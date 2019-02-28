<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Designation;
use App\Department;
use App\Role;
use App\TravelMember;
use App\TravelType;
use App\TravelStatus;
use App\UserMembers;
use App\Locations;
use App\Airlines;
use App\TravelRequest;
use App\TravelExpense;
use App\TravelExpenseList;
use App\ExpenseApprovals;
use Illuminate\Support\Facades\Hash;
use Auth;
use Datatables;
use DB;
use URL;
use Mail;
use Session;

class TravelExpenseController extends Controller {

    public $email = "portal.alert@proaxive.my";
    public $subject = "Expense Claim approval required";

    public function add_travelexpense() {
        $id = $data['id'] = Auth::user()->id;
        $data['name'] = Auth::user()->name;
        $data['last_id'] = TravelExpense::select('id')->orderBy('id', 'desc')->first();
        $data['travel_id'] = DB::table('travel_request')->where(['user' => $id, 'status' => 4])->select('request_no', 'id')->get();
        $data['users'] = User::select('name', 'id')->whereIn('role_id', [1, 2])->get();
        $data['payment_currency'] = DB::table('payment_currency')->where(['is_active' => 0])->get();
        $data['expense_type'] = DB::table('expense_type')->where(['is_active' => 0])->get();
        return view('customer/travelexpense/expense_form', ['data' => $data]);
    }

    public function add_travelexpense_hrsecretary() {
        $id = $data['id'] = Auth::user()->id;
        $data['name'] = User::select('name', 'id')->whereIn('role_id', [3])->get();
        $data['last_id'] = TravelExpense::select('id')->orderBy('id', 'desc')->first();
        $data['travel_id'] = DB::table('travel_request')->where(['user' => $id, 'status' => 4])->select('request_no', 'id')->get();
        $data['users'] = User::select('name', 'id')->whereIn('role_id', [1, 2])->get();
        $data['payment_currency'] = DB::table('payment_currency')->where(['is_active' => 0])->get();
        $data['expense_type'] = DB::table('expense_type')->where(['is_active' => 0])->get();
        return view('hr_secretary/travelexpense/expense_form', ['data' => $data]);
    }

    public function travel_details(Request $request) {
        $data = DB::table('travel_request')
                ->join('locations as location_trip_to_loc', 'location_trip_to_loc.id', '=', 'travel_request.trip_to_loc')
                ->join('locations as location_on_account_of', 'location_on_account_of.id', '=', 'travel_request.trip_from_loc')
                ->where(['travel_request.id' => $request->id])
                ->select('travel_request.purpose', 'location_trip_to_loc.name as Destination', 'travel_request.trip_from_loc', 'location_trip_to_loc.id as Destination_id'
                        , 'location_on_account_of.id as  on_account_of_id', 'location_on_account_of.name as on_account_of')
                ->first();
        if ($data) {
            return ['status' => true, 'data' => $data];
        } else {
            return ['status' => 'false'];
        }
    }

    public function travelexpense_save(Request $request) {
        if ($this->validation_input($request)) {
            try {
                DB::beginTransaction();
                $sort = [];
                $filename = $this->fileupload($request, 'authorization', 'line_manager_attachments');
                $count = TravelExpense::count();
                if ($count > 0) {
                    $last_id = TravelExpense::select('id')->orderBy('id', 'desc')->get();
                    $last_id = (int) $last_id[0]->id += 1;
                } else {
                    $last_id = 1;
                }
                if ($request->expense_type_list == "travel expense") {
                    $data = TravelExpense::create([
                                'employee_id' => $request->employee_id,
                                'travelexpense_no' => "TEN-" . date('Y') . "-1055" . $last_id,
                                'expense_type' => $request->expense_type_list,
                                'travel_id' => $request->travel_no,
                                'expense_authorization_docs' => e($filename),
                                'travel_purpose' => e($request->travel_purpose),
                                'destination_id' => $request->destination_id,
                                'payment_order_number' => "EC-" . date('Y') . "-1055" . $last_id,
                                'currency_id' => $request->expense_currency,
                                'by_order_of' => $request->by_order_of,
                                'on_account_of_location' => e($request->on_account_of),
                                'total_amount' => preg_replace("/[^0-9.]/", "", $request->total_amount),
                                'status' => 1,
                                'user_id' => Auth::user()->id
                    ]);
                }
                if ($request->expense_type_list == "general expense") {
                    $data = TravelExpense::create([
                                'employee_id' => $request->employee_id,
                                'travelexpense_no' => "TEN-" . date('Y') . "-1055" . $last_id,
                                'expense_type' => $request->expense_type_list,
                                'expense_authorization_docs' => e($filename),
                                'travel_purpose' => e($request->travel_purpose),
                                'destination' => e($request->destination),
                                'payment_order_number' => "EC-" . date('Y') . "-1055" . $last_id,
                                'currency_id' => $request->expense_currency,
                                'by_order_of' => $request->by_order_of,
                                'on_account_of_location' => e($request->on_account_of),
                                'total_amount' => preg_replace("/[^0-9.]/", "", $request->total_amount),
                                'status' => 1,
                                'user_id' => Auth::user()->id
                    ]);
                }
                for ($i = 0; $i < sizeof($request->expense_types); $i++) {
                    $sort[$i]['travel_expense_id'] = $data->id;
                    $sort[$i]['expense_type'] = $request->expense_types[$i];
                    $sort[$i]['date'] = date('Y-m-d', strtotime($request->expense_date[$i]));
                    $sort[$i]['description'] = e($request->expense_Description[$i]);
                    $sort[$i]['receipt_number'] = e($request->expense_receipt_number[$i]);
                    $sort[$i]['amount'] = preg_replace("/[^0-9.]/", "", $request->expense_amount[$i]);
                }
                TravelExpenseList::insert($sort);
                $user_name = user::where(['id' => $request->employee_id])->select('name')->first();
                $data_email = [
                    'travel_expense_id' => "TEN-" . date('Y') . "-1055" . $last_id
                    , 'employee' => $user_name->name
                    , 'purpose' => $request->travel_purpose
                    , 'amount' => $request->total_amount
                    , 'redirection_url' => URL::to('hrsecretary/expense/details/' . $data->id)
                    , 'type' => 'New Expense Claim Details'
                ];
                DB::commit();
                $this->sent_email_to_hrsecretary_create_expense($data_email);
                if ($request->user == "customer") {
                    return redirect('/expense/grid');
                }
                if ($request->user == "hrsecretary") {
                    return redirect('/hrsecretary/expense/grid');
                }
            } catch (Exception $ex) {
                DB::rollBack();
            }
        }
    }

    public function resubmit_save(Request $request) {
        if ($this->resubmit_validation_input($request)) {
            try {
                DB::beginTransaction();
                $sort = [];
                $filename = $this->fileupload($request, 'authorization', 'line_manager_attachments');
                if ($filename == "") {
                    $filename = $request->authorization_file_name;
                }
                $count = TravelExpense::count();
                if ($count > 0) {
                    $last_id = TravelExpense::select('id')->orderBy('id', 'desc')->get();
                    $last_id = (int) $last_id[0]->id += 1;
                } else {
                    $last_id = 1;
                }
                if ($request->expense_type_list == "travel expense") {
                    $data = TravelExpense::create([
                                'expense_claim_no' => $request->expense_claim_no,
                                'employee_id' => $request->employee_id,
                                'travelexpense_no' => "TEN-" . date('Y') . "-1055" . $last_id,
                                'expense_type' => $request->expense_type_list,
                                'travel_id' => $request->travel_no,
                                'expense_authorization_docs' => e($filename),
                                'travel_purpose' => e($request->travel_purpose),
                                'destination_id' => $request->destination_id,
                                'destination' => $request->destination,
                                'payment_order_number' => "EC-" . date('Y') . "-1055" . $last_id,
                                'currency_id' => $request->expense_currency,
                                'by_order_of' => $request->by_order_of,
                                'on_account_of_location' => e($request->on_account_of),
                                'total_amount' => preg_replace("/[^0-9.]/", "", $request->total_amount),
                                'status' => 1,
                                'user_id' => Auth::user()->id
                    ]);
                }
                if ($request->expense_type_list == "general expense") {
                    $data = TravelExpense::create([
                                'expense_claim_no' => $request->expense_claim_no,
                                'employee_id' => $request->employee_id,
                                'travelexpense_no' => "TEN-" . date('Y') . "-1055" . $last_id,
                                'expense_type' => $request->expense_type_list,
                                'expense_authorization_docs' => e($filename),
                                'travel_purpose' => e($request->travel_purpose),
                                'destination' => e($request->destination),
                                'payment_order_number' => "EC-" . date('Y') . "-1055" . $last_id,
                                'currency_id' => $request->expense_currency,
                                'by_order_of' => $request->by_order_of,
                                'on_account_of_location' => e($request->on_account_of),
                                'total_amount' => preg_replace("/[^0-9.]/", "", $request->total_amount),
                                'status' => 1,
                                'user_id' => Auth::user()->id
                    ]);
                }
                for ($i = 0; $i < sizeof($request->expense_types); $i++) {
                    $sort[$i]['travel_expense_id'] = $data->id;
                    $sort[$i]['expense_type'] = $request->expense_types[$i];
                    $sort[$i]['date'] = date('Y-m-d', strtotime($request->expense_date[$i]));
                    $sort[$i]['description'] = e($request->expense_Description[$i]);
                    $sort[$i]['receipt_number'] = e($request->expense_receipt_number[$i]);
                    $sort[$i]['amount'] = preg_replace("/[^0-9.]/", "", $request->expense_amount[$i]);
                }
                TravelExpenseList::insert($sort);
                $user_name = user::where(['id' => $request->employee_id])->select('name')->first();
                $data_email = [
                    'travel_expense_id' => "TEN-" . date('Y') . "-1055" . $last_id
                    , 'employee' => $user_name->name
                    , 'purpose' => $request->travel_purpose
                    , 'amount' => $request->total_amount
                    , 'redirection_url' => URL::to('hrsecretary/expense/details/' . $data->id)
                    , 'type' => 'Expense Claim Resubmit (' . $request->expense_claim_no . ')'
                ];
                TravelExpense::where(['id' => $request->expense_claim_id])->update(['is_resubmit_entry' => 1,'is_resubmit' => 1]);
                DB::commit();
                $this->sent_email_to_hrsecretary_create_expense($data_email);
              //  return $request->user;
                if ($request->user == "customer") {
                    return redirect('/expense/grid');
                }
                if ($request->user == "hr_secretary") {
                    return redirect('/hrsecretary/expense/grid');
                }
            } catch (Exception $ex) {
                DB::rollBack();
            }
        }
    }

//sent email to hr start
    public function sent_email_to_hr($data) {
        $managers_email = [];
        $email_list = User::where(['role_id' => 2])->select('email')->get();
        for ($i = 0; $i < sizeof($email_list); $i++) {
            array_push($managers_email, $email_list[$i]->email);
        }
        Mail::send(['html' => 'hr_secretary_email'], $data, function($message) use($managers_email) {
            $message->to($managers_email)->subject($this->subject);
            $message->from($this->email, 'Proaxive Management');
        });
        return true;
    }

//sent email to hr end
    public function validation_input($request) {
        $request->validate([
            'authorization' => 'required|max:5120']);
        return $request;
    }

    public function resubmit_validation_input($request) {
        $request->validate([
            'authorization' => 'max:5120']);
        return $request;
    }

    //expense_edit for customer start
    public function expense_edit_customer($expense_id) {
        $data = $this->get_expense_details($expense_id);
        if (sizeof($data['data'])) {
            return view('customer/travelexpense/expense_edit', ['data' => $data]);
        } else {
            return redirect()->back();
        }
    }

    //expense_edit for customer end

        //expense_edit for hrsecretary start
    public function expense_edit_hrsecretary($expense_id) {
        $data = $this->get_expense_details($expense_id);
        if (sizeof($data['data'])) {
            return view('hr_secretary/travelexpense/expense_edit', ['data' => $data]);
        } else {
            return redirect()->back();
        }
    }

    //expense_edit for hrsecretary end
    
    public function get_expense_details($expense_id) {
        $id = $data['id'] = Auth::user()->id;
        $data['name'] = Auth::user()->name;
        $data['last_id'] = TravelExpense::select('id')->orderBy('id', 'desc')->first();
        $data['travel_id'] = DB::table('travel_request')->where(['user' => $id, 'status' => 4])->select('request_no', 'id')->get();
        $data['users'] = User::select('name', 'id')->whereIn('role_id', [1, 2])->get();
        $data['payment_currency'] = DB::table('payment_currency')->where(['is_active' => 0])->get();
        $data['expense_type'] = DB::table('expense_type')->where(['is_active' => 0])->get();
        $data['data'] = DB::table('travel_expense')->where(['status' => 3, 'id' => $expense_id])->get();
        $data['expense'] = DB::table('travel_expense_list')->where(['travel_expense_id' => $expense_id, 'is_active' => 0])->get();
        return $data;
    }

//customer expense_list start
    public function grid() {
        return view('customer/travelexpense/expense_list');
    }

//customer expense_list end
    //hr  expense_list start
    public function grid_expense() {
        return view('hr/travelexpense/expense_list');
    }

    //hr  expense_list end
    // md expense_list start
    public function grid_expense_md() {
        return view('md/travelexpense/expense_list');
    }

    //md expense_list end
    // hrsecretary  expense_list start
    public function grid_expense_hrsecretary() {
        return view('hr_secretary/travelexpense/expense_list');
    }

    //hrsecretary expense_list end
    //expense details view for customer start
    public function expense_details($id) {
        $data['data'] = $this->expense_details_data($id);
        $data['approvals'] = $this->get_expense_approvals_status($id);
        return view('customer/travelexpense/expense_details', ['data' => $data]);
    }

    //expense details view for customer end
    //expense details view for hr  start
    public function expense_details_view($id) {
        $data['data'] = $this->expense_details_data($id);
        $data['approvals'] = $this->get_expense_approvals_status($id);
        $data['status_check'] = $this->expense_status_check($id);
        $data['status_check_hrsec'] = $this->expense_status_hrsec_check_check($id);

        return view('hr/travelexpense/expense_details', ['data' => $data]);
    }

    //expense details view for hr  end
    //expense details view for md start
    public function expense_details_view_md($id) {
        $data['data'] = $this->expense_details_data($id);
        $data['approvals'] = $this->get_expense_approvals_status($id);
        $data['status_check'] = $this->expense_status_check($id);
        $data['hrapproval_check'] = $this->expense_status_hrapproval_check($id);
        return view('md/travelexpense/expense_details', ['data' => $data]);
    }

    //expense details view for hrsecretary  start
    public function expense_details_view_hrsecretary($id) {
        $data['data'] = $this->expense_details_data($id);
        $data['approvals'] = $this->get_expense_approvals_status($id);
        $data['status_check'] = $this->expense_status_check($id);
        return view('hr_secretary/travelexpense/expense_details', ['data' => $data]);
    }

    //expense details view for hrsecretary  end
    //expense details view for  md end

    public function expense_details_data($id) {
        return DB::table('travel_expense')
                        ->join('travel_expense_list', 'travel_expense_list.travel_expense_id', '=', 'travel_expense.id')
                        ->join('currency_type', 'currency_type.id', '=', 'travel_expense.currency_id')
                        ->join('expense_type', 'expense_type.id', '=', 'travel_expense_list.expense_type')
                        ->join('users as u_1', 'u_1.id', '=', 'travel_expense.by_order_of')
                        ->join('users as u_2', 'u_2.id', '=', 'travel_expense.employee_id')
                        ->join('travel_status', 'travel_status.id', '=', 'travel_expense.status')
                        ->leftjoin('travel_request', 'travel_request.id', '=', 'travel_expense.travel_id')
                        ->leftjoin('locations as  loc_destination', 'loc_destination.id', '=', 'travel_expense.destination_id')
                        ->leftjoin('locations as  loc_on_account_of', 'loc_on_account_of.id', '=', 'travel_expense.on_account_of')
                        ->select('travel_expense.*'
                                , 'expense_type.name as travel_expense_list_expense_name'
                                , 'travel_expense_list.expense_type as travel_expense_list_expense_type', 'travel_expense_list.date as travel_expense_list_date'
                                , 'travel_expense_list.description as travel_expense_list_description'
                                , 'travel_expense_list.receipt_number as travel_expense_list_receipt_number'
                                , 'travel_expense_list.amount as travel_expense_list_amount'
                                , 'currency_type.name as currency_name', 'u_1.name as by_order_of'
                                , 'u_2.emp_id', 'u_2.name as employee_name', 'u_2.email as employee_email', 'u_2.passport_attachment as employee_passport_attachment'
                                , 'u_2.passport_no'
                                , 'travel_request.request_no', 'loc_destination.name as location_destination'
                                , 'loc_on_account_of.name as location_account_of_name', 'travel_status.name as status', 'travel_expense.status as status_id'
                        )
                        ->where(['travel_expense.id' => $id])->orderBy('travel_expense.id', 'DESC')->get();
    }

//expense list grid for customer start
    public function get_expense_list() {
        $list = DB::table('travel_expense')->where(['employee_id' => Auth::user()->id])->orderBy('travel_expense.id', 'DESC')->get();
        return Datatables::of($list)
                        ->addColumn('status', function($list) {
                            if ($list->status == 1) {
                                return "<i class='fa fa-clock-o' title='Pending'></i>";
                            } else if ($list->status == 2) {
                                return "<i class='fa fa-spinner' title='Processing' style='color: blue;'></i>";
                            } else if ($list->status == 3) {

                                return "<i class='fa fa-ban' style='color:red;' title='Rejected'></i>";
                            } else if ($list->status == 4) {
                                return "<i class='fa fa-check-circle' style='color:green;' title='Approved'></i>";
                            }
                        })
                        ->addColumn('created_at', function($list) {
                            return date("d-M-Y", strtotime($list->created_at));
                        })->addColumn('action', function ($list) {
                            $btn = '<button title="View Details"><a href="' . url('expense/details/' . $list->id . '') . '" style="color:#fff;"><i class="icon ion-document-text"></i></a></button></a>';
                            if ($list->status == 3 && $list->is_resubmit==0) {
                                $btn .= '<button title="Resubmit Expense Claim"><a href="' . url('customer/expense/edit/' . $list->id . '') . '" style="color:#fff;"><i class="fa fa-history"></i></a></button></a>';
                            }
                            return $btn;
                        })
                        ->make(true);
    }

//expense list grid for customer end
    //expense list grid for hr start
    public function get_all_customers_expense_list() {
        $list = DB::table('travel_expense')->orderBy('travel_expense.id', 'DESC')->get();
        return Datatables::of($list)
                        ->addColumn('status', function($list) {
                            if ($list->status == 1) {
                                return "<i class='fa fa-clock-o' title='Pending'></i>";
                            } else if ($list->status == 2) {
                                return "<i class='fa fa-spinner' title='Processing' style='color: blue;'></i>";
                            } else if ($list->status == 3) {

                                return "<i class='fa fa-ban' style='color:red;' title='Rejected'></i>";
                            } else if ($list->status == 4) {
                                return "<i class='fa fa-check-circle' style='color:green;' title='Approved'></i>";
                            }
                        })
                        ->addColumn('created_at', function($list) {
                            return date("d-M-Y", strtotime($list->created_at));
                        })->addColumn('action', function ($list) {
                            return '<button title="View Details"><a href="' . url('expense/details/view/' . $list->id . '') . '" style="color:#fff;"><i class="icon ion-document-text"></i></a></button></a>';
                        })
                        ->make(true);
    }

//expense list grid for hr end
    //expense list grid for hrsecretary start
    public function get_all_customers_expense_list_hrsecretary() {
        $list = DB::table('travel_expense')->orderBy('travel_expense.id', 'DESC')->get();
        return Datatables::of($list)
                        ->addColumn('status', function($list) {
                            if ($list->status == 1) {
                                return "<i class='fa fa-clock-o' title='Pending'></i>";
                            } else if ($list->status == 2) {
                                return "<i class='fa fa-spinner' title='Processing' style='color: blue;'></i>";
                            } else if ($list->status == 3) {

                                return "<i class='fa fa-ban' style='color:red;' title='Rejected'></i>";
                            } else if ($list->status == 4) {
                                return "<i class='fa fa-check-circle' style='color:green;' title='Approved'></i>";
                            }
                        })
                        ->addColumn('created_at', function($list) {
                            return date("d-M-Y", strtotime($list->created_at));
                        })->addColumn('action', function ($list) {
                            $btn = '<button title="View Details"><a href="' . url('/hrsecretary/expense/details/' . $list->id . '') . '" style="color:#fff;"><i class="icon ion-document-text"></i></a></button></a>';
                            if ($list->status == 3 && $list->is_resubmit==0) {
                                $btn .= '<button title="Resubmit Expense Claim"><a href="' . url('hrsecretary/expense/edit/' . $list->id . '') . '" style="color:#fff;"><i class="fa fa-history"></i></a></button></a>';
                            }
                            return $btn;
                        })
                        ->make(true);
    }

//expense list grid for hrsecretary end
    //expense list grid for  md start
    public function get_all_customers_expense_list_md() {
        $list = DB::table('travel_expense')->whereIn('status', [2, 3, 4])->orderBy('travel_expense.id', 'DESC')->get();
        return Datatables::of($list)
                        ->addColumn('status', function($list) {
                            if ($list->status == 1) {
                                return "<i class='fa fa-clock-o' title='Pending'></i>";
                            } else if ($list->status == 2) {
                                return "<i class='fa fa-spinner' title='Processing' style='color: blue;'></i>";
                            } else if ($list->status == 3) {

                                return "<i class='fa fa-ban' style='color:red;' title='Rejected'></i>";
                            } else if ($list->status == 4) {
                                return "<i class='fa fa-check-circle' style='color:green;' title='Approved'></i>";
                            }
                        })
                        ->addColumn('created_at', function($list) {
                            return date("d-M-Y", strtotime($list->created_at));
                        })->addColumn('action', function ($list) {
                            return '<button title="View Details"><a href="' . url('expense/details/view/md/' . $list->id . '') . '" style="color:#fff;"><i class="icon ion-document-text"></i></a></button></a>';
                        })
                        ->make(true);
    }

//expense list grid for  md end
    public function get_expense_approvals_status($expense_id) {
        $data = DB::table('expense_approvals')
                        ->join('users', 'users.id', '=', 'expense_approvals.user_id')
                        ->join('roles', 'roles.id', '=', 'users.role_id')
                        ->join('travel_status', 'travel_status.id', '=', 'expense_approvals.status')
                        ->select('expense_approvals.comment', 'users.name as user_name', 'roles.name as user_role'
                                , 'travel_status.name as status')
                        ->where(['expense_approvals.expense_id' => $expense_id])->get();
        if (sizeof($data)) {
            return ['status' => true, 'data' => $data];
        } else {
            return ['status' => 'false'];
        }
    }

    public function expense_status_check($expense_id) {
        return DB::table('expense_approvals')
                        ->join('users', 'users.id', '=', 'expense_approvals.user_id')
                        ->where(['expense_approvals.expense_id' => $expense_id, 'users.role_id' => Auth::user()->role_id])->count();
    }

// status hrapproval check for hr start
    public function expense_status_hrsec_check_check($expense_id) {

        return DB::table('expense_approvals')
                        ->join('users', 'users.id', '=', 'expense_approvals.user_id')
                        ->where(['expense_approvals.expense_id' => $expense_id, 'users.role_id' => 4, 'expense_approvals.status' => 4])->count();
    }

// status hrapproval check for hr end
// status hrapproval check for md start
    public function expense_status_hrapproval_check($expense_id) {
        return DB::table('expense_approvals')
                        ->join('users', 'users.id', '=', 'expense_approvals.user_id')
                        ->where(['expense_id' => $expense_id, 'role_id' => 2, 'expense_approvals.status' => 4])->count();
    }

// status hrapproval check for md end
    public function expense_status_update(Request $request) {
        if (isset($request->status)) {
            if ($request->status != "") {
                ExpenseApprovals::create([
                    'expense_id' => $request->expense_id,
                    'user_id' => Auth::user()->id,
                    'comment' => $request->comment,
                    'status' => $request->status,
                    'request_status' => 0
                ]);
                if (Auth::user()->role_id == 4 && $request->status == 4) {
                    $this->travel_expense_details_for_email_sent_hr_secretary($request->expense_id, Auth::user()->id, $request->comment, $request->status);
                    TravelExpense::where(['id' => $request->expense_id])->update(['status' => 2]);
                }
                if (Auth::user()->role_id == 4 && $request->status == 3) {
                    TravelExpense::where(['id' => $request->expense_id])->update(['status' => 3]);
                }
                if (Auth::user()->role_id == 2 && $request->status == 4) {
                    $this->travel_expense_details_email_sent_for_hr_approve($request->expense_id, Auth::user()->id, $request->comment, $request->status);
                    $this->travel_expense_details_email_sent_hr_approve_for_customer($request->expense_id, Auth::user()->id, $request->comment, $request->status);
                    TravelExpense::where(['id' => $request->expense_id])->update(['status' => 2]);
                }
                if (Auth::user()->role_id == 2 && $request->status == 3) {
                    TravelExpense::where(['id' => $request->expense_id])->update(['status' => 3]);
                    $this->travel_expense_details_email_sent_hr_approve_for_customer($request->expense_id, Auth::user()->id, $request->comment, $request->status);
                }
                if (Auth::user()->role_id == 1 && $request->status == 4) {
                    $this->travel_expense_details_email_sent_md_approve($request->expense_id, Auth::user()->id, $request->comment, $request->status);
                    TravelExpense::where(['id' => $request->expense_id])->update(['status' => 4]);
                }
                if (Auth::user()->role_id == 1 && $request->status == 3) {
                    $this->travel_expense_details_email_sent_md_approve($request->expense_id, Auth::user()->id, $request->comment, $request->status);
                    TravelExpense::where(['id' => $request->expense_id])->update(['status' => 3]);
                }
                $status = TravelStatus::where(['id' => $request->status])->select('name')->first();
                return redirect()->back()->with('error_message', 'Your Expense Claim has been ' . $status->name);
            } else {
                return ['status' => false];
            }
        } else {
            return ['status' => false];
        }
    }

    public function get_travel_id(Request $request) {
        return DB::table('travel_request')->where(['user' => $request->id, 'status' => 4])->select('request_no', 'id')->get();
    }

//email_sent_customer_for_md_approve start
    public function travel_expense_details_email_sent_for_hr_approve($expense_id, $user_id, $comment, $status_id) {
        $employee = DB::table('travel_expense')
                ->join('users', 'users.id', 'travel_expense.employee_id')
                ->where(['travel_expense.id' => $expense_id])
                ->select('travel_expense.employee_id', 'travel_expense.travel_purpose'
                        , 'travel_expense.total_amount', 'users.name', 'travel_expense.travelexpense_no')
                ->first();
        $status = TravelStatus::where(['id' => $status_id])->select('name')->first();
        $data_email = [
            'travel_expense_id' => $employee->travelexpense_no
            , 'employee' => $employee->name
            , 'purpose' => $employee->travel_purpose
            , 'amount' => $employee->total_amount
            , 'redirection_url' => URL::to('expense/details/view/md/' . $expense_id)
            , 'comment' => $comment
            , 'role_name' => Auth::user()->name
            , 'status' => $status
        ];
        $this->sent_email_to_md($data_email);
        return true;
    }

//email_sent_customer_for_md_approve end
//hr secretary approved sent email to hr start
    public function travel_expense_details_for_email_sent_hr_secretary($expense_id, $user_id, $comment, $status_id) {
        $employee = DB::table('travel_expense')
                ->join('users', 'users.id', 'travel_expense.employee_id')
                ->where(['travel_expense.id' => $expense_id])
                ->select('travel_expense.employee_id', 'travel_expense.travel_purpose'
                        , 'travel_expense.total_amount', 'users.name', 'travel_expense.travelexpense_no')
                ->first();
        $status = TravelStatus::where(['id' => $status_id])->select('name')->first();
        $data_email = [
            'travel_expense_id' => $employee->travelexpense_no
            , 'employee' => $employee->name
            , 'purpose' => $employee->travel_purpose
            , 'amount' => $employee->total_amount
            , 'redirection_url' => URL::to('/expense/details/view/' . $expense_id)
            , 'comment' => $comment
            , 'role_name' => Auth::user()->name
            , 'status' => $status
        ];
        $this->sent_email_to_hr($data_email);
        return true;
    }

//hr secretary approved sent email to hr end
    //md approve sent email  to customer start
    public function travel_expense_details_email_sent_md_approve($expense_id, $user_id, $comment, $status_id) {
        $employee = DB::table('travel_expense')
                ->join('users', 'users.id', 'travel_expense.employee_id')
                ->where(['travel_expense.id' => $expense_id])
                ->select('travel_expense.employee_id', 'travel_expense.travel_purpose'
                        , 'travel_expense.total_amount', 'users.name', 'travel_expense.travelexpense_no'
                        , 'users.email as user_email')
                ->first();
        $status = TravelStatus::where(['id' => $status_id])->select('name')->first();
        $data_email = [
            'travel_expense_id' => $employee->travelexpense_no
            , 'employee' => $employee->name
            , 'purpose' => $employee->travel_purpose
            , 'amount' => $employee->total_amount
            , 'redirection_url' => URL::to('expense/details/' . $expense_id)
            , 'comment' => $comment
            , 'role_name' => Auth::user()->name
            , 'status' => $status
        ];
        $this->sent_email_to_customer($data_email, $employee->user_email);
        return true;
    }

//md approve sent email to customer end

    public function sent_email_to_customer($data, $user_email) {
        Mail::send(['html' => 'md_email'], $data, function($message) use($user_email) {
            $message->to($user_email)->subject($this->subject);
            $message->from($this->email, 'Proaxive Management');
        });
        return true;
    }

//email_sent_for_customer_approve start
    public function travel_expense_details_email_sent_hr_approve_for_customer($expense_id, $user_id, $comment, $status_id) {
        $employee = DB::table('travel_expense')
                ->join('users', 'users.id', 'travel_expense.employee_id')
                ->where(['travel_expense.id' => $expense_id])
                ->select('travel_expense.employee_id', 'travel_expense.travel_purpose'
                        , 'travel_expense.total_amount', 'users.name', 'travel_expense.travelexpense_no'
                        , 'users.email as user_email')
                ->first();
        $status = TravelStatus::where(['id' => $status_id])->select('name')->first();
        $data_email = [
            'travel_expense_id' => $employee->travelexpense_no
            , 'employee' => $employee->name
            , 'purpose' => $employee->travel_purpose
            , 'amount' => $employee->total_amount
            , 'redirection_url' => URL::to('expense/details/' . $expense_id)
            , 'comment' => $comment
            , 'role_name' => Auth::user()->name
            , 'status' => $status
        ];
        $this->sent_email_to_customer_hr_approve($data_email, $employee->user_email);
        return true;
    }

//email_sent_for_customer_approve end
    //hr approve sent email customer start
    public function sent_email_to_customer_hr_approve($data, $user_email) {
        Mail::send(['html' => 'hr_email'], $data, function($message) use($user_email) {
            $message->to($user_email)->subject($this->subject);
            $message->from($this->email, 'Proaxive Management');
        });
        return true;
    }

//hr approve sent email customer end

    public function sent_email_to_md($data) {
        $hr_email = [];
        $email_list = User::where(['role_id' => 1])->select('email')->get();
        for ($i = 0; $i < sizeof($email_list); $i++) {
            array_push($hr_email, $email_list[$i]->email);
        }
        Mail::send(['html' => 'hr_email'], $data, function($message) use($hr_email) {
            $message->to($hr_email)->subject($this->subject);
            $message->from($this->email, 'Proaxive Management');
        });
        return true;
    }

//sent to email create expense start
    public function sent_email_to_hrsecretary_create_expense($data) {
        $hr_email = [];
        $email_list = User::where(['role_id' => 4])->select('email')->get();
        for ($i = 0; $i < sizeof($email_list); $i++) {
            array_push($hr_email, $email_list[$i]->email);
        }
        Mail::send(['html' => 'create_expense_email'], $data, function($message) use($hr_email) {
            $message->to($hr_email)->subject($this->subject);
            $message->from($this->email, 'Proaxive Management');
        });
        return true;
    }

//sent to email create expense end
    /*
      public function sent_email_to_hrsecretary($data) {
      $hr_email = [];
      $email_list = User::where(['role_id' => 2])->select('email')->get();
      for ($i = 0; $i < sizeof($email_list); $i++) {
      array_push($hr_email, $email_list[$i]->email);
      }
      Mail::send(['html' => 'approval_hrsecretary_email'], $data, function($message) use($hr_email) {
      $message->to($hr_email)->subject('Expense Approvel!');
      $message->from('ammad.baig@deploy.com.pk', 'Proaxive Management');
      });
      return true;
      }
     */
    public function fileupload($request, $name, $directory) {
        if ($request->hasFile($name) && $request->$name->isValid()) {
            $extension = $request->$name->extension();
            $filename = date('d-m-y') . "_" . time() . "." . $extension;
            $request->$name->move(public_path($directory), $filename);
            return $filename;
        }
    }

}

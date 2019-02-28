<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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

class TravelExpenseApiController extends Controller {

    public function get_expense_list(Request $request) {
        $data = [];
        if ($request->user()->role_id == 1) {
            $data = $this->get_expense_list_hr_md();
        }
        if ($request->user()->role_id == 2) {
            $data = $this->get_expense_list_hr();
        }
        if ($request->user()->role_id == 4) {
            $data = $this->get_expense_list_hr_hrsecretary();
        }
        if (sizeof($data)) {
            return ['status_code' => 200, 'data' => $data];
        } else {
            return ['status_code' => 401];
        }
    }

    public function get_expense_list_hr_hrsecretary() {
        return $list = DB::table('travel_expense')
                        ->join('payment_currency', 'payment_currency.id', '=', 'travel_expense.currency_id')
                        ->join('travel_status', 'travel_status.id', '=', 'travel_expense.status')
                        ->join('users', 'users.id', '=', 'travel_expense.employee_id')
                        ->select('travel_expense.id', 'travel_expense.travelexpense_no as expense_no', 'travel_status.id as status_id'
                                , 'travel_status.name as status', 'users.name as employee', DB::raw("CONCAT(travel_expense.total_amount,' ',payment_currency.name) AS amount"))
                        ->selectRaw("DATE_FORMAT(travel_expense.created_at ,'%d-%m-%y' ) as date")
                        ->orderBy('travel_expense.id', 'DESC')->get();
    }

    public function get_expense_list_hr() {

        return $list = DB::table('travel_expense')
                        ->join('payment_currency', 'payment_currency.id', '=', 'travel_expense.currency_id')
                        ->join('travel_status', 'travel_status.id', '=', 'travel_expense.status')
                        ->join('users', 'users.id', '=', 'travel_expense.employee_id')
                        ->select('travel_expense.id', 'travel_expense.travelexpense_no as expense_no', 'travel_status.id as status_id'
                                , 'travel_status.name as status', 'users.name as employee', DB::raw("CONCAT(travel_expense.total_amount,' ',payment_currency.name) AS amount"))
                        ->selectRaw("DATE_FORMAT(travel_expense.created_at ,'%d-%m-%y' ) as date")
                        ->orderBy('travel_expense.id', 'DESC')->get();
    }

    public function get_expense_list_hr_md() {
        return $list = DB::table('travel_expense')
                        ->join('payment_currency', 'payment_currency.id', '=', 'travel_expense.currency_id')
                        ->join('travel_status', 'travel_status.id', '=', 'travel_expense.status')
                        ->join('users', 'users.id', '=', 'travel_expense.employee_id')
                        ->select('travel_expense.id', 'travel_expense.travelexpense_no as expense_no', 'travel_status.id as status_id'
                                , 'travel_status.name as status', 'users.name as employee', DB::raw("CONCAT(travel_expense.total_amount,' ',payment_currency.name) AS amount"))
                        ->selectRaw("DATE_FORMAT(travel_expense.created_at ,'%d-%m-%y' ) as date")
                        ->whereIn('status', [2, 3, 4])->orderBy('travel_expense.id', 'DESC')->get();
    }

    public function get_travel_request(Request $request) {
        $data = [];
        if ($request->user()->role_id == 1) {
            $data = $this->get_travel_request_list_md();
        }
        if ($request->user()->role_id == 2) {
            $data = $this->get_travel_request_list_hr();
        }
        if ($request->user()->role_id == 4) {
            
        }
        if (sizeof($data)) {
            return ['status_code' => 200, 'data' => $data];
        } else {
            return ['status_code' => 404];
        }
    }

    public function get_travel_request_list_hr() {
        return $list = DB::table('travel_request')->join('locations as from_loc', 'from_loc.id', '=', 'travel_request.trip_from_loc')
                ->join('locations as to_loc', 'to_loc.id', '=', 'travel_request.trip_to_loc')
                ->join('travel_type', 'travel_type.id', '=', 'travel_request.travel_type')
                ->join('users', 'users.id', '=', 'travel_request.user')
                ->join('travel_status', 'travel_status.id', '=', 'travel_request.status')
                ->join('airlines', 'airlines.id', '=', 'travel_request.airline_id')
                ->select(
                        'travel_request.request_no', 'travel_request.id', 'travel_request.is_resubmit_entry', 'travel_request.start_date as departure_date', 'travel_request.end_date as return_date', 'travel_request.purpose', 'from_loc.name as from_loc', 'from_loc.code as from_code', 'to_loc.name as to_loc', 'to_loc.code as to_code', 'travel_type.name as travel_type', 'users.first_name as first_name', 'users.last_name as last_name', 'users.email', 'users.name as full_name', 'travel_request.created_at as created_date', 'travel_request.comment', 'travel_status.name as status', 'travel_status.id as status_id', 'airlines.name as airline'
                )
                ->get();
    }

    public function get_travel_request_list_md() {
        return $list = DB::table('travel_request')->join('locations as from_loc', 'from_loc.id', '=', 'travel_request.trip_from_loc')
                ->join('locations as to_loc', 'to_loc.id', '=', 'travel_request.trip_to_loc')
                ->join('travel_type', 'travel_type.id', '=', 'travel_request.travel_type')
                ->join('users', 'users.id', '=', 'travel_request.user')
                ->join('travel_status', 'travel_status.id', '=', 'travel_request.status')
                ->join('airlines', 'airlines.id', '=', 'travel_request.airline_id')
                ->select(
                        'travel_request.request_no', 'travel_request.id', 'travel_request.is_resubmit_entry', 'travel_request.start_date as departure_date', 'travel_request.end_date as return_date', 'travel_request.purpose', 'from_loc.name as from_loc', 'from_loc.code as from_code', 'to_loc.name as to_loc', 'to_loc.code as to_code', 'travel_type.name as travel_type', 'users.first_name as first_name', 'users.last_name as last_name', 'users.email', 'users.name as full_name', 'travel_request.created_at as created_date', 'travel_request.comment', 'travel_status.name as status', 'travel_status.id as status_id', 'airlines.name as airline'
                )->where('status', 2)
                ->get();
    }

    public function get_expense_details($id, Request $request) {
        $expense_details = $this->expense_details($id, $request);

		
		$data['employee']['name']=$expense_details[0]->employee_name;
		$data['employee']['u_id']=$expense_details[0]->emp_id;
		$data['employee']['email']=$expense_details[0]->email;
		$data['employee']['department']=$expense_details[0]->u_department;
		$data['employee']['designation']=$expense_details[0]->u_designation;
		$data['employee']['passport_no']=$expense_details[0]->passport_no;
		$data['employee']['passport_attachment_link']=$expense_details[0]->passport_attachment;
		
		
		$data['expense_details']['request_no']=$expense_details[0]->request_no;
		$data['expense_details']['type']=$expense_details[0]->expense_type;
		$data['expense_details']['purpose']=$expense_details[0]->travel_purpose;
		$data['expense_details']['total_amount']=$expense_details[0]->total_amount;
		$data['expense_details']['status']=$expense_details[0]->status;
		
		$data['expense_details']['payment_order']['pon']=$expense_details[0]->payment_order_number;
		$data['expense_details']['payment_order']['by_order_of']=$expense_details[0]->by_order_of;
		$data['expense_details']['payment_order']['currency']=$expense_details[0]->currency_name;
		$data['expense_details']['payment_order']['on_account_of']=$expense_details[0]->on_account_of_location;
		$data['expense_details']['payment_order']['expense_authorization_attachment']=$expense_details[0]->expense_authorization_docs;
		
		for($i=0;$i<sizeof($expense_details);$i++){
		$data['expense_details']['expenses'][$i]['type']=$expense_details[$i]->travel_expense_list_expense_name;
		$data['expense_details']['expenses'][$i]['date']=$expense_details[$i]->travel_expense_list_date;
		$data['expense_details']['expenses'][$i]['description']=$expense_details[$i]->travel_expense_list_description;
		$data['expense_details']['expenses'][$i]['receipt_no']=$expense_details[$i]->travel_expense_list_receipt_number;
		$data['expense_details']['expenses'][$i]['amount']=$expense_details[$i]->travel_expense_list_amount;
		}
	
		
        if ($request->user()->role_id == 1) {
            $data['approvals'] = $this->get_expense_approvals_status($id, $request);
            $data['status_check'] = $this->expense_status_check($id, $request);
            $data['hrapproval_check'] = $this->expense_status_hrapproval_check($id, $request);
        }

        if ($request->user()->role_id == 2) {
            $data['approvals'] = $this->get_expense_approvals_status($id, $request);
            $data['status_check'] = $this->expense_status_check($id, $request);
            $data['status_check_hrsec'] = $this->expense_status_hrsec_check($id, $request);
        }
        if ($request->user()->role_id == 4) {
            $data['approvals'] = $this->get_expense_approvals_status($id, $request);
            $data['status_check'] = $this->expense_status_check($id, $request);
        }

        if (sizeof($data)) {
            return ['status_code' => 200, 'data' => $data];
        } else {
            return ['status_code' => 401];
        }
    }

    public function expense_details($id, $request) {
        $data = DB::table('travel_expense')
                        ->join('travel_expense_list', 'travel_expense_list.travel_expense_id', '=', 'travel_expense.id')
                        ->join('payment_currency', 'payment_currency.id', '=', 'travel_expense.currency_id')
                        ->join('expense_type', 'expense_type.id', '=', 'travel_expense_list.expense_type')
                        ->join('users as u_1', 'u_1.id', '=', 'travel_expense.by_order_of')
                        ->join('users as u_2', 'u_2.id', '=', 'travel_expense.employee_id')
                        ->join('travel_status', 'travel_status.id', '=', 'travel_expense.status')
						->join('department', 'department.id', '=', 'u_2.department_id')
						->join('designation', 'designation.id', '=', 'u_2.designation_id')
                        ->leftjoin('travel_request', 'travel_request.id', '=', 'travel_expense.travel_id')
                        ->leftjoin('locations as  loc_destination', 'loc_destination.id', '=', 'travel_expense.destination_id')
                        ->leftjoin('locations as  loc_on_account_of', 'loc_on_account_of.id', '=', 'travel_expense.on_account_of')
                        ->select('travel_expense.*'
                                , 'expense_type.name as travel_expense_list_expense_name'
                                , 'travel_expense_list.expense_type as travel_expense_list_expense_type'//, 'travel_expense_list.date as travel_expense_list_date'
                                , 'travel_expense_list.description as travel_expense_list_description'
                                , 'travel_expense_list.receipt_number as travel_expense_list_receipt_number'
                                , 'payment_currency.name as currency_name', 'u_1.name as by_order_of'
                                , 'u_2.name as employee_name',  'u_2.email as email','u_2.emp_id', 'travel_request.request_no'
								,'department.name as u_department','designation.name as u_designation','u_2.passport_no','u_2.passport_attachment'
                                , 'loc_destination.name as location_destination'
                                , 'loc_on_account_of.name as location_account_of_name', 'travel_status.name as status', 'travel_expense.status as status_id'
                        ,DB::raw("CONCAT(travel_expense.total_amount,' ',payment_currency.name) AS total_amount")
						 ,DB::raw("CONCAT(travel_expense_list.amount,' ',payment_currency.name) AS travel_expense_list_amount")
						)->selectRaw("DATE_FORMAT(travel_expense_list.date ,'%d-%m-%y' ) as travel_expense_list_date")
                        ->where(['travel_expense.id' => $id])->orderBy('travel_expense.id', 'DESC')->get();
        return $data;
    }

    public function get_expense_approvals_status($expense_id, $request) {
     return   $data = DB::table('expense_approvals')
                        ->join('users', 'users.id', '=', 'expense_approvals.user_id')
                        ->join('roles', 'roles.id', '=', 'users.role_id')
                        ->join('travel_status', 'travel_status.id', '=', 'expense_approvals.status')
                        ->select('expense_approvals.comment', 'users.name as approver', 'roles.name as role_name'
                                , 'travel_status.name as status_name')
                        ->where(['expense_approvals.expense_id' => $expense_id])->get();
    }

    public function expense_status_check($expense_id, $request) {
        return DB::table('expense_approvals')
                        ->join('users', 'users.id', '=', 'expense_approvals.user_id')
                        ->where(['expense_approvals.expense_id' => $expense_id, 'users.role_id' => $request->user()->role_id])->count();
    }

// status hrapproval check for hr start
    public function expense_status_hrsec_check($expense_id, $request) {

        return DB::table('expense_approvals')
                        ->join('users', 'users.id', '=', 'expense_approvals.user_id')
                        ->where(['expense_approvals.expense_id' => $expense_id, 'users.role_id' => 4, 'expense_approvals.status' => 4])->count();
    }

// status hrapproval check for hr end
// status hrapproval check for md start
    public function expense_status_hrapproval_check($expense_id, $request) {
        return DB::table('expense_approvals')
                        ->join('users', 'users.id', '=', 'expense_approvals.user_id')
                        ->where(['expense_id' => $expense_id, 'role_id' => 2, 'expense_approvals.status' => 4])->count();
    }

// status hrapproval check for md end

    public function get_travel_request_details($id, Request $request) {
        $exist = TravelRequest::where(['id' => $id])->count();
        if ($exist) {
            $list= DB::table('travel_request')->join('locations as from_loc', 'from_loc.id', '=', 'travel_request.trip_from_loc')
                ->join('locations as to_loc', 'to_loc.id', '=', 'travel_request.trip_to_loc')
                ->join('travel_type', 'travel_type.id', '=', 'travel_request.travel_type')
                ->join('users', 'users.id', '=', 'travel_request.user')
                ->join('department', 'users.department_id', '=', 'department.id')
                ->join('designation', 'users.designation_id', '=', 'designation.id')
                ->join('travel_status', 'travel_status.id', '=', 'travel_request.status')
                ->join('airlines', 'airlines.id', '=', 'travel_request.airline_id')
                ->select(
                    'travel_request.request_no',
                    'travel_request.id',
                    'travel_request.archive',
                    'travel_request.is_resubmit_entry',
                    'travel_request.start_date',
                    'travel_request.end_date',
                    'travel_request.purpose',
                    'travel_request.class',
                    'travel_request.start_date',
                    'travel_request.end_date',
                    'travel_request.comment',
                    'travel_request.line_manager_attachments',
                    'from_loc.name as from_loc',
                    'from_loc.code as from_code',
                    'to_loc.name as to_loc',
                    'to_loc.code as to_code',
                    'travel_type.name as travel_type',

                    'users.first_name as employee_firstname',
                    'users.last_name as employee_lastname',
                    'users.email as employee_email',
                    'users.name as employee_name',
                    'users.emp_id as employee_id',
                    'users.passport_no as employee_passport_no',
                    'users.passport_attachment as employee_passport_attachment',
                    'department.name as employee_department',
                    'designation.name as employee_designation',

                    'travel_request.created_at as created_date',
                    'travel_request.comment',
                    'travel_status.name as status',
                    'travel_status.id as status_id',
                    'airlines.name as airline'
                )->where('travel_request.id', $id)
                ->first();


            $members=DB::table('travel_members')->join('user_members', 'user_members.id', '=', 'travel_members.user_member_id')
                ->join('relation', 'relation.id', '=', 'user_members.relation_id')
                ->select('user_members.first_name as first_name',
                'user_members.last_name as last_name',
                'user_members.passport_no as passport_no',
                'user_members.passport_attachment as passport_attachment_link',
                    'relation.name as relationship'
                )
                ->where('travel_members.travel_id', $id)
                ->get();


            $approval_list=DB::table('request_approvals')->join('users', 'users.id', '=', 'request_approvals.user_id')
                ->join('roles', 'roles.id', '=', 'users.role_id')
                ->join('travel_status', 'travel_status.id', '=', 'request_approvals.status')
                ->select('users.name as approver',
                    'users.role_id as role_id',
                    'roles.name as role_name',
                    'travel_status.name as status_name',
                    'travel_status.id as status_id',
                    'request_approvals.comment as comment'
                )
                ->where('request_approvals.request_id', $id)
                ->get();

            $endDate=null;
            if($list->end_date!=null){
                $endDate=date('d-m-Y', strtotime($list->end_date));
            }

            $data=[
                'request_no'=>$list->request_no,
                'departure'=>$list->from_loc,
                'destination'=>$list->to_loc,
                'purpose'=>$list->purpose,
                'type'=>$list->travel_type,
                'class'=>$list->class,
                'departure_date'=>date('d-m-Y', strtotime($list->start_date)),
                'return_date'=>$endDate,
                'comments'=>$list->comment,
                'travel_auth_attachment_link'=>$list->line_manager_attachments,
                'approval_status_code'=>$list->status_id,
                'approval_status'=>$list->status,

            ];
            $data['employee']=[
                'name'=>$list->employee_name,
                'u_id'=>$list->employee_id,
                'email'=>$list->employee_email,
                'department'=>$list->employee_department,
                'designation'=>$list->employee_designation,
                'passport_no'=>$list->employee_passport_no,
                'passport_attachment_link'=>$list->employee_passport_attachment,
            ];

            $data['additional_travelers']=$members;

            $data['approvals']=$approval_list;





            return ['status_code' => 200, 'data' => $data];
        } else {
            return ['status_code' => 401];
        }




    }

    public function expense_status_update(Request $request) {
        $role_id = $request->user()->role_id;
        if (isset($request->expense_id) && isset($request->comment) && isset($request->status_id)) {
            if ($request->expense_id != "" && $request->status_id != "") {
                ExpenseApprovals::create([
                    'expense_id' => $request->expense_id,
                    'user_id' => $request->user()->id,
                    'comment' => $request->comment,
                    'status' => $request->status_id,
                    'request_status' => 1
                ]);
                if ($role_id == 4 && $request->status_id == 4) {
                    TravelExpense::where(['id' => $request->expense_id])->update(['status' => 2]);
                }
                if ($role_id == 4 && $request->status_id == 3) {
                    TravelExpense::where(['id' => $request->expense_id])->update(['status' => 3]);
                }
                if ($role_id == 2 && $request->status_id == 4) {
                    TravelExpense::where(['id' => $request->expense_id])->update(['status' => 2]);
                }
                if ($role_id == 2 && $request->status_id == 3) {
                    TravelExpense::where(['id' => $request->expense_id])->update(['status' => 3]);
                }
                if ($role_id == 1 && $request->status_id == 4) {
                    TravelExpense::where(['id' => $request->expense_id])->update(['status' => 4]);
                }
                if ($role_id == 1 && $request->status_id == 3) {
                    TravelExpense::where(['id' => $request->expense_id])->update(['status' => 3]);
                }
                return ['status_code' => 200];
            } else {
                return ['status_code' => 401];
            }
        } else {
            return ['status_code' => 401];
        }
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Designation;
use App\Department;
use App\Role;
use App\TravelMember;
use App\TravelType;
use App\UserMembers;
use App\Locations;
use App\Airlines;
use App\Relation;
use Input;

use Illuminate\Support\Facades\Hash;
use Datatables;
use Auth;
use DB;

class CustomerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

    }

    public function setting(){
        $user=User::where('id',Auth::user()->id)->first();
        $data['designation']=Designation::get();
        $data['department']=Department::get();
        $data['role']=Role::get();
        $data['user']=$user;


        return view('customer/settings', $data);
    }

    public function update_general(Request $request){
        $firstname=  $request->input('first_name');
        $lastname=  $request->input('last_name');
        $email=  $request->input('email');
        $phone_no=  $request->input('phone_no');
        $department=  $request->input('department');
        $designation=  $request->input('designation');

        User::where('id', Auth::user()->id)->update([
            'first_name'=>$firstname,
            'last_name'=>$lastname,
            'name'=>$firstname.' '.$lastname,
            'email'=>$email,
            'phone_no'=>$phone_no,
            'department_id'=>$department,
            'designation_id'=>$designation
        ]);

        return redirect()->back()->with('message', 'General Information Updated Successfully');
    }

    public function update_passport(Request $request){
        $passport_no=$request->input('passport_no');
        $this->validate($request, [
            'passport_attachment' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('passport_attachment')) {
            $image = $request->file('passport_attachment');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/passports');
            $image->move($destinationPath, $name);
            User::where('id', Auth::user()->id)->update(['passport_no'=>$passport_no,'passport_attachment'=>$name]);
            return redirect()->back()->with('message','Passport Information Updated Successfully');
        }
        else{
            User::where('id', Auth::user()->id)->update(['passport_no'=>$passport_no]);
            return redirect()->back()->with('message','Passport Information Updated Successfully');
        }
    }

    public function update_password(Request $request){
        $old_password=$request->input("old_password");
        $new_password=$request->input("new_password");
        $confirm_password=$request->input("confirm_password");

        $user=User::where('id', Auth::user()->id)->first();

       // return redirect()->back()->with('message', $user['password']);

        if(Hash::check($old_password, $user['password'])){
            if($new_password==$confirm_password){
                User::where('id', Auth::user()->id)->update(['password'=>Hash::make($new_password)]);
                return redirect()->back()->with('message', "Your password has been successfully changed!");
            }
            else{
                return redirect()->back()->with('error_message', "Didn't match your passwords");
            }
        }
        else{
            return redirect()->back()->with('error_message', 'You Typed Wrong Old Password');
        }
    }

    public function members(){
        $data['relation']=Relation::get();
        return View('customer/members', $data);
    }

    public function create_member(Request $request){
        $firstname=  $request->input('first_name');
        $lastname=  $request->input('last_name');
        $passport_no=$request->input('passport_no');
        $relation =$request->input('relation');

        $this->validate($request, [
            'passport_attachment' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if(UserMembers::where('passport_no', $passport_no)->exists()){
            return redirect()->back()->with('error_message','Member already created with this Passport Number');
        }
        else{
            if ($request->hasFile('passport_attachment')) {
                $image = $request->file('passport_attachment');
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/passports');
                $image->move($destinationPath, $name);
                UserMembers::create([
                    'first_name'=>$firstname,
                    'last_name'=>$lastname,
                    'passport_no'=>$passport_no,
                    'passport_attachment'=>$name,
                    'user_id'=>Auth::user()->id,
                    'relation_id'=>$relation
                ]);
                return redirect()->back()->with('message','New Member created Successfully');
            }
        }

    }

    public function get_customer_member($customer_id){
        return UserMembers::where('user_id', $customer_id)->get();
    }




}

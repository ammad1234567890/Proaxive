<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Designation;
use App\Department;
use App\Role;
use Illuminate\Support\Facades\Hash;
use Datatables;
use Auth;
use DB;

class EmployeeController extends Controller
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
        $data['designation']=Designation::get();
        $data['department']=Department::get();
        $data['role']=Role::get();

        
        return view('hr/employee/create_employee', $data);
    }

    public function create(Request $request){
        $firstname= $request->input('firstname');
        $lastname=$request->input('lastname');
        $email=$request->input('email');
        $password=$request->input('password');
        $phone=$request->input('phone');
        $department=$request->input('department');
        $designation=$request->input('designation');
        $role=$request->input('role');



        $new_create=User::create([
            'name'=>$firstname.' '.$lastname,
            'first_name'=>$firstname,
            'last_name'=>$lastname,
            'email'=>$email,
            'password'=>Hash::make($password),
            'phone'=>$phone,
            'department_id'=>$department,
            'designation_id'=>$designation,
            'role_id'=>$role,
            'created_by'=>Auth::user()->id,
        ]);





        $emp_id='PRX'.date('Y').'-'.date('m').date('d').$new_create->id;

        User::where('id', $new_create->id)->update(['emp_id'=>$emp_id]);

        return redirect()->back()->with('message', 'Successfully Created');

    }

    public function view(){
         $users= DB::table('users')->join('department', 'users.department_id', '=', 'department.id')
            ->join('designation', 'designation.id', '=', 'users.designation_id')
             ->join('roles', 'roles.id', '=', 'users.role_id')
            ->select('users.id', 'users.first_name','users.last_name','users.email','designation.name as designation_name', 'department.name as department_name', 'roles.name as role_name')
            ->get();
        return Datatables::of($users)->addColumn('action', function ($user) {
            return '<button><a href="#edit-'.$user->id.'" style="color:#fff;"><i class="icon ion-document-text"></i></a></button> 
<button><a href="#edit-'.$user->id.'" style="color:#fff;"><i class="fa fa-pencil"></i></a></button> 
<button><a href="#edit-'.$user->id.'" style="color:#fff;"><i class="icon ion-trash-b"></i></a></button>';
        })
            ->editColumn('id', 'ID: {{$id}}')
            ->removeColumn('password')
            ->make(true);
    }
}

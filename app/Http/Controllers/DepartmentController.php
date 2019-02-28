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

class DepartmentController extends Controller
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

        return view('hr/department/department');
    }

    public function create(Request $request){
        $name= $request->input('name');
        if(Department::where('name', $name)->exists()){
            return redirect()->back()->with('message', 'This Department already exist');
        }
        else{
            Department::create(['name'=>$name, 'created_by'=>Auth::user()->id]);

            return redirect()->back()->with('message', 'Successfully Created');
        }



    }

    public function view(){
         $users= DB::table('department')
            ->select('department.id','department.name as department_name')
            ->get();
        return Datatables::of($users)->addColumn('action', function ($user) {
            return ' <button><a href="#edit-'.$user->id.'" style="color:#fff;"><i class="fa fa-pencil"></i></a></button>';
        })
            ->editColumn('id', 'ID: {{$id}}')
            ->removeColumn('password')
            ->make(true);
    }
}

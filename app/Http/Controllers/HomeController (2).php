<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
use Auth;
use Excel;
use Illuminate\Support\Facades\Input;
use App\Locations;
use App\TravelRequest;
use App\TravelExpense;
class HomeController extends Controller
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
        if(Auth::user()->role_id==1){

            return View('md/dashboard');
        }
        else if(Auth::user()->role_id==2){
            return View('hr/dashboard');
        }
        else if(Auth::user()->role_id==3){
            $travel_request=TravelRequest::where('user', Auth::user()->id)->get();
            $travel_expense=TravelExpense::where('user_id', Auth::user()->id)->get();
            $data['travel_request_count'] = $travel_request->count();
            $data['travel_expense_count'] = $travel_expense->count();
            return View('customer/dashboard', $data);
        }
		else if(Auth::user()->role_id==4){
            return View('hr_secretary/dashboard');
        }

        return view('home');
    }

    public function upload_locations(Request $request){
        if(Input::hasFile('locations')) {
            $path = Input::file('locations')->getRealPath();
            $data = Excel::load($path, function ($reader) {
            })->get();


            foreach ($data as $key => $value) {
                Locations::create(['name'=>$value->locations]);

            }

        }
    }
}

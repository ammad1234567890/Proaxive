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
use App\TravelRequest;
use App\RequestApprovals;
use Illuminate\Support\Facades\Hash;
use Datatables;
use Auth;
use DB;
use Mail;

class HRController extends Controller
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

}

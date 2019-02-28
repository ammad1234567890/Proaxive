<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use  HasApiTokens,Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'emp_id','first_name','last_name','email', 'password','phone_no','cnic','passport_no','passport_attachment','department_id','designation_id','role_id','created_by','updated_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function designation()
    {
        return $this->belongsTo('App\Designation', 'designation_id')->select(array('name'));
    }

    public function designation_name()
    {
        return $this->belongsTo('App\Designation', 'designation_id');
    }

    public function department()
    {
        return $this->belongsTo('App\Department', 'department_id');
    }

    public function role()
    {
        return $this->belongsTo('App\Role', 'role_id');
    }

    public function AllowToAccess($role_id){
        $User=$this::where('id',$this->id);
        $user_details=$User->first();
        
        if($user_details['role_id']==$role_id){
            return true;
        }
        //return $user_details;
        return false;
    }
}

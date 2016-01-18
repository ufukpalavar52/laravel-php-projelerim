<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Client;
class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','last_name','dateOfBirth','email','tel','authorization', 'password','profile_picture'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    static function doctorClients($id)
    {
        $clients = Client::where('doctor_id',$id)->whereRaw('CURDATE()<= app_date')->get();
        return $clients;
    }
    
    function doctorNameSurname($doctor_id) 
    {
         $doctor = User::where('id',$doctor_id)->first();
         return $doctor->name.' '.$doctor->last_name;
    }
}

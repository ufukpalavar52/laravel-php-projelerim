<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientDetail extends Model
{
    protected $table = "client_details";
    public $timestamps = false;
    protected $fillable = [
        'client_id','app_date','hour_id','doctor_id','made_operation','after_operation', 'status',
    ];
}

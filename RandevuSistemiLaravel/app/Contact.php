<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = "contacts";
    public $timestamps = false;
    protected $fillable = [
        'name','email','message'
    ];

}

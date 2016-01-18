<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    function index()
    {
        return view('pages.index');
    }
    
    function about()
    {
        $users = User::where('authorization','0')->get();
        return view('pages.about',['users'=>$users]);
    }
    
    function service()
    {
        return view('pages.service');
    }
    
    function appointment()
    {
        return view('pages.appointment');
    }
    
    function contact()
    {
        return view('pages.contact');
    }
    
    function login()
    {
        return view('pages.login');
    }
    
    function userPanel()
    {
         if(isset($_SESSION['authorization'])) {
             return view('users.userPanel');
         }
    }
}

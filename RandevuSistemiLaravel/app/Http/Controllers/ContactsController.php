<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Contact;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ContactsController extends Controller
{
    function createContact()
    {
        $contact = array("name"=>Input::get('ad'),"email"=>Input::get('email'),"message"=>Input::get('mesaj'));
        $create = Contact::create($contact);
        if ($create) {
            return '<p style="color: green">Mesajınız İletildi.</p>';
        } else {
            return '<p style="color: red">Mesajınız İletilmedi.</p>';
        }
    }
    
    function showMessages()
    {
        if (isset($_SESSION['authorization']) && $_SESSION['authorization'] == 1) {
            $contacts = Contact::all();
            return view('users.lookContacts',['contacts'=>$contacts]);
        } else {
            return Redirect::to('./sayfa-bulunamadi');
        }
        
    }
    
    function destroyContact()
    {
        $destroy = Contact::destroy(Input::get('id'));
        if ($destroy) {
           return '<p style="color: green">Mesaj silindi</p>'; 
        } else {
            return '<p style="color: red">Mesaj silinmedi</p>';
        }
    }
}

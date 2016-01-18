<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ClientDetail;
use App\Client;
use Illuminate\Support\Facades\Redirect;

class ClientDetailsController extends Controller
{
    function create()
    {
        $id = Input::get('id');
        if (Input::get('muayneDurumu') != 'ertelendi' ) {
            $hour = Input::get('saat');
            $app_date = Input::get('tarih');
        } else {
            $hour = Input::get('ysaat');
            $app_date = Input::get('yTarih');
        }
        
        $client = array(
            'name'=>Input::get('ad'), 'last_name'=>Input::get('soyad'),
            'email'=>Input::get('email'),'tel'=>Input::get('tel'),
            'app_date'=>$app_date,'hour_id'=>$hour,'doctor_id'=>Input::get('doktor'),
            'confirmation'=>1,'message'=>Input::get('mesaj')
        );
        
        $update = Client::where('id',Input::get('id'))->update($client);
        if ($update || Input::get('muayneDurumu') != null) {
            $client_detail = array(
                'client_id'=>Input::get('id'),'app_date'=>$app_date,
                'hour_id'=>$hour,'made_operation'=>Input::get('yapilanIslem'),'doctor_id'=>Input::get('doktor'),
                'after_operation'=>Input::get('yapilacakIslem'),'status'=>Input::get('muayneDurumu')
            );
            $create = ClientDetail::create($client_detail);
            
            if ($create) {
                $client = Client::find($id);
                $_SESSION['mesaj'] = '<div class="form-signin" style="background-color:pink;"><center><p style="color:green;">İşlem başarıyla gerçekleştirildi.</p></center></div>';
                return view('clients.appointment',['client'=>$client]);
            }
        } else {
            $client = Client::find($id);
            $_SESSION['mesaj'] = '<div class="form-signin" style="background-color:pink;"><center><p style="color:red;">İşelem gerçekleştirilmedi</p></center></div>';
            return view('clients.appointment',['client'=>$client]);
        }
    }
    
    function lookHistory()
    {
        if (isset($_SESSION['authorization'])) {
            $client_d = ClientDetail::where('client_id',Input::get('id'))->orderBy('id','DESC')->get();
            $client = Client::find(Input::get('id'));
            $name = $client->name.' '.$client->last_name;
            
            return view('clients.historyAppointment',['client_d'=>$client_d, 'name'=>$name]);
        } else {
            return Redirect::to('./sayfa-bulunamadi');
        }
    }
    
}

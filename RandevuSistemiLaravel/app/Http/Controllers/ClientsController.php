<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Client;
use Illuminate\Support\Facades\Redirect;

class ClientsController extends Controller
{
    function create()
    {
        $client = array(
            'name'=>Input::get('ad'),'last_name'=> Input::get('soyad'),
            'email'=>Input::get('email'),'tel'=>  Input::get('tel'),
            'app_date'=>Input::get('randevuTarihi'),'hour_id'=>Input::get('saat'),
            'message'=>  Input::get('mesaj')
        );
        $create = Client::create($client);
        if ($create) {
            $_SESSION['mesaj'] = '<div class="form-signin" style="background-color:pink;"><center><p style="color:green;">Bilgileriniz alındı en yakın zamanda size döneceğiz.</p></center></div>';
        } else {
            $_SESSION['mesaj'] = '<div class="form-signin" style="background-color:pink;"><center><p style="color:green;">Hata Oluştu.</p></center></div>';
        }
        
        return Redirect::to('e-randevu');
    }
    
    function show()
    {
        if(isset($_SESSION['authorization'])) {
            $client = Client::find(Input::get('id'));
            return view('clients.appointment',['client'=>$client]);
        } else {
            $_SESSION['mesaj'] = '<div class="form-signin" style="background-color:pink;"><center><p style="color:red;">Bu Sayfaya Girme Yetkiniz Yok .</p></center></div>';
            return Redirect::to('yetkili-girisi');
        }
    }
    
    function update()
    {
        
        $id = Input::get('id');
        $client = array(
            "name"=>Input::get('ad'),"last_name"=>Input::get('soyad'),
            "email"=>Input::get('email'),"tel"=>Input::get('tel'),
            "app_date"=>Input::get('tarih'), "hour_id"=>Input::get('saat'),
            "doctor_id"=>Input::get('doktor'),"message"=>Input::get('mesaj'),
            "confirmation"=>1
        );
        
        $update = Client::where('id',$id)->update($client);
        echo $update;
        
        if ($update) {
            $client = Client::find($id);
            $_SESSION['mesaj'] = '<div class="form-signin" style="background-color:pink;"><center><p style="color:green;">Randevu Onaylandı/Değisiklik yapıldı</p></center></div>';
            return view('clients.appointment',['client'=>$client]);
        } else {
            $client = Client::find($id);
            $_SESSION['mesaj'] = '<div class="form-signin" style="background-color:pink;"><center><p style="color:red;">Randevu Onaylanmadı/Değisiklik yapılmadı.</p></center></div>';
            return view('clients.appointment',['client'=>$client]);
        }
        return view('clients.appointment',['client'=>$client]);
    }
            
    function clienToweek()
    {
        if(isset($_SESSION['authorization'])) {
            if($_SESSION['authorization'] == 1 || $_SESSION['authorization'] == 0) {
                return view('users.lookAppointment');
            }     
        } else {
            //$_SESSION['mesaj'] = '<div class="form-signin" style="background-color:pink;"><center><p style="color:red;">Bu Sayfaya Girme Yetkiniz Yok .</p></center></div>';
            return Redirect::to('./sayfa-bulunamadi');
        }
    }
    
    function destroy() 
    {
        if (isset($_SESSION['authorization'])) {
            $delete = Client::destroy(Input::get('id'));
            if ($delete) {
                $_SESSION['delete'] = '<p style="color:green;">Randevu Başarıyla Silindi.</p>';
            } else {
                $_SESSION['delete'] = '<p style="color:red;">Randevu Silinemedi.</p>';
            }

            return Redirect::to('randevu-talepleri');
        }
    }
    
    function pastAppointment()
    {
        if(isset($_SESSION['authorization'])){
            if( $_SESSION['authorization'] == 1) {
                $clients = Client::pastAppointment();
            } else {
                $clients = Client::pastDoctorAppointment($_SESSION['user_id']);
            }
           return view('clients.pastAppointment',['clients'=>$clients]);
        } else {
            //$_SESSION['mesaj'] = '<div class="form-signin" style="background-color:pink;"><center><p style="color:red;">Bu Sayfaya Girme Yetkiniz Yok .</p></center></div>';
            return Redirect::to('./sayfa-bulunamadi');
        }
    }
    
    function allAppointment()
    {
        if(isset($_SESSION['authorization'])){
            if( $_SESSION['authorization'] == 1) {
                $clients = Client::orderBy('id','DESC')->get();
            } else {
                $clients = Client::where('doctor_id',$_SESSION['user_id'])->orderBy('id','DESC')->get();
            }
           return view('clients.allAppointment',['clients'=>$clients]);
        } else {
            //$_SESSION['mesaj'] = '<div class="form-signin" style="background-color:pink;"><center><p style="color:red;">Bu Sayfaya Girme Yetkiniz Yok .</p></center></div>';
            return Redirect::to('./sayfa-bulunamadi');
        }
    }

}

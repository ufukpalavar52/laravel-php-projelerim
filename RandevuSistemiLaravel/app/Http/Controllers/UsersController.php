<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Client;
Use Hash;
Use Auth;

class UsersController extends Controller
{
    function news()
    {
        if(isset($_SESSION['authorization']) && $_SESSION['authorization'] == 1) {
            return view('users.create');
        } else {
            $_SESSION['mesaj'] = '<div class="form-signin" style="background-color:pink;"><center><p style="color:red;">Bu Sayfaya Girme Yetkiniz Yok .</p></center></div>';
            return Redirect::to('./yetkili-girisi');
        }    
    }
    
    function emailCheck() 
    {
        $kontrol = User::where('email',Input::get('email'))->first();
        
        if ($kontrol == null) {
            return 0;
        } else {
            return 1;
        }
    }
    
    function create()
    {
        if(isset($_SESSION['authorization']) && $_SESSION['authorization'] == 1) {
            $sifre = Hash::make(Input::get('sifre'));
            $user = array(
                "name"=>Input::get('ad'),"last_name"=>Input::get('soyad'),
                "dateOfBirth"=>Input::get('dogumTarihi'),"email"=>Input::get('email'),
                "tel"=>Input::get('tel'), "password"=>$sifre, "authorization"=>Input::get('yetki')
            );
            $create = User::create($user);
            if ($create) {
                Auth::attempt($user,$remember = TRUE);
                $_SESSION['mesaj'] = '<div class="form-signin" style="background-color:pink;"><center><p style="color:green;">Kullanıcı Başarıyla Oluşturuldu.</p></center></div>';                
            } else {
                $_SESSION['mesaj'] = '<div class="form-signin" style="background-color:pink;"><center><p style="color:red;">Kullanıcı  Oluşturulamadı.</p></center></div>';
            }
        
            return Redirect::to('./kullanici-ekle');
        } else {
            return Redirect::to('./yetkili-girisi');
        }
    }
    
    function destroy()
    {
        $destroy = User::destroy(Input::get("id"));
        if($destroy) {
            $_SESSION['delete'] = '<p style="color:green;">Doktor Başarıyla Silindi.</p>';
        } else {
            $_SESSION['delete'] = '<p style="color:red;">Doktor Silinemedi.</p>';
        }
        return Redirect::to('./kullanici-ekle');
    }
    
    function showDoctors() 
    {
        if (isset($_SESSION['authorization']) && $_SESSION['authorization'] == 1) {
            return view('users.doctors');
        } else {
            $_SESSION['mesaj'] = '<div class="form-signin" style="background-color:pink;"><center><p style="color:red;">Bu Sayfaya Girme Yetkiniz Yok .</p></center></div>';
            return Redirect::to('./yetkili-girisi');
        }
    }
    
    function showDoctorClients()
    {
        if (isset($_SESSION['authorization']) && $_SESSION['authorization'] == 1) {
            $doctor = new User();
            $doctorName = $doctor->doctorNameSurname(Input::get('id'));
            $clients = User::doctorClients(Input::get('id'));
            return view('clients.doctorClients',['clients'=>$clients,'doctorName'=>$doctorName]);
        } else {
            $_SESSION['mesaj'] = '<div class="form-signin" style="background-color:pink;"><center><p style="color:red;">Bu Sayfaya Girme Yetkiniz Yok .</p></center></div>';
            return Redirect::to('./yetkili-girisi');
        }
    }        

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\User;
Use Hash;
Use Auth;
use File;

class LoginController extends Controller
{
    function login()
    {
        
        $userdata = array('email'=>Input::get('email'), 'password'=>Input::get('sifre'));
        
        if(Auth::attempt($userdata)) {
            $user = User::where('email',Input::get('email'))->first();
            $_SESSION["user_id"] = $user->id;
            $_SESSION['authorization'] = $user->authorization;
            if ($user->authorization == 0) { 
                return Redirect::to('./doktor');
            } else if ($user->authorization == 1) { 
                return Redirect::to('./admin');
            }
        } else {
            $_SESSION['mesaj'] = '<div class="form-signin" style="background-color:pink;"><center><p style="color:red;">Kullanıcı Adı veya şifre hatalı.</p></center></div>';
            return Redirect::to('./yetkili-girisi');
        }
    }
    
    function logout()
    {
        session_destroy();
        Auth::logout();
        return Redirect::to('./yetkili-girisi');
    }
    
    function showProfile() 
    {
        if (isset($_SESSION['user_id'])) {
            $picture = '<center><a href="#" style="text-decoration: none" class="btn btn-primary">Resim Ekle/Güncelle</a><center><br>';
            $readonly = "readonly";
            $user = User::find($_SESSION['user_id']);
            if($user->profile_picture != null) {
                $status = "Resmi Güncelle";
            } else {
                $status = "Resim Yükle";
            }
            $picture = '<center><a href="./resim-yukle" style="text-decoration: none" class="btn btn-primary">'.$status.'</a><center><br>';
            return view('users.showProfile',['user'=>$user,'readonly'=>$readonly,"picture"=>$picture]);
        } else {
            return Redirect::to('errors.404');
        }
    }
    
    function editProfile() 
    {
        if (isset($_SESSION['user_id'])) {
            $picture = null;
            $user = User::find($_SESSION['user_id']);
            return view('users.editProfile',['user'=>$user,'readonly'=>null,"picture"=>$picture]);
        } else {
            return Redirect::to('errors.404');
        }
    }
    
    function emailCheck()
    {
        $email = Input::get('email');
        $oldemail = Input::get('oldemail');
        $emailCheck = User::where('email',$email)->where('email','!=',$oldemail)->get();
        if ($emailCheck->isEmpty()) {
            return 0;
        } else {
            return 1;
        }
        
    }
            
    function updateProfile()
    {
        $user = User::find($_SESSION['user_id']);
        $update = $user->fill(['email' => Input::get('email'),'name'=>Input::get('ad'),
              'last_name'=>Input::get('soyad'),'dateOfBirth'=>Input::get('dogumTarihi'),
              'tel'=>Input::get('tel')  
        ])->save();
        
        if ($update) {
            $_SESSION['mesaj'] = '<div class="form-signin" style="background-color:pink;"><center><p style="color:green;">Bilgileriniz Güncellendi.</p></center></div>';
        } else {
            $_SESSION['mesaj'] = '<div class="form-signin" style="background-color:pink;"><center><p style="color:red;">Bilgileriniz Güncellenmedi.</p></center></div>';
        }
        return Redirect::to('./profil');
    }
    
    function changePassword()
    {
        if (isset($_SESSION['user_id'])) {
            return view('users.updatePassword');
        } else {
            return Redirect::to('errors.404');
        }
    }
    
    function updatePassword()
    {
        $user = User::find($_SESSION['user_id']);
        $password = Hash::make(Input::get('sifre1'));
        $update = $user->fill(['password'=>$password])->save();
        if ($update) {
            $_SESSION['mesaj'] = '<div class="form-signin" style="background-color:pink;"><center><p style="color:green;">Şifre Güncellendi.</p></center></div>';
            return Redirect::to('./sifre-degistir');
        }
    }
    
    function showFileForm()
    {
        if (isset($_SESSION['user_id'])) {
            $user = User::find($_SESSION['user_id']);
            return view('users.profilePictUpl',['path'=>$user->profile_picture]);
        } else {
            return Redirect::to('errors.404');
        }
    }
    
    function uploadFile()
    {
        if (isset($_SESSION['user_id'])) {
            $id = $_SESSION['user_id'];
            if (Input::file('resim')->isValid()) {
                $destinationPath = 'images';
                $extension = Input::file('resim')->getClientOriginalExtension();
                $dir = $destinationPath.'/'.'users';
                
                if(!file_exists($dir)) {
                    File::makeDirectory($dir);
                }
                
                $folder = $destinationPath.'/'.'users/'.$id.'/';
                if(!file_exists($folder)) {
                    File::makeDirectory($folder);
                }
                $fileName = $id.'.'.$extension;
                
                if(Input::file('resim')->move($folder, $fileName)) {
                    $path = $folder.$fileName;
                    $upload = User::where('id',$id)->update(array('profile_picture'=>$path));
                    if ($upload) {
                        $_SESSION['mesaj'] = '<div class="form-signin" style="background-color:pink;"><center><p style="color:green;">Resim Güncellendi.</p></center></div>';
                        
                    } else {
                        $_SESSION['mesaj'] = '<div class="form-signin" style="background-color:pink;"><center><p style="color:red;">Resim Güncellenmedi.</p></center></div>';
                    }
                    
                } else {
                    $_SESSION['mesaj'] = '<div class="form-signin" style="background-color:pink;"><center><p style="color:red;">İşleminiz Gerçekleşmedi.</p></center></div>';
                }
                return Redirect::to('./resim-yukle');
            }
            
        } else {
            return Redirect::to('errors.404');
        }
    }
}

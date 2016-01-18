<?php
use Illuminate\Support\Facades\Input;

session_start();
 
Route::get('/','PagesController@index');
Route::get('/hakkimizda','PagesController@about');
Route::get('/hizmetlerimiz','PagesController@service');
Route::get('/e-randevu','PagesController@appointment');
Route::get('/iletisim','PagesController@contact');
Route::get('/yetkili-girisi','PagesController@login');
Route::get('/kullanici-ekle','UsersController@news');
Route::post('/email-kontrol','UsersController@emailCheck');
Route::post('/kullanici-olustur','UsersController@create');
Route::post('/login','LoginController@login');
Route::get('/logout','LoginController@logout');
Route::post('/randevu-al','ClientsController@create');
Route::get('/randevu-talepleri','ClientsController@clienToweek');
Route::post('/musteri-sil','ClientsController@destroy');
Route::post('/randevu-bilgileri','ClientsController@show');
Route::post('/randevu-onaylama','ClientsController@update');
Route::post('/musteri-gecmis-bilgileri','ClientDetailsController@lookHistory');
Route::get('/doktorlar','UsersController@showDoctors');
Route::post('/doktor-randevulari','UsersController@showDoctorClients');
Route::get('/admin','PagesController@userPanel');
Route::get('/doktor','PagesController@userPanel');
Route::get('/gecmis-randevular','ClientsController@pastAppointment');
Route::post('/doktor-sil','UsersController@destroy');
Route::get('/tum-randevular','ClientsController@allAppointment');
Route::post('/muayene-onaylama','ClientDetailsController@create');
Route::get('/profil','LoginController@showProfile');
Route::get('/bilgileri-guncelle','LoginController@editProfile'); 
Route::post('/bilgileri-guncelle','LoginController@updateProfile');
Route::post('/email-profil-kontrol','LoginController@emailCheck');
Route::get('/sifre-degistir','LoginController@changePassword');
Route::post('/sifre-degistir','LoginController@updatePassword');
Route::get('/resim-yukle','LoginController@showFileForm');
Route::post('/resim-yukle','LoginController@uploadFile');
Route::post('/mesaj-ilet','ContactsController@createContact');
Route::post('/mesaj-sil','ContactsController@destroyContact');
Route::get('/ziyaretci-mesajlari','ContactsController@showMessages');

Route::get('/sayfa-bulunamadi',  function () {
     return view('errors.404');
});

Route::get('/{name}',  function () {
    return view('errors.404');
});
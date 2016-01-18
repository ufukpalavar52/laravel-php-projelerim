<?php
use App\User;

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Karadeniz @yield('title')</title>

  <link href="{{ URL::asset('dist/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
  
  <link href="http://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css"/>
  <link href="http://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css"/>
  <link href="{{ URL::asset('dist/loginCss/style.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ URL::asset('dist/formHelper/dist/css/bootstrap-formhelpers.css') }}"/>
  <link href="{{ URL::asset('dist/site/style.css') }}" rel="stylesheet" type="text/css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="{{ URL::asset('dist/js/bootstrap.min.js') }}"></script>
  <script src="{{ URL::asset('dist/formHelper/js/bootstrap-formhelpers-phone.js') }}"></script>
  @yield('bootstrap')
  


</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#myPage">Logo</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-left">
      <?php
      if (isset($_SESSION['authorization'])) {
          if ($_SESSION['authorization'] == 0) {
      ?>
          <li class="{{\App\Helper\Helper::set_active('doktor')}}"><a href="{{ URL::asset('doktor')}}">Doktor Paneli</a></li>
      <?php    
          } else {
      ?>
          <li class="{{\App\Helper\Helper::set_active('admin')}}"><a href="{{ URL::asset('admin') }}">Admin Paneli</a></li>
      <?php    
          }
      }
      
      ?>                  
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="{{\App\Helper\Helper::set_active('/')}}"><a href="{{ URL::asset('/') }}">Ana Sayfa</a></li>
        <li class="{{\App\Helper\Helper::set_active('hakkimizda')}}"><a href="{{ URL::asset('hakkimizda') }}">Hakkımızda</a></li>
        <li class="{{\App\Helper\Helper::set_active('hizmetlerimiz')}}"><a href="{{ URL::asset('hizmetlerimiz') }}">Hizmetlerimiz</a></li>
        <li class="{{\App\Helper\Helper::set_active('e-randevu')}}"><a href="{{ URL::asset('e-randevu') }}">Online Randevu</a></li>
        <li class="{{\App\Helper\Helper::set_active('iletisim')}}"><a href="{{ URL::asset('iletisim') }}">İletişim</a></li>
        
        <?php
        if (isset($_SESSION['user_id'])) {
            $user = User::find($_SESSION['user_id']);
        ?>
        <li class="dropdown ">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <?= $user->name ?>
            <span class="caret"></span></a>
             <ul class="dropdown-menu" style="background-color: grey; ">
                 <li><a href="{{ URL::asset('profil') }}">Profil Ayarları</a></li>
                 <li><a href="{{ URL::asset('logout') }}">Oturumu Kapat</a></li>
             </ul>
        </li>    
        <?php
        } else {
        ?>
        <li class="{{\App\Helper\Helper::set_active('yetkili-girisi')}}"><a href="./yetkili-girisi">Yetkili Girişi</a></li>
        <?php } ?>
        
    </div>
  </div>
</nav>
<div class="jumbotron text-center">
            <h1>Karadeniz Diş Hastanesi</h1> 


</div>
<?php

?>
@yield('menu')


        <br>
        <br><br>
        <footer class="container-fluid text-center">

            <p>Ufuk Palavar Tasarımıdır. &copy; Tüm Hakları Saklıdır.</p> 
        </footer>
@yield('footer')        

</body>
</html>
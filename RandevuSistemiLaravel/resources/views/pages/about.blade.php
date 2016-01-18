
@extends('master')
@section('title',' || Hakkımızda')

@section('menu')

<div class="container marketing">
<center>
        <h2>Doktorlarımız</h2><hr>
</center><br/>
<div class="row">
    <?php
      foreach ($users as $user) {
          if ($user->profile_picture == null) {
              $picture = "images/empty-profile/empty-profil.png";
          } else {
              $picture = $user->profile_picture;
          }
    ?>
        <div class="col-lg-4">
            <center><img class="img-thumbnail" src="<?= $picture ?>" alt="" style="width: 100px; height: 150px;"/></center>
            
            <center><h3><strong><?= $user->name.' '.$user->last_name ?></strong> </h3></center>
            <center><h3>Diş Hekimi</h3></center>
            <center><p><a class="btn btn-primary"  role="button">Daha Ayrıntılı Bilgi</a></p></center><hr>
        </div>
    <?php
          
      }
    ?>
</div>
</div>

@stop

@section('footer')
@stop
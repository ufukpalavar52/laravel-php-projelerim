
@extends('master')

@section('title',' || Profil')
@section('menu')
<?php
if (isset($_SESSION['mesaj'])) {
    echo $_SESSION['mesaj'];
    unset($_SESSION['mesaj']);
}
?>
<div  class="form-signin" method="post">
        <?php
        if ($user->profile_picture == null) {
            $p_picture = 'images/empty-profile/empty-profil.png';
        } else {
            $p_picture = $user->profile_picture;
        }        
        ?>
            <h3 class="form-signin-heading"><img src="{{ $p_picture }}" class="img-rounded" style="width: 120px; height: 120px;"/></h3>
            {!! $picture !!}
            
            <h3 class="form-signin-heading">Profil Bilgileri</h3>
            <hr class="colorgraph"><br>
            <table class="table" >
                
                <tr>
                    <td><label>Adı</label></td>
                    <td><input type="text" name="ad" class="form-control" value="{{ $user->name }}" <?= $readonly ?>/></td> 
                </tr>
                <tr>
                    <td><label>Soyadı</label></td>
                    <td><input type="text" class="form-control" name="soyad" value="{{ $user->last_name }}" <?= $readonly ?>/></td>
                </tr>
                <tr>
                    <td><label>Doğum Tarihi</label></td>
                    <td><input type="date" name="dogumTarihi"  class="form-control" value="{{ $user->dateOfBirth }}" <?= $readonly ?>/></td>
                </tr>
                <tr>
                    <td><label>Email</label></td>
                    <td><input type="email" name="email" class="form-control" value="{{ $user->email }}" <?= $readonly ?>/></td>
                    
                </tr>
                <tr>
                    <td><label>Telefonu</label></td>
                    <td><input type="tel" name="tel" class="form-control" value="{{ $user->tel }}" <?= $readonly ?>/></td>
                </tr>
                <tr>
                    <td><button  class="btn btn-primary"><a href="./bilgileri-guncelle" style="color: white;text-decoration: none;">Bilgilerimi Güncelle</a></button></td>
                    <td><button class="btn btn-link"><a href="./sifre-degistir" >Şifremi Değiştir</a></button></td>
                    
                </tr>
                <tr>
                    
                </tr>
            </table>
        </div>

@stop


@section('footer')

@stop
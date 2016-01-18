
<?php
if (isset($_SESSION['mesaj'])) {
    echo $_SESSION['mesaj'];
    unset($_SESSION['mesaj']);
}
?>
{!! Form::open(['url'=>'./login', 'class'=>'form-signin']) !!}       
    <h3 class="form-signin-heading">Giriş Yapınız</h3>
	<hr class="colorgraph"><br>
			  
	<input type="text" class="form-control" name="email" placeholder="Eposta Adresi" required="" autofocus="" />
	<input type="password" class="form-control" name="sifre" placeholder="Şifrenizi Giriniz. " required=""/>  
                
        <hr class="colorgraph"><br>
	<button class="btn btn-lg btn-primary btn-block"  name="Submit" value="Login" type="Submit">Giriş</button>
    <a class="btn btn-link pull-left">Şifremi Unuttum</a>                           
{!! Form::close() !!}
<script>
$(document).ready(function()
{
    $('#email').keyup(email_check);
}); 
function email_check()
{   
    var email = $('#email').val();
    var regex = /^[a-zA-Z0-9._-]+@([a-zA-Z0-9.-]+.)+([.])+[a-zA-Z0-9.-]{2,4}$/;
    if (email == '') {
        document.getElementById("txtHint").innerHTML = '';
    } else if(regex.test(email) != true) {
        if(email.length > 7) {
           document.getElementById("txtHint").innerHTML = '<p style="color: red;">Lütfen Geçerli bir eposta giriniz.</p>';
       } else {
           document.getElementById("txtHint").innerHTML = '';
       }    
    }  else {
    jQuery.ajax({
        type: "POST",
        url: "./email-kontrol",
        data: 'email='+ email,
        cache: false,
        success: function(response){
            if(response == 1){
                document.getElementById("txtHint").innerHTML = '<p style="color: red;">Bu epostayı başkası  kullanıyor.</p>'; 
                $("#kbutton").attr("disabled","disabled");
            }
            else
            {    
                document.getElementById("txtHint").innerHTML = '<p style="color: green;">Bu eposta adresi uygundur.</p>';  
            }
        }
    });
    }
    
}


</script>

<?php
$maxtarih = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d"), date("Y") - 21));
$mintarih = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d"), date("Y") - 70));
?>
<?php
if (isset($_SESSION['mesaj'])) {
	echo $_SESSION['mesaj'];
        unset($_SESSION['mesaj']);
} 
?>
{!! Form::open(['url' => './kullanici-olustur','class' => 'form-signin']) !!}       
            <h3 class="form-signin-heading">Kullanıcı Ekle</h3>
            <hr class="colorgraph"><br>
            <table class="table">
                <tr>
                    <td ><label>Adı</label></td>
                    <td><input name="ad" type="text" class="form-control" required autofocus/>
                    
                    </td>
                </tr>
                <tr>
                    <td><label>Soyadı</label></td>
                    <td><input name="soyad" type="text" class="form-control"  required autofocus/></td>
                </tr>
                <tr>
                    <td><label>Doğum Tarihi</label></td>
                    <td><input name="dogumTarihi" class="form-control" type="date" min="<?php echo $mintarih; ?>"  max="<?php echo $maxtarih; ?>" required autofocus/></td>
                <tr>
                <tr>
                    <td><label>Email</label></td>
                    <td><input name="email" type="email" id='email' class="form-control" id="email" required autofocus /> <div id='txtHint'></div> </td>
                    
                </tr>
                <tr>
                    <td><label>Telefonunuz</label></td>
                    <td><input type="tel" name="tel" class="form-control bfh-phone" data-format="+90 (ddd) (ddd)-(dddd)" required autofocus/></td>
                </tr>
                
                <tr>
                    <td><label>Yetki</label></td>
                    <td>Doktor <input type="radio" name="yetki" value="0"  checked/>
                    &nbsp;&nbsp;&nbsp;Admin <input type="radio" name="yetki" value="1" /></td>
                </tr> 
                <tr>
                    <td><label>Şifre</label></td>
                    <td><input name="sifre" id="sif1" type="password" class="form-control" required autofocus/></td>
                </tr>

                <tr>
                    <td><label>Şifre Tekrar</label></td>
                    <td><input name="tekrar"  id="sif2" type="password" class="form-control" required autofocus/></td>
                </tr>
                
                

                <tr>
                    <td></td>
                    <td><button class="btn btn-primary" type="submit"  id="kbutton" disabled="disabled">Kaydet</button></td>
                </tr>
                
            </table>
        {!! Form::close() !!}
        <div id="txt"></div>

<script>
    $('#sif2').keyup(sifreKontrol);
    function sifreKontrol()
    {
        var sif1 = $('#sif1').val();
        var sif2 = $('#sif2').val();
        
        if (sif1 != "" && sif2 != "" && sif1.length > 5 && sif2.length > 5)
        {
            if (sif1 != sif2) {
                document.getElementById("txt").innerHTML = '<div class="form-signin" style="background-color:pink;"><center><p style="color:red;">Şifre eşleşmiyor.</p></center></div>';
                $("#kbutton").attr("disabled","disabled");
            } else {
                document.getElementById("txt").innerHTML = '<div class="form-signin" style="background-color:#94F67C;"><center><p style="color:green;">Şifre Eşleşiyor.</p></center></div>';
            
               $("#kbutton").removeAttr("disabled");
              
            }
        }    
         
    }
</script>
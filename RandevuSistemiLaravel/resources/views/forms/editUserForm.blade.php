<script>
$(document).ready(function()
{
    $('#email').keyup(email_check);
}); 
function email_check()
{   
    var email = $('#email').val();
    var oldemail = $('#oldemail').val();
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
        url: "./email-profil-kontrol",
        data: 'email='+ email+'&'+'oldemail='+oldemail,
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
{!! Form::open(['url'=>'./bilgileri-guncelle', 'class'=>'form-signin']) !!}
        <?php
         $maxdate = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d"), date("Y") - 21));
         $mindate = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d"), date("Y") - 70));       
         ?>
            <h3 class="form-signin-heading"><img src="{{ $user->profile_picture }}" class="img-rounded" style="width: 120px; height: 120px;"/></h3>
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
                    <td><input type="date" min="{{ $mindate }}" max="{{ $maxdate }}" name="dogumTarihi"  class="form-control" value="{{ $user->dateOfBirth }}" <?= $readonly ?>/></td>
                </tr>
                <tr>
                    <td><label>Email</label></td>
                    <td><input type="email" name="email" id='email' class="form-control" value="{{ $user->email }}" <?= $readonly ?>/>
                         <input type="email" name="oldemail" id='oldemail' class="hidden" value="{{ $user->email }}" <?= $readonly ?>/>
                         <div id='txtHint'></div> 
                    </td>
                     
                    
                </tr>
                <tr>
                    <td><label>Telefonu</label></td>
                    <td><input type="tel" name="tel" class="form-control" value="{{ $user->tel }}" <?= $readonly ?>/></td>
                </tr>
                <tr>
                    <td><button type="reset"  class="btn btn-default">Varsayılan</button></td>
                    <td><button type="submit"  class="btn btn-primary">Bilgileri Güncelle</button></td>
    
                </tr>
                <tr>
                    
                </tr>
            </table>
        {!! Form::close() !!}
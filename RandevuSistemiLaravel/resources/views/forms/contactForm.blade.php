<script>
$(document).ready(function(){
    $('#contact1').click(function(){
        var email = $('#email').val();
        var ad = $('#ad').val();
        var mesaj = $('#mesaj').val();
        if(email != "" && ad != "" && mesaj != "" && mesaj.length >= 5) {
            var regex = /^[a-zA-Z0-9._-]+@([a-zA-Z0-9.-]+.)+([.])+[a-zA-Z0-9.-]{2,4}$/;
            if (regex.test(email) != true) {
                document.getElementById("emailtxt").innerHTML = '<p style="color: red">Lütfen eposta adresinizi giriniz!<p>';
            } else {
                jQuery.ajax({
                    type: "POST",
                    url: "./mesaj-ilet",
                    data: 'email='+ email+'&ad='+ad+'&mesaj='+mesaj,
                    cache: false,
                    success: function(response){
                        document.getElementById("txt").innerHTML = response;
                        $('#email').val('');
                        $('#ad').val('');
                        $('#mesaj').val('');
                        setTimeout("waitfor()",1000);
                    }
                  });
            }    
        }
        
    });
    
}); 
function waitfor()
{
    window.location.reload();
}
</script>

<br><br>
<div class="container">     
    <div id="contact" class="container-fluid bg-grey">
        <h3 class="text-center"><strong>İletişim</strong></h3><br><br>
        <div class="row">
            <div class="col-sm-5">
                <p>Saat 8:00 ile 18:00 arası telefon iletişimine açığız .</p>
                <p><span class="glyphicon glyphicon-map-marker"></span> İstanbul, Türkiye</p>
                <p><span class="glyphicon glyphicon-phone"></span> 0(212) 555 55 55 </p>
                <p><span class="glyphicon glyphicon-envelope"></span> karadenizklinigi@gmail.com</p>	   
            </div>
            <div class='col-sm-7'>
            
                <div class="row">
                    <div class="col-sm-6 form-group">
                        <input class="form-control" type="text" id='ad'  name="ad" placeholder="Adınız.." required>
                    </div>
                    <div class="col-sm-6 form-group">
                        <input class="form-control" id="email" name="email" placeholder="Eposta Adresiniz..." type="email" required/>
                        <div id='emailtxt'></div>
                    </div>
                </div>
                <textarea class="form-control"  id='mesaj' name="mesaj" placeholder="Mesajınız..." rows="5"></textarea><br>
                <div class="row">
                    <div class="col-sm-12 form-group">
                        <button class="btn btn-success pull-right" id='contact1' >Gönder</button>
                    </div>
                </div>

            </div>
            <div id='txt'></div>
        </div>        
    </div>
</div>
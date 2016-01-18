<?php
if (isset($_SESSION['mesaj'])) {
    echo $_SESSION['mesaj'];
    unset($_SESSION['mesaj']);
}
?>

		{{ Form::open(['url'=>'./sifre-degistir', 'class'=>'form-signin']) }}      
		    <h3 class="form-signin-heading">Şifre Değiştirme</h3>
			  <hr class="colorgraph"><br>
			  
			  <input type="password" id="sif1" class="form-control" name="sifre1" placeholder="Yeni şifreyi giriniz" required="" autofocus="" />
			  <input type="password" id="sif2" class="form-control" name="sifre2" placeholder="Tekrar yeni şifreyi giriniz " required=""/>  
                          
                          
                          
			 
                          <button class="btn btn-lg btn-primary btn-block" id="kbutton" disabled="disabled"  name="Submit" type="Submit">Şifreyi Değiştir</button>
                                                     
		{{ Form::close() }}
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
                document.getElementById("txt").innerHTML = '<div class="form-signin" style="background-color:#94F67C;"><center><p style="color:green;">Şifre Uygun.</p></center></div>';
                $("#kbutton").removeAttr("disabled");
            }
        }    
        
    }
</script>
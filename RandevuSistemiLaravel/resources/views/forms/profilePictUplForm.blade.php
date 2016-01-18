<script type="text/javascript">
$(document).ready(function(){
    $('#dosya').change(getFile);
    function getFile(){
        var filename = document.getElementById("dosya").value;
        var uzanti = (/[.]/.exec(filename)) ? /[^.]+$/.exec(filename):undefined;
        if(this.files[0].size < 1024*1024) {
            if(uzanti == "png" || uzanti == "jpg" || uzanti == "gif" || uzanti == "jpeg"){
                document.getElementById("txt").innerHTML = '';
                $("#kbutton").removeAttr("disabled","disabled");
            } else {
                document.getElementById("txt").innerHTML = '<p style="color: red;">Lütfen png, jpg, gif ve jpeg uzantılı dosyalar seçiniz.</p>';
                $("#kbutton").attr("disabled","disabled");
            }
        } else {
            document.getElementById("txt").innerHTML = '<p style="color: red;">Dosya boyutu 1 Mb den büyük!</p>';
            $("#kbutton").attr("disabled","disabled");
        }   
    }
});
</script> 
<?php
if (isset($_SESSION['mesaj'])) {
    echo $_SESSION['mesaj'];
    unset($_SESSION['mesaj']);
}
?>
<?php
        if ($path == null) {
            $p_picture = 'images/empty-profile/empty-profil.png';
        } else {
            $p_picture = $path;
        }        
?>
{!! Form::open(array('url'=>'./resim-yukle','method'=>'POST', 'files'=>true, 'class'=>'form-signin')) !!}

    <h3 class="form-signin-heading"><img src="{{ $p_picture }}" class="img-rounded" style="width: 120px; height: 120px;"/></h3>
    <h3 class="form-signin-heading"></h3>
    <hr class="colorgraph"><br>

    <input type="file"  class="form-control" name="resim" id="dosya" placeholder="Resim Yükleyin" required="" autofocus="" />
    <div id="txt"></div>
    <hr class="colorgraph"><br>
    <button class="btn btn-lg btn-primary btn-block" id="kbutton" disabled="disabled"  name="Submit" type="Submit">Resmi Yükle</button>

{!! Form::close() !!}
<div id="txt"></div>
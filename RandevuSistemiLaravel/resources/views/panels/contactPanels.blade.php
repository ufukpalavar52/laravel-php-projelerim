<script>
$(document).ready(function(){
    $('#delete').click(function(){
        var id = $('#contact_id').val();
        jQuery.ajax({
            type: "POST",
            url: "./mesaj-sil",
            data: 'id='+id,
            cache: false,
            success: function(response){
                document.getElementById("txt").innerHTML = response;
                setTimeout("waitfor()",500);
            }
         });
    });
}); 

function waitfor()
{
    window.location.reload();
}
</script>
<div class='container'>
<?php
if ($contacts->isEmpty()) {
?>
    <div class="panel-group">
        <div class="panel panel-primary">
            <div class="panel-heading" id="hclick"><center>Mesajlar</center></div>
            <div class="panel-body" id="pclick" >
                <p style="color: red">Hiç Mesajınız yok!</p>
            </div>
        </div>
     </div>
<?php    
} else {
    foreach ($contacts as $contact) { 
?>

    <div id="txt"></div>
    <div class="panel-group">
        <div class="panel panel-primary">
            <div class="panel-heading" id="hclick"><center>Mesajlar</center></div>
            <div class="panel-body" id="pclick" >
                <table  class="table table-hover table-responsive table-striped">
                <tr>
                    <th><center>Adı Soyadı</center></th>
                    <th><center>Eposta</center></th>
                    <th><center>Mesajı</center></th>
                    <th><center>İşlemler</center></th>
                </tr>
                <tr>
                    <td><center>{{ $contact->name }}</center></td>
                    <td><center>{{ $contact->email }}</center></td>
                    <td><center>{{ $contact->message }}</center></td>
                <td><center>
                    <input class='hidden' name="id" type="text" value="{{ $contact->id }}" id="contact_id" />
                    <button id="delete" class="btn btn-danger glyphicon glyphicon-trash"></button>
                </center></td>
                </tr>
                </table>
            </div>
        </div>
     </div>
    
    
<?php
     }
}
?>
</div>

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

    <div id="txt<?= $contact->id ?>"></div>
    <div class="panel-group">
        <div class="panel panel-primary">
            <div class="panel-heading" id="hclick"><center>Mesaj</center></div>
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
                    <input class='hidden' name="id" type="text" value="{{ $contact->id }}" id="contact_id<?= $contact->id ?>" />
                    <button id="delete<?= $contact->id ?>" class="btn btn-danger glyphicon glyphicon-trash"></button>
                </center></td>
                </tr>
                </table>
            </div>
        </div>
     </div>
<script>

 $('#delete<?= $contact->id ?>').click(function(){
     var id = $('#contact_id<?= $contact->id ?>').val();
     jQuery.ajax({
         type: "POST",
         url: "./mesaj-sil",
         data: 'id='+id,
         cache: false,
         success: function(response){
             document.getElementById("txt<?= $contact->id ?>").innerHTML = response;
             setTimeout("waitfor()",500);
         }
     });
 });


function waitfor()
{
    window.location.reload();
}
</script>  
    
<?php
     }
}
?>
</div>
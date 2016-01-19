<?php
use App\Client;
use App\User;
if(isset($_SESSION['authorization']) && $_SESSION['authorization'] == 1) { 
    if (!isset($doctorName)) {
        $doctorName = "";
    }
?>
<br><br>

<div class="container">
    <?php
    if (isset($_SESSION['delete'])) {
        echo $_SESSION['delete'];
        unset($_SESSION['delete']);
    }
    ?>
    <div class="panel-group">
        <div class="panel panel-primary">
            <div class="panel-heading" id="hclick"><center>{{ $doctorName }} Randevuları</center></div>
            <div class="panel-body" id="pclick" >
                <?php
                
               
                if($clients->isEmpty()) {
                 echo '<p style="color:red">Şuan yeni randevusu yok!</p>';   
                } else {
                ?>
                <table  class="table table-hover table-responsive table-striped">
                <tr>
                    <th><center>Müşteri Adı</center></th>
                    <th><center>Müşteri Soyadı</center></th>
                    <th><center>Eposta</center></th>
                    <th><center>Telefonu</center></th>
                    <th><center>Randevu Tarihi</center></th>
                    <th><center>Randevu Saati</center></th>
                    <th><center>Doktor<center/></th>
                    <th colspan="2"><center>İşlemler</center></th>
                </tr>
                <?php
                
                    foreach ($clients as $client) {
                    
                ?>
                <tr>
                    <td><center>{{ $client->name }}</center></td>
                    <td><center>{{ $client->last_name }}</center></td>
                    <td><center>{{ $client->email }}</center></td>
                    <td><center>{{ $client->tel }}</center></td>
                    <td><center>{{ $client->app_date }}</center></td>
                    <td><center>{{ Client::clientHours($client->hour_id)->hours }}</center></td>
                    <?php
                     
                    ?>
                    <td><center>{{ $doctorName }}</center></td>
                    <td><center>
                        {!! Form::open(['url'=>'randevu-bilgileri']) !!}
                        <input type="number" class="hidden" name="id" value="{{ $client->id }}"/>
                        <button type="submit" class="btn btn-warning glyphicon glyphicon-edit" title="Düzenle"></button>
                        {!! Form::close() !!}
                        </center>
                     </td>
                    <td><center>
                        <a href='#myDoctor<?= $client->id ?>' data-toggle="modal"   class="btn btn-danger glyphicon glyphicon-trash" title="Sil"></a>
                        @include('forms.deleteModalForm',['id'=>$client->id,'url'=>'./musteri-sil'])
                     </center>
                  </td>
                </tr>    
                <?php
                }
                
                ?>
                </table>
                <?php } ?>
                <a style='text-decoration: none;' class="pull-right btn btn-info" href='./doktorlar'>Geri Dön</a>
            </div>
        </div>
    </div>
</div>

<?php } ?>

<?php
use App\Client;
?>
<div class="container">
    
    <div class="panel-group">
        <div class="panel panel-primary">
            <div class="panel-heading" id="hclick"><center>Tüm Randevular</center></div>
            <div class="panel-body" id="pclick" >
                <?php
                
                //$clients = Client::all();
                if ($clients->isEmpty() ) 
                {
                    echo '<p style="color: red">Hiç randevu bulunmamaktadır</p>';
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
                     $c = new Client();
                     $doktorName = $c->clientDoctorNameSurname($client->doctor_id);
                     if ($_SESSION['authorization'] == 0) {
                         if (date('Y-m-d') != $client->app_date) {
                             $disabled = 'disabled="disabled"';
                         } else {
                             $disabled = '';
                         }
                     } else {
                         $disabled = '';
                     }         
                    ?>
                    <td><center>{{ $doktorName }}</center></td>
                    <td><center>
                        {!! Form::open(['url'=>'randevu-bilgileri']) !!}
                        <input type="number" class="hidden" name="id" value="{{ $client->id }}"/>
                        <button type="submit" <?= $disabled ?> class="btn btn-warning glyphicon glyphicon-edit" title="Düzenle"></button>
                        {!! Form::close() !!}
                        </center>
                     </td>
                    <td><center>
                        {!! Form::open(['url'=>'musteri-sil']) !!}
                        <input type='text' class='hidden' name="id" value='{{ $client->id }}'/>
                        <button type="submit" <?= $disabled ?> class="btn btn-danger glyphicon glyphicon-trash" title="Sil"></button>
                        {!! Form::close() !!}
                        </center>
                     </td>
                </tr>    
                <?php
                }
                
                ?>
                </table>
                <?php } 
                if ($_SESSION['authorization'] == 0) {
                    $p = "doktor";
                } else {
                    $p = "admin";
                }
                ?>
                <a style='text-decoration: none;' class="pull-right btn btn-info" href='./{{ $p }}'>Geri Dön</a>
            </div>
        </div>
    </div>
</div>
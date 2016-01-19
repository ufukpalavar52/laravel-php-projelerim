<?php
use App\Client;
if (isset($_SESSION['delete'])) {
    echo '<div class="container"><pre>'.$_SESSION['delete'].'</pre>'.'</div>';
    unset($_SESSION['delete']);
    echo '<br><br>';
}
?>
       
<?php


for($i = 0; $i < 14; $i++)
{
    $date = date("Y-m-d", mktime(0,0,0,date("m"),date("d")+$i,date("Y")));
    $date1 = mktime(0,0,0,date("m"),date("d")+$i,date("Y"));
    $days = array('Pazar',"Pazartesi","Salı","Çarşamba","Perşembe","Cuma","Cumartesi");
    $month = array('','Ocak','Şubat','Mart','Nisan','Mayıs','Haziran','Temmuz','Ağustos','Eylül','Ekim','Kasım','Aralık');
    $fullDate = date("d",$date1).'&nbsp;&nbsp;'.$month[date("n",$date1)].'&nbsp;&nbsp;'.date('Y',$date1).'&nbsp;&nbsp;'.$days[date("w",$date1)];
    $clientList =  Client::showTodayClients($date); 
    
?>

<div class="container">
    <div class="panel-group">        
        <div class="panel panel-primary">
            <div class="panel-heading"  id="b<?php echo $i;?>" style="background-color: #ff0906;" ><center><a  style="color: white;text-decoration: none;"><h3><?php echo $fullDate; ?></a></h3></center></div>
            
            <div class="panel-body" id="t<?php echo $i;?>" style="display: none;">
                <table class="table">
                    <?php
                    if ($clientList->isEmpty()) {
                         echo '<p style="color: red;">'.$fullDate.' günü için hiç müşteri yok</p></div>';
                    } else {
                    ?>
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
                    foreach ($clientList as $list) {
                    ?>
                    <tr>
                        <td><center>{{$list->name}}</center></td>
                        <td><center>{{$list->last_name}}</center></td>
                        <td><center>{{$list->email}}</center></td>
                        <td><center>{{$list->tel}}</center></td>
                        <td><center>{{$list->app_date}}</center></td>
                        <td><center>{{ Client::clientHours($list->hour_id)->hours }}</center></td>
                        <td><center>
                        <?php
                        //$doctor = Client::clientDoctors($list->doctor_id);
                        if ($list->doctor_id == null) {
                            echo "Atanmadı";
                        } else {
                            $doctor = Client::clientDoctors($list->doctor_id);
                            echo $doctor->name.' '.$doctor->last_name;
                        }
                        ?>
                           </center> 
                        </td>
                        <td><center>
                            {!! Form::open(['url'=>'randevu-bilgileri']) !!}
                            <input type="number" class="hidden" name="id" value="{{ $list->id }}"/>
                            <input type="number" class="hidden" name="doctor_id" value="{{ $list->doctor_id }}"/>
                            <input type="number" class="hidden" name="hour_id" value="{{ $list->hour_id }}"/>
                            <button type="submit" title="Güncelle/Doktor Ata" class="btn btn-primary glyphicon glyphicon-transfer"></button>
                            {!! Form::close() !!}
                            </center>
                        </td>
                        <?php  if ($list->doctor_id != null) { ?>
                        <td><center>
                            {!! Form::open(['url'=>'musteri-gecmis-bilgileri']) !!}
                            <input type="number" class="hidden" name="id" value="{{ $list->id }}"/>
                            <input type="number" class="hidden" name="ad" value="{{ $list->name.' '.$list->last_name }}"/>
                            <button type="submit"  title="Geçmiş Bilgiler"  class="btn btn-success glyphicon glyphicon-calendar"></button>
                            {!! Form::close() !!}
                            </center>
                        </td>
                        <?php  } ?>
                        <td><center>
                        <a href='#myDoctor<?= $list->id ?>' data-toggle="modal"  class="btn btn-danger glyphicon glyphicon-trash" title="Sil"></a>
                        @include('forms.deleteModalForm',['id'=>$list->id,'url'=>'./musteri-sil'])
                        </center>
                        </td>
                    </tr>
                    <?php } 
                    }
                    ?>
                </table>
                <script>
                    $("#b<?php echo $i; ?>").click(function(){    
                        $("#t<?php echo $i;?>").slideToggle(1000);    
                    });    
    
               </script>
            </div>
        </div>
    </div>
</div>    

<?php
               

}
?>

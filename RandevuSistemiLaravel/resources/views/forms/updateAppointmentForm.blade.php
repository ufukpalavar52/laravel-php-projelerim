<?php
use App\Client;
?>

<?php
$maxTarih = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") + 15, date("Y")));
    
$tarih = date('Y-m-d');
if ($_SESSION['authorization'] == 0) {
     $authorization = 0;
     $url =  "./muayene-onaylama";  
} else if ($_SESSION['authorization'] == 1) {
    $authorization = 1;
    $url =  "./randevu-onaylama";
}   
    
?>    
<?php
if (isset($_SESSION['mesaj'])) {
    echo $_SESSION['mesaj'];
    unset($_SESSION['mesaj']);
}

?>

        {!! Form::open(['url'=>$url, 'class'=>'form-signin']) !!}
        
            <h3 class="form-signin-heading">Online Randevu</h3>
            <table class="table">
                <tr>
                    <td><label>Adı</label></td>
                    <td><input type="text" name="ad" value="{{ $client->name }}" class="form-control" required autofocus/>
                        <input type="text" name="id" value="{{ $client->id }}" class="hidden" required autofocus/> 
                    </td>
                </tr>

                <tr>
                    <td><label >Soyadız</label></td>
                    <td><input type="text" name="soyad" value="{{ $client->last_name }}" class="form-control " required autofocus/></td>
                </tr>
                <br>
                <tr>
                    <td><label>Eposta</label></td>
                    <td><input type="email" name="email" value="{{ $client->email }}" class="form-control" required/></td>
                </tr>

                <tr>
                    <td><label>Telefonu</label></td>
                    <td><input type="tel" name="tel" value="{{ $client->tel }}" class="form-control bfh-phone" data-format="+90 (ddd) (ddd)-(dddd)" required autofocus/></td>
                </tr>

                <tr>
                    <td><label>Randevu Tarihi</label></td>
                    <td><input type="date" class="form-control" value="{{ $client->app_date }}" name="tarih" min="<?php echo $tarih; ?>" max="<?php echo $maxTarih; ?>" required autofocus/></td>
                </tr>
                <tr>
                    <td><label>Saat</label></td>
                    <?php  $hours = Client::hourList(); ?>
                    <td>
                        <select name="saat" class="form-control">
                            <?php
                            $secHour = Client::clientHours($client->hour_id);
                            echo '<option value="'.$secHour->id.'">'.$secHour->hours.'</option>';
                            
                            foreach ($hours as $hour) {
                                echo '<option value="'.$hour->id.'">'.$hour->hours.'</option>';
                            }
                            ?>
                            

                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label>Doktor</label></td>
                    <?php  $doctors = Client::doktorList(); ?>
                    <td>
                        <select name="doktor" class="form-control">
                            <?php
                            if ($client->doctor_id != null) {
                                $secDoctor = Client::clientDoctors($client->doctor_id);
                                echo '<option value="'.$secDoctor->id.'">'.$secDoctor->name.' '.$secDoctor->last_name.'</option>';
                            }
                            if ($authorization == 1) {
                                foreach ($doctors as $doctor) {
                                    echo '<option value="'.$doctor->id.'">'.$doctor->name.' '.$doctor->last_name.'</option>';
                                }
                            }
                            ?>
                            

                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label>Mesajı</label></td>
                    <td><textarea name="mesaj"  class="form-control">{{ $client->message }}</textarea></td>
                </tr>
                <?php
                if ($authorization == 0) {
                ?>
                <tr>
                <td>Yapılan İşlem</td>
                <td>
                    <textarea name="yapilanIslem" class="form-control"></textarea>
                </td>
            </tr>
            <tr>
                <td>Muayne Durumu</td>
                <td>
                    <select name="muayneDurumu" id="m" class="form-control">
                        <option value="tamamlandi">Tamamlandı</option>
                        <option value="ertelendi">Ertelendi</option>
                    </select>
                </td>
            </tr>
            <tr id="txt1">
                
            </tr>
            <tr>
                
            </tr>
            <tr id="txt2">
                
            </tr>
            <tr id="txt3">
                
            </tr>
                <?php
                }
                
                ?>
               
                <tr>
                    <td><input type="Reset" value="Temizle" class="btn btn-default"/></td>
                <td>
                 
                <input type="submit" value="Randevuyu Onayla/Güncelle" class="btn btn-primary"/>
                </td>
                </tr>
                <tr>
                   
                    <td colspan="2">
                <center> 
                    <a href="./tum-randevular" style="text-decoration: none;" class="btn  btn-info">Geri Dön</a>
                </center>
                </td>
                
                </tr>
            </table>
        {!! Form::close() !!}
        <script>
            $('#m').change(select_control);
            function select_control()
            {
                var select = $('#m').val();
                
                if (select == "ertelendi") {
                    
                    document.getElementById("txt2").innerHTML = '<td>Saati</td><td><select name="ysaat" class="form-control"><?php foreach ($hours as $hour) { echo '<option value="'.$hour->id.'">'.$hour->hours.'</option>';} ?></select></td>';
                    document.getElementById("txt1").innerHTML = '<td>Yeni Randevu Tarihi</td><td><input type="date" min="<?=$tarih?>" max="<?=$maxTarih?>" name="yTarih" class="form-control" required autofocus/></td>';
                    document.getElementById("txt3").innerHTML = '<td>Yapılacak İşlem</td><td><textarea  name="yapilacakIslem" class="form-control"></textarea></td>';
                } else {
                    document.getElementById("txt1").innerHTML = "";
                    document.getElementById("txt3").innerHTML = "";
                    document.getElementById("txt2").innerHTML = "";
                }    
            }
        </script> 
  

 
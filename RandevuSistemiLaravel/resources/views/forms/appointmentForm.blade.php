<?php
use App\Hour;
?>

<?php
$maxTarih = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") + 15, date("Y")));
    
$tarih = date('Y-m-d');
    
    
?>    
<?php
if (isset($_SESSION['mesaj'])) {
    echo $_SESSION['mesaj'];
    unset($_SESSION['mesaj']);
} 
?>

        {!! Form::open(['url'=>'./randevu-al', 'class'=>'form-signin']) !!}
        
            <h3 class="form-signin-heading">Online Randevu</h3>
            <table class="table">
                <tr>
                    <td><label>Adınız</label></td>
                    <td><input type="text" name="ad" class="form-control" required autofocus/></td>
                </tr>

                <tr>
                    <td><label >Soyadınız</label></td>
                    <td><input type="text" name="soyad" class="form-control " required autofocus/></td>
                </tr>
                <br>
                <tr>
                    <td><label>Eposta</label></td>
                    <td><input type="email" name="email" class="form-control" required/></td>
                </tr>

                <tr>
                    <td><label>Telefonunuz</label></td>
                    <td><input type="tel" name="tel" class="form-control bfh-phone" data-format="+90 (ddd) (ddd)-(dddd)" required autofocus/></td>
                </tr>

                <tr>
                    <td><label>Randevu Tarihi</label></td>
                    <td><input type="date" class="form-control" name="randevuTarihi" min="<?php echo $tarih; ?>" max="<?php echo $maxTarih; ?>" required autofocus/></td>
                </tr>
                <tr>
                    <td><label>Saat</label></td>
                    <?php  $hours = Hour::all(); ?>
                    <td>
                        <select name="saat" class="form-control">
                            <?php
                            foreach ($hours as $hour) {
                                echo '<option value="'.$hour->id.'">'.$hour->hours.'</option>';
                            }
                            ?>
                            

                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label>Mesajınız</label></td>
                    <td><textarea name="mesaj"  class="form-control"></textarea></td>
                </tr>
               
                <tr>
                    <td><input type="Reset" value="Temizle" class="btn btn-default"/> </td>
                    <td>
                
                <input type="submit" value="Randevu Al" class="btn btn-primary"/>
                </td>
                </tr>
            </table>
        {!! Form::close() !!}
  

 
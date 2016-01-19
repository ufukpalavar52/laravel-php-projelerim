<?php
use App\User;
if(isset($_SESSION['authorization']) && $_SESSION['authorization'] == 1) { 

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
            <div class="panel-heading" id="hclick"><center>Doktor Listesi</center></div>
            <div class="panel-body" id="pclick" >
                <table  class="table table-hover table-responsive table-striped">
                <tr>
                    <th><center>Adı</center></th>
                    <th><center>Soyadı</center></th>
                    <th><center>Doğum Tarihi</center></th>
                    <th><center>Eposta</center></th>
                    <th><center>Telefonu</center></th>
                    <th colspan="2"><center>İşlemler</center></th>
                </tr>
                <?php
                $doctors = User::where('authorization','0')->get();
                foreach ($doctors as $doktor) {
                ?>
                <tr>
                    <td><center><?= $doktor->name ?></center></td>
                    <td><center><?= $doktor->last_name ?></center></td>
                    <td><center><?= $doktor->dateOfBirth ?></center></td>
                    <td><center><?= $doktor->email ?></center></td>
                    <td><center><?= $doktor->tel ?></center></td>
                    <td><center>
                        {!! Form::open(['url'=>'doktor-randevulari']) !!}
                        <input type='text' class='hidden' name='id' value='<?= $doktor->id ?>'/>
                        <input type='text' class='hidden' name='doctors' value='1'/>
                        <button type="submit" class="btn btn-primary glyphicon glyphicon-list-alt" title="Randevularını Gör"></button>
                        {!! Form::close() !!}
                        </center>
                     </td>
                    <td><center>
                        <a href='#myDoctor<?= $doktor->id ?>' data-toggle="modal"   class="btn btn-danger glyphicon glyphicon-trash" title="Sil"></a>
                        @include('forms.deleteModalForm',['id'=>$doktor->id,'url'=>'./doktor-sil'])
                        </center>
                     </td>
                </tr>    
                <?php
                }
                ?>
                </table>
            </div>
        </div>
    </div>
</div>

<?php } ?>

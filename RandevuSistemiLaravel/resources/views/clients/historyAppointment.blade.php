<?php
use App\Client;
?>
@extends('master')
@section('title',' ||  Bilgileri')

@section('menu')

<div class="container">
    
    <div class="panel-group">
        <div class="panel panel-primary">
            <div class="panel-heading" id="hclick" style='color: white;'><center>{{ $name }} Geçmiş Muayeneleri</center></div>
            <div class="panel-body" id="pclick" >
                <?php
                
                //$clients = Client::all();
                if ($client_d->isEmpty() ) 
                {
                    echo '<p style="color: red">Hiç bir muayenesi bulunmamaktadır.</p>';
                } else {
                    
                ?>
                <table  class="table table-hover table-responsive table-striped">
                <tr>
                    <th><center>Randevu Tarih</center></th>
                    <th><center>Doktor</center></th>
                    <th><center>Randevu Saati</center></th>
                    <th><center>Yapılan İşlem<center/></th>
                    <th><center>Yapılacak İşlem</center></th>
                    <th><center>Muayene Durumu</center></th>
                </tr>
                <?php
                    foreach ($client_d as $cd) {
                        $c = new Client();
                        $doktorName = $c->clientDoctorNameSurname($cd->doctor_id);
                ?>
                <tr>
                <td><center>{{ $cd->app_date }}</center></td>
                <td><center>{{ $doktorName }}</center></td>
                <td><center>{{ Client::clientHours($cd->hour_id)->hours }}</center></td>
                <td><center>{{ $cd->made_operation }}</center></td>
                <td><center>{{ $cd->after_operation }}</center></td>
                <td><center>{{ $cd->status }}</center></td>
                </tr>
                <?php
                   }
                ?>
                </table>
                <?php
                }
                ?>
                
            </div>
        </div>
    </div>
</div>    

@stop


@section('footer')
@stop
<?php
use Illuminate\Support\Facades\Redirect;
?>
@extends('master')
@section('title',' || Randevu Talepleri')

@section('menu')
<?php if(isset($_SESSION['authorization'])) {
    if($_SESSION['authorization'] == 0) {
?>
@include('panels.futureDoctorClientsPanel')
<?php
    } else {
?>
@include('panels.futureClientsPanel')     
<?php
    }
} else {
    Redirect::to('./sayfa-bulunamadi');    
} 
?>

@stop

@section('footer')
@stop
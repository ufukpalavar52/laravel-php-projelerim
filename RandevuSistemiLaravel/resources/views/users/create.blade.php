@extends('master')
@section('title',' || Kullanıcı Ekle')
@section('bootstrap')


@stop

@section('menu')
@include('forms.UserCreateForm')

@include('panels.doctorList')

@stop

@section('footer')
@stop
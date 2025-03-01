@extends('layouts.app')

<?php
if (Session::has('locale')) {
    App::setLocale(Session::get('locale'));
}
?>

@section('title', 'MyProfile')

@section('content')
    <h1>ESTA ES LA VISTA DEL PERFIL DE USUARIO</h1>
@endsection

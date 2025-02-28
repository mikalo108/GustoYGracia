@extends('layouts.app')

<?php
// En tu vista Blade, antes de cargar el contenido
App::setLocale(session('locale'));
?>

@push('css')
    <!-- estilos adicionales -->
    <style>

    </style>
@endpush

@section('title', 'Home')

@section('content')
    <h1>{{ __('messages.Welcome') }}</h1> <!-- Corregido -->
    <p>{{ __('messages.recipes') }}</p> <!-- También puedes traducir este texto -->
    <!-- Puedes agregar más contenido aquí -->

    <!-- Verifica el idioma actual -->
    <p>Idioma actual: {{ App::getLocale() }}</p>
@endsection

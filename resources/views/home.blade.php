@extends('layouts.app')

<?php
if (Session::has('locale')) {
    App::setLocale(Session::get('locale'));
}
?>

@push('css')
    <!-- estilos adicionales -->
    <style>

    </style>
@endpush

@section('title', 'Home')

@section('content')
    <h1>{{ __('messages.Welcome') }}</h1>
    <p>Aquí encontrarás las mejores recetas para todos los gustos.</p>
    <!-- Puedes agregar más contenido aquí -->

    <p>Idioma actual: {{ app()->getLocale() }}</p>

    <form action="{{ route('e') }}" method="GET">
        @csrf
        <button type="submit">No borrar este botón</button>
    </form>

@endsection
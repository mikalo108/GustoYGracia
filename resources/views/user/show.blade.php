@extends('layouts.app')

@section('title', 'Información de ' . $user->name)

@section('content')
    <div class="user-profile">
        <h1>Información de {{ $user->name }}</h1>

        <!-- Información del usuario -->
        <div class="user-info">
            <h2>Datos del usuario</h2>
            <div class="info-card">
                <p><strong>Nombre:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
            </div>
        </div>

        <!-- Información del contacto -->
        @if ($user->contact)
            <div class="contact-info">
                <h2>Datos de contacto</h2>
                <div class="info-card">
                    <p><strong>Nombre:</strong> {{ $user->contact->name }}</p>
                    <p><strong>Apellido:</strong> {{ $user->contact->surname }}</p>
                    <p><strong>Teléfono:</strong> {{ $user->contact->phone }}</p>
                    <p><strong>Ciudad:</strong> {{ $user->contact->city }}</p>
                    <p><strong>País:</strong> {{ $user->contact->country }}</p>
                    <p><strong>Biografía:</strong> {{ $user->contact->bio }}</p>
                </div>
            </div>
        @else
            <div class="info-card">
                <p>No hay información de contacto asociada a este usuario.</p>
            </div>
        @endif
        <!-- Botón para volver -->
        <div>
            <a href="{{ url()->previous() }}" class="btn-back">Volver</a>
        </div>
    </div>
@endsection
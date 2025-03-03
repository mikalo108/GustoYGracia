@extends('layouts.app')

@php
    if (Session::has('locale')) {
        App::setLocale(Session::get('locale'));
    } else {
        App::setLocale(config('app.locale'));
    }
@endphp

@section('title', __('messages.InfoFrom') . ' ' . $user->name . ' | Gusto&Gracia')

@section('content')
    <div class="user-profile">
        <h1>{{__('messages.InfoFrom')}} {{ $user->name }}</h1>

        <!-- Información del usuario -->
        <div class="user-info">
            <h2>{{__('messages.UserData')}}</h2>
            <div class="info-card">
                <p><strong>{{ __('messages.User') }}:</strong> {{ $user->name }}</p>
                <p><strong>{{ __('messages.Email') }}:</strong> {{ $user->email }}</p>
            </div>
        </div>

        <!-- Información del contacto -->
        @if ($user->contact)
            <div class="contact-info">
                <h2>{{__('messages.ContactData')}}</h2>
                <div class="info-card">
                    <p><strong>{{ __('messages.Name') }}:</strong> {{ $user->contact->name }}</p>
                    <p><strong>{{ __('messages.Surnames') }}:</strong> {{ $user->contact->surname }}</p>
                    <p><strong>{{ __('messages.Phone') }}:</strong> {{ $user->contact->phone }}</p>
                    <p><strong>{{ __('messages.City') }}:</strong> {{ $user->contact->city }}</p>
                    <p><strong>{{ __('messages.Country') }}:</strong> {{ $user->contact->country }}</p>
                    <p><strong>{{ __('messages.Bio') }}:</strong> {{ $user->contact->bio }}</p>
                </div>
            </div>
        @else
            <div class="info-card">
                <p>{{__('messages.NoContactInfo')}}</p>
            </div>
        @endif
        <!-- Botón para volver -->
        <div>
            <a href="{{ url()->previous() }}" class="btn-back">{{ __('messages.Back') }}</a>
        </div>
    </div>
@endsection
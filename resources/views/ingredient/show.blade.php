@extends('layouts.app')

@php
    if (Session::has('locale')) {
        App::setLocale(Session::get('locale'));
    } else {
        App::setLocale(config('app.locale'));
    }
@endphp

@section('title', __('messages.InfoFrom') . ' ' . $ingredient->name . ' | Gusto&Gracia')

@section('content')
    <div class="user-profile">
        <h1>{{__('messages.InfoFrom')}} {{ $ingredient->name }}</h1>

        <!-- Información del usuario -->
        <div class="user-info">
            <div class="info-card">
            <p><strong>{{ __('columns.ingredient_1') }}:</strong> {{ $ingredient->name }}</p>
            <p><strong>{{ __('columns.ingredient_2') }}:</strong> {{ $ingredient->description }}</p>
            <p><strong>{{ __('columns.created_at') }}:</strong> {{ $ingredient->created_at }}</p>
            <p><strong>{{ __('columns.updated_at') }}:</strong> {{ $ingredient->updated_at }}</p>
            </div>
        </div>

        <!-- Botón para volver -->
        <div>
            <a href="{{ url()->previous() }}" class="btn-back">{{ __('messages.Back') }}</a>
        </div>
    </div>
@endsection
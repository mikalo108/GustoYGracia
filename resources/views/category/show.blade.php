@extends('layouts.app')

@php
    if (Session::has('locale')) {
        App::setLocale(Session::get('locale'));
    } else {
        App::setLocale(config('app.locale'));
    }
@endphp

@section('title', __('messages.InfoFrom') . ' ' . $category->name . ' | Gusto&Gracia')

@section('content')
    <div class="user-profile">
        <h1>{{__('messages.InfoFrom')}} {{ $category->name }}</h1>

        <!-- Información del usuario -->
        <div class="user-info">
            <div class="info-card">
            <p><strong>{{ __('columns.category_1') }}:</strong> {{ $category->name }}</p>
            <p><strong>{{ __('columns.category_2') }}:</strong> {{ $category->description }}</p>
            <p><strong>{{ __('columns.created_at') }}:</strong> {{ $category->created_at }}</p>
            <p><strong>{{ __('columns.updated_at') }}:</strong> {{ $category->updated_at }}</p>
            </div>
        </div>

        <!-- Botón para volver -->
        <div>
            <a href="{{ url()->previous() }}" class="btn-back">{{ __('messages.Back') }}</a>
        </div>
    </div>
@endsection
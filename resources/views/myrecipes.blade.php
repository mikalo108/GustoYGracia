@extends('layouts.app')

@php
    if (Session::has('locale')) {
        App::setLocale(Session::get('locale'));
    } else {
        App::setLocale(config('app.locale'));
    }
@endphp

@push('css')
    <link rel="stylesheet" href="{{ asset('css/myprofile.css') }}">
@endpush

@section('title', __('messages.MyRecipes') . ' | Gusto&Gracia')

@section('content')
    <div class="profile-page">
        <h1>{{ __('messages.MyProfile') }}</h1>

        
    </div>

    @push('scripts')
        
    @endpush
@endsection

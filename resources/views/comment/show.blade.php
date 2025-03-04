@extends('layouts.app')

@php
    if (Session::has('locale')) {
        App::setLocale(Session::get('locale'));
    } else {
        App::setLocale(config('app.locale'));
    }
@endphp

@section('title', __('messages.InfoFrom') . ' ' . $comment->name . ' | Gusto&Gracia')

@section('content')
    <div class="user-profile">
        <h1>{{__('messages.InfoFrom')}} {{ __('admin.TitleCommentTable') }} #{{ $comment->id }}</h1>

        <!-- Información del usuario -->
        <div class="user-info">
            <div class="info-card">
            <p><strong>{{ __('columns.comment_1') }}:</strong> {{ $comment->user->name }}</p>
            <p><strong>{{ __('columns.comment_2') }}:</strong> {{ $comment->recipe->name }}</p>
            <p><strong>{{ __('columns.comment_3') }}:</strong> {{ $comment->content }}</p>
            <p><strong>{{ __('columns.created_at') }}:</strong> {{ $comment->created_at }}</p>
            <p><strong>{{ __('columns.updated_at') }}:</strong> {{ $comment->updated_at }}</p>
            </div>
        </div>

        <!-- Botón para volver -->
        <div>
            <a href="{{ url()->previous() }}" class="btn-back">{{ __('messages.Back') }}</a>
        </div>
    </div>
@endsection
@extends('layouts.app')

@php
    if (Session::has('locale')) {
        App::setLocale(Session::get('locale'));
    } else {
        App::setLocale(config('app.locale'));
    }
    if(isset($user->name)){
        $title=__('admin.Edit').' '.$user->name;
    } else{
        $title=__('admin.Create').' '.__('admin.TitleUserTable');
    }
@endphp

@push('css')
    <!-- estilos adicionales -->
    <style>
        form{
            flex-direction: column;
        }
        form>input[type="submit"]{
            align-self: flex-start;
        }
    </style>
@endpush

@section("title", $title)

@section('content')
    @if (Auth::check() && Auth::user()->email === 'admin@gustoygracia.com')
        <div class="row mb-5">
            <div class="col">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="card-header">
                            <div class="row">
                                <h1>{{ $title }}</h1>
                            </div>
                        </div>
                        <div class="col-md mt-4">
                            @isset($user)
                                <form name="edit_user" action="{{ route('user.update', $user->id) }}" method="post">
                                @csrf
                            @else
                                <form name="create_user" action="{{ route('user.store') }}" method="post">
                                @csrf
                            @endisset
                                <div class="mb-3">
                                    <label for="name" class="form-label"> {{__('columns.user_1')}}</label>
                                    <input id="name" name="name" type="text"
                                    class="form-control" required @isset($user) value="{{$user->name}}" @endisset />
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label"> {{__('columns.user_2')}}</label>
                                    <input id="email" name="email" type="email" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"
                                    class="form-control" required @isset($user) value="{{$user->email}}" @endisset />
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">@isset($user->password) {{__('columns.user_4_form')}} @else {{__('columns.user_4')}} @endisset</label>
                                    <input id="password" name="password" type="password" @isset($user->password) @else required @endisset
                                    class="form-control" value=""/>
                                </div>

                                <!-- Contacto -->
                                <div class="mb-3">
                                    <h6 class="form-label" style="margin-bottom:7px;">{{__('columns.user_5')}} ({{ __('admin.optionalFields') }})</h6>
                                    <div class="card" style="padding-inline: 20px; padding-block: 2px; margin-bottom: 30px;">
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="contactName" class="form-label">{{__('columns.contact_1')}}</label>
                                                <input id="contactName" name="contactName" type="text"
                                                class="form-control" @isset($user->contact) value="{{$user->contact->name}}" @endisset />
                                            </div>
                                            <div class="mb-3">
                                                <label for="contactSurname" class="form-label">{{__('columns.contact_2')}}</label>
                                                <input id="contactSurname" name="contactSurname" type="text"
                                                class="form-control" @isset($user->contact) value="{{$user->contact->surname}}" @endisset />
                                            </div>
                                            <div class="mb-3">
                                                <label for="contactBio" class="form-label">{{__('columns.contact_3')}}</label>
                                                <input id="contactBio" name="contactBio" type="text"
                                                class="form-control" @isset($user->contact) value="{{$user->contact->bio}}" @endisset />
                                            </div>
                                            <div class="mb-3">
                                                <label for="contactPhone" class="form-label">{{__('columns.contact_4')}}</label>
                                                <input id="contactPhone" name="contactPhone" type="text"
                                                class="form-control" @isset($user->contact) value="{{$user->contact->phone}}" @endisset />
                                            </div>
                                            <div class="mb-3">
                                                <label for="contactCountry" class="form-label">{{__('columns.contact_5')}}</label>
                                                <input id="contactCountry" name="contactCountry" type="text"
                                                class="form-control" @isset($user->contact) value="{{$user->contact->country}}" @endisset />
                                            </div>
                                            <div class="mb-3">
                                                <label for="contactCity" class="form-label">{{__('columns.contact_6')}}</label>
                                                <input id="contactCity" name="contactCity" type="text"
                                                class="form-control" @isset($user->contact) value="{{$user->contact->city}}" @endisset />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <input type="submit" value="{{__('admin.save_btn')}}" class="btn btn-primary"/>
                            </form>
                        </div>
                        <!-- Botón para volver -->
                        <div>
                            <a href="{{ url()->previous() }}" class="btn-back">{{ __('messages.Back') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else

    @endif

    @endsection

@extends('layouts.app')

@php
    if (Session::has('locale')) {
        App::setLocale(Session::get('locale'));
    } else {
        App::setLocale(config('app.locale'));
    }
    if(isset($contact->name)){
        $title=__('admin.Edit').' '.$contact->name;
    } else{
        $title=__('admin.Create').' '.__('admin.TitleContactTable');
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
                            @isset($contact)
                                <form name="edit_contact" action="{{ route('contact.update', $contact->id) }}" method="post">
                                @csrf
                            @else
                                <form name="create_contact" action="{{ route('contact.store') }}" method="post">
                                @csrf
                            @endisset
                                <div class="mb-3">
                                    <h6 class="form-label" style="margin-bottom:7px;"> ({{ __('admin.optionalFields') }})</h6>
                                    <div class="card" style="padding-inline: 20px; padding-block: 2px; margin-bottom: 30px;">
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">{{__('columns.contact_1')}}</label>
                                                <input id="name" name="name" type="text"
                                                class="form-control" @isset($contact) value="{{$contact->name}}" @endisset />
                                            </div>
                                            <div class="mb-3">
                                                <label for="surname" class="form-label">{{__('columns.contact_2')}}</label>
                                                <input id="surname" name="surname" type="text"
                                                class="form-control" @isset($contact) value="{{$contact->surname}}" @endisset />
                                            </div>
                                            <div class="mb-3">
                                                <label for="bio" class="form-label">{{__('columns.contact_3')}}</label>
                                                <input id="bio" name="bio" type="text"
                                                class="form-control" @isset($contact) value="{{$contact->bio}}" @endisset />
                                            </div>
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">{{__('columns.contact_4')}}</label>
                                                <input id="phone" name="phone" type="text"
                                                class="form-control" @isset($contact) value="{{$contact->phone}}" @endisset />
                                            </div>
                                            <div class="mb-3">
                                                <label for="country" class="form-label">{{__('columns.contact_5')}}</label>
                                                <input id="country" name="country" type="text"
                                                class="form-control" @isset($contact) value="{{$contact->country}}" @endisset />
                                            </div>
                                            <div class="mb-3">
                                                <label for="city" class="form-label">{{__('columns.contact_6')}}</label>
                                                <input id="city" name="city" type="text"
                                                class="form-control" @isset($contact) value="{{$contact->city}}" @endisset />
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

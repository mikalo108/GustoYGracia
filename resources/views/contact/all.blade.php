@extends('layouts.app')

@php
    if (Session::has('locale')) {
        App::setLocale(Session::get('locale'));
    } else {
        App::setLocale(config('app.locale'));
    }

    $title = __('admin.TitleContactsTable'); 
    if(Auth::check() && Auth::user()->email === 'admin@gustoygracia.com') {
        $title = $title.' '. __('admin.Index');
    }
@endphp

@push('css')
    <!-- estilos adicionales -->
    <style>

    </style>
@endpush

@section('title', $title)

@section('content')
    @if (Auth::check() && Auth::user()->email === 'admin@gustoygracia.com')
        <div class="row mb-5">
            <div class="col">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="card-header">
                            <div class="row">
                                <h1>{{ __("admin.Table") }}: {{ __("admin.TitleContactsTable") }}</h1>
                            </div>
                        </div>
                        <div class="col-md mt-4">
                            <form action="{{ route('contact.index') }}" method="get" class="search-form" id="formBusqueda">
                                @csrf
                                <div>
                                    <label for="user_id" class="form-label"> {{ __("admin.TitleContactTable") }} {{ __('columns.contact_5') }}</label>
                                    <input type="text" id="user_id" name="user_id" class="form-control" value="@isset($user_id) {{ $user_id }} @endisset"/>
                                </div>
                                <div>
                                    <label for="contactName" class="form-label"> {{ __("admin.TitleContactTable") }} {{ __('columns.contact_1') }}</label>
                                    <input type="text" id="contactName" name="contactName" class="form-control" value="@isset($contactName) {{ $contactName }}@endisset"/>
                                </div>
                                <div>
                                    <label for="contactSurname" class="form-label"> {{ __("admin.TitleContactTable") }} {{ __('columns.contact_2') }}</label>
                                    <input type="text" id="contactSurname" name="contactSurname" class="form-control" value="@isset($contactSurname) {{ $contactSurname }} @endisset"/>
                                </div>
                                <div>
                                    <label for="contactPhone" class="form-label"> {{ __("admin.TitleContactTable") }} {{ __('columns.contact_4') }}</label>
                                    <input type="text" id="contactPhone" name="contactPhone" class="form-control" value="@isset($contactPhone) {{ $contactPhone }} @endisset"/>
                                </div>
                                <div>
                                    <label for="contactCountry" class="form-label"> {{ __("admin.TitleContactTable") }} {{ __('columns.contact_5') }}</label>
                                    <input type="text" id="contactCountry" name="contactCountry" class="form-control" value="@isset($contactCountry) {{ $contactCountry }} @endisset"/>
                                </div>
                                <button type="submit" id="botonBuscar" class="btn btn-primary"><img width="20" src="{{ asset('images/lupa-icon-solid-white.svg') }}" alt="Search"></button>
                                <input 
                                    @if(isset($user_id)||isset($contactName)||isset($contactSurname)||isset($contactPhone)||isset($contactCountry))
                                        style="visibility: visible;justify-self: right;"
                                    @else 
                                        style="visibility: hidden;justify-self: right;" 
                                    @endif 
                                    class="btn btn-danger" id="vaciarCampos" type="button" value="{{ __('admin.clearFields') }}"
                                >
                            </form>
                        </div>
                        <hr>
                        <div class="table-responsive mt-3">
                            @if (count($contactList) > 0)
                                <table class="table table-striped align-items-center">
                                    <thead class="thead-light">
                                        <th>#</th>
                                        <th>user_id</th>
                                        <th>{{ __('columns.contact_1') }}</th>
                                        <th>{{ __('columns.contact_2') }}</th>
                                        <th>{{ __('columns.contact_3') }}</th>
                                        <th>{{ __('columns.contact_4') }}</th>
                                        <th>{{ __('columns.contact_5') }}</th>
                                        <th>{{ __('columns.contact_6') }}</th>
                                        <th>{{ __('columns.created_at') }}</th>
                                        <th>{{ __('columns.updated_at') }}</th>
                                        <th>{{ __('columns.actions') }}</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($contactList as $contact)
                                            <tr class="filaTablaIndex"  link="{{ route('contact.show', $contact->id) }}">
                                                <td>{{ $contact->id }}</td>
                                                <td> @isset($contact->user) {{ $contact->user->id }} @endisset </td>
                                                <td>{{ $contact->name }}</td>
                                                <td>{{ $contact->surname }}</td>
                                                <td class="descripcion">{{ $contact->bio }}</td>
                                                <td>{{ $contact->phone }}</td>
                                                <td>{{ $contact->country }}</td>
                                                <td>{{ $contact->city }}</td>
                                                <td>{{ $contact->created_at }}</td>
                                                <td>{{ $contact->updated_at }}</td>

                                                <td>
                                                    <div class="btn-group actions" role="group" aria-label="Contact">
                                                        <div class="btn">
                                                            <a class="btn btn-secondary" href="{{ route('contact.edit', $contact) }}">
                                                                <img class="editButton" src="{{ asset('images/pencil-solid.svg') }}" alt="Edit">
                                                            </a>
                                                        </div>
                                                        <form class="btn" action="{{route('contact.destroy', $contact->id)}}" method="POST">
                                                            @csrf
                                                            @method("DELETE")
                                                            <a class="btn btn-danger botonBorrar">
                                                                <img class="editButton" src="{{ asset('images/trash-solid.svg') }}" alt="Delete">
                                                            </a>
                                                        </form>
                                                        
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="alert alert-warning mt-3">
                                    {{ __('admin.noData') }}
                                </div>
                            @endif
                        </div>
                        <div class="row my-3 pr-3">
                            <div class="col">
                                <div class="float-right">
                                    {{ $contactList->links('pagination::bootstrap-5') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else

    @endif

    @endsection

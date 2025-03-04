@extends('layouts.app')

@php
    if (Session::has('locale')) {
        App::setLocale(Session::get('locale'));
    } else {
        App::setLocale(config('app.locale'));
    }

    $title = __('admin.TitleUsersTable'); 
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
                                <h1>{{ __("admin.Table") }}: {{ __("admin.TitleUsersTable") }}</h1>
                            </div>
                        </div>
                        <div class="col-md mt-4">
                            <form action="{{ route('user.index') }}" method="get" class="search-form" id="formBusqueda">
                                @csrf
                                <div>
                                    <label for="user_id" class="form-label"> {{ __("admin.TitleUserTable") }} Id</label>
                                    <input type="text" id="user_id" name="user_id" class="form-control" value="@isset($user_id){{$user_id}}@endisset"/>
                                </div>
                                <div>
                                    <label for="userName" class="form-label"> {{ __("admin.TitleUserTable") }} {{ __('columns.user_1') }}</label>
                                    <input type="text" id="userName" name="userName" class="form-control"
                                    value="@isset($userName){{$userName}}@endisset"/>
                                </div>
                                <div>
                                    <label for="userEmail" class="form-label"> {{ __("admin.TitleUserTable") }} {{ __('columns.user_2') }}</label>
                                    <input type="text" id="userEmail" name="userEmail" class="form-control" value="@isset($userEmail){{$userEmail}}@endisset"/>
                                </div>
                                <div>
                                    <label for="userContactName" class="form-label"> {{ __("admin.TitleUserTable") }} {{ __('columns.user_5') }} {{ __('columns.user_1') }}</label>
                                    <input type="text" id="userContactName" name="userContactName" class="form-control" value="@isset($userContactName){{$userContactName}}@endisset"/>
                                </div>
                                
                                <button type="submit" id="botonBuscar" class="btn btn-primary"><img width="20" src="{{ asset('images/lupa-icon-solid-white.svg') }}" alt="Search"></button>
                                <input 
                                    @if(isset($user_id)||isset($userName)||isset($userEmail)||isset($userContactName))
                                        style="visibility: visible;justify-self: right;"
                                    @else 
                                        style="visibility: hidden;justify-self: right;" 
                                    @endif 
                                    class="btn btn-danger" id="vaciarCampos" type="button" value="{{ __('admin.clearFields') }}"
                                >
                            </form>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-end">
                            <a id="createIcon" class="header__link btn btn-sm btn-success"
                                href="{{ route('user.create') }}"><img width="30" src="{{ asset('images/plus-solid.svg') }}" alt="New"></a>
                        </div>
                        <div class="table-responsive mt-3">
                            @if (count($userList) > 0)
                                <table class="table table-striped align-items-center">
                                    <thead class="thead-light">
                                        <th>#</th>
                                        <th>{{ __('columns.user_1') }}</th>
                                        <th>{{ __('columns.user_2') }}</th>
                                        <th>{{ __('columns.user_3') }}</th>
                                        <th>{{ __('columns.user_4') }}</th>
                                        <th>{{ __('columns.user_5') }}</th>
                                        <th>{{ __('columns.created_at') }}</th>
                                        <th>{{ __('columns.updated_at') }}</th>
                                        <th>{{ __('columns.actions') }}</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($userList as $user)
                                            <tr class="filaTablaIndex" link="{{ route('user.show', $user->id) }}">
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    @if(isset($user->email_verified_at))
                                                        <img height="20" src="{{ asset('images/circle-check-solid.svg') }}" alt="True">
                                                    @else
                                                        <img height="20" src="{{ asset('images/circle-xmark-solid.svg') }}" alt="False">                                                    
                                                    @endif
                                                </td>
                                                <td class="descripcion">{{ $user->password }}</td>
                                                <td> @isset($user->contact->name) {{ $user->contact->name }} @endisset</td>
                                                <td>{{ $user->created_at }}</td>
                                                <td>{{ $user->updated_at }}</td>

                                                <td>
                                                    <div class="btn-group actions" role="group" aria-label="user">
                                                        @if(Auth::user()->email == $user->email) 
                                                        @else
                                                            <div class="btn">
                                                                <a class="btn btn-secondary" href="{{ route('user.edit', $user) }}">
                                                                    <img class="editButton" src="{{ asset('images/pencil-solid.svg') }}" alt="Edit">
                                                                </a>
                                                            </div>
                                                            <form class="btn" action="{{route('user.destroy', $user->id)}}" method="POST">
                                                                @csrf
                                                                @method("DELETE")
                                                                <a class="btn btn-danger botonBorrar">
                                                                    <img class="editButton" src="{{ asset('images/trash-solid.svg') }}" alt="Delete">
                                                                </a>
                                                            </form>
                                                        @endif                                                       
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
                                    {{ $userList->links('pagination::bootstrap-5') }}
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

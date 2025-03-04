@extends('layouts.app')

@php
    if (Session::has('locale')) {
        App::setLocale(Session::get('locale'));
    } else {
        App::setLocale(config('app.locale'));
    }

    $title = __('admin.TitleCommentsTable'); 
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
                                <h1>{{ __("admin.Table") }}: {{ __("admin.TitleCommentsTable") }}</h1>
                            </div>
                        </div>
                        <div class="col-md mt-4">
                            <form action="{{ route('comment.index') }}" method="get" class="search-form" id="formBusqueda">
                                @csrf
                                <div>
                                    <label for="commentUserId" class="form-label">{{ __('columns.comment_1') }} Id</label>
                                    <input type="text" id="commentUserId" name="commentUserId" class="form-control"
                                    value="@isset($commentUserId){{$commentUserId}}@endisset"/>
                                </div>
                                <div>
                                    <label for="commentRecipeId" class="form-label">{{ __('columns.comment_2') }} Id</label>
                                    <input type="text" id="commentRecipeId" name="commentRecipeId" class="form-control" value="@isset($commentRecipeId){{$commentRecipeId}}@endisset"/>
                                </div>
                                <button type="submit" id="botonBuscar" class="btn btn-primary"><img width="20" src="{{ asset('images/lupa-icon-solid-white.svg') }}" alt="Search"></button>
                                <input 
                                    @if(isset($commentUserId)||isset($commentRecipeId))
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
                                href="{{ route('comment.create') }}"><img width="30" src="{{ asset('images/plus-solid.svg') }}" alt="New"></a>
                        </div>
                        <div class="table-responsive mt-3">
                            @if (count($commentList) > 0)
                                <table class="table table-striped align-items-center">
                                    <thead class="thead-light">
                                        <th>#</th>
                                        <th>{{ __('columns.comment_1') }} Id</th>
                                        <th>{{ __('columns.comment_2') }} Id</th>
                                        <th>{{ __('columns.comment_3') }}</th>
                                        <th>{{ __('columns.created_at') }}</th>
                                        <th>{{ __('columns.updated_at') }}</th>
                                        <th>{{ __('columns.actions') }}</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($commentList as $comment)
                                            <tr class="filaTablaIndex" link="{{ route('comment.show', $comment->id) }}">
                                                <td>{{ $comment->id }}</td>
                                                <td> @isset($comment->user->id) {{ $comment->user->id }} @endisset</td>
                                                <td> @isset($comment->recipe->id) {{ $comment->recipe->id }} @endisset</td>
                                                <td class="descripcion">{{ $comment->content }}</td>
                                                <td>{{ $comment->created_at }}</td>
                                                <td>{{ $comment->updated_at }}</td>

                                                <td>
                                                    <div class="btn-group actions" role="group" aria-label="Comment">
                                                        <div class="btn">
                                                            <a class="btn btn-secondary" href="{{ route('comment.edit', $comment) }}">
                                                                <img class="editButton" src="{{ asset('images/pencil-solid.svg') }}" alt="Edit">
                                                            </a>
                                                        </div>
                                                        <form class="btn" action="{{route('comment.destroy', $comment->id)}}" method="POST">
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
                                    {{ $commentList->links('pagination::bootstrap-5') }}
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

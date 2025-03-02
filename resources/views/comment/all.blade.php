@extends('layouts.app')

@php
    if (Session::has('locale')) {
        App::setLocale(Session::get('locale'));
    } else {
        App::setLocale(config('app.locale'));
    }
@endphp

@push('css')
    <!-- estilos adicionales -->
    <style>

    </style>
@endpush

@section('title', 'Comment Index')

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
                            <form action="" method="post" class="search-form">
                                @csrf
                                <div>
                                    <label for="commentUser" class="form-label"> {{ __("admin.TitleCommentTable") }} {{ __('columns.comment_1') }}</label>
                                    <input id="commentUser" name="commentUser" class="form-control"
                                    value="@isset($commentUser) {{ $commentUser }}@endisset"/>
                                </div>
                                <div>
                                    <label for="commentRecipe" class="form-label"> {{ __("admin.TitleCommentTable") }} {{ __('columns.comment_2') }}</label>
                                    <input id="commentRecipe" name="commentRecipe" class="form-control" value="@isset($commentRecipe) {{ $commentRecipe }} @endisset"/>
                                </div>
                                <button type="submit" id="botonBuscar" class="btn btn-primary"><img width="20" src="{{ asset('images/lupa-icon-solid-white.svg') }}" alt="Search"></button>
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
                                        <th>{{ __('columns.comment_1') }}</th>
                                        <th>{{ __('columns.comment_2') }}</th>
                                        <th>{{ __('columns.comment_3') }}</th>
                                        <th>{{ __('columns.created_at') }}</th>
                                        <th>{{ __('columns.updated_at') }}</th>
                                        <th>{{ __('columns.actions') }}</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($commentList as $comment)
                                            <tr>
                                                <td>{{ $comment->id }}</td>
                                                <td> @isset($comment->user->name) {{ $comment->user->name }} @endisset</td>
                                                <td> @isset($comment->recipe->name) {{ $comment->recipe->name }} @endisset</td>
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

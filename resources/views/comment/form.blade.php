@extends('layouts.app')

@php
    if (Session::has('locale')) {
        App::setLocale(Session::get('locale'));
    } else {
        App::setLocale(config('app.locale'));
    }
    if(isset($comment->name)){
        $title=__('admin.Edit').' '.$comment->name;
    } else{
        $title=__('admin.Create').' '.__('admin.TitleCommentTable');
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
                            @isset($comment)
                                <form name="edit_comment" action="{{ route('comment.update', $comment->id) }}" method="post">
                                @csrf
                            @else
                                <form name="create_comment" action="{{ route('comment.store') }}" method="post">
                                @csrf
                            @endisset
                                <div class="mb-3">
                                    <h6 class="form-label" style="margin-bottom:7px;"> ({{ __('admin.optionalFields') }})</h6>
                                    <div class="card" style="padding-inline: 20px; padding-block: 2px; margin-bottom: 30px;">
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="recipe" class="form-label">{{__('columns.comment_1')}} {{__('columns.comment_2')}}</label>
                                                <input id="recipe" @isset($comment) disabled @endisset type="text"
                                                class="form-control"  @isset($comment) value="{{$comment->recipe->name}}" @endisset />
                                            </div>
                                            <div class="mb-3">
                                                <label for="user" class="form-label">{{__('columns.comment_2')}} {{__('columns.comment_3')}}</label>
                                                <input id="user"  @isset($comment) disabled @endisset type="text"
                                                class="form-control" @isset($comment) value="{{$comment->user->name}}" @endisset />
                                            </div>
                                            <div class="mb-3">
                                                <label for="content" class="form-label">{{__('columns.comment_3')}} {{__('columns.comment_1')}}</label>
                                                <textarea id="content" required name="content" 
                                                class="form-control">@isset($comment){{$comment->content}}@endisset</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <input type="submit" value="{{__('admin.save_btn')}}" class="btn btn-primary" name="saveBtn"/>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else

    @endif

    @endsection

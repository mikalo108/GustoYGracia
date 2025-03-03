@extends('layouts.app')

@php
    if (Session::has('locale')) {
        App::setLocale(Session::get('locale'));
    } else {
        App::setLocale(config('app.locale'));
    }
@endphp

@section('title', __('messages.MyProfile') . ' | Gusto&Gracia')

@section('content')
    <div class="profile-page">
        <h1>{{ __('messages.MyProfile') }}</h1>
        <form action="{{ route('myProfile.update', ['id' => Auth::user()->id]) }}" method="POST" id="profile-form">
            @csrf
            @method('PUT')

            <label for="name">{{ __('messages.User') }}</label>
            <input type="text" id="name" name="name" value="{{ Auth::user()->name }}" disabled>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />

            <label for="email">{{ __('messages.Email') }}</label>
            <input type="email" id="email" name="email" value="{{ Auth::user()->email }}" disabled>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />

            <label for="password">{{ __('messages.NewPassword') }}</label>
            <input type="password" id="password" name="password" disabled>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />

            <label for="password_confirmation">{{ __('messages.PassConfirm') }}</label>
            <input type="password" id="password_confirmation" name="password_confirmation" disabled>

            <label for="contact_name">{{ __('messages.Name') }}</label>
            <input type="text" name="contact_name" value="{{ $user->contact->name ?? '' }}" disabled>

            <label for="contact_surname">{{ __('messages.Surnames') }}</label>
            <input type="text" name="contact_surname" value="{{ $user->contact->surname ?? '' }}" disabled>

            <label for="contact_bio">{{ __('messages.Bio') }}</label>
            <textarea name="contact_bio" disabled>{{ $user->contact->bio ?? '' }}</textarea>

            <label for="contact_phone">{{ __('messages.Phone') }}</label>
            <input type="text" name="contact_phone" value="{{ $user->contact->phone ?? '' }}" disabled>

            <label for="contact_country">{{ __('messages.Country') }}</label>
            <input type="text" name="contact_country" value="{{ $user->contact->country ?? '' }}" disabled>

            <label for="contact_city">{{ __('messages.City') }}</label>
            <input type="text" name="contact_city" value="{{ $user->contact->city ?? '' }}" disabled>

            <div class="button-group">
                <button type="button" id="edit-btn">{{ __('messages.EditData') }}</button>
                <button type="submit" id="save-btn" class="hidden">{{ __('messages.Save') }}</button>
                <button type="button" id="cancel-btn" class="hidden">{{ __('messages.Cancel') }}</button>
            </div>
            <div>
                <a href="{{ url()->previous() }}" class="btn-back">{{ __('messages.Back') }}</a>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const editBtn = document.getElementById("edit-btn");
                const saveBtn = document.getElementById("save-btn");
                const cancelBtn = document.getElementById("cancel-btn");
                const inputs = document.querySelectorAll("#profile-form input, #profile-form textarea");

                editBtn.addEventListener("click", function() {
                    inputs.forEach(input => input.disabled = false);
                    editBtn.classList.add("hidden");
                    saveBtn.classList.remove("hidden");
                    cancelBtn.classList.remove("hidden");
                });

                cancelBtn.addEventListener("click", function() {
                    inputs.forEach(input => input.disabled = true);
                    editBtn.classList.remove("hidden");
                    saveBtn.classList.add("hidden");
                    cancelBtn.classList.add("hidden");
                });
            });
        </script>
    @endpush
@endsection

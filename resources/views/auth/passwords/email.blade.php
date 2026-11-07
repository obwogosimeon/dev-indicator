@extends('layouts.auth')

@section('title', __('Reset your password'))

@section('content')
<h1 class="auth-heading">{{ __('Reset your password') }}</h1>
<p class="auth-description">{{ __('Enter the email address linked to your account and we will send you a password reset link.') }}</p>

<form method="POST" action="{{ route('password.email') }}" class="auth-form" aria-label="{{ __('Send password reset link') }}">
    @csrf

    <div class="auth-field">
        <label class="auth-label" for="email">{{ __('Email address') }}</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}"
               class="auth-input{{ $errors->has('email') ? ' is-invalid' : '' }}"
               placeholder="you@organization.org" required autofocus autocomplete="email">
        @if ($errors->has('email'))
            <span class="auth-error" role="alert">{{ $errors->first('email') }}</span>
        @endif
    </div>

    <button type="submit" class="auth-button">{{ __('Email me a reset link') }}</button>
</form>

<a class="auth-back" href="{{ route('login') }}">&larr; {{ __('Back to sign in') }}</a>
@endsection

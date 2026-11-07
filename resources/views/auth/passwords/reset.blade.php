@extends('layouts.auth')

@section('title', __('Choose a new password'))

@section('content')
<h1 class="auth-heading">{{ __('Choose a new password') }}</h1>
<p class="auth-description">{{ __('Enter your email address and choose a new password for your account.') }}</p>

<form method="POST" action="{{ route('password.request') }}" class="auth-form" aria-label="{{ __('Reset Password') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">

    <div class="auth-field">
        <label class="auth-label" for="email">{{ __('Email address') }}</label>
        <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}"
               class="auth-input{{ $errors->has('email') ? ' is-invalid' : '' }}"
               placeholder="you@organization.org" required autofocus autocomplete="email">
        @if ($errors->has('email'))
            <span class="auth-error" role="alert">{{ $errors->first('email') }}</span>
        @endif
    </div>

    <div class="auth-field">
        <label class="auth-label" for="password">{{ __('New password') }}</label>
        <div class="auth-password">
            <input id="password" type="password" name="password"
                   class="auth-input{{ $errors->has('password') ? ' is-invalid' : '' }}"
                   placeholder="{{ __('Create a new password') }}" required autocomplete="new-password">
            <button type="button" class="auth-password__toggle" data-password-toggle
                    data-show-label="{{ __('Show') }}" data-hide-label="{{ __('Hide') }}"
                    aria-label="{{ __('Show password') }}" aria-controls="password" aria-pressed="false">{{ __('Show') }}</button>
        </div>
        @if ($errors->has('password'))
            <span class="auth-error" role="alert">{{ $errors->first('password') }}</span>
        @endif
    </div>

    <div class="auth-field">
        <label class="auth-label" for="password_confirmation">{{ __('Confirm new password') }}</label>
        <div class="auth-password">
            <input id="password_confirmation" type="password" name="password_confirmation"
                   class="auth-input" placeholder="{{ __('Re-enter your new password') }}" required autocomplete="new-password">
            <button type="button" class="auth-password__toggle" data-password-toggle
                    data-show-label="{{ __('Show') }}" data-hide-label="{{ __('Hide') }}"
                    aria-label="{{ __('Show password') }}" aria-controls="password_confirmation" aria-pressed="false">{{ __('Show') }}</button>
        </div>
    </div>

    <button type="submit" class="auth-button">{{ __('Reset password') }}</button>
</form>

<a class="auth-back" href="{{ route('login') }}">&larr; {{ __('Back to sign in') }}</a>
@endsection

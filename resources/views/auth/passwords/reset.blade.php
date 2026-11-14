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
                    data-show-label="{{ __('Show password') }}" data-hide-label="{{ __('Hide password') }}"
                    aria-label="{{ __('Show password') }}" aria-controls="password" aria-pressed="false">
                <svg class="auth-password__icon auth-password__icon--show" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7S2 12 2 12Z"></path>
                    <circle cx="12" cy="12" r="3"></circle>
                </svg>
                <svg class="auth-password__icon auth-password__icon--hide" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="m3 3 18 18"></path>
                    <path d="M10.6 10.6a2 2 0 0 0 2.8 2.8"></path>
                    <path d="M9.9 5.2A10.7 10.7 0 0 1 12 5c6.4 0 10 7 10 7a15.8 15.8 0 0 1-3.1 3.9"></path>
                    <path d="M6.2 6.2C3.5 8 2 12 2 12s3.6 7 10 7c1.2 0 2.3-.2 3.3-.6"></path>
                </svg>
            </button>
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
                    data-show-label="{{ __('Show password') }}" data-hide-label="{{ __('Hide password') }}"
                    aria-label="{{ __('Show password') }}" aria-controls="password_confirmation" aria-pressed="false">
                <svg class="auth-password__icon auth-password__icon--show" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7S2 12 2 12Z"></path>
                    <circle cx="12" cy="12" r="3"></circle>
                </svg>
                <svg class="auth-password__icon auth-password__icon--hide" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="m3 3 18 18"></path>
                    <path d="M10.6 10.6a2 2 0 0 0 2.8 2.8"></path>
                    <path d="M9.9 5.2A10.7 10.7 0 0 1 12 5c6.4 0 10 7 10 7a15.8 15.8 0 0 1-3.1 3.9"></path>
                    <path d="M6.2 6.2C3.5 8 2 12 2 12s3.6 7 10 7c1.2 0 2.3-.2 3.3-.6"></path>
                </svg>
            </button>
        </div>
    </div>

    <button type="submit" class="auth-button">{{ __('Reset password') }}</button>
</form>

<a class="auth-back" href="{{ route('login') }}">&larr; {{ __('Back to sign in') }}</a>
@endsection

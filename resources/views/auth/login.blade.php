@extends('layouts.auth')

@section('title', __('Sign in'))

@section('content')
<h1 class="auth-heading">{{ __('Welcome back') }}</h1>
<p class="auth-description">Sign in to continue to your monitoring and evaluation workspace.</p>

<form method="POST" action="{{ route('login') }}" class="auth-form" aria-label="{{ __('Login') }}" data-enable-when-complete>
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

    <div class="auth-field">
        <label class="auth-label" for="password">{{ __('Password') }}</label>
        <div class="auth-password">
            <input id="password" type="password" name="password"
                   class="auth-input{{ $errors->has('password') ? ' is-invalid' : '' }}"
                   placeholder="{{ __('Enter your password') }}" required autocomplete="current-password">
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

    <div class="auth-form__meta">
        <label class="auth-checkbox" for="remember">
            <input id="remember" type="checkbox" name="remember" value="1" {{ old('remember') ? 'checked' : '' }}>
            <span>{{ __('Remember me') }}</span>
        </label>
        <a class="auth-link" href="{{ route('password.request') }}">{{ __('Forgot password?') }}</a>
    </div>

    <button type="submit" class="auth-button" data-submit-button disabled>{{ __('Sign in') }}</button>
</form>

<p class="auth-switch">
    {{ __('New to DevIndicator?') }}
    <a class="auth-link" href="{{ route('register') }}">{{ __('Create an account') }}</a>
</p>
@endsection

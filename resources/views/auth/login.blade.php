@extends('layouts.auth')

@section('title', __('Sign in'))

@section('content')
<h1 class="auth-heading">{{ __('Welcome back') }}</h1>
<p class="auth-description">Sign in to continue to your monitoring and evaluation workspace.</p>

<form method="POST" action="{{ route('login') }}" class="auth-form" aria-label="{{ __('Login') }}">
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
                    data-show-label="{{ __('Show') }}" data-hide-label="{{ __('Hide') }}"
                    aria-label="{{ __('Show password') }}" aria-controls="password" aria-pressed="false">{{ __('Show') }}</button>
        </div>
        @if ($errors->has('password'))
            <span class="auth-error" role="alert">{{ $errors->first('password') }}</span>
        @endif
    </div>

    <div class="auth-form__meta">
        <label class="auth-checkbox" for="remember">
            <input id="remember" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
            <span>{{ __('Remember me') }}</span>
        </label>
        <a class="auth-link" href="{{ route('password.request') }}">{{ __('Forgot password?') }}</a>
    </div>

    <button type="submit" class="auth-button">{{ __('Sign in') }}</button>
</form>

<p class="auth-switch">
    {{ __('New to DevIndicator?') }}
    <a class="auth-link" href="{{ route('register') }}">{{ __('Create an account') }}</a>
</p>
@endsection

@extends('layouts.auth')

@section('title', __('Change password'))

@section('content')
<h1 class="auth-heading">{{ __('Change your password') }}</h1>
<p class="auth-description">{{ __('Choose a new password to keep your account secure.') }}</p>

<form method="POST" action="{{ route('changePassword') }}" class="auth-form" aria-label="{{ __('Change password') }}">
    @csrf

    <div class="auth-field">
        <label class="auth-label" for="current-password">{{ __('Current password') }}</label>
        <div class="auth-password">
            <input id="current-password" type="password" name="current-password"
                   class="auth-input{{ $errors->has('current-password') ? ' is-invalid' : '' }}"
                   placeholder="{{ __('Enter your current password') }}" required autofocus autocomplete="current-password">
            <button type="button" class="auth-password__toggle" data-password-toggle
                    data-show-label="{{ __('Show password') }}" data-hide-label="{{ __('Hide password') }}"
                    aria-label="{{ __('Show password') }}" aria-controls="current-password" aria-pressed="false">
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
        @if ($errors->has('current-password'))
            <span class="auth-error" role="alert">{{ $errors->first('current-password') }}</span>
        @endif
    </div>

    <div class="auth-field">
        <label class="auth-label" for="new-password">{{ __('New password') }}</label>
        <div class="auth-password">
            <input id="new-password" type="password" name="new-password"
                   class="auth-input{{ $errors->has('new-password') ? ' is-invalid' : '' }}"
                   placeholder="{{ __('Create a new password') }}" required autocomplete="new-password">
            <button type="button" class="auth-password__toggle" data-password-toggle
                    data-show-label="{{ __('Show password') }}" data-hide-label="{{ __('Hide password') }}"
                    aria-label="{{ __('Show password') }}" aria-controls="new-password" aria-pressed="false">
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
        @if ($errors->has('new-password'))
            <span class="auth-error" role="alert">{{ $errors->first('new-password') }}</span>
        @endif
    </div>

    <div class="auth-field">
        <label class="auth-label" for="new-password-confirm">{{ __('Confirm new password') }}</label>
        <div class="auth-password">
            <input id="new-password-confirm" type="password" name="new-password-confirm"
                   class="auth-input{{ $errors->has('new-password-confirm') ? ' is-invalid' : '' }}"
                   placeholder="{{ __('Re-enter your new password') }}" required autocomplete="new-password">
            <button type="button" class="auth-password__toggle" data-password-toggle
                    data-show-label="{{ __('Show password') }}" data-hide-label="{{ __('Hide password') }}"
                    aria-label="{{ __('Show password') }}" aria-controls="new-password-confirm" aria-pressed="false">
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
        @if ($errors->has('new-password-confirm'))
            <span class="auth-error" role="alert">{{ $errors->first('new-password-confirm') }}</span>
        @endif
    </div>

    <button type="submit" class="auth-button">{{ __('Save new password') }}</button>
</form>
@endsection

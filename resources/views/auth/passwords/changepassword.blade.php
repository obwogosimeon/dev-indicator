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
                    data-show-label="{{ __('Show') }}" data-hide-label="{{ __('Hide') }}"
                    aria-label="{{ __('Show password') }}" aria-controls="current-password" aria-pressed="false">{{ __('Show') }}</button>
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
                    data-show-label="{{ __('Show') }}" data-hide-label="{{ __('Hide') }}"
                    aria-label="{{ __('Show password') }}" aria-controls="new-password" aria-pressed="false">{{ __('Show') }}</button>
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
                    data-show-label="{{ __('Show') }}" data-hide-label="{{ __('Hide') }}"
                    aria-label="{{ __('Show password') }}" aria-controls="new-password-confirm" aria-pressed="false">{{ __('Show') }}</button>
        </div>
        @if ($errors->has('new-password-confirm'))
            <span class="auth-error" role="alert">{{ $errors->first('new-password-confirm') }}</span>
        @endif
    </div>

    <button type="submit" class="auth-button">{{ __('Save new password') }}</button>
</form>
@endsection

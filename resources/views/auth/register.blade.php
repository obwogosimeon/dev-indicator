@extends('layouts.auth')

@section('title', __('Create an account'))
@section('content-class', 'auth-content--wide')
@section('main-class', 'auth-main__inner--wide')

@section('content')
<h1 class="auth-heading">{{ __('Create your account') }}</h1>
<p class="auth-description">Set up your DevIndicator workspace to start planning and measuring results.</p>

<form action="{{ route('register') }}" method="POST" class="auth-form auth-form--register" aria-label="{{ __('Register') }}">
    @csrf
    <input type="hidden" name="role" value="admin">

    <div class="auth-field auth-field--full">
        <label class="auth-label" for="account_type">{{ __('Account type') }}</label>
        <select class="auth-select{{ $errors->has('account_type') ? ' is-invalid' : '' }}" name="account_type" id="account_type">
            <option value="null" {{ old('account_type', 'null') == 'null' ? 'selected' : '' }}>{{ __('Select an account type') }}</option>
            <option value="Organization" {{ old('account_type') == 'Organization' ? 'selected' : '' }}>{{ __('Organization') }}</option>
            <option value="Consultant" {{ old('account_type') == 'Consultant' ? 'selected' : '' }}>{{ __('Consultant') }}</option>
            <option value="Student" {{ old('account_type') == 'Student' ? 'selected' : '' }}>{{ __('Student') }}</option>
        </select>
        @if ($errors->has('account_type'))
            <span class="auth-error" role="alert">{{ $errors->first('account_type') }}</span>
        @endif
    </div>

    <div class="auth-field auth-field--full" id="organization-field">
        <label class="auth-label" for="organization_name">{{ __('Organization name') }}</label>
        <input type="text" name="organization_name" id="organization_name"
               class="auth-input{{ $errors->has('organization_name') ? ' is-invalid' : '' }}"
               placeholder="{{ __('Enter your organization name') }}" value="{{ old('organization_name') }}" autocomplete="organization">
        @if ($errors->has('organization_name'))
            <span class="auth-error" role="alert">{{ $errors->first('organization_name') }}</span>
        @endif
    </div>

    <div class="auth-field auth-field--full" id="domain-field">
        <label class="auth-label" for="domain">{{ __('Workspace domain') }}</label>
        <input type="text" name="domain_name" id="domain"
               class="auth-input{{ $errors->has('domain_name') ? ' is-invalid' : '' }}"
               placeholder="{{ __('Choose a workspace name') }}" value="{{ old('domain_name') }}" autocomplete="off">
        <span class="auth-hint" id="domain-name">{{ __('Choose a short name for your organization workspace.') }}</span>
        @if ($errors->has('domain_name'))
            <span class="auth-error" role="alert">{{ $errors->first('domain_name') }}</span>
        @endif
    </div>

    <div class="auth-field">
        <label class="auth-label" for="name">{{ __('First name') }}</label>
        <input type="text" name="name" id="name"
               class="auth-input{{ $errors->has('name') ? ' is-invalid' : '' }}"
               placeholder="{{ __('Your first name') }}" value="{{ old('name') }}" required autofocus autocomplete="given-name">
        @if ($errors->has('name'))
            <span class="auth-error" role="alert">{{ $errors->first('name') }}</span>
        @endif
    </div>

    <div class="auth-field">
        <label class="auth-label" for="last_name">{{ __('Last name') }}</label>
        <input type="text" name="last_name" id="last_name"
               class="auth-input{{ $errors->has('last_name') ? ' is-invalid' : '' }}"
               placeholder="{{ __('Your last name') }}" value="{{ old('last_name') }}" required autocomplete="family-name">
        @if ($errors->has('last_name'))
            <span class="auth-error" role="alert">{{ $errors->first('last_name') }}</span>
        @endif
    </div>

    <div class="auth-field auth-field--full">
        <label class="auth-label" for="email">{{ __('Email address') }}</label>
        <input type="email" name="email" id="email"
               class="auth-input{{ $errors->has('email') ? ' is-invalid' : '' }}"
               placeholder="you@organization.org" value="{{ old('email') }}" required autocomplete="email">
        @if ($errors->has('email'))
            <span class="auth-error" role="alert">{{ $errors->first('email') }}</span>
        @endif
    </div>

    <div class="auth-field">
        <label class="auth-label" for="password">{{ __('Password') }}</label>
        <div class="auth-password">
            <input type="password" name="password" id="password"
                   class="auth-input{{ $errors->has('password') ? ' is-invalid' : '' }}"
                   placeholder="{{ __('Create a password') }}" required autocomplete="new-password">
            <button type="button" class="auth-password__toggle" data-password-toggle
                    data-show-label="{{ __('Show') }}" data-hide-label="{{ __('Hide') }}"
                    aria-label="{{ __('Show password') }}" aria-controls="password" aria-pressed="false">{{ __('Show') }}</button>
        </div>
        @if ($errors->has('password'))
            <span class="auth-error" role="alert">{{ $errors->first('password') }}</span>
        @endif
    </div>

    <div class="auth-field">
        <label class="auth-label" for="password_confirmation">{{ __('Confirm password') }}</label>
        <div class="auth-password">
            <input type="password" name="password_confirmation" id="password_confirmation"
                   class="auth-input" placeholder="{{ __('Re-enter your password') }}" required autocomplete="new-password">
            <button type="button" class="auth-password__toggle" data-password-toggle
                    data-show-label="{{ __('Show') }}" data-hide-label="{{ __('Hide') }}"
                    aria-label="{{ __('Show password') }}" aria-controls="password_confirmation" aria-pressed="false">{{ __('Show') }}</button>
        </div>
    </div>

    <div class="auth-field auth-field--full">
        <button type="submit" class="auth-button">{{ __('Create account') }}</button>
    </div>
</form>

<p class="auth-switch">
    {{ __('Already have an account?') }}
    <a class="auth-link" href="{{ route('login') }}">{{ __('Sign in') }}</a>
</p>
@endsection

@push('scripts')
<script>
    (function () {
        var accountType = document.getElementById('account_type');
        var organizationField = document.getElementById('organization-field');
        var domainField = document.getElementById('domain-field');
        var organizationName = document.getElementById('organization_name');
        var domain = document.getElementById('domain');
        var domainHint = document.getElementById('domain-name');

        function updateOrganizationFields() {
            var isOrganization = accountType.value === 'Organization';
            organizationField.hidden = !isOrganization;
            domainField.hidden = !isOrganization;
        }

        function updateDomainHint() {
            var domainName = domain.value.trim();
            domainHint.textContent = domainName
                ? domainName + '.app.devindicators.com'
                : 'Choose a short name for your organization workspace.';
        }

        accountType.addEventListener('change', updateOrganizationFields);
        organizationName.addEventListener('input', function () {
            if (!domain.value || domain.dataset.autofilled === 'true') {
                domain.value = organizationName.value.trim().replace(/\s+/g, '-').toLowerCase();
                domain.dataset.autofilled = 'true';
            }
            updateDomainHint();
        });
        domain.addEventListener('input', function () {
            domain.value = domain.value.replace(/\s+/g, '-').toLowerCase();
            domain.dataset.autofilled = 'false';
            updateDomainHint();
        });

        updateOrganizationFields();
        updateDomainHint();
    }());
</script>
@endpush

@extends('layouts.auth')

@section('title', __('Monitoring and evaluation workspace'))

@section('content')
<span class="auth-aside__eyebrow auth-home__eyebrow">{{ __('Monitoring, evaluation, and learning') }}</span>
<h1 class="auth-heading auth-home__heading">{{ __('Make every result count.') }}</h1>
<p class="auth-description auth-home__description">
    {{ __('DevIndicator brings your programs, projects, and evidence together so your team can focus on the outcomes that matter.') }}
</p>

<div class="auth-home__actions">
    @auth
        <a class="auth-button auth-home__button" href="{{ route('home') }}">{{ __('Go to your workspace') }}</a>
    @else
        <a class="auth-button auth-home__button" href="{{ route('login') }}">{{ __('Sign in to your workspace') }}</a>
        <a class="auth-button auth-button--secondary auth-home__button" href="{{ route('register') }}">{{ __('Create an account') }}</a>
    @endauth
</div>

<div class="auth-home__features" aria-label="{{ __('Platform benefits') }}">
    <div class="auth-home__feature">
        <span class="auth-home__feature-mark" aria-hidden="true">01</span>
        <span>{{ __('Plan programs and projects') }}</span>
    </div>
    <div class="auth-home__feature">
        <span class="auth-home__feature-mark" aria-hidden="true">02</span>
        <span>{{ __('Track indicators and progress') }}</span>
    </div>
    <div class="auth-home__feature">
        <span class="auth-home__feature-mark" aria-hidden="true">03</span>
        <span>{{ __('Learn from measurable results') }}</span>
    </div>
</div>
@endsection

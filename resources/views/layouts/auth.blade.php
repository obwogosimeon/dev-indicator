<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#123f4a">
    <title>@yield('title') | {{ config('app.name', 'DevIndicator') }}</title>
    <link rel="icon" href="{{ asset('main/img/favicon_io/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body class="auth-page">
    <main class="auth-layout">
        <aside class="auth-aside" aria-label="About DevIndicator">
            <a class="auth-aside__brand" href="{{ url('/') }}" aria-label="DevIndicator home">
                <img src="{{ asset('main/img/devlogo.png') }}" alt="DevIndicator">
                <span>DevIndicator</span>
            </a>
            <div class="auth-aside__message">
                <span class="auth-aside__eyebrow">Plan with purpose. Measure what matters.</span>
                <h1>Better insights.<br>Stronger outcomes.</h1>
                <p>A workspace for teams to plan, monitor, and learn from the work that moves communities forward.</p>
            </div>
            <div class="auth-aside__footer">
                <span>Managing for development results</span>
                <span class="auth-aside__footer-mark" aria-hidden="true">M&amp;E</span>
            </div>
        </aside>

        <section class="auth-main">
            <div class="auth-main__inner @yield('main-class')">
                <a class="auth-brand-mobile" href="{{ url('/') }}">
                    <img src="{{ asset('main/img/devlogo.png') }}" alt="">
                    <span>DevIndicator</span>
                </a>
                <div class="auth-content @yield('content-class')">
                    @if (session('status'))
                        <div class="auth-alert auth-alert--success" role="status">{{ session('status') }}</div>
                    @endif
                    @if (session('success'))
                        <div class="auth-alert auth-alert--success" role="status">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="auth-alert auth-alert--error" role="alert">{{ session('error') }}</div>
                    @endif
                    @yield('content')
                </div>
                <footer class="auth-main__footer">
                    &copy; {{ \Carbon\Carbon::now()->format('Y') }} DevIndicator. All rights reserved.
                </footer>
            </div>
        </section>
    </main>
    <script>
        document.querySelectorAll('[data-password-toggle]').forEach(function (toggle) {
            toggle.addEventListener('click', function () {
                var input = document.getElementById(toggle.getAttribute('aria-controls'));
                var visible = input.type === 'password';

                input.type = visible ? 'text' : 'password';
                toggle.setAttribute('aria-pressed', visible ? 'true' : 'false');
                toggle.setAttribute('aria-label', visible ? toggle.dataset.hideLabel : toggle.dataset.showLabel);
                toggle.textContent = visible ? toggle.dataset.hideLabel : toggle.dataset.showLabel;
            });
        });
    </script>
    @stack('scripts')
</body>
</html>

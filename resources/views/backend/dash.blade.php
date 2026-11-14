@extends('layouts.apps')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css?ver=1.1') }}">
@endpush

@section('content')
<main class="container-fluid me-home">
    @if (session('status'))
        <div class="alert alert-success" role="status">{{ session('status') }}</div>
    @endif

    <header class="me-home__header">
        <div>
            <p class="me-home__eyebrow">Monitoring &amp; evaluation workspace</p>
            <h1 class="me-home__title">Welcome back, {{ Auth::user()->name }}</h1>
            <p class="me-home__intro">Plan with clarity, follow implementation, and keep your results in view.</p>
        </div>
        <time class="me-home__date" datetime="{{ \Carbon\Carbon::now()->toDateString() }}">
            <span class="me-home__date-icon" aria-hidden="true"><em class="icon ni ni-calendar-alt"></em></span>
            {{ \Carbon\Carbon::now()->format('l, F j, Y') }}
        </time>
    </header>

    <section class="me-home__section" aria-labelledby="me-home-snapshot-title">
        <div class="me-home__section-head">
            <div>
                <h2 id="me-home-snapshot-title">Portfolio snapshot</h2>
                <p>A quick view of your current workspace.</p>
            </div>
        </div>

        <div class="me-home__stats">
            <article class="me-home__stat">
                <span class="me-home__stat-icon me-home__stat-icon--teal" aria-hidden="true"><em class="icon ni ni-activity-round-fill"></em></span>
                <span class="me-home__stat-label">Projects</span>
                <strong class="me-home__stat-value">{{ $projects }}</strong>
                <span class="me-home__stat-note">Created by you</span>
            </article>
            <article class="me-home__stat">
                <span class="me-home__stat-icon me-home__stat-icon--blue" aria-hidden="true"><em class="icon ni ni-cc-alt2-fill"></em></span>
                <span class="me-home__stat-label">Programs</span>
                <strong class="me-home__stat-value">{{ $programs }}</strong>
                <span class="me-home__stat-note">Created by you</span>
            </article>
            <article class="me-home__stat">
                <span class="me-home__stat-icon me-home__stat-icon--amber" aria-hidden="true"><em class="icon ni ni-building"></em></span>
                <span class="me-home__stat-label">Affiliate partners</span>
                <strong class="me-home__stat-value">{{ $affiliate }}</strong>
                <span class="me-home__stat-note">Connected organizations</span>
            </article>
            <a class="me-home__stat" href="{{ url('barnotifications') }}">
                <span class="me-home__stat-icon me-home__stat-icon--violet" aria-hidden="true"><em class="icon ni ni-bell"></em></span>
                <span class="me-home__stat-label">Notifications</span>
                <strong class="me-home__stat-value">{{ $notificationcount }}</strong>
                <span class="me-home__stat-note">Pending updates <em class="icon ni ni-arrow-up-right" aria-hidden="true"></em></span>
            </a>
        </div>
    </section>

    <section class="me-home__section" aria-labelledby="me-home-integrations-title">
        <div class="me-home__section-head">
            <div>
                <h2 id="me-home-integrations-title">Connected tools</h2>
                <p>Jump straight into your data collection and analysis workspaces.</p>
            </div>
        </div>

        <div class="me-home__integrations">
            <a class="me-home__integration" href="http://kf.kobo.visystem.net/" target="_blank" rel="noopener noreferrer">
                <span class="me-home__integration-icon me-home__integration-icon--teal" aria-hidden="true"><em class="icon ni ni-file-code"></em></span>
                <span class="me-home__integration-content">
                    <strong>KoboToolbox</strong>
                    <span>Open your field data collection workspace.</span>
                </span>
                <span class="me-home__integration-link">Open tool <em class="icon ni ni-arrow-up-right" aria-hidden="true"></em></span>
            </a>
            <a class="me-home__integration" href="http://rstudio.visystem.net/" target="_blank" rel="noopener noreferrer">
                <span class="me-home__integration-icon me-home__integration-icon--blue" aria-hidden="true"><em class="icon ni ni-bar-chart"></em></span>
                <span class="me-home__integration-content">
                    <strong>RStudio</strong>
                    <span>Launch the statistical analysis environment.</span>
                </span>
                <span class="me-home__integration-link">Open tool <em class="icon ni ni-arrow-up-right" aria-hidden="true"></em></span>
            </a>
            <a class="me-home__integration" href="http://jupyter.visystem.net/" target="_blank" rel="noopener noreferrer">
                <span class="me-home__integration-icon me-home__integration-icon--violet" aria-hidden="true"><em class="icon ni ni-code"></em></span>
                <span class="me-home__integration-content">
                    <strong>Jupyter</strong>
                    <span>Explore data in an interactive notebook.</span>
                </span>
                <span class="me-home__integration-link">Open tool <em class="icon ni ni-arrow-up-right" aria-hidden="true"></em></span>
            </a>
        </div>
    </section>

    <section class="me-home__section" aria-labelledby="me-home-cycle-title">
        <div class="me-home__section-head">
            <div>
                <h2 id="me-home-cycle-title">Your M&amp;E work cycle</h2>
                <p>Move from programme design to delivery, measurement, and learning.</p>
            </div>
        </div>

        <div class="me-home__cycle">
            <article class="me-home__cycle-card">
                <div class="me-home__cycle-top">
                    <span class="me-home__step">01</span>
                    <span class="me-home__cycle-icon me-home__cycle-icon--teal" aria-hidden="true"><em class="icon ni ni-bulb"></em></span>
                </div>
                <p class="me-home__cycle-label">Plan &amp; design</p>
                <h3>Define the change you want to make</h3>
                <p class="me-home__cycle-copy">Organize programs, build results frameworks, and connect interventions to outcomes.</p>
                <div class="me-home__cycle-links">
                    @can('programs.index')
                        <a href="{{ route('programs.index') }}">Programs <em class="icon ni ni-arrow-right" aria-hidden="true"></em></a>
                    @endcan
                    <a href="{{ route('logframes.index') }}">Logframes &amp; indicators <em class="icon ni ni-arrow-right" aria-hidden="true"></em></a>
                </div>
            </article>

            <article class="me-home__cycle-card">
                <div class="me-home__cycle-top">
                    <span class="me-home__step">02</span>
                    <span class="me-home__cycle-icon me-home__cycle-icon--blue" aria-hidden="true"><em class="icon ni ni-activity-round-fill"></em></span>
                </div>
                <p class="me-home__cycle-label">Implement &amp; monitor</p>
                <h3>Keep delivery connected to the plan</h3>
                <p class="me-home__cycle-copy">Coordinate projects and implementation activities as work moves forward.</p>
                <div class="me-home__cycle-links">
                    @can('projects.index')
                        <a href="{{ route('projects.index') }}">Manage projects <em class="icon ni ni-arrow-right" aria-hidden="true"></em></a>
                    @endcan
                </div>
            </article>

            <article class="me-home__cycle-card">
                <div class="me-home__cycle-top">
                    <span class="me-home__step">03</span>
                    <span class="me-home__cycle-icon me-home__cycle-icon--amber" aria-hidden="true"><em class="icon ni ni-reports"></em></span>
                </div>
                <p class="me-home__cycle-label">Measure &amp; learn</p>
                <h3>Turn evidence into useful decisions</h3>
                <p class="me-home__cycle-copy">Explore programme, project, and logframe reporting to understand progress and results.</p>
                <div class="me-home__cycle-links">
                    @can('reports')
                        <a href="{{ route('reportsindex') }}">Open reports <em class="icon ni ni-arrow-right" aria-hidden="true"></em></a>
                    @endcan
                </div>
            </article>
        </div>
    </section>

    <section class="me-home__support" aria-label="Workspace support">
        <div class="me-home__support-copy">
            <span class="me-home__support-icon" aria-hidden="true"><em class="icon ni ni-bell"></em></span>
            <div>
                <h2>Stay up to date</h2>
                <p>
                    @if ($notificationcount > 0)
                        You have {{ $notificationcount }} pending {{ \Illuminate\Support\Str::plural('notification', $notificationcount) }} to review.
                    @else
                        You’re all caught up. New workspace updates will appear here.
                    @endif
                </p>
            </div>
        </div>
        <a href="{{ url('barnotifications') }}">View invitations &amp; updates <em class="icon ni ni-arrow-right" aria-hidden="true"></em></a>
    </section>
</main>
@endsection

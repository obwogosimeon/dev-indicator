@extends('layouts.apps')

@section('content')
<main class="container-fluid admin-page program-detail-page">
    <header class="admin-page__header">
        <div>
            <p class="admin-page__eyebrow">Planning schedule</p>
            <h1 class="admin-page__title">{{ $yearshow->year_name }}</h1>
            <p class="admin-page__description">Financial year details and reporting period.</p>
        </div>
        <div class="admin-page__actions">
            @if ($yearshow->program_id)
                <a href="{{ route('programs.show', $yearshow->program_id) }}" class="admin-page__button-secondary">
                    <em class="icon ni ni-arrow-left" aria-hidden="true"></em>
                    Back to programme
                </a>
            @else
                <a href="{{ route('years.index') }}" class="admin-page__button-secondary">All financial years</a>
            @endif
            <a href="{{ route('years.edit', $yearshow->id) }}" class="admin-page__button">
                <em class="icon ni ni-edit" aria-hidden="true"></em>
                Edit financial year
            </a>
        </div>
    </header>

    <section class="admin-page__card">
        <div class="admin-page__card-head">
            <div>
                <h2>Financial year details</h2>
                <p>The fiscal date range configured for this period.</p>
            </div>
        </div>
        <dl class="admin-page__detail-grid program-resource__detail-grid">
            <div>
                <dt>Financial year</dt>
                <dd>{{ $yearshow->year_name }}</dd>
            </div>
            <div>
                <dt>Programme</dt>
                <dd>{{ optional($yearshow->program)->program_name ?: 'Not linked' }}</dd>
            </div>
            <div>
                <dt>Start date</dt>
                <dd>{{ $yearshow->start_date ? \Carbon\Carbon::parse($yearshow->start_date)->format('M j, Y') : '—' }}</dd>
            </div>
            <div>
                <dt>End date</dt>
                <dd>{{ $yearshow->end_date ? \Carbon\Carbon::parse($yearshow->end_date)->format('M j, Y') : '—' }}</dd>
            </div>
        </dl>
    </section>
</main>
@endsection

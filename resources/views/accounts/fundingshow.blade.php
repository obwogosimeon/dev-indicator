@extends('layouts.apps')

@section('content')
<main class="container-fluid admin-page program-detail-page">
    <header class="admin-page__header">
        <div>
            <p class="admin-page__eyebrow">Programme resources</p>
            <h1 class="admin-page__title">{{ $fundingshow->funding_name }}</h1>
            <p class="admin-page__description">Funding stream details and reporting configuration.</p>
        </div>
        <div class="admin-page__actions">
            @if ($fundingshow->program_id)
                <a href="{{ route('programs.show', $fundingshow->program_id) }}" class="admin-page__button-secondary">
                    <em class="icon ni ni-arrow-left" aria-hidden="true"></em>
                    Back to programme
                </a>
            @else
                <a href="{{ route('fundingindex') }}" class="admin-page__button-secondary">All funding</a>
            @endif
            <a href="{{ route('funding.edit', $fundingshow->id) }}" class="admin-page__button">
                <em class="icon ni ni-edit" aria-hidden="true"></em>
                Edit funding
            </a>
        </div>
    </header>

    <section class="admin-page__card">
        <div class="admin-page__card-head">
            <div>
                <h2>Funding information</h2>
                <p>Configuration used to classify programme resources.</p>
            </div>
            @if ($fundingshow->status === '01')
                <span class="admin-page__badge">Active</span>
            @else
                <span class="admin-page__badge admin-page__badge--muted">Inactive</span>
            @endif
        </div>
        <dl class="admin-page__detail-grid program-resource__detail-grid">
            <div>
                <dt>Funding name</dt>
                <dd>{{ $fundingshow->funding_name }}</dd>
            </div>
            <div>
                <dt>Funding type</dt>
                <dd>{{ $fundingshow->funding_type }}</dd>
            </div>
            <div>
                <dt>Used for expenditure</dt>
                <dd>{{ $fundingshow->expenditure }}</dd>
            </div>
            <div>
                <dt>Variable name</dt>
                <dd>{{ $fundingshow->variable_name }}</dd>
            </div>
            <div class="program-resource__detail-full">
                <dt>Description</dt>
                <dd>{{ $fundingshow->description ?: 'No description provided.' }}</dd>
            </div>
        </dl>
    </section>
</main>
@endsection

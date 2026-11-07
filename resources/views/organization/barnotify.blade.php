@extends('layouts.apps')

@section('content')
<main class="container-fluid admin-page">
    <header class="admin-page__header">
        <div>
            <p class="admin-page__eyebrow">Workspace access</p>
            <h1 class="admin-page__title">Invitations</h1>
            <p class="admin-page__description">Review organization invitations and track their current status.</p>
        </div>
        <a href="{{ route('organizations.index') }}" class="admin-page__button-secondary">
            <em class="icon ni ni-building" aria-hidden="true"></em>
            Organizations
        </a>
    </header>

    @if (session('success'))
        <div class="alert alert-success" role="status">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <section class="admin-page__stats" aria-label="Invitation summary">
        <div class="admin-page__stat">
            <span class="admin-page__stat-icon admin-page__stat-icon--teal"><em class="icon ni ni-mail" aria-hidden="true"></em></span>
            <div><strong>{{ $barnotifies->count() }}</strong><span>Total invitations</span></div>
        </div>
        <div class="admin-page__stat">
            <span class="admin-page__stat-icon admin-page__stat-icon--amber"><em class="icon ni ni-clock" aria-hidden="true"></em></span>
            <div><strong>{{ $barnotifies->where('status', '01')->count() }}</strong><span>Awaiting review</span></div>
        </div>
        <div class="admin-page__stat">
            <span class="admin-page__stat-icon admin-page__stat-icon--green"><em class="icon ni ni-check-circle" aria-hidden="true"></em></span>
            <div><strong>{{ $barnotifies->where('status', '02')->count() }}</strong><span>Accepted</span></div>
        </div>
    </section>

    <section class="admin-page__card" aria-label="Organization invitations">
        <div class="admin-page__card-head">
            <div>
                <h2>Invitation activity</h2>
                <p>{{ $barnotifies->count() }} {{ \Illuminate\Support\Str::plural('invitation', $barnotifies->count()) }}</p>
            </div>
        </div>
        <div class="table-responsive admin-page__table-wrap">
            <table class="table admin-page__table admin-page__table--cards">
                <thead>
                    <tr>
                        <th>Invitation</th>
                        <th>Organization</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th><span class="sr-only">Actions</span></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barnotifies as $invitation)
                        <tr>
                            <td data-label="Invitation">
                                <strong>{{ $invitation->type ?: 'Organization invitation' }}</strong>
                                <span class="admin-page__table-secondary">Reference #{{ $invitation->id }}</span>
                            </td>
                            <td data-label="Organization">{{ $invitation->organizationfrom ?: 'Organization not specified' }}</td>
                            <td class="admin-page__description-cell" data-label="Description">{{ $invitation->description ?: 'No additional details' }}</td>
                            <td data-label="Status">
                                @if ($invitation->status === '01')
                                    <span class="admin-page__badge admin-page__badge--amber">Pending review</span>
                                @elseif ($invitation->status === '02')
                                    <span class="admin-page__badge admin-page__badge--green">Accepted</span>
                                @elseif ($invitation->status === '03')
                                    <span class="admin-page__badge admin-page__badge--red">Rejected</span>
                                @elseif ($invitation->status === '04')
                                    <span class="admin-page__badge admin-page__badge--neutral">Closed</span>
                                @else
                                    <span class="admin-page__badge admin-page__badge--neutral">Unknown</span>
                                @endif
                            </td>
                            <td data-label="Actions">
                                <a class="admin-page__action" href="{{ url('managebarnotify/'.$invitation->id) }}">Review</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if ($barnotifies->isEmpty())
            <p class="admin-page__empty">You do not have any organization invitations yet.</p>
        @endif
    </section>
</main>
@endsection

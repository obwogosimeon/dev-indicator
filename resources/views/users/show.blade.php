@extends('layouts.apps')

@section('content')
<main class="container-fluid admin-page">
    <header class="admin-page__header">
        <div>
            <p class="admin-page__eyebrow">Workspace access</p>
            <h1 class="admin-page__title">{{ trim($user->name . ' ' . $user->last_name) ?: $user->name }}</h1>
            <p class="admin-page__description">Member profile and assigned access.</p>
        </div>
        <div class="admin-page__actions">
            <a href="{{ route('users.index') }}" class="admin-page__button-secondary">
                <em class="icon ni ni-arrow-left" aria-hidden="true"></em>
                All members
            </a>
            <a href="{{ route('users.edit', $user->id) }}" class="admin-page__button">Edit member</a>
        </div>
    </header>

    <section class="admin-page__card" aria-labelledby="member-profile-title">
        <div class="admin-page__card-head">
            <div>
                <h2 id="member-profile-title">Profile details</h2>
                <p>Organization account information</p>
            </div>
        </div>
        <div class="admin-page__detail-grid">
            <div class="admin-page__detail">
                <span class="admin-page__detail-label">First name</span>
                <span class="admin-page__detail-value">{{ $user->name }}</span>
            </div>
            <div class="admin-page__detail">
                <span class="admin-page__detail-label">Last name</span>
                <span class="admin-page__detail-value">{{ $user->last_name ?: '—' }}</span>
            </div>
            <div class="admin-page__detail">
                <span class="admin-page__detail-label">Email address</span>
                <span class="admin-page__detail-value">{{ $user->email }}</span>
            </div>
            <div class="admin-page__detail">
                <span class="admin-page__detail-label">Organization</span>
                <span class="admin-page__detail-value">{{ $user->organization_name ?: '—' }}</span>
            </div>
            <div class="admin-page__detail admin-page__field--full">
                <span class="admin-page__detail-label">Assigned roles</span>
                <span class="admin-page__detail-value">
                    @forelse ($user->getRoleNames() as $roleName)
                        <span class="admin-page__badge">{{ $roleName }}</span>
                    @empty
                        No role assigned
                    @endforelse
                </span>
            </div>
        </div>
    </section>
</main>
@endsection

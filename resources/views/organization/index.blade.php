@extends('layouts.apps')

@section('content')
<main class="container-fluid admin-page">
    <header class="admin-page__header">
        <div>
            <p class="admin-page__eyebrow">Organization management</p>
            <h1 class="admin-page__title">Organizations</h1>
            <p class="admin-page__description">Manage your organization and its affiliated teams.</p>
        </div>
        <a href="{{ route('organizations.create') }}" class="admin-page__button">
            <em class="icon ni ni-plus" aria-hidden="true"></em>
            Add organization
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

    <section class="admin-page__stats" aria-label="Organization summary">
        <div class="admin-page__stat">
            <span class="admin-page__stat-icon admin-page__stat-icon--teal"><em class="icon ni ni-building" aria-hidden="true"></em></span>
            <div><strong>{{ $organizations->count() }}</strong><span>Organizations</span></div>
        </div>
        <div class="admin-page__stat">
            <span class="admin-page__stat-icon admin-page__stat-icon--blue"><em class="icon ni ni-network" aria-hidden="true"></em></span>
            <div><strong>{{ $organizations->where('id', '!=', Auth::user()->organization_id)->count() }}</strong><span>Affiliates</span></div>
        </div>
        <div class="admin-page__stat">
            <span class="admin-page__stat-icon admin-page__stat-icon--green"><em class="icon ni ni-check-circle" aria-hidden="true"></em></span>
            <div><strong>{{ $organizations->where('status', '04')->count() }}</strong><span>Active</span></div>
        </div>
    </section>

    <section class="admin-page__card" aria-label="Organizations">
        <div class="admin-page__card-head">
            <div>
                <h2>Organization directory</h2>
                <p>{{ $organizations->count() }} {{ \Illuminate\Support\Str::plural('organization', $organizations->count()) }} in your workspace</p>
            </div>
        </div>
        <div class="table-responsive admin-page__table-wrap">
            <table class="table admin-page__table admin-page__table--cards">
                <thead>
                    <tr>
                        <th>Organization</th>
                        <th>Relationship</th>
                        <th>Access code</th>
                        <th>Status</th>
                        <th><span class="sr-only">Actions</span></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($organizations as $organization)
                        <tr>
                            <td data-label="Organization">
                                <a href="{{ route('organizations.show', $organization->id) }}">{{ $organization->organization_name }}</a>
                                <span class="admin-page__table-secondary">Organization workspace</span>
                            </td>
                            <td data-label="Relationship">
                                <span class="admin-page__badge {{ $organization->id == Auth::user()->organization_id ? 'admin-page__badge--blue' : '' }}">
                                    {{ $organization->id == Auth::user()->organization_id ? 'Parent organization' : 'Affiliate' }}
                                </span>
                            </td>
                            <td data-label="Access code">{{ $organization->access_code ?: '—' }}</td>
                            <td data-label="Status">
                                @if ($organization->status === '04')
                                    <span class="admin-page__badge admin-page__badge--green">Active</span>
                                @elseif ($organization->status === '01')
                                    <span class="admin-page__badge admin-page__badge--amber">Draft</span>
                                @else
                                    <span class="admin-page__badge admin-page__badge--neutral">Pending</span>
                                @endif
                            </td>
                            <td data-label="Actions">
                                <div class="admin-page__actions">
                                    <a class="admin-page__action" href="{{ route('organizations.show', $organization->id) }}">Manage</a>
                                    <a class="admin-page__action" href="{{ route('organizations.edit', $organization->id) }}">Edit</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if ($organizations->isEmpty())
            <p class="admin-page__empty">No organizations are available in your workspace yet.</p>
        @endif
    </section>
</main>
@endsection

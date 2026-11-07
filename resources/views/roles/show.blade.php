@extends('layouts.apps')

@section('content')
<main class="container-fluid admin-page">
    <header class="admin-page__header">
        <div>
            <p class="admin-page__eyebrow">Access control</p>
            <h1 class="admin-page__title">{{ $role->name }}</h1>
            <p class="admin-page__description">Review the permissions assigned to this role.</p>
        </div>
        <div class="admin-page__actions">
            <a href="{{ route('roles.index') }}" class="admin-page__button-secondary">
                <em class="icon ni ni-arrow-left" aria-hidden="true"></em>
                All roles
            </a>
            <a href="{{ route('roles.edit', $role->id) }}" class="admin-page__button">Edit role</a>
        </div>
    </header>

    <section class="admin-page__card" aria-labelledby="role-permissions-title">
        <div class="admin-page__card-head">
            <div>
                <h2 id="role-permissions-title">Assigned permissions</h2>
                <p>{{ $rolePermissions->count() }} {{ \Illuminate\Support\Str::plural('permission', $rolePermissions->count()) }}</p>
            </div>
        </div>
        <div class="admin-page__detail-grid">
            @forelse ($rolePermissions as $permission)
                <div class="admin-page__detail">
                    <span class="admin-page__detail-label">{{ $permission->category ?: 'Permission' }}</span>
                    <span class="admin-page__detail-value">{{ $permission->alias ?: $permission->name }}</span>
                    <span class="admin-page__field-hint">{{ $permission->name }}</span>
                </div>
            @empty
                <p class="admin-page__empty">No permissions are assigned to this role.</p>
            @endforelse
        </div>
    </section>
</main>
@endsection

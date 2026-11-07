@extends('layouts.apps')

@section('content')
<main class="container-fluid admin-page">
    <header class="admin-page__header">
        <div>
            <p class="admin-page__eyebrow">Access control</p>
            <h1 class="admin-page__title">Permissions</h1>
            <p class="admin-page__description">Review the actions that can be assigned to roles across the workspace.</p>
        </div>
        <a href="{{ route('permissions.create') }}" class="admin-page__button">
            <em class="icon ni ni-plus" aria-hidden="true"></em>
            Add permission
        </a>
    </header>

    @if (session('success'))
        <div class="alert alert-success" role="status">{{ session('success') }}</div>
    @endif

    <section class="admin-page__card" aria-label="Permissions list">
        <div class="admin-page__card-head">
            <div>
                <h2>Permission directory</h2>
                <p>{{ $permissions->count() }} {{ \Illuminate\Support\Str::plural('permission', $permissions->count()) }} available</p>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table admin-page__table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Permission</th>
                        <th>Display name</th>
                        <th>Category</th>
                        <th>Guard</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $permission)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong>{{ $permission->name }}</strong></td>
                            <td>{{ $permission->alias }}</td>
                            <td><span class="admin-page__badge">{{ $permission->category }}</span></td>
                            <td>{{ $permission->guard_name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if ($permissions->isEmpty())
            <p class="admin-page__empty">No permissions have been created yet.</p>
        @endif
    </section>
</main>
@endsection

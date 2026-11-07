@extends('layouts.apps')

@section('content')
<main class="container-fluid admin-page">
    <header class="admin-page__header">
        <div>
            <p class="admin-page__eyebrow">Workspace access</p>
            <h1 class="admin-page__title">Members</h1>
            <p class="admin-page__description">Manage team members and their roles in your organization.</p>
        </div>
        <a href="{{ route('users.create') }}" class="admin-page__button">
            <em class="icon ni ni-plus" aria-hidden="true"></em>
            Add member
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

    <section class="admin-page__card" aria-label="Organization members">
        <div class="admin-page__card-head">
            <div>
                <h2>Organization members</h2>
                <p>{{ $data->count() }} {{ \Illuminate\Support\Str::plural('member', $data->count()) }}</p>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table admin-page__table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Member</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <a href="{{ route('users.show', $user->id) }}">
                                    {{ trim($user->name . ' ' . $user->last_name) ?: $user->name }}
                                </a>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @forelse ($user->getRoleNames() as $roleName)
                                    <span class="admin-page__badge">{{ $roleName }}</span>
                                @empty
                                    <span class="text-soft">No role assigned</span>
                                @endforelse
                            </td>
                            <td>
                                <div class="admin-page__actions">
                                    <a class="admin-page__action" href="{{ route('users.show', $user->id) }}">View</a>
                                    <a class="admin-page__action" href="{{ route('users.edit', $user->id) }}">Edit</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if ($data->isEmpty())
            <p class="admin-page__empty">No members are listed for this organization yet.</p>
        @endif
    </section>
</main>
@endsection

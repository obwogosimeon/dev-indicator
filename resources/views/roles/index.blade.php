@extends('layouts.apps')

@section('content')
<main class="container-fluid admin-page">
    <header class="admin-page__header">
        <div>
            <p class="admin-page__eyebrow">Access control</p>
            <h1 class="admin-page__title">Roles</h1>
            <p class="admin-page__description">Manage role profiles and the permissions assigned to each one.</p>
        </div>
        <a href="{{ route('roles.create') }}" class="admin-page__button">
            <em class="icon ni ni-plus" aria-hidden="true"></em>
            Create role
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

    <section class="admin-page__card" aria-label="Roles list">
        <div class="admin-page__card-head">
            <div>
                <h2>Role directory</h2>
                <p>{{ $roles->total() }} {{ \Illuminate\Support\Str::plural('role', $roles->total()) }} configured</p>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table admin-page__table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $roles->firstItem() + $loop->index }}</td>
                            <td><strong>{{ $role->name }}</strong></td>
                            <td>
                                <div class="admin-page__actions">
                                    <a class="admin-page__action" href="{{ route('roles.show', $role->id) }}">View</a>
                                    <a class="admin-page__action" href="{{ route('roles.edit', $role->id) }}">Edit</a>
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id], 'onsubmit' => "return confirm('Delete this role?')"]) !!}
                                        <button type="submit" class="admin-page__action admin-page__action--danger">Delete</button>
                                    {!! Form::close() !!}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if ($roles->isEmpty())
            <p class="admin-page__empty">No roles have been created yet.</p>
        @endif
        @if ($roles->hasPages())
            <div class="p-3">{{ $roles->links() }}</div>
        @endif
    </section>
</main>
@endsection

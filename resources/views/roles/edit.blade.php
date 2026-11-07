@extends('layouts.apps')

@section('content')
<main class="container-fluid admin-page">
    <header class="admin-page__header">
        <div>
            <p class="admin-page__eyebrow">Access control</p>
            <h1 class="admin-page__title">Edit role</h1>
            <p class="admin-page__description">Update the role name and its assigned permissions.</p>
        </div>
        <a href="{{ route('roles.index') }}" class="admin-page__button-secondary">
            <em class="icon ni ni-arrow-left" aria-hidden="true"></em>
            Back to roles
        </a>
    </header>

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <section class="admin-page__card admin-page__form-card admin-page__form-card--wide">
        <div class="admin-page__card-head">
            <div>
                <h2>Role details</h2>
                <p>Changes take effect for members assigned to this role.</p>
            </div>
        </div>
        <form method="POST" action="{{ route('roles.update', $role->id) }}" class="admin-page__form">
            @csrf
            @method('PATCH')
            <div class="admin-page__form-grid">
                <div class="admin-page__field admin-page__field--full">
                    <label for="role-name">Role name</label>
                    <input id="role-name" type="text" name="name" value="{{ old('name', $role->name) }}" class="form-control" required>
                </div>
                <div class="admin-page__field admin-page__field--full">
                    <label>Permissions</label>
                    @if (count($permission))
                        <div class="admin-page__permission-list">
                            @foreach ($permission as $value)
                                <label class="admin-page__permission">
                                    <input type="checkbox" name="permission[]" value="{{ $value->id }}"{{ in_array($value->id, old('permission', $rolePermissions)) ? ' checked' : '' }}>
                                    <span>{{ $value->alias ?: $value->name }}<small>{{ $value->name }}</small></span>
                                </label>
                            @endforeach
                        </div>
                    @else
                        <p class="admin-page__field-hint">No permissions have been created yet.</p>
                    @endif
                </div>
            </div>
            <div class="admin-page__form-footer">
                <button type="submit" class="admin-page__button">Save changes</button>
                <a href="{{ route('roles.index') }}" class="admin-page__button-secondary">Cancel</a>
            </div>
        </form>
    </section>
</main>
@endsection

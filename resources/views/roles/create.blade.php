@extends('layouts.apps')

@section('content')
<main class="container-fluid admin-page">
    <header class="admin-page__header">
        <div>
            <p class="admin-page__eyebrow">Access control</p>
            <h1 class="admin-page__title">Create role</h1>
            <p class="admin-page__description">Give a role a clear name and choose the actions its members can perform.</p>
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
                <p>Assign only the permissions needed for this role.</p>
            </div>
        </div>
        <form method="POST" action="{{ route('roles.store') }}" class="admin-page__form">
            @csrf
            <div class="admin-page__form-grid">
                <div class="admin-page__field admin-page__field--full">
                    <label for="role-name">Role name</label>
                    <input id="role-name" type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="e.g. Programme manager" required>
                </div>
                <div class="admin-page__field admin-page__field--full">
                    <label>Permissions</label>
                    @if (count($permission))
                        <div class="admin-page__permission-list">
                            @foreach ($permission as $value)
                                <label class="admin-page__permission">
                                    <input type="checkbox" name="permission[]" value="{{ $value->id }}"{{ in_array($value->id, old('permission', [])) ? ' checked' : '' }}>
                                    <span>{{ $value->alias ?: $value->name }}<small>{{ $value->name }}</small></span>
                                </label>
                            @endforeach
                        </div>
                    @else
                        <p class="admin-page__field-hint">Create permissions before setting up a role.</p>
                    @endif
                </div>
            </div>
            <div class="admin-page__form-footer">
                <button type="submit" class="admin-page__button">Create role</button>
                <a href="{{ route('roles.index') }}" class="admin-page__button-secondary">Cancel</a>
            </div>
        </form>
    </section>
</main>
@endsection

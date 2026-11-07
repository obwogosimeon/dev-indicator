@extends('layouts.apps')

@section('content')
<main class="container-fluid admin-page">
    <header class="admin-page__header">
        <div>
            <p class="admin-page__eyebrow">Access control</p>
            <h1 class="admin-page__title">Add permission</h1>
            <p class="admin-page__description">Define an action that can be assigned to workspace roles.</p>
        </div>
        <a href="{{ route('permissions.index') }}" class="admin-page__button-secondary">
            <em class="icon ni ni-arrow-left" aria-hidden="true"></em>
            Back to permissions
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
                <h2>Permission details</h2>
                <p>Use a unique action name and a clear display label.</p>
            </div>
        </div>
        <form method="POST" action="{{ route('permissions.store') }}" class="admin-page__form">
            @csrf
            <div class="admin-page__form-grid">
                <div class="admin-page__field">
                    <label for="permission-name">Permission name</label>
                    <input id="permission-name" type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="e.g. projects.index" required>
                </div>
                <div class="admin-page__field">
                    <label for="permission-alias">Display name</label>
                    <input id="permission-alias" type="text" name="alias" value="{{ old('alias') }}" class="form-control" placeholder="e.g. View projects" required>
                </div>
                <div class="admin-page__field">
                    <label for="permission-category">Category</label>
                    <select id="permission-category" name="category" class="form-control" required>
                        <option value="">Select a category</option>
                        @foreach (['Project', 'Program', 'Logframe', 'Account', 'Currency', 'Year', 'MNE', 'Security', 'Structure', 'Staff'] as $category)
                            <option value="{{ $category }}"{{ old('category') === $category ? ' selected' : '' }}>{{ $category }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="admin-page__field">
                    <label for="permission-guard">Guard</label>
                    <input id="permission-guard" type="text" name="guard_name" value="{{ old('guard_name', 'web') }}" class="form-control" required>
                    <span class="admin-page__field-hint">Most workspace permissions use the web guard.</span>
                </div>
            </div>
            <div class="admin-page__form-footer">
                <button type="submit" class="admin-page__button">Create permission</button>
                <a href="{{ route('permissions.index') }}" class="admin-page__button-secondary">Cancel</a>
            </div>
        </form>
    </section>
</main>
@endsection

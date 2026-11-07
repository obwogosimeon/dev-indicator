@extends('layouts.apps')

@section('content')
<main class="container-fluid admin-page">
    <header class="admin-page__header">
        <div>
            <p class="admin-page__eyebrow">Workspace access</p>
            <h1 class="admin-page__title">Edit member</h1>
            <p class="admin-page__description">Update {{ $user->name }}’s profile and role assignment.</p>
        </div>
        <a href="{{ route('users.index') }}" class="admin-page__button-secondary">
            <em class="icon ni ni-arrow-left" aria-hidden="true"></em>
            Back to members
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
                <h2>Member details</h2>
                <p>Leave the password fields blank to keep the current password.</p>
            </div>
        </div>
        {!! Form::model($user, ['method' => 'PATCH', 'route' => ['users.update', $user->id], 'class' => 'admin-page__form']) !!}
            @csrf
            <div class="admin-page__form-grid">
                <div class="admin-page__field">
                    <label for="member-name">First name</label>
                    <input id="member-name" type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
                </div>
                <div class="admin-page__field">
                    <label for="member-last-name">Last name</label>
                    <input id="member-last-name" type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}" class="form-control">
                </div>
                <div class="admin-page__field">
                    <label for="member-email">Email address</label>
                    <input id="member-email" type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required autocomplete="email">
                </div>
                <div class="admin-page__field">
                    <label for="member-roles">Roles</label>
                    {!! Form::select('roles[]', $roles, old('roles', $userRole), ['id' => 'member-roles', 'class' => 'form-control', 'multiple' => true, 'required' => true]) !!}
                    <span class="admin-page__field-hint">Use Ctrl or Command to select multiple roles.</span>
                </div>
                <div class="admin-page__field">
                    <label for="member-password">New password</label>
                    <input id="member-password" type="password" name="password" class="form-control" autocomplete="new-password">
                </div>
                <div class="admin-page__field">
                    <label for="member-confirm-password">Confirm new password</label>
                    <input id="member-confirm-password" type="password" name="confirm-password" class="form-control" autocomplete="new-password">
                </div>
            </div>
            <div class="admin-page__form-footer">
                <button type="submit" class="admin-page__button">Save changes</button>
                <a href="{{ route('users.index') }}" class="admin-page__button-secondary">Cancel</a>
            </div>
        {!! Form::close() !!}
    </section>
</main>
@endsection

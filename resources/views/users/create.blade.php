@extends('layouts.apps')

@section('content')
<main class="container-fluid admin-page">
    <header class="admin-page__header">
        <div>
            <p class="admin-page__eyebrow">Workspace access</p>
            <h1 class="admin-page__title">Add a member</h1>
            <p class="admin-page__description">Invite a colleague and assign their initial workspace role.</p>
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
                <p>An invitation will be sent to the email address provided.</p>
            </div>
        </div>
        {!! Form::open(['route' => 'users.store', 'method' => 'POST', 'class' => 'admin-page__form']) !!}
            @csrf
            <div class="admin-page__form-grid">
                <div class="admin-page__field">
                    <label for="member-name">First name</label>
                    <input id="member-name" type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="First name" required>
                </div>
                <div class="admin-page__field">
                    <label for="member-last-name">Last name</label>
                    <input id="member-last-name" type="text" name="last_name" value="{{ old('last_name') }}" class="form-control" placeholder="Last name" required>
                </div>
                <div class="admin-page__field">
                    <label for="member-email">Email address</label>
                    <input id="member-email" type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="name@organization.org" required autocomplete="email">
                </div>
                <div class="admin-page__field">
                    <label for="member-role">Role</label>
                    <select id="member-role" name="roles" class="form-control" required>
                        <option value="">Select a role</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}"{{ old('roles') === $role->name ? ' selected' : '' }}>{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <input type="hidden" name="organization_id" value="{{ Auth::user()->organization_id }}">
            <input type="hidden" name="organization_name" value="{{ Auth::user()->organization_name }}">
            <input type="hidden" name="created_by" value="{{ Auth::id() }}">

            <div class="admin-page__form-footer">
                <button type="submit" class="admin-page__button">
                    <em class="icon ni ni-send" aria-hidden="true"></em>
                    Send invitation
                </button>
                <a href="{{ route('users.index') }}" class="admin-page__button-secondary">Cancel</a>
            </div>
        {!! Form::close() !!}
    </section>
</main>
@endsection

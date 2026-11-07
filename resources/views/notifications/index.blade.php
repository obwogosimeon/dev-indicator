@extends('layouts.apps')
@section('content')
<main class="container-fluid admin-page">
    <header class="admin-page__header">
        <div>
            <p class="admin-page__eyebrow">System configuration</p>
            <h1 class="admin-page__title">Email notifications</h1>
            <p class="admin-page__description">Manage the email delivery settings configured for your organization.</p>
        </div>
        <a href="{{ route('notificationcreate') }}" class="admin-page__button">
            <em class="icon ni ni-plus" aria-hidden="true"></em>
            Add email configuration
        </a>
    </header>

    @if (session('success'))
        <div class="alert alert-success" role="status">{{ session('success') }}</div>
    @endif

    <section class="admin-page__card" aria-label="Email configurations">
        <div class="admin-page__card-head">
            <div>
                <h2>Configured mail servers</h2>
                <p>{{ $notifications->count() }} {{ \Illuminate\Support\Str::plural('configuration', $notifications->count()) }}</p>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table admin-page__table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Organization</th>
                        <th>Email address</th>
                        <th>Mail host</th>
                        <th>Driver</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($notifications as $notification)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ optional($notification->organization)->organization_name ?: 'Organization not assigned' }}</td>
                            <td>{{ $notification->username }}</td>
                            <td>{{ $notification->host }}</td>
                            <td><span class="admin-page__badge">{{ $notification->driver }}</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if ($notifications->isEmpty())
            <p class="admin-page__empty">No email configurations have been added yet.</p>
        @endif
    </section>
</main>
@endsection
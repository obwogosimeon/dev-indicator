@extends('layouts.apps')

@section('content')
<main class="container-fluid admin-page">
    <header class="admin-page__header">
        <div>
            <p class="admin-page__eyebrow">Portfolio management</p>
            <h1 class="admin-page__title">Programmes</h1>
            <p class="admin-page__description">Plan, coordinate, and monitor your organization’s programmes.</p>
        </div>
        <a href="{{ route('programs.create') }}" class="admin-page__button">
            <em class="icon ni ni-plus" aria-hidden="true"></em>
            Add programme
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

    <section class="admin-page__stats" aria-label="Programme summary">
        <div class="admin-page__stat">
            <span class="admin-page__stat-icon admin-page__stat-icon--teal"><em class="icon ni ni-grid-alt" aria-hidden="true"></em></span>
            <div><strong>{{ $programs->count() }}</strong><span>Total programmes</span></div>
        </div>
        <div class="admin-page__stat">
            <span class="admin-page__stat-icon admin-page__stat-icon--green"><em class="icon ni ni-check-circle" aria-hidden="true"></em></span>
            <div><strong>{{ $programs->where('status', '00')->count() }}</strong><span>Active</span></div>
        </div>
        <div class="admin-page__stat">
            <span class="admin-page__stat-icon admin-page__stat-icon--amber"><em class="icon ni ni-clock" aria-hidden="true"></em></span>
            <div><strong>{{ $programs->where('status', '01')->count() }}</strong><span>Unverified</span></div>
        </div>
    </section>

    <section class="admin-page__card" aria-label="Programmes">
        <div class="admin-page__card-head">
            <div>
                <h2>Programme directory</h2>
                <p>{{ $programs->count() }} {{ \Illuminate\Support\Str::plural('programme', $programs->count()) }} in your organization</p>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table admin-page__table">
                <thead>
                    <tr>
                        <th>Programme</th>
                        <th>Base currency</th>
                        <th>Duration</th>
                        <th>Status</th>
                        <th><span class="sr-only">Actions</span></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($programs as $program)
                        <tr>
                            <td>
                                <a href="{{ route('programs.show', $program->id) }}">{{ $program->program_name }}</a>
                                <span class="admin-page__table-secondary">Programme #{{ $program->id }}</span>
                            </td>
                            <td>{{ optional($program->basecurrency)->currency_name ?: 'Not set' }}</td>
                            <td>
                                {{ $program->start_date ? \Carbon\Carbon::parse($program->start_date)->format('M j, Y') : '—' }}
                                <span class="admin-page__date-separator">to</span>
                                {{ $program->end_date ? \Carbon\Carbon::parse($program->end_date)->format('M j, Y') : '—' }}
                            </td>
                            <td>
                                @if ($program->status === '00')
                                    <span class="admin-page__badge admin-page__badge--green">Active</span>
                                @elseif ($program->status === '01')
                                    <span class="admin-page__badge admin-page__badge--amber">Unverified</span>
                                @else
                                    <span class="admin-page__badge admin-page__badge--neutral">Pending</span>
                                @endif
                            </td>
                            <td>
                                <div class="admin-page__actions">
                                    <a class="admin-page__action" href="{{ route('programs.show', $program->id) }}">View</a>
                                    <a class="admin-page__action" href="{{ route('programs.edit', $program->id) }}">Edit</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if ($programs->isEmpty())
            <p class="admin-page__empty">No programmes have been created for your organization yet.</p>
        @endif
    </section>
</main>
@endsection

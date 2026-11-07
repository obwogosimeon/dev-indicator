@extends('layouts.apps')

@section('content')
<main class="container-fluid admin-page report-page">
    <header class="admin-page__header">
        <div>
            <p class="admin-page__eyebrow">Reports &amp; insights</p>
            <h1 class="admin-page__title">Programme reports</h1>
            <p class="admin-page__description">Review programme timelines and open reports for their associated projects.</p>
        </div>
        <a href="{{ route('reportsindex') }}" class="admin-page__button-secondary">
            <em class="icon ni ni-arrow-left" aria-hidden="true"></em>
            All reports
        </a>
    </header>

    <section class="admin-page__card">
        <div class="admin-page__card-head">
            <div>
                <h2>Programme portfolio</h2>
                <p>{{ $programs->count() }} {{ \Illuminate\Support\Str::plural('programme', $programs->count()) }}</p>
            </div>
            <a href="{{ route('programs.create') }}" class="admin-page__button-secondary">Create programme</a>
        </div>
        <div class="table-responsive">
            <table class="table admin-page__table report-page__table">
                <thead>
                    <tr>
                        <th>Programme</th>
                        <th>Reporting period</th>
                        <th>Projects</th>
                        <th>Project reports</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($programs as $program)
                        <tr>
                            <td>
                                <a href="{{ route('programs.show', $program->id) }}">{{ $program->program_name }}</a>
                                <small class="report-page__secondary">Programme #{{ $program->id }}</small>
                            </td>
                            <td>
                                @if ($program->start_date || $program->end_date)
                                    {{ $program->start_date ?: '—' }} <span class="report-page__date-separator">to</span> {{ $program->end_date ?: '—' }}
                                @else
                                    —
                                @endif
                            </td>
                            <td><span class="admin-page__badge">{{ $program->project->count() }} {{ \Illuminate\Support\Str::plural('project', $program->project->count()) }}</span></td>
                            <td>
                                @forelse ($program->project as $project)
                                    <a class="report-page__open-link" href="{{ route('projectreportshow', $project->id) }}">{{ $project->project_name }} <em class="icon ni ni-arrow-up-right" aria-hidden="true"></em></a>
                                @empty
                                    <span class="report-page__secondary">No linked projects</span>
                                @endforelse
                            </td>
                        </tr>
                    @endforeach
                    @if ($programs->isEmpty())
                        <tr><td colspan="4" class="admin-page__empty">No programmes are available yet.</td></tr>
                    @endif
                </tbody>
            </table>
        </div>
    </section>
</main>
@endsection

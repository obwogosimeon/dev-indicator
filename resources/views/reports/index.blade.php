@extends('layouts.apps')

@section('content')
<main class="container-fluid admin-page report-page">
    <header class="report-page__hero">
        <div>
            <p class="admin-page__eyebrow">Monitoring &amp; evaluation</p>
            <h1 class="admin-page__title">Reports &amp; insights</h1>
            <p class="admin-page__description">Explore reporting across your project portfolio, programmes, and results frameworks.</p>
        </div>
        <span class="report-page__hero-icon" aria-hidden="true"><em class="icon ni ni-reports"></em></span>
    </header>

    @if (session('success'))
        <div class="alert alert-success" role="status">{{ session('success') }}</div>
    @endif

    <section class="report-page__overview" aria-label="Reporting overview">
        <a href="#project-reports" class="report-page__metric">
            <span class="report-page__metric-icon report-page__metric-icon--teal" aria-hidden="true"><em class="icon ni ni-activity-round-fill"></em></span>
            <span><strong>{{ $projects->count() }}</strong><small>Projects</small></span>
            <em class="icon ni ni-arrow-up-right report-page__metric-arrow" aria-hidden="true"></em>
        </a>
        <a href="{{ route('programreports') }}" class="report-page__metric">
            <span class="report-page__metric-icon report-page__metric-icon--blue" aria-hidden="true"><em class="icon ni ni-cc-alt2-fill"></em></span>
            <span><strong>{{ $programCount }}</strong><small>Programmes</small></span>
            <em class="icon ni ni-arrow-up-right report-page__metric-arrow" aria-hidden="true"></em>
        </a>
        <a href="{{ route('logframereports') }}" class="report-page__metric">
            <span class="report-page__metric-icon report-page__metric-icon--violet" aria-hidden="true"><em class="icon ni ni-bulb"></em></span>
            <span><strong>{{ $logframeCount }}</strong><small>Results frameworks</small></span>
            <em class="icon ni ni-arrow-up-right report-page__metric-arrow" aria-hidden="true"></em>
        </a>
    </section>

    <section class="admin-page__card report-page__directory" id="project-reports" aria-labelledby="project-reports-title">
        <div class="admin-page__card-head">
            <div>
                <h2 id="project-reports-title">Project reports</h2>
                <p>Select a project to view its reporting templates and definitions.</p>
            </div>
            <span class="admin-page__badge">{{ $projects->count() }} {{ \Illuminate\Support\Str::plural('project', $projects->count()) }}</span>
        </div>
        <div class="table-responsive">
            <table class="table admin-page__table report-page__table">
                <thead>
                    <tr>
                        <th>Project</th>
                        <th>Programme</th>
                        <th>Reporting period</th>
                        <th>Status</th>
                        <th>Report</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr>
                            <td>
                                <strong>{{ $project->project_name }}</strong>
                                <small class="report-page__secondary">Project #{{ $project->id }}</small>
                            </td>
                            <td>{{ optional($project->program)->program_name ?: '—' }}</td>
                            <td>
                                @if ($project->start_date || $project->end_date)
                                    {{ $project->start_date ? \Carbon\Carbon::parse($project->start_date)->format('M j, Y') : '—' }} <span class="report-page__date-separator">to</span> {{ $project->end_date ? \Carbon\Carbon::parse($project->end_date)->format('M j, Y') : '—' }}
                                @else
                                    —
                                @endif
                            </td>
                            <td>
                                @if ($project->status)
                                    <span class="admin-page__badge">{{ $project->status }}</span>
                                @else
                                    <span class="report-page__secondary">Not specified</span>
                                @endif
                            </td>
                            <td><a class="report-page__open-link" href="{{ route('projectreportshow', $project->id) }}">Open report <em class="icon ni ni-arrow-right" aria-hidden="true"></em></a></td>
                        </tr>
                    @endforeach
                    @if ($projects->isEmpty())
                        <tr><td colspan="5" class="admin-page__empty">No projects are available for reporting yet.</td></tr>
                    @endif
                </tbody>
            </table>
        </div>
    </section>

    <section class="report-page__categories" aria-label="Other report categories">
        <a class="report-page__category" href="{{ route('programreports') }}">
            <span class="report-page__category-icon report-page__metric-icon--blue" aria-hidden="true"><em class="icon ni ni-cc-alt2-fill"></em></span>
            <span class="report-page__category-copy"><strong>Programme reports</strong><small>Review programme periods and linked projects.</small></span>
            <em class="icon ni ni-arrow-right report-page__category-arrow" aria-hidden="true"></em>
        </a>
        <a class="report-page__category" href="{{ route('logframereports') }}">
            <span class="report-page__category-icon report-page__metric-icon--violet" aria-hidden="true"><em class="icon ni ni-bulb"></em></span>
            <span class="report-page__category-copy"><strong>Results framework reports</strong><small>Browse logframes used to structure results.</small></span>
            <em class="icon ni ni-arrow-right report-page__category-arrow" aria-hidden="true"></em>
        </a>
    </section>
</main>
@endsection

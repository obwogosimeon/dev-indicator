@extends('layouts.apps')

@section('content')
<main class="container-fluid admin-page">
    <header class="admin-page__header">
        <div>
            <p class="admin-page__eyebrow">Portfolio management</p>
            <h1 class="admin-page__title">Projects</h1>
            <p class="admin-page__description">Track project delivery, reporting schedules, and results.</p>
        </div>
        @can('project.create')
            <a href="{{ route('projects.create') }}" class="admin-page__button">
                <em class="icon ni ni-plus" aria-hidden="true"></em>
                Add project
            </a>
        @endcan
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

    <section class="admin-page__stats" aria-label="Project summary">
        <div class="admin-page__stat">
            <span class="admin-page__stat-icon admin-page__stat-icon--teal"><em class="icon ni ni-folder" aria-hidden="true"></em></span>
            <div><strong>{{ $projects->count() }}</strong><span>Total projects</span></div>
        </div>
        <div class="admin-page__stat">
            <span class="admin-page__stat-icon admin-page__stat-icon--green"><em class="icon ni ni-check-circle" aria-hidden="true"></em></span>
            <div><strong>{{ $projects->where('status', '00')->count() }}</strong><span>Active</span></div>
        </div>
        <div class="admin-page__stat">
            <span class="admin-page__stat-icon admin-page__stat-icon--amber"><em class="icon ni ni-clock" aria-hidden="true"></em></span>
            <div><strong>{{ $projects->where('status', '01')->count() }}</strong><span>Unverified</span></div>
        </div>
    </section>

    <section class="admin-page__card" aria-label="Projects">
        <div class="admin-page__card-head">
            <div>
                <h2>Project directory</h2>
                <p>{{ $projects->count() }} {{ \Illuminate\Support\Str::plural('project', $projects->count()) }} assigned to you</p>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table admin-page__table">
                <thead>
                    <tr>
                        <th>Project</th>
                        <th>Programme / results framework</th>
                        <th>Reporting frequency</th>
                        <th>Status</th>
                        <th><span class="sr-only">Actions</span></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr>
                            <td>
                                <a href="{{ route('projects.show', $project->id) }}">{{ $project->project_name }}</a>
                                <span class="admin-page__table-secondary">Project #{{ $project->id }}</span>
                            </td>
                            <td>
                                @if ($project->logframe_id && $project->logframe_id !== '#')
                                    {{ optional($project->logframe)->logframe_name ?: 'Results framework unavailable' }}
                                    <span class="admin-page__table-secondary">Results framework</span>
                                @else
                                    {{ optional($project->program)->program_name ?: 'Programme unavailable' }}
                                    <span class="admin-page__table-secondary">Programme</span>
                                @endif
                            </td>
                            <td>{{ $project->reporting_frequency ?: 'Not set' }}</td>
                            <td>
                                @if ($project->status === '00')
                                    <span class="admin-page__badge admin-page__badge--green">Active</span>
                                @elseif ($project->status === '01')
                                    <span class="admin-page__badge admin-page__badge--amber">Unverified</span>
                                @else
                                    <span class="admin-page__badge admin-page__badge--neutral">Pending</span>
                                @endif
                            </td>
                            <td>
                                <div class="admin-page__actions">
                                    <a class="admin-page__action" href="{{ route('projects.show', $project->id) }}">View</a>
                                    <a class="admin-page__action" href="{{ route('projects.edit', $project->id) }}">Edit</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if ($projects->isEmpty())
            <p class="admin-page__empty">No projects are assigned to you yet.</p>
        @endif
    </section>
</main>
@endsection

@extends('layouts.apps')

@section('content')
<main class="container-fluid admin-page report-page">
    <header class="admin-page__header">
        <div>
            <p class="admin-page__eyebrow">Reports &amp; insights</p>
            <h1 class="admin-page__title">Results framework reports</h1>
            <p class="admin-page__description">Browse the logframes that define expected outcomes and connect to project reporting.</p>
        </div>
        <a href="{{ route('reportsindex') }}" class="admin-page__button-secondary">
            <em class="icon ni ni-arrow-left" aria-hidden="true"></em>
            All reports
        </a>
    </header>

    <section class="admin-page__card">
        <div class="admin-page__card-head">
            <div>
                <h2>Results frameworks</h2>
                <p>{{ $logrames->count() }} {{ \Illuminate\Support\Str::plural('framework', $logrames->count()) }}</p>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table admin-page__table report-page__table">
                <thead>
                    <tr>
                        <th>Framework</th>
                        <th>Linked projects</th>
                        <th>Project reports</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($logrames as $logframe)
                        <tr>
                            <td>
                                <strong>{{ $logframe->logframe_name }}</strong>
                                <small class="report-page__secondary">Framework #{{ $logframe->id }}</small>
                            </td>
                            <td><span class="admin-page__badge">{{ $logframe->project->count() }} {{ \Illuminate\Support\Str::plural('project', $logframe->project->count()) }}</span></td>
                            <td>
                                @forelse ($logframe->project as $project)
                                    <a class="report-page__open-link" href="{{ route('projectreportshow', $project->id) }}">{{ $project->project_name }} <em class="icon ni ni-arrow-up-right" aria-hidden="true"></em></a>
                                @empty
                                    <span class="report-page__secondary">No linked projects</span>
                                @endforelse
                            </td>
                        </tr>
                    @endforeach
                    @if ($logrames->isEmpty())
                        <tr><td colspan="3" class="admin-page__empty">No results frameworks are available yet.</td></tr>
                    @endif
                </tbody>
            </table>
        </div>
    </section>
</main>
@endsection

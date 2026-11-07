@extends('layouts.apps')

@section('content')
<main class="container-fluid admin-page project-form-page">
    <header class="admin-page__header">
        <div>
            <p class="admin-page__eyebrow">Portfolio management</p>
            <h1 class="admin-page__title">Edit project</h1>
            <p class="admin-page__description">Update the details and reporting schedule for {{ $projectedit->project_name }}.</p>
        </div>
        <div class="admin-page__actions">
            <a href="{{ route('projects.show', $projectedit->id) }}" class="admin-page__button-secondary">
                <em class="icon ni ni-eye" aria-hidden="true"></em>
                View project
            </a>
            <a href="{{ route('projects.index') }}" class="admin-page__button-secondary">
                <em class="icon ni ni-arrow-left" aria-hidden="true"></em>
                Back to projects
            </a>
        </div>
    </header>

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <strong>Please review the project details.</strong>
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <section class="admin-page__card admin-page__form-card admin-page__form-card--wide">
        <div class="admin-page__card-head">
            <div>
                <h2>Project information</h2>
                <p>Update the fields below and save your changes.</p>
            </div>
        </div>
        {!! Form::model($projectedit, ['method' => 'PATCH', 'route' => ['projects.update', $projectedit->id], 'class' => 'admin-page__form']) !!}
            @csrf
            <div class="admin-page__form-grid">
                <div class="admin-page__field admin-page__field--full">
                    <label for="project-name">Project name <span class="text-danger">*</span></label>
                    <input id="project-name" type="text" name="project_name" value="{{ old('project_name', $projectedit->project_name) }}" class="form-control{{ $errors->has('project_name') ? ' is-invalid' : '' }}" required>
                    @if ($errors->has('project_name'))
                        <span class="admin-page__field-error">{{ $errors->first('project_name') }}</span>
                    @endif
                </div>

                <div class="admin-page__field">
                    <label for="project-start-date">Start date <span class="text-danger">*</span></label>
                    <input id="project-start-date" type="date" name="start_date" value="{{ old('start_date', $projectedit->start_date) }}" class="form-control{{ $errors->has('start_date') ? ' is-invalid' : '' }}" required>
                    @if ($errors->has('start_date'))
                        <span class="admin-page__field-error">{{ $errors->first('start_date') }}</span>
                    @endif
                </div>

                <div class="admin-page__field">
                    <label for="project-end-date">End date <span class="text-danger">*</span></label>
                    <input id="project-end-date" type="date" name="end_date" value="{{ old('end_date', $projectedit->end_date) }}" class="form-control{{ $errors->has('end_date') ? ' is-invalid' : '' }}" required>
                    @if ($errors->has('end_date'))
                        <span class="admin-page__field-error">{{ $errors->first('end_date') }}</span>
                    @endif
                </div>

                <div class="admin-page__field">
                    <label for="project-frequency">Reporting frequency <span class="text-danger">*</span></label>
                    <?php $frequency = old('reporting_frequency', $projectedit->reporting_frequency); ?>
                    <select id="project-frequency" name="reporting_frequency" class="form-control{{ $errors->has('reporting_frequency') ? ' is-invalid' : '' }}" required>
                        <option value="">Select a frequency</option>
                        <option value="Monthly"{{ $frequency === 'Monthly' ? ' selected' : '' }}>Monthly</option>
                        <option value="BiMonthly"{{ $frequency === 'BiMonthly' ? ' selected' : '' }}>Bi-monthly</option>
                        <option value="Quaterly"{{ $frequency === 'Quaterly' ? ' selected' : '' }}>Quarterly</option>
                        <option value="SemiAnnual"{{ $frequency === 'SemiAnnual' ? ' selected' : '' }}>Semi-annual</option>
                        <option value="Annaul"{{ $frequency === 'Annaul' ? ' selected' : '' }}>Annual</option>
                    </select>
                    @if ($errors->has('reporting_frequency'))
                        <span class="admin-page__field-error">{{ $errors->first('reporting_frequency') }}</span>
                    @endif
                </div>

                <div class="admin-page__field">
                    <label for="project-programme">Programme</label>
                    <select id="project-programme" name="program_id" class="form-control{{ $errors->has('program_id') ? ' is-invalid' : '' }}">
                        <option value="">Select a programme</option>
                        @foreach ($programs as $program)
                            <option value="{{ $program->id }}"{{ (string) old('program_id', $projectedit->program_id) === (string) $program->id ? ' selected' : '' }}>{{ $program->program_name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('program_id'))
                        <span class="admin-page__field-error">{{ $errors->first('program_id') }}</span>
                    @else
                        <span class="admin-page__field-hint">Link this project to one of your organization’s programmes.</span>
                    @endif
                </div>

                <div class="admin-page__field">
                    <label for="project-exchange-period">Exchange period</label>
                    <?php $exchangePeriod = old('exchange_period', $projectedit->exchange_period); ?>
                    <select id="project-exchange-period" name="exchange_period" class="form-control">
                        <option value="">Select an exchange period</option>
                        @foreach ($currencies as $currency)
                            <option value="{{ $currency->currency_name }}"{{ (string) $exchangePeriod === (string) $currency->currency_name || (string) $exchangePeriod === (string) $currency->id ? ' selected' : '' }}>{{ $currency->currency_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="admin-page__field admin-page__field--full">
                    <label for="project-description">Project description</label>
                    <textarea id="project-description" name="description" rows="5" class="form-control">{{ old('description', $projectedit->description) }}</textarea>
                </div>
            </div>

            <div class="admin-page__form-footer">
                <button type="submit" class="admin-page__button">
                    <em class="icon ni ni-save" aria-hidden="true"></em>
                    Save changes
                </button>
                <a href="{{ route('projects.show', $projectedit->id) }}" class="admin-page__button-secondary">Cancel</a>
            </div>
        {!! Form::close() !!}
    </section>
</main>
@endsection

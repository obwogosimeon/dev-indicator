@extends('layouts.apps')

@section('content')
<main class="container-fluid admin-page program-form-page">
    <header class="admin-page__header">
        <div>
            <p class="admin-page__eyebrow">Planning schedule</p>
            <h1 class="admin-page__title">Edit financial year</h1>
            <p class="admin-page__description">Update the fiscal period for {{ $yearedit->year_name }}.</p>
        </div>
        <div class="admin-page__actions">
            @if ($yearedit->program_id)
                <a href="{{ route('programs.show', $yearedit->program_id) }}" class="admin-page__button-secondary">
                    <em class="icon ni ni-arrow-left" aria-hidden="true"></em>
                    Back to programme
                </a>
            @else
                <a href="{{ route('years.index') }}" class="admin-page__button-secondary">All financial years</a>
            @endif
        </div>
    </header>

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <strong>Please review the financial year details.</strong>
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <section class="admin-page__card admin-page__form-card admin-page__form-card--wide">
        <div class="admin-page__card-head">
            <div>
                <h2>Financial year information</h2>
                <p>Set a clear name and date range for this fiscal period.</p>
            </div>
            <span class="program-form-page__required-note"><span class="text-danger">*</span> Required</span>
        </div>
        <form method="POST" action="{{ route('years.update', $yearedit->id) }}" class="admin-page__form">
            @csrf
            @method('PATCH')
            <div class="admin-page__form-grid">
                <div class="admin-page__field admin-page__field--full">
                    <label for="year-name">Financial year name <span class="text-danger">*</span></label>
                    <input id="year-name" type="text" name="year_name" value="{{ old('year_name', $yearedit->year_name) }}" class="form-control{{ $errors->has('year_name') ? ' is-invalid' : '' }}" required>
                    @if ($errors->has('year_name'))
                        <span class="admin-page__field-error">{{ $errors->first('year_name') }}</span>
                    @endif
                </div>
                <div class="admin-page__field">
                    <label for="year-start-date">Start date <span class="text-danger">*</span></label>
                    <input id="year-start-date" type="date" name="start_date" value="{{ old('start_date', $yearedit->start_date) }}" class="form-control{{ $errors->has('start_date') ? ' is-invalid' : '' }}" required>
                    @if ($errors->has('start_date'))
                        <span class="admin-page__field-error">{{ $errors->first('start_date') }}</span>
                    @endif
                </div>
                <div class="admin-page__field">
                    <label for="year-end-date">End date <span class="text-danger">*</span></label>
                    <input id="year-end-date" type="date" name="end_date" value="{{ old('end_date', $yearedit->end_date) }}" class="form-control{{ $errors->has('end_date') ? ' is-invalid' : '' }}" required>
                    @if ($errors->has('end_date'))
                        <span class="admin-page__field-error">{{ $errors->first('end_date') }}</span>
                    @endif
                </div>
            </div>
            <div class="admin-page__form-footer">
                <button type="submit" class="admin-page__button">
                    <em class="icon ni ni-save" aria-hidden="true"></em>
                    Save changes
                </button>
                @if ($yearedit->program_id)
                    <a href="{{ route('programs.show', $yearedit->program_id) }}" class="admin-page__button-secondary">Cancel</a>
                @else
                    <a href="{{ route('years.index') }}" class="admin-page__button-secondary">Cancel</a>
                @endif
            </div>
        </form>
    </section>
</main>
@endsection

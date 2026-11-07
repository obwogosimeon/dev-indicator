@extends('layouts.apps')

@section('content')
<main class="container-fluid admin-page program-form-page">
    <header class="admin-page__header">
        <div>
            <p class="admin-page__eyebrow">Portfolio management</p>
            <h1 class="admin-page__title">Edit programme</h1>
            <p class="admin-page__description">Update the scope, schedule, and description for {{ $programedit->program_name }}.</p>
        </div>
        <div class="admin-page__actions">
            <a href="{{ route('programs.show', $programedit->id) }}" class="admin-page__button-secondary">
                <em class="icon ni ni-eye" aria-hidden="true"></em>
                View programme
            </a>
            <a href="{{ route('programs.index') }}" class="admin-page__button-secondary">
                <em class="icon ni ni-arrow-left" aria-hidden="true"></em>
                All programmes
            </a>
        </div>
    </header>

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <strong>Please review the programme details.</strong>
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <section class="admin-page__card admin-page__form-card admin-page__form-card--wide">
        <div class="admin-page__card-head">
            <div>
                <h2>Programme information</h2>
                <p>Make your changes and save when you’re ready.</p>
            </div>
        </div>
        {!! Form::model($programedit, ['method' => 'PATCH', 'route' => ['programs.update', $programedit->id], 'class' => 'admin-page__form']) !!}
            @csrf
            <input type="hidden" name="organization_id" value="{{ Auth::user()->organization_id }}">
            <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">
            <input type="hidden" name="status" value="01">

            <div class="admin-page__form-grid">
                <div class="admin-page__field admin-page__field--full">
                    <label for="program-name">Programme name <span class="text-danger">*</span></label>
                    <input id="program-name" type="text" name="program_name" value="{{ old('program_name', $programedit->program_name) }}" class="form-control{{ $errors->has('program_name') ? ' is-invalid' : '' }}" minlength="5" required>
                    @if ($errors->has('program_name'))
                        <span class="admin-page__field-error">{{ $errors->first('program_name') }}</span>
                    @endif
                </div>

                <div class="admin-page__field">
                    <label for="program-start-date">Start date <span class="text-danger">*</span></label>
                    <input id="program-start-date" type="date" name="start_date" value="{{ old('start_date', $programedit->start_date) }}" class="form-control{{ $errors->has('start_date') ? ' is-invalid' : '' }}" required>
                    @if ($errors->has('start_date'))
                        <span class="admin-page__field-error">{{ $errors->first('start_date') }}</span>
                    @endif
                </div>

                <div class="admin-page__field">
                    <label for="program-end-date">End date <span class="text-danger">*</span></label>
                    <input id="program-end-date" type="date" name="end_date" value="{{ old('end_date', $programedit->end_date) }}" class="form-control{{ $errors->has('end_date') ? ' is-invalid' : '' }}" required>
                    @if ($errors->has('end_date'))
                        <span class="admin-page__field-error">{{ $errors->first('end_date') }}</span>
                    @endif
                </div>

                <div class="admin-page__field admin-page__field--full">
                    <label for="program-description">Programme description <span class="program-form-page__optional">(Optional)</span></label>
                    <textarea id="program-description" name="description" rows="5" class="form-control">{{ old('description', $programedit->description) }}</textarea>
                </div>
            </div>

            <div class="admin-page__form-footer">
                <button type="submit" class="admin-page__button">
                    <em class="icon ni ni-save" aria-hidden="true"></em>
                    Save changes
                </button>
                <a href="{{ route('programs.show', $programedit->id) }}" class="admin-page__button-secondary">Cancel</a>
            </div>
        {!! Form::close() !!}
    </section>
</main>
@endsection

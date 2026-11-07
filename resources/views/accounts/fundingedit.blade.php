@extends('layouts.apps')

@section('content')
<main class="container-fluid admin-page program-form-page">
    <header class="admin-page__header">
        <div>
            <p class="admin-page__eyebrow">Programme resources</p>
            <h1 class="admin-page__title">Edit funding</h1>
            <p class="admin-page__description">Update the details for {{ $fundingedit->funding_name }}.</p>
        </div>
        <div class="admin-page__actions">
            @if ($fundingedit->program_id)
                <a href="{{ route('programs.show', $fundingedit->program_id) }}" class="admin-page__button-secondary">
                    <em class="icon ni ni-arrow-left" aria-hidden="true"></em>
                    Back to programme
                </a>
            @else
                <a href="{{ route('fundingindex') }}" class="admin-page__button-secondary">All funding</a>
            @endif
        </div>
    </header>

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <strong>Please review the funding details.</strong>
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <section class="admin-page__card admin-page__form-card admin-page__form-card--wide">
        <div class="admin-page__card-head">
            <div>
                <h2>Funding information</h2>
                <p>Update how this funding stream is categorized and reported.</p>
            </div>
        </div>
        <form method="POST" action="{{ route('funding.update', $fundingedit->id) }}" class="admin-page__form">
            @csrf
            <input type="hidden" name="type" value="{{ old('type', $fundingedit->type) }}">
            <input type="hidden" name="status" value="{{ old('status', $fundingedit->status) }}">

            <div class="admin-page__form-grid">
                <div class="admin-page__field admin-page__field--full">
                    <label for="funding-name">Funding name <span class="text-danger">*</span></label>
                    <input id="funding-name" type="text" name="funding_name" value="{{ old('funding_name', $fundingedit->funding_name) }}" class="form-control{{ $errors->has('funding_name') ? ' is-invalid' : '' }}" required>
                    @if ($errors->has('funding_name'))
                        <span class="admin-page__field-error">{{ $errors->first('funding_name') }}</span>
                    @endif
                </div>

                <div class="admin-page__field">
                    <label for="funding-type">Funding type <span class="text-danger">*</span></label>
                    <select id="funding-type" name="funding_type" class="form-control{{ $errors->has('funding_type') ? ' is-invalid' : '' }}" required>
                        <option value="">Select a funding type</option>
                        @foreach (['Budgeting', 'Expenditure'] as $type)
                            <option value="{{ $type }}"{{ old('funding_type', $fundingedit->funding_type) === $type ? ' selected' : '' }}>{{ $type }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('funding_type'))
                        <span class="admin-page__field-error">{{ $errors->first('funding_type') }}</span>
                    @endif
                </div>

                <div class="admin-page__field">
                    <label for="funding-expenditure">Used for expenditure? <span class="text-danger">*</span></label>
                    <select id="funding-expenditure" name="expenditure" class="form-control{{ $errors->has('expenditure') ? ' is-invalid' : '' }}" required>
                        <option value="">Select an option</option>
                        @foreach (['Yes', 'No'] as $option)
                            <option value="{{ $option }}"{{ old('expenditure', $fundingedit->expenditure) === $option ? ' selected' : '' }}>{{ $option }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('expenditure'))
                        <span class="admin-page__field-error">{{ $errors->first('expenditure') }}</span>
                    @endif
                </div>

                <div class="admin-page__field admin-page__field--full">
                    <label for="funding-variable">Variable name <span class="text-danger">*</span></label>
                    <input id="funding-variable" type="text" name="variable_name" value="{{ old('variable_name', $fundingedit->variable_name) }}" class="form-control{{ $errors->has('variable_name') ? ' is-invalid' : '' }}" required>
                    @if ($errors->has('variable_name'))
                        <span class="admin-page__field-error">{{ $errors->first('variable_name') }}</span>
                    @endif
                </div>

                <div class="admin-page__field admin-page__field--full">
                    <label for="funding-description">Description <span class="program-form-page__optional">(Optional)</span></label>
                    <textarea id="funding-description" name="description" rows="5" class="form-control">{{ old('description', $fundingedit->description) }}</textarea>
                </div>
            </div>

            <input type="hidden" name="updated_by" value="{{ Auth::id() }}">

            <div class="admin-page__form-footer">
                <button type="submit" class="admin-page__button">
                    <em class="icon ni ni-save" aria-hidden="true"></em>
                    Save changes
                </button>
                @if ($fundingedit->program_id)
                    <a href="{{ route('programs.show', $fundingedit->program_id) }}" class="admin-page__button-secondary">Cancel</a>
                @else
                    <a href="{{ route('fundingindex') }}" class="admin-page__button-secondary">Cancel</a>
                @endif
            </div>
        </form>
    </section>
</main>
@endsection

@extends('layouts.apps')

@section('content')
<main class="container-fluid admin-page program-form-page">
    <header class="admin-page__header">
        <div>
            <p class="admin-page__eyebrow">Portfolio management</p>
            <h1 class="admin-page__title">Create programme</h1>
            <p class="admin-page__description">Set up the programme scope, schedule, and base currency.</p>
        </div>
        <a href="{{ route('programs.index') }}" class="admin-page__button-secondary">
            <em class="icon ni ni-arrow-left" aria-hidden="true"></em>
            Back to programmes
        </a>
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
                <p>Complete the required fields to create your programme.</p>
            </div>
            <span class="program-form-page__required-note"><span class="text-danger">*</span> Required</span>
        </div>
        <form method="POST" action="{{ route('programs.store') }}" class="admin-page__form" id="createProgram">
            @csrf
            <input type="hidden" name="organization_id" value="{{ Auth::user()->organization_id }}">
            <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">
            <input type="hidden" name="status" value="01">

            <div class="admin-page__form-grid">
                <div class="admin-page__field admin-page__field--full">
                    <label for="program-name">Programme name <span class="text-danger">*</span></label>
                    <input id="program-name" type="text" name="program_name" value="{{ old('program_name') }}" class="form-control{{ $errors->has('program_name') ? ' is-invalid' : '' }}" placeholder="e.g. Community resilience and livelihoods" minlength="5" required>
                    @if ($errors->has('program_name'))
                        <span class="admin-page__field-error">{{ $errors->first('program_name') }}</span>
                    @else
                        <span class="admin-page__field-hint">Use at least five characters to make the programme easy to identify.</span>
                    @endif
                </div>

                <div class="admin-page__field">
                    <label for="program-start-date">Start date <span class="text-danger">*</span></label>
                    <input id="program-start-date" type="date" name="start_date" value="{{ old('start_date') }}" class="form-control{{ $errors->has('start_date') ? ' is-invalid' : '' }}" required>
                    @if ($errors->has('start_date'))
                        <span class="admin-page__field-error">{{ $errors->first('start_date') }}</span>
                    @endif
                </div>

                <div class="admin-page__field">
                    <label for="program-end-date">End date <span class="text-danger">*</span></label>
                    <input id="program-end-date" type="date" name="end_date" value="{{ old('end_date') }}" class="form-control{{ $errors->has('end_date') ? ' is-invalid' : '' }}" required>
                    @if ($errors->has('end_date'))
                        <span class="admin-page__field-error">{{ $errors->first('end_date') }}</span>
                    @else
                        <span class="admin-page__field-hint">Choose a date after the start date.</span>
                    @endif
                </div>

                <div class="admin-page__field admin-page__field--full">
                    <label for="program-base-currency">Base currency <span class="text-danger">*</span></label>
                    <select id="program-base-currency" name="basecurrency_id" class="form-control{{ $errors->has('basecurrency_id') ? ' is-invalid' : '' }}" required>
                        <option value="">Select a base currency</option>
                        @foreach ($basecurrency as $currency)
                            <option value="{{ $currency->id }}"{{ (string) old('basecurrency_id') === (string) $currency->id ? ' selected' : '' }}>
                                {{ $currency->currency_name }} ({{ $currency->currency_code }})
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('basecurrency_id'))
                        <span class="admin-page__field-error">{{ $errors->first('basecurrency_id') }}</span>
                    @else
                        <span class="admin-page__field-hint">This currency will be used as the programme’s reporting base.</span>
                    @endif
                </div>

                <div class="admin-page__field admin-page__field--full">
                    <label for="program-description">Programme description <span class="program-form-page__optional">(Optional)</span></label>
                    <textarea id="program-description" name="description" rows="5" class="form-control" placeholder="Summarize the programme’s purpose and expected outcomes.">{{ old('description') }}</textarea>
                </div>
            </div>

            <div class="admin-page__form-footer">
                <button type="submit" class="admin-page__button">
                    <em class="icon ni ni-plus" aria-hidden="true"></em>
                    Create programme
                </button>
                <a href="{{ route('programs.index') }}" class="admin-page__button-secondary">Cancel</a>
            </div>
        </form>
    </section>
</main>
@endsection

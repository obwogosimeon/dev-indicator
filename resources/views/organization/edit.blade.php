@extends('layouts.apps')

@section('content')
<main class="container-fluid admin-page organization-edit-page">
    <header class="admin-page__header">
        <div>
            <p class="admin-page__eyebrow">Organization management</p>
            <h1 class="admin-page__title">Edit organization</h1>
            <p class="admin-page__description">Update contact information and profile details for {{ $organization->organization_name }}.</p>
        </div>
        <a href="{{ route('organizations.show', $organization->id) }}" class="admin-page__button-secondary">
            <em class="icon ni ni-arrow-left" aria-hidden="true"></em>
            Back to organization
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

    <section class="admin-page__card organization-edit__card" aria-labelledby="organizationEditTitle">
        <div class="admin-page__card-head">
            <div>
                <h2 id="organizationEditTitle">Organization profile</h2>
                <p>Keep your organization’s details accurate and up to date.</p>
            </div>
            <span class="organization-edit__badge"><em class="icon ni ni-building" aria-hidden="true"></em> Profile details</span>
        </div>
        <form method="POST" enctype="multipart/form-data" action="">
            @csrf
            <div class="organization-edit__fields">
                <div class="form-group">
                    <label class="form-label" for="organizationName">Organization name</label>
                    <input type="text" name="logframe_name" class="form-control" id="organizationName" value="{{ $organization->organization_name }}">
                </div>
                <div class="form-group">
                    <label class="form-label" for="organizationPin">Organization PIN</label>
                    <input type="text" name="logframe_name" class="form-control" id="organizationPin" value="{{ $organization->kra_pin }}">
                </div>
                <div class="form-group">
                    <label class="form-label" for="organizationPhone">Phone number</label>
                    <input type="text" name="logframe_name" class="form-control" id="organizationPhone" value="{{ $organization->phone_number }}">
                </div>
                <div class="form-group">
                    <label class="form-label" for="organizationAddress">Physical address</label>
                    <input type="text" name="logframe_name" class="form-control" id="organizationAddress" value="{{ $organization->address }}">
                </div>
                <div class="form-group">
                    <label class="form-label" for="organizationEmail">Email address</label>
                    <input type="text" name="logframe_name" class="form-control" id="organizationEmail" value="{{ $organization->email_address }}">
                </div>
                <div class="form-group">
                    <label class="form-label" for="organizationLogo">Organization logo</label>
                    <input type="file" name="logo" class="form-control" id="organizationLogo" accept="image/*">
                    <span class="organization-edit__hint">Choose an image file to replace the current logo.</span>
                </div>
            </div>
            <input type="hidden" name="organization_id" value="{{ Auth::user()->organization_id }}">
            <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">
            <div class="organization-edit__footer">
                <a href="{{ route('organizations.show', $organization->id) }}" class="admin-page__button-secondary">Cancel</a>
                <button type="submit" class="admin-page__button">
                    <em class="icon ni ni-save" aria-hidden="true"></em>
                    Save changes
                </button>
            </div>
        </form>
    </section>
</main>
@endsection

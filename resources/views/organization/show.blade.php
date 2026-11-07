@extends('layouts.apps')

@section('content')
<main class="container-fluid admin-page organization-detail">
    <header class="admin-page__header">
        <div>
            <p class="admin-page__eyebrow">Organization management</p>
            <h1 class="admin-page__title">{{ $orgshow->organization_name }}</h1>
            <p class="admin-page__description">Manage organization members and workspace access.</p>
        </div>
        <div class="organization-detail__header-actions">
            <a href="{{ route('organizations.index') }}" class="admin-page__button-secondary">
                <em class="icon ni ni-arrow-left" aria-hidden="true"></em>
                Organizations
            </a>
            <a href="{{ route('organizations.edit', $orgshow->id) }}" class="admin-page__button-secondary">
                <em class="icon ni ni-edit" aria-hidden="true"></em>
                Edit details
            </a>
            <button type="button" class="admin-page__button" data-bs-toggle="modal" data-bs-target="#addOrganizationMember">
                <em class="icon ni ni-plus" aria-hidden="true"></em>
                Add member
            </button>
        </div>
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

    <section class="organization-detail__summary" aria-label="Organization details">
        <div class="organization-detail__identity">
            <span class="organization-detail__icon" aria-hidden="true"><em class="icon ni ni-building"></em></span>
            <div>
                <span>Organization</span>
                <strong>{{ $orgshow->organization_name }}</strong>
            </div>
        </div>
        <div class="organization-detail__identity">
            <span class="organization-detail__icon organization-detail__icon--blue" aria-hidden="true"><em class="icon ni ni-mail"></em></span>
            <div>
                <span>Email address</span>
                <strong>{{ $orgshow->email_address ?: 'Not provided' }}</strong>
            </div>
        </div>
        <div class="organization-detail__identity">
            <span class="organization-detail__icon organization-detail__icon--green" aria-hidden="true"><em class="icon ni ni-users"></em></span>
            <div>
                <span>Organization members</span>
                <strong>{{ $orgusers->count() }}</strong>
            </div>
        </div>
    </section>

    <section class="admin-page__card" aria-label="Organization members">
        <div class="admin-page__card-head">
            <div>
                <h2>Member directory</h2>
                <p>{{ $orgusers->count() }} {{ \Illuminate\Support\Str::plural('member', $orgusers->count()) }} in this organization</p>
            </div>
        </div>
        @if ($orgusers->isNotEmpty())
            <div class="table-responsive admin-page__table-wrap">
                <table class="table admin-page__table admin-page__table--cards">
                    <thead>
                        <tr>
                            <th scope="col">Member</th>
                            <th scope="col">Email address</th>
                            <th scope="col">Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orgusers as $member)
                            <tr>
                                <td data-label="Member">
                                    <span class="organization-member__name">{{ $member->name }} {{ $member->last_name }}</span>
                                </td>
                                <td data-label="Email address">{{ $member->email }}</td>
                                <td data-label="Role">
                                    @if ($member->getRoleNames()->isNotEmpty())
                                        <div class="organization-member__roles">
                                            @foreach ($member->getRoleNames() as $role)
                                                <span class="admin-page__badge">{{ $role }}</span>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="admin-page__badge admin-page__badge--neutral">No role assigned</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="admin-page__empty organization-detail__empty">
                <span class="organization-detail__empty-icon" aria-hidden="true"><em class="icon ni ni-users"></em></span>
                <strong>No members yet</strong>
                <span>Add the first member to this organization to get started.</span>
                <button type="button" class="admin-page__button-secondary" data-bs-toggle="modal" data-bs-target="#addOrganizationMember">Add member</button>
            </div>
        @endif
    </section>
</main>

<div class="modal fade" tabindex="-1" id="addOrganizationMember" aria-labelledby="addOrganizationMemberTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content organization-member-modal">
            <div class="modal-header">
                <div>
                    <h5 class="modal-title" id="addOrganizationMemberTitle">Add organization member</h5>
                    <p>Invite a new member to {{ $orgshow->organization_name }}.</p>
                </div>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </button>
            </div>
            <form method="POST" action="{{ route('addmember') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label" for="memberFirstName">First name</label>
                        <input type="text" class="form-control" name="name" id="memberFirstName" autocomplete="given-name" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="memberLastName">Last name</label>
                        <input type="text" class="form-control" name="last_name" id="memberLastName" autocomplete="family-name" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="memberEmail">Email address</label>
                        <input type="email" class="form-control" name="email" id="memberEmail" autocomplete="email" required>
                    </div>
                    <input type="hidden" name="organization_id" value="{{ $orgshow->id }}">
                    <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="roles" value="Normal">
                </div>
                <div class="modal-footer">
                    <button type="button" class="admin-page__button-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="admin-page__button">
                        <em class="icon ni ni-user-add" aria-hidden="true"></em>
                        Add member
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

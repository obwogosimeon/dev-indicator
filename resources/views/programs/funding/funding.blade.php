<div class="tab-pane" id="tabItem8" role="tabpanel" aria-labelledby="program-funding-tab">
    <div class="program-detail__panel">
        <div class="program-detail__panel-header">
            <div>
                <p class="admin-page__eyebrow">Programme resources</p>
                <h2>Funding streams</h2>
                <p>Manage the financiers and funding variables used by this programme.</p>
            </div>
            <button type="button" class="admin-page__button" data-bs-toggle="modal" data-bs-target="#modal234567">
                <em class="icon ni ni-plus" aria-hidden="true"></em>
                Add funding
            </button>
        </div>

        @if ($fundings->isEmpty())
            <div class="program-detail__empty-state">
                <span class="program-detail__record-icon"><em class="icon ni ni-wallet-out" aria-hidden="true"></em></span>
                <h3>No funding streams yet</h3>
                <p>Add the first funding stream to track how resources are categorized for this programme.</p>
                <button type="button" class="admin-page__button" data-bs-toggle="modal" data-bs-target="#modal234567">
                    <em class="icon ni ni-plus" aria-hidden="true"></em>
                    Add funding
                </button>
            </div>
        @else
            <div class="program-detail__record-list" aria-label="Programme funding streams">
                @foreach ($fundings as $object)
                    <article class="program-detail__record">
                        <span class="program-detail__record-icon"><em class="icon ni ni-wallet-out" aria-hidden="true"></em></span>
                        <div class="program-detail__record-main">
                            <h3>{{ $object->funding_name }}</h3>
                            <div class="program-detail__record-meta">
                                <span>{{ $object->funding_type }}</span>
                                <span>Expenditure: {{ $object->expenditure }}</span>
                                <span>Variable: <code>{{ $object->variable_name }}</code></span>
                            </div>
                            @if ($object->description)
                                <p class="program-detail__record-description">{{ $object->description }}</p>
                            @endif
                        </div>
                        <div class="program-detail__record-actions">
                            <a href="{{ route('funding.show', $object->id) }}" class="admin-page__action" aria-label="View {{ $object->funding_name }}">
                                <em class="icon ni ni-eye" aria-hidden="true"></em>
                                View
                            </a>
                            <a href="{{ route('funding.edit', $object->id) }}" class="admin-page__action" aria-label="Edit {{ $object->funding_name }}">
                                <em class="icon ni ni-edit" aria-hidden="true"></em>
                                Edit
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </div>
</div>

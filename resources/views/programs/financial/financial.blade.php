<div class="tab-pane" id="tabItem9" role="tabpanel" aria-labelledby="program-years-tab">
    <div class="program-detail__panel">
        <div class="program-detail__panel-header">
            <div>
                <p class="admin-page__eyebrow">Planning schedule</p>
                <h2>Financial years</h2>
                <p>Set the fiscal periods used to organize programme plans and reporting.</p>
            </div>
            <button type="button" class="admin-page__button" data-bs-toggle="modal" data-bs-target="#modal23456">
                <em class="icon ni ni-plus" aria-hidden="true"></em>
                Add financial year
            </button>
        </div>

        @if ($years->isEmpty())
            <div class="program-detail__empty-state">
                <span class="program-detail__record-icon"><em class="icon ni ni-calendar-fill" aria-hidden="true"></em></span>
                <h3>No financial years yet</h3>
                <p>Add a financial year to organize this programme’s plans and reports by period.</p>
                <button type="button" class="admin-page__button" data-bs-toggle="modal" data-bs-target="#modal23456">
                    <em class="icon ni ni-plus" aria-hidden="true"></em>
                    Add financial year
                </button>
            </div>
        @else
            <div class="program-detail__record-list" aria-label="Programme financial years">
                @foreach ($years as $object)
                    <article class="program-detail__record">
                        <span class="program-detail__record-icon program-detail__record-icon--blue"><em class="icon ni ni-calendar-fill" aria-hidden="true"></em></span>
                        <div class="program-detail__record-main">
                            <h3>{{ $object->year_name }}</h3>
                            <div class="program-detail__record-meta">
                                <span><strong>Start</strong> {{ $object->start_date }}</span>
                                <span><strong>End</strong> {{ $object->end_date }}</span>
                            </div>
                        </div>
                        <div class="program-detail__record-actions">
                            <a href="{{ route('years.show', $object->id) }}" class="admin-page__action" aria-label="View {{ $object->year_name }}">
                                <em class="icon ni ni-eye" aria-hidden="true"></em>
                                View
                            </a>
                            <a href="{{ route('years.edit', $object->id) }}" class="admin-page__action" aria-label="Edit {{ $object->year_name }}">
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

<div id="workplan-containers" class="project-workplan__list">
    @foreach ($workplancontaines as $containers)
        <section class="project-workplan__container" aria-labelledby="workplan-title-{{ $containers->id }}">
            <header class="project-workplan__container-header">
                <button type="button" class="project-workplan__toggle collapsed" data-bs-toggle="collapse" data-bs-target="#workplan-content-{{ $containers->id }}" aria-expanded="false" aria-controls="workplan-content-{{ $containers->id }}">
                    <span class="project-workplan__container-icon" aria-hidden="true">
                        <em class="icon ni ni-calendar-alt"></em>
                    </span>
                    <span class="project-workplan__container-heading">
                        <span class="project-workplan__container-title-row">
                            <span class="project-workplan__container-title" id="workplan-title-{{ $containers->id }}">{{ $containers->container_name }}</span>
                            @if ($containers->status == '01')
                                <span class="admin-page__badge admin-page__badge--amber">Draft</span>
                            @elseif ($containers->status == '02')
                                <span class="admin-page__badge admin-page__badge--blue">Submitted</span>
                            @elseif ($containers->status == '03')
                                <span class="admin-page__badge admin-page__badge--blue">Forwarded</span>
                            @elseif ($containers->status == '04')
                                <span class="admin-page__badge admin-page__badge--green">Approved</span>
                            @elseif ($containers->status == '05')
                                <span class="admin-page__badge admin-page__badge--neutral">Reported</span>
                            @elseif ($containers->status == '06')
                                <span class="admin-page__badge admin-page__badge--neutral">Report forwarded</span>
                            @elseif ($containers->status == '07')
                                <span class="admin-page__badge admin-page__badge--green">Report approved</span>
                            @else
                                <span class="admin-page__badge admin-page__badge--neutral">Status {{ $containers->status }}</span>
                            @endif
                        </span>
                        <span class="project-workplan__container-meta">
                            <span>{{ $containers->planning_type }} planning</span>
                            <span>{{ $containers->financial_year }}</span>
                            @if ($containers->planning_type == 'Activity')
                                <span>{{ $containers->budget->count() }} {{ \Illuminate\Support\Str::plural('activity plan', $containers->budget->count()) }}</span>
                            @elseif ($containers->planning_type == 'Indicator')
                                <span>{{ $containers->indicatortarget->count() }} {{ \Illuminate\Support\Str::plural('indicator target', $containers->indicatortarget->count()) }}</span>
                            @endif
                        </span>
                    </span>
                    <span class="project-workplan__expand" aria-hidden="true">
                        <em class="icon ni ni-chevron-down"></em>
                    </span>
                </button>
                <div class="project-workplan__container-actions">
                    @if ($containers->status == '01')
                        @if ($containers->planning_type == 'Activity')
                            <a class="admin-page__action" href="{{ route('createwp', $containers->id) }}">
                                <em class="icon ni ni-plus" aria-hidden="true"></em>
                                Add activity plan
                            </a>
                        @elseif ($containers->planning_type == 'Indicator')
                            <a class="admin-page__action" href="{{ route('createindicatorwp', $containers->id) }}">
                                <em class="icon ni ni-plus" aria-hidden="true"></em>
                                Add indicator plan
                            </a>
                        @endif
                        <button type="button" class="admin-page__button-secondary" id="workplan2" data-id="{{ $containers->id }}" data-bs-toggle="modal" data-bs-target="#workplan1">
                            <em class="icon ni ni-send" aria-hidden="true"></em>
                            Submit
                        </button>
                    @elseif ($containers->status == '02')
                        <button type="button" class="admin-page__action" data-bs-toggle="modal" data-bs-target="#worktimeline-{{ $containers->id }}">
                            <em class="icon ni ni-clock" aria-hidden="true"></em>
                            Timeline
                        </button>
                        <button type="button" class="admin-page__action admin-page__action--danger" id="cancelworkplan" data-id="{{ $containers->id }}" data-bs-toggle="modal" data-bs-target="#cancelworkplan1">
                            <em class="icon ni ni-cross" aria-hidden="true"></em>
                            Cancel
                        </button>
                    @endif
                </div>
            </header>

            <div class="collapse project-workplan__details" id="workplan-content-{{ $containers->id }}" data-bs-parent="#workplan-containers">
                @if ($containers->planning_type == 'Activity')
                    <div class="project-workplan__section">
                        <div class="project-workplan__section-heading">
                            <div>
                                <h4>Activity plans</h4>
                                <p>Planned activities, delivery dates, and allocated funding.</p>
                            </div>
                        </div>

                        @if ($containers->budget->isEmpty())
                            <div class="project-workplan__empty">
                                <em class="icon ni ni-list-round" aria-hidden="true"></em>
                                <div>
                                    <strong>No activity plans in this container</strong>
                                    <p>Add an activity plan to record its schedule and funding.</p>
                                </div>
                                @if ($containers->status == '01')
                                    <a class="admin-page__action" href="{{ route('createwp', $containers->id) }}">Add activity plan</a>
                                @endif
                            </div>
                        @else
                            <div class="project-workplan__activity-list">
                                @foreach ($containers->budget as $object)
                                    <article class="project-workplan__activity">
                                        <div class="project-workplan__activity-heading">
                                            <span class="project-workplan__activity-icon" aria-hidden="true"><em class="icon ni ni-activity-round-fill"></em></span>
                                            <div>
                                                <h5>{{ $object->workplan_name }}</h5>
                                                <span><em class="icon ni ni-calendar-alt" aria-hidden="true"></em> {{ $object->start_date ? \Carbon\Carbon::parse($object->start_date)->format('M j, Y') : '—' }} – {{ $object->end_date ? \Carbon\Carbon::parse($object->end_date)->format('M j, Y') : '—' }}</span>
                                            </div>
                                            <a class="admin-page__action" href="{{ url('budgetupdate', $object->id) }}">
                                                <em class="icon ni ni-edit" aria-hidden="true"></em>
                                                Edit plan
                                            </a>
                                        </div>
                                        <div class="project-workplan__allocations">
                                            @if ($accounts->count() > 0)
                                                <div class="project-workplan__allocation">
                                                    <span>{{ optional($accounts->get(0))->funding_name ?: 'Funding A' }}</span>
                                                    <strong>
                                                        @if ($projectshow->basecurrency_id != '')
                                                            {{ $projectshow->basecurrency->currency_code }}
                                                        @else
                                                            {{ $projectshow->program->basecurrency->currency_code }}
                                                        @endif
                                                        @convert($object->annual_amounta)
                                                    </strong>
                                                </div>
                                            @endif
                                            @if ($accounts->count() > 1)
                                                <div class="project-workplan__allocation">
                                                    <span>{{ optional($accounts->get(1))->funding_name ?: 'Funding B' }}</span>
                                                    <strong>
                                                        @if ($projectshow->basecurrency_id != '')
                                                            {{ $projectshow->basecurrency->currency_code }}
                                                        @else
                                                            {{ $projectshow->program->basecurrency->currency_code }}
                                                        @endif
                                                        @convert($object->annual_amountb)
                                                    </strong>
                                                </div>
                                            @endif
                                            <div class="project-workplan__allocation project-workplan__allocation--total">
                                                <span>Total funding</span>
                                                <strong>
                                                    @if ($projectshow->basecurrency_id != '')
                                                        {{ $projectshow->basecurrency->currency_code }}
                                                    @else
                                                        {{ $projectshow->program->basecurrency->currency_code }}
                                                    @endif
                                                    @convert($object->total)
                                                </strong>
                                            </div>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        @endif

                        <div class="project-workplan__summary">
                            <div class="project-workplan__summary-heading">
                                <span class="project-workplan__summary-icon"><em class="icon ni ni-coins" aria-hidden="true"></em></span>
                                <div>
                                    <h4>Project funding overview</h4>
                                    <p>Combined budget totals across this project.</p>
                                </div>
                            </div>
                            <div class="project-workplan__summary-values">
                                @if ($accounts->count() > 0)
                                    <div>
                                        <span>{{ optional($accounts->get(0))->funding_name ?: 'Funding A' }}</span>
                                        <strong>
                                            @if ($projectshow->basecurrency_id != '')
                                                {{ $projectshow->basecurrency->currency_code }}
                                            @else
                                                {{ $projectshow->program->basecurrency->currency_code }}
                                            @endif
                                            @convert($fundingonetotal)
                                        </strong>
                                    </div>
                                @endif
                                @if ($accounts->count() > 1)
                                    <div>
                                        <span>{{ optional($accounts->get(1))->funding_name ?: 'Funding B' }}</span>
                                        <strong>
                                            @if ($projectshow->basecurrency_id != '')
                                                {{ $projectshow->basecurrency->currency_code }}
                                            @else
                                                {{ $projectshow->program->basecurrency->currency_code }}
                                            @endif
                                            @convert($fundingtwototal)
                                        </strong>
                                    </div>
                                @endif
                                <div>
                                    <span>Total project funding</span>
                                    <strong>
                                        @if ($projectshow->basecurrency_id != '')
                                            {{ $projectshow->basecurrency->currency_code }}
                                        @else
                                            {{ $projectshow->program->basecurrency->currency_code }}
                                        @endif
                                        @convert($fundingtotal)
                                    </strong>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif ($containers->planning_type == 'Indicator')
                    <div class="project-workplan__section">
                        <div class="project-workplan__section-heading">
                            <div>
                                <h4>Indicator targets and reporting</h4>
                                <p>Review targets and reporting values by frequency.</p>
                            </div>
                        </div>

                        <ul class="nav nav-tabs project-workplan__report-tabs" role="tablist" aria-label="Indicator reporting frequency">
                            <li class="nav-item"><a class="nav-link active" id="workplan-{{ $containers->id }}-all-tab" data-bs-toggle="tab" href="#workplan-{{ $containers->id }}-all" role="tab" aria-controls="workplan-{{ $containers->id }}-all" aria-selected="true">Targets</a></li>
                            <li class="nav-item"><a class="nav-link" id="workplan-{{ $containers->id }}-monthly-tab" data-bs-toggle="tab" href="#workplan-{{ $containers->id }}-monthly" role="tab" aria-controls="workplan-{{ $containers->id }}-monthly">Monthly</a></li>
                            <li class="nav-item"><a class="nav-link" id="workplan-{{ $containers->id }}-bimonthly-tab" data-bs-toggle="tab" href="#workplan-{{ $containers->id }}-bimonthly" role="tab" aria-controls="workplan-{{ $containers->id }}-bimonthly">Bi-monthly</a></li>
                            <li class="nav-item"><a class="nav-link" id="workplan-{{ $containers->id }}-quarterly-tab" data-bs-toggle="tab" href="#workplan-{{ $containers->id }}-quarterly" role="tab" aria-controls="workplan-{{ $containers->id }}-quarterly">Quarterly</a></li>
                            <li class="nav-item"><a class="nav-link" id="workplan-{{ $containers->id }}-semiannual-tab" data-bs-toggle="tab" href="#workplan-{{ $containers->id }}-semiannual" role="tab" aria-controls="workplan-{{ $containers->id }}-semiannual">Semi-annual</a></li>
                            <li class="nav-item"><a class="nav-link" id="workplan-{{ $containers->id }}-annual-tab" data-bs-toggle="tab" href="#workplan-{{ $containers->id }}-annual" role="tab" aria-controls="workplan-{{ $containers->id }}-annual">Annual</a></li>
                        </ul>

                        <div class="tab-content project-workplan__report-content">
                            <div class="tab-pane active" id="workplan-{{ $containers->id }}-all" role="tabpanel" aria-labelledby="workplan-{{ $containers->id }}-all-tab">
                                @if ($containers->indicatortarget->isEmpty())
                                    <div class="project-workplan__report-empty">No indicator targets are linked to this container.</div>
                                @else
                                    <div class="project-workplan__table-wrap">
                                        <table class="table project-workplan__table">
                                            <thead><tr><th>Indicator</th><th>Label</th><th>Baseline</th><th>Target</th></tr></thead>
                                            <tbody>
                                                @foreach ($containers->indicatortarget as $object)
                                                    <tr>
                                                        <td>{{ $object->indicator->indicator_title }}</td>
                                                        <td>{{ $object->label }}</td>
                                                        <td>{{ $object->baseline }}</td>
                                                        <td>{{ $object->target }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                            <div class="tab-pane" id="workplan-{{ $containers->id }}-monthly" role="tabpanel" aria-labelledby="workplan-{{ $containers->id }}-monthly-tab">
                                @if ($reporting->isEmpty())
                                    <div class="project-workplan__report-empty">No monthly reporting values available.</div>
                                @else
                                    <div class="project-workplan__table-wrap">
                                        <table class="table project-workplan__table">
                                            <thead><tr><th>Label</th><th>Jan</th><th>Feb</th><th>Mar</th><th>Apr</th><th>May</th><th>Jun</th><th>Jul</th><th>Aug</th><th>Sep</th><th>Oct</th><th>Nov</th><th>Dec</th></tr></thead>
                                            <tbody>
                                                @foreach ($reporting as $object)
                                                    <tr><td>{{ $object->label }}</td><td>{{ preg_replace('/["]/', '', $object->january) }}</td><td>{{ preg_replace('/["]/', '', $object->february) }}</td><td>{{ preg_replace('/["]/', '', $object->march) }}</td><td>{{ preg_replace('/["]/', '', $object->april) }}</td><td>{{ preg_replace('/["]/', '', $object->may) }}</td><td>{{ preg_replace('/["]/', '', $object->june) }}</td><td>{{ preg_replace('/["]/', '', $object->july) }}</td><td>{{ preg_replace('/["]/', '', $object->august) }}</td><td>{{ preg_replace('/["]/', '', $object->september) }}</td><td>{{ preg_replace('/["]/', '', $object->october) }}</td><td>{{ preg_replace('/["]/', '', $object->november) }}</td><td>{{ preg_replace('/["]/', '', $object->december) }}</td></tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                            <div class="tab-pane" id="workplan-{{ $containers->id }}-bimonthly" role="tabpanel" aria-labelledby="workplan-{{ $containers->id }}-bimonthly-tab">
                                @if ($reporting2->isEmpty())
                                    <div class="project-workplan__report-empty">No bi-monthly reporting values available.</div>
                                @else
                                    <div class="project-workplan__table-wrap">
                                        <table class="table project-workplan__table">
                                            <thead><tr><th>Label</th><th>Jan–Feb</th><th>Mar–Apr</th><th>May–Jun</th><th>Jul–Aug</th><th>Sep–Oct</th><th>Nov–Dec</th></tr></thead>
                                            <tbody>
                                                @foreach ($reporting2 as $object)
                                                    <tr><td>{{ $object->label }}</td><td>{{ $object->jan_feb }}</td><td>{{ $object->mar_apr }}</td><td>{{ $object->may_june }}</td><td>{{ $object->july_aug }}</td><td>{{ $object->sep_oct }}</td><td>{{ $object->nov_dec }}</td></tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                            <div class="tab-pane" id="workplan-{{ $containers->id }}-quarterly" role="tabpanel" aria-labelledby="workplan-{{ $containers->id }}-quarterly-tab">
                                @if ($reporting3->isEmpty())
                                    <div class="project-workplan__report-empty">No quarterly reporting values available.</div>
                                @else
                                    <div class="project-workplan__table-wrap">
                                        <table class="table project-workplan__table">
                                            <thead><tr><th>Label</th><th>Jan–Mar</th><th>Apr–Jun</th><th>Jul–Sep</th><th>Oct–Dec</th></tr></thead>
                                            <tbody>
                                                @foreach ($reporting3 as $object)
                                                    <tr><td>{{ $object->label }}</td><td>{{ $object->jan_march }}</td><td>{{ $object->april_june }}</td><td>{{ $object->july_september }}</td><td>{{ $object->october_december }}</td></tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                            <div class="tab-pane" id="workplan-{{ $containers->id }}-semiannual" role="tabpanel" aria-labelledby="workplan-{{ $containers->id }}-semiannual-tab">
                                @if ($reporting4->isEmpty())
                                    <div class="project-workplan__report-empty">No semi-annual reporting values available.</div>
                                @else
                                    <div class="project-workplan__table-wrap">
                                        <table class="table project-workplan__table">
                                            <thead><tr><th>Label</th><th>Jan–Jun</th><th>Jul–Dec</th></tr></thead>
                                            <tbody>
                                                @foreach ($reporting4 as $object)
                                                    <tr><td>{{ $object->label }}</td><td>{{ $object->jan_june }}</td><td>{{ $object->july_december }}</td></tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                            <div class="tab-pane" id="workplan-{{ $containers->id }}-annual" role="tabpanel" aria-labelledby="workplan-{{ $containers->id }}-annual-tab">
                                @if ($reporting5->isEmpty())
                                    <div class="project-workplan__report-empty">No annual reporting values available.</div>
                                @else
                                    <div class="project-workplan__table-wrap">
                                        <table class="table project-workplan__table">
                                            <thead><tr><th>Label</th><th>Jan–Dec</th></tr></thead>
                                            <tbody>
                                                @foreach ($reporting5 as $object)
                                                    <tr><td>{{ $object->label }}</td><td>{{ $object->jan_december }}</td></tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </section>

        @if ($containers->status == '02')
            <div class="modal fade" tabindex="-1" id="worktimeline-{{ $containers->id }}" aria-labelledby="worktimeline-title-{{ $containers->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered project-detail__modal-dialog" role="document">
                    <div class="modal-content project-detail__modal">
                        <div class="modal-header">
                            <div class="project-detail__modal-heading">
                                <span class="project-detail__modal-icon"><em class="icon ni ni-clock" aria-hidden="true"></em></span>
                                <div>
                                    <h5 class="modal-title" id="worktimeline-title-{{ $containers->id }}">Work plan timeline</h5>
                                    <p>{{ $containers->container_name }}</p>
                                </div>
                            </div>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><em class="icon ni ni-cross"></em></button>
                        </div>
                        <div class="modal-body">
                            <ol class="project-workplan__timeline">
                                <li><span>Created</span><strong>{{ \Carbon\Carbon::parse($containers->created_at)->format('M j, Y, g:i A') }}</strong></li>
                                @if ($containers->submitted_on)
                                    <li><span>Submitted</span><strong>{{ \Carbon\Carbon::createFromFormat('l dS \of F Y h:i:s A', $containers->submitted_on)->format('M j, Y, g:i A') }}</strong></li>
                                @endif
                                @if ($containers->cancel_date)
                                    <li><span>Cancelled</span><strong>{{ \Carbon\Carbon::createFromFormat('l dS \of F Y h:i:s A', $containers->cancel_date)->format('M j, Y, g:i A') }}</strong></li>
                                @endif
                            </ol>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="admin-page__button-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</div>

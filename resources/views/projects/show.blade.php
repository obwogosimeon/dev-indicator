@extends('layouts.apps')
@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
    $(document).ready(function () {
        $('#tabMenu a[href="#{{ old('tab') }}"]').tab('show')
        $('.nk-content .modal-content').addClass('project-detail__modal')
        var logframeDialogs = [
            '#addGoalDialog', '#editgoal_modal', '#practice_modal', '#editoutcome_modal',
            '#activity_modal', '#activity1', '#activity2', '#editactivity_modal',
            '#editoutcomeactivity_modal', '#editoutputactivity_modal', '#output_model',
            '#editoutput_modal', '#indicator_modal', '#indicator1', '#indicator2',
            '#editindicator_modal', '#addOutcomeDialog', '#addGoalIndicatorDialog',
            '#editGoalIndicatorDialog', '#addGoalActivityDialog', '#editGoalActivityDialog',
            '#addOutputDialog', '#editOutputDialog', '#addOutcomeIndicatorDialog',
            '#editOutcomeIndicatorDialog', '#addOutcomeActivityDialog',
            '#editOutcomeActivityDialog', '#addOutputIndicatorDialog',
            '#editOutputIndicatorDialog', '#addOutputActivityDialog',
            '#editOutputActivityDialog', '#updatecurreny'
        ].join(', ')
        $(logframeDialogs).find('.modal-content').addClass('logframe-form-modal')
        $('#indicator_modal .modal-content').addClass('logframe-indicator-modal')
        $('#indicator1 .modal-content, #indicator2 .modal-content').addClass('logframe-nested-indicator-modal')
        $('#updatecurreny .modal-content').addClass('logframe-currency-modal')
    });
</script>


<div class="container-fluid admin-page project-detail-page">
    <header class="admin-page__header">
        <div>
            <p class="admin-page__eyebrow">Project workspace</p>
            <h1 class="admin-page__title">{{ $projectshow->project_name }}</h1>
            <p class="admin-page__description">
                {{ optional($projectshow->program)->program_name ?: 'Programme not assigned' }}
                @if ($projectshow->start_date || $projectshow->end_date)
                    <span class="project-detail__description-divider">·</span>
                    {{ $projectshow->start_date ? \Carbon\Carbon::parse($projectshow->start_date)->format('M j, Y') : 'Start date not set' }} – {{ $projectshow->end_date ? \Carbon\Carbon::parse($projectshow->end_date)->format('M j, Y') : 'End date not set' }}
                @endif
            </p>
        </div>
        <div class="admin-page__actions project-detail__header-actions">
            <a href="{{ route('projects.index') }}" class="admin-page__button-secondary">
                <em class="icon ni ni-arrow-left" aria-hidden="true"></em>
                All projects
            </a>
            <a href="{{ route('projects.edit', $projectshow->id) }}" class="admin-page__button-secondary">
                <em class="icon ni ni-edit" aria-hidden="true"></em>
                Edit project
            </a>
            <button type="button" class="admin-page__button" data-bs-toggle="modal" data-bs-target="#updatecurreny">
                <em class="icon ni ni-coins" aria-hidden="true"></em>
                Update base currency
            </button>
        </div>
    </header>

    <section class="project-detail__summary" aria-label="Project overview">
        <div class="project-detail__summary-item">
            <span class="project-detail__summary-icon"><em class="icon ni ni-calendar-alt" aria-hidden="true"></em></span>
            <div>
                <span>Reporting frequency</span>
                <strong>{{ $reportingf ?: 'Not set' }}</strong>
            </div>
        </div>
        <div class="project-detail__summary-item">
            <span class="project-detail__summary-icon project-detail__summary-icon--blue"><em class="icon ni ni-clock" aria-hidden="true"></em></span>
            <div>
                <span>Project period</span>
                <strong>{{ $projectshow->start_date ? \Carbon\Carbon::parse($projectshow->start_date)->format('M j, Y') : '—' }} <span class="project-detail__date-divider">to</span> {{ $projectshow->end_date ? \Carbon\Carbon::parse($projectshow->end_date)->format('M j, Y') : '—' }}</strong>
            </div>
        </div>
        <div class="project-detail__summary-item">
            <span class="project-detail__summary-icon project-detail__summary-icon--green"><em class="icon ni ni-check-circle" aria-hidden="true"></em></span>
            <div>
                <span>Project status</span>
                @if ($projectshow->status === '00')
                    <strong><span class="admin-page__badge admin-page__badge--green">Active</span></strong>
                @elseif ($projectshow->status === '01')
                    <strong><span class="admin-page__badge admin-page__badge--amber">Unverified</span></strong>
                @else
                    <strong><span class="admin-page__badge admin-page__badge--neutral">In progress</span></strong>
                @endif
            </div>
        </div>
        <div class="project-detail__summary-item">
            <span class="project-detail__summary-icon project-detail__summary-icon--violet"><em class="icon ni ni-coin" aria-hidden="true"></em></span>
            <div>
                <span>Base currency</span>
                <strong>{{ optional($projectshow->basecurrency)->currency_name ?: optional(optional($projectshow->program)->basecurrency)->currency_name ?: 'Not set' }}</strong>
            </div>
        </div>
    </section>

    <div class="card card-bordered card-preview project-detail__workspace">
        <div class="card-inner">
            <div class="card-inner">
                <ul class="nav nav-tabs mt-n3 project-detail__tabs" id="tabMenu" aria-label="Project management sections" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="project-implementation-tab" role="tab" aria-controls="tabItem1" aria-selected="true" data-bs-toggle="tab" href="#tabItem1">
                            <span>Implementation</span><span class="project-detail__tab-count">{{ $impcontainers->count() }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="project-workplan-tab" role="tab" aria-controls="tabItem2" aria-selected="false" data-bs-toggle="tab" href="#tabItem2">
                            <span>Work plan</span><span class="project-detail__tab-count">{{ $workplancontaines->count() }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="project-intervention-tab" role="tab" aria-controls="tabItem3" aria-selected="false" data-bs-toggle="tab" href="#tabItem3">
                            <span>Intervention</span><span class="project-detail__tab-count">{{ $intervencontainers->count() }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="project-logframe-tab" role="tab" aria-controls="tabItem4" aria-selected="false" data-bs-toggle="tab" href="#tabItem4">Logframe</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="project-funding-tab" role="tab" aria-controls="tabItem5" aria-selected="false" data-bs-toggle="tab" href="#tabItem5">
                            <span>Funding</span><span class="project-detail__tab-count">{{ $accounts->count() }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="project-users-tab" role="tab" aria-controls="tabItem6" aria-selected="false" data-bs-toggle="tab" href="#tabItem6">
                            <span>Project users</span><span class="project-detail__tab-count">{{ $projectusers->count() }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="project-documents-tab" role="tab" aria-controls="tabItem7" aria-selected="false" data-bs-toggle="tab" href="#tabItem7">Documents</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="project-expenses-tab" role="tab" aria-controls="tabItem8" aria-selected="false" data-bs-toggle="tab" href="#tabItem8">Project expenses</a>
                    </li>
                </ul>
                
                    <div class="tab-content">


                            @include('projects.implementation.implementation') 


                               <div class="tab-pane project-detail__tab-pane" id="tabItem2" role="tabpanel" aria-labelledby="project-workplan-tab">
                                <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
                                    <div class="subheader py-2 py-lg-4 project-workspace__header" id="kt_subheader">
                                        <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                                            <div class="project-workspace__heading">
                                                <p class="admin-page__eyebrow">Planning and budgeting</p>
                                                <h2>Work plans</h2>
                                                <p>Organize activity and indicator plans by financial year.</p>
                                            </div>
                                            <div class="project-workspace__header-actions">
                                                <span class="project-workspace__count">{{ $workplancontaines->count() }} {{ \Illuminate\Support\Str::plural('plan', $workplancontaines->count()) }}</span>
                                                <button type="button" class="admin-page__button" data-bs-toggle="modal" data-bs-target="#modalZoom87">
                                                    <em class="icon ni ni-plus" aria-hidden="true"></em>
                                                    Add work plan
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-block nk-block-lg">
                                        <div class="card card-bordered card-preview project-workspace__content">
                                            <div class="card-inner">
                                              @if($workplancontaines->isEmpty())
                                                <div class="project-detail__empty-state">
                                                    <span class="project-detail__record-icon program-detail__record-icon--blue"><em class="icon ni ni-calendar-alt" aria-hidden="true"></em></span>
                                                    <h3>No work plans yet</h3>
                                                    <p>Create a work plan container to start organizing this project’s activities and indicators.</p>
                                                    <button type="button" class="admin-page__button" data-bs-toggle="modal" data-bs-target="#modalZoom87">
                                                        <em class="icon ni ni-plus" aria-hidden="true"></em>
                                                        Add work plan
                                                    </button>
                                                </div>
                                              @endif
                                              @include('projects.workplan-content')
                                            </div>
                                        </div>
                                    </div>


                                </div>



                            </div>


                            <div class="tab-pane project-detail__tab-pane" id="tabItem3" role="tabpanel" aria-labelledby="project-intervention-tab">

                                <script type="text/javascript">
                                  $(function(){
                                    $('#funding1, #funding2').keyup(function(){
                                       var funding1 = parseFloat($('#funding1').val()) || 0;
                                       var funding2 = parseFloat($('#funding2').val()) || 0;
                                       $('#total').val(funding1 + funding2);
                                   });
                                });
                            </script>

                            <script type="text/javascript">
                              $(function(){
                                $('#funding1').keyup(function(){
                                   var funding1 = parseFloat($('#funding1').val()) || 0;
                                   $('#valued').val(funding1);
                               });
                            });
                        </script>

                        <script type="text/javascript">
                          $(function(){
                            $('#funding2').keyup(function(){
                               var funding2 = parseFloat($('#funding2').val()) || 0;
                               $('#valuee').val(funding2);
                           });
                        });
                    </script>
                    <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
                        <!--begin::Subheader-->
                        <div class="subheader py-2 py-lg-4 project-workspace__header" id="kt_subheader">
                            <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                                <div class="project-workspace__heading">
                                    <p class="admin-page__eyebrow">Delivery tracking</p>
                                    <h2>Interventions</h2>
                                    <p>Track delivery entries, submission status, and approvals.</p>
                                </div>
                                <div class="project-workspace__header-actions">
                                    <span class="project-workspace__count">{{ $intervencontainers->count() }} {{ \Illuminate\Support\Str::plural('container', $intervencontainers->count()) }}</span>
                                    <button type="button" class="admin-page__button" data-bs-toggle="modal" data-bs-target="#modalZoom8787">
                                        <em class="icon ni ni-plus" aria-hidden="true"></em>
                                        Add intervention container
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="nk-block nk-block-lg">
                            <div class="card card-bordered card-preview project-workspace__content">
                                <div class="card-inner">
                                    @if($intervencontainers->isEmpty())
                                        <div class="project-detail__empty-state">
                                            <span class="project-detail__record-icon"><em class="icon ni ni-activity" aria-hidden="true"></em></span>
                                            <h3>No intervention containers yet</h3>
                                            <p>Create an intervention container to begin recording project delivery.</p>
                                            <button type="button" class="admin-page__button" data-bs-toggle="modal" data-bs-target="#modalZoom8787">
                                                <em class="icon ni ni-plus" aria-hidden="true"></em>
                                                Add intervention container
                                            </button>
                                        </div>
                                    @endif
                                    @foreach($intervencontainers as $key1 => $incontainer)
                                    @php
                                        $containerInterventions = $interventions->where('intervention_container_id', $incontainer->id);
                                        $containerFundingOne = $containerInterventions->sum('funding1');
                                        $containerFundingTwo = $containerInterventions->sum('funding2');
                                        $containerTotal = $containerInterventions->sum('total');
                                        $projectCurrencyCode = optional($projectshow->basecurrency)->currency_code
                                            ?: optional(optional($projectshow->program)->basecurrency)->currency_code;
                                    @endphp
                                    <div id="intervention-accordion-{{ $incontainer->id }}" class="accordion project-workspace__accordion project-intervention__container">
                                        <div class="accordion-item">
                                            <div class="project-intervention__container-head">
                                                <a href="#intervention-content-{{ $incontainer->id }}" class="accordion-head collapsed project-intervention__toggle" data-bs-toggle="collapse" data-bs-target="#intervention-content-{{ $incontainer->id }}" aria-expanded="false" aria-controls="intervention-content-{{ $incontainer->id }}">
                                                    <span class="project-intervention__container-icon"><em class="icon ni ni-activity" aria-hidden="true"></em></span>
                                                    <span class="project-intervention__container-heading">
                                                        <span>Intervention container</span>
                                                        <strong>{{ $incontainer->container_name }}</strong>
                                                    </span>
                                                    @if($incontainer->status == '01')
                                                        <span class="project-intervention__status project-intervention__status--draft">Draft</span>
                                                    @elseif($incontainer->status == '02')
                                                        <span class="project-intervention__status project-intervention__status--submitted">Submitted</span>
                                                    @elseif($incontainer->status == '03')
                                                        <span class="project-intervention__status project-intervention__status--forwarded">Forwarded</span>
                                                    @elseif($incontainer->status == '04')
                                                        <span class="project-intervention__status project-intervention__status--approved">Approved</span>
                                                    @elseif($incontainer->status == '05')
                                                        <span class="project-intervention__status project-intervention__status--rejected">Rejected</span>
                                                    @endif
                                                    <span class="accordion-icon"></span>
                                                </a>
                                                <div class="dropdown project-intervention__actions">
                                                    <button type="button" class="project-intervention__actions-trigger" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Actions for {{ $incontainer->container_name }}">
                                                        <span>Actions</span><em class="icon ni ni-chevron-down" aria-hidden="true"></em>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <ul class="link-list-plain">
                                                        @if($incontainer->status == '01')
                                                        <li class="preview-item">
                                                            <button type="button" id="addintervention12" data-id="{{ $incontainer->id }}" data-bs-toggle="modal" data-bs-target="#addintervention1"><em class="icon ni ni-plus" aria-hidden="true"></em>Add intervention</button>
                                                        </li> 

                                                        <li class="preview-item">
                                                            <button type="button" id="uploadintervention" data-id="{{ $incontainer->id }}" data-bs-toggle="modal" data-bs-target="#uploadintervention1"><em class="icon ni ni-upload" aria-hidden="true"></em>Upload Excel/CSV</button>
                                                        </li> 

                                                        <li class="preview-item">
                                                            <button type="button" id="submitcontainer" data-id="{{ $incontainer->id }}" data-bs-toggle="modal" data-bs-target="#submitcontainer"><em class="icon ni ni-send" aria-hidden="true"></em>Submit container</button>
                                                        </li> 
                                                        @elseif($incontainer->status == '02') 
                                                        @can('forward-intervention')
                                                        <li class="preview-item">
                                                            <button type="button" id="forwardintervention2" data-id="{{ $incontainer->id }}" data-bs-toggle="modal" data-bs-target="#forwardintervention1"><em class="icon ni ni-forward-arrow" aria-hidden="true"></em>Forward</button>
                                                        </li> 
                                                        @endcan
                                                        @can('approve-intervention')
                                                        <li class="preview-item">
                                                            <button type="button" id="approveintervention2" data-id="{{ $incontainer->id }}" data-bs-toggle="modal" data-bs-target="#approveintervention1"><em class="icon ni ni-done" aria-hidden="true"></em>Approve</button>
                                                        </li> 
                                                        @endcan
                                                        @can('reject-intervention')
                                                        <li class="preview-item">
                                                            <button type="button" id="rejectintervention2" data-id="{{ $incontainer->id }}" data-bs-toggle="modal" data-bs-target="#rejectintervention1"><em class="icon ni ni-cross" aria-hidden="true"></em>Reject</button>
                                                        </li> 
                                                        @endcan
                                                        <li class="preview-item">
                                                            <button type="button" id="cancelintervention" data-id="{{ $incontainer->id }}" data-bs-toggle="modal" data-bs-target="#cancelintervention1"><em class="icon ni ni-cross" aria-hidden="true"></em>Cancel</button>
                                                        </li> 

                                                        <li class="preview-item">
                                                            <button type="button" id="timeline12" data-id="{{ $incontainer->id }}" data-bs-toggle="modal" data-bs-target="#timeline2"><em class="icon ni ni-setting" aria-hidden="true"></em>Timeline</button>
                                                        </li> 
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                            </div>

                                            <div class="modal fade zoom" tabindex="-1" id="timeline2">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Timeline</h5>
                                                            <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                <em class="icon ni ni-cross"></em>
                                                            </a>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="nk-block nk-block-lg">
                                                                <div class="card card-bordered card-preview">
                                                                    <div class="card-inner">
                                                                        <div class="example-alerts">
                                                                            <div class="gy-4">
                                                                                <div class="example-alert">
                                                                                    <div class="alert alert-success alert-icon">
                                                                                        <em class="icon ni ni-check-circle"></em> <strong>{{$incontainer->container_name}} Created on</strong>
                                                                                        <i>{{ \Carbon\Carbon::parse($incontainer->created_at)->format('M j, Y, g:i A') }}</i> <strong>created
                                                                                        by </strong>{{Auth::user()->name}}
                                                                                    </div>
                                                                                </div>
                                                                                @if($incontainer->submitted_by != NULL)
                                                                                <div class="example-alert">
                                                                                    <div class="alert alert-secondary alert-icon">
                                                                                        <em class="icon ni ni-alert-circle"></em> <strong>{{$incontainer->container_name}} Submitted on</strong>
                                                                                        <i>{{ \Carbon\Carbon::createFromFormat('l dS \of F Y h:i:s A', $incontainer->submitted_on)->format('M j, Y, g:i A') }}</i></strong>
                                                                                        Submitted to <strong>{{$incontainer->submitted_to}} - <i>{{$incontainer->submitted_to_email}}</i></strong>
                                                                                    </div>
                                                                                </div>
                                                                                @endif
                                                                                @if($incontainer->forwarded_on != NULL)
                                                                                <div class="example-alert">
                                                                                    <div class="alert alert-primary alert-icon">
                                                                                        <em class="icon ni ni-alert-circle"></em> <strong>{{$incontainer->container_name}} Forwarded on</strong>
                                                                                        <i>{{ \Carbon\Carbon::createFromFormat('l dS \of F Y h:i:s A', $incontainer->forwarded_on)->format('M j, Y, g:i A') }}</i></strong>
                                                                                        Forwarded to <strong>{{$incontainer->forward_to_name}} - <i>{{$incontainer->forward_to_email}}</i></strong>
                                                                                    </div>
                                                                                </div>
                                                                                @endif
                                                                                @if($incontainer->approved_by != NULL)
                                                                                <div class="example-alert">
                                                                                    <div class="alert alert-success alert-icon">
                                                                                        <em class="icon ni ni-check-circle"></em> <strong>{{$incontainer->container_name}} Approved on</strong>
                                                                                        <i>{{ \Carbon\Carbon::createFromFormat('l dS \of F Y h:i:s A', $incontainer->approved_on)->format('M j, Y, g:i A') }}</i></strong>
                                                                                        Approved By <strong>{{$incontainer->approved_by}} - <i>{{$incontainer->approved_by_email}}</i></strong>
                                                                                    </div>
                                                                                </div>
                                                                                @endif
                                                                            </div>
                                                                        </div> 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer bg-light">
                                                            <span class="sub-text"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 


                                            <div class="accordion-body collapse" id="intervention-content-{{ $incontainer->id }}" data-bs-parent="#intervention-accordion-{{ $incontainer->id }}">
                                                <div class="accordion-inner">
                                                    @if($containerInterventions->isEmpty())
                                                    <div class="project-intervention__empty">
                                                        <span class="project-intervention__empty-icon"><em class="icon ni ni-activity" aria-hidden="true"></em></span>
                                                        <div>
                                                            <strong>No interventions in this container</strong>
                                                            <p>Add an intervention to start tracking delivery and expenditure.</p>
                                                        </div>
                                                        @if($incontainer->status == '01')
                                                        <button type="button" class="admin-page__button-secondary" id="addintervention12" data-id="{{ $incontainer->id }}" data-bs-toggle="modal" data-bs-target="#addintervention1">
                                                            <em class="icon ni ni-plus" aria-hidden="true"></em>Add intervention
                                                        </button>
                                                        @endif
                                                    </div>
                                                    @else
                                                            <div class="project-intervention__table-wrap">
                                                            <table class="table project-intervention__table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Activity</th>
                                                                        @foreach($accounts->take(2) as $account)
                                                                        <th>{{ $account->funding_name }}</th>
                                                                        @endforeach
                                                                        <th>Total</th>
                                                                        <th><span class="sr-only">Actions</span></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($containerInterventions as $object)
                                                                    <tr>
                                                                        <td data-label="#"> {{ $loop->iteration }} </td>
                                                                        <td>
                                                                            <div class="project-intervention__activity">
                                                                                <span class="project-intervention__activity-icon"><em class="icon ni ni-activity" aria-hidden="true"></em></span>
                                                                                <span>{{ optional($object->activity)->activity_title ?: 'Activity unavailable' }}</span>
                                                                            </div>
                                                                        </td>
                                                                        @if($accounts->count() > 0)
                                                                        <td>{{ $projectCurrencyCode }} @convert($object->funding1)</td>
                                                                        @endif
                                                                        @if($accounts->count() > 1)
                                                                        <td>{{ $projectCurrencyCode }} @convert($object->funding2)</td>
                                                                        @endif
                                                                        <td class="project-intervention__amount">{{ $projectCurrencyCode }} @convert($object->total)</td>
                                                                        <td class="project-intervention__row-actions">
                                                                            <div class="dropdown">
                                                                                <button type="button" class="project-intervention__row-action" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Actions for {{ optional($object->activity)->activity_title ?: 'intervention' }}">
                                                                                    <em class="icon ni ni-more-h" aria-hidden="true"></em>
                                                                                </button>
                                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                                    <ul class="link-list-plain">
                                                                                        <li><button type="button" id="editintervention" data-id="{{ $object->id }}" data-bs-toggle="modal" data-bs-target="#editinterventi"><em class="icon ni ni-edit" aria-hidden="true"></em>Edit intervention</button></li>
                                                                                        <li><button type="button" id="viewintervention" data-id="{{ $object->id }}" data-bs-toggle="modal" data-bs-target="#viewinterventi"><em class="icon ni ni-eye" aria-hidden="true"></em>View details</button></li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                            </div>
                                                    @endif
                                                            <div class="project-intervention__summary">
                                                                <div>
                                                                    <span>{{ optional($accounts->get(0))->funding_name ?: 'Funding 1' }}</span>
                                                                    <strong>{{ $projectCurrencyCode }} @convert($containerFundingOne)</strong>
                                                                </div>
                                                                <div>
                                                                    <span>{{ optional($accounts->get(1))->funding_name ?: 'Funding 2' }}</span>
                                                                    <strong>{{ $projectCurrencyCode }} @convert($containerFundingTwo)</strong>
                                                                </div>
                                                                <div class="project-intervention__summary-total">
                                                                    <span>Container total</span>
                                                                    <strong>{{ $projectCurrencyCode }} @convert($containerTotal)</strong>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <hr>
                                        </div>
                                    </div>
                                    @endforeach
                                                </div>

                                            </div>
                                        </div>

                                    </div>


                                    <div class="modal fade" tabindex="-1" id="modalZoom8787" aria-labelledby="add-intervention-container-title" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered project-detail__modal-dialog" role="document">
                                            <div class="modal-content project-detail__modal">
                                                <div class="modal-header">
                                                    <div class="project-detail__modal-heading">
                                                        <span class="project-detail__modal-icon"><em class="icon ni ni-activity" aria-hidden="true"></em></span>
                                                        <div>
                                                            <h5 class="modal-title" id="add-intervention-container-title">Add intervention container</h5>
                                                            <p>Create a container to organize project interventions.</p>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <em class="icon ni ni-cross"></em>
                                                    </button>
                                                </div>
                                                <form method="POST" action="{{ route('createicontainer') }}" class="project-detail__modal-form">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <input type="hidden" name="status" value="01">
                                                        <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">
                                                        <input type="hidden" name="organization_id" value="{{ Auth::user()->organization_id }}">
                                                        <input type="hidden" name="project_id" value="{{ $projectshow->id }}">

                                                        <div class="project-detail__form-grid">
                                                            <div class="project-detail__form-field project-detail__form-field--full">
                                                                <label class="form-label" for="intervention-container-name">Container name</label>
                                                                <input type="text" class="form-control" name="container_name" id="intervention-container-name" placeholder="Enter an intervention container name">
                                                                <small>Use a clear name that describes this group of interventions.</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="admin-page__button-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="admin-page__button">
                                                            <em class="icon ni ni-check" aria-hidden="true"></em>
                                                            Save container
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="modal fade zoom" tabindex="-1" id="addintervention1">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Add Intervention</h5>
                                                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                    <em class="icon ni ni-cross"></em>
                                                </a>
                                            </div>
                                            <div class="modal-body">
                                                <div class="nk-block nk-block-lg">
                                                    <div class="card card-bordered card-preview">
                                                        <div class="card-inner">
                                                            <ul class="nav nav-tabs mt-n3">
                                                                <li class="nav-item">
                                                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem53434777"><em class="icon ni ni-table"></em><span>Interventions</span></a>
                                                                </li>
                                                            </ul>

                                                            <div class="tab-content">
                                                                <div class="tab-pane active" id="tabItem53434777">
                                                                    <form method="POST" action="{{ route('createIntervention')}}" id="addInterventionValidate">
                                                                        @csrf
                                                                        <div class="row gy-4">

                                                                         <input type="hidden" class="form-control" value="01" name="status" id="default-01">
                                                                         <input type="hidden" class="form-control" id="intervention_container123" name="intervention_container_id">
                                                                         <input type="hidden" class="form-control" value="{{Auth::user()->id}}" name="created_by" id="default-01">
                                                                         <input type="hidden" class="form-control" value="{{Auth::user()->organization_id}}" name="organization_id" id="default-01">
                                                                         <input type="hidden" class="form-control" value="{{$projectshow->id}}" name="project_id" id="default-01">

                                                                         <div class="form-group">

                                                                            <div class="form-group" id="program">
                                                                                <label class="form-label" for="default-06">Select Activity<span style="color:red">*</span></label>
                                                                                <div class="form-control-wrap ">
                                                                                    <div class="form-control-select">
                                                                                        <select id="default-06" name="activity_id" class="form-control" id="activityid">
                                                                                            <option value="">-------Nothing Selected-------</option>
                                                                                            <option></option>                                                  
                                                                                            @foreach($activities as $obj)
                                                                                            <option value="{{$obj->id}}">{{$obj->activity_title}}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                    <!-- <script type="text/javascript">
                                                        $(document).ready(function() {
                                                            $('#activityid').change(function(){
                                                                $.get("{{ url('api/activityname')}}",
                                                                    { option: $(this).val() },
                                                                    function(data) {
                                                                        console.log(data);
                                                                        $('#activitytitle17').val(data);
                                                                    });
                                                            });
                                                        });
                                                    </script> -->

                                                    <script type="text/javascript">
                                                        $(document).ready(function() {
                                                            $('#activityid').change(function(){
                                                                $.get("{{ url('api/activityname')}}",
                                                                    { option: $(this).val() },
                                                                    function(data) {
                                                                        console.log('Service Code');
                                                                        $('#activitytitle17').val(data);
                                                                    });
                                                            });
                                                        });
                                                    </script>

                                                    <!-- <div class="form-group">
                                                        <label class="form-label" for="default-01">Activity Title</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" name="activity_title" id="activitytitle17">
                                                        </div>
                                                    </div> -->

                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <h6>Fundings</h6>
                                                                @foreach ($accounts as $key => $object)
                                                                <th scope="col">{{ $object->funding_name }}</th>
                                                                @endforeach

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <td>
                                                                <label class="form-label" for="default-01">Required<span style="color:red">*</span></label>
                                                                <input type="text" placeholder="e.g 200" class="form-control" name="funding1" id="funding1">
                                                            </td>
                                                            <br>
                                                            <td>
                                                                <label class="form-label" for="default-01">Required<span style="color:red">*</span></label>
                                                                <input type="text" placeholder="e.g 500" class="form-control" name="funding2" id="funding2">
                                                            </td>
                                                        </tbody>
                                                    </table>




                                                    <div class="form-group">
                                                        <label class="form-label" for="default-01">Total Amount<span style="color:red">*</span></label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" placeholder="Auto Calculation" class="form-control" name="total" id="total" readonly="">
                                                        </div>
                                                    </div>





                                                    <td><input type="hidden" name="valued" id="valued" readonly=""></td>
                                                    <td><input type="hidden" name="valuee" id="valuee" readonly=""></td>



                                                </div>

                                                <!-- <button type="submit" class="btn btn-primary"></button> -->
                                            </div>
                                            <br>
                                            <button style="margin-left: 40%;" type="submit" class="btn btn-round btn-primary"><em class="icon ni ni-navigate-fill"></em>&nbsp Save Intervention</button>
                                        </form>

                                        <script>
                                            $(document).ready(function() {
                                                $("#addInterventionValidate").validate({
                                                    rules: {
                                                        funding1: {
                                                            required: true,
                                                            digits: true
                                                        },
                                                        funding2: {
                                                            required: true,
                                                            digits: true
                                                        },
                                                        activity_name: {
                                                            required: true,
                                                        }
                                                    },
                                                    messages: {
                                                        funding1: {
                                                            required: "Please enter the amount in numbers",
                                                            minlength: "Your funding must consist of at least 1 number 0-9"
                                                        },
                                                        funding2: {
                                                            required: "Please enter the amount in numbers",
                                                            minlength: "Your funding must consist of at least 1 number 0-9"
                                                        },
                                                        activity_name: {
                                                            required: "Please Select Activity",
                                                        }
                                                        
                                                    },
                                                    submitHandler: function(form) {
                                                        form.submit();
                                                    }
                                                });
                                            });
                                        </script>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <span class="sub-text"></span>
                </div>
            </div>
        </div>
    </div>

<div class="tab-pane project-detail__tab-pane project-logframe" id="tabItem4" role="tabpanel" aria-labelledby="project-logframe-tab">
    <div class="project-logframe__header">
        <div>
            <p class="admin-page__eyebrow">Results framework · Project</p>
            <h2>Project Logframe</h2>
        </div>
        <button type="button" class="project-logframe__add-goal" data-bs-toggle="modal" data-bs-target="#addGoalDialog">
            <em class="icon ni ni-plus" aria-hidden="true"></em>
            Goal
        </button>
    </div>
    <div class="nk-block nk-block-lg project-logframe__tree">
        <div class="card card-bordered card-preview">
            <div class="card-inner">
                    <div class="project-logframe__table-head" aria-hidden="true">
                        <span>Results hierarchy</span><span aria-hidden="true"></span><span>Baseline</span><span>Target</span><span>Frequency</span><span>Type</span><span aria-hidden="true"></span>
                    </div>
                    @if($loopgoals != null && $loopgoals->count())
                    @foreach($loopgoals as $obj)
                    <div id="logframe-project-{{ $projectshow->id }}-goal-{{ $obj->id }}" class="accordion project-logframe__accordion">
                        <div class="accordion-item">
                            <div class="project-logframe__row-actions">
                            <div class="dropdown project-logframe__dropdown project-logframe__dropdown--add">
                                <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" aria-label="Add to goal" role="button" tabindex="0" data-bs-toggle="dropdown"><em class="icon ni ni-plus" aria-hidden="true"></em></a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                    <ul class="link-list-plain">
                                        <li class="preview-item">
                                            <button type="button" class="project-logframe__menu-item" data-goal-id="{{ $obj->id }}" data-goal-label="{{ $obj->goal_code }} - {{ $obj->goal_name }}" data-bs-toggle="modal" data-bs-target="#practice_modal"><em class="icon ni ni-plus" aria-hidden="true"></em><span>Add Outcome</span></button>
                                        </li> 
                                        <li class="preview-item">
                                            <button type="button" class="project-logframe__menu-item" data-goal-id="{{ $obj->id }}" data-goal-label="{{ $obj->goal_code }} - {{ $obj->goal_name }}" data-bs-toggle="modal" data-bs-target="#activity_modal"><em class="icon ni ni-plus" aria-hidden="true"></em><span>Add Activity</span></button>
                                        </li> 
                                        <li class="preview-item">
                                            <button type="button" class="project-logframe__menu-item" data-goal-id="{{ $obj->id }}" data-goal-label="{{ $obj->goal_code }} - {{ $obj->goal_name }}" data-bs-toggle="modal" data-bs-target="#indicator_modal"><em class="icon ni ni-plus" aria-hidden="true"></em><span>Add Indicator</span></button>
                                        </li> 
                                    </ul>
                                </div>
                            </div>
                            <div class="project-logframe__row-options">
                                <button type="button" id="editgoal" data-id="{{ $obj->id }}" data-bs-toggle="modal" data-bs-target="#editgoal_modal" aria-label="Edit goal"><em class="icon ni ni-edit" aria-hidden="true"></em></button>
                                <button type="button" id="deletegoal" data-id="{{ $obj->id }}" data-bs-toggle="modal" data-bs-target="#deletegoal" aria-label="Delete goal"><em class="icon ni ni-trash" aria-hidden="true"></em></button>
                            </div>
                            </div>

                            <a href="#logframe-project-goal-{{ $obj->id }}" class="accordion-head collapsed project-logframe__row-toggle" data-bs-toggle="collapse" data-bs-target="#logframe-project-goal-{{ $obj->id }}" aria-expanded="false" aria-controls="logframe-project-goal-{{ $obj->id }}">
                                <h6 class="title"><span class="badge bg-success">GOAL</span><span class="project-logframe__row-title">{{ $obj->goal_code }} - {{ $obj->goal_name }}</span><span class="accordion-icon"></span></h6>
                            </a>
                            <div class="accordion-body collapse" id="logframe-project-goal-{{ $obj->id }}" data-bs-parent="#logframe-project-{{ $projectshow->id }}-goal-{{ $obj->id }}">
                                <div class="accordion-inner">

                                    @foreach($goalindicator->where('goal_id', $obj->id) as $goalindicator)
                                    <div class="project-logframe__data-row">
                                    <h6 class="project-logframe__indicator-row">
                                        <span class="project-logframe__indicator-name"><span class="badge bg-blue">INDICATOR</span><span>{{ $goalindicator->indicator_title }}</span></span>
                                        <span data-label="Baseline">{{ $goalindicator->baseline_none !== null && $goalindicator->baseline_none !== '' ? $goalindicator->baseline_none : '—' }}</span>
                                        <span data-label="Target">{{ $goalindicator->target_none !== null && $goalindicator->target_none !== '' ? $goalindicator->target_none : '—' }}</span>
                                        <span data-label="Frequency">{{ $goalindicator->reporting_frequency ?: '—' }}</span>
                                        <span data-label="Type">{{ $goalindicator->type ?: '—' }}</span>
                                    </h6>
                                    <div class="project-logframe__row-options">
                                        <button type="button" id="editgoalIndicator" data-id="{{ $goalindicator->id }}" data-bs-toggle="modal" data-bs-target="#editindicator_modal" aria-label="Edit indicator"><em class="icon ni ni-edit" aria-hidden="true"></em></button>
                                        <button type="button" id="deleteindicator" data-id="{{ $goalindicator->id }}" data-bs-toggle="modal" data-bs-target="#deleteindicator" aria-label="Delete indicator"><em class="icon ni ni-trash" aria-hidden="true"></em></button>
                                    </div>
                                    </div>
                                        </div>
                                    @endforeach

                                    @foreach($activitygoal->where('goal_id', $obj->id) as $goalactivity)
                                    <div class="project-logframe__data-row">
                                    <h6 class="project-logframe__activity-row"><span class="badge bg-danger">ACTIVITY</span><span class="project-logframe__entry-label">{{$goalactivity->activity_code}} -  {{$goalactivity->activity_title}}</span>
                                    </h6>
                                    <div class="project-logframe__row-options">
                                        <button type="button" id="editactivity" data-id="{{ $goalactivity->id }}" data-bs-toggle="modal" data-bs-target="#editactivity_modal" aria-label="Edit activity"><em class="icon ni ni-edit" aria-hidden="true"></em></button>
                                        <button type="button" id="deleteactivity" data-id="{{ $goalactivity->id }}" data-bs-toggle="modal" data-bs-target="#deleteactivity" aria-label="Delete activity"><em class="icon ni ni-trash" aria-hidden="true"></em></button>
                                    </div>
                                    </div>
                                    @endforeach
                            <!-- <hr> -->
                            @foreach($goaloutcomes->where('goal_id', $obj->id) as $outcom)
                            <div class="accordion-item">
                                <div class="project-logframe__row-actions">
                                <div class="dropdown project-logframe__dropdown project-logframe__dropdown--add">
                                    <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" aria-label="Add to outcome" role="button" tabindex="0" data-bs-toggle="dropdown"><em class="icon ni ni-plus" aria-hidden="true"></em></a>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                        <ul class="link-list-plain">
                                            <li class="preview-item">
                                                <button type="button" class="project-logframe__menu-item" id="addoutput" data-id="{{ $outcom->id }}" data-bs-toggle="modal" data-bs-target="#output_model"><em class="icon ni ni-plus" aria-hidden="true"></em><span>Add Output</span></button>
                                            </li> 
                                            <li class="preview-item">
                                                <button type="button" class="project-logframe__menu-item" id="addoutcomeactivity" data-id="{{ $outcom->id }}" data-bs-toggle="modal" data-bs-target="#activity1"><em class="icon ni ni-plus" aria-hidden="true"></em><span>Add Activity</span></button>
                                            </li>  
                                            <li class="preview-item">
                                                <button type="button" class="project-logframe__menu-item" id="addoutcomeindicator" data-id="{{ $outcom->id }}" data-bs-toggle="modal" data-bs-target="#indicator1"><em class="icon ni ni-plus" aria-hidden="true"></em><span>Add Indicator</span></button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="project-logframe__row-options">
                                    <button type="button" id="editoutcome" data-id="{{ $outcom->id }}" data-bs-toggle="modal" data-bs-target="#editoutcome_modal" aria-label="Edit outcome"><em class="icon ni ni-edit" aria-hidden="true"></em></button>
                                    <button type="button" id="deleteoutcome" data-id="{{ $outcom->id }}" data-bs-toggle="modal" data-bs-target="#deleteoutcome" aria-label="Delete outcome"><em class="icon ni ni-trash" aria-hidden="true"></em></button>
                                </div>
                                </div>
                                <a href="#logframe-project-outcome-{{ $outcom->id }}" class="accordion-head collapsed project-logframe__row-toggle" data-bs-toggle="collapse" data-bs-target="#logframe-project-outcome-{{ $outcom->id }}" aria-expanded="false" aria-controls="logframe-project-outcome-{{ $outcom->id }}">
                                    <h6><span class="badge bg-warning">OUTCOME</span><span class="project-logframe__row-title">{{ $outcom->outcome_code }} - {{ $outcom->outcome_title }}</span><span class="accordion-icon"></span></h6>
                                </a>
                                <div class="accordion-body collapse" id="logframe-project-outcome-{{ $outcom->id }}">
                                    <div class="accordion-inner">

                                        @foreach($indicators2->where('outcome_id', $outcom->id) as $outcomeindicator2)
                                        @if($outcomeindicator2->outcome_id == $outcom->id) 
                                        <div class="project-logframe__data-row">
                                        <h6 class="project-logframe__indicator-row">
                                            <span class="project-logframe__indicator-name"><span class="badge bg-blue">INDICATOR</span><span>{{ $outcomeindicator2->indicator_title }}</span></span>
                                            <span data-label="Baseline">{{ $outcomeindicator2->baseline_none !== null && $outcomeindicator2->baseline_none !== '' ? $outcomeindicator2->baseline_none : '—' }}</span>
                                            <span data-label="Target">{{ $outcomeindicator2->target_none !== null && $outcomeindicator2->target_none !== '' ? $outcomeindicator2->target_none : '—' }}</span>
                                            <span data-label="Frequency">{{ $outcomeindicator2->reporting_frequency ?: '—' }}</span>
                                            <span data-label="Type">{{ $outcomeindicator2->type ?: '—' }}</span>
                                        </h6>
                                        <div class="project-logframe__row-options">
                                            <button type="button" id="editoutcomeindicator" data-id="{{ $outcomeindicator2->id }}" data-bs-toggle="modal" data-bs-target="#editoutcomeindicator" aria-label="Edit indicator"><em class="icon ni ni-edit" aria-hidden="true"></em></button>
                                            <button type="button" id="deleteoutcomeindicator" data-id="{{ $outcomeindicator2->id }}" data-bs-toggle="modal" data-bs-target="#deleteoutcomeindicator" aria-label="Delete indicator"><em class="icon ni ni-trash" aria-hidden="true"></em></button>
                                        </div>
                                        </div>
                                        @endif
                                        @endforeach

                                        <hr>
                                        @foreach($activity2 as $outcomeactivity)
                                        @if($outcomeactivity->outcome_id == $outcom->id && $outcomeactivity->project_id == $projectshow->id)  
                                        <div class="project-logframe__data-row">
                                        <h6 class="project-logframe__activity-row"><span class="badge bg-danger">ACTIVITY</span><span class="project-logframe__entry-label">{{$outcomeactivity->activity_code}} -  {{$outcomeactivity->activity_title}}</span>
                                        </h6>
                                        <div class="project-logframe__row-options">
                                            <button type="button" id="editoutcomeactivity" data-id="{{ $outcomeactivity->id }}" data-bs-toggle="modal" data-bs-target="#editoutcomeactivity_modal" aria-label="Edit activity"><em class="icon ni ni-edit" aria-hidden="true"></em></button>
                                            <button type="button" id="deleteoutcomeactivity" data-id="{{ $outcomeactivity->id }}" data-bs-toggle="modal" data-bs-target="#deleteoutcomeactivity" aria-label="Delete activity"><em class="icon ni ni-trash" aria-hidden="true"></em></button>
                                        </div>
                                        </div>
                                        @endif
                                        @endforeach
                                <!-- <hr> -->
                                @foreach($projectoutput->where('outcome_id', $outcom->id) as $output)
                                @if($output->outcome_id == $outcom->id)
                                <div class="accordion-item">
                                    <div class="project-logframe__row-actions">
                                    <div class="dropdown project-logframe__dropdown project-logframe__dropdown--add">
                                        <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" aria-label="Add to output" role="button" tabindex="0" data-bs-toggle="dropdown"><em class="icon ni ni-plus" aria-hidden="true"></em></a>
                                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                            <ul class="link-list-plain">
                                                <li class="preview-item">
                                                    <button type="button" class="project-logframe__menu-item" id="addoutputactivity1" data-id="{{ $output->id }}" data-bs-toggle="modal" data-bs-target="#activity2"><em class="icon ni ni-plus" aria-hidden="true"></em><span>Add Activity</span></button>
                                                </li> 
                                                <li class="preview-item">
                                                    <button type="button" class="project-logframe__menu-item" id="addoutputindicator" data-id="{{ $output->id }}" data-bs-toggle="modal" data-bs-target="#indicator2"><em class="icon ni ni-plus" aria-hidden="true"></em><span>Add Indicator</span></button>
                                                </li> 
                                            </ul>
                                        </div>
                                    </div> 
                                    <div class="project-logframe__row-options">
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#editoutput_modal" id="editoutput" data-id="{{ $output->id }}" aria-label="Edit output"><em class="icon ni ni-edit" aria-hidden="true"></em></button>
                                        <button type="button" id="deleteoutput" data-id="{{ $output->id }}" data-bs-toggle="modal" data-bs-target="#deleteoutput" aria-label="Delete output"><em class="icon ni ni-trash" aria-hidden="true"></em></button>
                                    </div>
                                    </div>

                                    <a href="#logframe-project-output-{{ $output->id }}" class="accordion-head collapsed project-logframe__row-toggle" data-bs-toggle="collapse" data-bs-target="#logframe-project-output-{{ $output->id }}" aria-expanded="false" aria-controls="logframe-project-output-{{ $output->id }}">
                                        <h6><span class="badge bg-purple">OUTPUT</span><span class="project-logframe__row-title">{{ $output->output_code }} - {{ $output->output_name }}</span><span class="accordion-icon"></span></h6>
                                    </a>
                                    <div class="accordion-body collapse" id="logframe-project-output-{{ $output->id }}">
                                        <div class="accordion-inner">

                                           @foreach($outoutindicator2 as $outputindicator2)
                                           @if($outputindicator2->output_id == $output->id) 
                                              <div class="project-logframe__data-row">
                                           <h6 class="project-logframe__indicator-row">
                                            <span class="project-logframe__indicator-name"><span class="badge bg-blue">INDICATOR</span><span>{{ $outputindicator2->indicator_title }}</span></span>
                                            <span data-label="Baseline">{{ $outputindicator2->baseline_none !== null && $outputindicator2->baseline_none !== '' ? $outputindicator2->baseline_none : '—' }}</span>
                                            <span data-label="Target">{{ $outputindicator2->target_none !== null && $outputindicator2->target_none !== '' ? $outputindicator2->target_none : '—' }}</span>
                                            <span data-label="Frequency">{{ $outputindicator2->reporting_frequency ?: '—' }}</span>
                                            <span data-label="Type">{{ $outputindicator2->type ?: '—' }}</span>
                                        </h6>
                                        <div class="project-logframe__row-options">
                                            <button type="button" id="editoutputindicator" data-id="{{ $outputindicator2->id }}" data-bs-toggle="modal" data-bs-target="#editoutputindicator" aria-label="Edit indicator"><em class="icon ni ni-edit" aria-hidden="true"></em></button>
                                            <button type="button" id="deleteoutputindicator" data-id="{{ $outputindicator2->id }}" data-bs-toggle="modal" data-bs-target="#deleteoutputindicator" aria-label="Delete indicator"><em class="icon ni ni-trash" aria-hidden="true"></em></button>
                                        </div>
                                        </div>
                                        @endif
                                        @endforeach

                                        <hr>

                                        @foreach($outputactivity2 as $outputactv)
                                        @if($outputactv->output_id == $output->id && $outputactv->project_id == $projectshow->id)  
                                        <div class="project-logframe__data-row">
                                        <h6 class="project-logframe__activity-row"><span class="badge bg-danger">ACTIVITY</span><span class="project-logframe__entry-label">{{$outputactv->activity_code}} -  {{$outputactv->activity_title}}</span>
                                        </h6>
                                        <div class="project-logframe__row-options">
                                            <button type="button" id="editoutputcomeactivity" data-id="{{ $outputactv->id }}" data-bs-toggle="modal" data-bs-target="#editoutputactivity_modal" aria-label="Edit activity"><em class="icon ni ni-edit" aria-hidden="true"></em></button>
                                            <button type="button" id="deleteoutputactivity" data-id="{{ $outputactv->id }}" data-bs-toggle="modal" data-bs-target="#deleteoutputactivity" aria-label="Delete activity"><em class="icon ni ni-trash" aria-hidden="true"></em></button>
                                        </div>
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @else
                        <div class="project-logframe__empty">
                            <span class="project-logframe__empty-icon"><em class="icon ni ni-view-col" aria-hidden="true"></em></span>
                            <div>
                                <h3>No results hierarchy yet</h3>
                                <p>Add a goal to start building this project’s logframe.</p>
                            </div>
                            @if ($logframes)
                                <button type="button" class="admin-page__button-secondary" data-bs-toggle="modal" data-bs-target="#addGoalDialog">
                                    <em class="icon ni ni-plus" aria-hidden="true"></em>
                                    Add goal
                                </button>
                            @endif
                        </div>
                    @endif
            </div>
        </div>
    </div>
</div>

<div class="tab-pane project-detail__tab-pane" id="tabItem5" role="tabpanel" aria-labelledby="project-funding-tab">
    <section class="project-detail__panel">
        <header class="project-detail__panel-header">
            <div>
                <p class="admin-page__eyebrow">Programme resources</p>
                <h2>Funding sources</h2>
                <p>Funding categories available to this project through its programme.</p>
            </div>
            <span class="project-workspace__count">{{ $accounts->count() }} {{ \Illuminate\Support\Str::plural('source', $accounts->count()) }}</span>
        </header>

        @if ($accounts->isEmpty())
            <div class="project-detail__empty-state">
                <span class="project-detail__record-icon"><em class="icon ni ni-wallet-out" aria-hidden="true"></em></span>
                <h3>No funding sources available</h3>
                <p>Link this project to a programme and configure funding sources there to make them available here.</p>
            </div>
        @else
            <div class="project-funding__list" aria-label="Project funding sources">
                @foreach ($accounts as $object)
                    <article class="project-funding__resource">
                        <span class="project-funding__icon" aria-hidden="true"><em class="icon ni ni-wallet-out"></em></span>
                        <div class="project-funding__content">
                            <h3>{{ $object->funding_name }}</h3>
                            <div class="project-funding__details">
                                <div class="project-funding__detail">
                                    <span>Funding type</span>
                                    <strong>{{ $object->funding_type ?: 'Not specified' }}</strong>
                                </div>
                                @if ($object->expenditure)
                                    <div class="project-funding__detail">
                                        <span>Expenditure</span>
                                        <strong>{{ $object->expenditure }}</strong>
                                    </div>
                                @endif
                            </div>
                            @if ($object->description)
                                <p class="project-funding__description">{{ $object->description }}</p>
                            @endif
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </section>
</div>

<div class="tab-pane project-detail__tab-pane" id="tabItem6" role="tabpanel" aria-labelledby="project-users-tab">
    <section class="project-detail__panel">
        <header class="project-detail__panel-header">
            <div>
                <p class="admin-page__eyebrow">Project team</p>
                <h2>Project users</h2>
                <p>People who have access to collaborate on this project.</p>
            </div>
            <div class="project-workspace__header-actions">
                <span class="project-workspace__count">{{ $projectusers->count() }} {{ \Illuminate\Support\Str::plural('member', $projectusers->count()) }}</span>
                <button type="button" class="admin-page__button" data-bs-toggle="modal" data-bs-target="#addusers">
                    <em class="icon ni ni-user-add" aria-hidden="true"></em>
                    Add project user
                </button>
            </div>
        </header>

        @if ($projectusers->isEmpty())
            <div class="project-detail__empty-state">
                <span class="project-detail__record-icon program-detail__record-icon--blue"><em class="icon ni ni-users" aria-hidden="true"></em></span>
                <h3>No project users yet</h3>
                <p>Invite colleagues from your organization or affiliated organizations to collaborate.</p>
                <button type="button" class="admin-page__button" data-bs-toggle="modal" data-bs-target="#addusers">
                    <em class="icon ni ni-user-add" aria-hidden="true"></em>
                    Add project user
                </button>
            </div>
        @else
            <div class="project-detail__record-list" aria-label="Project team members">
                @foreach ($projectusers as $object)
                    <article class="project-detail__record project-team__record">
                        <span class="project-team__avatar" aria-hidden="true">{{ strtoupper(substr($object->name ?: $object->email, 0, 1)) }}</span>
                        <div class="project-detail__record-main">
                            <h3>{{ trim(($object->name ?: '') . ' ' . ($object->last_name ?: '')) ?: $object->email }}</h3>
                            @if ($object->email)
                                <div class="project-detail__record-meta"><span>{{ $object->email }}</span></div>
                            @endif
                        </div>
                        <span class="admin-page__badge admin-page__badge--green">Project member</span>
                    </article>
                @endforeach
            </div>
        @endif
    </section>
</div>

<div class="tab-pane project-detail__tab-pane" id="tabItem8" role="tabpanel" aria-labelledby="project-expenses-tab">
    <section class="project-detail__panel">
        <header class="program-detail__panel-header">
            <div>
                <p class="admin-page__eyebrow">Financial tracking</p>
                <h2>Project expenses</h2>
                <p>Review budget, spending, and reporting frequency for each expense record.</p>
            </div>
            <span class="project-workspace__count">{{ $projectexpenses->count() }} {{ \Illuminate\Support\Str::plural('record', $projectexpenses->count()) }}</span>
        </header>

        @if ($projectexpenses->isEmpty())
            <div class="program-detail__empty-state">
                <span class="program-detail__record-icon program-detail__record-icon--violet"><em class="icon ni ni-wallet-out" aria-hidden="true"></em></span>
                <h3>No expense records yet</h3>
                <p>Expense records associated with this project will appear here.</p>
            </div>
        @else
            <div class="program-detail__record-list" aria-label="Project expense records">
                @foreach ($projectexpenses as $object)
                    <article class="program-detail__record">
                        <span class="program-detail__record-icon program-detail__record-icon--violet" aria-hidden="true">
                            <em class="icon ni ni-wallet-out"></em>
                        </span>
                        <div class="program-detail__record-main">
                            <h3>Budget #{{ $object->budget_id }} <span class="project-detail__description-divider">·</span> Funding #{{ $object->funding_id }}</h3>
                            <div class="program-detail__record-meta">
                                <span><strong>Annual budget:</strong> {{ $object->total_budget }}</span>
                                <span><strong>Total expense:</strong> {{ $object->total_expense }}</span>
                                <span><strong>Reporting frequency:</strong> {{ $object->reporting_frequency_tally }}</span>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </section>
</div>

<div class="tab-pane project-detail__tab-pane" id="tabItem7" role="tabpanel" aria-labelledby="project-documents-tab">
    <section class="project-detail__panel">
        <header class="program-detail__panel-header">
            <div>
                <p class="admin-page__eyebrow">Project resources</p>
                <h2>Documents</h2>
                <p>Manage and access files shared with this project.</p>
            </div>
            <div class="project-workspace__header-actions">
                <span class="project-workspace__count">{{ $documents->count() }} {{ \Illuminate\Support\Str::plural('document', $documents->count()) }}</span>
                <button type="button" class="admin-page__button" data-bs-toggle="modal" data-bs-target="#addprogdoc">
                    <em class="icon ni ni-file" aria-hidden="true"></em>
                    Add project document
                </button>
            </div>
        </header>

        @if ($documents->isEmpty())
            <div class="program-detail__empty-state">
                <span class="program-detail__record-icon program-detail__record-icon--blue"><em class="icon ni ni-file" aria-hidden="true"></em></span>
                <h3>No project documents yet</h3>
                <p>Upload a project document to make it available to your team.</p>
                <button type="button" class="admin-page__button" data-bs-toggle="modal" data-bs-target="#addprogdoc">
                    <em class="icon ni ni-file" aria-hidden="true"></em>
                    Add project document
                </button>
            </div>
        @else
            <div class="program-detail__record-list" aria-label="Project documents">
                @foreach ($documents as $object)
                    <article class="program-detail__record">
                        <span class="program-detail__record-icon program-detail__record-icon--blue" aria-hidden="true">
                            <em class="icon ni ni-file"></em>
                        </span>
                        <div class="program-detail__record-main">
                            <h3>{{ $object->doc_name }}</h3>
                            <div class="program-detail__record-meta">
                                @if ($object->status == '01')
                                    <span class="admin-page__badge admin-page__badge--neutral">Draft</span>
                                @elseif ($object->status == '02')
                                    <span class="admin-page__badge admin-page__badge--green">Approved</span>
                                @else
                                    <span class="admin-page__badge admin-page__badge--neutral">Status {{ $object->status }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="program-detail__record-actions">
                            <a class="admin-page__action" href="{{ url('download/'.$object->id) }}">
                                <em class="icon ni ni-download" aria-hidden="true"></em>
                                Download
                            </a>
                            <a class="admin-page__action" href="{{ url('documentview/'.$object->id) }}">
                                <em class="icon ni ni-eye" aria-hidden="true"></em>
                                Archive
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </section>

    <div class="modal fade" tabindex="-1" id="addprogdoc" aria-labelledby="add-project-document-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered project-detail__modal-dialog" role="document">
            <div class="modal-content project-detail__modal">
                <div class="modal-header">
                    <div class="project-detail__modal-heading">
                        <span class="project-detail__modal-icon"><em class="icon ni ni-file" aria-hidden="true"></em></span>
                        <div>
                            <h5 class="modal-title" id="add-project-document-title">Add project document</h5>
                            <p>Upload a file for the project team to access.</p>
                        </div>
                    </div>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </button>
                </div>
                <form method="POST" action="{{ route('documents.store') }}" enctype="multipart/form-data" class="project-detail__modal-form">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="status" value="01">
                        <input type="hidden" name="project_id" value="{{ $projectshow->id }}">
                        <input type="hidden" name="organization_id" value="{{ Auth::user()->organization_id }}">

                        <div class="project-detail__form-grid">
                            <div class="project-detail__form-field project-detail__form-field--full">
                                <label class="form-label" for="project-document-name">Document name</label>
                                <input type="text" name="doc_name" class="form-control" id="project-document-name" placeholder="e.g. Project implementation plan">
                            </div>
                            <div class="project-detail__form-field project-detail__form-field--full">
                                <label class="form-label" for="project-document-file">Choose a file</label>
                                <input type="file" name="file" class="form-control" id="project-document-file">
                                <small>Choose the document you want to upload.</small>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="admin-page__button-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="admin-page__button">
                            <em class="icon ni ni-upload" aria-hidden="true"></em>
                            Upload document
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</div>
</div>
</div>
</div>


<div class="modal fade zoom" tabindex="-1" id="modalZoom121">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Container Approval</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="nk-block nk-block-lg">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <ul class="nav nav-tabs mt-n3">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem53434"><em class="icon ni ni-user"></em><span>Annual Work Plan</span></a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem53434">
                                    <form method="POST" action="{{ route('createwpcontainer')}}">
                                        @csrf
                                        <div class="row gy-4">

                                          <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label" for="default-textarea">Approval Comment</label>
                                                <div class="form-control-wrap">
                                                    <textarea class="form-control no-resize" name="approval_comment" id="default-textarea"></textarea>
                                                </div>
                                            </div>
                                        </div> 

                                        <button type="submit" class="btn btn-primary">Approve</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer bg-light">
            <span class="sub-text"></span>
        </div>
    </div>
</div>
</div>


<!-- Create Project Goal Indicator---->
<script>
    $(document).ready(function(){
        $('#baseline').hide();
        $('#target').hide();
        $('#label').hide();
        $('#baseline1').hide();
        $('#target1').hide();
        $('#Disaggregation').hide();

        $('#disaggregation').change(function(){
          if($(this).val() == 'none'){
            $('#baseline').show();
            $('#target').show();
            $('#label').show();
            $('#Disaggregation').hide();
        }else if($(this).val() == 'Disaggregation'){
            $('#Disaggregation').show();
            $('#baseline').hide();
            $('#target').hide();
            $('#label').hide();
        }else if($(this).val() == 'ALIENID'){
            $('#document_number').show();
        }
        else{
           $('#null').show('');
       }
   });
    });

</script>

<div class="modal fade zoom" tabindex="-1" id="indicator_modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="logframe-indicator__heading">
                    <h5 class="modal-title">Add Project Goal Indicator</h5>
                    <p class="logframe-indicator__goal-context">
                        For goal: {{ optional($goalframe)->goal_code }} - {{ optional($goalframe)->goal_name }}
                    </p>
                </div>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">

                <form id="projectgoalindicator">
                    @csrf
                    <div class="logframe-indicator__form-grid">
                        <input type="hidden" name="goal_name" value="{{ optional($goalframe)->goal_code }} - {{ optional($goalframe)->goal_name }}">
                        <input type="hidden" name="created_by" class="form-control" value="{{Auth::user()->id}}" readonly="">
                        <input type="hidden" name="organization_id" class="form-control" value="{{Auth::user()->organization_id}}" readonly="">
                        <input type="hidden" name="project_id" class="form-control" value="{{$projectshow->id}}" readonly="">
                        <input type="hidden" name="goal_id" class="form-control" value="{{ optional($goalframe)->id }}" readonly="">
                        <input type="hidden" name="status" class="form-control" value="01" readonly="">



                        <div class="form-group logframe-indicator__title">
                            <label class="form-label" for="default-01">Indicator Title<span style="color:red">*</span></label>
                            <div class="form-control-wrap">
                                <input type="text" name="indicator_title" class="form-control" id="indicator_title" placeholder="Enter Indicator Title">
                            </div>
                        </div>

                        <div class="form-group logframe-indicator__frequency">
                            <label class="form-label" for="default-06">Reporting Frequency<span style="color:red">*</span></label>
                            <div class="form-control-wrap ">
                                <div class="form-control-select">
                                    <select class="form-control" name="reporting_frequency" id="reporting_frequency">
                                        <option value="">Select reporting frequency</option>
                                        <option value="Monthly">Monthly</option>
                                        <option value="Bi-Monthly">Bi-Monthly</option>
                                        <option value="Quaterly">Quarterly</option>
                                        <option value="Semi-Annual">Semi-Annual</option>
                                        <option value="Annual">Annual</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group logframe-indicator__type">
                            <label class="form-label" for="default-06">Type<span style="color:red">*</span></label>
                            <div class="form-control-wrap ">
                                <div class="form-control-select">
                                    <select class="form-control" name="type" id="type">
                                        <option value="">Select indicator type</option>
                                        <option value="Quantitative">Quantitative</option>
                                        <option value="Qualitative">Qualitative</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group logframe-indicator__disaggregation">
                            <label class="form-label" for="default-06">Disaggregation<span style="color:red">*</span></label>
                            <div class="form-control-wrap ">
                                <div class="form-control-select">
                                    <select class="form-control" name="disaggregation" id="disaggregation">
                                        <option value="">Select disaggregation</option>
                                        <!-- <option value="none">None</option> -->
                                        <option value="Disaggregation">Disaggregation</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-4 col-sm-6 logframe-indicator__measure">
                            <div class="form-group" id="label">
                                <label class="form-label" for="default-01">Label</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="label_none" class="form-control" id="default-01" placeholder="Enter label">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6 logframe-indicator__measure">
                            <div class="form-group" id="baseline">
                                <label class="form-label" for="default-01">Baseline</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="baseline_none" class="form-control" id="default-01" placeholder="Enter baseline">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6 logframe-indicator__measure">
                            <div class="form-group" id="target">
                                <label class="form-label" for="default-01">Target</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="target_none" class="form-control" id="default-01" placeholder="Enter target">
                                </div>
                            </div>
                        </div>


                        <div role="tabpanel" class="tab-pane logframe-indicator__breakdown" id="Disaggregation">

                            <div id='ncontainer'>
                              <div class="logframe-indicator__breakdown-heading">
                                <h6>Disaggregation breakdown</h6>
                                <p>Add the categories you want to track, with a baseline and target for each.</p>
                              </div>

                              <table id="nextkin" border="1" cellspacing="0">
                                <tr>
                                  <th><input class='ncheck_all' type='checkbox' onclick="select_all()"/></th>
                                  <th>#</th>
                                  <th>Label</th>
                                  <th>Baseline</th>
                                  <th>Target</th>
                              </tr>
                              <tr>
                                  <td><input type='checkbox' class='ncase'/></td>
                                  <td><span id='nsnum'>1.</span></td>
                                  <td><input class="form-control" type='text' id='dvalue' name='dvalue[0]' value="{{{ Input::old('dvalue[0]') }}}"/></td>
                                  <td><input class="form-control" type='text' id='dbaseline' name='dbaseline[0]' value="{{{ Input::old('dbaseline[0]') }}}"/></td>
                                  <td><input class="form-control" type='text' id='dtarget' name='dtarget[0]' value="{{{ Input::old('dtarget[0]') }}}"/></td>

                              </tr>
                          </table>

                          <div class="logframe-indicator__breakdown-actions">
                            <button type="button" class='ndelete'>Delete selected</button>
                            <button type="button" class='naddmore'>Add category</button>
                          </div>
                      </div>
                      <script>
                        $(".ndelete").on('click', function() {
                          if($('.ncase:checkbox:checked').length > 0){
                            if (window.confirm("Are you sure you want to delete this Disaggregation detail(s)?"))
                            {
                              $('.ncase:checkbox:checked').parents("#nextkin tr").remove();
                              $('.ncheck_all').prop("checked", false);
                              check();
                          }else{
                              $('.ncheck_all').prop("checked", false);
                              $('.ncase').prop("checked", false);
                          }
                      }
                  });
                        var i=2;
                        $(".naddmore").on('click',function(){
                          count=$('#nextkin tr').length;
                          var data="<tr><td><input type='checkbox' class='ncase'/></td><td><span id='nsnum"+i+"'>"+count+".</span></td>";

                          data +="<td><input class='form-control' type='text' id='dvalue"+i+"' name='dvalue["+(i-1)+"]' value='{{{ Input::old('dvalue["+(i-1)+"]') }}}'/></td><td><input class='form-control' type='text' id='dbaseline"+i+"' name='dbaseline["+(i-1)+"]' value='{{{ Input::old('dbaseline["+(i-1)+"]') }}}'/></td><td><input class='form-control' type='text' id='dtarget"+i+"' name='dtarget["+(i-1)+"]' value='{{{ Input::old('dtarget["+(i-1)+"]') }}}'/></td>";
                          $('#nextkin').append(data);
                          i++;
                      });

                        function select_all() {
                          $('input[class=ncase]:checkbox').each(function(){
                            if($('input[class=ncheck_all]:checkbox:checked').length == 0){
                              $(this).prop("checked", false);
                          } else {
                              $(this).prop("checked", true);
                          }
                      });
                      }

                      function check(){
                          obj=$('#nextkin tr').find('span');
                          $.each( obj, function( key, value ) {
                            id=value.id;
                            $('#'+id).html(key+1);
                        });
                      }

                  </script>
              </div>

              <div class="col-sm-12 logframe-indicator__description">
                <div class="form-group">
                    <label class="form-label" for="default-textarea">Indicator Description<i><span style="color:grey">(Optional)</span></i></label>
                    <div class="form-control-wrap">
                        <textarea class="form-control no-resize" name="indicator_description" id="default-textarea"></textarea>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Add Goal Indicator</button>
        </div>

    </form>

    <script>
        $(document).ready(function() {
            $("#projectgoalindicator").validate({
                rules: {
                    indicator_title: {
                        required: true,
                        minlength: 5
                    },
                    reporting_frequency: {
                        required: true,
                    },
                    type: {
                        required: true,
                    },
                    disaggregation: {
                        required: true,

                    },
                    dvalue: {
                        required: true,
                        digits: true
                    },
                    dbaseline: {
                        required: true,
                        digits: true
                    },
                    dtarget: {
                        required: true,
                        digits: true
                    }
                },
                messages: {
                    indicator_title: {
                        required: "Please enter program name",
                        minlength: "Your program name must consist of at least 5 characters and above"
                    },
                    reporting_frequency: {
                        required: "Please select end date",

                    },
                    type: {
                        required: "Please select start date",

                    },
                    disaggregation: {
                        required: "Please Select Base Currency",
                    }

                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            var activeTab = localStorage.getItem('activeTab');
            if (activeTab) {
                $('#tabMenu').removeClass('active');
                $(activeTab).addClass('active');
                $('#tabMenu a[href="' + activeTab + '"]').tab('show');
            }

                        // Save the active tab to local storage
            $('#tabMenu a').on('shown.bs.tab', function (e) {
                localStorage.setItem('activeTab', $(e.target).attr('href'));
            });

            $('#projectgoalindicator').on('submit', function(e) {
                e.preventDefault();
                            // location.reload();
                $.ajax({
                    url: "{{ route('addgoalindicator')}}",
                    type: "POST",
                    data: $(this).serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            location.reload();
                                        // alert('Output Added Successfully!.');
                        } else {
                            alert('An error occurred while saving.');
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('An error occurred: ' + error);
                    }
                });
            });
        });
    </script>
</div>
</div>
</div>
</div>


<!-- Add Project Goal Outcome -->

<div class="modal fade zoom" tabindex="-1" id="practice_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="logframe-indicator__heading">
                    <h5 class="modal-title">Add Project Goal Outcome</h5>
                    <p class="logframe-parent__goal-context"></p>
                </div>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">

                <form id="projectgoaloutcome">
                    @csrf
                        <input type="hidden" name="created_by" class="form-control" value="{{Auth::user()->id}}" readonly="">
                        <input type="hidden" name="organization_id" class="form-control" value="{{Auth::user()->organization_id}}" readonly="">
                        <input type="hidden" name="project_id" class="form-control" value="{{$projectshow->id}}" readonly="">
                        <input type="hidden" name="goal_id" class="form-control" value="{{ optional($goalframe)->id }}" readonly="">
                        <input type="hidden" name="status" class="form-control" value="01" readonly="">
                        <input type="hidden" name="outcome_goal" id="outcome_goal" value="{{ optional($goalframe)->goal_code }} - {{ optional($goalframe)->goal_name }}">

                        <div class="logframe-parent-form-grid">
                        <div class="form-group">
                            <label class="form-label" for="outcome_title">Outcome title<span style="color:red">*</span></label>
                            <div class="form-control-wrap">
                                <input type="text" name="outcome_title" class="form-control" id="outcome_title" placeholder="Enter Outcome Title">
                            </div>
                        </div>

                        <div class="form-group logframe-parent-form-grid__full">
                            <label class="form-label" for="outcome_code">Outcome code<i><span style="color:grey">(Optional)</span></i></label>
                            <div class="form-control-wrap">
                                <input type="text" name="outcome_code" class="form-control" id="outcome_code" placeholder="Enter outcome Code">
                            </div>
                        </div>

                        <div class="col-sm-12 logframe-parent-form-grid__full">
                            <div class="form-group">
                                <label class="form-label" for="outcome_description">Outcome description<i><span style="color:grey">(Optional)</span></i></label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control no-resize" name="outcome_description" id="outcome_description" placeholder="Add context for this outcome"></textarea>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Goal Outcome</button>
                        </div>
                </form>
                <script>
                    $(document).ready(function() {
                        $("#projectgoaloutcome").validate({
                            rules: {
                                outcome_title: {
                                    required: true,
                                    minlength: 5
                                }
                            },
                            messages: {
                                outcome_title: {
                                    required: "Please Enter Outcome Title",
                                    minlength: "Your Outcome Title must consist of at least 5 characters and above"
                                }
                            },
                            submitHandler: function(form) {
                                form.submit();
                            }
                        });
                    });
                </script>
                <script>
                    $(document).ready(function() {
                        var activeTab = localStorage.getItem('activeTab');
                        if (activeTab) {
                            $('#tabMenu').removeClass('active');
                            $(activeTab).addClass('active');
                            $('#tabMenu a[href="' + activeTab + '"]').tab('show');
                        }

                        // Save the active tab to local storage
                        $('#tabMenu a').on('shown.bs.tab', function (e) {
                            localStorage.setItem('activeTab', $(e.target).attr('href'));
                        });

                        $('#projectgoaloutcome').on('submit', function(e) {
                            e.preventDefault();
                            // location.reload();
                            $.ajax({
                                url: "{{ route('outcomes.store')}}",
                                type: "POST",
                                data: $(this).serialize(),
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(response) {
                                    if (response.success) {
                                        location.reload();
                                        // alert('Output Added Successfully!.');
                                    } else {
                                        alert('An error occurred while saving.');
                                    }
                                },
                                error: function(xhr, status, error) {
                                    alert('An error occurred: ' + error);
                                }
                            });
                        });
                    });
                </script>


            </div>
        </div>
    </div>
</div>

<!-- Add Project Goal Activity -->

<div class="modal fade zoom" tabindex="-1" id="activity_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="logframe-indicator__heading">
                    <h5 class="modal-title">Add Project Goal Activity</h5>
                    <p class="logframe-parent__goal-context"></p>
                </div>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">

                <form id="projectgoalactivity">
                    @csrf

                        <input type="hidden" name="created_by" class="form-control" value="{{Auth::user()->id}}" readonly="">
                        <input type="hidden" name="organization_id" class="form-control" value="{{Auth::user()->organization_id}}" readonly="">
                        <input type="hidden" name="project_id" class="form-control" value="{{$projectshow->id}}" readonly="">
                        <input type="hidden" name="status" class="form-control" value="01" readonly="">
                        <input type="hidden" name="goal_id" class="form-control" value="{{ optional($goalframe)->id }}" readonly="">
                        <input type="hidden" name="activity_name" value="{{ optional($goalframe)->goal_code }} - {{ optional($goalframe)->goal_name }}">

                    <div class="logframe-parent-form-grid">
                        <div class="form-group">
                            <label class="form-label" for="activity_title">Activity title<span style="color:red">*</span></label>
                            <div class="form-control-wrap">
                                <input type="text" name="activity_title" class="form-control" id="activity_title" placeholder="Enter Activity Title">
                            </div>
                        </div>

                        <div class="form-group logframe-parent-form-grid__full">
                            <label class="form-label" for="activity_code">Activity code<i><span style="color:grey">(Optional)</span></i></label>
                            <div class="form-control-wrap">
                                <input type="text" name="activity_code" class="form-control" id="activity_code" placeholder="Enter Activity Code">
                            </div>
                        </div>

                        <div class="col-sm-12 logframe-parent-form-grid__full">
                            <div class="form-group">
                                <label class="form-label" for="activity_description">Activity description<i><span style="color:grey">(Optional)</span></i></label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control no-resize" name="activity_description" id="activity_description" placeholder="Add context for this activity"></textarea>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Activity</button>
                    </div>

                </form>

                <script>
                    $(document).ready(function() {
                        $("#projectgoalactivity").validate({
                            rules: {
                                activity_title: {
                                    required: true,
                                    minlength: 5
                                }
                            },
                            messages: {
                                activity_title: {
                                    required: "Please Enter Activity Title",
                                    minlength: "Your Activity Title must consist of at least 5 characters and above"
                                }
                            },
                            submitHandler: function(form) {
                                form.submit();
                            }
                        });
                    });
                </script>

                <script>
                    $(document).ready(function() {
                        var activeTab = localStorage.getItem('activeTab');
                        if (activeTab) {
                            $('#tabMenu').removeClass('active');
                            $(activeTab).addClass('active');
                            $('#tabMenu a[href="' + activeTab + '"]').tab('show');
                        }

                        // Save the active tab to local storage
                        $('#tabMenu a').on('shown.bs.tab', function (e) {
                            localStorage.setItem('activeTab', $(e.target).attr('href'));
                        });

                        $('#projectgoalactivity').on('submit', function(e) {
                            e.preventDefault();
                            // location.reload();
                            $.ajax({
                                url: "{{ route('activities.store')}}",
                                type: "POST",
                                data: $(this).serialize(),
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(response) {
                                    if (response.success) {
                                        location.reload();
                                        // alert('Output Added Successfully!.');
                                    } else {
                                        alert('An error occurred while saving.');
                                    }
                                },
                                error: function(xhr, status, error) {
                                    alert('An error occurred: ' + error);
                                }
                            });
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        $('#practice_modal, #activity_modal, #indicator_modal').on('show.bs.modal', function (event) {
            var trigger = $(event.relatedTarget);
            var form = $(this).find('form');
            var labelField = this.id === 'practice_modal'
                ? 'outcome_goal'
                : (this.id === 'activity_modal' ? 'activity_name' : 'goal_name');

            form.find('[name="goal_id"]').val(trigger.data('goal-id'));
            form.find('[name="' + labelField + '"]').val(trigger.data('goal-label'));
            if (this.id === 'indicator_modal') {
                $(this).find('.logframe-indicator__goal-context').text('For goal: ' + trigger.data('goal-label'));
            } else {
                $(this).find('.logframe-parent__goal-context').text('For goal: ' + trigger.data('goal-label'));
            }
        });
    });
</script>

<!-- Add Project Outcome Output -->

<div class="modal fade zoom" tabindex="-1" id="output_model">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="logframe-indicator__heading">
                    <h5 class="modal-title">Add Project Outcome Output</h5>
                    <p class="logframe-nested__parent-context"></p>
                </div>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">

                <form id="projectoutcomeoutput">
                    @csrf

                        <input type="hidden" name="created_by" class="form-control" value="{{Auth::user()->id}}" readonly="">
                        <input type="hidden" name="organization_id" class="form-control" value="{{Auth::user()->organization_id}}" readonly="">
                        <input type="hidden" name="project_id" class="form-control" value="{{$projectshow->id}}" readonly="">
                        <input type="hidden" name="status" class="form-control" value="01" readonly="">
                        <input type="hidden" name="outcome_id" id="outcome_id" class="form-control" readonly="">
                        <input type="hidden" name="output_title" id="output_title" value="">

                    <div class="logframe-parent-form-grid">
                        <div class="form-group">
                            <label class="form-label" for="project_output_name">Output name</label>
                            <div class="form-control-wrap">
                                <input type="text" name="output_name" class="form-control" id="project_output_name" placeholder="Enter output name">
                            </div>
                        </div>

                        <div class="form-group logframe-parent-form-grid__full">
                            <label class="form-label" for="project_output_code">Output code</label>
                            <div class="form-control-wrap">
                                <input type="text" name="output_code" class="form-control" id="project_output_code" placeholder="Enter output code">
                            </div>
                        </div>

                        <div class="col-sm-12 logframe-parent-form-grid__full">
                            <div class="form-group">
                                <label class="form-label" for="project_output_description">Output description (optional)</label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control no-resize" name="output_description" id="project_output_description" placeholder="Add context for this output"></textarea>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Outcome Output</button>
                    </div>

                </form>
                <script>
                    $(document).ready(function() {
                        var activeTab = localStorage.getItem('activeTab');
                        if (activeTab) {
                            $('#tabMenu').removeClass('active');
                            $(activeTab).addClass('active');
                            $('#tabMenu a[href="' + activeTab + '"]').tab('show');
                        }

                        // Save the active tab to local storage
                        $('#tabMenu a').on('shown.bs.tab', function (e) {
                            localStorage.setItem('activeTab', $(e.target).attr('href'));
                        });

                        $('#projectoutcomeoutput').on('submit', function(e) {
                            e.preventDefault();
                            // location.reload();
                            $.ajax({
                                url: "{{ route('outputs.store')}}",
                                type: "POST",
                                data: $(this).serialize(),
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(response) {
                                    if (response.success) {
                                        location.reload();
                                        // alert('Output Added Successfully!.');
                                    } else {
                                        alert('An error occurred while saving.');
                                    }
                                },
                                error: function(xhr, status, error) {
                                    alert('An error occurred: ' + error);
                                }
                            });
                        });
                    });
                </script>

            </div>
        </div>
    </div>
</div>

<!---- Add project Outcome Activity -->

<div class="modal fade zoom" tabindex="-1" id="activity1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="logframe-indicator__heading">
                    <h5 class="modal-title">Add Project Outcome Activity</h5>
                    <p class="logframe-nested__parent-context"></p>
                </div>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">

                <form id="projectoutcomeactivity">
                    @csrf

                        <input type="hidden" name="created_by" class="form-control" value="{{Auth::user()->id}}" readonly="">
                        <input type="hidden" name="organization_id" class="form-control" value="{{Auth::user()->organization_id}}" readonly="">
                        <input type="hidden" name="project_id" class="form-control" value="{{$projectshow->id}}" readonly="">
                        <input type="hidden" name="outcome_id" class="form-control" id="outcome_id1" readonly="">
                        <input type="hidden" name="status" class="form-control" value="01" readonly="">
                        <input type="hidden" name="activity_name" id="activity_name2" value="">

                    <div class="logframe-parent-form-grid">
                        <div class="form-group">
                            <label class="form-label" for="outcome_activity_title">Activity title</label>
                            <div class="form-control-wrap">
                                <input type="text" name="activity_title" class="form-control" id="outcome_activity_title" placeholder="Enter activity title">
                            </div>
                        </div>

                        <div class="form-group logframe-parent-form-grid__full">
                            <label class="form-label" for="outcome_activity_code">Activity code</label>
                            <div class="form-control-wrap">
                                <input type="text" name="activity_code" class="form-control" id="outcome_activity_code" placeholder="Enter activity code">
                            </div>
                        </div>

                        <div class="col-sm-12 logframe-parent-form-grid__full">
                            <div class="form-group">
                                <label class="form-label" for="outcome_activity_description">Activity description (optional)</label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control no-resize" name="activity_description" id="outcome_activity_description" placeholder="Add context for this activity"></textarea>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Outcome Activity</button>
                    </div>

                </form>
                <script>
                    $(document).ready(function() {
                        var activeTab = localStorage.getItem('activeTab');
                        if (activeTab) {
                            $('#tabMenu').removeClass('active');
                            $(activeTab).addClass('active');
                            $('#tabMenu a[href="' + activeTab + '"]').tab('show');
                        }

                        // Save the active tab to local storage
                        $('#tabMenu a').on('shown.bs.tab', function (e) {
                            localStorage.setItem('activeTab', $(e.target).attr('href'));
                        });

                        $('#projectoutcomeactivity').on('submit', function(e) {
                            e.preventDefault();
                            // location.reload();
                            $.ajax({
                                url: "{{ route('addoutcomeactivity')}}",
                                type: "POST",
                                data: $(this).serialize(),
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(response) {
                                    if (response.success) {
                                        location.reload();
                                        // alert('Output Added Successfully!.');
                                    } else {
                                        alert('An error occurred while saving.');
                                    }
                                },
                                error: function(xhr, status, error) {
                                    alert('An error occurred: ' + error);
                                }
                            });
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>

<!----   Add Project Output Activity -->

<div class="modal fade zoom" tabindex="-1" id="activity2">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="logframe-indicator__heading">
                    <h5 class="modal-title">Add Project Output Activity</h5>
                    <p class="logframe-nested__parent-context"></p>
                </div>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">

                <form id="projectoutputactivity">
                    @csrf

                        <input type="hidden" name="created_by" class="form-control" value="{{Auth::user()->id}}" readonly="">
                        <input type="hidden" name="organization_id" class="form-control" value="{{Auth::user()->organization_id}}" readonly="">
                        <input type="hidden" name="project_id" class="form-control" value="{{$projectshow->id}}" readonly="">
                        <input type="hidden" name="output_id" class="form-control" id="output_id5" readonly="">
                        <input type="hidden" name="status" class="form-control" value="01" readonly="">
                        <input type="hidden" name="activity_name" id="output_title7" value="">

                    <div class="logframe-parent-form-grid">
                        <div class="form-group">
                            <label class="form-label" for="output_activity_title">Activity title</label>
                            <div class="form-control-wrap">
                                <input type="text" name="activity_title" class="form-control" id="output_activity_title" placeholder="Enter activity title">
                            </div>
                        </div>

                        <div class="form-group logframe-parent-form-grid__full">
                            <label class="form-label" for="output_activity_code">Activity code</label>
                            <div class="form-control-wrap">
                                <input type="text" name="activity_code" class="form-control" id="output_activity_code" placeholder="Enter activity code">
                            </div>
                        </div>

                        <div class="col-sm-12 logframe-parent-form-grid__full">
                            <div class="form-group">
                                <label class="form-label" for="output_activity_description">Activity description (optional)</label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control no-resize" name="activity_description" id="output_activity_description" placeholder="Add context for this activity"></textarea>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Output Activity</button>
                    </div>

                </form>

                <script>
                    $(document).ready(function() {
                        var activeTab = localStorage.getItem('activeTab');
                        if (activeTab) {
                            $('#tabMenu').removeClass('active');
                            $(activeTab).addClass('active');
                            $('#tabMenu a[href="' + activeTab + '"]').tab('show');
                        }

                        // Save the active tab to local storage
                        $('#tabMenu a').on('shown.bs.tab', function (e) {
                            localStorage.setItem('activeTab', $(e.target).attr('href'));
                        });

                        $('#projectoutputactivity').on('submit', function(e) {
                            e.preventDefault();
                            // location.reload();
                            $.ajax({
                                url: "{{ route('addoutputactivity')}}",
                                type: "POST",
                                data: $(this).serialize(),
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(response) {
                                    if (response.success) {
                                        location.reload();
                                        // alert('Output Added Successfully!.');
                                    } else {
                                        alert('An error occurred while saving.');
                                    }
                                },
                                error: function(xhr, status, error) {
                                    alert('An error occurred: ' + error);
                                }
                            });
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>

<!---- Add Project Output Indicator --->
<script>
    $(document).ready(function(){
        $('#output11').hide();
        $('#output21').hide();
        $('#output31').hide();
        $('#Disaggregation2').hide();

        $('#disaggregation2').change(function(){
          if($(this).val() == 'none'){
            $('#output11').show();
            $('#output21').show();
            $('#output31').show();
            $('#Disaggregation2').hide();
        }else if($(this).val() == 'Disaggregation2'){
            $('#Disaggregation2').show();
            $('#output31').hide();
            $('#output21').hide();
            $('#output11').hide();
        }else if($(this).val() == 'ALIENID'){
            $('#document_number').show();
        }
        else{
         $('#null').show('');
     }
 });
    });

</script>

<div class="modal fade zoom" tabindex="-1" id="indicator2">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="logframe-indicator__heading">
                    <h5 class="modal-title">Add Project Output Indicator</h5>
                    <p class="logframe-nested__parent-context"></p>
                </div>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">

                <form id="projectoutputindicator">
                    @csrf
                        <input type="hidden" name="created_by" class="form-control" value="{{Auth::user()->id}}" readonly="">
                        <input type="hidden" name="organization_id" class="form-control" value="{{Auth::user()->organization_id}}" readonly="">
                        <input type="hidden" name="project_id" class="form-control" value="{{$projectshow->id}}" readonly="">
                        <input type="hidden" name="output_id" class="form-control" id="output_indicator5" readonly="">
                        <input type="hidden" name="status" class="form-control" value="01" readonly="">
                        <input type="hidden" name="goal_name" id="output_indicator7" value="">

                    <div class="logframe-nested-indicator__grid">
                        <div class="form-group">
                            <label class="form-label" for="output_indicator_title">Indicator title</label>
                            <div class="form-control-wrap">
                                <input type="text" name="indicator_title" class="form-control" id="output_indicator_title" placeholder="Enter indicator title">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="output_indicator_frequency">Reporting frequency</label>
                            <div class="form-control-wrap ">
                                <div class="form-control-select">
                                    <select class="form-control" name="reporting_frequency" id="output_indicator_frequency">
                                        <option value="">Select reporting frequency</option>
                                        <option value="Monthly">Monthly</option>
                                        <option value="Bi-Monthly">Bi-Monthly</option>
                                        <option value="Quaterly">Quarterly</option>
                                        <option value="Semi-Annual">Semi-Annual</option>
                                        <option value="Annual">Annual</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="output_indicator_type">Type</label>
                            <div class="form-control-wrap ">
                                <div class="form-control-select">
                                    <select class="form-control" name="type" id="output_indicator_type">
                                        <option value="">Select indicator type</option>
                                        <option value="Quantitative">Quantitative</option>
                                        <option value="Qualitative">Qualitative</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="output_indicator_disaggregation">Disaggregation</label>
                            <div class="form-control-wrap ">
                                <div class="form-control-select">
                                    <select class="form-control" name="disaggregation" id="disaggregation2">
                                        <option value="">Select disaggregation</option>
                                        <option value="Disaggregation2">Disaggregation</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-4 col-sm-6 logframe-nested-indicator__measure">
                            <div class="form-group" id="output11">
                                <label class="form-label" for="output_indicator_label">Label</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="label_none" class="form-control" id="output_indicator_label" placeholder="Enter label">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6 logframe-nested-indicator__measure">
                            <div class="form-group" id="output21">
                                <label class="form-label" for="output_indicator_baseline">Baseline</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="baseline_none" class="form-control" id="output_indicator_baseline" placeholder="Enter baseline">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6 logframe-nested-indicator__measure">
                            <div class="form-group" id="output31">
                                <label class="form-label" for="output_indicator_target">Target</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="target_none" class="form-control" id="output_indicator_target" placeholder="Enter target">
                                </div>
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane logframe-nested-indicator__breakdown" id="Disaggregation2">
                            <div id='ncontainer'>
                              <div class="logframe-indicator__breakdown-heading">
                                <h6>Disaggregation breakdown</h6>
                                <p>Add the categories you want to track, with a baseline and target for each.</p>
                              </div>

                              <table id="nextkin2" border="1" cellspacing="0">
                                <tr>
                                  <th><input class='ncheck_all' type='checkbox' onclick="select_all()"/></th>
                                  <th>#</th>
                                  <th>Label</th>
                                  <th>Baseline</th>
                                  <th>Target</th>
                              </tr>
                              <tr>
                                  <td><input type='checkbox' class='ncase'/></td>
                                  <td><span id='nsnum'>1.</span></td>
                                  <td><input class="form-control" type='text' id='dvalue' name='dvalue[0]' value="{{{ Input::old('dvalue[0]') }}}"/></td>
                                  <td><input class="form-control" type='text' id='dbaseline' name='dbaseline[0]' value="{{{ Input::old('dbaseline[0]') }}}"/></td>
                                  <td><input class="form-control" type='text' id='dtarget' name='dtarget[0]' value="{{{ Input::old('dtarget[0]') }}}"/></td>

                              </tr>
                          </table>

                          <button type="button" class='ndelete'>- Delete</button>
                          <button type="button" class='naddmore1'>+ Add More</button>
                      </div>
                      <script>
                        $(".ndelete").on('click', function() {
                          if($('.ncase:checkbox:checked').length > 0){
                            if (window.confirm("Are you sure you want to delete this Disaggregation detail(s)?"))
                            {
                              $('.ncase:checkbox:checked').parents("#nextkin2 tr").remove();
                              $('.ncheck_all').prop("checked", false);
                              check();
                          }else{
                              $('.ncheck_all').prop("checked", false);
                              $('.ncase').prop("checked", false);
                          }
                      }
                  });
                        var i=2;
                        $(".naddmore1").on('click',function(){
                          count=$('#nextkin2 tr').length;
                          var data="<tr><td><input type='checkbox' class='ncase'/></td><td><span id='nsnum"+i+"'>"+count+".</span></td>";

                          data +="<td><input class='form-control' type='text' id='dvalue"+i+"' name='dvalue["+(i-1)+"]' value='{{{ Input::old('dvalue["+(i-1)+"]') }}}'/></td><td><input class='form-control' type='text' id='dbaseline"+i+"' name='dbaseline["+(i-1)+"]' value='{{{ Input::old('dbaseline["+(i-1)+"]') }}}'/></td><td><input class='form-control' type='text' id='dtarget"+i+"' name='dtarget["+(i-1)+"]' value='{{{ Input::old('dtarget["+(i-1)+"]') }}}'/></td>";
                          $('#nextkin2').append(data);
                          i++;
                      });

                        function select_all() {
                          $('input[class=ncase]:checkbox').each(function(){
                            if($('input[class=ncheck_all]:checkbox:checked').length == 0){
                              $(this).prop("checked", false);
                          } else {
                              $(this).prop("checked", true);
                          }
                      });
                      }

                      function check(){
                          obj=$('#nextkin2 tr').find('span');
                          $.each( obj, function( key, value ) {
                            id=value.id;
                            $('#'+id).html(key+1);
                        });
                      }

                  </script>
              </div>

              <div class="col-sm-12 logframe-nested-indicator__description">
                <div class="form-group">
                    <label class="form-label" for="default-textarea">Indicator Description(Optional)</label>
                    <div class="form-control-wrap">
                        <textarea class="form-control no-resize" name="indicator_description" id="default-textarea"></textarea>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Add Output Indicator</button>
        </div>

    </form>

    <script>
        $(document).ready(function() {
            var activeTab = localStorage.getItem('activeTab');
            if (activeTab) {
                $('#tabMenu').removeClass('active');
                $(activeTab).addClass('active');
                $('#tabMenu a[href="' + activeTab + '"]').tab('show');
            }

                        // Save the active tab to local storage
            $('#tabMenu a').on('shown.bs.tab', function (e) {
                localStorage.setItem('activeTab', $(e.target).attr('href'));
            });

            $('#projectoutputindicator').on('submit', function(e) {
                e.preventDefault();
                            // location.reload();
                $.ajax({
                    url: "{{ route('addoutputindicator')}}",
                    type: "POST",
                    data: $(this).serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            location.reload();
                                        // alert('Output Added Successfully!.');
                        } else {
                            alert('An error occurred while saving.');
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('An error occurred: ' + error);
                    }
                });
            });
        });
    </script>
</div>
</div>
</div>
</div>


<!--- Add Project outcome indicator -->
<script>
    $(document).ready(function(){
        $('#outcome11').hide();
        $('#outcome12').hide();
        $('#outcome13').hide();
        $('#Disaggregation3').hide();

        $('#disaggregation3').change(function(){
          if($(this).val() == 'none'){
            $('#outcome11').show();
            $('#outcome12').show();
            $('#outcome13').show();
            $('#Disaggregation3').hide();
        }else if($(this).val() == 'Disaggregation3'){
            $('#Disaggregation3').show();
            $('#outcome11').hide();
            $('#outcome12').hide();
            $('#outcome13').hide();
        }else if($(this).val() == 'ALIENID'){
            $('#document_number').show();
        }
        else{
           $('#null').show('');
       }
   });
    });

</script>


<div class="modal fade zoom" tabindex="-1" id="indicator1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="logframe-indicator__heading">
                    <h5 class="modal-title">Add Project Outcome Indicator</h5>
                    <p class="logframe-nested__parent-context"></p>
                </div>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">

                <form id="projectoutcomeindicator">
                    @csrf
                        <input type="hidden" name="created_by" class="form-control" value="{{Auth::user()->id}}" readonly="">
                        <input type="hidden" name="organization_id" class="form-control" value="{{Auth::user()->organization_id}}" readonly="">
                        <input type="hidden" name="project_id" class="form-control" value="{{$projectshow->id}}" readonly="">
                        <input type="hidden" name="outcome_id" class="form-control" id="outcome_id3" readonly="">
                        <input type="hidden" name="status" class="form-control" value="01" readonly="">
                        <input type="hidden" name="goal_name" id="outcome_indicator" value="">

                    <div class="logframe-nested-indicator__grid">
                        <div class="form-group">
                            <label class="form-label" for="outcome_indicator_title">Indicator title</label>
                            <div class="form-control-wrap">
                                <input type="text" name="indicator_title" class="form-control" id="outcome_indicator_title" placeholder="Enter indicator title">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="outcome_indicator_frequency">Reporting frequency</label>
                            <div class="form-control-wrap ">
                                <div class="form-control-select">
                                    <select class="form-control" name="reporting_frequency" id="outcome_indicator_frequency">
                                        <option value="">Select reporting frequency</option>
                                        <option value="Monthly">Monthly</option>
                                        <option value="Bi-Monthly">Bi-Monthly</option>
                                        <option value="Quaterly">Quarterly</option>
                                        <option value="Semi-Annual">Semi-Annual</option>
                                        <option value="Annual">Annual</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="outcome_indicator_type">Type</label>
                            <div class="form-control-wrap ">
                                <div class="form-control-select">
                                    <select class="form-control" name="type" id="outcome_indicator_type">
                                        <option value="">Select indicator type</option>
                                        <option value="Quantitative">Quantitative</option>
                                        <option value="Qualitative">Qualitative</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="outcome_indicator_disaggregation">Disaggregation</label>
                            <div class="form-control-wrap ">
                                <div class="form-control-select">
                                    <select class="form-control" name="disaggregation" id="disaggregation3">
                                        <option value="">Select disaggregation</option>
                                        <option value="Disaggregation3">Disaggregation</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-4 col-sm-6 logframe-nested-indicator__measure">
                            <div class="form-group" id="outcome11">
                                <label class="form-label" for="outcome_indicator_label">Label</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="label_none" class="form-control" id="outcome_indicator_label" placeholder="Enter label">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6 logframe-nested-indicator__measure">
                            <div class="form-group" id="outcome12">
                                <label class="form-label" for="outcome_indicator_baseline">Baseline</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="baseline_none" class="form-control" id="outcome_indicator_baseline" placeholder="Enter baseline">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6 logframe-nested-indicator__measure">
                            <div class="form-group" id="outcome13">
                                <label class="form-label" for="outcome_indicator_target">Target</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="target_none" class="form-control" id="outcome_indicator_target" placeholder="Enter target">
                                </div>
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane logframe-nested-indicator__breakdown" id="Disaggregation3">
                            <div id='ncontainer'>
                              <div class="logframe-indicator__breakdown-heading">
                                <h6>Disaggregation breakdown</h6>
                                <p>Add the categories you want to track, with a baseline and target for each.</p>
                              </div>

                              <table id="nextkin1" border="1" cellspacing="0">
                                <tr>
                                  <th><input class='ncheck_all' type='checkbox' onclick="select_all()"/></th>
                                  <th>#</th>
                                  <th>Label</th>
                                  <th>Baseline</th>
                                  <th>Target</th>
                              </tr>
                              <tr>
                                  <td><input type='checkbox' class='ncase'/></td>
                                  <td><span id='nsnum'>1.</span></td>
                                  <td><input class="form-control" type='text' id='dvalue' name='dvalue[0]' value="{{{ Input::old('dvalue[0]') }}}"/></td>
                                  <td><input class="form-control" type='text' id='dbaseline' name='dbaseline[0]' value="{{{ Input::old('dbaseline[0]') }}}"/></td>
                                  <td><input class="form-control" type='text' id='dtarget' name='dtarget[0]' value="{{{ Input::old('dtarget[0]') }}}"/></td>

                              </tr>
                          </table>

                          <button type="button" class='ndelete'>- Delete</button>
                          <button type="button" class='naddmore1'>+ Add More</button>
                      </div>
                      <script>
                        $(".ndelete").on('click', function() {
                          if($('.ncase:checkbox:checked').length > 0){
                            if (window.confirm("Are you sure you want to delete this Disaggregation detail(s)?"))
                            {
                              $('.ncase:checkbox:checked').parents("#nextkin1 tr").remove();
                              $('.ncheck_all').prop("checked", false);
                              check();
                          }else{
                              $('.ncheck_all').prop("checked", false);
                              $('.ncase').prop("checked", false);
                          }
                      }
                  });
                        var i=2;
                        $(".naddmore1").on('click',function(){
                          count=$('#nextkin1 tr').length;
                          var data="<tr><td><input type='checkbox' class='ncase'/></td><td><span id='nsnum"+i+"'>"+count+".</span></td>";

                          data +="<td><input class='form-control' type='text' id='dvalue"+i+"' name='dvalue["+(i-1)+"]' value='{{{ Input::old('dvalue["+(i-1)+"]') }}}'/></td><td><input class='form-control' type='text' id='dbaseline"+i+"' name='dbaseline["+(i-1)+"]' value='{{{ Input::old('dbaseline["+(i-1)+"]') }}}'/></td><td><input class='form-control' type='text' id='dtarget"+i+"' name='dtarget["+(i-1)+"]' value='{{{ Input::old('dtarget["+(i-1)+"]') }}}'/></td>";
                          $('#nextkin1').append(data);
                          i++;
                      });

                        function select_all() {
                          $('input[class=ncase]:checkbox').each(function(){
                            if($('input[class=ncheck_all]:checkbox:checked').length == 0){
                              $(this).prop("checked", false);
                          } else {
                              $(this).prop("checked", true);
                          }
                      });
                      }

                      function check(){
                          obj=$('#nextkin1 tr').find('span');
                          $.each( obj, function( key, value ) {
                            id=value.id;
                            $('#'+id).html(key+1);
                        });
                      }

                  </script>
              </div>
              
              <div class="col-sm-12 logframe-nested-indicator__description">
                <div class="form-group">
                    <label class="form-label" for="default-textarea">Indicator Description(Optional)</label>
                    <div class="form-control-wrap">
                        <textarea class="form-control no-resize" name="indicator_description" id="default-textarea"></textarea>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Add Outcome Indicator</button>
        </div>

    </form>
    <script>
        $(document).ready(function() {
            var activeTab = localStorage.getItem('activeTab');
            if (activeTab) {
                $('#tabMenu').removeClass('active');
                $(activeTab).addClass('active');
                $('#tabMenu a[href="' + activeTab + '"]').tab('show');
            }

                        // Save the active tab to local storage
            $('#tabMenu a').on('shown.bs.tab', function (e) {
                localStorage.setItem('activeTab', $(e.target).attr('href'));
            });

            $('#projectoutcomeindicator').on('submit', function(e) {
                e.preventDefault();
                            // location.reload();
                $.ajax({
                    url: "{{ route('addoutcomeindicator')}}",
                    type: "POST",
                    data: $(this).serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            location.reload();
                                        // alert('Output Added Successfully!.');
                        } else {
                            alert('An error occurred while saving.');
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('An error occurred: ' + error);
                    }
                });
            });
        });
    </script>
</div>
</div>
</div>
</div>




<script type="text/javascript">
    $(document).ready(function() {
        $('#planning_type').change(function(){
            $.get("{{ url('api/planningtype')}}",
                { option: $(this).val() },
                function(data) {
                    console.log('planing type');
                    $('#planning').val(data);
                });
        });
    });
</script>

    <div class="modal fade" tabindex="-1" id="modalZoom877" aria-labelledby="add-implementation-container-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered project-detail__modal-dialog" role="document">
            <div class="modal-content project-detail__modal">
                <div class="modal-header">
                    <div class="project-detail__modal-heading">
                        <span class="project-detail__modal-icon"><em class="icon ni ni-check-circle" aria-hidden="true"></em></span>
                        <div>
                            <h5 class="modal-title" id="add-implementation-container-title">Add implementation container</h5>
                            <p>Set up an implementation period and connect it to a work plan.</p>
                        </div>
                    </div>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </button>
                </div>
                <form method="POST" action="{{ route('createimcontainer') }}" class="project-detail__modal-form">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="status" value="01">
                        <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="organization_id" value="{{ Auth::user()->organization_id }}">
                        <input type="hidden" name="exchange_rate" value="FY-2023">
                        <input type="hidden" name="project_id" value="{{ $projectshow->id }}">

                        <div class="project-detail__form-grid">
                            <div class="project-detail__form-field project-detail__form-field--full">
                                <label class="form-label" for="implementation-container-name">Container name</label>
                                <input type="text" class="form-control" name="container_name" id="implementation-container-name" placeholder="Enter an implementation container name">
                            </div>
                            <div class="project-detail__form-field">
                                <label class="form-label" for="planning_typeid">Planning type</label>
                                <select class="form-control" name="planning_type" id="planning_typeid">
                                    <option value="null">Select planning type</option>
                                    <option value="Activity">Activity</option>
                                    <option value="Indicator">Indicator</option>
                                </select>
                            </div>
                            <div class="project-detail__form-field" id="activityworkplan" style="display: none;">
                                <label class="form-label" for="workplancontainer_id">Activity work plan</label>
                                <select class="form-control" name="workplancontainer_id" id="workplancontainer_id" disabled>
                                    <option value="">Select an activity work plan</option>
                                    @foreach($workplancontaineract as $obj)
                                        <option value="{{ $obj->id }}">{{ $obj->container_name }} - ({{ $obj->planning_type }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="project-detail__form-field" id="indicatorworkplan" style="display: none;">
                                <label class="form-label" for="indicator_workplancontainer_id">Indicator work plan</label>
                                <select class="form-control" name="workplancontainer_id" id="indicator_workplancontainer_id" disabled>
                                    <option value="">Select an indicator work plan</option>
                                    @foreach($workplancontainerind as $obj)
                                        <option value="{{ $obj->id }}">{{ $obj->container_name }} - ({{ $obj->planning_type }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="project-detail__form-field">
                                <label class="form-label" for="implementation-start-date">Start date</label>
                                <div class="project-detail__date-input">
                                    <em class="icon ni ni-calendar-alt" aria-hidden="true"></em>
                                    <input type="text" name="implementation_start_date" class="form-control date-picker" id="implementation-start-date" placeholder="Select start date">
                                </div>
                            </div>
                            <div class="project-detail__form-field">
                                <label class="form-label" for="implementation-end-date">End date</label>
                                <div class="project-detail__date-input">
                                    <em class="icon ni ni-calendar-alt" aria-hidden="true"></em>
                                    <input type="text" name="imeplementation_end_date" class="form-control date-picker" id="implementation-end-date" placeholder="Select end date">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="admin-page__button-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="admin-page__button">
                            <em class="icon ni ni-check" aria-hidden="true"></em>
                            Save container
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        var updateWorkplanOptions = function () {
            var planningType = $('#planning_typeid').val();
            var isActivity = planningType === 'Activity';
            var isIndicator = planningType === 'Indicator';

            $('#activityworkplan').toggle(isActivity);
            $('#indicatorworkplan').toggle(isIndicator);
            $('#workplancontainer_id').prop('disabled', !isActivity).prop('required', isActivity);
            $('#indicator_workplancontainer_id').prop('disabled', !isIndicator).prop('required', isIndicator);
        };

        $('#planning_typeid').on('change', updateWorkplanOptions);
        updateWorkplanOptions();
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#userid').change(function(){
            $.get("{{ url('api/inviteuser')}}",
                { option: $(this).val() },
                function(data) {
                    console.log('inviteuser');
                    $('#inviteuser').val(data);
                });
        });
    });
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $('#userid').change(function(){
            $.get("{{ url('api/getname')}}",
                { option: $(this).val() },
                function(data) {
                    console.log('username');
                    $('#username').val(data);
                });
        });
    });
</script>

<div class="modal fade" tabindex="-1" id="addusers" aria-labelledby="add-project-user-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered project-detail__modal-dialog" role="document">
        <div class="modal-content project-detail__modal">
            <div class="modal-header">
                <div class="project-detail__modal-heading">
                    <span class="project-detail__modal-icon"><em class="icon ni ni-user-add" aria-hidden="true"></em></span>
                    <div>
                        <h5 class="modal-title" id="add-project-user-title">Add user to the project</h5>
                        <p>Choose a colleague and assign their project profile.</p>
                    </div>
                </div>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </button>
            </div>
            <form method="POST" action="{{ route('inviteuser') }}" class="project-detail__modal-form">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="project_id" value="{{ $projectshow->id }}">
                    <input type="hidden" value="" id="username" name="name" readonly>
                    <input type="hidden" value="" id="inviteuser" name="email" readonly>

                    <div class="project-detail__form-grid">
                        <div class="project-detail__form-field project-detail__form-field--full">
                            <label class="form-label" for="project-user-project">Project</label>
                            <input type="text" class="form-control" value="{{ $projectshow->project_name }}" id="project-user-project" name="project_name" readonly>
                        </div>
                        <div class="project-detail__form-field project-detail__form-field--full">
                            <label class="form-label" for="userid">User</label>
                            <select class="form-control" id="userid" name="user_id">
                                <option value="#">Select a user</option>
                                @foreach($projectusers1 as $object)
                                    <option value="{{ $object->id }}">{{ $object->name }} {{ $object->last_name }}</option>
                                @endforeach
                            </select>
                            <small>Select a user to add to this project.</small>
                        </div>
                        <div class="project-detail__form-field project-detail__form-field--full">
                            <label class="form-label" for="project-user-profile">Profile</label>
                            <select class="form-control" name="basecurrency_id" id="project-user-profile">
                                <option value="null">Select a profile</option>
                                @foreach($roles as $obj)
                                    <option value="{{ $obj->id }}">{{ $obj->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="admin-page__button-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="admin-page__button">
                        <em class="icon ni ni-user-add" aria-hidden="true"></em>
                        Add user
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade zoom" tabindex="-1" id="updatecurreny">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Base Currency</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ url('updatebasecurrency', $projectshow->id) }}" class="logframe-currency__form">
                    @csrf
                    <div class="form-group">
                        <label class="form-label" for="basecurrency_id">Base currency</label>
                        <div class="form-control-wrap">
                            <div class="form-control-select">
                                <select class="form-control" name="basecurrency_id" id="basecurrency_id" required>
                                    <option value="">Select a new base currency</option>
                                    @foreach($basecurrency as $obj)
                                    <option value="{{$obj->id}}">{{$obj->currency_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <em class="icon ni ni-navigate-fill"></em>
                        <span>Update base currency</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade zoom" tabindex="-1" id="assignrole">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Assign Role</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="nk-block nk-block-lg">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <ul class="nav nav-tabs mt-n3">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem5232"><em class="icon ni ni-edit"></em><span>Assign Role</span></a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem5232">
                                    <form method="POST" action="{{ url('updatebasecurrency',$projectshow->id) }}">
                                        @csrf
                                        <div class="row gy-4">



                                            <div class="form-group">
                                                <label class="form-label" for="default-06">Role</label>
                                                <div class="form-control-wrap ">
                                                    <div class="form-control-select">
                                                        <select class="form-control" name="basecurrency_id" id="basecurrency_id">
                                                            <option value="null">Nothing Selected</option>
                                                            <option></option>
                                                            @foreach($roles as $obj)
                                                            <option value="{{$obj->id}}">{{$obj->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-label" for="default-06">Users</label>
                                                <div class="form-control-wrap ">
                                                    <div class="form-control-select">
                                                        <select class="form-control" name="basecurrency_id" id="basecurrency_id">
                                                            <option value="null">Nothing Selected</option>
                                                            <option></option>
                                                            @foreach($projectusers as $obj)
                                                            <option value="{{$obj->id}}">{{$obj->name}} {{$obj->last_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- <input type="" id="result" name=""> -->



                                        </div>

                                        

                                        <br>
                                        <button style="margin-left: 30%;" type="submit" class="btn btn-round btn-primary"><em class="icon ni ni-navigate-fill"></em>&nbsp Assign Role</button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>

<div class="modal fade zoom" tabindex="-1" id="editgoal_modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Goal</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="nk-block nk-block-lg">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <ul class="nav nav-tabs mt-n3">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem5232"><em class="icon ni ni-edit"></em><span>Edit</span></a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem5232">
                                    <form method="POST" action="{{ route('updategoal')}}">
                                        @csrf
                                        
                                        <div class="row gy-4">


                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Goal Name</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="goal_name" id="goal_name2" class="form-control" placeholder="">
                                                </div>
                                            </div> 



                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Goal Code</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="goal_code" id="goal_code2" class="form-control" placeholder="">
                                                </div>
                                            </div> 

                                            <input type="hidden" name="goal_id" id="goal_id2" class="form-control" placeholder="">

                                            
                                        </div>
                                        <br>
                                        <button style="margin-left: 30%;" type="submit" class="btn btn-round btn-primary"><em class="icon ni ni-navigate-fill"></em>&nbsp Edit Goal</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<div class="modal fade zoom" tabindex="-1" id="editactivity_modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Goal Activity</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="nk-block nk-block-lg">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <ul class="nav nav-tabs mt-n3">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem5232"><em class="icon ni ni-edit"></em><span>Edit</span></a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem5232">
                                    <form method="POST" action="{{ route('updateactivitygoal')}}">
                                        @csrf
                                        
                                        <div class="row gy-4">


                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Activity Name</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="activity_title" id="activity_title2" class="form-control" placeholder="">
                                                </div>
                                            </div> 



                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Activity Code</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="activity_code" id="activity_code2" class="form-control" placeholder="">
                                                </div>
                                            </div> 

                                            <input type="hidden" name="activity_id" id="activity_id2" class="form-control" placeholder="">

                                            
                                        </div>
                                        <br>
                                        <button style="margin-left: 30%;" type="submit" class="btn btn-round btn-primary"><em class="icon ni ni-navigate-fill"></em>&nbsp Edit Goal Activity</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<div class="modal fade zoom" tabindex="-1" id="editoutputactivity_modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Output Activity</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="nk-block nk-block-lg">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <ul class="nav nav-tabs mt-n3">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem5232"><em class="icon ni ni-edit"></em><span>Edit</span></a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem5232">
                                    <form method="POST" action="{{ route('updateoutputactivity')}}">
                                        @csrf
                                        
                                        <div class="row gy-4">


                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Activity Name</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="activity_title" id="activity_title4" class="form-control" placeholder="">
                                                </div>
                                            </div> 



                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Activity Code</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="activity_code" id="activity_code4" class="form-control" placeholder="">
                                                </div>
                                            </div> 

                                            <input type="hidden" name="activity_id" id="activity_id4" class="form-control" placeholder="">

                                            
                                        </div>
                                        <br>
                                        <button style="margin-left: 30%;" type="submit" class="btn btn-round btn-primary"><em class="icon ni ni-navigate-fill"></em>&nbsp Edit Output Activity</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>



<div class="modal fade zoom" tabindex="-1" id="editoutcomeactivity_modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Outcome Activity</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="nk-block nk-block-lg">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <ul class="nav nav-tabs mt-n3">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem5232"><em class="icon ni ni-edit"></em><span>Edit</span></a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem5232">
                                    <form method="POST" action="{{ route('updateoutcomeactivity')}}">
                                        @csrf
                                        
                                        <div class="row gy-4">


                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Activity Name</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="activity_title" id="activity_title3" class="form-control" placeholder="">
                                                </div>
                                            </div> 



                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Activity Code</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="activity_code" id="activity_code3" class="form-control" placeholder="">
                                                </div>
                                            </div> 

                                            <input type="hidden" name="activity_id" id="activity_id3" class="form-control" placeholder="">

                                            
                                        </div>
                                        <br>
                                        <button style="margin-left: 30%;" type="submit" class="btn btn-round btn-primary"><em class="icon ni ni-navigate-fill"></em>&nbsp Edit Outcome Activity</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<div class="modal fade zoom" tabindex="-1" id="editindicator_modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Goal Indicator</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="nk-block nk-block-lg">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <ul class="nav nav-tabs mt-n3">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem5232"><em class="icon ni ni-edit"></em><span>Edit</span></a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem5232">
                                    <form method="POST" action="{{ route('updategoal')}}">
                                        @csrf
                                        
                                        <div class="row gy-4">


                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Indicator Title</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="goal_name" id="goal_name2" class="form-control" placeholder="">
                                                </div>
                                            </div> 



                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Goal Code</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="goal_code" id="goal_code2" class="form-control" placeholder="">
                                                </div>
                                            </div> 

                                            <input type="hidden" name="goal_id" id="goal_id2" class="form-control" placeholder="">

                                            
                                        </div>
                                        <br>
                                        <button style="margin-left: 30%;" type="submit" class="btn btn-round btn-primary"><em class="icon ni ni-navigate-fill"></em>&nbsp Edit Goal Indicator</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="modal fade zoom" tabindex="-1" id="editoutcome_modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Outcome</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="nk-block nk-block-lg">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <ul class="nav nav-tabs mt-n3">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem5232"><em class="icon ni ni-edit"></em><span>Edit</span></a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem5232">
                                    <form method="POST" action="{{ route('updateoutcome')}}">
                                        @csrf
                                        
                                        <div class="row gy-4">


                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Outcome Name</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="outcome_name" id="outcome_name2" class="form-control" placeholder="">
                                                </div>
                                            </div> 

                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Outcome Code</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="outcome_code" id="outcome_code2" class="form-control" placeholder="">
                                                </div>
                                            </div> 

                                            <input type="hidden" name="outcome_id" id="outcome_id2" class="form-control" placeholder="">

                                            
                                        </div>
                                        <br>
                                        <button style="margin-left: 30%;" type="submit" class="btn btn-round btn-primary"><em class="icon ni ni-navigate-fill"></em>&nbsp Edit Outcome</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<div class="modal fade zoom" tabindex="-1" id="editoutput_modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Output</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="nk-block nk-block-lg">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <ul class="nav nav-tabs mt-n3">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem5232"><em class="icon ni ni-edit"></em><span>Edit</span></a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem5232">
                                    <form method="POST" action="{{ route('updateoutput')}}">
                                        @csrf
                                        
                                        <div class="row gy-4">


                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Output Name</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="output_name" id="output_name2" class="form-control" placeholder="">
                                                </div>
                                            </div> 

                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Outcome Code</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="output_code" id="output_code2" class="form-control" placeholder="">
                                                </div>
                                            </div> 

                                            <input type="hidden" name="output_id" id="output_id2" class="form-control" placeholder="">

                                            
                                        </div>
                                        <br>
                                        <button style="margin-left: 30%;" type="submit" class="btn btn-round btn-primary"><em class="icon ni ni-navigate-fill"></em>&nbsp Edit Output</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<div class="modal fade zoom" tabindex="-1" id="editinterventi">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Intervention</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="nk-block nk-block-lg">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <ul class="nav nav-tabs mt-n3">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem5232"><em class="icon ni ni-edit"></em><span>Edit</span></a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem5232">
                                    <form method="POST" action="{{ route('updateinterventions')}}">
                                        @csrf
                                        
                                        <div class="row gy-4">

                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Activity</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="activity_name" id="activity_name" class="form-control" placeholder="">
                                                </div>
                                            </div> 

                                            <input type="hidden" name="intervention_id" id="intervention_id" class="form-control" placeholder="">

                                            <!-- <div class="tab-pane" id="tabItem3"> -->

                                                <script type="text/javascript">
                                                  $(function(){
                                                    $('#funding11, #funding22').keyup(function(){
                                                       var funding11 = parseFloat($('#funding11').val()) || 0;
                                                       var funding22 = parseFloat($('#funding22').val()) || 0;
                                                       $('#totall').val(funding11 + funding22);
                                                   });
                                                });
                                            </script>

                                            @foreach($accounts as $key => $object)
                                            @if($loop->first)
                                            <div class="form-group">
                                                <label class="form-label" for="default-01">{{$object->funding_name}}</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="funding1" id="funding11" class="form-control" placeholder="">
                                                </div>
                                            </div> 
                                            @endif
                                            @if($loop->last)
                                            <div class="form-group">
                                                <label class="form-label" for="default-01">{{$object->funding_name}}</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="funding2" id="funding22" class="form-control" placeholder="">
                                                </div>
                                            </div> 
                                            @endif
                                            @endforeach

                                            

                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Total</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="total" id="totall" class="form-control" placeholder="">
                                                </div>
                                            </div> 

                                        </div>



                                        <br>
                                        <button style="margin-left: 30%;" type="submit" class="btn btn-round btn-primary"><em class="icon ni ni-navigate-fill"></em>&nbsp Edit Intervention</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="modal fade zoom" tabindex="-1" id="viewinterventi">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">View Intervention</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="nk-block nk-block-lg">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <ul class="nav nav-tabs mt-n3">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem5232"><em class="icon ni ni-eye"></em><span>View</span></a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem5232">
                                    <form method="POST" action="">
                                        @csrf
                                        
                                        <div class="row gy-4">

                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Activity</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="activity_name" id="activity_name1" class="form-control" placeholder=""- readonly>
                                                </div>
                                            </div> 
                                            @foreach($accounts as $key => $object)
                                            @if($loop->first)
                                            <div class="form-group">
                                                <label class="form-label" for="default-01">{{$object->funding_name}}</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="funding1" id="funding111" class="form-control" placeholder="" readonly>
                                                </div>
                                            </div> 
                                            @endif
                                            @if($loop->last)
                                            <div class="form-group">
                                                <label class="form-label" for="default-01">{{$object->funding_name}}</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="funding2" id="funding222" class="form-control" placeholder="" readonly>
                                                </div>
                                            </div> 
                                            @endif
                                            @endforeach

                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Total</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="total" id="totalll" class="form-control" placeholder="" readonly>
                                                </div>
                                            </div> 

                                        </div>



                                        <br>
                                        <!-- <button style="margin-left: 30%;" type="submit" class="btn btn-round btn-primary"><em class="icon ni ni-navigate-fill"></em>&nbsp Edit Intervention</button> -->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!--- Add Goal -->
<div class="modal fade" id="addGoalDialog" tabindex="-1" role="dialog" aria-labelledby="addGoalDialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="addGoalForm" name="addGoalForm" method="POST" action="{{ route('goals.store') }}">
                @csrf
                <input type="hidden" name="tab" value="tabItem4" />

                <div class="modal-header">
                    <div class="logframe-indicator__heading">
                        <h5 class="modal-title">Add Goal</h5>
                        <p class="logframe-goal__subtitle">Create a new top-level result for this project.</p>
                    </div>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross" aria-hidden="true"></em>
                    </button>
                </div>
                <div class="modal-body">
                    <input name="organization_id" type="hidden" class="form-control" value="{{Auth::user()->organization_id}}" />
                    <input name="created_by" type="hidden" class="form-control" value="{{Auth::user()->id}}" />
                    <input name="status" type="hidden" class="form-control" value="01" />
                    <input name="log_frame_id" type="hidden" class="form-control" value="{{ optional($logframes)->id }}" />

                    <div class="logframe-parent-form-grid logframe-goal__form-grid">
                        <div class="form-group">
                            <label class="font-weight-bolder">Goal title<span class="text-danger">*</span></label>
                            <input name="goal_name" type="text" class="form-control" placeholder="Enter a clear goal title" required="" />
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bolder">Goal code<span class="text-danger">*</span></label>
                            <input name="goal_code" type="text" class="form-control" placeholder="e.g. G1" required="" />
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bolder">Description <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                            <textarea name="goal_description" class="form-control" rows="4" placeholder="Add context for this goal"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-success font-weight-bold">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- add outcome -->
<div class="modal fade" id="addOutcomeDialog" tabindex="-1" role="dialog" aria-labelledby="addOutcomeDialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="addOutcomeForm" name="addOutcomeForm" method="post" action="">
                <input type="hidden" id="outcome_goal_id" name="goal_id" />
                <input type="hidden" id="outcome_goal_description" name="goal_description" />

                <div class="modal-header">
                    <h5 class="modal-title">Add Outcome</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- title -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label id="outcome_goal_desc" class="font-weight-bolder"></label>
                            </div>
                        </div>
                    </div>

                    <!-- title -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Title<span class="text-danger">*</span></label>
                                <input name="title" type="text" class="form-control" required="" />
                            </div>
                        </div>
                    </div>

                    <!-- description -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Description <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                                <textarea name="description" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-success font-weight-bold">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- add indicator -->
<div class="modal fade" id="addGoalIndicatorDialog" tabindex="-1" role="dialog" aria-labelledby="addGoalIndicatorDialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form id="addGoalIndicatorForm" name="addGoalIndicatorForm" method="post" action="">
                <input type="hidden" id="goal_indicator_id" name="goal_id" />
                <input type="hidden" id="goal_indicator_description" name="goal_description" />
                <input type="hidden" id="goal_indicator_add_disaggs" name="disaggregations" />

                <div class="modal-header">
                    <h5 class="modal-title">Add goal indicator</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- title -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Goal</label>
                                <br/>
                                <label id="goal_indicator_desc"></label>
                            </div>
                        </div>
                    </div>

                    <!-- title and reporting frequency -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Title<span class="text-danger">*</span></label>
                                <input name="title" type="text" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Reporting Frequency<span class="text-danger">*</span></label>
                                <select name="reporting_frequency" class="form-control" required="">
                                    <option value=""></option>
                                    <option value="Monthly">Monthly</option>
                                    <option value="Bi-Monthly">Bi-Monthly</option>
                                    <option value="Quarterly">Quarterly</option>
                                    <option value="Semi-Annual">Semi-Annual</option>
                                    <option value="Annual">Annual</option>
                                    <option value="Annual">Mid-Term</option>
                                    <option value="Annual">End-Term</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- description -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Description <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                                <textarea name="description" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- disaggregation -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Disaggregation<span class="text-danger">*</span></label>
                                <select id="goal_indicator_add_target_type" name="target_type" class="form-control" required="">
                                    <option value=""></option>
                                    <option value="Disaggregation">Disaggregation</option>
                                    <option value="None">None</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <br>

                    <!-- baseline and target -->
                    <div id="goal_indicator_add_target_baseline_section" class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="font-weight-bolder">Label <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                                <input name="label" type="number" step="any" class="form-control" />
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="font-weight-bolder">Baseline <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                                <input name="baseline" type="number" step="any" class="form-control" step="any" />
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="font-weight-bolder">Target <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                                <input name="target" type="number" step="any" class="form-control" step="any" />
                            </div>
                        </div>
                    </div>

                    <!-- disaggregations -->
                    <div id="goal_indicator_add_disagg_section">
                        <div class="separator separator-dashed mt-8 mb-8"></div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="font-weight-bolder text-muted font-italic">Label</label>
                                    <input id="goal_indicator_add_disag_label" type="text" class="form-control" placeholder="e.g. Male" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="font-weight-bolder text-muted font-italic">Baseline</label>
                                    <input id="goal_indicator_add_disag_baseline" type="number" step="any" class="form-control" placeholder="e.g. 10" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="font-weight-bolder text-muted font-italic">Target</label>
                                    <div class="input-group">
                                        <input id="goal_indicator_add_disag_target" type="number" step="any" class="form-control" placeholder="e.g. 10" />
                                        <div class="input-group-append">
                                            <button class="btn btn-secondary" type="button" onclick="add_goal_indicator_disag();">ADD</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive-lg">
                                    <table id="goal_indicator_add_disagg_values" class="table">
                                        <caption>Disaggregation Data</caption>
                                        <thead>
                                            <tr>
                                                <th>Label</th>
                                                <th>Baseline</th>
                                                <th>Target</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-borderless"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="separator separator-dashed mt-8 mb-8"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-success font-weight-bold">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- edit indicator -->
<div class="modal fade" id="editGoalIndicatorDialog" tabindex="-1" role="dialog" aria-labelledby="editGoalIndicatorDialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form id="editGoalIndicatorForm" name="editGoalIndicatorForm" method="post" action="">
                <input type="hidden" id="ed_goal_indicator_id" name="id" />
                <input type="hidden" id="ed_goal_indicator_add_disaggs" name="disaggregations" />

                <div class="modal-header">
                    <h5 class="modal-title">Edit indicator</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- title -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Goal</label>
                                <br/>
                                <label id="ed_goal_indicator_desc"></label>
                            </div>
                        </div>
                    </div>

                    <!-- title and reporting frequency -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Title<span class="text-danger">*</span></label>
                                <input id="ed_goal_indicator_title" name="title" type="text" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Reporting Frequency<span class="text-danger">*</span></label>
                                <select id="ed_goal_indicator_reporting_frequency" name="reporting_frequency" class="form-control" required="">
                                    <option value=""></option>
                                    <option value="Monthly">Monthly</option>
                                    <option value="Bi-Monthly">Bi-Monthly</option>
                                    <option value="Quarterly">Quarterly</option>
                                    <option value="Semi-Annual">Semi-Annual</option>
                                    <option value="Annual">Annual</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- description -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Description <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                                <textarea id="ed_goal_indicator_description" name="description" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- means of variation and target -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Disaggregation<span class="text-danger">*</span></label>
                                <select id="ed_goal_indicator_add_target_type" name="target_type" class="form-control" required="">
                                    <option value=""></option>
                                    <option value="Disaggregation">Disaggregation</option>
                                    <option value="None">None</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- baseline and target -->
                    <div id="ed_goal_indicator_add_target_baseline_section" class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="font-weight-bolder">Baseline <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                                <input id="ed_goal_indicator_baseline" name="baseline" type="number" step="any" class="form-control" />
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="font-weight-bolder">Target <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                                <input id="ed_goal_indicator_target" name="target" type="number" step="any" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <!-- disaggregations -->
                    <div id="ed_goal_indicator_add_disagg_section">
                        <div class="separator separator-dashed mt-8 mb-8"></div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="font-weight-bolder text-muted font-italic">Label</label>
                                    <input id="ed_goal_indicator_add_disag_label" type="text" class="form-control" placeholder="e.g. Male" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="font-weight-bolder text-muted font-italic">Baseline</label>
                                    <input id="ed_goal_indicator_add_disag_baseline" type="number" step="any" class="form-control" placeholder="e.g. 10" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="font-weight-bolder text-muted font-italic">Target</label>
                                    <div class="input-group">
                                        <input id="ed_goal_indicator_add_disag_target" type="number" step="any" class="form-control" placeholder="e.g. 10" />
                                        <div class="input-group-append">
                                            <button class="btn btn-secondary" type="button" onclick="ed_add_goal_indicator_disag();">ADD</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive-lg">
                                    <table id="ed_goal_indicator_add_disagg_values" class="table">
                                        <caption>Disaggregation Data</caption>
                                        <thead>
                                            <tr>
                                                <th>Label</th>
                                                <th>Baseline</th>
                                                <th>Target</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-borderless"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="separator separator-dashed mt-8 mb-8"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-success font-weight-bold">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- add activity -->
<div class="modal fade" id="addGoalActivityDialog" tabindex="-1" role="dialog" aria-labelledby="addGoalActivityDialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form id="addGoalActivityForm" name="addGoalActivityForm" method="post" action="">
                <input type="hidden" name="project_id" value="9" />
                <input type="hidden" name="link_type" value="GOAL" />
                <input type="hidden" id="goal_activity_link_id" name="link_id" />
                <input type="hidden" id="goal_activity_link_description" name="link_description" />

                <div class="modal-header">
                    <h5 class="modal-title">Add new goal activity</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- code -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Code <small class="text-muted font-weight-bolder text-uppercase">(Optional)</small></label>
                                <input name="code" type="text" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <!-- title -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Title<span class="text-danger">*</span></label>
                                <input name="title" type="text" class="form-control" required />
                            </div>
                        </div>
                    </div>

                    <!-- description -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Description <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                                <textarea name="description" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-success font-weight-bold">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- edit activity -->
<div class="modal fade" id="editGoalActivityDialog" tabindex="-1" role="dialog" aria-labelledby="editGoalActivityDialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form id="editGoalActivityForm" name="editGoalActivityForm" method="post" action="">
                <input type="hidden" id="goal_activity_id" name="id" />

                <div class="modal-header">
                    <h5 class="modal-title">Edit activity info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- code -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Code <small class="text-muted font-weight-bolder text-uppercase">(Optional)</small></label>
                                <input id="ed_goal_activity_code" name="code" type="text" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <!-- title -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Title<span class="text-danger">*</span></label>
                                <input id="ed_goal_activity_title" name="title" type="text" class="form-control" required />
                            </div>
                        </div>
                    </div>

                    <!-- description -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Description <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                                <textarea id="ed_goal_activity_description" name="description" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- start date and end date and status-->
                    <div class="row">
                        <!-- start date -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="font-weight-bolder">Start Date<span class="text-danger">*</span></label>
                                <input id="ed_goal_activity_start_date" name="start_date" type="text" class="form-control start-date" required="" readonly />
                            </div>
                        </div>

                        <!-- end date -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="font-weight-bolder">End Date<span class="text-danger">*</span></label>
                                <input id="ed_goal_activity_end_date" name="end_date" type="text" class="form-control end-date" required="" readonly />
                            </div>
                        </div>

                        <!-- activity type -->
                        <div class="col-lg-3">
                            <!-- notes -->
                            <div class="form-group">
                                <label class="font-weight-bolder">Activity Type<span class="text-danger">*</span></label>
                                <select id="ed_goal_activity_activity_type" name="activity_type" class="form-control" required="">
                                    <option value=""></option>
                                    <option value="Administration">Administration</option>
                                    <option value="Construction">Construction</option>
                                    <option value="Planning">Planning</option>
                                    <option value="Research/Evaluation">Research/Evaluation</option>
                                    <option value="Resource provision">Resource provision</option>
                                    <option value="Service delivery">Service delivery</option>
                                    <option value="Survey">Survey</option>
                                    <option value="Training">Training</option>
                                </select>
                            </div>
                        </div>

                        <!-- status -->
                        <div class="col-lg-3">
                            <!-- notes -->
                            <div class="form-group">
                                <label class="font-weight-bolder">Status<span class="text-danger">*</span></label>
                                <select id="ed_goal_activity_status" name="status" class="form-control" required="">
                                    <option value=""></option>
                                    <option value="Not Started">Not Started</option>
                                    <option value="Ongoing">Ongoing</option>
                                    <option value="Paused">Paused</option>
                                    <option value="Completed">Completed</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- assignee -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Assignee <small class="text-muted font-weight-bolder text-uppercase">(Optional)</small></label>
                                <input id="ed_goal_activity_assignee" name="assignee" type="text" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <!-- budget and expenditure -->
                    <div class="row">
                        <!-- budget -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Budget<span class="text-danger">*</span></label>
                                <input id="ed_goal_activity_budget" name="budget" type="number" step="any" class="form-control" required="" />
                            </div>
                        </div>

                        <!-- expenditure -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Expenditure <small class="text-muted font-weight-bolder text-uppercase">(Optional)</small></label>
                                <input id="ed_goal_activity_expenditure" name="expenditure" type="number" step="any" class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-success font-weight-bold">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- add output -->
<div class="modal fade" id="addOutputDialog" tabindex="-1" role="dialog" aria-labelledby="addOutputDialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="addOutputForm" name="addOutputForm" method="post" action="">
                <input type="hidden" id="output_outcome_id" name="outcome_id" />
                <input type="hidden" id="output_outcome_description" name="outcome_description" />

                <div class="modal-header">
                    <h5 class="modal-title">Add Output</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- title -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Outcome</label>
                                <br/>
                                <label id="output_outcome_desc"></label>
                            </div>
                        </div>
                    </div>

                    <!-- title -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Title<span class="text-danger">*</span></label>
                                <input name="title" type="text" class="form-control" required="" />
                            </div>
                        </div>
                    </div>

                    <!-- description -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Description <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                                <textarea name="description" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-success font-weight-bold">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- edit output -->
<div class="modal fade" id="editOutputDialog" tabindex="-1" role="dialog" aria-labelledby="editOutputDialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="editOutputForm" name="editOutputForm" method="post" action="">
                <input type="hidden" id="ed_output_id" name="output_id" />

                <div class="modal-header">
                    <h5 class="modal-title">Edit Output</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- title -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Outcome</label>
                                <br/>
                                <label id="ed_output_outcome_desc"></label>
                            </div>
                        </div>
                    </div>

                    <!-- title -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Title<span class="text-danger">*</span></label>
                                <input id="ed_output_title" name="title" type="text" class="form-control" required="" />
                            </div>
                        </div>
                    </div>

                    <!-- description -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Description <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                                <textarea id="ed_output_description" name="description" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-success font-weight-bold">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- add indicator -->
<div class="modal fade" id="addOutcomeIndicatorDialog" tabindex="-1" role="dialog" aria-labelledby="addOutcomeIndicatorDialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form id="addOutcomeIndicatorForm" name="addOutcomeIndicatorForm" method="post" action="">
                <input type="hidden" id="outcome_indicator_id" name="outcome_id" />
                <input type="hidden" id="outcome_indicator_description" name="outcome_description" />
                <input type="hidden" id="outcome_indicator_add_disaggs" name="disaggregations" />

                <div class="modal-header">
                    <h5 class="modal-title">Add outcome indicator</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- title -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Outcome</label>
                                <br/>
                                <label id="outcome_indicator_desc"></label>
                            </div>
                        </div>
                    </div>

                    <!-- title and reporting frequency -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Title<span class="text-danger">*</span></label>
                                <input name="title" type="text" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Reporting Frequency<span class="text-danger">*</span></label>
                                <select name="reporting_frequency" class="form-control" required="">
                                    <option value=""></option>
                                    <option value="Monthly">Monthly</option>
                                    <option value="Bi-Monthly">Bi-Monthly</option>
                                    <option value="Quarterly">Quarterly</option>
                                    <option value="Semi-Annual">Semi-Annual</option>
                                    <option value="Annual">Annual</option>
                                    <option value="Annual">Mid-Term</option>
                                    <option value="Annual">End-Term</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- description -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Description<span class="text-danger">*</span></label>
                                <textarea name="description" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- disaggregation -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Disaggregation<span class="text-danger">*</span></label>
                                <select id="outcome_indicator_add_target_type" name="target_type" class="form-control" required="">
                                    <option value=""></option>
                                    <option value="Disaggregation">Disaggregation</option>
                                    <option value="None">None</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- baseline and target -->
                    <div id="outcome_indicator_add_target_baseline_section" class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Label <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                                <input name="label" type="number" step="any" class="form-control" />
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Baseline <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                                <input name="baseline" type="number" step="any" class="form-control" />
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Target <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                                <input name="target" type="number" step="any" class="form-control" />
                            </div>
                        </div>
                    </div>
                    
                    <!-- disaggregations -->
                    <div id="outcome_indicator_add_disagg_section">
                        <div class="separator separator-dashed mt-8 mb-8"></div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="font-weight-bolder text-muted font-italic">Label</label>
                                    <input id="outcome_indicator_add_disag_label" type="text" class="form-control" placeholder="e.g. Male" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="font-weight-bolder text-muted font-italic">Baseline</label>
                                    <input id="outcome_indicator_add_disag_baseline" type="number" step="any" class="form-control" placeholder="e.g. 10" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="font-weight-bolder text-muted font-italic">Target</label>
                                    <div class="input-group">
                                        <input id="outcome_indicator_add_disag_target" type="number" step="any" class="form-control" placeholder="e.g. 10" />
                                        <div class="input-group-append">
                                            <button class="btn btn-secondary" type="button" onclick="add_outcome_indicator_disag();">ADD</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive-lg">
                                    <table id="outcome_indicator_add_disagg_values" class="table">
                                        <caption>Disaggregation Data</caption>
                                        <thead>
                                            <tr>
                                                <th>Label</th>
                                                <th>Baseline</th>
                                                <th>Target</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-borderless"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="separator separator-dashed mt-8 mb-8"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-success font-weight-bold">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- edit indicator -->
<div class="modal fade" id="editOutcomeIndicatorDialog" tabindex="-1" role="dialog" aria-labelledby="editOutcomeIndicatorDialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form id="editOutcomeIndicatorForm" name="editOutcomeIndicatorForm" method="post" action="">
                <input type="hidden" id="ed_outcome_indicator_id" name="id" />
                <input type="hidden" id="ed_outcome_indicator_add_disaggs" name="disaggregations" />

                <div class="modal-header">
                    <h5 class="modal-title">Edit outcome indicator</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- title -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Outcome</label>
                                <br/>
                                <label id="ed_outcome_indicator_desc"></label>
                            </div>
                        </div>
                    </div>

                    <!-- title and reporting frequency -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Title<span class="text-danger">*</span></label>
                                <input id="ed_outcome_indicator_title" name="title" type="text" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Reporting Frequency<span class="text-danger">*</span></label>
                                <select id="ed_outcome_indicator_reporting_frequency" name="reporting_frequency" class="form-control" required="">
                                    <option value=""></option>
                                    <option value="Monthly">Monthly</option>
                                    <option value="Bi-Monthly">Bi-Monthly</option>
                                    <option value="Quarterly">Quarterly</option>
                                    <option value="Semi-Annual">Semi-Annual</option>
                                    <option value="Annual">Annual</option>
                                    <option value="Annual">Mid-Term</option>
                                    <option value="Annual">End-Term</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- description -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Description<span class="text-danger">*</span></label>
                                <textarea id="ed_outcome_indicator_description" name="description" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- means of variation and target -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Disaggregation<span class="text-danger">*</span></label>
                                <select id="ed_outcome_indicator_add_target_type" name="target_type" class="form-control" required="">
                                    <option value=""></option>
                                    <option value="Disaggregation">Disaggregation</option>
                                    <option value="None">None</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- baseline and target -->
                    <div id="ed_outcome_indicator_add_target_baseline_section" class="row">

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="font-weight-bolder">Label <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                                <input id="ed_outcome_indicator_baseline" name="label" type="number" step="any" class="form-control" />
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="font-weight-bolder">Baseline <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                                <input id="ed_outcome_indicator_baseline" name="baseline" type="number" step="any" class="form-control" />
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="font-weight-bolder">Target <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                                <input id="ed_outcome_indicator_target" name="target" type="number" step="any" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <!-- disaggregations -->
                    <div id="ed_outcome_indicator_add_disagg_section">
                        <div class="separator separator-dashed mt-8 mb-8"></div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="font-weight-bolder text-muted font-italic">Label</label>
                                    <input id="ed_outcome_indicator_add_disag_label" type="text" class="form-control" placeholder="e.g. Male" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="font-weight-bolder text-muted font-italic">Baseline</label>
                                    <input id="ed_outcome_indicator_add_disag_baseline" type="number" step="any" class="form-control" placeholder="e.g. 10" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="font-weight-bolder text-muted font-italic">Target</label>
                                    <div class="input-group">
                                        <input id="ed_outcome_indicator_add_disag_target" type="number" step="any" class="form-control" placeholder="e.g. 10" />
                                        <div class="input-group-append">
                                            <button class="btn btn-secondary" type="button" onclick="ed_add_outcome_indicator_disag();">ADD</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive-lg">
                                    <table id="ed_outcome_indicator_add_disagg_values" class="table">
                                        <caption>Disaggregation Data</caption>
                                        <thead>
                                            <tr>
                                                <th>Label</th>
                                                <th>Baseline</th>
                                                <th>Target</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-borderless"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="separator separator-dashed mt-8 mb-8"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-success font-weight-bold">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- add activity -->
<div class="modal fade" id="addOutcomeActivityDialog" tabindex="-1" role="dialog" aria-labelledby="addOutcomeActivityDialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form id="addOutcomeActivityForm" name="addOutcomeActivityForm" method="post" action="">
                <input type="hidden" name="project_id" value="9" />
                <input type="hidden" name="link_type" value="OUTCOME" />
                <input type="hidden" id="outcome_activity_link_id" name="link_id" />
                <input type="hidden" id="outcome_activity_link_description" name="link_description" />

                <div class="modal-header">
                    <h5 class="modal-title">Add a new activity</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- code -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Code <small class="text-muted font-weight-bolder text-uppercase">(Optional)</small></label>
                                <input name="code" type="text" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <!-- title -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Title<span class="text-danger">*</span></label>
                                <input name="title" type="text" class="form-control" required />
                            </div>
                        </div>
                    </div>

                    <!-- description -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Description <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                                <textarea name="description" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- start date and end date and status-->
                    <div class="row">
                        <!-- start date -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="font-weight-bolder">Start Date<span class="text-danger">*</span></label>
                                <input name="start_date" type="text" class="form-control start-date" required="" readonly />
                            </div>
                        </div>

                        <!-- end date -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="font-weight-bolder">End Date<span class="text-danger">*</span></label>
                                <input name="end_date" type="text" class="form-control end-date" required="" readonly />
                            </div>
                        </div>

                        <!-- activity type -->
                        <div class="col-lg-3">
                            <!-- notes -->
                            <div class="form-group">
                                <label class="font-weight-bolder">Activity Type<span class="text-danger">*</span></label>
                                <select name="activity_type" class="form-control" required="">
                                    <option value=""></option>
                                    <option value="Administration">Administration</option>
                                    <option value="Construction">Construction</option>
                                    <option value="Planning">Planning</option>
                                    <option value="Research/Evaluation">Research/Evaluation</option>
                                    <option value="Resource provision">Resource provision</option>
                                    <option value="Service delivery">Service delivery</option>
                                    <option value="Survey">Survey</option>
                                    <option value="Training">Training</option>
                                </select>
                            </div>
                        </div>

                        <!-- status -->
                        <div class="col-lg-3">
                            <!-- notes -->
                            <div class="form-group">
                                <label class="font-weight-bolder">Status<span class="text-danger">*</span></label>
                                <select id="outcome_activity_status" name="status" class="form-control" required="">
                                    <option value=""></option>
                                    <option value="Not Started">Not Started</option>
                                    <option value="Ongoing">Ongoing</option>
                                    <option value="Paused">Paused</option>
                                    <option value="Completed">Completed</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- assignee -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Assignee <small class="text-muted font-weight-bolder text-uppercase">(Optional)</small></label>
                                <input name="assignee" type="text" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <!-- budget and expenditure -->
                    <div class="row">
                        <!-- budget -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Budget<span class="text-danger">*</span></label>
                                <input name="budget" type="number" step="any" class="form-control" required="" />
                            </div>
                        </div>

                        <!-- expenditure -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Expenditure <small class="text-muted font-weight-bolder text-uppercase">(Optional)</small></label>
                                <input id="outcome_activity_expenditure" name="expenditure" type="number" step="any" class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-success font-weight-bold">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- edit activity -->
<div class="modal fade" id="editOutcomeActivityDialog" tabindex="-1" role="dialog" aria-labelledby="editOutcomeActivityDialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form id="editOutcomeActivityForm" name="editOutcomeActivityForm" method="post" action="">
                <input type="hidden" id="outcome_activity_id" name="id" />

                <div class="modal-header">
                    <h5 class="modal-title">Edit activity info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- code -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Code <small class="text-muted font-weight-bolder text-uppercase">(Optional)</small></label>
                                <input id="ed_outcome_activity_code" name="code" type="text" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <!-- title -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Title<span class="text-danger">*</span></label>
                                <input id="ed_outcome_activity_title" name="title" type="text" class="form-control" required />
                            </div>
                        </div>
                    </div>

                    <!-- description -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Description <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                                <textarea id="ed_outcome_activity_description" name="description" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- start date and end date and status-->
                    <div class="row">
                        <!-- start date -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="font-weight-bolder">Start Date<span class="text-danger">*</span></label>
                                <input id="ed_outcome_activity_start_date" name="start_date" type="text" class="form-control start-date" required="" readonly />
                            </div>
                        </div>

                        <!-- end date -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="font-weight-bolder">End Date<span class="text-danger">*</span></label>
                                <input id="ed_outcome_activity_end_date" name="end_date" type="text" class="form-control end-date" required="" readonly />
                            </div>
                        </div>

                        <!-- activity type -->
                        <div class="col-lg-3">
                            <!-- notes -->
                            <div class="form-group">
                                <label class="font-weight-bolder">Activity Type<span class="text-danger">*</span></label>
                                <select id="ed_outcome_activity_activity_type" name="activity_type" class="form-control" required="">
                                    <option value=""></option>
                                    <option value="Administration">Administration</option>
                                    <option value="Construction">Construction</option>
                                    <option value="Planning">Planning</option>
                                    <option value="Research/Evaluation">Research/Evaluation</option>
                                    <option value="Resource provision">Resource provision</option>
                                    <option value="Service delivery">Service delivery</option>
                                    <option value="Survey">Survey</option>
                                    <option value="Training">Training</option>
                                </select>
                            </div>
                        </div>

                        <!-- status -->
                        <div class="col-lg-3">
                            <!-- notes -->
                            <div class="form-group">
                                <label class="font-weight-bolder">Status<span class="text-danger">*</span></label>
                                <select id="ed_outcome_activity_status" name="status" class="form-control" required="">
                                    <option value=""></option>
                                    <option value="Not Started">Not Started</option>
                                    <option value="Ongoing">Ongoing</option>
                                    <option value="Paused">Paused</option>
                                    <option value="Completed">Completed</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- assignee -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Assignee <small class="text-muted font-weight-bolder text-uppercase">(Optional)</small></label>
                                <input id="ed_outcome_activity_assignee" name="assignee" type="text" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <!-- budget and expenditure -->
                    <div class="row">
                        <!-- budget -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Budget<span class="text-danger">*</span></label>
                                <input id="ed_outcome_activity_budget" name="budget" type="number" step="any" class="form-control" required="" />
                            </div>
                        </div>

                        <!-- expenditure -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Expenditure <small class="text-muted font-weight-bolder text-uppercase">(Optional)</small></label>
                                <input id="ed_outcome_activity_expenditure" name="expenditure" type="number" step="any" class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-success font-weight-bold">Save</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- add indicator -->
<div class="modal fade" id="addOutputIndicatorDialog" tabindex="-1" role="dialog" aria-labelledby="addOutputIndicatorDialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form id="addOutputIndicatorForm" name="addOutputIndicatorForm" method="post" action="">
                <input type="hidden" id="output_indicator_id" name="output_id" />
                <input type="hidden" id="output_indicator_description" name="output_description" />
                <input type="hidden" id="output_indicator_add_disaggs" name="disaggregations" />

                <div class="modal-header">
                    <h5 class="modal-title">Add output indicator</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- title -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Output</label>
                                <br/>
                                <label id="output_indicator_desc"></label>
                            </div>
                        </div>
                    </div>

                    <!-- title and reporting frequency -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Title<span class="text-danger">*</span></label>
                                <input name="title" type="text" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Reporting Frequency<span class="text-danger">*</span></label>
                                <select name="reporting_frequency" class="form-control" required="">
                                    <option value=""></option>
                                    <option value="Monthly">Monthly</option>
                                    <option value="Bi-Monthly">Bi-Monthly</option>
                                    <option value="Quarterly">Quarterly</option>
                                    <option value="Semi-Annual">Semi-Annual</option>
                                    <option value="Annual">Annual</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- description -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Description<span class="text-danger">*</span></label>
                                <textarea name="description" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- disaggregation -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Disaggregation<span class="text-danger">*</span></label>
                                <select id="output_indicator_add_target_type" name="target_type" class="form-control" required="">
                                    <option value=""></option>
                                    <option value="Disaggregation">Disaggregation</option>
                                    <option value="None">None</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- baseline and target -->
                    <div id="output_indicator_add_target_baseline_section" class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Label <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                                <input name="label" type="number" step="any" class="form-control" />
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Baseline <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                                <input name="baseline" type="number" step="any" class="form-control" />
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Target <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                                <input name="target" type="number" step="any" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <!-- disaggregations -->
                    <div id="output_indicator_add_disagg_section">
                        <div class="separator separator-dashed mt-8 mb-8"></div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="font-weight-bolder text-muted font-italic">Label</label>
                                    <input id="output_indicator_add_disag_label" type="text" class="form-control" placeholder="e.g. Male" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="font-weight-bolder text-muted font-italic">Baseline</label>
                                    <input id="output_indicator_add_disag_baseline" type="number" step="any" class="form-control" placeholder="e.g. 10" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="font-weight-bolder text-muted font-italic">Target</label>
                                    <div class="input-group">
                                        <input id="output_indicator_add_disag_target" type="number" step="any" class="form-control" placeholder="e.g. 10" />
                                        <div class="input-group-append">
                                            <button class="btn btn-secondary" type="button" onclick="add_output_indicator_disag();">ADD</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive-lg">
                                    <table id="output_indicator_add_disagg_values" class="table">
                                        <caption>Disaggregation Data</caption>
                                        <thead>
                                            <tr>
                                                <th>Label</th>
                                                <th>Baseline</th>
                                                <th>Target</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-borderless"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="separator separator-dashed mt-8 mb-8"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-success font-weight-bold">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="modalZoom87" aria-labelledby="add-work-plan-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered project-detail__modal-dialog" role="document">
        <div class="modal-content project-detail__modal">
            <div class="modal-header">
                <div class="project-detail__modal-heading">
                    <span class="project-detail__modal-icon"><em class="icon ni ni-calendar-alt" aria-hidden="true"></em></span>
                    <div>
                        <h5 class="modal-title" id="add-work-plan-title">Add annual work plan</h5>
                        <p>Name the plan, choose its financial year, and set the planning type.</p>
                    </div>
                </div>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </button>
            </div>
            <form method="POST" action="{{ route('createwpcontainer') }}" class="project-detail__modal-form">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="status" value="01">
                    <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="organization_id" value="{{ Auth::user()->organization_id }}">
                    <input type="hidden" name="project_id" value="{{ $projectshow->id }}">

                    <div class="project-detail__form-grid">
                        <div class="project-detail__form-field project-detail__form-field--full">
                            <label class="form-label" for="work-plan-container-name">Annual work plan name</label>
                            <input type="text" class="form-control" name="container_name" id="work-plan-container-name" placeholder="e.g. Community health activities">
                        </div>
                        <div class="project-detail__form-field">
                            <label class="form-label" for="financial_year">Financial year</label>
                            <select class="form-control" name="financial_year" id="financial_year">
                                <option value="null">Select financial year</option>
                                @foreach($years as $obj)
                                    <option value="{{ $obj->year_name }}">{{ $obj->year_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="project-detail__form-field">
                            <label class="form-label" for="planning_type">Planning type</label>
                            <select class="form-control" name="planning_type" id="planning_type">
                                <option value="null">Select planning type</option>
                                <option value="Activity">Activities</option>
                                <option value="Indicator">Indicators</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="admin-page__button-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="admin-page__button">
                        <em class="icon ni ni-check" aria-hidden="true"></em>
                        Save work plan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- edit indicator -->
<div class="modal fade" id="editOutputIndicatorDialog" tabindex="-1" role="dialog" aria-labelledby="editOutputIndicatorDialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form id="editOutputIndicatorForm" name="editOutputIndicatorForm" method="post" action="">
                <input type="hidden" id="ed_output_indicator_id" name="id" />
                <input type="hidden" id="ed_output_indicator_add_disaggs" name="disaggregations" />

                <div class="modal-header">
                    <h5 class="modal-title">Edit indicator</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- title -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Output</label>
                                <br/>
                                <label id="ed_output_indicator_desc"></label>
                            </div>
                        </div>
                    </div>

                    <!-- title and reporting frequency -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Title<span class="text-danger">*</span></label>
                                <input id="ed_output_indicator_title" name="title" type="text" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Reporting Frequency<span class="text-danger">*</span></label>
                                <select id="ed_output_indicator_reporting_frequency" name="reporting_frequency" class="form-control" required="">
                                    <option value=""></option>
                                    <option value="Monthly">Monthly</option>
                                    <option value="Bi-Monthly">Bi-Monthly</option>
                                    <option value="Quarterly">Quarterly</option>
                                    <option value="Semi-Annual">Semi-Annual</option>
                                    <option value="Annual">Annual</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- description -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Description<span class="text-danger">*</span></label>
                                <textarea id="ed_output_indicator_description" name="description" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- means of variation and target -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Disaggregation<span class="text-danger">*</span></label>
                                <select id="ed_output_indicator_add_target_type" name="target_type" class="form-control" required="">
                                    <option value=""></option>
                                    <option value="Disaggregation">Disaggregation</option>
                                    <option value="None">None</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- baseline and target -->
                    <div id="ed_output_indicator_add_target_baseline_section" class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="font-weight-bolder">Baseline <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                                <input id="ed_output_indicator_baseline" name="baseline" type="number" step="any" class="form-control" />
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="font-weight-bolder">Target <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                                <input id="ed_output_indicator_target" name="target" type="number" step="any" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <!-- disaggregations -->
                    <div id="ed_output_indicator_add_disagg_section">
                        <div class="separator separator-dashed mt-8 mb-8"></div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="font-weight-bolder text-muted font-italic">Label</label>
                                    <input id="ed_output_indicator_add_disag_label" type="text" class="form-control" placeholder="e.g. Male" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="font-weight-bolder text-muted font-italic">Baseline</label>
                                    <input id="ed_output_indicator_add_disag_baseline" type="number" step="any" class="form-control" placeholder="e.g. 10" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="font-weight-bolder text-muted font-italic">Target</label>
                                    <div class="input-group">
                                        <input id="ed_output_indicator_add_disag_target" type="number" step="any" class="form-control" placeholder="e.g. 10" />
                                        <div class="input-group-append">
                                            <button class="btn btn-secondary" type="button" onclick="ed_add_output_indicator_disag();">ADD</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive-lg">
                                    <table id="ed_output_indicator_add_disagg_values" class="table">
                                        <caption>Disaggregation Data</caption>
                                        <thead>
                                            <tr>
                                                <th>Label</th>
                                                <th>Baseline</th>
                                                <th>Target</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-borderless"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="separator separator-dashed mt-8 mb-8"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-success font-weight-bold">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- add output activity -->
<div class="modal fade" id="addOutputActivityDialog" tabindex="-1" role="dialog" aria-labelledby="addOutputActivityDialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form id="addOutputActivityForm" name="addOutputActivityForm" method="post" action="">
                <input type="hidden" name="project_id" value="9" />
                <input type="hidden" name="link_type" value="OUTPUT" />
                <input type="hidden" id="output_activity_link_id" name="link_id" />
                <input type="hidden" id="output_activity_link_description" name="link_description" />

                <div class="modal-header">
                    <h5 class="modal-title">Add a new activity</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- code -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Code <small class="text-muted font-weight-bolder text-uppercase">(Optional)</small></label>
                                <input name="code" type="text" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <!-- title -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Title<span class="text-danger">*</span></label>
                                <input name="title" type="text" class="form-control" required />
                            </div>
                        </div>
                    </div>

                    <!-- description -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Description <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                                <textarea name="description" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- start date and end date and status-->
                    <div class="row">
                        <!-- start date -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="font-weight-bolder">Start Date<span class="text-danger">*</span></label>
                                <input name="start_date" type="text" class="form-control start-date" required="" readonly />
                            </div>
                        </div>

                        <!-- end date -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="font-weight-bolder">End Date<span class="text-danger">*</span></label>
                                <input name="end_date" type="text" class="form-control end-date" required="" readonly />
                            </div>
                        </div>

                        <!-- activity type -->
                        <div class="col-lg-3">
                            <!-- notes -->
                            <div class="form-group">
                                <label class="font-weight-bolder">Activity Type<span class="text-danger">*</span></label>
                                <select name="activity_type" class="form-control" required="">
                                    <option value=""></option>
                                    <option value="Administration">Administration</option>
                                    <option value="Construction">Construction</option>
                                    <option value="Planning">Planning</option>
                                    <option value="Research/Evaluation">Research/Evaluation</option>
                                    <option value="Resource provision">Resource provision</option>
                                    <option value="Service delivery">Service delivery</option>
                                    <option value="Survey">Survey</option>
                                    <option value="Training">Training</option>
                                </select>
                            </div>
                        </div>

                        <!-- status -->
                        <div class="col-lg-3">
                            <!-- notes -->
                            <div class="form-group">
                                <label class="font-weight-bolder">Status<span class="text-danger">*</span></label>
                                <select id="output_activity_status" name="status" class="form-control" required="">
                                    <option value=""></option>
                                    <option value="Not Started">Not Started</option>
                                    <option value="Ongoing">Ongoing</option>
                                    <option value="Paused">Paused</option>
                                    <option value="Completed">Completed</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- assignee -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Assignee <small class="text-muted font-weight-bolder text-uppercase">(Optional)</small></label>
                                <input name="assignee" type="text" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <!-- budget and expenditure -->
                    <div class="row">
                        <!-- budget -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Budget<span class="text-danger">*</span></label>
                                <input name="budget" type="number" step="any" class="form-control" required="" />
                            </div>
                        </div>

                        <!-- expenditure -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Expenditure <small class="text-muted font-weight-bolder text-uppercase">(Optional)</small></label>
                                <input id="output_activity_expenditure" name="expenditure" type="number" step="any" class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-success font-weight-bold">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- edit output activity -->
<div class="modal fade" id="editOutputActivityDialog" tabindex="-1" role="dialog" aria-labelledby="editOutputActivityDialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form id="editOutputActivityForm" name="editOutputActivityForm" method="post" action="">
                <input type="hidden" id="output_activity_id" name="id" />

                <div class="modal-header">
                    <h5 class="modal-title">Edit activity info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- code -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Code <small class="text-muted font-weight-bolder text-uppercase">(Optional)</small></label>
                                <input id="ed_output_activity_code" name="code" type="text" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <!-- title -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Title<span class="text-danger">*</span></label>
                                <input id="ed_output_activity_title" name="title" type="text" class="form-control" required />
                            </div>
                        </div>
                    </div>

                    <!-- description -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Description <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                                <textarea id="ed_output_activity_description" name="description" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- start date and end date and status-->
                    <div class="row">
                        <!-- start date -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="font-weight-bolder">Start Date<span class="text-danger">*</span></label>
                                <input id="ed_output_activity_start_date" name="start_date" type="text" class="form-control start-date" required="" readonly />
                            </div>
                        </div>

                        <!-- end date -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="font-weight-bolder">End Date<span class="text-danger">*</span></label>
                                <input id="ed_output_activity_end_date" name="end_date" type="text" class="form-control end-date" required="" readonly />
                            </div>
                        </div>

                        <!-- activity type -->
                        <div class="col-lg-3">
                            <!-- notes -->
                            <div class="form-group">
                                <label class="font-weight-bolder">Activity Type<span class="text-danger">*</span></label>
                                <select id="ed_output_activity_activity_type" name="activity_type" class="form-control" required="">
                                    <option value=""></option>
                                    <option value="Administration">Administration</option>
                                    <option value="Construction">Construction</option>
                                    <option value="Planning">Planning</option>
                                    <option value="Research/Evaluation">Research/Evaluation</option>
                                    <option value="Resource provision">Resource provision</option>
                                    <option value="Service delivery">Service delivery</option>
                                    <option value="Survey">Survey</option>
                                    <option value="Training">Training</option>
                                </select>
                            </div>
                        </div>

                        <!-- status -->
                        <div class="col-lg-3">
                            <!-- notes -->
                            <div class="form-group">
                                <label class="font-weight-bolder">Status<span class="text-danger">*</span></label>
                                <select id="ed_output_activity_status" name="status" class="form-control" required="">
                                    <option value=""></option>
                                    <option value="Not Started">Not Started</option>
                                    <option value="Ongoing">Ongoing</option>
                                    <option value="Paused">Paused</option>
                                    <option value="Completed">Completed</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- assignee -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Assignee <small class="text-muted font-weight-bolder text-uppercase">(Optional)</small></label>
                                <input id="ed_output_activity_assignee" name="assignee" type="text" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <!-- budget and expenditure -->
                    <div class="row">
                        <!-- budget -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Budget<span class="text-danger">*</span></label>
                                <input id="ed_output_activity_budget" name="budget" type="number" step="any" class="form-control" required="" />
                            </div>
                        </div>

                        <!-- expenditure -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Expenditure <small class="text-muted font-weight-bolder text-uppercase">(Optional)</small></label>
                                <input id="ed_output_activity_expenditure" name="expenditure" type="number" step="any" class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-success font-weight-bold">Save</button>
                </div>
            </form>
        </div>
    </div>
</div> 


<div class="modal fade zoom" tabindex="-1" id="submitintervention1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Submit Intervention</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="nk-block nk-block-lg">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <ul class="nav nav-tabs mt-n3">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem589790"><em class="icon ni ni-table"></em><span>Submit Intervention</span></a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem589790">
                                    <form method="POST" action="{{ route('submitintervention')}}">
                                        @csrf
                                        <div class="row gy-4">

                                            <script type="text/javascript">
                                                $(document).ready(function() {
                                                    $('#users_id').change(function(){
                                                        $.get("{{ url('api/submittedemail')}}",
                                                            { option: $(this).val() },
                                                            function(data) {
                                                                console.log('submittedemail');
                                                                $('#submittedemail').val(data);
                                                            });
                                                    });
                                                });
                                            </script>

                                            <script type="text/javascript">
                                                $(document).ready(function() {
                                                    $('#users_id').change(function(){
                                                        $.get("{{ url('api/submiitedname')}}",
                                                            { option: $(this).val() },
                                                            function(data) {
                                                                console.log('submiitedname');
                                                                $('#submiitedname').val(data);
                                                            });
                                                    });
                                                });
                                            </script>

                                            <div class="form-group" id="program">
                                                <label class="form-label" for="default-06">Submit To?</label>
                                                <div class="form-control-wrap ">
                                                    <div class="form-control-select">
                                                        <select class="form-control" id="users_id" name="users_id" >
                                                            <option value="#">Nothing Selected</option>
                                                            <option></option>                                                
                                                            @foreach($projectusers as $object)
                                                            <option value="{{$object->id}}">{{$object->name}}  {{$object->last_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php

                                            $date = date('l dS \of F Y h:i:s A');
                                            ?>

                                            <input type="hidden" name="email" id="submittedemail" />
                                            <input type="hidden" name="name" id="submiitedname" />
                                            <input type="hidden" name="submitted_name" value="{{Auth::user()->name}}" />
                                            <input type="hidden" name="submitted_on" value="{{$date}}" />

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="default-textarea">Add Comment</label>
                                                    <div class="form-control-wrap">
                                                        <textarea class="form-control no-resize" name="submission_comment" id="default-textarea"></textarea>
                                                    </div>
                                                </div>
                                            </div> 

                                            <input type="hidden" name="status" value="02">
                                            <input type="hidden" name="submitted_by" value="{{Auth::user()->id}}">
                                            <input type="hidden" name="container_id" id="sibmit_container_id">
                                            <input type="hidden" name="container_name" id="submitted_container_name">

                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <span class="sub-text"></span>
            </div>
        </div>
    </div>
</div> 


<div class="modal fade zoom" tabindex="-1" id="cancelintervention1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cancel Intervention</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="nk-block nk-block-lg">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <ul class="nav nav-tabs mt-n3">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem58979080"><em class="icon ni ni-table"></em><span>Cancel Intervention</span></a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem58979080">
                                    <form method="POST" action="{{ route('cancelintervention')}}">
                                        @csrf
                                        <div class="row gy-4">


                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="default-textarea">Add Comment</label>
                                                    <div class="form-control-wrap">
                                                        <textarea class="form-control no-resize" name="cancel_comment" id="default-textarea"></textarea>
                                                    </div>
                                                </div>
                                            </div> 

                                            <input type="hidden" name="status" value="01">
                                            <input type="hidden" name="container_id" id="cancel_container_id">
                                            <input type="hidden" name="container_name" id="cancel_container_name">

                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <span class="sub-text"></span>
            </div>
        </div>
    </div>
</div> 


<div class="modal fade zoom" tabindex="-1" id="timeline1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Timeline</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="nk-block nk-block-lg">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <div class="example-alerts">
                                <div class="gy-4">
                                    <div class="example-alert">
                                        <div class="alert alert-success alert-icon">
                                            <em class="icon ni ni-check-circle"></em> <strong>Intervention Container Created</strong>
                                        </div>
                                    </div>
                                    <!-- <div class="example-alert">
                                        <div class="alert alert-secondary alert-icon">
                                            <em class="icon ni ni-alert-circle"></em> <strong>Order has been placed</strong>. Your will be redirect for make your payment.
                                        </div>
                                    </div>
                                    <div class="example-alert">
                                        <div class="alert alert-success alert-icon">
                                            <em class="icon ni ni-check-circle"></em> <strong>Thanks for your deposit</strong>. Your account balance has been updated accordingly.
                                        </div>
                                    </div>
                                    <div class="example-alert">
                                        <div class="alert alert-info alert-icon">
                                            <em class="icon ni ni-alert-circle"></em> <strong>Order has been placed</strong>. Your will be redirect for make your payment.
                                        </div>
                                    </div>
                                    <div class="example-alert">
                                        <div class="alert alert-warning alert-icon">
                                            <em class="icon ni ni-alert-circle"></em> Your credit card <strong>already expired</strong>. Please enter a valid & up-to-date <a href="#" class="alert-link">credit card</a> for make deposit.
                                        </div>
                                    </div>
                                    <div class="example-alert">
                                        <div class="alert alert-danger alert-icon">
                                            <em class="icon ni ni-cross-circle"></em> <strong>Update failed</strong>! There is some technical issues.
                                        </div>
                                    </div>
                                    <div class="example-alert">
                                        <div class="alert alert-gray alert-icon">
                                            <em class="icon ni ni-alert-circle"></em> Your credit card <strong>already expired</strong>. Please enter a valid & up-to-date <a href="#" class="alert-link">credit card</a> for make deposit.
                                        </div>
                                    </div>
                                    <div class="example-alert">
                                        <div class="alert alert-light alert-icon">
                                            <em class="icon ni ni-alert-circle"></em> Your credit card <strong>already expired</strong>. Please enter a valid & up-to-date <a href="#" class="alert-link">credit card</a> for make deposit.
                                        </div>
                                    </div>
                                    <div class="example-alert">
                                        <div class="alert alert-danger alert-icon alert-dismissible">
                                            <em class="icon ni ni-cross-circle"></em> <strong>Update failed</strong>! There is some technical issues. <button class="close" data-bs-dismiss="alert"></button>
                                        </div>
                                    </div> -->
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <span class="sub-text"></span>
            </div>
        </div>
    </div>
</div> 


<div class="modal fade zoom" tabindex="-1" id="workplan1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Submit WorkPlan</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="nk-block nk-block-lg">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <ul class="nav nav-tabs mt-n3">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem5897901"><em class="icon ni ni-table"></em><span>Submit WorkPlan</span></a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem5897901">
                                    <form method="POST" action="{{ route('submitworkplan')}}">
                                        @csrf
                                        <div class="row gy-4">

                                            <script type="text/javascript">
                                                $(document).ready(function() {
                                                    $('#users_id').change(function(){
                                                        $.get("{{ url('api/submittedemail')}}",
                                                            { option: $(this).val() },
                                                            function(data) {
                                                                console.log('submittedemail');
                                                                $('#submittedemail').val(data);
                                                            });
                                                    });
                                                });
                                            </script>

                                            <script type="text/javascript">
                                                $(document).ready(function() {
                                                    $('#users_id').change(function(){
                                                        $.get("{{ url('api/submiitedname')}}",
                                                            { option: $(this).val() },
                                                            function(data) {
                                                                console.log('submiitedname');
                                                                $('#submiitedname').val(data);
                                                            });
                                                    });
                                                });
                                            </script>

                                            <div class="form-group" id="program">
                                                <label class="form-label" for="default-06">Submit To?</label>
                                                <div class="form-control-wrap ">
                                                    <div class="form-control-select">
                                                        <select class="form-control" id="users_id" name="users_id" >
                                                            <option value="#">Nothing Selected</option>
                                                            <option></option>                                                
                                                            @foreach($projectusers as $object)
                                                            <option value="{{$object->id}}">{{$object->name}}  {{$object->last_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php

                                            $date = date('l dS \of F Y h:i:s A');
                                            ?>

                                            <input type="hidden" name="email" id="submittedemail" />
                                            <input type="hidden" name="name" id="submiitedname" />
                                            <input type="hidden" name="submitted_name" value="{{Auth::user()->name}}" />
                                            <input type="hidden" name="submitted_on" value="{{$date}}" />
                                            <input type="hidden" name="status" value="02">
                                            <input type="hidden" name="submitted_by" value="{{Auth::user()->id}}">
                                            <input type="hidden" name="container_id" id="workplan_container_id">
                                            <input type="hidden" name="container_name" id="workplan_container_name">

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="default-textarea">Add Comment</label>
                                                    <div class="form-control-wrap">
                                                        <textarea class="form-control no-resize" name="submission_comment" id="default-textarea"></textarea>
                                                    </div>
                                                </div>
                                            </div> 

                                            

                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <span class="sub-text"></span>
            </div>
        </div>
    </div>
</div> 

<div class="modal fade zoom" tabindex="-1" id="cancelworkplan1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cancel Workplan Container</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="nk-block nk-block-lg">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <ul class="nav nav-tabs mt-n3">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem589790801"><em class="icon ni ni-table"></em><span>Cancel WorkPlanConatiner</span></a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem589790801">
                                    <form method="POST" action="{{ route('cancelworkplan')}}">
                                        @csrf
                                        <div class="row gy-4">


                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="default-textarea">Add Comment</label>
                                                    <div class="form-control-wrap">
                                                        <textarea class="form-control no-resize" name="cancel_comment" id="default-textarea"></textarea>
                                                    </div>
                                                </div>
                                            </div> 

                                            <?php

                                            $date = date('l dS \of F Y h:i:s A');
                                            ?>

                                            <input type="hidden" name="status" value="01">
                                            <input type="hidden" name="container_id" id="cancelw_container_id">
                                            <input type="hidden" name="container_name" id="cancelw_container_name">
                                            <input type="hidden" name="cancel_date" value="{{$date}}" />

                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <span class="sub-text"></span>
            </div>
        </div>
    </div>
</div> 


<div class="modal fade zoom" tabindex="-1" id="forwardintervention1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Forward Intervention</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="nk-block nk-block-lg">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <ul class="nav nav-tabs mt-n3">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem58979022897"><em class="icon ni ni-table"></em><span>Forward Intervention</span></a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem58979022897">
                                    <form method="POST" action="{{ route('forwardintervention')}}">
                                        @csrf
                                        <div class="row gy-4">

                                            <script type="text/javascript">
                                                $(document).ready(function() {
                                                    $('#users_id1').change(function(){
                                                        $.get("{{ url('api/submittedemail')}}",
                                                            { option: $(this).val() },
                                                            function(data) {
                                                                console.log('submittedemail1');
                                                                $('#submittedemail1').val(data);
                                                            });
                                                    });
                                                });
                                            </script>

                                            <script type="text/javascript">
                                                $(document).ready(function() {
                                                    $('#users_id1').change(function(){
                                                        $.get("{{ url('api/submiitedname')}}",
                                                            { option: $(this).val() },
                                                            function(data) {
                                                                console.log('submiitedname1');
                                                                $('#submiitedname1').val(data);
                                                            });
                                                    });
                                                });
                                            </script>

                                            <div class="form-group" id="program">
                                                <label class="form-label" for="default-06">Submit To?</label>
                                                <div class="form-control-wrap ">
                                                    <div class="form-control-select">
                                                        <select class="form-control" id="users_id1" name="users_id1" >
                                                            <option value="#">Nothing Selected</option>
                                                            <option></option>                                                
                                                            @foreach($projectusers as $object)
                                                            <option value="{{$object->id}}">{{$object->name}}  {{$object->last_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php

                                            $date = date('l dS \of F Y h:i:s A');
                                            ?>

                                            <input type="hidden" name="forward_to_email" id="submittedemail1" />
                                            <input type="hidden" name="forward_to_name" id="submiitedname1" />
                                            <input type="hidden" name="forwarded_by" value="{{Auth::user()->name}}" />
                                            <input type="hidden" name="forwarded_on" value="{{$date}}" />

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="default-textarea">Add Comment</label>
                                                    <div class="form-control-wrap">
                                                        <textarea class="form-control no-resize" name="submission_comment" id="default-textarea"></textarea>
                                                    </div>
                                                </div>
                                            </div> 

                                            <input type="hidden" name="status" value="02">
                                            <input type="hidden" name="forwarded_by" value="{{Auth::user()->id}}">
                                            <input type="hidden" name="container_id" id="forward_container_id">
                                            <input type="hidden" name="container_name" id="forward_container_name">

                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <span class="sub-text"></span>
            </div>
        </div>
    </div>
</div> 


<div class="modal fade zoom" tabindex="-1" id="approveintervention1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Approve Intervention</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="nk-block nk-block-lg">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <ul class="nav nav-tabs mt-n3">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem58979022897"><em class="icon ni ni-table"></em><span>Approve Intervention</span></a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem58979022897">
                                    <form method="POST" action="{{ route('approveintervention')}}">
                                        @csrf
                                        <div class="row gy-4">


                                            <?php

                                            $date = date('l dS \of F Y h:i:s A');
                                            ?>

                                            <input type="hidden" name="approved_by" value="{{Auth::user()->name}}" />
                                            <input type="hidden" name="approved_by_email" value="{{Auth::user()->email}}" />
                                            <input type="hidden" name="approved_on" value="{{$date}}" />

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="default-textarea">Add Comment</label>
                                                    <div class="form-control-wrap">
                                                        <textarea class="form-control no-resize" name="approval_comment" id="default-textarea"></textarea>
                                                    </div>
                                                </div>
                                            </div> 

                                            <input type="hidden" name="status" value="02">
                                            <input type="hidden" name="container_id" id="approve_container_id">
                                            <input type="hidden" name="container_name" id="approve_container_name">

                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <span class="sub-text"></span>
            </div>
        </div>
    </div>
</div> 

<div class="modal fade zoom" tabindex="-1" id="rejectintervention1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reject Intervention</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="nk-block nk-block-lg">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <ul class="nav nav-tabs mt-n3">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem58979022897"><em class="icon ni ni-table"></em><span>Reject Intervention</span></a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem58979022897">
                                    <form method="POST" action="{{ route('rejectintervention')}}">
                                        @csrf
                                        <div class="row gy-4">


                                            <?php

                                            $date = date('l dS \of F Y h:i:s A');
                                            ?>

                                            <input type="hidden" name="rejected_by" value="{{Auth::user()->name}}" />
                                            <input type="hidden" name="rejected_by_email" value="{{Auth::user()->email}}" />
                                            <input type="hidden" name="rejected_on" value="{{$date}}" />

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="default-textarea">Add Comment</label>
                                                    <div class="form-control-wrap">
                                                        <textarea class="form-control no-resize" name="reject_comment" id="default-textarea"></textarea>
                                                    </div>
                                                </div>
                                            </div> 

                                            <input type="hidden" name="status" value="01">
                                            <input type="hidden" name="container_id" id="reject_container_id1">
                                            <input type="hidden" name="container_name" id="reject_container_name1">

                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <span class="sub-text"></span>
            </div>
        </div>
    </div>
</div>


<div class="modal fade zoom" tabindex="-1" id="uploadintervention1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Intervention</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="nk-block nk-block-lg">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <ul class="nav nav-tabs mt-n3">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem58979022897"><em class="icon ni ni-table"></em><span>Upload Excel/CSV</span></a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem58979022897">
                                    <form method="POST" action="#">
                                        @csrf
                                        <div class="row gy-4">

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <!-- <label class="font-weight-bolder">Upload Excel/CSV</label> -->
                                                        <input id="" name="" type="file" class="form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Upload</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <span class="sub-text"></span>
            </div>
        </div>
    </div>
</div>

<script>
// reject intervention container
    $(document).ready(function () {
        $('body').on('click', '#rejectintervention2', function (event) {
            event.preventDefault();
            var url = "{{ route('interventioncontainers.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {
                console.log(data);
                $('#userCrudModal').html("Output category");
                $('#submit').val("intervention add");
                $('#rejectintervention1').modal('show');
                $('#reject_container_id1').val(data.id);
                $('#reject_container_name1').val(data.container_name);
            })
        });
    }); 
</script>

<script>
// approve intervention container
    $(document).ready(function () {
        $('body').on('click', '#approveintervention2', function (event) {
            event.preventDefault();
            var url = "{{ route('interventioncontainers.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {
                console.log(data);
                $('#userCrudModal').html("Output category");
                $('#submit').val("intervention add");
                $('#approveintervention1').modal('show');
                $('#approve_container_id').val(data.id);
                $('#approve_container_name').val(data.container_name);
            })
        });
    }); 
</script>

<script>
// forward intervention container
    $(document).ready(function () {
        $('body').on('click', '#forwardintervention2', function (event) {
            event.preventDefault();
            var url = "{{ route('interventioncontainers.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {
                console.log(data);
                $('#userCrudModal').html("Output category");
                $('#submit').val("intervention add");
                $('#forwardintervention1').modal('show');
                $('#forward_container_id').val(data.id);
                $('#forward_container_name').val(data.container_name);
            })
        });
    }); 
</script>

<script>
// cancel container
    $(document).ready(function () {
        $('body').on('click', '#cancelworkplan', function (event) {
            event.preventDefault();
            var url = "{{ route('workplancontainers.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {
                console.log(data);
                $('#userCrudModal').html("Output category");
                $('#submit').val("intervention add");
                $('#cancelworkplan1').modal('show');
                $('#cancelw_container_id').val(data.id);
                $('#cancelw_container_name').val(data.container_name);
            })
        });
    }); 
</script>

<script>
// Add submitcontainer workplan
    $(document).ready(function () {
        $('body').on('click', '#workplan2', function (event) {
            event.preventDefault();
            var url = "{{ route('workplancontainers.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {
                console.log(id);
                $('#userCrudModal').html("Output category");
                $('#submit').val("intervention add");
                $('#workplan1').modal('show');
                $('#workplan_container_id').val(data.id);
                $('#workplan_container_name').val(data.container_name);
            })
        });
    }); 
</script> 

<script>
// Add addIntervetion
    $(document).ready(function () {
        $('body').on('click', '#addintervention12', function (event) {
            event.preventDefault();
            var url = "{{ route('interventions.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {
                console.log(id);
                $('#userCrudModal').html("Output category");
                $('#submit').val("intervention add");
                $('#addintervention1').modal('show');
                $('#intervention_container123').val(id);
            })
        });
    }); 
</script> 

<script>
// Add submitcontainer
    $(document).ready(function () {
        $('body').on('click', '#submitcontainer', function (event) {
            event.preventDefault();
            var url = "{{ route('interventioncontainers.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {
                console.log(id);
                $('#userCrudModal').html("Output category");
                $('#submit').val("intervention add");
                $('#submitintervention1').modal('show');
                $('#sibmit_container_id').val(data.id);
                $('#submitted_container_name').val(data.container_name);
            })
        });
    }); 
</script>  

<script>
// Show Intervention timeline
    $(document).ready(function () {
        $('body').on('click', '#timeline', function (event) {
            event.preventDefault();
            var url = "{{ route('interventioncontainers.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {
                console.log(id);
                $('#userCrudModal').html("Output category");
                $('#submit').val("intervention add");
                $('#timeline1').modal('show');
                $('#timeline_container_id').val(data.id);
                $('#timeline_container_name').val(data.container_name);
            })
        });
    }); 
</script>

<script>
// Add forwardcontainer
    $(document).ready(function () {
        $('body').on('click', '#forwardcontainer', function (event) {
            event.preventDefault();
            var url = "{{ route('interventioncontainers.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {
                console.log(id);
                $('#userCrudModal').html("Output category");
                $('#submit').val("intervention add");
                $('#submitintervention1').modal('show');
                $('#sibmit_container_id').val(data.id);
                $('#submitted_container_name').val(data.container_name);
            })
        });
    }); 
</script> 

<script>
// Add approvecontainer
    $(document).ready(function () {
        $('body').on('click', '#approvecontainer', function (event) {
            event.preventDefault();
            var url = "{{ route('interventioncontainers.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {
                console.log(id);
                $('#userCrudModal').html("Output category");
                $('#submit').val("intervention add");
                $('#submitintervention1').modal('show');
                $('#sibmit_container_id').val(data.id);
                $('#submitted_container_name').val(data.container_name);
            })
        });
    }); 
</script>

<script>
// Add rejectcontainer
    $(document).ready(function () {
        $('body').on('click', '#rejectcontainer', function (event) {
            event.preventDefault();
            var url = "{{ route('interventioncontainers.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {
                console.log(id);
                $('#userCrudModal').html("Output category");
                $('#submit').val("intervention add");
                $('#submitintervention1').modal('show');
                $('#sibmit_container_id').val(data.id);
                $('#submitted_container_name').val(data.container_name);
            })
        });
    }); 
</script>

<script>
// cancel container
    $(document).ready(function () {
        $('body').on('click', '#cancelintervention', function (event) {
            event.preventDefault();
            var url = "{{ route('interventioncontainers.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {
                console.log(data);
                $('#userCrudModal').html("Output category");
                $('#submit').val("intervention add");
                $('#cancelintervention1').modal('show');
                $('#cancel_container_id').val(data.id);
                $('#cancel_container_name').val(data.container_name);
            })
        });
    }); 
</script>

<script>
    $(document).ready(function () {
        $('body').on('click', '#editintervention', function (event) {
            event.preventDefault();
            var url = "{{ route('interventions.index')}}";
            var id = $(this).data('id');

            $.get(url + '/' + id + '/edit', function (data) {
                console.log(data);
                $('#userCrudModal').html("Edit category");
                $('#submit').val("Edit category");
                $('#editinterventi').modal('show');
                $('#intervention_id').val(data.id);
                $('#activity_name').val(data.activity_id);
                $('#funding11').val(data.funding1);
                $('#funding22').val(data.funding2);
                $('#totall').val(data.total);
            })
        });
    }); 
</script>

<script>
    $(document).ready(function () {
        $('body').on('click', '#viewintervention', function (event) {
            event.preventDefault();
            var url = "{{ route('interventions.index')}}";
            var id = $(this).data('id');

            $.get(url + '/' + id + '/edit', function (data) {
                console.log(data);
                $('#userCrudModal').html("Edit category");
                $('#submit').val("Edit category");
                $('#viewinterventi').modal('show');
                $('#id').val(data.id);
                $('#activity_name1').val(data.activity_name);
                $('#funding111').val(data.funding1);
                $('#funding222').val(data.funding2);
                $('#totalll').val(data.total);
            })
        });
    }); 
</script>

<script>
// Add Output
    $(document).ready(function () {
        $('body').on('click', '#addoutput', function (event) {
            event.preventDefault();
            var url = "{{ route('outcomes.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {
        // console.log(id);
             $('#userCrudModal').html("Output category");
             $('#submit').val("Output category");
             $('#output_model').modal('show');
             $('#outcome_id').val(data.id);
             var parent = data.outcome_code + ' - ' + data.outcome_title;
             $('#output_title').val(parent);
             $('#output_model .logframe-nested__parent-context').text('Outcome: ' + parent);
         })
        });
    }); 
</script>

<script>
// Add addoutcomeactivity
    $(document).ready(function () {
        $('body').on('click', '#addoutcomeactivity', function (event) {
            event.preventDefault();
            var url = "{{ route('outcomes.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {
        // console.log(id);
             $('#userCrudModal').html("Output category");
             $('#submit').val("Output category");
             $('#activity1').modal('show');
             $('#outcome_id1').val(data.id);
             var parent = data.outcome_code + ' - ' + data.outcome_title;
             $('#activity_name2').val(parent);
             $('#activity1 .logframe-nested__parent-context').text('Outcome: ' + parent);
         })
        });
    }); 
</script>


<script>
// Add addoutcomeindicator
    $(document).ready(function () {
        $('body').on('click', '#addoutcomeindicator', function (event) {
            event.preventDefault();
            var url = "{{ route('outcomes.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {
        // console.log(id);
             $('#userCrudModal').html("Output category");
             $('#submit').val("Output category");
             $('#indicator1').modal('show');
             $('#outcome_id3').val(data.id);
             var parent = data.outcome_code + ' - ' + data.outcome_title;
             $('#outcome_indicator').val(parent);
             $('#indicator1 .logframe-nested__parent-context').text('Outcome: ' + parent);
         })
             // window.location.reload();
        });

    }); 
</script>

<script>
// Add addoutputactivity
    $(document).ready(function () {
        $('body').on('click', '#addoutputactivity1', function (event) {
            event.preventDefault();
            var url = "{{ route('outputs.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {
        // console.log(id);
             $('#userCrudModal').html("Output category");
             $('#submit').val("Output category");
             $('#activity2').modal('show');
             $('#output_id5').val(data.id);
             var parent = data.output_code + ' - ' + data.output_name;
             $('#output_title7').val(parent);
             $('#activity2 .logframe-nested__parent-context').text('Output: ' + parent);
         })
        });
    }); 
</script>


<script>
// Add addoutputactivity
    $(document).ready(function () {
        $('body').on('click', '#addoutputindicator', function (event) {
            event.preventDefault();
            var url = "{{ route('outputs.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {
        // console.log(id);
             $('#userCrudModal').html("Output category");
             $('#submit').val("Output category");
             $('#indicator2').modal('show');
             $('#output_indicator5').val(data.id);
             var parent = data.output_code + ' - ' + data.output_name;
             $('#output_indicator7').val(parent);
             $('#indicator2 .logframe-nested__parent-context').text('Output: ' + parent);
         })
        });
    });
</script>

<script>
// Update Budget
    $(document).ready(function () {
        $('body').on('click', '#editbudget', function (event) {
            event.preventDefault();
            var url = "{{ route('budgets.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {

             $('#userCrudModal').html("Output category");
             $('#submit').val("Output category");
             $('#editbudget_modal').modal('show');
             $('#budgetid').val(data.id);
             $('#impid').val(data.id);
         })
        });

    });
</script>


<script>
// Add editgoal
    $(document).ready(function () {
        $('body').on('click', '#editgoal', function (event) {
            event.preventDefault();
            var url = "{{ route('goals.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {

             $('#userCrudModal').html("Output category");
             $('#submit').val("Output category");
             $('#editgoal_modal').modal('show');
             $('#goal_name2').val(data.goal_name);
             $('#goal_code2').val(data.goal_code);
             $('#goal_id2').val(data.id)
         })
        });

    });
</script>

<script>
// Add editoutcome
    $(document).ready(function () {
        $('body').on('click', '#editoutcome', function (event) {
            event.preventDefault();
            var url = "{{ route('outcomes.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {

             $('#userCrudModal').html("Output category");
             $('#submit').val("Output category");
             $('#editoutcome_modal').modal('show');
             $('#outcome_name2').val(data.outcome_title);
             $('#outcome_code2').val(data.outcome_code);
             $('#outcome_id2').val(data.id)
         })
        });
    });
</script>

<script>
// Add editoutput
    $(document).ready(function () {
        $('body').on('click', '#editoutput', function (event) {
            event.preventDefault();
            var url = "{{ route('outputs.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {

             $('#userCrudModal').html("Output category");
             $('#submit').val("Output category");
             $('#editoutput_modal').modal('show');
             $('#output_name2').val(data.output_name);
             $('#output_code2').val(data.output_code);
             $('#output_id2').val(data.id)
         })
        });
    });
</script>


<script>
// Add editoutcomeactivity
    $(document).ready(function () {
        $('body').on('click', '#editoutcomeactivity', function (event) {
            event.preventDefault();
            var url = "{{ route('activities.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {

             $('#userCrudModal').html("Output category");
             $('#submit').val("Output category");
             $('#editoutcomeactivity_modal').modal('show');
             $('#activity_title3').val(data.activity_title);
             $('#activity_code3').val(data.activity_code);
             $('#activity_id3').val(data.id)
         })
        });
    });
</script>

<script>
// Add editouuputactivity
    $(document).ready(function () {
        $('body').on('click', '#editoutputcomeactivity', function (event) {
            event.preventDefault();
            var url = "{{ route('activities.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {

             $('#userCrudModal').html("Output category");
             $('#submit').val("Output category");
             $('#editoutputactivity_modal').modal('show');
             $('#activity_title4').val(data.activity_title);
             $('#activity_code4').val(data.activity_code);
             $('#activity_id4').val(data.id)
         })
        });
    });
</script>


<script>
// Add editgoalactivity
    $(document).ready(function () {
        $('body').on('click', '#editactivity', function (event) {
            event.preventDefault();
            var url = "{{ route('activities.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {

             $('#userCrudModal').html("Output category");
             $('#submit').val("Output category");
             $('#editactivity_modal').modal('show');
             $('#activity_title2').val(data.activity_title);
             $('#activity_code2').val(data.activity_code);
             $('#activity_id2').val(data.id)
         })
        });
    });
</script>

<script>
// Add editgoalIndicator
    $(document).ready(function () {
        $('body').on('click', '#editgoalIndicator', function (event) {
            event.preventDefault();
            var url = "{{ route('indicators.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {

             $('#userCrudModal').html("Output category");
             $('#submit').val("Output category");
             $('#editindicator_modal').modal('show');
             $('#output_name2').val(data.output_name);
             $('#output_code2').val(data.output_code);
             $('#output_id2').val(data.id)
         })
        });
    });
</script>


<script type="text/javascript">

    // deletegoal

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
    $(document).ready(function () {
        $('body').on('click', '#deletegoal', function () {

            var id = $(this).data('id');
            confirm("Are You sure want to delete goal !");

            $.ajax({
                type: "DELETE",
                url: "{{ route('goals.store') }}"+'/'+id,
                success: function (data) {
                    confirm("Goal Has been Deleted!");
                    window.location.reload();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });

    });

</script>


<script type="text/javascript">
    // deleteoutcome

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
    $(document).ready(function () {
        $('body').on('click', '#deleteoutcome', function () {

            var id = $(this).data('id');
            confirm("Are You sure want to delete Outcome!");

            $.ajax({
                type: "DELETE",
                url: "{{ route('outcomes.store') }}"+'/'+id,
                success: function (data) {
                    confirm("Outcome Has been Deleted!");
                    window.location.reload();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });

    });

</script>


<script type="text/javascript">
    // deleteoutput

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
    $(document).ready(function () {
        $('body').on('click', '#deleteoutput', function () {

            var id = $(this).data('id');
            confirm("Are You sure you want to delete Output!");

            $.ajax({
                type: "DELETE",
                url: "{{ route('outputs.store') }}"+'/'+id,
                success: function (data) {
                    confirm("Output Has been Deleted!");
                    window.location.reload();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });

    });

</script>

<script type="text/javascript">
    // delete goal activity

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
    $(document).ready(function () {
        $('body').on('click', '#deleteactivity', function () {

            var id = $(this).data('id');
            confirm("Are You sure you want to delete Activity!");

            $.ajax({
                type: "DELETE",
                url: "{{ route('activities.store') }}"+'/'+id,
                success: function (data) {
                    confirm("Activity Has been Deleted!");
                    window.location.reload();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });

    });

</script>


<script type="text/javascript">
    // delete goal indicator

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
    $(document).ready(function () {
        $('body').on('click', '#deleteindicator', function () {

            var id = $(this).data('id');
            confirm("Are You sure you want to delete Indicator!");

            $.ajax({
                type: "DELETE",
                url: "{{ route('indicators.store') }}"+'/'+id,
                success: function (data) {
                    confirm("Indicator Has been Deleted!");
                    window.location.reload();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });

    });

</script>



<script type="text/javascript">
    // delete outcome activity

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
    $(document).ready(function () {
        $('body').on('click', '#deleteoutcomeactivity', function () {

            var id = $(this).data('id');
            confirm("Are You sure you want to delete this Outcome Activity!");

            $.ajax({
                type: "DELETE",
                url: "{{ route('activities.store') }}"+'/'+id,
                success: function (data) {
                    confirm("Outcome Activity Has been Deleted!");
                    window.location.reload();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });

    });

</script>

<script type="text/javascript">
    // delete outcome indicator

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
    $(document).ready(function () {
        $('body').on('click', '#deleteoutcomeindicator', function () {

            var id = $(this).data('id');
            confirm("Are You sure you want to delete this Outcome Indicator!");

            $.ajax({
                type: "DELETE",
                url: "{{ route('indicators.store') }}"+'/'+id,
                success: function (data) {
                    confirm("Outcome Indicator Has been Deleted!");
                    window.location.reload();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });

    });

</script>


<script type="text/javascript">
    // delete output activity

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
    $(document).ready(function () {
        $('body').on('click', '#deleteoutputactivity', function () {

            var id = $(this).data('id');
            confirm("Are You sure you want to delete this Output Activity!");

            $.ajax({
                type: "DELETE",
                url: "{{ route('activities.store') }}"+'/'+id,
                success: function (data) {
                    confirm("Output Activity Has been Deleted!");
                    window.location.reload();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });

    });

</script>


<script type="text/javascript">
    // delete output indicator

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
    $(document).ready(function () {
        $('body').on('click', '#deleteoutputindicator', function () {

            var id = $(this).data('id');
            confirm("Are You sure you want to delete this Output Indicator!");

            $.ajax({
                type: "DELETE",
                url: "{{ route('indicators.store') }}"+'/'+id,
                success: function (data) {
                    confirm("Output indicator Has been Deleted!");
                    window.location.reload();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });

    });

</script>

@endsection
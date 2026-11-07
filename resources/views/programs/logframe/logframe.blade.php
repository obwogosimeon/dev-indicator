<div class="tab-pane program-logframe" id="tabItem6" role="tabpanel" aria-labelledby="program-logframe-tab">
    <div class="program-detail__panel">
        <div class="program-detail__panel-header">
            <div>
                <p class="admin-page__eyebrow">Results framework</p>
                <h2>Program Logframe</h2>
            </div>
            @if ($programshow->log_frame_id == '')
                <button type="button" class="admin-page__button" data-bs-toggle="modal" data-bs-target="#logframecreate">
                    <em class="icon ni ni-plus" aria-hidden="true"></em>
                    Add results framework
                </button>
            @else
                <button type="button" class="project-logframe__add-goal" data-bs-toggle="modal" data-bs-target="#goalcreate">
                    <em class="icon ni ni-plus" aria-hidden="true"></em>
                    Goal
                </button>
            @endif
        </div>
        <div class="nk-block nk-block-lg project-logframe__tree">
                <div class="card card-bordered card-preview">
                    <div class="card-inner">
                        <div class="project-logframe__table-head" aria-hidden="true">
                            <span>Results hierarchy</span><span aria-hidden="true"></span><span>Baseline</span><span>Target</span><span>Frequency</span><span>Type</span><span aria-hidden="true"></span>
                        </div>
                        @if($loopgoals != null && $loopgoals->count())
                        @foreach($loopgoals as $obj)
                        <div id="logframe-program-{{ $programshow->id }}-goal-{{ $obj->id }}" class="accordion project-logframe__accordion">
                            <div class="accordion-item">
                                <div class="project-logframe__row-actions">
                                <div class="dropdown project-logframe__dropdown project-logframe__dropdown--add">
                                    <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" aria-label="Add to goal" role="button" tabindex="0" data-bs-toggle="dropdown"><em class="icon ni ni-plus" aria-hidden="true"></em></a>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                        <ul class="link-list-plain">
                                            <li class="preview-item">
                                                <button type="button" class="btn btn-success icon ni ni-plus" data-goal-id="{{ $obj->id }}" data-goal-label="{{ $obj->goal_code }} - {{ $obj->goal_name }}" data-bs-toggle="modal" data-bs-target="#practice_modal">Add Outcome</button>
                                            </li> 
                                            <li class="preview-item">
                                                <button type="button" class="btn btn-success icon ni ni-plus" data-goal-id="{{ $obj->id }}" data-goal-label="{{ $obj->goal_code }} - {{ $obj->goal_name }}" data-bs-toggle="modal" data-bs-target="#activity_modal">Add Activity</button>
                                            </li> 
                                            <li class="preview-item">
                                                <button type="button" class="btn btn-success icon ni ni-plus" data-goal-id="{{ $obj->id }}" data-goal-label="{{ $obj->goal_code }} - {{ $obj->goal_name }}" data-bs-toggle="modal" data-bs-target="#indicator_modal">Add Indicator</button>
                                            </li> 
                                        </ul>
                                    </div>
                                </div>
                                <div class="project-logframe__row-options">
                                    <button type="button" id="editgoal" data-id="{{ $obj->id }}" data-bs-toggle="modal" data-bs-target="#editgoal_modal" aria-label="Edit goal"><em class="icon ni ni-edit" aria-hidden="true"></em></button>
                                    <button type="button" id="deletegoal" data-id="{{ $obj->id }}" data-bs-toggle="modal" data-bs-target="#deletegoal" aria-label="Delete goal"><em class="icon ni ni-trash" aria-hidden="true"></em></button>
                                </div>
                                </div>
                                <a href="#logframe-program-goal-{{ $obj->id }}" class="accordion-head collapsed project-logframe__row-toggle" data-bs-toggle="collapse" data-bs-target="#logframe-program-goal-{{ $obj->id }}" aria-expanded="false" aria-controls="logframe-program-goal-{{ $obj->id }}">
                                    <h6 class="title"><span class="badge bg-success">GOAL</span><span class="project-logframe__row-title">{{ $obj->goal_code }} - {{ $obj->goal_name }}</span><span class="accordion-icon"></span></h6>
                                </a>
                                <div class="accordion-body collapse" id="logframe-program-goal-{{ $obj->id }}" data-bs-parent="#logframe-program-{{ $programshow->id }}-goal-{{ $obj->id }}">
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
                                            <button type="button" id="editindicator" data-id="{{ $goalindicator->id }}" data-bs-toggle="modal" data-bs-target="#editindicator" aria-label="Edit indicator"><em class="icon ni ni-edit" aria-hidden="true"></em></button>
                                            <button type="button" id="deleteindicator" data-id="{{ $goalindicator->id }}" data-bs-toggle="modal" data-bs-target="#deleteindicator" aria-label="Delete indicator"><em class="icon ni ni-trash" aria-hidden="true"></em></button>
                                        </div>
                                        </div>
                                        @endforeach

                                        @foreach($activitygoal->where('goal_id', $obj->id) as $goalactivity)
                                        <div class="project-logframe__data-row">
                                        <h6 class="project-logframe__activity-row"><span class="badge bg-danger">ACTIVITY</span><span class="project-logframe__entry-label">{{$goalactivity->activity_code}} -  {{$goalactivity->activity_title}}</span>
                                        </h6>
                                        <div class="project-logframe__row-options">
                                            <button type="button" id="editactivity" data-id="{{ $goalactivity->id }}" data-bs-toggle="modal" data-bs-target="#editactivity" aria-label="Edit activity"><em class="icon ni ni-edit" aria-hidden="true"></em></button>
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
                                                    <button type="button" class="btn btn-success icon ni ni-plus" id="addoutput" data-id="{{ $outcom->id }}" data-bs-toggle="modal" data-bs-target="#output_model"></em>Add Output</button>
                                                </li> 
                                                <li class="preview-item">
                                                    <button type="button" class="btn btn-success icon ni ni-plus" id="addoutcomeactivity" data-id="{{ $outcom->id }}" data-bs-toggle="modal" data-bs-target="#activity1"></em>Add Activity</button>
                                                </li>  
                                                <li class="preview-item">
                                                    <button type="button" class="btn btn-success icon ni ni-plus" id="addoutcomeindicator" data-id="{{ $outcom->id }}" data-bs-toggle="modal" data-bs-target="#indicator1"></em>Add Indicator</button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="project-logframe__row-options">
                                        <button type="button" id="editoutcome" data-id="{{ $outcom->id }}" data-bs-toggle="modal" data-bs-target="#editoutcome" aria-label="Edit outcome"><em class="icon ni ni-edit" aria-hidden="true"></em></button>
                                        <button type="button" id="deleteoutcome" data-id="{{ $outcom->id }}" data-bs-toggle="modal" data-bs-target="#deleteoutcome" aria-label="Delete outcome"><em class="icon ni ni-trash" aria-hidden="true"></em></button>
                                    </div>
                                </div>
                                    <a href="#logframe-program-outcome-{{ $outcom->id }}" class="accordion-head collapsed project-logframe__row-toggle" data-bs-toggle="collapse" data-bs-target="#logframe-program-outcome-{{ $outcom->id }}" aria-expanded="false" aria-controls="logframe-program-outcome-{{ $outcom->id }}">
                                        <h6><span class="badge bg-warning">OUTCOME</span><span class="project-logframe__row-title">{{ $outcom->outcome_code }} - {{ $outcom->outcome_title }}</span><span class="accordion-icon"></span></h6>
                                    </a>
                                    <div class="accordion-body collapse" id="logframe-program-outcome-{{ $outcom->id }}">
                                        <div class="accordion-inner">

                                            @foreach($indicators2->where('outcome_id', $outcom->id) as $outcomeindicator2)
                                            @if($outcomeindicator2->outcome_id == $outcom->id && $outcomeindicator2->program_id == $programshow->id) 
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
                                            @if($outcomeactivity->outcome_id == $outcom->id && $outcomeactivity->program_id == $programshow->id)  
                                            <div class="project-logframe__data-row">
                                            <h6 class="project-logframe__activity-row"><span class="badge bg-danger">ACTIVITY</span><span class="project-logframe__entry-label">{{$outcomeactivity->activity_code}} -  {{$outcomeactivity->activity_title}}</span>
                                            </h6>
                                            <div class="project-logframe__row-options">
                                                <button type="button" id="editoutcomeactivity" data-id="{{ $outcomeactivity->id }}" data-bs-toggle="modal" data-bs-target="#editoutcomeactivity" aria-label="Edit activity"><em class="icon ni ni-edit" aria-hidden="true"></em></button>
                                                <button type="button" id="deleteoutcomeactivity" data-id="{{ $outcomeactivity->id }}" data-bs-toggle="modal" data-bs-target="#deleteoutcomeactivity" aria-label="Delete activity"><em class="icon ni ni-trash" aria-hidden="true"></em></button>
                                            </div>
                                            </div>
                                            @endif
                                    @endforeach
                                    <!-- <hr> -->
                                    @foreach($outputs2->where('outcome_id', $outcom->id) as $output)
                                    @if($output->outcome_id == $outcom->id)
                                    <div class="accordion-item">
                                        <div class="project-logframe__row-actions">
                                        <div class="dropdown project-logframe__dropdown project-logframe__dropdown--add">
                                            <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" aria-label="Add to output" role="button" tabindex="0" data-bs-toggle="dropdown"><em class="icon ni ni-plus" aria-hidden="true"></em></a>
                                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                                <ul class="link-list-plain">
                                                    <li class="preview-item">
                                                        <button type="button" class="btn btn-success icon ni ni-plus" id="addoutputactivity1" data-id="{{ $output->id }}" data-bs-toggle="modal" data-bs-target="#activity2"></em>Add Activity</button>
                                                    </li> 
                                                    <li class="preview-item">
                                                        <button type="button" class="btn btn-success icon ni ni-plus" id="addoutputindicator" data-id="{{ $output->id }}" data-bs-toggle="modal" data-bs-target="#indicator2"></em>Add Indicator</button>
                                                    </li> 
                                                </ul>
                                            </div>
                                            </div>
                                            <div class="project-logframe__row-options">
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#edit" aria-label="Edit output"><em class="icon ni ni-edit" aria-hidden="true"></em></button>
                                                <button type="button" id="deleteoutput" data-id="{{ $output->id }}" data-bs-toggle="modal" data-bs-target="#deleteoutput" aria-label="Delete output"><em class="icon ni ni-trash" aria-hidden="true"></em></button>
                                            </div>
                                            </div>
                                        <a href="#logframe-program-output-{{ $output->id }}" class="accordion-head collapsed project-logframe__row-toggle" data-bs-toggle="collapse" data-bs-target="#logframe-program-output-{{ $output->id }}" aria-expanded="false" aria-controls="logframe-program-output-{{ $output->id }}">
                                            <h6><span class="badge bg-purple">OUTPUT</span><span class="project-logframe__row-title">{{ $output->output_code }} - {{ $output->output_name }}</span><span class="accordion-icon"></span></h6>
                                        </a>
                                        <div class="accordion-body collapse" id="logframe-program-output-{{ $output->id }}">
                                            <div class="accordion-inner">
                                                @foreach($outoutindicator2 as $outindicator2)
                                                @if($outindicator2->output_id == $output->id) 
                                                <div class="project-logframe__data-row">
                                                <h6 class="project-logframe__indicator-row">
                                                    <span class="project-logframe__indicator-name"><span class="badge bg-blue">INDICATOR</span><span>{{ $outindicator2->indicator_title }}</span></span>
                                                    <span data-label="Baseline">{{ $outindicator2->baseline_none !== null && $outindicator2->baseline_none !== '' ? $outindicator2->baseline_none : '—' }}</span>
                                                    <span data-label="Target">{{ $outindicator2->target_none !== null && $outindicator2->target_none !== '' ? $outindicator2->target_none : '—' }}</span>
                                                    <span data-label="Frequency">{{ $outindicator2->reporting_frequency ?: '—' }}</span>
                                                    <span data-label="Type">{{ $outindicator2->type ?: '—' }}</span>
                                                </h6>
                                                <div class="project-logframe__row-options">
                                                    <button type="button" id="editoutputindicator" data-id="{{ $outindicator2->id }}" data-bs-toggle="modal" data-bs-target="#editoutputindicator" aria-label="Edit indicator"><em class="icon ni ni-edit" aria-hidden="true"></em></button>
                                                    <button type="button" id="deleteoutputindicator" data-id="{{ $outindicator2->id }}" data-bs-toggle="modal" data-bs-target="#deleteoutputindicator" aria-label="Delete indicator"><em class="icon ni ni-trash" aria-hidden="true"></em></button>
                                                </div>
                                                </div>
                                                @endif
                                                @endforeach
                                                <hr>
                                                @foreach($outputactivity2 as $outputactv)
                                                @if($outputactv->output_id == $output->id)  
                                                <div class="project-logframe__data-row">
                                                <h6 class="project-logframe__activity-row"><span class="badge bg-danger">ACTIVITY</span><span class="project-logframe__entry-label">{{$outputactv->activity_code}} -  {{$outputactv->activity_title}}</span>
                                                </h6>
                                                <div class="project-logframe__row-options">
                                                    <button type="button" id="editoutcomeactivity" data-id="{{ $outputactv->id }}" data-bs-toggle="modal" data-bs-target="#editoutcomeactivity" aria-label="Edit activity"><em class="icon ni ni-edit" aria-hidden="true"></em></button>
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
                                        <p>Add a goal to start building this programme’s logframe.</p>
                                    </div>
                                    @if ($programshow->log_frame_id != '')
                                        <button type="button" class="admin-page__button-secondary" data-bs-toggle="modal" data-bs-target="#goalcreate">
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
    </div>

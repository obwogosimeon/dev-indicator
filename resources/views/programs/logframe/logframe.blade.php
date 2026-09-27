<div class="tab-pane" id="tabItem6">
    <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-4  subheader-solid " id="kt_subheader">
            <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex align-items-center flex-wrap mr-2">
                    <!--begin::Page Title-->
                    @if($logframes != null)
                    <h5 class="text-dark font-weight-bolder mt-2 mb-2 mr-2">
                        <span class="text-muted">Logframe design - </span> {{$programshow->logframe->logframe_name}}</h5>
                        @endif
                    </div>

                    <div class="d-flex align-items-center">
                        @if($programshow->log_frame_id == '')
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#logframecreate">Add Logframe</button>
                        @else
                        &nbsp&nbsp
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#goalcreate">Add Goal</button>
                        @endif
                    </div>
                </div>
            </div>

            <div class="nk-block nk-block-lg">
                <div class="card card-bordered card-preview">
                    <div class="card-inner">
                        @if($loopgoals != null)
                        @foreach($loopgoals as $obj)
                        <div id="accordion" class="accordion">
                            <div class="accordion-item">
                                <div class="dropdown">
                                    <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                        <ul class="link-list-plain">
                                            <li class="preview-item">
                                                <button type="button" class="btn btn-success icon ni ni-plus" id="editCompany" data-id="{{ $obj->id }}" data-bs-toggle="modal" data-bs-target="#practice_modal"></em>Add Outcome</button>
                                            </li> 
                                            <li class="preview-item">
                                                <button type="button" class="btn btn-success icon ni ni-plus" id="addactivity" data-id="{{ $obj->id }}" data-bs-toggle="modal" data-bs-target="#activity_modal"></em>Add Activity</button>
                                            </li> 
                                            <li class="preview-item">
                                                <button type="button" class="btn btn-success icon ni ni-plus" id="addindicator" data-id="{{ $obj->id }}" data-bs-toggle="modal" data-bs-target="#indicator_modal"></em>Add Indicator</button>
                                            </li> 
                                            <li class="preview-item">
                                                <button type="button" class="btn btn-success icon ni ni-edit" id="editgoal" data-id="{{ $obj->id }}" data-bs-toggle="modal" data-bs-target="#editgoal_modal"></em>Edit Goal</button>
                                            </li> 
                                            <li class="preview-item">
                                                <button type="button" class="btn btn-success icon ni ni-trash" id="deletegoal" data-id="{{ $obj->id }}" data-bs-toggle="modal" data-bs-target="#deletegoal"></em>Delete Goal</button>
                                            </li> 
                                        </ul>
                                    </div>
                                </div>
                                <a href="#" class="accordion-head collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-item-1">
                                    <h6 class="title"><span class="badge bg-success">GOAL</span> {{$obj->goal_code}} -  {{$obj->goal_name}}
                                    </h6>
                                    <span class="accordion-icon"></span>
                                </a>
                                <div class="accordion-body collapse" id="accordion-item-1" data-bs-parent="#accordion">
                                    <div class="accordion-inner">

                                        @foreach($goalindicator as $goalindicator) 
                                        <div class="dropdown">
                                            <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                                <ul class="link-list-plain">
                                                    <li class="preview-item">
                                                        <button type="button" class="btn btn-success icon ni ni-edit" id="editindicator" data-id="{{ $goalindicator->id }}" data-bs-toggle="modal" data-bs-target="#editindicator"></em>Edit Indicator</button>
                                                    </li> 
                                                    <li class="preview-item">
                                                        <button type="button" class="btn btn-success icon ni ni-trash" id="deleteindicator" data-id="{{ $goalindicator->id }}" data-bs-toggle="modal" data-bs-target="#deleteindicator"></em>Delete Indicator</button>
                                                    </li> 
                                                </ul>
                                            </div>
                                        </div> 
                                        <h6><span class="badge bg-blue">INDICATOR</span> {{$goalindicator->indicator_title}}
                                        </h6>
                                        <hr>
                                        @endforeach

                                        @foreach($activitygoal as $goalactivity) 
                                        <div class="dropdown">
                                            <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                                <ul class="link-list-plain">
                                                    <li class="preview-item">
                                                        <button type="button" class="btn btn-success icon ni ni-edit" id="editactivity" data-id="{{ $goalactivity->id }}" data-bs-toggle="modal" data-bs-target="#editactivity"></em>Edit Activity</button>
                                                    </li> 
                                                    <li class="preview-item">
                                                        <button type="button" class="btn btn-success icon ni ni-trash" id="deleteactivity" data-id="{{ $goalactivity->id }}" data-bs-toggle="modal" data-bs-target="#deleteactivity"></em>Delete Activity</button>
                                                    </li> 
                                                </ul>
                                            </div>
                                        </div> 
                                        <h6><span class="badge bg-danger">ACTIVITY</span> {{$goalactivity->activity_code}} -  {{$goalactivity->activity_title}}
                                        </h6>
                                        @endforeach
                                    </div> 
                                </div> 
                                <!-- <hr> -->
                                @foreach($goaloutcomes as $outcom)
                                <div class="accordion-item">
                                    <div class="dropdown">
                                        <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
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
                                                <li class="preview-item">
                                                    <button type="button" class="btn btn-success icon ni ni-edit" id="editoutcome" data-id="{{ $outcom->id }}" data-bs-toggle="modal" data-bs-target="#editoutcome"></em>Edit Outcome</button>
                                                </li> 
                                                <li class="preview-item">
                                                    <button type="button" class="btn btn-success icon ni ni-trash" id="deleteoutcome" data-id="{{ $outcom->id }}" data-bs-toggle="modal" data-bs-target="#deleteoutcome"></em>Delete Outcome</button>
                                                </li> 
                                            </ul>
                                        </div>
                                    </div>
                                    <a href="#" class="accordion-head collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-item-2">
                                        <h6><span class="badge bg-warning">OUTCOME</span> {{$outcom->outcome_code}} - {{$outcom->outcome_title}}
                                        </h6>
                                        <span class="accordion-icon"></span>
                                    </a>
                                    <div class="accordion-body collapse" id="accordion-item-2" data-bs-parent="#accordion">
                                        <div class="accordion-inner">

                                            @foreach($indicators2 as $outcomeindicator2)
                                            @if($outcomeindicator2->outcome_id == $outcom->id && $outcomeindicator2->program_id == $programshow->id) 
                                            <div class="dropdown">
                                                <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                                    <ul class="link-list-plain">
                                                        <li class="preview-item">
                                                            <button type="button" class="btn btn-success icon ni ni-edit" id="editoutcomeindicator" data-id="{{ $outcomeindicator2->id }}" data-bs-toggle="modal" data-bs-target="#editoutcomeindicator"></em>Edit Outcome Indicator</button>
                                                        </li> 
                                                        <li class="preview-item">
                                                            <button type="button" class="btn btn-success icon ni ni-trash" id="deleteoutcomeindicator" data-id="{{ $outcomeindicator2->id }}" data-bs-toggle="modal" data-bs-target="#deleteoutcomeindicator"></em>Delete Outcome Indicator</button>
                                                        </li> 
                                                    </ul>
                                                </div>
                                            </div>  
                                            <h6><span class="badge bg-blue">INDICATOR</span>  {{$outcomeindicator2->indicator_title}}
                                            </h6>
                                            @endif
                                            @endforeach

                                            <hr>
                                            @foreach($activity2 as $outcomeactivity)
                                            @if($outcomeactivity->outcome_id == $outcom->id && $outcomeactivity->program_id == $programshow->id)  
                                            <div class="dropdown">
                                                <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                                    <ul class="link-list-plain">
                                                        <li class="preview-item">
                                                            <button type="button" class="btn btn-success icon ni ni-edit" id="editoutcomeactivity" data-id="{{ $outcomeactivity->id }}" data-bs-toggle="modal" data-bs-target="#editoutcomeactivity"></em>Edit Outcome Activity</button>
                                                        </li> 
                                                        <li class="preview-item">
                                                            <button type="button" class="btn btn-success icon ni ni-trash" id="deleteoutcomeactivity" data-id="{{ $outcomeactivity->id }}" data-bs-toggle="modal" data-bs-target="#deleteoutcomeactivity"></em>Delete Outcome Activity</button>
                                                        </li> 
                                                    </ul>
                                                </div>
                                            </div> 
                                            <h6><span class="badge bg-danger">ACTIVITY</span> {{$outcomeactivity->activity_code}} -  {{$outcomeactivity->activity_title}}
                                            </h6>
                                            @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <!-- <hr> -->
                                    @foreach($outputs2 as $output)    
                                    @if($output->outcome_id == $outcom->id)
                                    <div class="accordion-item">
                                        <div class="dropdown">
                                            <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                                <ul class="link-list-plain">
                                                    <li class="preview-item">
                                                        <button type="button" class="btn btn-success icon ni ni-plus" id="addoutputactivity1" data-id="{{ $output->id }}" data-bs-toggle="modal" data-bs-target="#activity2"></em>Add Activity</button>
                                                    </li> 
                                                    <li class="preview-item">
                                                        <button type="button" class="btn btn-success icon ni ni-plus" id="addoutputindicator" data-id="{{ $output->id }}" data-bs-toggle="modal" data-bs-target="#indicator2"></em>Add Indicator</button>
                                                    </li> 
                                                    <li class="preview-item">
                                                        <button type="button" class="btn btn-success icon ni ni-edit" data-bs-toggle="modal" data-bs-target="#edit"></em>Edit Output</button>
                                                    </li> 
                                                    <li class="preview-item">
                                                        <button type="button" class="btn btn-success icon ni ni-trash" id="deleteoutput" data-id="{{ $output->id }}" data-bs-toggle="modal" data-bs-target="#deleteoutput"></em>Delete Output</button>
                                                    </li> 
                                                </ul>
                                            </div>
                                        </div> 
                                        <a href="#" class="accordion-head collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-item-3">
                                            <h6><span class="badge bg-purple">OUTPUT</span> {{$output->output_code}} - {{$output->output_name}}
                                            </h6>
                                            <span class="accordion-icon"></span>
                                        </a>
                                        <div class="accordion-body collapse" id="accordion-item-3" data-bs-parent="#accordion">
                                            <div class="accordion-inner">
                                                @foreach($outoutindicator2 as $outindicator2)
                                                @if($outindicator2->output_id == $output->id) 
                                                <div class="dropdown">
                                                    <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                                        <ul class="link-list-plain">
                                                            <li class="preview-item">
                                                                <button type="button" class="btn btn-success icon ni ni-edit" id="editoutputindicator" data-id="{{ $outindicator2->id }}" data-bs-toggle="modal" data-bs-target="#editoutputindicator"></em>Edit Output Indicator</button>
                                                            </li> 
                                                            <li class="preview-item">
                                                                <button type="button" class="btn btn-success icon ni ni-trash" id="deleteoutputindicator" data-id="{{ $outindicator2->id }}" data-bs-toggle="modal" data-bs-target="#deleteoutputindicator"></em>Delete Output Indicator</button>
                                                            </li> 
                                                        </ul>
                                                    </div>
                                                </div>  
                                                <h6><span class="badge bg-blue">INDICATOR</span>  {{$outindicator2->indicator_title}}
                                                </h6>
                                                @endif
                                                @endforeach
                                                <hr>
                                                @foreach($outputactivity2 as $outputactv)
                                                @if($outputactv->output_id == $output->id)  
                                                <div class="dropdown">
                                                    <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                                        <ul class="link-list-plain">
                                                            <li class="preview-item">
                                                                <button type="button" class="btn btn-success icon ni ni-edit" id="editoutcomeactivity" data-id="{{ $outputactv->id }}" data-bs-toggle="modal" data-bs-target="#editoutcomeactivity"></em>Edit Output Activity</button>
                                                            </li> 
                                                            <li class="preview-item">
                                                                <button type="button" class="btn btn-success icon ni ni-trash" id="deleteoutputactivity" data-id="{{ $outputactv->id }}" data-bs-toggle="modal" data-bs-target="#deleteoutputactivity"></em>Delete Output Activity</button>
                                                            </li> 
                                                        </ul>
                                                    </div>
                                                </div> 
                                                <h6><span class="badge bg-danger">ACTIVITY</span> {{$outputactv->activity_code}} -  {{$outputactv->activity_title}}
                                                </h6>
                                                @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>


                                @endforeach
                            </div>

                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

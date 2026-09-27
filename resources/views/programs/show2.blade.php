<div class="subheader py-2 py-lg-4  subheader-solid " id="kt_subheader">
                                    <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                                        <!--begin::Info-->
                                        <div class="d-flex align-items-center flex-wrap mr-2">
                                            <!--begin::Page Title-->
                                            <h5 class="text-dark font-weight-bolder mt-2 mb-2 mr-2">
                                                @if($logframes != null)
                                                <span class="text-muted">Logframe design - </span> {{$programshow->logframe->logframe_name}}</h5>
                                                @endif
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#logframecreate">LogFrame</button>
                                                &nbsp&nbsp
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#goalcreate">Goal</button>
                                                <a href="#" class="btn btn-clean  btn-sm font-weight-bold font-size-base mr-1">
                                                    Overview
                                                </a>
                                                <a href="#" class="btn btn-clean btn-sm font-weight-bold font-size-base  mr-1">
                                                    Activities
                                                </a>
                                                <a href="#" class="btn btn-clean btn-sm font-weight-bold font-size-base  mr-1">
                                                    Indicator
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-block nk-block-lg">
                                        @if($loopgoals != null)
                                        @foreach($loopgoals as $obj)
                                        <div class="card card-bordered card-preview">
                                            <div class="card-inner">
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
                                                                        <button type="button" class="btn btn-success icon ni ni-edit" data-bs-toggle="modal" data-bs-target="#edit"></em>Edit Goal</button>
                                                                    </li> 
                                                                    <li class="preview-item">
                                                                        <button type="button" class="btn btn-success icon ni ni-trash" data-bs-toggle="modal" data-bs-target="#delete"></em>Delete Goal</button>
                                                                    </li> 
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <a href="#" class="accordion-head collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-item-1-3">
                                                            <h6 class="title"><span class="badge bg-success">GOAL</span> {{$obj->goal_code}}   {{$obj->goal_name}}
                                                            </h6>
                                                            <span class="accordion-icon"></span> 
                                                        </a>
                                                        <div class="accordion-body collapse" id="accordion-item-1-3" data-bs-parent="#accordion-1">
                                                            <div class="accordion-inner">
                                                                <!----- Outcomes ---->
                                                                @foreach($outcomes2 as $outcom)    
                                                                @if($outcom->goal_id == $obj->id)
                                                                <div class="card-inner">
                                                                    <div id="accordion-1" class="accordion accordion-s2">
                                                                        <div class="accordion-item">
                                                                            <div class="dropdown">
                                                                                <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                                                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                                                                    <ul class="link-list-plain">
                                                                                        <li class="preview-item">
                                                                                            <button type="button" class="btn btn-success icon ni ni-plus" id="addoutput" data-id="{{ $outcom->id }}" data-bs-toggle="modal" data-bs-target="#output_model"></em>Add Output</button>
                                                                                        </li> 
                                                                                        <li class="preview-item">
                                                                                            <button type="button" class="btn btn-success icon ni ni-plus" data-bs-toggle="modal" data-bs-target="#activity1"></em>Add Activity</button>
                                                                                        </li> 
                                                                                        <li class="preview-item">
                                                                                            <button type="button" class="btn btn-success icon ni ni-plus" data-bs-toggle="modal" data-bs-target="#indicator1"></em>Add Indicator</button>
                                                                                        </li> 
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                            <a href="#" class="accordion-head collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-item-1-3">
                                                                                <h6 class="title"><span class="badge bg-warning">OUTCOME</span>

                                                                                    {{$outcom->outcome_code}} - {{$outcom->outcome_title}}

                                                                                </h6>
                                                                                <span class="accordion-icon"></span>
                                                                            </a>
                                                                            @foreach($activityoutcome as $outcomact)    
                                                       
                                                        <div class="card-inner">
                                                            <div id="accordion-1" class="accordion accordion-s2">
                                                                <div class="accordion-item">
                                                                    <a href="#" class="accordion-head collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-item-1-3">
                                                                        <h6 class="title"><span class="badge bg-info">OUTCOME ACTIVITY</span>

                                                                            {{$outcomact->activity_title}}

                                                                        </h6>
                                                                        <span class="accordion-icon"></span>
                                                                    </a>
                                        <!-- <div class="accordion-body collapse" id="accordion-item-1-3" data-bs-parent="#accordion-1">
                                            <div class="accordion-inner">


                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            
                            @endforeach 


                            @foreach($outcomeindicator as $outcomeindi)    
                                                       
                                                        <div class="card-inner">
                                                            <div id="accordion-1" class="accordion accordion-s2">
                                                                <div class="accordion-item">
                                                                    <a href="#" class="accordion-head collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-item-1-3">
                                                                        <h6 class="title"><span class="badge bg-warning">OUTCOME INDICATOR</span>

                                                                            {{$outcomeindi->indicator_title}}

                                                                        </h6>
                                                                        <span class="accordion-icon"></span>
                                                                    </a>
                                        <!-- <div class="accordion-body collapse" id="accordion-item-1-3" data-bs-parent="#accordion-1">
                                            <div class="accordion-inner">


                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            
                            @endforeach 

                                                                            <div class="accordion-body collapse" id="accordion-item-1-3" data-bs-parent="#accordion-1">
                                                                                <div class="accordion-inner">
                                                                                    @foreach($outputs2 as $output)    
                                                                                    @if($output->outcome_id == $outcom->id)
                                                                                    <div class="card-inner">
                                                                                        <div id="accordion-1" class="accordion accordion-s2">
                                                                                            <div class="accordion-item">
                                                                                             <div class="dropdown">
                                                                                                <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                                                                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                                                                                    <ul class="link-list-plain">
                                                                                                        <li class="preview-item">
                                                                                                            <button type="button" class="btn btn-success icon ni ni-plus" data-bs-toggle="modal" data-bs-target="#activity2"></em>Add Activity</button>
                                                                                                        </li> 
                                                                                                        <li class="preview-item">
                                                                                                            <button type="button" class="btn btn-success icon ni ni-plus" data-bs-toggle="modal" data-bs-target="#indicator2"></em>Add Indicator</button>
                                                                                                        </li> 
                                                                                                    </ul>
                                                                                                </div>
                                                                                            </div> 
                                                                                            <a href="#" class="accordion-head collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-item-1-3">
                                                                                                <h6 class="title"><span class="badge bg-blue">OUTPUT</span>

                                                                                                    {{$output->output_code}} - {{$output->output_name}}

                                                                                                </h6>
                                                                                                <span class="accordion-icon"></span>
                                                                                            </a>
                                                                                            @foreach($outputactivity as $outputact)    
                                                       
                                                        <div class="card-inner">
                                                            <div id="accordion-1" class="accordion accordion-s2">
                                                                <div class="accordion-item">
                                                                    <a href="#" class="accordion-head collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-item-1-3">
                                                                        <h6 class="title"><span class="badge bg-info">OUTPUT ACTIVITY</span>

                                                                            {{$outputact->activity_title}}

                                                                        </h6>
                                                                        <span class="accordion-icon"></span>
                                                                    </a>
                                       
                                    </div>
                                </div>
                            </div>
                            
                            @endforeach 


                            @foreach($outputindicator as $outputindi)    
                                                       
                                                        <div class="card-inner">
                                                            <div id="accordion-1" class="accordion accordion-s2">
                                                                <div class="accordion-item">
                                                                    <a href="#" class="accordion-head collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-item-1-3">
                                                                        <h6 class="title"><span class="badge bg-warning">OUTPUT INDICATOR</span>

                                                                            {{$outputindi->indicator_title}}

                                                                        </h6>
                                                                        <span class="accordion-icon"></span>
                                                                    </a>
                                        <!-- <div class="accordion-body collapse" id="accordion-item-1-3" data-bs-parent="#accordion-1">
                                            <div class="accordion-inner">


                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            
                            @endforeach 
                                                                                            
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            @endif
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> 

                                                        @foreach($goaladctiv as $goalActv)    
                                                        @if($goalActv->goal_id == $obj->id)
                                                        <div class="card-inner">
                                                            <div id="accordion-1" class="accordion accordion-s2">
                                                                <div class="accordion-item">
                                                                    <a href="#" class="accordion-head collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-item-1-3">
                                                                        <h6 class="title"><span class="badge bg-info">GOAL ACTIVITY</span>

                                                                            {{$goalActv->activity_title}}

                                                                        </h6>
                                                                        <span class="accordion-icon"></span>
                                                                    </a>
                                        <!-- <div class="accordion-body collapse" id="accordion-item-1-3" data-bs-parent="#accordion-1">
                                            <div class="accordion-inner">


                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach 
                            @foreach($goalindicators as $goalindicator)    
                            @if($goalindicator->goal_id == $obj->id)
                            <div class="card-inner">
                                <div id="accordion-1" class="accordion accordion-s2">
                                    <div class="accordion-item">
                                        <a href="#" class="accordion-head collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-item-1-3">
                                            <h6 class="title"><span class="badge bg-info">GOAL INDICATOR</span>

                                                {{$goalindicator->indicator_title}}

                                            </h6>
                                            <span class="accordion-icon"></span>
                                        </a>
                                        <!-- <div class="accordion-body collapse" id="accordion-item-1-3" data-bs-parent="#accordion-1">
                                            <div class="accordion-inner">


                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach  
                            @endif
                            @endforeach  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @endif
</div>                  
</div>
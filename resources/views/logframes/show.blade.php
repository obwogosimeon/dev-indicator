@extends('layouts.apps')
@section('content')


<div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4  subheader-solid " id="kt_subheader">
        <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bolder mt-2 mb-2 mr-2">
                    <span class="text-muted">Logframe design - </span> {{$logshow->logframe_name}}</h5>
                </div>

                <div class="d-flex align-items-center">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalZoom">Goal</button>
                </div>
            </div>
        </div>

        <div class="nk-block nk-block-lg">
            <div class="card card-bordered card-preview">
                <div class="card-inner">
                    @foreach($loopgoals as $obj)
                    <div id="accordion" class="accordion">
                        <div class="accordion-item">
                            

                            <a href="#" class="accordion-head collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-item-1">

                                <h6 class="title"><span class="badge bg-success">GOAL</span> {{$obj->goal_code}} -  {{$obj->goal_name}}
                                </h6>
                                <span class="accordion-icon"></span>



                            </a>

                            <div class="accordion-body collapse" id="accordion-item-1" data-bs-parent="#accordion">
                                <div class="accordion-inner">
                                    @foreach($goalindicator as $goalindicator) 
                                    <h6><span class="badge bg-blue">INDICATOR</span> {{$goalindicator->indicator_title}}
                                    </h6>
                                    <hr>
                                    @endforeach
                                    
                                    @foreach($goalactivities as $goalactivity)  
                                    <h6><span class="badge bg-danger">ACTIVITY</span> {{$goalactivity->activity_code}} -  {{$goalactivity->activity_title}}
                                    </h6>
                                    @endforeach
                                </div>  
                                <hr>
                                @foreach($outcomes2 as $outcom)    
                                @if($outcom->goal_id == $obj->id)
                                <div class="accordion-item">
                                    <a href="#" class="accordion-head collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-item-2">
                                        <h6><span class="badge bg-warning">OUTCOME</span> {{$outcom->outcome_code}} - {{$outcom->outcome_title}}
                                        </h6>
                                        <span class="accordion-icon"></span>
                                    </a>
                                    <div class="accordion-body collapse" id="accordion-item-2" data-bs-parent="#accordion">
                                        <div class="accordion-inner">
                                            @foreach($outcomeindicator as $outcomeindicator) 
                                            <h6><span class="badge bg-blue">INDICATOR</span> {{$outcomeindicator->indicator_title}}
                                            </h6>
                                            <hr>
                                            @endforeach

                                            @foreach($outcomeactivities as $outcomeactivity)  
                                            <h6><span class="badge bg-danger">ACTIVITY</span> {{$outcomeactivity->activity_code}} -  {{$outcomeactivity->activity_title}}
                                            </h6>
                                            @endforeach
                                        </div>
                                        <hr>
                                        @foreach($outputs2 as $output)    
                                        @if($output->outcome_id == $outcom->id)
                                        <div class="accordion-item">
                                            <a href="#" class="accordion-head collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-item-3">
                                                <h6><span class="badge bg-purple">OUTPUT</span> {{$output->output_code}} - {{$output->output_name}}
                                                </h6>
                                                <span class="accordion-icon"></span>
                                            </a>
                                            <div class="accordion-body collapse" id="accordion-item-3" data-bs-parent="#accordion">


                                                @foreach($outputactivities as $outputactivity)  
                                                <h6><span class="badge bg-danger">ACTIVITY</span> {{$outputactivity->activity_code}} -  {{$outputactivity->activity_title}}
                                                </h6>
                                                @endforeach
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
                    @endforeach
                </div>
            </div>
        </div>
    </div>


    @endsection
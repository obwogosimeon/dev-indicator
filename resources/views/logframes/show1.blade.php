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
                    <!-- <a href="https://tracker.ychira.com/project-view?id=1" class="btn btn-clean  btn-sm font-weight-bold font-size-base mr-1">
                        Overview
                    </a>
                    <a href="https://tracker.ychira.com/project-activities?id=1" class="btn btn-clean btn-sm font-weight-bold font-size-base  mr-1">
                        Activities
                    </a>
                    <a href="https://tracker.ychira.com/project-files?id=1" class="btn btn-clean btn-sm font-weight-bold font-size-base  mr-1">
                        Files
                    </a>
                    <span class="btn btn-clean btn-sm font-weight-bold text btn-success font-size-base  mr-1">
                        Logframe
                    </span>
                    <a href="https://tracker.ychira.com/project-data?id=1" class="btn btn-clean btn-sm font-weight-bold font-size-base  mr-1">
                        Indicator
                    </a> -->
                </div>
            </div>
        </div>
        <hr>

        <div class="nk-block nk-block-lg">
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
                                            <button type="button" class="btn btn-success icon ni ni-plus" id="addindicator" data-id="{{ $obj->id }}" data-bs-toggle="modal" data-bs-target="#indicator_modal"></em>Add Indocator</button>
                                        </li> 
                                        <!-- <li class="preview-item">
                                            <button type="button" class="btn btn-success icon ni ni-edit" data-bs-toggle="modal" data-bs-target="#edit"></em>Edit Goal</button>
                                        </li> 
                                        <li class="preview-item">
                                            <button type="button" class="btn btn-success icon ni ni-trash" data-bs-toggle="modal" data-bs-target="#delete"></em>Delete Goal</button>
                                        </li>  -->
                                    </ul>
                                </div>
                            </div>

                            <a href="#" class="accordion-head collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-item-1-3">
                                <h6 class="title"><span class="badge bg-success">GOAL</span> {{$obj->goal_code}} -  {{$obj->goal_name}}
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
                                            <hr>
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
                                                            <hr>
                                                            <div class="accordion-body collapse" id="accordion-item-1-3" data-bs-parent="#accordion-1">
                                                                <div class="accordion-inner">
                                                                    @foreach($activity2 as $activ)    
                                                                    @if($activ->output_id == $output->id)
                                                                    <div class="card-inner">
                                                                        <div id="accordion-1" class="accordion accordion-s2">
                                                                            <div class="accordion-item">
                                                                                <div class="dropdown">
                                                                                    <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                                                                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                                                                        <ul class="link-list-plain">

                                                                                            <li class="preview-item">
                                                                                                <button type="button" class="btn btn-success icon ni ni-plus" data-bs-toggle="modal" data-bs-target="#indicator"></em>Add Indicator</button>
                                                                                            </li> 
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                                <a href="#" class="accordion-head collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-item-1-3">
                                                                                    <h6 class="title"><span class="badge bg-purple">ACTIVITY</span>

                                                                                        {{$activ->activity_code}} - {{$activ->activity_title}}

                                                                                    </h6>
                                                                                    <span class="accordion-icon"></span>
                                                                                </a>
                                                                                <div class="accordion-body collapse" id="accordion-item-1-3" data-bs-parent="#accordion-1">
                                                                                    <div class="accordion-inner">

                                                                                        @foreach($indicators2 as $ind)    
                                                                                        @if($ind->activity_id == $activ->id)
                                                                                        <div class="card-inner">
                                                                                            <div id="accordion-1" class="accordion accordion-s2">
                                                                                                <div class="accordion-item">
                                                                                                    <a href="#" class="accordion-head collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-item-1-3">
                                                                                                        <h6 class="title"><span class="badge bg-warning">Indicator</span>

                                                                                                            {{$ind->indicator_title}}

                                                                                                        </h6>
                                                                                                        <span class="accordion-icon"></span>
                                                                                                    </a>
                                                                                                    <div class="accordion-body collapse" id="accordion-item-1-3" data-bs-parent="#accordion-1">
                                                                                                        <div class="accordion-inner">


                                                                                                        </div>
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
                                                                    @endif
                                                                    @endforeach 

                                                                </div>
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
                            <!---- End of Outcomes --> 
                        </div>
                    </div>
                </div>
            </div>   
        </div>
    </div>
    @endforeach
</div>
</div>


<!--- Outcome Activity -->
<div class="modal fade zoom" tabindex="-1" id="activity1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Outcome Activity</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('addoutcomeactivity')}}">
                    @csrf

                    <div class="row gy-4">
                        @if($outcomes != null)
                        <div class="form-group">
                            <label class="form-label" for="default-01">Outcome</label>
                            <div class="form-control-wrap">
                                <input type="text" name="activity_name" class="form-control" id="default-01" placeholder=""
                                value="{{$outcomes->outcome_code}} - {{$outcomes->outcome_title}}" readonly="">
                            </div>
                        </div>
                        @endif

                        <input type="hidden" name="created_by" class="form-control" value="{{Auth::user()->id}}" readonly="">
                        <input type="hidden" name="organization_id" class="form-control" value="{{Auth::user()->organization_id}}" readonly="">
                        <input type="hidden" name="log_frame_id" class="form-control" value="{{$logshow->id}}" readonly="">
                        @if($outcomes != null)
                        <input type="hidden" name="outcome_id" class="form-control" value="{{$outcomes->id}}" readonly="">
                        @endif
                        <input type="hidden" name="status" class="form-control" value="01" readonly="">

                        <div class="form-group">
                            <label class="form-label" for="default-01">Outcome Activity Title</label>
                            <div class="form-control-wrap">
                                <input type="text" name="activity_title" class="form-control" id="default-01" placeholder="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="default-01">Outcome Activity code</label>
                            <div class="form-control-wrap">
                                <input type="text" name="activity_code" class="form-control" id="default-01" placeholder="">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-label" for="default-textarea">Outcome Activity Description(Optional)</label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control no-resize" name="activity_description" id="default-textarea"></textarea>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Outcome Activity</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


<!-- Goal -->
<div class="modal fade zoom" tabindex="-1" id="modalZoom">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Goal</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('goals.store')}}">
                    @csrf

                    <div class="row gy-4">

                        <div class="form-group">
                            <label class="form-label" for="default-01">Goal Name</label>
                            <div class="form-control-wrap">
                                <input type="text" name="goal_name" class="form-control" id="default-01" placeholder="">
                            </div>
                        </div>

                        <input type="hidden" name="created_by" class="form-control" value="{{Auth::user()->id}}" >
                        <input type="hidden" name="organization_id" class="form-control" value="{{Auth::user()->organization_id}}" >
                        <input type="hidden" name="status" class="form-control" value="01">
                        <input type="hidden" name="log_frame_id" class="form-control" value="{{$logshow->id}}">

                        <div class="form-group">
                            <label class="form-label" for="default-01">Goal Code</label>
                            <div class="form-control-wrap">
                                <input type="text" name="goal_code" class="form-control" id="default-01" placeholder="">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-label" for="default-textarea">Goal Description <I>(Optional)</I></label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control no-resize" name="goal_description" id="default-textarea"></textarea>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Goal</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<!--- Output Activity --->

<div class="modal fade zoom" tabindex="-1" id="activity2">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Output Activity</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('addoutputactivity')}}">
                    @csrf

                    <div class="row gy-4">
                        @if($outputs != null)
                        <div class="form-group">
                            <label class="form-label" for="default-01">Ouput Activity</label>
                            <div class="form-control-wrap">
                                <input type="text" name="activity_name" class="form-control" id="default-01" placeholder=""
                                value="{{$outputs->output_code}} - {{$outputs->output_name}}" readonly="">
                            </div>
                        </div>
                        @endif

                        <input type="hidden" name="created_by" class="form-control" value="{{Auth::user()->id}}" readonly="">
                        <input type="hidden" name="organization_id" class="form-control" value="{{Auth::user()->organization_id}}" readonly="">
                        <input type="hidden" name="log_frame_id" class="form-control" value="{{$logshow->id}}" readonly="">
                        @if($outputs != null)
                        <input type="hidden" name="output_id" class="form-control" value="{{$output1->id}}" readonly="">
                        @endif
                        <input type="hidden" name="status" class="form-control" value="01" readonly="">

                        <div class="form-group">
                            <label class="form-label" for="default-01">Output Activity Title</label>
                            <div class="form-control-wrap">
                                <input type="text" name="activity_title" class="form-control" id="default-01" placeholder="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="default-01">Output Activity code</label>
                            <div class="form-control-wrap">
                                <input type="text" name="activity_code" class="form-control" id="default-01" placeholder="">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-label" for="default-textarea">Output Activity Description(Optional)</label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control no-resize" name="activity_description" id="default-textarea"></textarea>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Output Activity</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


<!---- Output Indicator -->

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
                <h5 class="modal-title">Add Output Indicator</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('addoutputindicator')}}">
                    @csrf
                    <div class="row gy-4">
                        @if($outputs != null)
                        <div class="form-group">
                            <label class="form-label" for="default-01">Output</label>
                            <div class="form-control-wrap">
                                <input type="text" name="goal_name" class="form-control" id="default-01" placeholder=""
                                value="{{$output1->output_code}} - {{$output1->output_name}}" readonly="">
                            </div>
                        </div>
                        @endif

                        <input type="hidden" name="created_by" class="form-control" value="{{Auth::user()->id}}" readonly="">
                        <input type="hidden" name="organization_id" class="form-control" value="{{Auth::user()->organization_id}}" readonly="">
                        <input type="hidden" name="log_frame_id" class="form-control" value="{{$logshow->id}}" readonly="">
                        @if($outputs != null)
                        <input type="hidden" name="output_id" class="form-control" value="{{$output1->id}}" readonly="">
                        @endif
                        <input type="hidden" name="status" class="form-control" value="01" readonly="">


                        <div class="form-group">
                            <label class="form-label" for="default-01">Indicator Title</label>
                            <div class="form-control-wrap">
                                <input type="text" name="indicator_title" class="form-control" id="default-01" placeholder="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="default-06">Reporting Frequency</label>
                            <div class="form-control-wrap ">
                                <div class="form-control-select">
                                    <select class="form-control" name="reporting_frequency" id="default-06">
                                        <option value="#">-------Select Reporting Frequency-------</option>
                                        <option></option>
                                        <option value="Monthly">Monthly</option>
                                        <option value="Bi-Monthly">Bi-Monthly</option>
                                        <option value="Quaterly">Quaterly</option>
                                        <option value="Semi-Annual">Semi-Annual</option>
                                        <option value="Annual">Annual</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="default-06">Type</label>
                            <div class="form-control-wrap ">
                                <div class="form-control-select">
                                    <select class="form-control" name="type" id="type">
                                        <option value="#">-------Select Type-------</option>
                                        <option></option>
                                        <option value="Quantitative">Quantitative</option>
                                        <option value="Qualitative">Qualitative</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="default-06">Disaggregation</label>
                            <div class="form-control-wrap ">
                                <div class="form-control-select">
                                    <select class="form-control" name="disaggregation" id="disaggregation2">
                                        <option value="#">-------Select Disaggregation-------</option>
                                        <option></option>
                                        <option value="none">None</option>
                                        <option value="Disaggregation2">Disaggregation</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        
                        <div class="col-lg-4 col-sm-6">
                            <div class="form-group" id="output11">
                                <label class="form-label" for="default-01">Label</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="label_none" class="form-control" id="default-01" placeholder="Input Label">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6">
                            <div class="form-group" id="output21">
                                <label class="form-label" for="default-01">Baseline</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="baseline_none" class="form-control" id="default-01" placeholder="Input Baselime">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6">
                            <div class="form-group" id="output31">
                                <label class="form-label" for="default-01">Target</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="target_none" class="form-control" id="default-01" placeholder="Input Target">
                                </div>
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane" id="Disaggregation2">

                            <!-- <h4 align="center"><strong>Disaggregation</strong></h4> -->
                            <div id='ncontainer'>

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



              <div class="col-sm-12">
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
</div>
</div>
</div>
</div>



<!--- Outcome Indicator --> 
<script>
    $(document).ready(function(){
        $('#default01').hide();
        $('#default02').hide();
        $('#default03').hide();
        $('#baseline1').hide();
        $('#target1').hide();
        $('#Disaggregation1').hide();

        $('#disaggregation1').change(function(){
          if($(this).val() == 'none'){
            $('#default01').show();
            $('#default02').show();
            $('#default03').show();
            $('#Disaggregation1').hide();
        }else if($(this).val() == 'Disaggregation1'){
            $('#Disaggregation1').show();
            $('#default01').hide();
            $('#default02').hide();
            $('#default03').hide();
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
                <h5 class="modal-title">Add Outcome Indicator</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('addoutcomeindicator')}}">
                    @csrf
                    <div class="row gy-4">
                        @if($outcomes != null)
                        <div class="form-group">
                            <label class="form-label" for="default-01">Output</label>
                            <div class="form-control-wrap">
                                <input type="text" name="goal_name" class="form-control" id="default-01" placeholder=""
                                value="{{$outcomes->outcome_code}} - {{$outcomes->outcome_title}}" readonly="">
                            </div>
                        </div>
                        @endif

                        <input type="hidden" name="created_by" class="form-control" value="{{Auth::user()->id}}" readonly="">
                        <input type="hidden" name="organization_id" class="form-control" value="{{Auth::user()->organization_id}}" readonly="">
                        <input type="hidden" name="log_frame_id" class="form-control" value="{{$logshow->id}}" readonly="">
                        @if($outcomes != null)
                        <input type="hidden" name="outcome_id" class="form-control" value="{{$outcomes->id}}" readonly="">
                        @endif
                        <input type="hidden" name="status" class="form-control" value="01" readonly="">


                        <div class="form-group">
                            <label class="form-label" for="default-01">Indicator Title</label>
                            <div class="form-control-wrap">
                                <input type="text" name="indicator_title" class="form-control" id="default-01" placeholder="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="default-06">Reporting Frequency</label>
                            <div class="form-control-wrap ">
                                <div class="form-control-select">
                                    <select class="form-control" name="reporting_frequency" id="default-06">
                                        <option value="#">-------Select Reporting Frequency-------</option>
                                        <option></option>
                                        <option value="Monthly">Monthly</option>
                                        <option value="Bi-Monthly">Bi-Monthly</option>
                                        <option value="Quaterly">Quaterly</option>
                                        <option value="Semi-Annual">Semi-Annual</option>
                                        <option value="Annual">Annual</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="default-06">Type</label>
                            <div class="form-control-wrap ">
                                <div class="form-control-select">
                                    <select class="form-control" name="type" id="type">
                                        <option value="#">-------Select Type-------</option>
                                        <option></option>
                                        <option value="Quantitative">Quantitative</option>
                                        <option value="Qualitative">Qualitative</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="default-06">Disaggregation</label>
                            <div class="form-control-wrap ">
                                <div class="form-control-select">
                                    <select class="form-control" name="disaggregation" id="disaggregation1">
                                        <option value="#">-------Select Disaggregation-------</option>
                                        <option></option>
                                        <option value="none">None</option>
                                        <option value="Disaggregation1">Disaggregation</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        
                        <div class="col-lg-4 col-sm-6">
                            <div class="form-group" id="default01">
                                <label class="form-label" for="default-01">Label</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="label_none" class="form-control" id="default01" placeholder="Input Label">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6">
                            <div class="form-group" id="default02">
                                <label class="form-label" for="default-01">Baseline</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="baseline_none" class="form-control" id="default02" placeholder="Input Baselime">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6">
                            <div class="form-group" id="default03">
                                <label class="form-label" for="default-01">Target</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="target_none" class="form-control" id="default03" placeholder="Input Target">
                                </div>
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane" id="Disaggregation1">

                            <!-- <h4 align="center"><strong>Disaggregation</strong></h4> -->
                            <div id='ncontainer'>

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


              <div class="col-sm-12">
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
</div>
</div>
</div>
</div>


<!--- Outcome Output -->

<div class="modal fade zoom" tabindex="-1" id="output_model">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Outcome Output</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('outputs.store')}}">
                    @csrf

                    <div class="row gy-4">
                        @if($outcomes != null)
                        <div class="form-group">
                            <label class="form-label" for="default-01">Output Title</label>
                            <div class="form-control-wrap">
                                <input type="text" name="output_title" class="form-control" id="default-01" placeholder=""
                                value="{{$outcomes->outcome_code}} - {{$outcomes->outcome_title}}" readonly="">
                            </div>
                        </div>
                        @endif

                        <input type="hidden" name="created_by" class="form-control" value="{{Auth::user()->id}}" readonly="">
                        <input type="hidden" name="organization_id" class="form-control" value="{{Auth::user()->organization_id}}" readonly="">
                        <input type="hidden" name="log_frame_id" class="form-control" value="{{$logshow->id}}" readonly="">
                        @if($outcomes != null)
                        <input type="hidden" name="outcome_id" class="form-control" value="{{$outcomes->id}}" readonly="">
                        @endif
                        <input type="hidden" name="status" class="form-control" value="01" readonly="">

                        <div class="form-group">
                            <label class="form-label" for="default-01">Output Name</label>
                            <div class="form-control-wrap">
                                <input type="text" name="output_name" class="form-control" id="default-01" placeholder="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="default-01">Output code</label>
                            <div class="form-control-wrap">
                                <input type="text" name="output_code" class="form-control" id="default-01" placeholder="">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-label" for="default-textarea">Output Description(Optional)</label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control no-resize" name="output_description" id="default-textarea"></textarea>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Outcome Output</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>



<!--Goal Activity -->

<div class="modal fade zoom" tabindex="-1" id="activity">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Goal Activity</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('activities.store')}}">
                    @csrf

                    <div class="row gy-4">

                        <input type="hidden" name="created_by" class="form-control" value="{{Auth::user()->id}}" readonly="">
                        <input type="hidden" name="organization_id" class="form-control" value="{{Auth::user()->organization_id}}" readonly="">
                        <input type="hidden" name="log_frame_id" class="form-control" value="{{$logshow->id}}" readonly="">
                        @if($goals != null)
                        <input type="hidden" name="goal_id" class="form-control" value="{{$goals->id}}" readonly="">
                        @endif
                        <input type="hidden" name="status" class="form-control" value="01" readonly="">
                        @if($goals != null)
                        <div class="form-group">
                            <label class="form-label" for="default-01">Goal</label>
                            <div class="form-control-wrap">
                                <input type="text" name="activity_name" class="form-control" id="default-01" placeholder=""
                                value="{{$goals->goal_code}} - {{$goals->goal_name}}" readonly="">
                            </div>
                        </div>
                        @endif
                        <div class="form-group">
                            <label class="form-label" for="default-01">Activity Title</label>
                            <div class="form-control-wrap">
                                <input type="text" name="activity_title" class="form-control" id="default-01" placeholder="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="default-01">Activity code</label>
                            <div class="form-control-wrap">
                                <input type="text" name="activity_code" class="form-control" id="default-01" placeholder="">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-label" for="default-textarea">Activity Description(Optional)</label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control no-resize" name="activity_description" id="default-textarea"></textarea>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Activity</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


<!--Goal Outcome -->
<div class="modal fade zoom" tabindex="-1" id="practice_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Goal Outcome</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('outcomes.store')}}" id="edit-form">
                    @csrf
                    <div class="row gy-4">

                        <div class="form-group">
                            <label class="form-label" for="default-01">Goal Name</label>
                            <div class="form-control-wrap">
                                <input type="text" name="outcome_goal" class="form-control" id="outcome_goal" placeholder=""
                                >
                            </div>
                        </div>

                        <input type="hidden" name="created_by" class="form-control" value="{{Auth::user()->id}}" readonly="">
                        <input type="hidden" name="organization_id" class="form-control" value="{{Auth::user()->organization_id}}" readonly="">
                        <input type="hidden" name="log_frame_id" class="form-control" value="{{$logshow->id}}" readonly="">

                        <input type="hidden" name="goal_id" id="goal_id" class="form-control" value="" readonly="">

                        <input type="hidden" name="status" class="form-control" value="01" readonly="">


                        <div class="form-group">
                            <label class="form-label" for="default-01">OutCome Title</label>
                            <div class="form-control-wrap">
                                <input type="text" name="outcome_title" class="form-control" id="default-01" placeholder="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="default-01">OutCome code</label>
                            <div class="form-control-wrap">
                                <input type="text" name="outcome_code" class="form-control" id="default-01" placeholder="">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-label" for="default-textarea">Outcome Description(Optional)</label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control no-resize" name="outcome_description" id="default-textarea"></textarea>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Goal Outcome</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add Goal Activity -->

<div class="modal fade zoom" tabindex="-1" id="activity_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Goal Activity</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('activities.store')}}">
                    @csrf

                    <div class="row gy-4">

                        <input type="hidden" name="created_by" class="form-control" value="{{Auth::user()->id}}" readonly="">
                        <input type="hidden" name="organization_id" class="form-control" value="{{Auth::user()->organization_id}}" readonly="">
                        <input type="hidden" name="log_frame_id" class="form-control" value="{{$logshow->id}}" readonly="">
                 
                        <input type="hidden" name="goal_id" id="goal" class="form-control" value="" readonly="">
                    
                        <input type="hidden" name="status" class="form-control" value="01" readonly="">
                    
                        <div class="form-group">
                            <label class="form-label" for="default-01">Goal</label>
                            <div class="form-control-wrap">
                                <input type="text" name="activity_name" id="activity_name" class="form-control" id="default-01" placeholder=""
                                value="" readonly="">
                            </div>
                        </div>
               
                        <div class="form-group">
                            <label class="form-label" for="default-01">Activity Title</label>
                            <div class="form-control-wrap">
                                <input type="text" name="activity_title" class="form-control" id="default-01" placeholder="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="default-01">Activity code</label>
                            <div class="form-control-wrap">
                                <input type="text" name="activity_code" class="form-control" id="default-01" placeholder="">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-label" for="default-textarea">Activity Description(Optional)</label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control no-resize" name="activity_description" id="default-textarea"></textarea>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Goal Activity</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


<!---- Goal Indicator -->
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
                <h5 class="modal-title">Add Goal Indicator</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('addgoalindicator')}}">
                    @csrf
                    <div class="row gy-4">
                        
                        <div class="form-group">
                            <label class="form-label" for="default-01">Goal</label>
                            <div class="form-control-wrap">
                                <input type="text" name="goal_name" id="goal_indicator" class="form-control" id="default-01" placeholder=""
                                value="" readonly="">
                            </div>
                        </div>
                        

                        <input type="hidden" name="created_by" class="form-control" value="{{Auth::user()->id}}" readonly="">
                        <input type="hidden" name="organization_id" class="form-control" value="{{Auth::user()->organization_id}}" readonly="">
                        <input type="hidden" name="log_frame_id" class="form-control" value="{{$logshow->id}}" readonly="">
                        
                        <input type="hidden" name="goal_id" id="indicator" class="form-control" value="" readonly="">
                        
                        <input type="hidden" name="status" class="form-control" value="01" readonly="">


                        <div class="form-group">
                            <label class="form-label" for="default-01">Indicator Title</label>
                            <div class="form-control-wrap">
                                <input type="text" name="indicator_title" class="form-control" id="default-01" placeholder="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="default-06">Reporting Frequency</label>
                            <div class="form-control-wrap ">
                                <div class="form-control-select">
                                    <select class="form-control" name="reporting_frequency" id="default-06">
                                        <option value="#">-------Select Reporting Frequency-------</option>
                                        <option></option>
                                        <option value="Monthly">Monthly</option>
                                        <option value="Bi-Monthly">Bi-Monthly</option>
                                        <option value="Quaterly">Quaterly</option>
                                        <option value="Semi-Annual">Semi-Annual</option>
                                        <option value="Annual">Annual</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="default-06">Type</label>
                            <div class="form-control-wrap ">
                                <div class="form-control-select">
                                    <select class="form-control" name="type" id="type">
                                        <option value="#">-------Select Type-------</option>
                                        <option></option>
                                        <option value="Quantitative">Quantitative</option>
                                        <option value="Qualitative">Qualitative</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="default-06">Disaggregation</label>
                            <div class="form-control-wrap ">
                                <div class="form-control-select">
                                    <select class="form-control" name="disaggregation" id="disaggregation">
                                        <option value="#">-------Select Disaggregation-------</option>
                                        <option></option>
                                        <option value="none">None</option>
                                        <option value="Disaggregation">Disaggregation</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        
                        <div class="col-lg-4 col-sm-6">
                            <div class="form-group" id="label">
                                <label class="form-label" for="default-01">Label</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="label_none" class="form-control" id="default-01" placeholder="Input Label">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6">
                            <div class="form-group" id="baseline">
                                <label class="form-label" for="default-01">Baseline</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="baseline_none" class="form-control" id="default-01" placeholder="Input Baselime">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6">
                            <div class="form-group" id="target">
                                <label class="form-label" for="default-01">Target</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="target_none" class="form-control" id="default-01" placeholder="Input Target">
                                </div>
                            </div>
                        </div>


                        <div role="tabpanel" class="tab-pane" id="Disaggregation">

                            <!-- <h4 align="center"><strong>Disaggregation</strong></h4> -->
                            <div id='ncontainer'>

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

                          <button type="button" class='ndelete'>- Delete</button>
                          <button type="button" class='naddmore'>+ Add More</button>
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

              <div class="col-sm-12">
                <div class="form-group">
                    <label class="form-label" for="default-textarea">Indicator Description(Optional)</label>
                    <div class="form-control-wrap">
                        <textarea class="form-control no-resize" name="indicator_description" id="default-textarea"></textarea>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Add Indicator</button>
        </div>

    </form>
</div>
</div>
</div>
</div>


<script>
// Add Goal Outcome
$(document).ready(function () {
$('body').on('click', '#editCompany', function (event) {
    event.preventDefault();
    var url = "{{ route('goals.index')}}";
    var id = $(this).data('id');

    $.get(url + '/' + id + '/edit', function (data) {
        // console.log(data);
         $('#userCrudModal').html("Edit category");
         $('#submit').val("Edit category");
         $('#practice_modal').modal('show');
         $('#goal_id').val(data.id);
         $('#outcome_goal').val(data.goal_code + '-' + data.goal_name);
     })
});
}); 
</script>


<script>
// Add Goal Activity
$(document).ready(function () {
$('body').on('click', '#addactivity', function (event) {
    event.preventDefault();
    var url = "{{ route('goals.index')}}";
    var id = $(this).data('id');
    $.get(url + '/' + id + '/activity', function (data) {
        // console.log(id);
         $('#userCrudModal').html("Activty category");
         $('#submit').val("Activty category");
         $('#activity_modal').modal('show');
         $('#goal').val(data.id);
         $('#activity_name').val(data.goal_code + '-' + data.goal_name)
     })
});
}); 
</script>


<script>
// Add Goal Indicator
$(document).ready(function () {
$('body').on('click', '#addindicator', function (event) {
    event.preventDefault();
    var url = "{{ route('goals.index')}}";
    var id = $(this).data('id');
    $.get(url + '/' + id + '/activity', function (data) {
        // console.log(id);
         $('#userCrudModal').html("Activty category");
         $('#submit').val("Activty category");
         $('#indicator_modal').modal('show');
         $('#indicator').val(data.id);
         $('#goal_indicator').val(data.goal_code + '-' + data.goal_name)
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
         $('#userCrudModal').html("Indicator category");
         $('#submit').val("Indicator category");
         $('#output_model').modal('show');
         $('#indicator').val(data.id);
         $('#goal_indicator').val(data.goal_code + '-' + data.goal_name)
     })
});
}); 
</script>


@endsection



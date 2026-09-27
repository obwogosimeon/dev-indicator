@extends('layouts.apps')
@section('content')


<script type="text/javascript">
    $(document).ready(function() {
        $('#programid').change(function(){
            $.get("{{ url('api/exchangeperiod')}}",
                { option: $(this).val() },
                function(data) {
                    console.log(data);
                    $('#exchange').val(data);
                });
        });
    });
</script>


<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <nav>
                <ul class="breadcrumb breadcrumb-pipe">
                    <li class="breadcrumb-item"><a href="{{ url('/home')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('projects.index')}}">Projects</a></li>
                    <li class="breadcrumb-item active">Add Project</li>
                </ul>
            </nav>
            <br>

            @if ( count( $errors ) > 0 )
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                {{ $error }}<br>
                @endforeach
            </div>
            @endif

        </div><!-- .nk-block-head -->
        <div class="nk-block nk-block-lg">
            <div class="card card-bordered card-preview">
                <div class="card-inner">
                    <div class="preview-block">
                        <span class="preview-title-lg overline-title">Create Project</span>
                        <form method="POST" action="{{ route('projects.store')}}">
                            @csrf
                            <div class="row gy-4">

                                <div class="form-group">
                                    <label class="form-label" for="default-01">Project Name</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" name="project_name" id="default-01" placeholder="Input Project Name">
                                    </div>
                                </div>

                                <input type="hidden" name="organization_id" class="form-control" id="default-01" readonly="" value="{{ Auth::user()->organization_id }}">

                                <input type="hidden" name="created_by" class="form-control" id="default-01" readonly="" value="{{ Auth::user()->id }}"> 

                                <input type="hidden" name="status" class="form-control" id="default-01" readonly="" value="01">

                                
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Start Date<span style="color:red">*</span></label>
                                        <div class="form-control-wrap">
                                            <input type="date" name="start_date" class="form-control" id="start_date" placeholder="Input Programme Name">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label" for="default-01">End Date<span style="color:red">*</span></label>
                                        <div class="form-control-wrap">
                                            <input type="date" name="end_date" class="form-control" id="end_date" placeholder="Input Programme Name">
                                        </div>
                                    </div>

                                <!-- <div class="col-lg-4 col-sm-6">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <div class="form-icon form-icon-right">
                                                <em class="icon ni ni-calendar-alt"></em>
                                            </div>
                                            <input type="text" name="start_date" class="form-control form-control-xl form-control-outlined date-picker" id="outlined-date-picker">
                                            <label class="form-label-outlined" for="outlined-date-picker">Start Date</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <div class="form-icon form-icon-right">
                                                <em class="icon ni ni-calendar-alt"></em>
                                            </div>
                                            <input type="text" name="end_date" class="form-control form-control-xl form-control-outlined date-picker" id="outlined-date-picker">
                                            <label class="form-label-outlined" for="outlined-date-picker">End Date</label>
                                        </div>
                                    </div>
                                </div> -->

                                <div class="form-group"> 
                                    <label class="form-label" for="default-06">Reporting Frequency</label>
                                    <div class="form-control-wrap ">
                                        <div class="form-control-select">
                                            <select class="form-control" name="reporting_frequency" id="reporting_frequency">
                                                <option value="null">-------Select Frequency-------</option>
                                                <option value="null"></option>
                                                <option value="Monthly">Monthly</option>
                                                <option value="BiMonthly">Bi-Monthly</option>
                                                <option value="Quaterly">Quaterly</option>
                                                <option value="SemiAnnual">Semi-Annual</option>
                                                <option value="Annaul">Annaul</option>
                                            </select> 
                                        </div>
                                    </div>
                                </div>

                                <script>
                                   $(document).ready(function(){
                                    $('#program').hide();
                                    $('#LogFrame').hide();

                                    $('#choose').change(function(){
                                      if($(this).val() == 'programmeshow'){
                                        $('#program').show();
                                        $('#LogFrame').hide();
                                    }else if($(this).val() == 'logframeshow'){
                                        $('#LogFrame').show();
                                        $('#program').hide();
                                    }
                                    else{
                                     $('#LogFrame').hide('');
                                     $('#program').hide('');
                                 }
                             });
                                });
                            </script>

                            <div class="form-group">
                                <label class="form-label" for="default-06">Choose Programme/Log Frame</label>
                                <div class="form-control-wrap ">
                                    <div class="form-control-select">
                                        <select class="form-control" name="program_id" id="choose">
                                            <option value="null">-------Select Programme-------</option>
                                            <option value="null"></option>
                                            <option value="programmeshow">Programme</option>
                                            <!-- <option value="logframeshow">Log Frame</option> -->
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" id="program">
                                <label class="form-label" for="default-06">Programme</label>
                                <div class="form-control-wrap ">
                                    <div class="form-control-select">
                                        <select class="form-control" id="programid" name="program_id" >
                                            <option value="#">-------Select Programme-------</option>
                                            <option></option>                                                   
                                            @foreach($programs as $object)
                                            <option value="{{$object->id}}">{{$object->program_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>


<!-- 
                            <div class="form-group">
                                <label class="form-label" for="default-01">Exchange Period</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" value="" id="exchange" name="exchange_period" id="default-01" readonly>
                                </div>
                            </div> -->

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="form-label" for="default-textarea">Project Description</label>
                                    <div class="form-control-wrap">
                                        <textarea class="form-control no-resize" name="description" id="default-textarea"></textarea>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <br>
                        <button style="margin-left: 40%;" type="submit" class="btn btn-round btn-primary"><em class="icon ni ni-navigate-fill"></em>&nbsp Add New Project</button>
                    </form>


                </div>
            </div>
        </div>

    </div>
</div>
</div>



@endsection
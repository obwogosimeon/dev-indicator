@extends('layouts.apps')
@section('content')


<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
                    <nav>
                        <ul class="breadcrumb breadcrumb-pipe">
                            <li class="breadcrumb-item"><a href="{{ url('/home')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('programs.index')}}">Programs</a></li>
                            <li class="breadcrumb-item active">Edit Program</li>
                        </ul>
                    </nav>
                    <div class="nk-block nk-block-lg">

                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <div class="preview-block">
                                    <span class="preview-title-lg overline-title">Edit Programme</span>

                                    {!! Form::model($programedit, ['method' => 'PATCH','route' => ['programs.update', $programedit->id]]) !!}
                                    @csrf
                                    <div class="row gy-4">

                                        <div class="form-group">
                                            <label class="form-label" for="default-01">Programme Name</label>
                                            <div class="form-control-wrap">
                                                <input type="text" name="program_name" class="form-control" id="default-01" value="{{$programedit->program_name}}">
                                            </div>
                                        </div>

                                        <input type="hidden" name="organization_id" class="form-control" id="default-01" readonly="" value="{{ Auth::user()->organization_id }}">

                                        <input type="hidden" name="created_by" class="form-control" id="default-01" readonly="" value="{{ Auth::user()->id }}"> 

                                        <input type="hidden" name="status" class="form-control" id="default-01" readonly="" value="01">


                                        <div class="col-lg-4 col-sm-6">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <div class="form-icon form-icon-right">
                                                        <em class="icon ni ni-calendar-alt"></em>
                                                    </div>
                                                    <input type="text" name="start_date" value="{{$programedit->start_date}}" class="form-control form-control-xl form-control-outlined date-picker" id="outlined-date-picker">
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
                                                    <input type="text" value="{{$programedit->end_date}}" name="end_date" class="form-control form-control-xl form-control-outlined date-picker" id="outlined-date-picker">
                                                    <label class="form-label-outlined" for="outlined-date-picker">End Date</label>
                                                </div>
                                            </div>
                                        </div>

                                        

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label" for="default-textarea">Programme Description (Optional)</label>
                                                <div class="form-control-wrap">
                                                    <textarea class="form-control no-resize" name="description" id="default-textarea"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        


                                    </div>
                                    <br>
                                    <button style="margin-left: 40%;" type="submit" class="btn btn-round btn-primary"><em class="icon ni ni-reload"></em>&nbsp Update Program</button>
                                    {!! Form::close() !!}


                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>



@endsection
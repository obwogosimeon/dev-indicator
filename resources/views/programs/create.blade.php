@extends('layouts.apps')
@section('content')

<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <nav>
                <ul class="breadcrumb breadcrumb-pipe">
                    <li class="breadcrumb-item"><a href="{{ url('/home')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('programs.index')}}">Programs</a></li>
                    <li class="breadcrumb-item active">Add Program</li>
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
            <div class="nk-block nk-block-lg">

                <div class="card card-bordered card-preview">
                    <div class="card-inner">
                        <div class="preview-block">
                            <span class="preview-title-lg overline-title">Create Programme</span>
                            <i><h6>All fields marks with <span style="color:red">*</span> are mandatory</h6></i>

                            <form method="POST" action="{{ route('programs.store')}}" id="createProgram">
                                @csrf
                                <div class="row gy-4">

                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Programme Name<span style="color:red">*</span></label>
                                        <div class="form-control-wrap">
                                            <input type="text" name="program_name" class="form-control" id="program_name" placeholder="Input Programme Name">
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
<!-- 

                                    <div class="col-lg-4 col-sm-6">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <div class="form-icon form-icon-right">
                                                    <em class="icon ni ni-calendar-alt"></em>
                                                </div>
                                                <input type="text" name="start_date" class="form-control form-control-xl form-control-outlined date-picker" id="start_date">
                                                <label class="form-label-outlined" for="outlined-date-picker">Start Date<span style="color:red">*</span></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-sm-6">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <div class="form-icon form-icon-right">
                                                    <em class="icon ni ni-calendar-alt"></em>
                                                </div>
                                                <input type="text" name="end_date" class="form-control form-control-xl form-control-outlined date-picker" id="end_date">
                                                <label class="form-label-outlined" for="outlined-date-picker">End Date<span style="color:red">*</span></label>
                                            </div>
                                        </div>
                                    </div> -->


                                    <div class="form-group">
                                        <label class="form-label" for="default-06">Select Base Currency<span style="color:red">*</span></label>
                                        <div class="form-control-wrap ">
                                            <div class="form-control-select">
                                                <select class="form-control" id="basecurrency_id" name="basecurrency_id">
                                                    <option value="">-------Select Base Currency-------</option>
                                                    <option></option>
                                                    @foreach($basecurrency as $obj)
                                                    <option value="{{$obj->id}}">{{$obj->currency_name}}-<I>({{$obj->currency_code}})</I></option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="default-textarea">Programme Description<i><span style="color:grey">(Optional)</span></i></label>
                                                    <div class="form-control-wrap">
                                                        <textarea class="form-control no-resize" name="description" id="default-textarea"></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- <button type="submit" class="btn btn-primary">Create Program</button> -->

                                            


                                        </div>
                                        <br>
                                        <button style="margin-left: 40%;" type="submit" class="btn btn-round btn-primary"><em class="icon ni ni-navigate-fill"></em>&nbsp Add New Program</button>
                                    </form>


                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>



        <script>
            $(document).ready(function() {
                $("#createProgram").validate({
                    rules: {
                        program_name: {
                            required: true,
                            minlength: 5
                        },
                        end_date: {
                            required: true,
                        },
                        start_date: {
                            required: true,
                        },
                        basecurrency_id: {
                            required: true,
                        }
                    },
                    messages: {
                        program_name: {
                            required: "Please enter program name",
                            minlength: "Your program name must consist of at least 5 characters and above"
                        },
                        end_date: {
                            required: "Please select end date",
                            
                        },
                        start_date: {
                            required: "Please select start date",
                            
                        },
                        basecurrency_id: {
                            required: "Please Select Base Currency",
                        }

                    },
                    submitHandler: function(form) {
                        form.submit();
                    }
                });
            });
        </script>


        @endsection
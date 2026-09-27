@extends('layouts.apps')
@section('content')

<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="components-preview wide-md mx-auto">
                    <nav>
                        <ul class="breadcrumb breadcrumb-pipe">
                            <li class="breadcrumb-item"><a href="{{ url('/home')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('organizations.index')}}">Your Organization</a></li>
                            <li class="breadcrumb-item active">Update Organization Information</li>
                        </ul>
                    </nav>
                    <br>
                    <div class="nk-block nk-block-lg">
                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <div class="preview-block">
                                    <span class="preview-title-lg overline-title">Update Organization</span>
                                    <form method="POST" enctype="multipart/form-data" action="">
                                        @csrf
                                        <div class="row gy-4">
                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Organization Name</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="logframe_name" class="form-control" id="default-01" value="{{$organization->organization_name}}">
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Organization PIN</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="logframe_name" class="form-control" id="default-01" value="{{$organization->kra_pin}}">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Organization Phone Number</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="logframe_name" class="form-control" id="default-01" value="{{$organization->phone_number}}">
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Organization Physical Address</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="logframe_name" class="form-control" id="default-01" value="{{$organization->address}}">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Organization Email Address</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="logframe_name" class="form-control" id="default-01" value="{{$organization->email_address}}">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Organization Logo</label>
                                                <div class="form-control-wrap">
                                                    <input type="file" name="logo" class="form-control" id="default-01" value="{{$organization->organization_name}}">
                                                </div>
                                            </div>

                                            <input type="hidden" name="organization_id" class="form-control" id="default-01" readonly="" value="{{ Auth::user()->organization_id }}">

                                            <input type="hidden" name="created_by" class="form-control" id="default-01" readonly="" value="{{ Auth::user()->id }}"> 

                                            <!-- <button type="submit" class="btn btn-primary">Update Log Frame</button> -->
                                        </div>
                                        <br>
                                        <button style="margin-left: 40%;" type="submit" class="btn btn-round btn-primary"><em class="icon ni ni-reload"></em>&nbsp Update Organization</button>
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
@endsection
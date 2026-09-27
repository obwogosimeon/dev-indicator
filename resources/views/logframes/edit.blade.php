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
                            <li class="breadcrumb-item"><a href="{{ route('logframes.index')}}">Logframes</a></li>
                            <li class="breadcrumb-item active">Update Logframe</li>
                        </ul>
                    </nav>
                   <br>
                    <div class="nk-block nk-block-lg">

                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <div class="preview-block">
                                    <span class="preview-title-lg overline-title">Edit Log Frame</span>
                                    {!! Form::model($logedit, ['method' => 'PATCH','route' => ['logframes.update', $logedit->id]]) !!}
                                        @csrf

                                        <div class="row gy-4">

                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Log Frame Name</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="logframe_name" class="form-control" id="default-01" value="{{$logedit->logframe_name}}">
                                                </div>
                                            </div>

                                            <input type="hidden" name="organization_id" class="form-control" id="default-01" readonly="" value="{{ Auth::user()->organization_id }}">

                                            <input type="hidden" name="created_by" class="form-control" id="default-01" readonly="" value="{{ Auth::user()->id }}"> 



                                            <!-- <button type="submit" class="btn btn-primary">Update Log Frame</button> -->
                                        </div>

                                        <br>
                                        <button style="margin-left: 40%;" type="submit" class="btn btn-round btn-primary"><em class="icon ni ni-reload"></em>&nbsp Update LogFrame</button>

                                    {!! Form::close() !!}
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
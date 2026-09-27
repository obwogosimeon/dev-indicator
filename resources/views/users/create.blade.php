@extends('layouts.apps')
@section('content')

<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <nav>
                <ul class="breadcrumb breadcrumb-pipe">
                    <li class="breadcrumb-item"><a href="{{ url('/home')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('users.index')}}">Members</a></li>
                    <li class="breadcrumb-item active">Add New Member</li>
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
                            <span class="preview-title-lg overline-title">Create Member</span>

                            {!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}
                            @csrf
                            <div class="row gy-4">

                                <div class="form-group">
                                    <label class="form-label" for="default-01">First Name:</label>
                                    <div class="form-control-wrap">
                                        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="default-01">Last Name:</label>
                                    <div class="form-control-wrap">
                                        {!! Form::text('last_name', null, array('placeholder' => 'Last Name','class' => 'form-control')) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="default-01">Email:</label>
                                    <div class="form-control-wrap">
                                        {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                                    </div>
                                </div>

                                <!-- <div class="form-group">
                                    <label class="form-label" for="default-01">Password:</label>
                                    <div class="form-control-wrap">
                                        {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
                                    </div>
                                </div>

                                

                                <div class="form-group">
                                    <label class="form-label" for="default-01">Confirm Password:</label>
                                    <div class="form-control-wrap">
                                        {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
                                    </div>
                                </div> -->

                               <!--  <div class="form-group" id="program">
                                    <label class="form-label" for="default-06">Organization</label>
                                    <div class="form-control-wrap ">
                                        <div class="form-control-select">
                                            <select class="form-control" id="roles" name="roles" >
                                                <option value="#">-------Select Organization-------</option>
                                                <option></option>                                                   
                                                @foreach($orgs as $object)
                                                <option value="{{$object->id}}">{{$object->organization_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div> -->

                                <div class="form-group" id="program">
                                    <label class="form-label" for="default-06">Roles:</label>
                                    <div class="form-control-wrap ">
                                        <div class="form-control-select">
                                            <select class="form-control" id="roles" name="roles" >
                                                <option value="#">-------Select Role-------</option>
                                                <option></option>                                                   
                                                @foreach($roles as $object)
                                                <option value="{{$object->name}}">{{$object->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="organization_id" class="form-control" id="default-01" readonly="" value="{{ Auth::user()->organization_id }}">

                                <input type="hidden" name="organization_name" class="form-control" id="default-01" readonly="" value="{{ Auth::user()->organization_name }}">

                                <input type="hidden" name="created_by" class="form-control" id="default-01" readonly="" value="{{ Auth::user()->id }}"> 



                                <!-- <button type="submit" class="btn btn-primary">Create User</button> -->


                            </div>

                            <br>
                            <button style="margin-left: 40%;" type="submit" class="btn btn-round btn-primary"><em class="icon ni ni-navigate-fill"></em>&nbsp Add Member</button>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


@endsection
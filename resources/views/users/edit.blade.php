

@extends('layouts.apps')
@section('content')

<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <nav>
                <ul class="breadcrumb breadcrumb-pipe">
                    <li class="breadcrumb-item"><a href="{{ url('/home')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('users.index')}}">Users</a></li>
                    <li class="breadcrumb-item active">Update User</li>
                </ul>
            </nav>
            <br>

            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                 @foreach ($errors->all() as $error)
                 <li>{{ $error }}</li>
                 @endforeach
             </ul>
         </div>
         @endif

         <div class="nk-block nk-block-lg">

            <div class="card card-bordered card-preview">
                <div class="card-inner">
                    <div class="preview-block">
                        <span class="preview-title-lg overline-title">Edit Log Frame</span>
                        {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
                        @csrf

                        <div class="row gy-4">

                            <div class="form-group">
                                <label class="form-label" for="default-01">Full Name</label>
                                <div class="form-control-wrap">
                                    {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="default-01">Email</label>
                                <div class="form-control-wrap">
                                    {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="default-01">Password</label>
                                <div class="form-control-wrap">
                                    {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="default-01">Password</label>
                                <div class="form-control-wrap">
                                   {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
                               </div>
                           </div>

                           <div class="form-group">
                            <label class="form-label" for="default-01">Password</label>
                            <div class="form-control-wrap">
                               {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}
                           </div>
                       </div>





                       <!-- <button type="submit" class="btn btn-primary">Update Log Frame</button> -->
                   </div>

                   <br>
                   <button style="margin-left: 40%;" type="submit" class="btn btn-round btn-primary"><em class="icon ni ni-reload"></em>&nbsp Update User</button>

                   {!! Form::close() !!}
               </div>
           </div>
       </div>

   </div>
</div>
</div>
</div>

@endsection
@extends('layouts.apps')
@section('content')

<div class="nk-content ">
<div class="container-fluid">
<div class="nk-content-inner">
<div class="nk-content-body">
<div class="components-preview wide-md mx-auto">
    <div class="nk-block-head nk-block-head-lg wide-sm">
        <div class="nk-block-head-content">
            <div class="nk-block-head-sub"><a class="back-to" href="{{ route('roles.index')}}"><em class="icon ni ni-arrow-left"></em><span>System Roles</span></a></div>
        </div>
    </div><!-- .nk-block-head -->
    <div class="nk-block nk-block-lg">

        <div class="card card-bordered card-preview">
            <div class="card-inner">
                <div class="preview-block">
                    <span class="preview-title-lg overline-title">Create System Role</span>

                    {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
                        @csrf
                    <div class="row gy-4">
                        
                            <div class="form-group">
                                <label class="form-label" for="default-01">Profile Name:</label>
                                <div class="form-control-wrap">
                                    {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                                </div>
                            </div>

                            

                            <div class="form-group">
                                <label class="form-label" for="default-01">Permissions:</label>
                                <div class="form-control-wrap">
                                    <br/>
                                    @foreach($permission as $value)
                                        <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                                        {{ $value->alias }}</label>
                                    <br/>
                                    @endforeach
                                </div>
                            </div>

                            
                        
                        
                       
                        <button type="submit" class="btn btn-primary">Create Role</button>
                        
                        
                    </div>
                    
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
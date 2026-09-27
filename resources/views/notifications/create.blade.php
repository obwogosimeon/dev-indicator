@extends('layouts.apps')
@section('content')

<div class="nk-content ">
<div class="container-fluid">
<div class="nk-content-inner">
<div class="nk-content-body">
<div class="components-preview wide-md mx-auto">
    <div class="nk-block-head nk-block-head-lg wide-sm">
        <div class="nk-block-head-content">
            <div class="nk-block-head-sub"><a class="back-to" href="{{ route('notificationget')}}"><em class="icon ni ni-arrow-left"></em><span>Notification</span></a></div>
        </div>
    </div><!-- .nk-block-head -->
    <div class="nk-block nk-block-lg">

        <div class="card card-bordered card-preview">
            <div class="card-inner">
                <div class="preview-block">
                    <span class="preview-title-lg overline-title">Create Package</span>
                    <form method="POST" action="{{ route('notificationstore')}}">
                        @csrf
                    <div class="row gy-4">

                        <input type="hidden" name="organization_id" class="form-control" id="default-01" readonly="" value="{{ Auth::user()->organization_id }}">

                        <input type="hidden" name="created_by" class="form-control" id="default-01" readonly="" value="{{ Auth::user()->id }}">
                        
                            <div class="form-group">
                                <label class="form-label" for="default-01">Driver</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="driver" class="form-control" id="default-01" readonly="" value="smtp">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="default-01">Host</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="host" class="form-control" id="default-01" placeholder="Input Host">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="default-01">Port</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="port" class="form-control" id="default-01" placeholder="Input Port">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="default-01">Username</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="username" class="form-control" id="default-01" placeholder="Input Username">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="default-01">Password</label>
                                <div class="form-control-wrap">
                                    <input type="password" name="password" class="form-control" id="default-01" placeholder="Input Password">
                                </div>
                            </div>

                        <button type="submit" class="btn btn-primary">Create Notification</button>
                    </div>
                    
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
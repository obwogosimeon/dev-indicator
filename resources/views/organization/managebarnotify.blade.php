@extends('layouts.apps')
@section('content')

<nav>
    <ul class="breadcrumb breadcrumb-pipe">
        <li class="breadcrumb-item"><a href="{{ url('/home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ url('barnotifications')}}">Notifications</a></li>
        <li class="breadcrumb-item active">Manage Notification</li>
    </ul>
</nav>
<hr>

<div class="nk-block-head nk-block-head-lg wide-sm">
    <div class="nk-block-head-content">
        <h6 class="title"><B>Description</B> <span class="badge bg-success">{{$managebarnotify->description}}</span></h6>
        <div class="nk-block-des">
        </div>
    </div>
</div>

<div class="card card-bordered card-preview">
    <div class="card-inner">
        <ul class="preview-list">
            @if($managebarnotify->status == '01')
            <li class="preview-item">
                <button type="button" class="btn btn-success icon ni ni-setting" data-bs-toggle="modal" data-bs-target="#accept"></em>Accept</button>
            </li> 
            <li class="preview-item">
                <button type="button" class="btn btn-danger icon ni ni-setting" data-bs-toggle="modal" data-bs-target="#reject"></em>Reject</button>
            </li>  
            @endif
            <li class="preview-item">
                <button type="button" class="btn btn-warning icon ni ni-setting" data-bs-toggle="modal" data-bs-target="#close"></em>Close</button>
            </li>  
        </ul>
    </div>
</div>



<div class="modal fade zoom" tabindex="-1" id="accept">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Accept Invitation</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <div class="nk-block nk-block-lg">
                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <ul class="nav nav-tabs mt-n3">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#tabItem5897"><em class="icon ni ni-user"></em><span>Invitation</span></a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tabItem5897">
                                        <form method="POST" action="{{ url('acceptinvite/'.$managebarnotify->id)}}">
                                            @csrf
                                            <div class="row gy-4">

                                              <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="default-textarea">Accept Comment</label>
                                                    <div class="form-control-wrap">
                                                        <textarea class="form-control no-resize" name="accept_comment" id="default-textarea"></textarea>
                                                    </div>
                                                </div>
                                            </div> 

                                            <input type="hidden" name="status" value="02">
                                            <input type="hidden" name="approved_by" value="{{Auth::user()->id}}">

                                            <button type="submit" class="btn btn-primary">Accept</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <span class="sub-text"></span>
            </div>
        </div>
    </div>
</div>



<div class="modal fade zoom" tabindex="-1" id="reject">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reject Invitation</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <div class="nk-block nk-block-lg">
                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <ul class="nav nav-tabs mt-n3">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#tabItem5897"><em class="icon ni ni-user"></em><span>Invitation</span></a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tabItem5897">
                                        <form method="POST" action="{{ url('rejectinvite/'.$managebarnotify->id)}}">
                                            @csrf
                                            <div class="row gy-4">

                                              <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="default-textarea">Rejection Comment</label>
                                                    <div class="form-control-wrap">
                                                        <textarea class="form-control no-resize" name="rejection_comment" id="default-textarea"></textarea>
                                                    </div>
                                                </div>
                                            </div> 

                                            <input type="hidden" name="status" value="03">
                                            <input type="hidden" name="rejected_by" value="{{Auth::user()->id}}">

                                            <button type="submit" class="btn btn-primary">Reject</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <span class="sub-text"></span>
            </div>
        </div>
    </div>
</div>


<div class="modal fade zoom" tabindex="-1" id="close">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Close Invitation</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <div class="nk-block nk-block-lg">
                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <ul class="nav nav-tabs mt-n3">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#tabItem5897"><em class="icon ni ni-user"></em><span>Invitation</span></a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tabItem5897">
                                        <form method="POST" action="{{ url('closeinvite/'.$managebarnotify->id)}}">
                                            @csrf
                                            <div class="row gy-4">

                                              <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="default-textarea">Closure Comment</label>
                                                    <div class="form-control-wrap">
                                                        <textarea class="form-control no-resize" name="close_comment" id="default-textarea"></textarea>
                                                    </div>
                                                </div>
                                            </div> 

                                            <input type="hidden" name="status" value="04">
                                            <input type="hidden" name="closed_by" value="{{Auth::user()->id}}">

                                            <button type="submit" class="btn btn-primary">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <span class="sub-text"></span>
            </div>
        </div>
    </div>
</div>

@endsection
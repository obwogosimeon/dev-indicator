

<div class="card-inner">
    <ul class="preview-list">
        <li class="preview-item">
            <button type="button" class="btn btn-round btn-primary" data-bs-toggle="modal" data-bs-target="#modalZoom8787"><em class="icon ni ni-plus"></em>&nbsp Add Intervention Container</button>
        </li>
    </ul>
</div>

@foreach($intervencontainers as $key1 => $incontainer)

@if($incontainer->status == '01')
<h6 class="title"><span class="badge bg-warning">Draft</span> 
@elseif($incontainer->status == '02')    
<h6 class="title"><span class="badge bg-success">Submitted</span> 
@endif


<li class="preview-item">
    <button type="button" class="btn btn-success icon ni ni-setting" data-bs-toggle="modal" data-bs-target="#modalZoom366"></em>Add Intervention</button>
</li> 



<div class="card card-bordered card-preview">
    <div class="card-inner">
        <table class="datatable-init table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Activity</th>
                    @foreach($accounts as $key => $object)
                    <th>{{$object->funding_name}}</th>
                    @endforeach
                    <!-- <th>Funding Three</th> -->
                    <th>Total Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach ($interventions as $key => $object)


      <tr>
        <td>{{$i}}</td>
        <td>{{$object->activity_name}}</td>
        @if($projectshow->basecurrency_id != '')
        <td>{{$projectshow->basecurrency->currency_code}} @convert($object->funding1)</td>
        <td>{{$projectshow->basecurrency->currency_code}} @convert($object->funding2)</td>
        <td>{{$projectshow->basecurrency->currency_code}} @convert($object->total)</td>
        @else
        <td>{{$projectshow->program->basecurrency->currency_code}} @convert($object->funding1)</td>
        <td>{{$projectshow->program->basecurrency->currency_code}} @convert($object->funding2)</td>
        <td>{{$projectshow->program->basecurrency->currency_code}} @convert($object->total)</td>
        @endif
        <td>
            <ul class="nk-tb-actions gx-1 my-n1">
                <li class="me-n1">
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <ul class="link-list-opt no-bdr">


                                <li class="preview-item">
                                    <button type="button" class="btn btn-success icon ni ni-edit" id="editintervention" data-id="{{ $object->id }}" data-bs-toggle="modal" data-bs-target="#editinterventi"></em>Edit Intervention</button>
                                </li> 
                                <li class="preview-item">
                                    <button type="button" class="btn btn-success icon ni ni-eye" id="viewintervention" data-id="{{ $object->id }}" data-bs-toggle="modal" data-bs-target="#viewinterventi"></em>View Intervention</button>
                                </li> 
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
            
        </td>
    </tr>
    <?php $i++; ?>
    @endforeach  
</tbody>
</table>
<hr>
<style type="text/css">
    .styled-table thead tr {
        background-color: #009879;
        color: #ffffff;
        text-align: left;
    }

    .styled-table th,
    .styled-table td {
        padding: 12px 15px;
    }

    .styled-table tbody tr {
        border-bottom: 1px solid #dddddd;
    }

    .styled-table tbody tr:nth-of-type(even) {
        background-color: #f3f3f3;
    }

    .styled-table tbody tr:last-of-type {
        border-bottom: 2px solid #009879;
    }
</style>
<table class="styled-table" style="margin-left: 70%;">
  <tr>
    @foreach($accounts as $key => $object)
    <th>{{$object->funding_name}}</th>
    @endforeach
    <th>Total Amount</th>
</tr>
<tr>
    <td>@convert($purchases1)</td>
    <td>@convert($purchases2)</td>
    <td>@convert($purchases)</td>
</tr>

</table>
</div>
</div>
<br>
<br>
<hr>
<div class="card-inner">
    <ul class="preview-list">
        @if($incontainer->status == '01')
        <li class="preview-item">
            <button type="button" class="btn btn-success icon ni ni-setting" data-bs-toggle="modal" data-bs-target="#submitintervention"></em>Submit</button>
        </li>
        @elseif($incontainer->status == '02')  
        <li class="preview-item">
            <button type="button" class="btn btn-info icon ni ni-setting" data-bs-toggle="modal" data-bs-target="#approveintervention">Approve</button>
        </li> 
        <li class="preview-item">
            <button type="button" class="btn btn-info icon ni ni-setting" data-bs-toggle="modal" data-bs-target="#forwardintervention">Forward</button>
        </li> 
        <li class="preview-item">
            <button type="button" class="btn btn-danger icon ni ni-setting" data-bs-toggle="modal" data-bs-target="#rejectintervention">Reject</button>
        </li>
        @endif
    </ul>
</div>

<div class="modal fade zoom" tabindex="-1" id="rejectintervention">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reject Intervention</h5>
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
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem5897"><em class="icon ni ni-user"></em><span>Reject Intervention</span></a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem5897">
                                    <form method="POST" action="{{ url('reject/intervention/'.$incontainer->id)}}">
                                        @csrf
                                        <div class="row gy-4">

                                          <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label" for="default-textarea">Add Comment</label>
                                                <div class="form-control-wrap">
                                                    <textarea class="form-control no-resize" name="reject_comment" id="default-textarea"></textarea>
                                                </div>
                                            </div>
                                        </div> 

                                        <input type="hidden" name="status" value="01">
                                        <input type="hidden" name="rejected_by" value="{{Auth::user()->id}}">

                                        <button type="submit" class="btn btn-primary">Submit</button>
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



<div class="modal fade zoom" tabindex="-1" id="forwardintervention">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Forward Intervention</h5>
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
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem5897"><em class="icon ni ni-user"></em><span>Forward Intervention</span></a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem5897">
                                    <form method="POST" action="{{ url('forward/intervention/'.$incontainer->id)}}">
                                        @csrf
                                        <div class="row gy-4">

                                          <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label" for="default-textarea">Add Comment</label>
                                                <div class="form-control-wrap">
                                                    <textarea class="form-control no-resize" name="forward_comment" id="default-textarea"></textarea>
                                                </div>
                                            </div>
                                        </div> 

                                        <input type="hidden" name="status" value="03">
                                        <input type="hidden" name="forward_by" value="{{Auth::user()->id}}">

                                        <button type="submit" class="btn btn-primary">Submit</button>
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



<div class="modal fade zoom" tabindex="-1" id="approveintervention">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Approve Intervention</h5>
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
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem5897"><em class="icon ni ni-user"></em><span>Approve Intervention</span></a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem5897">
                                    <form method="POST" action="{{ url('approve/intervention/'.$incontainer->id)}}">
                                        @csrf
                                        <div class="row gy-4">

                                          <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label" for="default-textarea">Add Comment</label>
                                                <div class="form-control-wrap">
                                                    <textarea class="form-control no-resize" name="approval_comment" id="default-textarea"></textarea>
                                                </div>
                                            </div>
                                        </div> 

                                        <input type="hidden" name="status" value="04">
                                        <input type="hidden" name="approved_by" value="{{Auth::user()->id}}">

                                        <button type="submit" class="btn btn-primary">Submit</button>
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



<div class="modal fade zoom" tabindex="-1" id="submitintervention">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Submit Intervention</h5>
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
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem5897"><em class="icon ni ni-user"></em><span>Submit Intervention</span></a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem5897">
                                    <form method="POST" action="{{ url('submit/intervention/'.$incontainer->id)}}">
                                        @csrf
                                        <div class="row gy-4">

                                          <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label" for="default-textarea">Add Comment</label>
                                                <div class="form-control-wrap">
                                                    <textarea class="form-control no-resize" name="submission_comment" id="default-textarea"></textarea>
                                                </div>
                                            </div>
                                        </div> 

                                        <input type="hidden" name="status" value="02">
                                        <input type="hidden" name="submitted_by" value="{{Auth::user()->id}}">

                                        <button type="submit" class="btn btn-primary">Submit</button>
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

@endforeach




</div>
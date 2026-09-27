<div class="tab-pane" id="tabItem11">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addprogdoc">Add Program Document</button>
    <br>
    <br>
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class="datatable-init table">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>File Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    @foreach ($documents as $key => $object)
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{ $object->doc_name }}</td>
                        <td>
                            @if($object->status == '01')
                            <span class="badge bg-gray">Draft</span></h6>
                            @elseif($object->status == '02')
                            <span class="badge bg-success">Approved</span></h6>
                            @endif
                        </td>
                        <td>
                            <ul class="nk-tb-actions gx-1 my-n1">
                                <li class="me-n1">
                                    <div class="dropdown">
                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul class="link-list-opt no-bdr">
                                                <li><a href="{{ url('download/'.$object->id)}}"><em class="icon ni ni-download"></em><span>Download Document</span></a></li>
                                                <li><a href="{{ url('documentview/'.$object->id)}}"><em class="icon ni ni-eye"></em><span>Archive Document</span></a></li>
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
        </div>
    </div>

    <div class="modal fade zoom" tabindex="-1" id="addprogdoc">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Program Document</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">

                    <form method="POST" action="{{ route('documents.store')}}" enctype="multipart/form-data">
                        @csrf

                        <div class="row gy-4">

                            <div class="form-group">
                                <label class="form-label" for="default-01">Document Name</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="doc_name" class="form-control" id="default-01" placeholder="Input Document Name">
                                </div>
                            </div>

                            <input type="hidden" name="user_id" class="form-control" value="{{Auth::user()->id}}">
                            <input type="hidden" name="status" class="form-control" value="01">
                            <input type="hidden" name="program_id" class="form-control" value="{{$programshow->id}}">
                            <input type="hidden" name="organization_id" class="form-control" value="{{Auth::user()->organization_id}}">

                            <div class="form-group">
                                <label class="form-label" for="default-01">Browse Document</label>
                                <div class="form-control-wrap">
                                    <input type="file" name="file" class="form-control" id="default-01">
                                </div>
                            </div>  
                        </div>
                        <br>
                        <button style="margin-left: 40%;" type="submit" class="btn btn-round btn-primary"><em class="icon ni ni-navigate-fill"></em>&nbsp Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
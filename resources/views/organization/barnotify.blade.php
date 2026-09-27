@extends('layouts.apps')
@section('content')

<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <nav>
                <ul class="breadcrumb breadcrumb-pipe">
                    <li class="breadcrumb-item"><a href="{{ url('/home')}}">Home</a></li>
                    <!-- <li class="breadcrumb-item"><a href="{{ route('documents.index')}}">Documents</a></li> -->
                    <li class="breadcrumb-item active">Notifications</li>
                </ul>
            </nav>
            <br>

            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif

            <div class="card card-bordered card-preview">
                <div class="card-inner">
                    <table class="datatable-init table">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Type</th>
                                <th>Organization</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                         <?php $i = 1; ?>
                         @foreach ($barnotifies as $key => $object)
                         <tr>
                            <td>{{$i}}</td>
                            <td>{{ $object->type }}</td> 
                            <td>{{ $object->organizationfrom }}</td>
                            <td>{{ $object->description }}</td>  

                            <td>
                                @if($object->status == '01')
                                <span class="badge bg-gray">Pending Review...</span></h6>
                                @elseif($object->status == '02')
                                <span class="badge bg-success">Accepted</span></h6>
                                @elseif($object->status == '03')
                                <span class="badge bg-danger">Rejected</span></h6>
                                @elseif($object->status == '04')
                                <span class="badge bg-warning">Closed</span></h6>
                                @endif
                            </td>
                            
                            <td>
                                
                                <ul class="nk-tb-actions gx-1 my-n1">
                                    <li class="me-n1">
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul class="link-list-opt no-bdr">
                                                    <li><a href="{{ url('managebarnotify/'.$object->id)}}"><em class="icon ni ni-setting"></em><span>Manage Invite</span></a></li>
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

    </div>
</div>
</div>
</div>
</div>

@endsection
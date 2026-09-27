@extends('layouts.apps')
@section('content')

<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <nav>
                <ul class="breadcrumb breadcrumb-pipe">
                    <li class="breadcrumb-item"><a href="{{ url('/home')}}">Home</a></li>
                    <!-- <li class="breadcrumb-item"><a href="{{ route('documents.index')}}">Documents</a></li> -->
                    <li class="breadcrumb-item active">Organizations</li>
                </ul>
            </nav>
            <br>

            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif

            <a href="{{ route('organizations.create')}}" style="margin-left: 86%" class="btn btn-round btn-primary"><em class="icon ni ni-plus"></em><span>New Organization</span></a>

            <br>
            <br>

            <div class="card card-bordered card-preview">
                <div class="card-inner">
                    <table class="datatable-init table">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Organization Name</th>
                                <th>Parent/Affiliate</th>
                                <th>Organization Code</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                         <?php $i = 1; ?>
                         @foreach ($organizations as $key => $object)
                         <tr>
                            <td>{{$i}}</td>
                            <td>{{ $object->organization_name }}</td> 
                            @if($object->id == Auth::user()->organization_id)
                            <td>Parent</td>
                            @else
                            <td>Affiliate</td>
                            @endif
                            <td>{{ $object->access_code }}</td>  

                            <td>
                                @if($object->status == '01')
                                <span class="badge bg-gray">Draft</span></h6>
                                @elseif($object->status == '04')
                                <span class="badge bg-success">Active</span></h6>
                                @endif
                            </td>

                            <td>
                                    <li class="col-sm-6 col-lg-3">
                                        <div class="dropdown">
                                            <a href="#" class="btn btn-primary" data-bs-toggle="dropdown"><span>Select Action</span><em class="icon ni ni-chevron-down"></em></a>
                                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-auto mt-1">
                                                <ul class="link-list-plain">
                                                    <li><a href="{{ route('organizations.show', $object->id) }}">Manage</a></li>
                                                    <li><a href="{{ route('organizations.edit', $object->id) }}">Update</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </td>

                            <!-- <td>

                                <ul class="nk-tb-actions gx-1 my-n1">
                                    <li class="me-n1">
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul class="link-list-opt no-bdr">
                                                    <li><a href="{{ route('organizations.edit', $object->id) }}"><em class="icon ni ni-edit"></em><span>Edit Organization</span></a></li>
                                                    
                                                    <li><a href="{{ route('organizations.show', $object->id) }}"><em class="icon ni ni-setting"></em><span>Manage Organization</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </td> -->
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
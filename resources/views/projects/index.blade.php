@extends('layouts.apps')
@section('content')



<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <nav>
                <ul class="breadcrumb breadcrumb-pipe">
                    <li class="breadcrumb-item"><a href="{{ url('/home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Projects</li>
                </ul>
            </nav>
            <br>

            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif

            @can('project.create')

            <!-- <a href="{{ route('projects.create')}}" style="margin-left: 90%" class="btn btn-round btn-primary"><em class="icon ni ni-plus"></em><span>New Project</span></a> -->

            <a href="{{ route('projects.create')}}" style="align: left;" class="btn btn-round btn-primary"><em class="icon ni ni-plus"></em><span>New Project</span></a>

            @endcan
            <br>
            <br>

            <div class="card card-bordered card-preview">
                <div class="card-inner">
                    <table class="datatable-init-export nowrap table" data-export-title="Projects">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Project Name</th>
                                <th>Program/Log Frame Name</th>
                                <th>Reporting Frequency</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php $i = 1; ?>
                           @foreach ($projects as $object)
                           <tr>
                            <td>{{$i}}</td>
                            <td>{{ $object->project_name }}</td>
                            @if($object->logframe_id == '#' || $object->logframe_id == '')
                            <td>{{ $object->program->program_name }} - <i>(PROGRAM)</i></td>
                            @else
                            <td>{{ $object->logframe->logframe_name }}  - <i>(LOGFRAME)</i></td>
                            @endif
                            <td>{{ $object->reporting_frequency }}</td>
                            @if($object->status == '01')
                            <td><span class="badge bg-warning">Unverified</td>
                                @elseif($object->status == '00')  
                                <td><span class="badge bg-success">Active</td>  
                                    @endif
                                    <!-- <td>
                                        <li class="col-sm-6 col-lg-3">
                                            <div class="dropdown">
                                                <a href="#" class="btn btn-primary" data-bs-toggle="dropdown"><span>Select Action</span><em class="icon ni ni-chevron-down"></em></a>
                                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-auto mt-1">
                                                    <ul class="link-list-plain">
                                                        <li><a href="{{ route('projects.edit', $object->id) }}">Update Project</a></li>
                                                        @if($object->status == '01')
                                                        <li><a href="#">Verify Project</a></li>
                                                        @endif
                                                        @if($object->status == '00')
                                                        <li><a href="{{ route('projects.show', $object->id) }}">Manage Project</a></li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    </td> -->

                                    <td>
                                            <div class="tb-odr-btns d-none d-sm-inline">
                                                <a href="{{ route('projects.edit', $object->id) }}" class="btn btn-dim btn-sm btn-primary"><em class="icon ni ni-edit"></em></a>
                                                <a href="{{ route('projects.show', $object->id) }}" class="btn btn-dim btn-sm btn-primary"><em class="icon ni ni-eye"></em></a>
                                            </div>
                                            <a href="#" class="btn btn-pd-auto d-sm-none"><em class="icon ni ni-chevron-right"></em></a>
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


    @endsection
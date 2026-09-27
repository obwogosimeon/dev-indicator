@extends('layouts.apps')
@section('content')

<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <nav>
                <ul class="breadcrumb breadcrumb-pipe">
                    <li class="breadcrumb-item"><a href="{{ url('/home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Programs</li>
                    <!-- <li class="breadcrumb-item active">Add Project</li> -->
                </ul>
            </nav>
            <br>

            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif


            <a href="{{ route('programs.create')}}" style="align: left;" class="btn btn-round btn-primary"><em class="icon ni ni-plus"></em><span>New Programme</span></a>


            <br>
            <br>

            <div class="card card-bordered card-preview">
                <div class="card-inner">
                    <table class="datatable-init table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Programme Name</th>
                                <th>Base Currency</th>
                                <th>Date Range</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach ($programs as $key => $object)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $object->program_name }}</td>
                                <td>{{ $object->basecurrency->currency_name }}</td>
                                <td>{{ $object->start_date }} - {{ $object->end_date }}</td>
                                @if($object->status == '01')
                                <td><span class="badge bg-warning">Unverified</td>
                                    @elseif($object->status == '00')  
                                    <td><span class="badge bg-success">Active</td>  
                                        @endif    
                                        <td>
                                            <div class="tb-odr-btns d-none d-sm-inline">
                                                <a href="{{ route('programs.edit', $object->id) }}" class="btn btn-dim btn-sm btn-primary"><em class="icon ni ni-edit"></em></a>
                                                <a href="{{ route('programs.show', $object->id) }}" class="btn btn-dim btn-sm btn-primary"><em class="icon ni ni-eye"></em></a>
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
@extends('layouts.apps')
@section('content')

<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <nav>
                <ul class="breadcrumb breadcrumb-pipe">
                    <li class="breadcrumb-item"><a href="{{ url('/home')}}">Home</a></li>
                    <!-- <li class="breadcrumb-item"><a href="{{ route('logframes.index')}}">Logframes</a></li> -->
                    <li class="breadcrumb-item active">Logframes</li>
                </ul>
            </nav>

            <br>

            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif
            @can('logframe.create')
            
            <a href="{{ route('logframes.create')}}" style="margin-left: 82%" class="btn btn-round btn-primary"><em class="icon ni ni-plus"></em><span>New Logframe</span></a>
            @endcan

            <br>
            <br>

            <div class="card card-bordered card-preview">
                <div class="card-inner">
                    <table class="datatable-init table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Log Frame Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php $i = 1; ?>
                           @foreach ($logframes as $key => $object)
                           <tr>
                            <td>{{$i}}</td>
                            <td>{{ $object->logframe_name }}</td>
                            <td>
                                <ul class="nk-tb-actions gx-1 my-n1">
                                    <li class="me-n1">
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul class="link-list-opt no-bdr">
                                                    <li><a href="{{ route('logframes.edit', $object->id) }}"><em class="icon ni ni-edit"></em><span>Edit Logframe</span></a></li>
                                                    <li><a href="#"><em class="icon ni ni-trash"></em><span>Remove Logframe</span></a></li>
                                                    <li><a href="{{ route('logframes.show', $object->id) }}"><em class="icon ni ni-eye"></em><span>View Logframe</span></a></li>

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


@endsection
@extends('layouts.apps')
@section('content')

<div class="nk-content ">
<div class="container-fluid">
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="components-preview wide-md mx-auto">
                <div class="nk-block-head nk-block-head-lg wide-sm">
                    <div class="nk-block-head-content">
                        <div class="nk-block-head-sub"><a class="back-to" href="{{ url('/home')}}"><em class="icon ni ni-arrow-left"></em><span>Dashboard</span></a></div>
                        <h2 class="nk-block-title fw-normal">Programmes Report</h2>
                    </div>
                </div>

                @if ($message = Session::get('success'))
                  <div class="alert alert-success">
                    <p>{{ $message }}</p>
                  </div>
                  @endif

                <a href="{{ route('programs.create')}}" style="align: left;" class="btn btn-round btn-lg btn-primary">New Programme</a>

                <br>
                <br>

                <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <table class="datatable-init table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Programme Name</th>
                                        <th>Date Range</th>
                                        <!-- <th>Created By</th>
                                        <th>Status</th> -->
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach ($programs as $key => $object)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $object->program_name }}</td>
                                        <td>{{ $object->start_date }} - {{ $object->end_date }}</td>
                                        <!-- <td></td>
                                        <td></td> -->
                                        <td>
                                           
                                           <li class="col-sm-6 col-lg-3">
                                  
                                    <div class="dropdown">
                                        <a href="#" class="btn btn-primary" data-bs-toggle="dropdown"><span>Select Action</span><em class="icon ni ni-chevron-down"></em></a>
                                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-auto mt-1">
                                            <ul class="link-list-plain">
                                                
                                                <li><a href="#">Manage</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
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
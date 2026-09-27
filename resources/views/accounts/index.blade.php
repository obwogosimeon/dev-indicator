@extends('layouts.apps')
@section('content')

<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="components-preview wide-md mx-auto">
                    <nav>
                        <ul class="breadcrumb breadcrumb-pipe">
                            <li class="breadcrumb-item"><a href="{{ url('/home')}}">Home</a></li>
                            <!-- <li class="breadcrumb-item"><a href="{{ route('accounts.index')}}">Account</a></li> -->
                            <li class="breadcrumb-item active">Accounts</li>
                        </ul>
                    </nav>
                    <br>

                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                    @endif

                    <a href="{{ route('accounts.create')}}" style="align: left;" class="btn btn-round btn-lg btn-primary">New Account</a>

                    <br>
                    <br>

                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <table class="datatable-init table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Account Name</th>
                                        <th>Account Code</th>
                                        <!-- <th>Account Type</th> -->
                                        <!-- <th>Created By</th> -->
                                        <!-- <th>Status</th> -->
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach ($accounts as $key => $object)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{ $object->account_name }}</td>
                                        <td>{{ $object->account_code }}</td>
                                        <!-- <td>{{ $object->account_type }}</td> -->
                                        <!-- <td></td> -->
                                        <!-- <td></td> -->
                                        <td>
                                            <li class="col-sm-6 col-lg-3">
                                              
                                                <div class="dropdown">
                                                    <a href="#" class="btn btn-primary" data-bs-toggle="dropdown"><span>Select Action</span><em class="icon ni ni-chevron-down"></em></a>
                                                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-auto mt-1">
                                                        <ul class="link-list-plain">
                                                            <li><a href="{{ route('accounts.edit', $object->id) }}">Update</a></li>
                                                            <li><a href="{{ route('accounts.show', $object->id) }}">Show</a></li>
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
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
            <h2 class="nk-block-title fw-normal">Notifications</h2>
        </div>
    </div><!-- .nk-block-head -->

     @if ($message = Session::get('success'))
  <div class="alert alert-success">
    <p>{{ $message }}</p>
  </div>
  @endif

    <a href="{{ route('notificationcreate')}}" style="align: left;" class="btn btn-round btn-lg btn-primary">New Notification</a>

    <br>
    <br>

    <div class="card card-bordered card-preview">
            <div class="card-inner">
                <table class="datatable-init table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Organization Name</th>
                            <th>Email Address</th>
                            <th>Email host</th>
                            <th>Email Driver</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; ?>
                    @foreach ($notifications as $key => $object)
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{ $object->organization->name }}</td>
                        <td>{{ $object->username }}</td>
                        <td>{{ $object->host }}</td>
                        <td>{{ $object->driver }}</td>
                        <td>
                        <li class="col-sm-6 col-lg-3">
                      
                        <div class="dropdown">
                            <a href="#" class="btn btn-primary" data-bs-toggle="dropdown"><span>Select Action</span><em class="icon ni ni-chevron-down"></em></a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-auto mt-1">
                                <ul class="link-list-plain">
                                    
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
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
                            <h2 class="nk-block-title fw-normal">Permissions</h2>
                        </div>
                    </div><!-- .nk-block-head -->

                     @if ($message = Session::get('success'))
                  <div class="alert alert-success">
                    <p>{{ $message }}</p>
                  </div>
                  @endif

                    <a href="{{ route('permissions.create')}}" style="align: left;" class="btn btn-round btn-lg btn-primary">Add Permission</a>

                    <br>
                    <br>

                    <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <table class="datatable-init table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Permission</th>
                                            <th>Alias</th>
                                            <th>Category</th>
                                            <th>Gurd Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     <?php $i = 1; ?>
                                    @foreach($permissions as $key => $object)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{ $object->name }}</td> 
                                        <td>{{ $object->alias }}</td>  
                                        <td>{{ $object->category }}</td>
                                        <td>{{ $object->guard_name }}</td>
                                                      
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
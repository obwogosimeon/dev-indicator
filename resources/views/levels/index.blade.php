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
                                <h2 class="nk-block-title fw-normal">Levels</h2>
                            </div>
                        </div><!-- .nk-block-head -->

                        @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                        @endif

                        <a href="{{ route('levels.create')}}" style="align: left;" class="btn btn-round btn-lg btn-primary">New Level</a>

                        <br>
                        <br>

                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <table class="datatable-init table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Level Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($levels as $key => $object)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{ $object->level_name }}</td>
                                            <td>
                                                <li class="col-sm-6 col-lg-3">
                                                  
                                                    <div class="dropdown">
                                                        <a href="#" class="btn btn-primary" data-bs-toggle="dropdown"><span>Select Action</span><em class="icon ni ni-chevron-down"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-auto mt-1">
                                                            <ul class="link-list-plain">
                                                                <li><a href="{{ route('levels.edit', $object->id) }}">Update</a></li>
                                                                <li><a href="{{ route('levels.show', $object->id) }}">Show</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                        @endforeach
                                    </tbody>
                                </table>-
                            </div>
                        </div>

                        <br>

                        <div class="example-alerts">
                            <div class="gy-4">
                                <div class="example-alert">
                                    <div class="alert alert-pro alert-primary">
                                        <div class="alert-text">
                                            <!-- <h6>Welcome toPrograme Home Page</h6> -->
                                            <p>Structure levels help identify the management hierachy.

                                                For instance organization can divide itself into management levels such as System Management, Region management, Country Management ...
                                                These are referred to as Structure Levels.

                                            The order defines the levels. Using the handles, you can drag the levels up and down.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="example-alert">
                                    <div class="alert alert-pro alert-secondary">
                                        <div class="alert-text">
                                            <!-- <h6>User roles and access can be set based on this programme</h6> -->
                                            <p>Once a level has structure, you can not reorder nor delete levels above it, inclusive. When the structure's child level is available, the structure can append a child structure depending on rights provided.</p>
                                        </div>
                                    </div>
                                </div>
                                
                                
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection
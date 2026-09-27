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
                                <li class="breadcrumb-item"><a href="{{ route('projects.index')}}">Projects</a></li>
                                <li class="breadcrumb-item active">Project Reports</li>
                            </ul>
                        </nav>
                        <br>


                <div class="nk-block nk-block-lg">
                    
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <ul class="nav nav-tabs mt-n3">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem5"><em class="icon ni ni-user"></em><span>Work Plans</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem6"><em class="icon ni ni-lock-alt"></em><span>Activity Implementation</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem7"><em class="icon ni ni-bell"></em><span>Admin Plans</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem8"><em class="icon ni ni-link"></em><span>Admin Utilization</span></a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem5">
                                    <p>No Record Work Plans!</p>
                                </div>
                                <div class="tab-pane" id="tabItem6">
                                    <p>No Record Activity Implementation!</p>
                                </div>
                                <div class="tab-pane" id="tabItem7">
                                    <p>No Record Admin Plans!</p>
                                </div>
                                <div class="tab-pane" id="tabItem8">
                                    <p>No Record Admin Utilization!</p>
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
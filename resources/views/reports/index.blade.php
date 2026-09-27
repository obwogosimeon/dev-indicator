@extends('layouts.apps')
@section('content')

<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <nav>
                <ul class="breadcrumb breadcrumb-pipe">
                    <li class="breadcrumb-item"><a href="{{ url('/home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Reports</li>
                </ul>
            </nav>

            <div class="card card-bordered card-preview">
                <div class="card-inner">

                    <li class="nk-menu-item">
                        <a href="{{ route('projects.index')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-folder"></em></span>
                            <span class="nk-menu-text">Project Reports</span>
                        </a>
                    </li>
                    <hr>
                    <li class="nk-menu-item">
                        <a href="{{ route('projects.index')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-folder"></em></span>
                            <span class="nk-menu-text">Program Reports</span>
                        </a>
                    </li>
                    <hr>
                    <li class="nk-menu-item">
                        <a href="{{ route('projects.index')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-folder"></em></span>
                            <span class="nk-menu-text">Logframe Reports</span>
                        </a>
                    </li>
                    <hr>
                    <li class="nk-menu-item">
                        <a href="{{ route('projects.index')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-folder"></em></span>
                            <span class="nk-menu-text">Organizations Reports</span>
                        </a>
                    </li>
                    <hr>
                    <li class="nk-menu-item">
                        <a href="{{ route('projects.index')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-folder"></em></span>
                            <span class="nk-menu-text">System Reports</span>
                        </a>
                    </li>

                </div>
            </div>



        </div>
    </div>
</div>

@endsection
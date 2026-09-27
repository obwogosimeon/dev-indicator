@extends('layouts.apps')
@section('content')

<nav>
    <ul class="breadcrumb breadcrumb-pipe">
        <li class="breadcrumb-item"><a href="{{ url('/home')}}">Home</a></li>
        <!-- <li class="breadcrumb-item active">Library</li> -->
    </ul>
</nav>

<div class="container-fluid">
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Welcome to Monitoring & Evaluation (M&E)</h3>
                    </div><!-- .nk-block-head-content -->
                    <div class="nk-block-head-content">
                        <div class="toggle-wrap nk-block-tools-toggle">
                            <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                            <div class="toggle-expand-content" data-content="pageMenu">

                            </div>
                        </div>
                    </div><!-- .nk-block-head-content -->
                </div><!-- .nk-block-between -->
            </div><!-- .nk-block-head -->


            <div class="nk-block">
                <div class="row g-gs">
                    <div class="col-xxl-3 col-sm-6">
                        <div class="card">
                            <div class="nk-ecwg nk-ecwg6">
                                <div class="card-inner">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Number of Projects</h6>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="data-group">
                                            <div class="amount">{{$projects}}</div>
                                            <!-- <div class="nk-ecwg6-ck">
                                                <canvas class="ecommerce-line-chart-s3" id="todayOrders"></canvas>
                                            </div> -->
                                        </div>
                                        
                                    </div>
                                </div><!-- .card-inner -->
                            </div><!-- .nk-ecwg -->
                        </div><!-- .card -->
                    </div><!-- .col -->
                    <div class="col-xxl-3 col-sm-6">
                        <div class="card">
                            <div class="nk-ecwg nk-ecwg6">
                                <div class="card-inner">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Number of Programs</h6>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="data-group">
                                            <div class="amount">{{$programs}}</div>
                                            <!-- <div class="nk-ecwg6-ck">
                                                <canvas class="ecommerce-line-chart-s3" id="todayRevenue"></canvas>
                                            </div> -->
                                        </div>
                                        
                                    </div>
                                </div><!-- .card-inner -->
                            </div><!-- .nk-ecwg -->
                        </div><!-- .card -->
                    </div><!-- .col -->
                    <div class="col-xxl-3 col-sm-6">
                        <div class="card">
                            <div class="nk-ecwg nk-ecwg6">
                                <div class="card-inner">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Affiliate Organizations</h6>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="data-group">
                                            <div class="amount">{{$affiliate}}</div>
                                            <!-- <div class="nk-ecwg6-ck">
                                                <canvas class="ecommerce-line-chart-s3" id="todayCustomers"></canvas>
                                            </div> -->
                                        </div>
                                        
                                    </div>
                                </div><!-- .card-inner -->
                            </div><!-- .nk-ecwg -->
                        </div><!-- .card -->
                    </div><!-- .col -->
                    <div class="col-xxl-3 col-sm-6">
                        <div class="card">
                            <div class="nk-ecwg nk-ecwg6">
                                <div class="card-inner">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Funds utilization status</h6>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="data-group">
                                            <div class="amount">0%</div>
                                            <!-- <div class="nk-ecwg6-ck">
                                                <canvas class="ecommerce-line-chart-s3" id="todayVisitors"></canvas>
                                            </div> -->
                                        </div>
                                        
                                    </div>
                                </div><!-- .card-inner -->
                            </div><!-- .nk-ecwg -->
                        </div><!-- .card -->
                    </div><!-- .col -->





                </div><!-- .row -->
            </div><!-- .nk-block -->



        </div>
    </div>
</div>

<hr>

<!-- <style>
.overlay {
  color: #F5F5F5;
  background-repeat: no-repeat;
  width: 2000px;
  height: 1000px;
}
</style>
<img src="{{ asset('public/main/img/dashboardpic.jpg') }}" class="overlay"/> -->



@endsection
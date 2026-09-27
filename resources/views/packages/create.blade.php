@extends('layouts.apps')
@section('content')

<div class="nk-content ">
<div class="container-fluid">
<div class="nk-content-inner">
<div class="nk-content-body">
<div class="components-preview wide-md mx-auto">
    <div class="nk-block-head nk-block-head-lg wide-sm">
        <div class="nk-block-head-content">
            <div class="nk-block-head-sub"><a class="back-to" href="{{ route('packages.index')}}"><em class="icon ni ni-arrow-left"></em><span>Packages</span></a></div>
        </div>
    </div><!-- .nk-block-head -->
    <div class="nk-block nk-block-lg">

        <div class="card card-bordered card-preview">
            <div class="card-inner">
                <div class="preview-block">
                    <span class="preview-title-lg overline-title">Create Package</span>
                    <form method="POST" action="{{ route('packages.store')}}">
                        @csrf
                    
                    <div class="row gy-4">
                        
                            <div class="form-group">
                                <label class="form-label" for="default-01">Package Name</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="package_name" class="form-control" id="default-01" placeholder="Input Department Name">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="default-01">Package Amount</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="package_amount" class="form-control" id="default-01" placeholder="Input Department Name">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="default-01">Number of Users</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="user" class="form-control" id="default-01" placeholder="Input Department Name">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="default-01">Number of Projects</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="project" class="form-control" id="default-01" placeholder="Input Department Name">
                                </div>
                            </div>

                        <button type="submit" class="btn btn-primary">Create Package</button>
                    </div>
                    
                    </form>
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
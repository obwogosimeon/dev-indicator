@extends('layouts.apps')
@section('content')

<div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="components-preview wide-md mx-auto">
                                    <div class="nk-block-head nk-block-head-lg wide-sm">
                                        <div class="nk-block-head-content">
                                            <div class="nk-block-head-sub"><a class="back-to" href="{{ route('regions.index')}}"><em class="icon ni ni-arrow-left"></em><span>Regions</span></a></div>
                                        </div>
                                    </div><!-- .nk-block-head -->
                                    <div class="nk-block nk-block-lg">

                                        <div class="card card-bordered card-preview">
                                            <div class="card-inner">
                                                <div class="preview-block">
                                                    <span class="preview-title-lg overline-title">Create A region</span>

                                                    <form method="POST" action="{{ route('regions.store')}}">
                                                        @csrf
                                                    <div class="row gy-4">
                                                        
                                                            <div class="form-group">
                                                                <label class="form-label" for="default-01">Region Name</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" name="region_name" class="form-control" id="default-01" placeholder="Input Region Name">
                                                                </div>
                                                            </div>
                                                        
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="form-label" for="default-textarea">Region Description</label>
                                                                <div class="form-control-wrap">
                                                                    <textarea class="form-control no-resize" name="description" id="default-textarea"></textarea>
                                                                </div>
                                                            </div>
                                                        </div> 
                                                        <button type="submit" class="btn btn-primary">Create Region</button>
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
@extends('layouts.apps')
@section('content')

<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="components-preview wide-md mx-auto">
                    <div class="nk-block-head nk-block-head-lg wide-sm">
                        <div class="nk-block-head-content">
                            <div class="nk-block-head-sub"><a class="back-to" href="{{ route('permissions.index')}}"><em class="icon ni ni-arrow-left"></em><span>Permissions</span></a></div>
                        </div>
                    </div><!-- .nk-block-head -->
                    <div class="nk-block nk-block-lg">

                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <div class="preview-block">
                                    <span class="preview-title-lg overline-title">Create Permission</span>
                                    <form method="POST" action="{{ route('permissions.store')}}">
                                        @csrf

                                        <div class="row gy-4">

                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Permission Name</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="name" class="form-control" id="name" placeholder="Input Permission Name">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Permission Alias</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="alias" class="form-control" id="alias" placeholder="Input Alias Name">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="default-06">Permission Category</label>
                                                <div class="form-control-wrap ">
                                                    <div class="form-control-select">
                                                        <select class="form-control" name="category" id="category">
                                                            <option value="null">-------Select Category-------</option>
                                                            <option value="null"></option>
                                                            <option value="Project">Project</option>
                                                            <option value="Program">Program</option>
                                                            <option value="Logframe">Logframe</option>
                                                            <option value="Account">Account</option>
                                                            <option value="Currency">Currency</option>
                                                            <option value="Year">Year</option>
                                                            <option value="MNE">MNE</option>
                                                            <option value="Security">Security</option>
                                                            <option value="Structure">Structure</option>
                                                            <option value="Staff">Staff</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Gurd Name</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="guard_name" class="form-control" id="guard_name" placeholder="Input Gurd Name">
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-primary">Create Permission</button>
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
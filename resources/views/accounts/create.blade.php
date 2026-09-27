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
                            <li class="breadcrumb-item"><a href="{{ route('accounts.index')}}">Account</a></li>
                            <li class="breadcrumb-item active">Add Account</li>
                        </ul>
                    </nav>
                    <br>
                    @if ( count( $errors ) > 0 )
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                        @endforeach
                    </div>
                    @endif
                    <div class="nk-block nk-block-lg">

                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <div class="preview-block">
                                    <span class="preview-title-lg overline-title">Create Account</span>
                                    <form method="POST" action="{{ route('accounts.store')}}">
                                        @csrf
                                        <div class="row gy-4">

                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Account Name</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="account_name" class="form-control" id="default-01" placeholder="Input Account Name">
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Account Code</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="account_code" class="form-control" id="default-01" placeholder="Input Account Code">
                                                </div>
                                            </div>



                                                        <!-- <div class="form-group">
                                                                <label class="form-label" for="default-06">Account Type</label>
                                                                <div class="form-control-wrap ">
                                                                    <div class="form-control-select">
                                                                        <select class="form-control" name="account_type" id="default-06">
                                                                            <option value="#">-------Select Account Type-------</option>
                                                                            <option value="Savings Account">Savings Account</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div> -->
                                                            <div class="form-group">
                                                                <label class="form-label" for="default-06">Account Group</label>
                                                                <div class="form-control-wrap ">
                                                                    <div class="form-control-select">
                                                                        <select class="form-control" name="account_group" id="default-06">
                                                                            <option value="#">-------Select Account Group-------</option>
                                                                            <option value="SAMPLE GROUP">Sample Group</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="default-textarea">Account Description</label>
                                                                    <div class="form-control-wrap">
                                                                        <textarea class="form-control no-resize" name="description" id="default-textarea"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Create Account</button>

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
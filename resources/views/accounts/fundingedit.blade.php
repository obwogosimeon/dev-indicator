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
                            <li class="breadcrumb-item"><a href="{{ route('fundingindex')}}">Fundings</a></li>
                            <li class="breadcrumb-item active">Update Funding</li>
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
                                    <span class="preview-title-lg overline-title">Edit Funding</span>
                                    <form method="POST" action="{{ route('funding.update', $fundingedit->id)}}">
                                        @csrf

                                        <div class="row gy-4">

                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Funding Name</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="funding_name" class="form-control" value="{{$fundingedit->funding_name}}">
                                                </div>
                                            </div>


                                            <input type="hidden" name="type" class="form-control" id="default-01" value="Global">
                                            <input type="hidden" name="status" class="form-control" id="default-01" value="01">

                                            <div class="form-group">
                                                <label class="form-label" for="default-06">Funding Type</label>
                                                <div class="form-control-wrap ">
                                                    <div class="form-control-select">
                                                        <select class="form-control" name="funding_type" id="default-06">
                                                            <option value="{{$fundingedit->funding_type}}">{{$fundingedit->funding_type}}</option>
                                                            <option></option>
                                                            <option value="Budgeting">Budgeting</option>
                                                            <option value="Expenditure">Expenditure</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-label" for="default-06">Expenditure?</label>
                                                <div class="form-control-wrap ">
                                                    <div class="form-control-select">
                                                        <select class="form-control" name="expenditure" id="default-06">
                                                            <option value="{{$fundingedit->expenditure}}">{{$fundingedit->expenditure}}</option>
                                                            <option></option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Variable Name</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="variable_name" class="form-control" value="{{$fundingedit->variable_name}}">
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="default-textarea">Funding Description</label>
                                                    <div class="form-control-wrap">
                                                        <textarea class="form-control no-resize" name="description" id="default-textarea" value="{{$fundingedit->description}}"></textarea>
                                                    </div>
                                                </div>
                                            </div> 

                                            

                                            <input type="hidden" name="updated_by" class="form-control" id="default-01" readonly="" value="{{ Auth::user()->id }}"> 

                                            <button type="submit" class="btn btn-primary">Update Funding</button>
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
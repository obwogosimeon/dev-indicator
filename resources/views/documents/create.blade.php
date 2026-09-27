@extends('layouts.apps')
@section('content')


<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <nav>
                <ul class="breadcrumb breadcrumb-pipe">
                    <li class="breadcrumb-item"><a href="{{ url('/home')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('documents.index')}}">Documents</a></li>
                    <li class="breadcrumb-item active">Add New Document</li>
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
                            <span class="preview-title-lg overline-title">Add New Document</span>
                            <form method="POST" action="{{ route('documents.store')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="row gy-4">

                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Document Name</label>
                                        <div class="form-control-wrap">
                                            <input type="text" name="doc_name" class="form-control" id="default-01" placeholder="Input Document Name">
                                        </div>
                                    </div>

                                    <script>
                                       $(document).ready(function(){
                                        $('#program').hide();
                                        $('#LogFrame').hide();

                                        $('#choose').change(function(){
                                          if($(this).val() == 'programmeshow'){
                                            $('#program').show();
                                            $('#LogFrame').hide();
                                        }else if($(this).val() == 'projectshow'){
                                            $('#LogFrame').show();
                                            $('#program').hide();
                                        }
                                        else{
                                         $('#LogFrame').hide('');
                                         $('#program').hide('');
                                     }
                                 });
                                    });
                                </script>

                                <div class="form-group">
                                    <label class="form-label" for="default-06">Choose Programme/ Project</label>
                                    <div class="form-control-wrap ">
                                        <div class="form-control-select">
                                            <select class="form-control" name="program_id" id="choose">
                                                <option value="null">-------Select Programme/Project-------</option>
                                                <option value="null"></option>
                                                <option value="programmeshow">Programme</option>
                                                <option value="projectshow">Project</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group" id="program">
                                    <label class="form-label" for="default-06">Programme</label>
                                    <div class="form-control-wrap ">
                                        <div class="form-control-select">
                                            <select class="form-control" id="default-06" name="program_id" >
                                                <option value="#">-------Select Programme-------</option>
                                                <option></option>                                                   
                                                @foreach($programs as $object)
                                                <option value="{{$object->id}}">{{$object->program_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group" id="LogFrame">
                                    <label class="form-label" for="default-06">Projects</label>
                                    <div class="form-control-wrap ">
                                        <div class="form-control-select">
                                            <select class="form-control" id="default-06" name="project_id">
                                                <option value="#">-------Select Project-------</option>
                                                <option></option>
                                                @foreach($projects as $object)
                                                <option value="{{$object->id}}">{{$object->project_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="user_id" class="form-control" value="{{Auth::user()->id}}">
                                <input type="hidden" name="status" class="form-control" value="01">
                                <input type="hidden" name="organization_id" class="form-control" value="{{Auth::user()->organization_id}}">

                                <div class="form-group">
                                    <label class="form-label" for="default-01">Browse Document</label>
                                    <div class="form-control-wrap">
                                        <input type="file" name="file" class="form-control" id="default-01">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <button style="margin-left: 40%;" type="submit" class="btn btn-round btn-primary"><em class="icon ni ni-navigate-fill"></em>&nbsp Upload Document</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</div>

@endsection
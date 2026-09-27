@extends('layouts.apps')
@section('content')


<script type="text/javascript">
    $(document).ready(function() {
        $('#invited_id').change(function(){
            $.get("{{ url('api/organization')}}",
                { option: $(this).val() },
                function(data) {
                    console.log('orgemail');
                    $('#orgemail').val(data);
                });
        });
    });
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $('#invited_id').change(function(){
            $.get("{{ url('api/adminid')}}",
                { option: $(this).val() },
                function(data) {
                    console.log('adminid');
                    $('#adminid').val(data);
                });
        });
    });
</script>

<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <nav>
                <ul class="breadcrumb breadcrumb-pipe">
                    <li class="breadcrumb-item"><a href="{{ url('/home')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('organizations.index')}}">Organizations</a></li>
                    <li class="breadcrumb-item active">Add Organization</li>
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
                            <span class="preview-title-lg overline-title">Add Organization</span>

                            <form method="POST" action="{{ route('organizations.store')}}">
                                @csrf
                                <div class="row gy-4">


                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Organization Access Code</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" name="access_code" id="default-01" value="{{$access_code}}" readonly="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Your Organization</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" value="{{$userorganization->organization_name}}" name="yourorganization" id="default-01" readonly>
                                        </div>
                                    </div>

                                    <script>
                                     $(document).ready(function(){
                                        $('#org').hide();
                                        $('#orgname').hide();
                                        $('#email').hide();
                                        $('#emailaddress').hide();
                                        $('#organization').change(function(){
                                          if($(this).val() == 'new'){
                                            $('#org').hide();
                                            $('#orgname').show();
                                            $('#email').show();
                                        }else if($(this).val() == 'existing'){
                                            $('#org').show();
                                            $('#orgname').hide();
                                            $('#emailaddress').show();
                                        }
                                        else{
                                           $('#org').hide('');
                                           $('#orgname').hide('');
                                       }
                                   });
                                    });
                                </script>

                                <div class="form-group">
                                    <label class="form-label" for="default-06">New/Existing Organization?</label>
                                    <div class="form-control-wrap ">
                                        <div class="form-control-select">
                                            <select class="form-control" name="organization_level" id="organization" required>
                                                <option value="">Nothing Selected</option>
                                                <option value=""></option>
                                                <option value="new">New</option>
                                                <option value="existing">Existing</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>




                                <div class="form-group" id="org">
                                    <label class="form-label" for="default-06">All Organization</label>
                                    <div class="form-control-wrap ">
                                        <div class="form-control-select">
                                            <select class="form-control" id="invited_id" name="invited_id" >
                                                <option value="#">Nothing Selected</option>
                                                <option></option>                                                   
                                                @foreach($organizations as $object)
                                                <option value="{{$object->id}}">{{$object->organization_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group" id="orgname">
                                    <label class="form-label" for="default-01">Organization Name</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" name="organization_name" id="default-01" placeholder="Input Organization Name">
                                    </div>
                                </div>

                                

                                <div class="form-group" id="email">
                                    <label class="form-label" for="default-01">Organization Email Address</label>
                                    <div class="form-control-wrap">
                                        <input type="email" class="form-control" name="email_address1" id="default-01" placeholder="Input Organization Name">
                                    </div>
                                </div>


                                <div class="form-group" id="emailaddress">
                                    <label class="form-label" for="default-01">Organization Admin Email</label>
                                    <div class="form-control-wrap">
                                        <input type="email" class="form-control" name="email_address" id="orgemail" value="">
                                    </div>
                                </div>

                                <input type="hidden" class="form-control" name="adminid" id="adminid" value="">
                                <!-- <input type="hidden" class="form-control" name="organization_id1[0]" value="{{$userorganization->id}}"> -->
                                <input type="hidden" class="form-control" name="inviter_id" value="{{$userorganization->id}}">
                                <input type="hidden" class="form-control" name="created_by" id="default-01" value="{{Auth::user()->id}}">
                                <input type="hidden" class="form-control" name="status" id="default-01" value="01">



                                <!-- <button type="submit" class="btn btn-primary">Create Organization</button> -->
                            </div>
                            <br>
                            <button style="margin-left: 40%;" type="submit" class="btn btn-round btn-primary"><em class="icon ni ni-navigate-fill"></em>&nbsp Create Organization</button>
                        </form>


                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</div>


@endsection
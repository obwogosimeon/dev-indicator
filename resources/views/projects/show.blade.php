@extends('layouts.apps')
@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
    $(document).ready(function () {
        $('#tabMenu a[href="#{{ old('tab') }}"]').tab('show')
    });
</script>


<div class="nk-block nk-block-lg">
    <nav>
        <ul class="breadcrumb breadcrumb-pipe">
            <li class="breadcrumb-item"><a href="{{ url('/home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('projects.index')}}">Projects</a></li>
            <li class="breadcrumb-item active">Project Details</li>
            <hr>
            <h5 class="title nk-block-title"><span class="badge bg-success">{{$reportingf}}</span></h5>
        </ul>
    </nav>
    <br>
    <hr>

    <button type="button" style="margin-left: 78%" class="btn btn-round btn-primary" data-bs-toggle="modal" data-bs-target="#updatecurreny"><em class="icon ni ni-edit"></em>&nbsp Update Base Currency</button>
    <br>
    <br>

    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <div class="card-inner">
                <ul class="nav nav-tabs mt-n3" id="tabMenu">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#tabItem1">Implementation</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#tabItem2">Work plan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#tabItem3">Intervention</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#tabItem4">Logframe</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#tabItem5">Funding</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#tabItem6">Project Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#tabItem7">Documents</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#tabItem8">Project Expenses</a>
                    </li>
                </ul>
                
                    <div class="tab-content">


                            @include('projects.implementation.implementation') 


                               <div class="tab-pane" id="tabItem2">
                                <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
                                    <div class="subheader py-2 py-lg-4  subheader-solid " id="kt_subheader">
                                        <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                                            <!--begin::Info-->
                                            <div class="d-flex align-items-center flex-wrap mr-2">
                                                <!--begin::Page Title-->
                                                <h6 class="text-dark font-weight-bolder mt-2 mb-2 mr-10">
                                                    WorkPlans
                                                </h6>
                                            </div>
                                            <!--end::Info-->
                                            <div class="d-flex align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalZoom87">Add WorkPlan Container</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-block nk-block-lg">
                                        <div class="card card-bordered card-preview">
                                            <div class="card-inner">
                                              @foreach($workplancontaines as $key1 => $containers)
                                              <div id="" class="accordion">
                                                <div class="accordion-item">
                                                    <div class="dropdown">
                                                        <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                                            <ul class="link-list-plain">
                                                                @if($containers->status == '01')
                                                                @if($containers->planning_type == 'Activity')
                                                                <li><a href="{{ route('createwp', $containers->id)}}">Add Activity Work Plan</a></li>
                                                                @elseif($containers->planning_type == 'Indicator')
                                                                <li><a href="{{ route('createindicatorwp', $containers->id)}}">Add Indicator Work Plan</a>
                                                                </li>
                                                                @endif

                                                                <li class="preview-item">
                                                                    <button type="button" class="btn btn-success icon ni ni-send" id="workplan2" data-id="{{ $containers->id }}" data-bs-toggle="modal" data-bs-target="#workplan1"></em>Submit</button>
                                                                </li> 
                                                                @elseif($containers->status == '02') 
                                    <!-- <li class="preview-item">
                                        <button type="button" class="btn btn-success icon ni ni-forward-arrow" id="forwardcontainer" data-id="{{ $containers->id }}" data-bs-toggle="modal" data-bs-target="#forwardcontainer"></em>Forward</button>
                                    </li>  -->
                                    <li class="preview-item">
                                        <button type="button" class="btn btn-warning icon ni ni-setting" id="worktimeline" data-id="{{ $containers->id }}" data-bs-toggle="modal" data-bs-target="#worktimeline1"></em>Timeline</button>
                                    </li> 
                                    <li class="preview-item">
                                        <button type="button" class="btn btn-success icon ni ni-cross" id="cancelworkplan" data-id="{{ $containers->id }}" data-bs-toggle="modal" data-bs-target="#cancelworkplan1"></em>Cancel</button>
                                    </li> 
                                    @endif
                                </ul>
                            </div>
                        </div>


                        <div class="modal fade zoom" tabindex="-1" id="worktimeline1">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Timeline</h5>
                                        <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                                            <em class="icon ni ni-cross"></em>
                                        </a>
                                    </div>
                                    <div class="modal-body">
                                        <div class="nk-block nk-block-lg">
                                            <div class="card card-bordered card-preview">
                                                <div class="card-inner">
                                                    <div class="example-alerts">
                                                        <div class="gy-4">
                                                            <div class="example-alert">
                                                                <div class="alert alert-success alert-icon">
                                                                    <em class="icon ni ni-check-circle"></em> <strong>{{$containers->container_name}} Created on</strong>
                                                                    <i>{{$containers->created_at}}</i> <strong>created
                                                                    by </strong>{{Auth::user()->name}}
                                                                </div>
                                                            </div>
                                                            @if($containers->submitted_by != NULL)
                                                            <div class="example-alert">
                                                                <div class="alert alert-secondary alert-icon">
                                                                    <em class="icon ni ni-alert-circle"></em> <strong>{{$containers->container_name}} Submitted on</strong>
                                                                    <i>{{$containers->submitted_on}}</i></strong>. 
                                                                </div>
                                                            </div>
                                                            @endif
                                                            @if($containers->cancel_date != NULL)
                                                            <div class="example-alert">
                                                                <div class="alert alert-danger alert-icon">
                                                                    <em class="icon ni ni-alert-circle"></em> <strong>{{$containers->container_name}} Cancelled on</strong>
                                                                    <i>{{$containers->cancel_date}}</i></strong>.
                                                                </div>
                                                            </div>
                                                            @endif

                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer bg-light">
                                        <span class="sub-text"></span>
                                    </div>
                                </div>
                            </div>
                        </div> 


                        <a href="#" class="accordion-head collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-item-1">
                            <h6 class="title"><span class="badge bg-success">Container Name:</span> {{$containers->container_name}} - ( {{$containers->planning_type}} ) - {{$containers->financial_year}}
                            </h6>
                            <span class="accordion-icon"></span>
                        </a>
                        <div class="accordion-body collapse" id="accordion-item-1" data-bs-parent="#accordion">
                            <div class="accordion-inner">
                                <div class="card card-bordered card-preview">
                                    @if($containers->planning_type == 'Activity')
                                    <div class="card-inner">
                                        <table class="datatable-init-export nowrap table" data-export-title="Export">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Workplan Name</th>

                                                    <th>Date Range</th>
                                                    <!-- <th>Funding One</th> -->
                                                    @foreach($accounts as $key => $object)
                                                    <th>{{$object->funding_name}}</th>
                                                    @endforeach
                                                    <th>Funding Total</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                              <?php $i = 1; ?>
                                              @foreach ($containers->budget as $key => $object)
                                              <tr>
                                                <td>{{$i}}</td>
                                                <td>{{ $object->workplan_name }}</td>
                                                <!-- <td>{{ $object->financial_year }}</td> -->
                                                <!-- <td>{{ $object->activity }}</td> -->
                                                <td>{{ $object->start_date }} - {{ $object->end_date }}</td>
                                                @if($projectshow->basecurrency_id != '')
                                                <td>{{$projectshow->basecurrency->currency_code}} @convert($object->annual_amounta)</td>
                                                <td>{{$projectshow->basecurrency->currency_code}} @convert($object->annual_amountb)</td>
                                                <td>{{$projectshow->basecurrency->currency_code}} @convert($object->total)</td>
                                                <td>
                                                    @else
                                                    <td>{{$projectshow->program->basecurrency->currency_code}} @convert($object->annual_amounta)</td>
                                                    <td>{{$projectshow->program->basecurrency->currency_code}} @convert($object->annual_amountb)</td>
                                                    <td>{{$projectshow->program->basecurrency->currency_code}} @convert($object->total)</td>
                                                    <td>
                                                        @endif

                                                        


                                                        <li class="col-sm-6 col-lg-3">
                                                            <div class="dropdown">
                                                                <a href="#" class="btn btn-primary" data-bs-toggle="dropdown"><span>Select Action</span><em class="icon ni ni-chevron-down"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-auto mt-1">
                                                                    <ul class="link-list-plain">
                                                                        <li><a href="{{ url('budgetupdate',$object->id)}}">Edit Workplan</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </td>

                                                </tr>
                                                <?php $i++; ?>
                                                @endforeach

                                            </tbody>
                                        </table>
                                        <hr>
                                        <style type="text/css">
                                            .styled-table thead tr {
                                                background-color: #009879;
                                                color: #ffffff;
                                                text-align: left;
                                            }

                                            .styled-table th,
                                            .styled-table td {
                                                padding: 12px 15px;
                                            }

                                            .styled-table tbody tr {
                                                border-bottom: 1px solid #dddddd;
                                            }

                                            .styled-table tbody tr:nth-of-type(even) {
                                                background-color: #f3f3f3;
                                            }

                                            .styled-table tbody tr:last-of-type {
                                                border-bottom: 2px solid #009879;
                                            }
                                        </style>
                                        <table class="styled-table" style="margin-left: 70%;">
                                          <tr>
                                            @foreach($accounts as $key => $object)
                                            <th>{{$object->funding_name}}</th>
                                            @endforeach
                                            <th>Total Fundings</th>
                                        </tr>
                                        <tr>
                                            @if($projectshow->basecurrency_id != '')
                                            <td>{{$projectshow->basecurrency->currency_code}} @convert($fundingonetotal)</td>
                                            <td>{{$projectshow->basecurrency->currency_code}} @convert($fundingtwototal)</td>
                                            <td>{{$projectshow->basecurrency->currency_code}} @convert($fundingtotal)</td>
                                            @else
                                            <td>{{$projectshow->program->basecurrency->currency_code}} @convert($fundingonetotal)</td>
                                            <td>{{$projectshow->program->basecurrency->currency_code}} @convert($fundingtwototal)</td>
                                            <td>{{$projectshow->program->basecurrency->currency_code}} @convert($fundingtotal)</td>
                                            @endif
                                        </tr>

                                    </table>

                                </div>

                                @elseif($containers->planning_type == 'Indicator')

                                <div class="nk-block nk-block-lg">
                                    <div class="nk-block-head">
                                        <div class="nk-block-head-content">
                                            <div class="card card-bordered card-preview">
                                                <div class="card-inner">
                                                    <ul class="nav nav-tabs mt-n3">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" data-bs-toggle="tab" href="#tabItem88">All</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-bs-toggle="tab" href="#tabItem89">Monthly</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-bs-toggle="tab" href="#tabItem90">Bi-Monthly</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-bs-toggle="tab" href="#tabItem91">Quaterly</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-bs-toggle="tab" href="#tabItem92">Semi-Annual</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-bs-toggle="tab" href="#tabItem93">Annual</a>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content">
                                                        <div class="tab-pane active" id="tabItem88">
                                                            <div class="card-inner">
                                                                <table class="datatable-init-export nowrap table" data-export-title="Export">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>Indicator</th>
                                                                            <th>Label</th>
                                                                            <th>Baseline</th>
                                                                            <th>Target</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>

                                                                        <?php $i = 1; ?>
                                                                        @foreach($containers->indicatortarget as $key => $object)
                                                                        <tr>
                                                                            <td>{{$i}}</td>
                                                                            <td>{{ $object->indicator->indicator_title}}</td>
                                                                            <td>{{ $object->label }}</td>
                                                                            <th>{{ $object->baseline }}</th>
                                                                            <td>{{ $object->target }}</td>
                                                                        </tr>
                                                                        <?php $i++; ?>
                                                                        @endforeach

                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>

                                                        <div class="tab-pane" id="tabItem89">

                                                            <div class="card-inner">
                                                                <table class="datatable-init-export nowrap table" data-export-title="Export">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <!-- <th>Indicator</th> -->
                                                                            <th>Label</th>
                                                                            <th>January</th>
                                                                            <th>February</th>
                                                                            <th>March</th>
                                                                            <th>April</th>
                                                                            <th>May</th>
                                                                            <th>June</th>
                                                                            <th>July</th>
                                                                            <th>August</th>
                                                                            <th>September</th>
                                                                            <th>October</th>
                                                                            <th>November</th>
                                                                            <th>December</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>


                                                                        <!-- $string = str_replace('[] ', '""', $reporting); -->

                                                                        <?php $i = 1; ?>
                                                                        @foreach ($reporting as  $object)

                                                                        <tr>
                                                                            <td>{{$i}}</td>
                                                                            <td>{{ $object->label }}</td>
                                                                            <th>{{ preg_replace('/["]/', '', $object->january) }}</th>
                                                                            <td>{{ preg_replace('/["]/', '', $object->february) }}</td>
                                                                            <td>{{ preg_replace('/["]/', '', $object->march)}}</td>
                                                                            <td>{{ preg_replace('/["]/', '', $object->april) }}</td>
                                                                            <td>{{ preg_replace('/["]/', '', $object->may) }}</td>
                                                                            <td>{{ preg_replace('/["]/', '', $object->june) }}</td>
                                                                            <td>{{ preg_replace('/["]/', '', $object->july) }}</td>
                                                                            <td>{{ preg_replace('/["]/', '', $object->august) }}</td>
                                                                            <td>{{ preg_replace('/["]/', '', $object->september) }}</td>
                                                                            <td>{{ preg_replace('/["]/', '', $object->october) }}</td>
                                                                            <td>{{ preg_replace('/["]/', '', $object->november) }}</td>
                                                                            <td>{{ preg_replace('/["]/', '', $object->december) }}</td>


                                                                        </tr>
                                                                        <?php $i++; ?>
                                                                        @endforeach

                                                                    </tbody>
                                                                </table>
                                                                <hr>


                                                            </div>

                                                        </div>

                                                        <div class="tab-pane" id="tabItem90">
                                                            <div class="card-inner">
                                                                <table class="datatable-init table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <!-- <th>Indicator</th> -->
                                                                            <th>Label</th>
                                                                            <th>Jan-Feb</th>
                                                                            <th>March-April</th>
                                                                            <th>May-June</th>
                                                                            <th>July-August</th>
                                                                            <th>September-October</th>
                                                                            <th>November-December</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>

                                                                        <?php $i = 1; ?>
                                                                        @foreach ($reporting2 as $object)
                                                                        <tr>
                                                                            <td>{{$i}}</td>

                                                                            <td>{{ $object->label }}</td>
                                                                            <!-- <th>{{ $object->baseline }}</th> -->
                                                                            <td>{{ $object->jan_feb }}</td>

                                                                            <td>{{ $object->mar_apr }}</td>
                                                                            <td>{{ $object->may_june }}</td>
                                                                            <td>{{ $object->july_aug }}</td>
                                                                            <td>{{ $object->sep_oct }}</td>
                                                                            <td>{{ $object->nov_dec }}</td>


                                                                        </tr>
                                                                        <?php $i++; ?>
                                                                        @endforeach

                                                                    </tbody>
                                                                </table>
                                                                <hr>


                                                            </div>
                                                        </div>
                                                        <div class="tab-pane" id="tabItem91">
                                                            <div class="card-inner">
                                                                <table class="datatable-init-export nowrap table" data-export-title="Export">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <!-- <th>Indicator</th> -->
                                                                            <th>Label</th>
                                                                            <th>Jan-March</th>
                                                                            <th>Aprill-June</th>
                                                                            <th>July-September</th>
                                                                            <th>October-December</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>

                                                                        <?php $i = 1; ?>
                                                                        @foreach ($reporting3 as $object)
                                                                        <tr>
                                                                            <td>{{$i}}</td>

                                                                            <td>{{ $object->label }}</td>
                                                                            <!-- <th>{{ $object->baseline }}</th> -->
                                                                            <td>{{ $object->jan_march }}</td>

                                                                            <td>{{ $object->april_june }}</td>
                                                                            <td>{{ $object->july_september }}</td>
                                                                            <td>{{ $object->october_december }}</td>


                                                                        </tr>
                                                                        <?php $i++; ?>
                                                                        @endforeach

                                                                    </tbody>
                                                                </table>
                                                                <hr>


                                                            </div>
                                                        </div>
                                                        <div class="tab-pane" id="tabItem92">
                                                         <div class="card-inner">
                                                            <table class="datatable-init-export nowrap table" data-export-title="Export">
                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <!-- <th>Indicator</th> -->
                                                                        <th>Label</th>
                                                                        <th>Jan-June</th>
                                                                        <th>July-December</th>
                                                                                            <!-- <th>July-September</th>
                                                                                                <th>October-December</th> -->
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>

                                                                                            <?php $i = 1; ?>
                                                                                            @foreach ($reporting4 as $object)
                                                                                            <tr>
                                                                                                <td>{{$i}}</td>

                                                                                                <td>{{ $object->label }}</td>
                                                                                                <!-- <th>{{ $object->baseline }}</th> -->
                                                                                                <td>{{ $object->jan_june }}</td>

                                                                                                <td>{{ $object->july_december }}</td>
                                                                                            <!-- <td>{{ $object->july_september }}</td>
                                                                                                <td>{{ $object->october_december }}</td> -->


                                                                                            </tr>
                                                                                            <?php $i++; ?>
                                                                                            @endforeach

                                                                                        </tbody>
                                                                                    </table>
                                                                                    <hr>


                                                                                </div>
                                                                            </div>
                                                                            <div class="tab-pane" id="tabItem93">
                                                                                <div class="card-inner">
                                                                                    <table class="datatable-init-export nowrap table" data-export-title="Export">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th>#</th>
                                                                                                <!-- <th>Indicator</th> -->
                                                                                                <th>Label</th>
                                                                                                <!-- <th>Jan-June</th> -->
                                                                                                <th>Jan-December</th>
                                                                                            <!-- <th>July-September</th>
                                                                                                <th>October-December</th> -->
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>

                                                                                            <?php $i = 1; ?>
                                                                                            @foreach ($reporting5 as $object)
                                                                                            <tr>
                                                                                                <td>{{$i}}</td>

                                                                                                <td>{{ $object->label }}</td>
                                                                                                <!-- <th>{{ $object->baseline }}</th> -->
                                                                                                <td>{{ $object->jan_december }}</td>

                                                                                            <!-- <td>{{ $object->april_june }}</td>
                                                                                            <td>{{ $object->july_september }}</td>
                                                                                            <td>{{ $object->october_december }}</td> -->


                                                                                        </tr>
                                                                                        <?php $i++; ?>
                                                                                        @endforeach

                                                                                    </tbody>
                                                                                </table>
                                                                                <hr>


                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                @endif
                                                @if($containers->status == '01')
                                                <h6 class="title"><span class="badge bg-warning">Draft</span> 
                                                    @elseif($containers->status == '02')    
                                                    <h6 class="title"><span class="badge bg-success">Submitted</span> 
                                                        @elseif($containers->status == '03')    
                                                        <h6 class="title"><span class="badge bg-success">Forwarded</span> 
                                                            @elseif($containers->status == '04')    
                                                            <h6 class="title"><span class="badge bg-success">Approved</span> 
                                                                @elseif($containers->status == '05')    
                                                                <h6 class="title"><span class="badge bg-success">Rejected</span> 
                                                                    @endif

                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <br>
                                                <hr>
                                                @endforeach  
                                            </div>
                                        </div>
                                    </div>


                                </div>



                            </div>


                            <div class="tab-pane" id="tabItem3">

                                <script type="text/javascript">
                                  $(function(){
                                    $('#funding1, #funding2').keyup(function(){
                                       var funding1 = parseFloat($('#funding1').val()) || 0;
                                       var funding2 = parseFloat($('#funding2').val()) || 0;
                                       $('#total').val(funding1 + funding2);
                                   });
                                });
                            </script>

                            <script type="text/javascript">
                              $(function(){
                                $('#funding1').keyup(function(){
                                   var funding1 = parseFloat($('#funding1').val()) || 0;
                                   $('#valued').val(funding1);
                               });
                            });
                        </script>

                        <script type="text/javascript">
                          $(function(){
                            $('#funding2').keyup(function(){
                               var funding2 = parseFloat($('#funding2').val()) || 0;
                               $('#valuee').val(funding2);
                           });
                        });
                    </script>
                    <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
                        <!--begin::Subheader-->
                        <div class="subheader py-2 py-lg-4  subheader-solid " id="kt_subheader">
                            <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                                <!--begin::Info-->
                                <div class="d-flex align-items-center flex-wrap mr-2">
                                    <!--begin::Page Title-->
                                    <h6 class="text-dark font-weight-bolder mt-2 mb-2 mr-10">
                                        Interventions
                                    </h6>
                                </div>
                                <!--end::Info-->
                                <div class="d-flex align-items-center">
                                    <div class="d-flex align-items-center">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalZoom8787">Add Intervention Container</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="nk-block nk-block-lg">
                            <div class="card card-bordered card-preview">
                                <div class="card-inner">
                                    @foreach($intervencontainers as $key1 => $incontainer)
                                    <div id="" class="accordion">
                                        <div class="accordion-item">
                                            <div class="dropdown">
                                                <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                                    <ul class="link-list-plain">
                                                        @if($incontainer->status == '01')
                                                        <li class="preview-item">
                                                            <button type="button" class="btn btn-success icon ni ni-plus" id="addintervention12" data-id="{{ $incontainer->id }}" data-bs-toggle="modal" data-bs-target="#addintervention1"></em>Add Intervention</button>
                                                        </li> 

                                                        <li class="preview-item">
                                                            <button type="button" class="btn btn-success" id="uploadintervention" data-id="{{ $incontainer->id }}" data-bs-toggle="modal" data-bs-target="#uploadintervention1"></em>Upload Excel/CSV</button>
                                                        </li> 

                                                        <li class="preview-item">
                                                            <button type="button" class="btn btn-success icon ni ni-send" id="submitcontainer" data-id="{{ $incontainer->id }}" data-bs-toggle="modal" data-bs-target="#submitcontainer"></em>Submit</button>
                                                        </li> 
                                                        @elseif($incontainer->status == '02') 
                                                        @can('forward-intervention')
                                                        <li class="preview-item">
                                                            <button type="button" class="btn btn-success icon ni ni-forward-arrow" id="forwardintervention2" data-id="{{ $incontainer->id }}" data-bs-toggle="modal" data-bs-target="#forwardintervention1"></em>Forward</button>
                                                        </li> 
                                                        @endcan
                                                        @can('approve-intervention')
                                                        <li class="preview-item">
                                                            <button type="button" class="btn btn-success icon ni ni-done" id="approveintervention2" data-id="{{ $incontainer->id }}" data-bs-toggle="modal" data-bs-target="#approveintervention1"></em>Approve</button>
                                                        </li> 
                                                        @endcan
                                                        @can('reject-intervention')
                                                        <li class="preview-item">
                                                            <button type="button" class="btn btn-danger icon ni ni-done" id="rejectintervention2" data-id="{{ $incontainer->id }}" data-bs-toggle="modal" data-bs-target="#rejectintervention1"></em>Reject</button>
                                                        </li> 
                                                        @endcan
                                                        <li class="preview-item">
                                                            <button type="button" class="btn btn-danger icon ni ni-cross" id="cancelintervention" data-id="{{ $incontainer->id }}" data-bs-toggle="modal" data-bs-target="#cancelintervention1"></em>Cancel</button>
                                                        </li> 

                                                        <li class="preview-item">
                                                            <button type="button" class="btn btn-warning icon ni ni-setting" id="timeline12" data-id="{{ $incontainer->id }}" data-bs-toggle="modal" data-bs-target="#timeline2"></em>Timeline</button>
                                                        </li> 
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="modal fade zoom" tabindex="-1" id="timeline2">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Timeline</h5>
                                                            <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                <em class="icon ni ni-cross"></em>
                                                            </a>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="nk-block nk-block-lg">
                                                                <div class="card card-bordered card-preview">
                                                                    <div class="card-inner">
                                                                        <div class="example-alerts">
                                                                            <div class="gy-4">
                                                                                <div class="example-alert">
                                                                                    <div class="alert alert-success alert-icon">
                                                                                        <em class="icon ni ni-check-circle"></em> <strong>{{$incontainer->container_name}} Created on</strong>
                                                                                        <i>{{$incontainer->created_at}}</i> <strong>created
                                                                                        by </strong>{{Auth::user()->name}}
                                                                                    </div>
                                                                                </div>
                                                                                @if($incontainer->submitted_by != NULL)
                                                                                <div class="example-alert">
                                                                                    <div class="alert alert-secondary alert-icon">
                                                                                        <em class="icon ni ni-alert-circle"></em> <strong>{{$incontainer->container_name}} Submitted on</strong>
                                                                                        <i>{{$incontainer->submitted_on}}</i></strong>
                                                                                        Submitted to <strong>{{$incontainer->submitted_to}} - <i>{{$incontainer->submitted_to_email}}</i></strong>
                                                                                    </div>
                                                                                </div>
                                                                                @endif
                                                                                @if($incontainer->forwarded_on != NULL)
                                                                                <div class="example-alert">
                                                                                    <div class="alert alert-primary alert-icon">
                                                                                        <em class="icon ni ni-alert-circle"></em> <strong>{{$incontainer->container_name}} Forwarded on</strong>
                                                                                        <i>{{$incontainer->forwarded_on}}</i></strong>
                                                                                        Forwarded to <strong>{{$incontainer->forward_to_name}} - <i>{{$incontainer->forward_to_email}}</i></strong>
                                                                                    </div>
                                                                                </div>
                                                                                @endif
                                                                                @if($incontainer->approved_by != NULL)
                                                                                <div class="example-alert">
                                                                                    <div class="alert alert-success alert-icon">
                                                                                        <em class="icon ni ni-check-circle"></em> <strong>{{$incontainer->container_name}} Approved on</strong>
                                                                                        <i>{{$incontainer->approved_on}}</i></strong>
                                                                                        Approved By <strong>{{$incontainer->approved_by}} - <i>{{$incontainer->approved_by_email}}</i></strong>
                                                                                    </div>
                                                                                </div>
                                                                                @endif
                                                                            </div>
                                                                        </div> 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer bg-light">
                                                            <span class="sub-text"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 


                                            <a href="#" class="accordion-head collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-item-1">
                                                <h6 class="title"><span class="badge bg-success">Container Name:</span> {{$incontainer->container_name}}
                                                </h6>
                                                <span class="accordion-icon"></span>
                                            </a>
                                            <div class="accordion-body collapse" id="accordion-item-1" data-bs-parent="#accordion">
                                                <div class="accordion-inner">
                                                    <div class="card card-bordered card-preview">
                                                        <div class="card-inner">
                                                            <table class="datatable-init-export nowrap table" data-export-title="Export">
                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Activity</th>
                                                                        @foreach($accounts as $key => $object)
                                                                        <th>{{$object->funding_name}}</th>
                                                                        @endforeach
                                                                        <th>Total Amount</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php $i = 1; ?>
                                                                    @foreach ($interventions as $key => $object)
                                                                    @if($object->intervention_container_id == $incontainer->id)


                                                                    <tr>
                                                                        <td>{{$i}}</td>
                                                                        <td>{{$object->activity->activity_title}}</td>
                                                                        @if($projectshow->basecurrency_id != '')
                                                                        <td>{{$projectshow->basecurrency->currency_code}} @convert($object->funding1)</td>
                                                                        <td>{{$projectshow->basecurrency->currency_code}} @convert($object->funding2)</td>
                                                                        <td>{{$projectshow->basecurrency->currency_code}} @convert($object->total)</td>
                                                                        @else
                                                                        <td>{{$projectshow->program->basecurrency->currency_code}} @convert($object->funding1)</td>
                                                                        <td>{{$projectshow->program->basecurrency->currency_code}} @convert($object->funding2)</td>
                                                                        <td>{{$projectshow->program->basecurrency->currency_code}} @convert($object->total)</td>
                                                                        @endif
                                                                        <td>
                                                                            <li class="col-sm-6 col-lg-3">
                                                                                <div class="dropdown">
                                                                                    <a href="#" class="btn btn-primary" data-bs-toggle="dropdown"><span>Select Action</span><em class="icon ni ni-chevron-down"></em></a>
                                                                                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-auto mt-1">
                                                                                        <ul class="link-list-opt no-bdr">


                                                                                            <li class="preview-item">
                                                                                                <button type="button" class="btn btn-success icon ni ni-edit" id="editintervention" data-id="{{ $object->id }}" data-bs-toggle="modal" data-bs-target="#editinterventi"></em>Edit Intervention</button>
                                                                                            </li> 
                                                                                            <li class="preview-item">
                                                                                                <button type="button" class="btn btn-success icon ni ni-eye" id="viewintervention" data-id="{{ $object->id }}" data-bs-toggle="modal" data-bs-target="#viewinterventi"></em>View Intervention</button>
                                                                                            </li> 
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                        </td>
                                                                        
                                                                    </tr>
                                                                    <?php $i++; ?>
                                                                    @endif
                                                                    @endforeach  
                                                                </tbody>
                                                            </table>
                                                            <hr>
                                                            <style type="text/css">
                                                                .styled-table thead tr {
                                                                    background-color: #009879;
                                                                    color: #ffffff;
                                                                    text-align: left;
                                                                }

                                                                .styled-table th,
                                                                .styled-table td {
                                                                    padding: 12px 15px;
                                                                }

                                                                .styled-table tbody tr {
                                                                    border-bottom: 1px solid #dddddd;
                                                                }

                                                                .styled-table tbody tr:nth-of-type(even) {
                                                                    background-color: #f3f3f3;
                                                                }

                                                                .styled-table tbody tr:last-of-type {
                                                                    border-bottom: 2px solid #009879;
                                                                }
                                                            </style>
                                                            <table class="styled-table" style="margin-left: 70%;">
                                                              <tr>
                                                                @foreach($accounts as $key => $object)
                                                                <th>{{$object->funding_name}}</th>
                                                                @endforeach
                                                                <th>Total Amount</th>
                                                            </tr>
                                                            <tr>
                                                                <td>{{$projectshow->program->basecurrency->currency_code}} @convert($purchases1)</td>
                                                                <td>{{$projectshow->program->basecurrency->currency_code}} @convert($purchases2)</td>
                                                                <td>{{$projectshow->program->basecurrency->currency_code}} @convert($purchases)</td>
                                                            </tr>

                                                        </table>
                                                        @if($incontainer->status == '01')
                                                        <h6 class="title"><span class="badge bg-warning">Draft</span> 
                                                            @elseif($incontainer->status == '02')    
                                                            <h6 class="title"><span class="badge bg-success">Submitted</span> 
                                                                @elseif($incontainer->status == '03')    
                                                                <h6 class="title"><span class="badge bg-success">Forwarded</span> 
                                                                    @elseif($incontainer->status == '04')    
                                                                    <h6 class="title"><span class="badge bg-success">Approved</span> 
                                                                        @elseif($incontainer->status == '05')    
                                                                        <h6 class="title"><span class="badge bg-success">Rejected</span> 
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <hr>
                                                    @endforeach
                                                </div>

                                            </div>
                                        </div>

                                    </div>


                                    <div class="modal fade zoom" tabindex="-1" id="modalZoom8787">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Intervention Container</h5>
                                                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <em class="icon ni ni-cross"></em>
                                                    </a>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="nk-block nk-block-lg">
                                                        <div class="card card-bordered card-preview">
                                                            <div class="card-inner">
                                                                <ul class="nav nav-tabs mt-n3">
                                                                    <li class="nav-item">
                                                                        <a class="nav-link active" data-bs-toggle="tab" href="#tabItem5fgt56"><em class="icon ni ni-user"></em><span>Intervention</span></a>
                                                                    </li>
                                                                </ul>

                                                                <div class="tab-content">
                                                                    <div class="tab-pane active" id="tabItem5fgt56">
                                                                        <form method="POST" action="{{ route('createicontainer')}}">
                                                                            @csrf
                                                                            <div class="row gy-4">

                                                                             <input type="hidden" class="form-control" value="01" name="status" id="default-01">
                                                                             <input type="hidden" class="form-control" value="{{Auth::user()->id}}" name="created_by" id="default-01">
                                                                             <input type="hidden" class="form-control" value="{{Auth::user()->organization_id}}" name="organization_id" id="default-01">
                                                                             <input type="hidden" class="form-control" value="{{$projectshow->id}}" name="project_id" id="default-01">

                                                                             <div class="form-group">
                                                                                <label class="form-label" for="default-01">Container Name</label>
                                                                                <div class="form-control-wrap">
                                                                                    <input type="text" class="form-control" name="container_name" id="default-01" placeholder="Input Intervention Container Name">
                                                                                </div>
                                                                            </div>

                                                                            <!-- <button type="submit" class="btn btn-primary"></button> -->
                                                                        </div>
                                                                        <br>
                                                                        <button style="margin-left: 40%;" type="submit" class="btn btn-round btn-primary"><em class="icon ni ni-navigate-fill"></em>&nbsp Save Container</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer bg-light">
                                                <span class="sub-text"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="modal fade zoom" tabindex="-1" id="addintervention1">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Add Intervention</h5>
                                                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                    <em class="icon ni ni-cross"></em>
                                                </a>
                                            </div>
                                            <div class="modal-body">
                                                <div class="nk-block nk-block-lg">
                                                    <div class="card card-bordered card-preview">
                                                        <div class="card-inner">
                                                            <ul class="nav nav-tabs mt-n3">
                                                                <li class="nav-item">
                                                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem53434777"><em class="icon ni ni-table"></em><span>Interventions</span></a>
                                                                </li>
                                                            </ul>

                                                            <div class="tab-content">
                                                                <div class="tab-pane active" id="tabItem53434777">
                                                                    <form method="POST" action="{{ route('createIntervention')}}" id="addInterventionValidate">
                                                                        @csrf
                                                                        <div class="row gy-4">

                                                                         <input type="hidden" class="form-control" value="01" name="status" id="default-01">
                                                                         <input type="hidden" class="form-control" id="intervention_container123" name="intervention_container_id">
                                                                         <input type="hidden" class="form-control" value="{{Auth::user()->id}}" name="created_by" id="default-01">
                                                                         <input type="hidden" class="form-control" value="{{Auth::user()->organization_id}}" name="organization_id" id="default-01">
                                                                         <input type="hidden" class="form-control" value="{{$projectshow->id}}" name="project_id" id="default-01">

                                                                         <div class="form-group">

                                                                            <div class="form-group" id="program">
                                                                                <label class="form-label" for="default-06">Select Activity<span style="color:red">*</span></label>
                                                                                <div class="form-control-wrap ">
                                                                                    <div class="form-control-select">
                                                                                        <select id="default-06" name="activity_id" class="form-control" id="activityid">
                                                                                            <option value="">-------Nothing Selected-------</option>
                                                                                            <option></option>                                                  
                                                                                            @foreach($activities as $obj)
                                                                                            <option value="{{$obj->id}}">{{$obj->activity_title}}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                    <!-- <script type="text/javascript">
                                                        $(document).ready(function() {
                                                            $('#activityid').change(function(){
                                                                $.get("{{ url('api/activityname')}}",
                                                                    { option: $(this).val() },
                                                                    function(data) {
                                                                        console.log(data);
                                                                        $('#activitytitle17').val(data);
                                                                    });
                                                            });
                                                        });
                                                    </script> -->

                                                    <script type="text/javascript">
                                                        $(document).ready(function() {
                                                            $('#activityid').change(function(){
                                                                $.get("{{ url('api/activityname')}}",
                                                                    { option: $(this).val() },
                                                                    function(data) {
                                                                        console.log('Service Code');
                                                                        $('#activitytitle17').val(data);
                                                                    });
                                                            });
                                                        });
                                                    </script>

                                                    <!-- <div class="form-group">
                                                        <label class="form-label" for="default-01">Activity Title</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" name="activity_title" id="activitytitle17">
                                                        </div>
                                                    </div> -->

                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <h6>Fundings</h6>
                                                                @foreach ($accounts as $key => $object)
                                                                <th scope="col">{{ $object->funding_name }}</th>
                                                                @endforeach

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <td>
                                                                <label class="form-label" for="default-01">Required<span style="color:red">*</span></label>
                                                                <input type="text" placeholder="e.g 200" class="form-control" name="funding1" id="funding1">
                                                            </td>
                                                            <br>
                                                            <td>
                                                                <label class="form-label" for="default-01">Required<span style="color:red">*</span></label>
                                                                <input type="text" placeholder="e.g 500" class="form-control" name="funding2" id="funding2">
                                                            </td>
                                                        </tbody>
                                                    </table>




                                                    <div class="form-group">
                                                        <label class="form-label" for="default-01">Total Amount<span style="color:red">*</span></label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" placeholder="Auto Calculation" class="form-control" name="total" id="total" readonly="">
                                                        </div>
                                                    </div>





                                                    <td><input type="hidden" name="valued" id="valued" readonly=""></td>
                                                    <td><input type="hidden" name="valuee" id="valuee" readonly=""></td>



                                                </div>

                                                <!-- <button type="submit" class="btn btn-primary"></button> -->
                                            </div>
                                            <br>
                                            <button style="margin-left: 40%;" type="submit" class="btn btn-round btn-primary"><em class="icon ni ni-navigate-fill"></em>&nbsp Save Intervention</button>
                                        </form>

                                        <script>
                                            $(document).ready(function() {
                                                $("#addInterventionValidate").validate({
                                                    rules: {
                                                        funding1: {
                                                            required: true,
                                                            digits: true
                                                        },
                                                        funding2: {
                                                            required: true,
                                                            digits: true
                                                        },
                                                        activity_name: {
                                                            required: true,
                                                        }
                                                    },
                                                    messages: {
                                                        funding1: {
                                                            required: "Please enter the amount in numbers",
                                                            minlength: "Your funding must consist of at least 1 number 0-9"
                                                        },
                                                        funding2: {
                                                            required: "Please enter the amount in numbers",
                                                            minlength: "Your funding must consist of at least 1 number 0-9"
                                                        },
                                                        activity_name: {
                                                            required: "Please Select Activity",
                                                        }
                                                        
                                                    },
                                                    submitHandler: function(form) {
                                                        form.submit();
                                                    }
                                                });
                                            });
                                        </script>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <span class="sub-text"></span>
                </div>
            </div>
        </div>
    </div>

</div>




<div class="tab-pane" id="tabItem4">
    <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-4  subheader-solid " id="kt_subheader">
            <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex align-items-center flex-wrap mr-2">
                    <!--begin::Page Title-->
                    <h6 class="text-dark font-weight-bolder mt-2 mb-2 mr-10">
                        {{$logframes->logframe_name}}<span class="text-muted"> - Logframe design</span>
                    </h6>
                    <button class="btn btn-icon btn-circle w-30px h-30px btn-hover-success shadow" data-toggle="modal" data-target="#addGoalDialog" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Add Goal">
                        <i class="flaticon2-plus text-dark icon-nm"></i>
                    </button>
                </div>
                <!--end::Info-->
                <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addGoalDialog">Add Goal</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="nk-block nk-block-lg">
            <div class="card card-bordered card-preview">
                <div class="card-inner">
                    @if($loopgoals != null)
                    @foreach($loopgoals as $obj)
                    <div id="accordion" class="accordion">
                        <div class="accordion-item">
                            <div class="dropdown">
                                <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                    <ul class="link-list-plain">
                                        <li class="preview-item">
                                            <button type="button" class="btn btn-success icon ni ni-plus" id="editCompany" data-id="{{ $obj->id }}" data-bs-toggle="modal" data-bs-target="#practice_modal"></em>Add Outcome</button>
                                        </li> 
                                        <li class="preview-item">
                                            <button type="button" class="btn btn-success icon ni ni-plus" id="addactivity" data-id="{{ $obj->id }}" data-bs-toggle="modal" data-bs-target="#activity_modal"></em>Add Activity</button>
                                        </li> 
                                        <li class="preview-item">
                                            <button type="button" class="btn btn-success icon ni ni-plus" id="addindicator" data-id="{{ $obj->id }}" data-bs-toggle="modal" data-bs-target="#indicator_modal"></em>Add Indicator</button>
                                        </li> 
                                        <li class="preview-item">
                                            <button type="button" class="btn btn-success icon ni ni-edit" id="editgoal" data-id="{{ $obj->id }}" data-bs-toggle="modal" data-bs-target="#editgoal_modal"></em>Edit Goal</button>
                                        </li> 
                                        <li class="preview-item">
                                            <button type="button" class="btn btn-success icon ni ni-trash" id="deletegoal" data-id="{{ $obj->id }}" data-bs-toggle="modal" data-bs-target="#deletegoal"></em>Delete Goal</button>
                                        </li> 
                                    </ul>
                                </div>
                            </div>

                            <a href="#" class="accordion-head collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-item-1">
                                <h6 class="title"><span class="badge bg-success">GOAL</span> {{$obj->goal_code}} -  {{$obj->goal_name}}
                                </h6>
                                <span class="accordion-icon"></span>
                            </a>
                            <div class="accordion-body collapse" id="accordion-item-1" data-bs-parent="#accordion">
                                <div class="accordion-inner">

                                    @foreach($goalindicator as $goalindicator) 
                                    <div class="dropdown">
                                        <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                            <ul class="link-list-plain">
                                                <li class="preview-item">
                                                    <button type="button" class="btn btn-success icon ni ni-edit" id="editgoalIndicator" data-id="{{ $goalindicator->id }}" data-bs-toggle="modal" data-bs-target="#editindicator_modal"></em>Edit Indicator</button>
                                                </li> 
                                                <li class="preview-item">
                                                    <button type="button" class="btn btn-success icon ni ni-trash" id="deleteindicator" data-id="{{ $goalindicator->id }}" data-bs-toggle="modal" data-bs-target="#deleteindicator"></em>Delete Indicator</button>
                                                </li> 
                                            </ul>
                                        </div>
                                    </div> 
                                    <h6><span class="badge bg-blue">INDICATOR</span> {{$goalindicator->indicator_title}}
                                    </h6>
                                    <hr>
                                    @endforeach

                                    @foreach($activitygoal as $goalactivity) 
                                    <div class="dropdown">
                                        <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                            <ul class="link-list-plain">
                                                <li class="preview-item">
                                                    <button type="button" class="btn btn-success icon ni ni-edit" id="editactivity" data-id="{{ $goalactivity->id }}" data-bs-toggle="modal" data-bs-target="#editactivity_modal"></em>Edit Activity</button>
                                                </li> 
                                                <li class="preview-item">
                                                    <button type="button" class="btn btn-success icon ni ni-trash" id="deleteactivity" data-id="{{ $goalactivity->id }}" data-bs-toggle="modal" data-bs-target="#deleteactivity"></em>Delete Activity</button>
                                                </li> 
                                            </ul>
                                        </div>
                                    </div> 
                                    <h6><span class="badge bg-danger">ACTIVITY</span> {{$goalactivity->activity_code}} -  {{$goalactivity->activity_title}}
                                    </h6>
                                    @endforeach
                                </div>  
                            </div>
                            <!-- <hr> -->
                            @foreach($goaloutcomes as $outcom)
                            <div class="accordion-item">
                                <div class="dropdown">
                                    <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                        <ul class="link-list-plain">
                                            <li class="preview-item">
                                                <button type="button" class="btn btn-success icon ni ni-plus" id="addoutput" data-id="{{ $outcom->id }}" data-bs-toggle="modal" data-bs-target="#output_model"></em>Add Output</button>
                                            </li> 
                                            <li class="preview-item">
                                                <button type="button" class="btn btn-success icon ni ni-plus" id="addoutcomeactivity" data-id="{{ $outcom->id }}" data-bs-toggle="modal" data-bs-target="#activity1"></em>Add Activity</button>
                                            </li>  
                                            <li class="preview-item">
                                                <button type="button" class="btn btn-success icon ni ni-plus" id="addoutcomeindicator" data-id="{{ $outcom->id }}" data-bs-toggle="modal" data-bs-target="#indicator1"></em>Add Indicator</button>
                                            </li>
                                            <li class="preview-item">
                                                <button type="button" class="btn btn-success icon ni ni-edit" id="editoutcome" data-id="{{ $outcom->id }}" data-bs-toggle="modal" data-bs-target="#editoutcome_modal"></em>Edit Outcome</button>

                                            </li> 
                                            <li class="preview-item">
                                                <button type="button" class="btn btn-success icon ni ni-trash" id="deleteoutcome" data-id="{{ $outcom->id }}" data-bs-toggle="modal" data-bs-target="#deleteoutcome"></em>Delete Outcome</button>
                                            </li> 
                                        </ul>
                                    </div>
                                </div>
                                <a href="#" class="accordion-head collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-item-2">
                                    <h6><span class="badge bg-warning">OUTCOME</span> {{$outcom->outcome_code}} - {{$outcom->outcome_title}}
                                    </h6>
                                    <span class="accordion-icon"></span>
                                </a>
                                <div class="accordion-body collapse" id="accordion-item-2" data-bs-parent="#accordion">
                                    <div class="accordion-inner">

                                        @foreach($indicators2 as $outcomeindicator2)
                                        @if($outcomeindicator2->outcome_id == $outcom->id) 
                                        <div class="dropdown">
                                            <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                                <ul class="link-list-plain">
                                                    <li class="preview-item">
                                                        <button type="button" class="btn btn-success icon ni ni-edit" id="editoutcomeindicator" data-id="{{ $outcomeindicator2->id }}" data-bs-toggle="modal" data-bs-target="#editoutcomeindicator"></em>Edit Outcome Indicator</button>
                                                    </li> 
                                                    <li class="preview-item">
                                                        <button type="button" class="btn btn-success icon ni ni-trash" id="deleteoutcomeindicator" data-id="{{ $outcomeindicator2->id }}" data-bs-toggle="modal" data-bs-target="#deleteoutcomeindicator"></em>Delete Outcome Indicator</button>
                                                    </li> 
                                                </ul>
                                            </div>
                                        </div>  
                                        <h6><span class="badge bg-blue">INDICATOR</span>  {{$outcomeindicator2->indicator_title}}
                                        </h6>
                                        @endif
                                        @endforeach

                                        <hr>
                                        @foreach($activity2 as $outcomeactivity)
                                        @if($outcomeactivity->outcome_id == $outcom->id && $outcomeactivity->project_id == $projectshow->id)  
                                        <div class="dropdown">
                                            <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                                <ul class="link-list-plain">
                                                    <li class="preview-item">
                                                        <button type="button" class="btn btn-success icon ni ni-edit" id="editoutcomeactivity" data-id="{{ $outcomeactivity->id }}" data-bs-toggle="modal" data-bs-target="#editoutcomeactivity_modal"></em>Edit Outcome Activity</button>
                                                    </li> 
                                                    <li class="preview-item">
                                                        <button type="button" class="btn btn-success icon ni ni-trash" id="deleteoutcomeactivity" data-id="{{ $outcomeactivity->id }}" data-bs-toggle="modal" data-bs-target="#deleteoutcomeactivity"></em>Delete Outcome Activity</button>
                                                    </li> 
                                                </ul>
                                            </div>
                                        </div> 
                                        <h6><span class="badge bg-danger">ACTIVITY</span> {{$outcomeactivity->activity_code}} -  {{$outcomeactivity->activity_title}}
                                        </h6>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                                <!-- <hr> -->
                                @foreach($projectoutput as $output)    
                                @if($output->outcome_id == $outcom->id)
                                <div class="accordion-item">
                                    <div class="dropdown">
                                        <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                            <ul class="link-list-plain">
                                                <li class="preview-item">
                                                    <button type="button" class="btn btn-success icon ni ni-plus" id="addoutputactivity1" data-id="{{ $output->id }}" data-bs-toggle="modal" data-bs-target="#activity2"></em>Add Activity</button>
                                                </li> 
                                                <li class="preview-item">
                                                    <button type="button" class="btn btn-success icon ni ni-plus" id="addoutputindicator" data-id="{{ $output->id }}" data-bs-toggle="modal" data-bs-target="#indicator2"></em>Add Indicator</button>
                                                </li> 
                                                <li class="preview-item">
                                                    <button type="button" class="btn btn-success icon ni ni-edit" data-bs-toggle="modal" data-bs-target="#editoutput_modal" id="editoutput" data-id="{{ $output->id }}"></em>Edit Output</button>
                                                </li> 
                                                <li class="preview-item">
                                                    <button type="button" class="btn btn-success icon ni ni-trash" id="deleteoutput" data-id="{{ $output->id }}" data-bs-toggle="modal" data-bs-target="#deleteoutput"></em>Delete Output</button>
                                                </li> 
                                            </ul>
                                        </div>
                                    </div> 

                                    <a href="#" class="accordion-head collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-item-3">
                                        <h6><span class="badge bg-purple">OUTPUT</span> {{$output->output_code}} - {{$output->output_name}}
                                        </h6>
                                        <span class="accordion-icon"></span>
                                    </a>
                                    <div class="accordion-body collapse" id="accordion-item-3" data-bs-parent="#accordion">
                                        <div class="accordion-inner">

                                           @foreach($outoutindicator2 as $outputindicator2)
                                           @if($outputindicator2->output_id == $output->id) 
                                           <div class="dropdown">
                                            <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                                <ul class="link-list-plain">
                                                    <li class="preview-item">
                                                        <button type="button" class="btn btn-success icon ni ni-edit" id="editoutputindicator" data-id="{{ $outputindicator2->id }}" data-bs-toggle="modal" data-bs-target="#editoutputindicator"></em>Edit Output Indicator</button>
                                                    </li> 
                                                    <li class="preview-item">
                                                        <button type="button" class="btn btn-success icon ni ni-trash" id="deleteoutputindicator" data-id="{{ $outputindicator2->id }}" data-bs-toggle="modal" data-bs-target="#deleteoutputindicator"></em>Delete Output Indicator</button>
                                                    </li> 
                                                </ul>
                                            </div>
                                        </div>  
                                        <h6><span class="badge bg-blue">INDICATOR</span>  {{$outputindicator2->indicator_title}}
                                        </h6>
                                        @endif
                                        @endforeach

                                        <hr>

                                        @foreach($outputactivity2 as $outputactv)
                                        @if($outputactv->output_id == $output->id && $outputactv->project_id == $projectshow->id)  
                                        <div class="dropdown">
                                            <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                                <ul class="link-list-plain">
                                                    <li class="preview-item">
                                                        <button type="button" class="btn btn-success icon ni ni-edit" id="editoutputcomeactivity" data-id="{{ $outputactv->id }}" data-bs-toggle="modal" data-bs-target="#editoutputactivity_modal"></em>Edit Output Activity</button>
                                                    </li> 
                                                    <li class="preview-item">
                                                        <button type="button" class="btn btn-success icon ni ni-trash" id="deleteoutputactivity" data-id="{{ $outputactv->id }}" data-bs-toggle="modal" data-bs-target="#deleteoutputactivity"></em>Delete Output Activity</button>
                                                    </li> 
                                                </ul>
                                            </div>
                                        </div>
                                        <h6><span class="badge bg-danger">ACTIVITY</span> {{$outputactv->activity_code}} -  {{$outputactv->activity_title}}
                                        </h6>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach

                        </div>

                        @endforeach
                        
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div class="tab-pane" id="tabItem5">
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class="datatable-init table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Funding</th>
                        <th>Funding Type</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    @foreach ($accounts as $key => $object)
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{ $object->funding_name }}</td>
                        <td>{{ $object->funding_type }}</td>                                         
                        <td>
                            <a class="btn btn-primary" href="#">Edit</a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="tab-pane" id="tabItem6">

    <div class="d-flex align-items-center">
        <div class="d-flex align-items-center">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addusers">Add Project User</button>
        </div>
    </div>
    <br>
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class="datatable-init table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <!-- <th>Role</th> -->
                        <!-- <th>Action</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    @foreach ($projectusers as $key => $object)
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{ $object->name }}</td>
                    </tr>
                    <?php $i++; ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="tab-pane" id="tabItem8">
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class="datatable-init table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Budget</th>
                        <th>Funding</th>
                        <th>Annual Budget</th>
                        <th>Total Expense</th>
                        <th>Reporting Frequency</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    @foreach ($projectexpenses as $key => $object)
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{ $object->budget_id }}</td>
                        <td>{{ $object->funding_id }}</td>
                        <td>{{ $object->total_budget }}</td>
                        <td>{{ $object->total_expense }}</td>
                        <td>{{ $object->reporting_frequency_tally }}</td>
                    </tr>
                    <?php $i++; ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="tab-pane" id="tabItem7">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addprogdoc">Add Project Document</button>
    <br>
    <br>
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class="datatable-init table">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>File Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    @foreach ($documents as $key => $object)
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{ $object->doc_name }}</td>
                        <td>
                            @if($object->status == '01')
                            <span class="badge bg-gray">Draft</span></h6>
                            @elseif($object->status == '02')
                            <span class="badge bg-success">Approved</span></h6>
                            @endif
                        </td>
                        <td>
                            <ul class="nk-tb-actions gx-1 my-n1">
                                <li class="me-n1">
                                    <div class="dropdown">
                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul class="link-list-opt no-bdr">
                                                <li><a href="{{ url('download/'.$object->id)}}"><em class="icon ni ni-download"></em><span>Download Document</span></a></li>
                                                <li><a href="{{ url('documentview/'.$object->id)}}"><em class="icon ni ni-eye"></em><span>Archive Document</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    <?php $i++; ?>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade zoom" tabindex="-1" id="addprogdoc">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Project Document</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">

                    <form method="POST" action="{{ route('documents.store')}}" enctype="multipart/form-data">
                        @csrf

                        <div class="row gy-4">

                            <div class="form-group">
                                <label class="form-label" for="default-01">Document Name</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="doc_name" class="form-control" id="default-01" placeholder="Input Document Name">
                                </div>
                            </div>

                            <input type="hidden" name="user_id" class="form-control" value="{{Auth::user()->id}}">
                            <input type="hidden" name="status" class="form-control" value="01">
                            <input type="hidden" name="project_id" class="form-control" value="{{$projectshow->id}}">
                            <input type="hidden" name="organization_id" class="form-control" value="{{Auth::user()->organization_id}}">

                            <div class="form-group">
                                <label class="form-label" for="default-01">Browse Document</label>
                                <div class="form-control-wrap">
                                    <input type="file" name="file" class="form-control" id="default-01">
                                </div>
                            </div>  
                        </div>
                        <br>
                        <button style="margin-left: 40%;" type="submit" class="btn btn-round btn-primary"><em class="icon ni ni-navigate-fill"></em>&nbsp Upload</button>
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
</div>


<div class="modal fade zoom" tabindex="-1" id="modalZoom121">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Container Approval</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="nk-block nk-block-lg">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <ul class="nav nav-tabs mt-n3">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem53434"><em class="icon ni ni-user"></em><span>Annual Work Plan</span></a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem53434">
                                    <form method="POST" action="{{ route('createwpcontainer')}}">
                                        @csrf
                                        <div class="row gy-4">

                                          <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label" for="default-textarea">Approval Comment</label>
                                                <div class="form-control-wrap">
                                                    <textarea class="form-control no-resize" name="approval_comment" id="default-textarea"></textarea>
                                                </div>
                                            </div>
                                        </div> 

                                        <button type="submit" class="btn btn-primary">Approve</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer bg-light">
            <span class="sub-text"></span>
        </div>
    </div>
</div>
</div>


<!-- Create Project Goal Indicator---->
<script>
    $(document).ready(function(){
        $('#baseline').hide();
        $('#target').hide();
        $('#label').hide();
        $('#baseline1').hide();
        $('#target1').hide();
        $('#Disaggregation').hide();

        $('#disaggregation').change(function(){
          if($(this).val() == 'none'){
            $('#baseline').show();
            $('#target').show();
            $('#label').show();
            $('#Disaggregation').hide();
        }else if($(this).val() == 'Disaggregation'){
            $('#Disaggregation').show();
            $('#baseline').hide();
            $('#target').hide();
            $('#label').hide();
        }else if($(this).val() == 'ALIENID'){
            $('#document_number').show();
        }
        else{
           $('#null').show('');
       }
   });
    });

</script>

<div class="modal fade zoom" tabindex="-1" id="indicator_modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Project Goal Indicator</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">

                <form id="projectgoalindicator">
                    @csrf
                    <div class="row gy-4">

                        <div class="form-group">
                            <label class="form-label" for="default-01">Goal</label>
                            <div class="form-control-wrap">
                                <input type="text" name="goal_name" class="form-control" id="default-01" placeholder=""
                                value="{{$goalframe->goal_code}} - {{$goalframe->goal_name}}" readonly="">
                            </div>
                        </div>


                        <input type="hidden" name="created_by" class="form-control" value="{{Auth::user()->id}}" readonly="">
                        <input type="hidden" name="organization_id" class="form-control" value="{{Auth::user()->organization_id}}" readonly="">
                        <input type="hidden" name="project_id" class="form-control" value="{{$projectshow->id}}" readonly="">
                        <input type="hidden" name="goal_id" class="form-control" value="{{$goalframe->id}}" readonly="">
                        <input type="hidden" name="status" class="form-control" value="01" readonly="">



                        <div class="form-group">
                            <label class="form-label" for="default-01">Indicator Title<span style="color:red">*</span></label>
                            <div class="form-control-wrap">
                                <input type="text" name="indicator_title" class="form-control" id="indicator_title" placeholder="Enter Indicator Title">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="default-06">Reporting Frequency<span style="color:red">*</span></label>
                            <div class="form-control-wrap ">
                                <div class="form-control-select">
                                    <select class="form-control" name="reporting_frequency" id="reporting_frequency">
                                        <option value="">-------Select Reporting Frequency-------</option>
                                        <option></option>
                                        <option value="Monthly">Monthly</option>
                                        <option value="Bi-Monthly">Bi-Monthly</option>
                                        <option value="Quaterly">Quaterly</option>
                                        <option value="Semi-Annual">Semi-Annual</option>
                                        <option value="Annual">Annual</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="default-06">Type<span style="color:red">*</span></label>
                            <div class="form-control-wrap ">
                                <div class="form-control-select">
                                    <select class="form-control" name="type" id="type">
                                        <option value="">-------Select Type-------</option>
                                        <option></option>
                                        <option value="Quantitative">Quantitative</option>
                                        <option value="Qualitative">Qualitative</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="default-06">Disaggregation<span style="color:red">*</span></label>
                            <div class="form-control-wrap ">
                                <div class="form-control-select">
                                    <select class="form-control" name="disaggregation" id="disaggregation">
                                        <option value="">-------Select Disaggregation-------</option>
                                        <option></option>
                                        <!-- <option value="none">None</option> -->
                                        <option value="Disaggregation">Disaggregation</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-4 col-sm-6">
                            <div class="form-group" id="label">
                                <label class="form-label" for="default-01">Label</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="label_none" class="form-control" id="default-01" placeholder="Input Label">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6">
                            <div class="form-group" id="baseline">
                                <label class="form-label" for="default-01">Baseline</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="baseline_none" class="form-control" id="default-01" placeholder="Input Baselime">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6">
                            <div class="form-group" id="target">
                                <label class="form-label" for="default-01">Target</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="target_none" class="form-control" id="default-01" placeholder="Input Target">
                                </div>
                            </div>
                        </div>


                        <div role="tabpanel" class="tab-pane" id="Disaggregation">

                            <!-- <h4 align="center"><strong>Disaggregation</strong></h4> -->
                            <div id='ncontainer'>

                              <table id="nextkin" border="1" cellspacing="0">
                                <tr>
                                  <th><input class='ncheck_all' type='checkbox' onclick="select_all()"/></th>
                                  <th>#</th>
                                  <th>Label</th>
                                  <th>Baseline</th>
                                  <th>Target</th>
                              </tr>
                              <tr>
                                  <td><input type='checkbox' class='ncase'/></td>
                                  <td><span id='nsnum'>1.</span></td>
                                  <td><input class="form-control" type='text' id='dvalue' name='dvalue[0]' value="{{{ Input::old('dvalue[0]') }}}"/></td>
                                  <td><input class="form-control" type='text' id='dbaseline' name='dbaseline[0]' value="{{{ Input::old('dbaseline[0]') }}}"/></td>
                                  <td><input class="form-control" type='text' id='dtarget' name='dtarget[0]' value="{{{ Input::old('dtarget[0]') }}}"/></td>

                              </tr>
                          </table>

                          <button type="button" class='ndelete'>- Delete</button>
                          <button type="button" class='naddmore'>+ Add More</button>
                      </div>
                      <script>
                        $(".ndelete").on('click', function() {
                          if($('.ncase:checkbox:checked').length > 0){
                            if (window.confirm("Are you sure you want to delete this Disaggregation detail(s)?"))
                            {
                              $('.ncase:checkbox:checked').parents("#nextkin tr").remove();
                              $('.ncheck_all').prop("checked", false);
                              check();
                          }else{
                              $('.ncheck_all').prop("checked", false);
                              $('.ncase').prop("checked", false);
                          }
                      }
                  });
                        var i=2;
                        $(".naddmore").on('click',function(){
                          count=$('#nextkin tr').length;
                          var data="<tr><td><input type='checkbox' class='ncase'/></td><td><span id='nsnum"+i+"'>"+count+".</span></td>";

                          data +="<td><input class='form-control' type='text' id='dvalue"+i+"' name='dvalue["+(i-1)+"]' value='{{{ Input::old('dvalue["+(i-1)+"]') }}}'/></td><td><input class='form-control' type='text' id='dbaseline"+i+"' name='dbaseline["+(i-1)+"]' value='{{{ Input::old('dbaseline["+(i-1)+"]') }}}'/></td><td><input class='form-control' type='text' id='dtarget"+i+"' name='dtarget["+(i-1)+"]' value='{{{ Input::old('dtarget["+(i-1)+"]') }}}'/></td>";
                          $('#nextkin').append(data);
                          i++;
                      });

                        function select_all() {
                          $('input[class=ncase]:checkbox').each(function(){
                            if($('input[class=ncheck_all]:checkbox:checked').length == 0){
                              $(this).prop("checked", false);
                          } else {
                              $(this).prop("checked", true);
                          }
                      });
                      }

                      function check(){
                          obj=$('#nextkin tr').find('span');
                          $.each( obj, function( key, value ) {
                            id=value.id;
                            $('#'+id).html(key+1);
                        });
                      }

                  </script>
              </div>

              <div class="col-sm-12">
                <div class="form-group">
                    <label class="form-label" for="default-textarea">Indicator Description<i><span style="color:grey">(Optional)</span></i></label>
                    <div class="form-control-wrap">
                        <textarea class="form-control no-resize" name="indicator_description" id="default-textarea"></textarea>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Add Goal Indicator</button>
        </div>

    </form>

    <script>
        $(document).ready(function() {
            $("#projectgoalindicator").validate({
                rules: {
                    indicator_title: {
                        required: true,
                        minlength: 5
                    },
                    reporting_frequency: {
                        required: true,
                    },
                    type: {
                        required: true,
                    },
                    disaggregation: {
                        required: true,

                    },
                    dvalue: {
                        required: true,
                        digits: true
                    },
                    dbaseline: {
                        required: true,
                        digits: true
                    },
                    dtarget: {
                        required: true,
                        digits: true
                    }
                },
                messages: {
                    indicator_title: {
                        required: "Please enter program name",
                        minlength: "Your program name must consist of at least 5 characters and above"
                    },
                    reporting_frequency: {
                        required: "Please select end date",

                    },
                    type: {
                        required: "Please select start date",

                    },
                    disaggregation: {
                        required: "Please Select Base Currency",
                    }

                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            var activeTab = localStorage.getItem('activeTab');
            if (activeTab) {
                $('#tabMenu').removeClass('active');
                $(activeTab).addClass('active');
                $('#tabMenu a[href="' + activeTab + '"]').tab('show');
            }

                        // Save the active tab to local storage
            $('#tabMenu a').on('shown.bs.tab', function (e) {
                localStorage.setItem('activeTab', $(e.target).attr('href'));
            });

            $('#projectgoalindicator').on('submit', function(e) {
                e.preventDefault();
                            // location.reload();
                $.ajax({
                    url: "{{ route('addgoalindicator')}}",
                    type: "POST",
                    data: $(this).serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            location.reload();
                                        // alert('Output Added Successfully!.');
                        } else {
                            alert('An error occurred while saving.');
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('An error occurred: ' + error);
                    }
                });
            });
        });
    </script>
</div>
</div>
</div>
</div>


<!-- Add Project Goal Outcome -->

<div class="modal fade zoom" tabindex="-1" id="practice_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Project Goal Outcome</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">

                <form id="projectgoaloutcome">
                    @csrf
                    <div class="row gy-4">

                        <div class="form-group">
                            <label class="form-label" for="default-01">Goal Name</label>
                            <div class="form-control-wrap">
                                <input type="text" name="outcome_goal" class="form-control" id="outcome_goal" placeholder=""
                                value="{{$goalframe->goal_code}} - {{$goalframe->goal_name}}" readonly="">
                            </div>
                        </div>

                        <input type="hidden" name="created_by" class="form-control" value="{{Auth::user()->id}}" readonly="">
                        <input type="hidden" name="organization_id" class="form-control" value="{{Auth::user()->organization_id}}" readonly="">
                        <input type="hidden" name="project_id" class="form-control" value="{{$projectshow->id}}" readonly="">
                        <input type="hidden" name="goal_id" class="form-control" value="{{$goalframe->id}}" readonly="">
                        <input type="hidden" name="status" class="form-control" value="01" readonly="">



                        <div class="form-group">
                            <label class="form-label" for="default-01">OutCome Title<span style="color:red">*</span></label>
                            <div class="form-control-wrap">
                                <input type="text" name="outcome_title" class="form-control" id="outcome_title" placeholder="Enter Outcome Title">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="default-01">OutCome code<i><span style="color:grey">(Optional)</span></i></label>
                            <div class="form-control-wrap">
                                <input type="text" name="outcome_code" class="form-control" id="outcome_code" placeholder="Enter outcome Code">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-label" for="default-textarea">Outcome Description<i><span style="color:grey">(Optional)</span></i></label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control no-resize" name="outcome_description" id="default-textarea"></textarea>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Goal Outcome</button>
                    </div>
                </form>
                <script>
                    $(document).ready(function() {
                        $("#projectgoaloutcome").validate({
                            rules: {
                                outcome_title: {
                                    required: true,
                                    minlength: 5
                                }
                            },
                            messages: {
                                outcome_title: {
                                    required: "Please Enter Outcome Title",
                                    minlength: "Your Outcome Title must consist of at least 5 characters and above"
                                }
                            },
                            submitHandler: function(form) {
                                form.submit();
                            }
                        });
                    });
                </script>
                <script>
                    $(document).ready(function() {
                        var activeTab = localStorage.getItem('activeTab');
                        if (activeTab) {
                            $('#tabMenu').removeClass('active');
                            $(activeTab).addClass('active');
                            $('#tabMenu a[href="' + activeTab + '"]').tab('show');
                        }

                        // Save the active tab to local storage
                        $('#tabMenu a').on('shown.bs.tab', function (e) {
                            localStorage.setItem('activeTab', $(e.target).attr('href'));
                        });

                        $('#projectgoaloutcome').on('submit', function(e) {
                            e.preventDefault();
                            // location.reload();
                            $.ajax({
                                url: "{{ route('outcomes.store')}}",
                                type: "POST",
                                data: $(this).serialize(),
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(response) {
                                    if (response.success) {
                                        location.reload();
                                        // alert('Output Added Successfully!.');
                                    } else {
                                        alert('An error occurred while saving.');
                                    }
                                },
                                error: function(xhr, status, error) {
                                    alert('An error occurred: ' + error);
                                }
                            });
                        });
                    });
                </script>


            </div>
        </div>
    </div>
</div>

<!-- Add Project Goal Activity -->

<div class="modal fade zoom" tabindex="-1" id="activity_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Project Goal Activity</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">

                <form id="projectgoalactivity">
                    @csrf

                    <div class="row gy-4">

                        <input type="hidden" name="created_by" class="form-control" value="{{Auth::user()->id}}" readonly="">
                        <input type="hidden" name="organization_id" class="form-control" value="{{Auth::user()->organization_id}}" readonly="">
                        <input type="hidden" name="project_id" class="form-control" value="{{$projectshow->id}}" readonly="">
                        <input type="hidden" name="status" class="form-control" value="01" readonly="">
                        <input type="hidden" name="goal_id" class="form-control" value="{{$goalframe->id}}" readonly="">


                        <div class="form-group">
                            <label class="form-label" for="default-01">Goal</label>
                            <div class="form-control-wrap">
                                <input type="text" name="activity_name" class="form-control" id="default-01" placeholder=""
                                value="{{$goalframe->goal_code}} - {{$goalframe->goal_name}}" readonly="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="default-01">Activity Title<span style="color:red">*</span></label>
                            <div class="form-control-wrap">
                                <input type="text" name="activity_title" class="form-control" id="activity_title" placeholder="Enter Activity Title">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="default-01">Activity code<i><span style="color:grey">(Optional)</span></i></label>
                            <div class="form-control-wrap">
                                <input type="text" name="activity_code" class="form-control" id="activity_code" placeholder="Enter Activity Code">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-label" for="default-textarea">Activity Description<i><span style="color:grey">(Optional)</span></i></label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control no-resize" name="activity_description" id="default-textarea"></textarea>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Activity</button>
                    </div>

                </form>

                <script>
                    $(document).ready(function() {
                        $("#projectgoalactivity").validate({
                            rules: {
                                activity_title: {
                                    required: true,
                                    minlength: 5
                                }
                            },
                            messages: {
                                activity_title: {
                                    required: "Please Enter Activity Title",
                                    minlength: "Your Activity Title must consist of at least 5 characters and above"
                                }
                            },
                            submitHandler: function(form) {
                                form.submit();
                            }
                        });
                    });
                </script>

                <script>
                    $(document).ready(function() {
                        var activeTab = localStorage.getItem('activeTab');
                        if (activeTab) {
                            $('#tabMenu').removeClass('active');
                            $(activeTab).addClass('active');
                            $('#tabMenu a[href="' + activeTab + '"]').tab('show');
                        }

                        // Save the active tab to local storage
                        $('#tabMenu a').on('shown.bs.tab', function (e) {
                            localStorage.setItem('activeTab', $(e.target).attr('href'));
                        });

                        $('#projectgoalactivity').on('submit', function(e) {
                            e.preventDefault();
                            // location.reload();
                            $.ajax({
                                url: "{{ route('activities.store')}}",
                                type: "POST",
                                data: $(this).serialize(),
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(response) {
                                    if (response.success) {
                                        location.reload();
                                        // alert('Output Added Successfully!.');
                                    } else {
                                        alert('An error occurred while saving.');
                                    }
                                },
                                error: function(xhr, status, error) {
                                    alert('An error occurred: ' + error);
                                }
                            });
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>


<!-- Add Project Outcome Output -->

<div class="modal fade zoom" tabindex="-1" id="output_model">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Project Outcome Output</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">

                <form id="projectoutcomeoutput">
                    @csrf

                    <div class="row gy-4">

                        <div class="form-group">
                            <label class="form-label" for="default-01">Output Title</label>
                            <div class="form-control-wrap">
                                <input type="text" name="output_title" class="form-control" id="output_title" placeholder=""
                                readonly="">
                            </div>
                        </div>
                        


                        <input type="hidden" name="created_by" class="form-control" value="{{Auth::user()->id}}" readonly="">
                        <input type="hidden" name="organization_id" class="form-control" value="{{Auth::user()->organization_id}}" readonly="">
                        <input type="hidden" name="project_id" class="form-control" value="{{$projectshow->id}}" readonly="">
                        <input type="hidden" name="status" class="form-control" value="01" readonly="">
                        <input type="hidden" name="outcome_id" id="outcome_id" class="form-control" readonly="">


                        <div class="form-group">
                            <label class="form-label" for="default-01">Output Name</label>
                            <div class="form-control-wrap">
                                <input type="text" name="output_name" class="form-control" id="default-01" placeholder="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="default-01">Output code</label>
                            <div class="form-control-wrap">
                                <input type="text" name="output_code" class="form-control" id="default-01" placeholder="">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-label" for="default-textarea">Output Description(Optional)</label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control no-resize" name="output_description" id="default-textarea"></textarea>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Outcome Output</button>
                    </div>

                </form>
                <script>
                    $(document).ready(function() {
                        var activeTab = localStorage.getItem('activeTab');
                        if (activeTab) {
                            $('#tabMenu').removeClass('active');
                            $(activeTab).addClass('active');
                            $('#tabMenu a[href="' + activeTab + '"]').tab('show');
                        }

                        // Save the active tab to local storage
                        $('#tabMenu a').on('shown.bs.tab', function (e) {
                            localStorage.setItem('activeTab', $(e.target).attr('href'));
                        });

                        $('#projectoutcomeoutput').on('submit', function(e) {
                            e.preventDefault();
                            // location.reload();
                            $.ajax({
                                url: "{{ route('outputs.store')}}",
                                type: "POST",
                                data: $(this).serialize(),
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(response) {
                                    if (response.success) {
                                        location.reload();
                                        // alert('Output Added Successfully!.');
                                    } else {
                                        alert('An error occurred while saving.');
                                    }
                                },
                                error: function(xhr, status, error) {
                                    alert('An error occurred: ' + error);
                                }
                            });
                        });
                    });
                </script>

            </div>
        </div>
    </div>
</div>

<!---- Add project Outcome Activity -->

<div class="modal fade zoom" tabindex="-1" id="activity1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Project Outcome Activity</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">

                <form id="projectoutcomeactivity">
                    @csrf

                    <div class="row gy-4">

                        <div class="form-group">

                            <label class="form-label" for="default-01">Outcome</label>
                            <div class="form-control-wrap">
                                <input type="text" name="activity_name" class="form-control" id="activity_name2" placeholder=""
                                readonly="">
                            </div>
                        </div>

                        <input type="hidden" name="created_by" class="form-control" value="{{Auth::user()->id}}" readonly="">
                        <input type="hidden" name="organization_id" class="form-control" value="{{Auth::user()->organization_id}}" readonly="">
                        <input type="hidden" name="project_id" class="form-control" value="{{$projectshow->id}}" readonly="">
                        <input type="hidden" name="outcome_id" class="form-control" id="outcome_id1" readonly="">
                        <input type="hidden" name="status" class="form-control" value="01" readonly="">

                        <div class="form-group">
                            <label class="form-label" for="default-01">Outcome Activity Title</label>
                            <div class="form-control-wrap">
                                <input type="text" name="activity_title" class="form-control" id="default-01" placeholder="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="default-01">Outcome Activity code</label>
                            <div class="form-control-wrap">
                                <input type="text" name="activity_code" class="form-control" id="default-01" placeholder="">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-label" for="default-textarea">Outcome Activity Description(Optional)</label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control no-resize" name="activity_description" id="default-textarea"></textarea>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Outcome Activity</button>
                    </div>

                </form>
                <script>
                    $(document).ready(function() {
                        var activeTab = localStorage.getItem('activeTab');
                        if (activeTab) {
                            $('#tabMenu').removeClass('active');
                            $(activeTab).addClass('active');
                            $('#tabMenu a[href="' + activeTab + '"]').tab('show');
                        }

                        // Save the active tab to local storage
                        $('#tabMenu a').on('shown.bs.tab', function (e) {
                            localStorage.setItem('activeTab', $(e.target).attr('href'));
                        });

                        $('#projectoutcomeactivity').on('submit', function(e) {
                            e.preventDefault();
                            // location.reload();
                            $.ajax({
                                url: "{{ route('addoutcomeactivity')}}",
                                type: "POST",
                                data: $(this).serialize(),
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(response) {
                                    if (response.success) {
                                        location.reload();
                                        // alert('Output Added Successfully!.');
                                    } else {
                                        alert('An error occurred while saving.');
                                    }
                                },
                                error: function(xhr, status, error) {
                                    alert('An error occurred: ' + error);
                                }
                            });
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>

<!----   Add Project Output Activity -->

<div class="modal fade zoom" tabindex="-1" id="activity2">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Project Output Activity</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">

                <form id="projectoutputactivity">
                    @csrf

                    <div class="row gy-4">

                        <div class="form-group">
                            <label class="form-label" for="default-01">Ouput Activity</label>
                            <div class="form-control-wrap">
                                <input type="text" name="activity_name" class="form-control" id="output_title7" placeholder=""
                                readonly="">
                            </div>
                        </div>



                        <input type="hidden" name="created_by" class="form-control" value="{{Auth::user()->id}}" readonly="">
                        <input type="hidden" name="organization_id" class="form-control" value="{{Auth::user()->organization_id}}" readonly="">
                        <input type="hidden" name="project_id" class="form-control" value="{{$projectshow->id}}" readonly="">
                        <input type="hidden" name="output_id" class="form-control" id="output_id5" readonly="">
                        <input type="hidden" name="status" class="form-control" value="01" readonly="">


                        <div class="form-group">
                            <label class="form-label" for="default-01">Output Activity Title</label>
                            <div class="form-control-wrap">
                                <input type="text" name="activity_title" class="form-control" id="default-01" placeholder="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="default-01">Output Activity code</label>
                            <div class="form-control-wrap">
                                <input type="text" name="activity_code" class="form-control" id="default-01" placeholder="">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-label" for="default-textarea">Output Activity Description(Optional)</label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control no-resize" name="activity_description" id="default-textarea"></textarea>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Output Activity</button>
                    </div>

                </form>

                <script>
                    $(document).ready(function() {
                        var activeTab = localStorage.getItem('activeTab');
                        if (activeTab) {
                            $('#tabMenu').removeClass('active');
                            $(activeTab).addClass('active');
                            $('#tabMenu a[href="' + activeTab + '"]').tab('show');
                        }

                        // Save the active tab to local storage
                        $('#tabMenu a').on('shown.bs.tab', function (e) {
                            localStorage.setItem('activeTab', $(e.target).attr('href'));
                        });

                        $('#projectoutputactivity').on('submit', function(e) {
                            e.preventDefault();
                            // location.reload();
                            $.ajax({
                                url: "{{ route('addoutputactivity')}}",
                                type: "POST",
                                data: $(this).serialize(),
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(response) {
                                    if (response.success) {
                                        location.reload();
                                        // alert('Output Added Successfully!.');
                                    } else {
                                        alert('An error occurred while saving.');
                                    }
                                },
                                error: function(xhr, status, error) {
                                    alert('An error occurred: ' + error);
                                }
                            });
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>

<!---- Add Project Output Indicator --->
<script>
    $(document).ready(function(){
        $('#output11').hide();
        $('#output21').hide();
        $('#output31').hide();
        $('#Disaggregation2').hide();

        $('#disaggregation2').change(function(){
          if($(this).val() == 'none'){
            $('#output11').show();
            $('#output21').show();
            $('#output31').show();
            $('#Disaggregation2').hide();
        }else if($(this).val() == 'Disaggregation2'){
            $('#Disaggregation2').show();
            $('#output31').hide();
            $('#output21').hide();
            $('#output11').hide();
        }else if($(this).val() == 'ALIENID'){
            $('#document_number').show();
        }
        else{
         $('#null').show('');
     }
 });
    });

</script>

<div class="modal fade zoom" tabindex="-1" id="indicator2">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Project Output Indicator</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">

                <form id="projectoutputindicator">
                    @csrf
                    <div class="row gy-4">
                        <div class="form-group">
                            <label class="form-label" for="default-01">Output</label>
                            <div class="form-control-wrap">
                                <input type="text" name="goal_name" class="form-control" id="output_indicator7" placeholder=""
                                readonly="">
                            </div>
                        </div>


                        <input type="hidden" name="created_by" class="form-control" value="{{Auth::user()->id}}" readonly="">
                        <input type="hidden" name="organization_id" class="form-control" value="{{Auth::user()->organization_id}}" readonly="">
                        <input type="hidden" name="project_id" class="form-control" value="{{$projectshow->id}}" readonly="">
                        <input type="hidden" name="output_id" class="form-control" id="output_indicator5" readonly="">
                        <input type="hidden" name="status" class="form-control" value="01" readonly="">



                        <div class="form-group">
                            <label class="form-label" for="default-01">Indicator Title</label>
                            <div class="form-control-wrap">
                                <input type="text" name="indicator_title" class="form-control" id="default-01" placeholder="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="default-06">Reporting Frequency</label>
                            <div class="form-control-wrap ">
                                <div class="form-control-select">
                                    <select class="form-control" name="reporting_frequency" id="default-06">
                                        <option value="#">-------Select Reporting Frequency-------</option>
                                        <option></option>
                                        <option value="Monthly">Monthly</option>
                                        <option value="Bi-Monthly">Bi-Monthly</option>
                                        <option value="Quaterly">Quaterly</option>
                                        <option value="Semi-Annual">Semi-Annual</option>
                                        <option value="Annual">Annual</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="default-06">Type</label>
                            <div class="form-control-wrap ">
                                <div class="form-control-select">
                                    <select class="form-control" name="type" id="type">
                                        <option value="#">-------Select Type-------</option>
                                        <option></option>
                                        <option value="Quantitative">Quantitative</option>
                                        <option value="Qualitative">Qualitative</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="default-06">Disaggregation</label>
                            <div class="form-control-wrap ">
                                <div class="form-control-select">
                                    <select class="form-control" name="disaggregation" id="disaggregation2">
                                        <option value="#">-------Select Disaggregation-------</option>
                                        <option></option>
                                        <!-- <option value="none">None</option> -->
                                        <option value="Disaggregation2">Disaggregation</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-4 col-sm-6">
                            <div class="form-group" id="output11">
                                <label class="form-label" for="default-01">Label</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="label_none" class="form-control" id="default-01" placeholder="Input Label">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6">
                            <div class="form-group" id="output21">
                                <label class="form-label" for="default-01">Baseline</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="baseline_none" class="form-control" id="default-01" placeholder="Input Baselime">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6">
                            <div class="form-group" id="output31">
                                <label class="form-label" for="default-01">Target</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="target_none" class="form-control" id="default-01" placeholder="Input Target">
                                </div>
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane" id="Disaggregation2">

                            <!-- <h4 align="center"><strong>Disaggregation</strong></h4> -->
                            <div id='ncontainer'>

                              <table id="nextkin2" border="1" cellspacing="0">
                                <tr>
                                  <th><input class='ncheck_all' type='checkbox' onclick="select_all()"/></th>
                                  <th>#</th>
                                  <th>Label</th>
                                  <th>Baseline</th>
                                  <th>Target</th>
                              </tr>
                              <tr>
                                  <td><input type='checkbox' class='ncase'/></td>
                                  <td><span id='nsnum'>1.</span></td>
                                  <td><input class="form-control" type='text' id='dvalue' name='dvalue[0]' value="{{{ Input::old('dvalue[0]') }}}"/></td>
                                  <td><input class="form-control" type='text' id='dbaseline' name='dbaseline[0]' value="{{{ Input::old('dbaseline[0]') }}}"/></td>
                                  <td><input class="form-control" type='text' id='dtarget' name='dtarget[0]' value="{{{ Input::old('dtarget[0]') }}}"/></td>

                              </tr>
                          </table>

                          <button type="button" class='ndelete'>- Delete</button>
                          <button type="button" class='naddmore1'>+ Add More</button>
                      </div>
                      <script>
                        $(".ndelete").on('click', function() {
                          if($('.ncase:checkbox:checked').length > 0){
                            if (window.confirm("Are you sure you want to delete this Disaggregation detail(s)?"))
                            {
                              $('.ncase:checkbox:checked').parents("#nextkin2 tr").remove();
                              $('.ncheck_all').prop("checked", false);
                              check();
                          }else{
                              $('.ncheck_all').prop("checked", false);
                              $('.ncase').prop("checked", false);
                          }
                      }
                  });
                        var i=2;
                        $(".naddmore1").on('click',function(){
                          count=$('#nextkin2 tr').length;
                          var data="<tr><td><input type='checkbox' class='ncase'/></td><td><span id='nsnum"+i+"'>"+count+".</span></td>";

                          data +="<td><input class='form-control' type='text' id='dvalue"+i+"' name='dvalue["+(i-1)+"]' value='{{{ Input::old('dvalue["+(i-1)+"]') }}}'/></td><td><input class='form-control' type='text' id='dbaseline"+i+"' name='dbaseline["+(i-1)+"]' value='{{{ Input::old('dbaseline["+(i-1)+"]') }}}'/></td><td><input class='form-control' type='text' id='dtarget"+i+"' name='dtarget["+(i-1)+"]' value='{{{ Input::old('dtarget["+(i-1)+"]') }}}'/></td>";
                          $('#nextkin2').append(data);
                          i++;
                      });

                        function select_all() {
                          $('input[class=ncase]:checkbox').each(function(){
                            if($('input[class=ncheck_all]:checkbox:checked').length == 0){
                              $(this).prop("checked", false);
                          } else {
                              $(this).prop("checked", true);
                          }
                      });
                      }

                      function check(){
                          obj=$('#nextkin2 tr').find('span');
                          $.each( obj, function( key, value ) {
                            id=value.id;
                            $('#'+id).html(key+1);
                        });
                      }

                  </script>
              </div>

              <div class="col-sm-12">
                <div class="form-group">
                    <label class="form-label" for="default-textarea">Indicator Description(Optional)</label>
                    <div class="form-control-wrap">
                        <textarea class="form-control no-resize" name="indicator_description" id="default-textarea"></textarea>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Add Output Indicator</button>
        </div>

    </form>

    <script>
        $(document).ready(function() {
            var activeTab = localStorage.getItem('activeTab');
            if (activeTab) {
                $('#tabMenu').removeClass('active');
                $(activeTab).addClass('active');
                $('#tabMenu a[href="' + activeTab + '"]').tab('show');
            }

                        // Save the active tab to local storage
            $('#tabMenu a').on('shown.bs.tab', function (e) {
                localStorage.setItem('activeTab', $(e.target).attr('href'));
            });

            $('#projectoutputindicator').on('submit', function(e) {
                e.preventDefault();
                            // location.reload();
                $.ajax({
                    url: "{{ route('addoutputindicator')}}",
                    type: "POST",
                    data: $(this).serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            location.reload();
                                        // alert('Output Added Successfully!.');
                        } else {
                            alert('An error occurred while saving.');
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('An error occurred: ' + error);
                    }
                });
            });
        });
    </script>
</div>
</div>
</div>
</div>


<!--- Add Project outcome indicator -->
<script>
    $(document).ready(function(){
        $('#outcome11').hide();
        $('#outcome12').hide();
        $('#outcome13').hide();
        $('#Disaggregation3').hide();

        $('#disaggregation3').change(function(){
          if($(this).val() == 'none'){
            $('#outcome11').show();
            $('#outcome12').show();
            $('#outcome13').show();
            $('#Disaggregation3').hide();
        }else if($(this).val() == 'Disaggregation3'){
            $('#Disaggregation3').show();
            $('#outcome11').hide();
            $('#outcome12').hide();
            $('#outcome13').hide();
        }else if($(this).val() == 'ALIENID'){
            $('#document_number').show();
        }
        else{
           $('#null').show('');
       }
   });
    });

</script>


<div class="modal fade zoom" tabindex="-1" id="indicator1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Project Outcome Indicator</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">

                <form id="projectoutcomeindicator">
                    @csrf
                    <div class="row gy-4">

                        <div class="form-group">
                            <label class="form-label" for="default-01">Outcome</label>
                            <div class="form-control-wrap">
                                <input type="text" name="goal_name" class="form-control" id="outcome_indicator" placeholder=""
                                readonly="">
                            </div>
                        </div>
                        


                        <input type="hidden" name="created_by" class="form-control" value="{{Auth::user()->id}}" readonly="">
                        <input type="hidden" name="organization_id" class="form-control" value="{{Auth::user()->organization_id}}" readonly="">
                        <input type="hidden" name="project_id" class="form-control" value="{{$projectshow->id}}" readonly="">
                        <input type="hidden" name="outcome_id" class="form-control" id="outcome_id3" readonly="">
                        <input type="hidden" name="status" class="form-control" value="01" readonly="">



                        <div class="form-group">
                            <label class="form-label" for="default-01">Indicator Title</label>
                            <div class="form-control-wrap">
                                <input type="text" name="indicator_title" class="form-control" id="default-01" placeholder="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="default-06">Reporting Frequency</label>
                            <div class="form-control-wrap ">
                                <div class="form-control-select">
                                    <select class="form-control" name="reporting_frequency" id="default-06">
                                        <option value="#">-------Select Reporting Frequency-------</option>
                                        <option></option>
                                        <option value="Monthly">Monthly</option>
                                        <option value="Bi-Monthly">Bi-Monthly</option>
                                        <option value="Quaterly">Quaterly</option>
                                        <option value="Semi-Annual">Semi-Annual</option>
                                        <option value="Annual">Annual</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="default-06">Type</label>
                            <div class="form-control-wrap ">
                                <div class="form-control-select">
                                    <select class="form-control" name="type" id="type">
                                        <option value="#">-------Select Type-------</option>
                                        <option></option>
                                        <option value="Quantitative">Quantitative</option>
                                        <option value="Qualitative">Qualitative</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="default-06">Disaggregation</label>
                            <div class="form-control-wrap ">
                                <div class="form-control-select">
                                    <select class="form-control" name="disaggregation" id="disaggregation3">
                                        <option value="#">-------Select Disaggregation-------</option>
                                        <option></option>
                                        <!-- <option value="none">None</option> -->
                                        <option value="Disaggregation3">Disaggregation</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-4 col-sm-6">
                            <div class="form-group" id="outcome11">
                                <label class="form-label" for="default-01">Label</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="label_none" class="form-control" id="default-01" placeholder="Input Label">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6">
                            <div class="form-group" id="outcome12">
                                <label class="form-label" for="default-01">Baseline</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="baseline_none" class="form-control" id="default-01" placeholder="Input Baselime">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6">
                            <div class="form-group" id="outcome13">
                                <label class="form-label" for="default-01">Target</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="target_none" class="form-control" id="default-01" placeholder="Input Target">
                                </div>
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane" id="Disaggregation3">

                            <!-- <h4 align="center"><strong>Disaggregation</strong></h4> -->
                            <div id='ncontainer'>

                              <table id="nextkin1" border="1" cellspacing="0">
                                <tr>
                                  <th><input class='ncheck_all' type='checkbox' onclick="select_all()"/></th>
                                  <th>#</th>
                                  <th>Label</th>
                                  <th>Baseline</th>
                                  <th>Target</th>
                              </tr>
                              <tr>
                                  <td><input type='checkbox' class='ncase'/></td>
                                  <td><span id='nsnum'>1.</span></td>
                                  <td><input class="form-control" type='text' id='dvalue' name='dvalue[0]' value="{{{ Input::old('dvalue[0]') }}}"/></td>
                                  <td><input class="form-control" type='text' id='dbaseline' name='dbaseline[0]' value="{{{ Input::old('dbaseline[0]') }}}"/></td>
                                  <td><input class="form-control" type='text' id='dtarget' name='dtarget[0]' value="{{{ Input::old('dtarget[0]') }}}"/></td>

                              </tr>
                          </table>

                          <button type="button" class='ndelete'>- Delete</button>
                          <button type="button" class='naddmore1'>+ Add More</button>
                      </div>
                      <script>
                        $(".ndelete").on('click', function() {
                          if($('.ncase:checkbox:checked').length > 0){
                            if (window.confirm("Are you sure you want to delete this Disaggregation detail(s)?"))
                            {
                              $('.ncase:checkbox:checked').parents("#nextkin1 tr").remove();
                              $('.ncheck_all').prop("checked", false);
                              check();
                          }else{
                              $('.ncheck_all').prop("checked", false);
                              $('.ncase').prop("checked", false);
                          }
                      }
                  });
                        var i=2;
                        $(".naddmore1").on('click',function(){
                          count=$('#nextkin1 tr').length;
                          var data="<tr><td><input type='checkbox' class='ncase'/></td><td><span id='nsnum"+i+"'>"+count+".</span></td>";

                          data +="<td><input class='form-control' type='text' id='dvalue"+i+"' name='dvalue["+(i-1)+"]' value='{{{ Input::old('dvalue["+(i-1)+"]') }}}'/></td><td><input class='form-control' type='text' id='dbaseline"+i+"' name='dbaseline["+(i-1)+"]' value='{{{ Input::old('dbaseline["+(i-1)+"]') }}}'/></td><td><input class='form-control' type='text' id='dtarget"+i+"' name='dtarget["+(i-1)+"]' value='{{{ Input::old('dtarget["+(i-1)+"]') }}}'/></td>";
                          $('#nextkin1').append(data);
                          i++;
                      });

                        function select_all() {
                          $('input[class=ncase]:checkbox').each(function(){
                            if($('input[class=ncheck_all]:checkbox:checked').length == 0){
                              $(this).prop("checked", false);
                          } else {
                              $(this).prop("checked", true);
                          }
                      });
                      }

                      function check(){
                          obj=$('#nextkin1 tr').find('span');
                          $.each( obj, function( key, value ) {
                            id=value.id;
                            $('#'+id).html(key+1);
                        });
                      }

                  </script>
              </div>
              
              <div class="col-sm-12">
                <div class="form-group">
                    <label class="form-label" for="default-textarea">Indicator Description(Optional)</label>
                    <div class="form-control-wrap">
                        <textarea class="form-control no-resize" name="indicator_description" id="default-textarea"></textarea>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Add Outcome Indicator</button>
        </div>

    </form>
    <script>
        $(document).ready(function() {
            var activeTab = localStorage.getItem('activeTab');
            if (activeTab) {
                $('#tabMenu').removeClass('active');
                $(activeTab).addClass('active');
                $('#tabMenu a[href="' + activeTab + '"]').tab('show');
            }

                        // Save the active tab to local storage
            $('#tabMenu a').on('shown.bs.tab', function (e) {
                localStorage.setItem('activeTab', $(e.target).attr('href'));
            });

            $('#projectoutcomeindicator').on('submit', function(e) {
                e.preventDefault();
                            // location.reload();
                $.ajax({
                    url: "{{ route('addoutcomeindicator')}}",
                    type: "POST",
                    data: $(this).serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            location.reload();
                                        // alert('Output Added Successfully!.');
                        } else {
                            alert('An error occurred while saving.');
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('An error occurred: ' + error);
                    }
                });
            });
        });
    </script>
</div>
</div>
</div>
</div>




<script type="text/javascript">
    $(document).ready(function() {
        $('#planning_type').change(function(){
            $.get("{{ url('api/planningtype')}}",
                { option: $(this).val() },
                function(data) {
                    console.log('planing type');
                    $('#planning').val(data);
                });
        });
    });
</script>

<div class="modal fade zoom" tabindex="-1" id="modalZoom877">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Implementaion Container</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="nk-block nk-block-lg">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <ul class="nav nav-tabs mt-n3">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem5232"><em class="icon ni ni-file"></em><span>Implementaion Container</span></a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem5232">
                                    <form method="POST" action="{{ route('createimcontainer') }}">
                                        @csrf
                                        <div class="row gy-4">

                                           <input type="hidden" class="form-control" value="01" name="status" id="default-01">
                                           <input type="hidden" class="form-control" value="{{Auth::user()->id}}" name="created_by" id="default-01">
                                           <input type="hidden" class="form-control" value="{{Auth::user()->organization_id}}" name="organization_id" id="default-01">
                                           <input type="hidden" class="form-control" value="FY-2023" name="exchange_rate" id="default-01">
                                           <input type="hidden" class="form-control" value="{{$projectshow->id}}" name="project_id" id="default-01">

                                           <div class="form-group">
                                            <label class="form-label" for="default-01">Conatiner Name</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" name="container_name" id="default-01" placeholder="Input Work Plan Container Name">
                                            </div>
                                        </div>

                                        <script>
                                            $(document).ready(function(){
                                                $('#activityworkplan').hide();
                                                $('#indicatorworkplan').hide();
                                                $('#planning_typeid').change(function(){
                                                  if($(this).val() == 'Activity'){
                                                    $('#activityworkplan').show();
                                                    $('#indicatorworkplan').hide();
                                                }else if($(this).val() == 'Indicator'){
                                                    $('#indicatorworkplan').show();
                                                    $('#activityworkplan').hide();
                                                }else if($(this).val() == 'ALIENID'){
                                                    $('#document_number').show();
                                                }
                                                else{
                                                   $('#null').show('');
                                               }
                                           });
                                            });

                                        </script>

                                        <div class="form-group">
                                            <label class="form-label" for="default-06">Planning Type</label>
                                            <div class="form-control-wrap ">
                                                <div class="form-control-select">
                                                    <select class="form-control" name="planning_type" id="planning_typeid">
                                                        <option value="null">-------Select Planning Type-------</option>
                                                        <option></option>
                                                        <option value="Activity">Activity</option>
                                                        <option value="Indicator">Indicator</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group" id="activityworkplan">
                                            <label class="form-label" for="default-06">Activity Work Plan</label>
                                            <div class="form-control-wrap ">
                                                <div class="form-control-select">
                                                    <select class="form-control" name="workplancontainer_id" id="workplancontainer_id">
                                                        <option value="null">-------Select Work Plan-------</option>
                                                        <option></option>
                                                        @foreach($workplancontaineract as $obj)
                                                        <option value="{{$obj->id}}">{{$obj->container_name}} - ({{$obj->planning_type}})</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <div class="form-icon form-icon-right">
                                                        <em class="icon ni ni-calendar-alt"></em>
                                                    </div>
                                                    <input type="text" name="implementation_start_date" class="form-control form-control-xl form-control-outlined date-picker" id="outlined-date-picker">
                                                    <label class="form-label-outlined" for="outlined-date-picker">Start Date</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <div class="form-icon form-icon-right">
                                                        <em class="icon ni ni-calendar-alt"></em>
                                                    </div>
                                                    <input type="text" name="imeplementation_end_date" class="form-control form-control-xl form-control-outlined date-picker" id="outlined-date-picker">
                                                    <label class="form-label-outlined" for="outlined-date-picker">End Date</label>
                                                </div>
                                            </div>
                                        </div>


                                        </div>

                                        


                                        <br>
                                        <button style="margin-left: 30%;" type="submit" class="btn btn-round btn-primary"><em class="icon ni ni-navigate-fill"></em>&nbsp Add Implementation Container</button>
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


<script type="text/javascript">
    $(document).ready(function() {
        $('#userid').change(function(){
            $.get("{{ url('api/inviteuser')}}",
                { option: $(this).val() },
                function(data) {
                    console.log('inviteuser');
                    $('#inviteuser').val(data);
                });
        });
    });
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $('#userid').change(function(){
            $.get("{{ url('api/getname')}}",
                { option: $(this).val() },
                function(data) {
                    console.log('username');
                    $('#username').val(data);
                });
        });
    });
</script>

<div class="modal fade zoom" tabindex="-1" id="addusers">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add User to the Project</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="nk-block nk-block-lg">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <ul class="nav nav-tabs mt-n3">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem5232"><em class="icon ni ni-edit"></em><span>Add User</span></a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem5232">
                                    <form method="POST" action="{{ route('inviteuser')}}">
                                        @csrf
                                        <div class="row gy-4">

                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Project</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" value="{{$projectshow->project_name}}" id="default-01" name="project_name" readonly>
                                                </div>
                                            </div>

                                            
                                            <input type="hidden" class="form-control" value="{{$projectshow->id}}" id="default-01" name="project_id" readonly>


                                            <div class="form-group" id="program">
                                                <label class="form-label" for="default-06">Users</label>
                                                <div class="form-control-wrap ">
                                                    <div class="form-control-select">
                                                        <select class="form-control" id="userid" name="user_id" >
                                                            <option value="#">Nothing Selected</option>
                                                            <option></option>                                                
                                                            @foreach($projectusers1 as $object)
                                                            <option value="{{$object->id}}">{{$object->name}}  {{$object->last_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="default-06">Profile</label>
                                                <div class="form-control-wrap ">
                                                    <div class="form-control-select">
                                                        <select class="form-control" name="basecurrency_id" id="basecurrency_id">
                                                            <option value="null">Nothing Selected</option>
                                                            <option></option>
                                                            @foreach($roles as $obj)
                                                            <option value="{{$obj->id}}">{{$obj->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <input type="hidden" class="form-control" value="" id="username" name="name" readonly>

                                            <input type="hidden" class="form-control" value="" id="inviteuser" name="email" readonly>

                                        </div> 
                                    </div>
                                    <br>
                                    <button style="margin-left: 30%;" type="submit" class="btn btn-round btn-primary"><em class="icon ni ni-navigate-fill"></em>&nbsp Invite User</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade zoom" tabindex="-1" id="updatecurreny">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Base Currency</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="nk-block nk-block-lg">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <ul class="nav nav-tabs mt-n3">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem5232"><em class="icon ni ni-edit"></em><span>Update Base Currency</span></a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem5232">
                                    <form method="POST" action="{{ url('updatebasecurrency',$projectshow->id) }}">
                                        @csrf
                                        <div class="row gy-4">



                                            <div class="form-group">
                                                <label class="form-label" for="default-06">Base Currency</label>
                                                <div class="form-control-wrap ">
                                                    <div class="form-control-select">
                                                        <select class="form-control" name="basecurrency_id" id="basecurrency_id">
                                                            <option value="null">-------Select New Base Currency-------</option>
                                                            <option></option>
                                                            @foreach($basecurrency as $obj)
                                                            <option value="{{$obj->id}}">{{$obj->currency_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>



                                        </div>

                                        
                                    </div>
                                    <br>
                                    <button style="margin-left: 30%;" type="submit" class="btn btn-round btn-primary"><em class="icon ni ni-navigate-fill"></em>&nbsp Update Base Currency</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer bg-light">
            <span class="sub-text"></span>
        </div>
    </div>
</div>
</div>

<div class="modal fade zoom" tabindex="-1" id="assignrole">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Assign Role</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="nk-block nk-block-lg">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <ul class="nav nav-tabs mt-n3">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem5232"><em class="icon ni ni-edit"></em><span>Assign Role</span></a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem5232">
                                    <form method="POST" action="{{ url('updatebasecurrency',$projectshow->id) }}">
                                        @csrf
                                        <div class="row gy-4">



                                            <div class="form-group">
                                                <label class="form-label" for="default-06">Role</label>
                                                <div class="form-control-wrap ">
                                                    <div class="form-control-select">
                                                        <select class="form-control" name="basecurrency_id" id="basecurrency_id">
                                                            <option value="null">Nothing Selected</option>
                                                            <option></option>
                                                            @foreach($roles as $obj)
                                                            <option value="{{$obj->id}}">{{$obj->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-label" for="default-06">Users</label>
                                                <div class="form-control-wrap ">
                                                    <div class="form-control-select">
                                                        <select class="form-control" name="basecurrency_id" id="basecurrency_id">
                                                            <option value="null">Nothing Selected</option>
                                                            <option></option>
                                                            @foreach($projectusers as $obj)
                                                            <option value="{{$obj->id}}">{{$obj->name}} {{$obj->last_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- <input type="" id="result" name=""> -->



                                        </div>

                                        

                                        <br>
                                        <button style="margin-left: 30%;" type="submit" class="btn btn-round btn-primary"><em class="icon ni ni-navigate-fill"></em>&nbsp Assign Role</button>

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

<div class="modal fade zoom" tabindex="-1" id="editgoal_modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Goal</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="nk-block nk-block-lg">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <ul class="nav nav-tabs mt-n3">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem5232"><em class="icon ni ni-edit"></em><span>Edit</span></a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem5232">
                                    <form method="POST" action="{{ route('updategoal')}}">
                                        @csrf
                                        
                                        <div class="row gy-4">


                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Goal Name</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="goal_name" id="goal_name2" class="form-control" placeholder="">
                                                </div>
                                            </div> 



                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Goal Code</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="goal_code" id="goal_code2" class="form-control" placeholder="">
                                                </div>
                                            </div> 

                                            <input type="hidden" name="goal_id" id="goal_id2" class="form-control" placeholder="">

                                            
                                        </div>
                                        <br>
                                        <button style="margin-left: 30%;" type="submit" class="btn btn-round btn-primary"><em class="icon ni ni-navigate-fill"></em>&nbsp Edit Goal</button>
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


<div class="modal fade zoom" tabindex="-1" id="editactivity_modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Goal Activity</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="nk-block nk-block-lg">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <ul class="nav nav-tabs mt-n3">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem5232"><em class="icon ni ni-edit"></em><span>Edit</span></a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem5232">
                                    <form method="POST" action="{{ route('updateactivitygoal')}}">
                                        @csrf
                                        
                                        <div class="row gy-4">


                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Activity Name</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="activity_title" id="activity_title2" class="form-control" placeholder="">
                                                </div>
                                            </div> 



                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Activity Code</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="activity_code" id="activity_code2" class="form-control" placeholder="">
                                                </div>
                                            </div> 

                                            <input type="hidden" name="activity_id" id="activity_id2" class="form-control" placeholder="">

                                            
                                        </div>
                                        <br>
                                        <button style="margin-left: 30%;" type="submit" class="btn btn-round btn-primary"><em class="icon ni ni-navigate-fill"></em>&nbsp Edit Goal Activity</button>
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


<div class="modal fade zoom" tabindex="-1" id="editoutputactivity_modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Output Activity</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="nk-block nk-block-lg">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <ul class="nav nav-tabs mt-n3">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem5232"><em class="icon ni ni-edit"></em><span>Edit</span></a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem5232">
                                    <form method="POST" action="{{ route('updateoutputactivity')}}">
                                        @csrf
                                        
                                        <div class="row gy-4">


                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Activity Name</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="activity_title" id="activity_title4" class="form-control" placeholder="">
                                                </div>
                                            </div> 



                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Activity Code</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="activity_code" id="activity_code4" class="form-control" placeholder="">
                                                </div>
                                            </div> 

                                            <input type="hidden" name="activity_id" id="activity_id4" class="form-control" placeholder="">

                                            
                                        </div>
                                        <br>
                                        <button style="margin-left: 30%;" type="submit" class="btn btn-round btn-primary"><em class="icon ni ni-navigate-fill"></em>&nbsp Edit Output Activity</button>
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



<div class="modal fade zoom" tabindex="-1" id="editoutcomeactivity_modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Outcome Activity</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="nk-block nk-block-lg">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <ul class="nav nav-tabs mt-n3">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem5232"><em class="icon ni ni-edit"></em><span>Edit</span></a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem5232">
                                    <form method="POST" action="{{ route('updateoutcomeactivity')}}">
                                        @csrf
                                        
                                        <div class="row gy-4">


                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Activity Name</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="activity_title" id="activity_title3" class="form-control" placeholder="">
                                                </div>
                                            </div> 



                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Activity Code</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="activity_code" id="activity_code3" class="form-control" placeholder="">
                                                </div>
                                            </div> 

                                            <input type="hidden" name="activity_id" id="activity_id3" class="form-control" placeholder="">

                                            
                                        </div>
                                        <br>
                                        <button style="margin-left: 30%;" type="submit" class="btn btn-round btn-primary"><em class="icon ni ni-navigate-fill"></em>&nbsp Edit Outcome Activity</button>
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


<div class="modal fade zoom" tabindex="-1" id="editindicator_modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Goal Indicator</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="nk-block nk-block-lg">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <ul class="nav nav-tabs mt-n3">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem5232"><em class="icon ni ni-edit"></em><span>Edit</span></a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem5232">
                                    <form method="POST" action="{{ route('updategoal')}}">
                                        @csrf
                                        
                                        <div class="row gy-4">


                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Indicator Title</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="goal_name" id="goal_name2" class="form-control" placeholder="">
                                                </div>
                                            </div> 



                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Goal Code</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="goal_code" id="goal_code2" class="form-control" placeholder="">
                                                </div>
                                            </div> 

                                            <input type="hidden" name="goal_id" id="goal_id2" class="form-control" placeholder="">

                                            
                                        </div>
                                        <br>
                                        <button style="margin-left: 30%;" type="submit" class="btn btn-round btn-primary"><em class="icon ni ni-navigate-fill"></em>&nbsp Edit Goal Indicator</button>
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

<div class="modal fade zoom" tabindex="-1" id="editoutcome_modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Outcome</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="nk-block nk-block-lg">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <ul class="nav nav-tabs mt-n3">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem5232"><em class="icon ni ni-edit"></em><span>Edit</span></a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem5232">
                                    <form method="POST" action="{{ route('updateoutcome')}}">
                                        @csrf
                                        
                                        <div class="row gy-4">


                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Outcome Name</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="outcome_name" id="outcome_name2" class="form-control" placeholder="">
                                                </div>
                                            </div> 

                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Outcome Code</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="outcome_code" id="outcome_code2" class="form-control" placeholder="">
                                                </div>
                                            </div> 

                                            <input type="hidden" name="outcome_id" id="outcome_id2" class="form-control" placeholder="">

                                            
                                        </div>
                                        <br>
                                        <button style="margin-left: 30%;" type="submit" class="btn btn-round btn-primary"><em class="icon ni ni-navigate-fill"></em>&nbsp Edit Outcome</button>
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


<div class="modal fade zoom" tabindex="-1" id="editoutput_modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Output</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="nk-block nk-block-lg">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <ul class="nav nav-tabs mt-n3">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem5232"><em class="icon ni ni-edit"></em><span>Edit</span></a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem5232">
                                    <form method="POST" action="{{ route('updateoutput')}}">
                                        @csrf
                                        
                                        <div class="row gy-4">


                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Output Name</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="output_name" id="output_name2" class="form-control" placeholder="">
                                                </div>
                                            </div> 

                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Outcome Code</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="output_code" id="output_code2" class="form-control" placeholder="">
                                                </div>
                                            </div> 

                                            <input type="hidden" name="output_id" id="output_id2" class="form-control" placeholder="">

                                            
                                        </div>
                                        <br>
                                        <button style="margin-left: 30%;" type="submit" class="btn btn-round btn-primary"><em class="icon ni ni-navigate-fill"></em>&nbsp Edit Output</button>
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


<div class="modal fade zoom" tabindex="-1" id="editinterventi">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Intervention</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="nk-block nk-block-lg">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <ul class="nav nav-tabs mt-n3">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem5232"><em class="icon ni ni-edit"></em><span>Edit</span></a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem5232">
                                    <form method="POST" action="{{ route('updateinterventions')}}">
                                        @csrf
                                        
                                        <div class="row gy-4">

                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Activity</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="activity_name" id="activity_name" class="form-control" placeholder="">
                                                </div>
                                            </div> 

                                            <input type="hidden" name="intervention_id" id="intervention_id" class="form-control" placeholder="">

                                            <!-- <div class="tab-pane" id="tabItem3"> -->

                                                <script type="text/javascript">
                                                  $(function(){
                                                    $('#funding11, #funding22').keyup(function(){
                                                       var funding11 = parseFloat($('#funding11').val()) || 0;
                                                       var funding22 = parseFloat($('#funding22').val()) || 0;
                                                       $('#totall').val(funding11 + funding22);
                                                   });
                                                });
                                            </script>

                                            @foreach($accounts as $key => $object)
                                            @if($loop->first)
                                            <div class="form-group">
                                                <label class="form-label" for="default-01">{{$object->funding_name}}</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="funding1" id="funding11" class="form-control" placeholder="">
                                                </div>
                                            </div> 
                                            @endif
                                            @if($loop->last)
                                            <div class="form-group">
                                                <label class="form-label" for="default-01">{{$object->funding_name}}</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="funding2" id="funding22" class="form-control" placeholder="">
                                                </div>
                                            </div> 
                                            @endif
                                            @endforeach

                                            

                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Total</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="total" id="totall" class="form-control" placeholder="">
                                                </div>
                                            </div> 

                                        </div>



                                        <br>
                                        <button style="margin-left: 30%;" type="submit" class="btn btn-round btn-primary"><em class="icon ni ni-navigate-fill"></em>&nbsp Edit Intervention</button>
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

<div class="modal fade zoom" tabindex="-1" id="viewinterventi">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">View Intervention</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="nk-block nk-block-lg">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <ul class="nav nav-tabs mt-n3">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem5232"><em class="icon ni ni-eye"></em><span>View</span></a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem5232">
                                    <form method="POST" action="">
                                        @csrf
                                        
                                        <div class="row gy-4">

                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Activity</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="activity_name" id="activity_name1" class="form-control" placeholder=""- readonly>
                                                </div>
                                            </div> 
                                            @foreach($accounts as $key => $object)
                                            @if($loop->first)
                                            <div class="form-group">
                                                <label class="form-label" for="default-01">{{$object->funding_name}}</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="funding1" id="funding111" class="form-control" placeholder="" readonly>
                                                </div>
                                            </div> 
                                            @endif
                                            @if($loop->last)
                                            <div class="form-group">
                                                <label class="form-label" for="default-01">{{$object->funding_name}}</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="funding2" id="funding222" class="form-control" placeholder="" readonly>
                                                </div>
                                            </div> 
                                            @endif
                                            @endforeach

                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Total</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="total" id="totalll" class="form-control" placeholder="" readonly>
                                                </div>
                                            </div> 

                                        </div>



                                        <br>
                                        <!-- <button style="margin-left: 30%;" type="submit" class="btn btn-round btn-primary"><em class="icon ni ni-navigate-fill"></em>&nbsp Edit Intervention</button> -->
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

<!--- Add Goal -->
<div class="modal fade" id="addGoalDialog" tabindex="-1" role="dialog" aria-labelledby="addGoalDialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="addGoalForm" name="addGoalForm" method="post" action="">
                <input type="hidden" name="project_id" value="9" />

                <div class="modal-header">
                    <h5 class="modal-title">Add Goal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- title -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Title<span class="text-danger">*</span></label>
                                <input name="goal_name" type="text" class="form-control" required="" />
                            </div>
                        </div>
                    </div>

                    <input name="organization_id" type="hidden" class="form-control" value="{{Auth::user()->organization_id}}" />
                    <input name="created_by" type="hidden" class="form-control" value="{{Auth::user()->id}}" />
                    <input name="status" type="hidden" class="form-control" value="01" />
                    <input name="log_frame_id" type="hidden" class="form-control" value="{{$projectshow->logframe_id}}" />

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Goal Code<span class="text-danger">*</span></label>
                                <input name="goal_code" type="text" class="form-control" required="" />
                            </div>
                        </div>
                    </div>

                    <!-- description -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Description <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                                <textarea name="goal_description" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-success font-weight-bold">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- add outcome -->
<div class="modal fade" id="addOutcomeDialog" tabindex="-1" role="dialog" aria-labelledby="addOutcomeDialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="addOutcomeForm" name="addOutcomeForm" method="post" action="">
                <input type="hidden" id="outcome_goal_id" name="goal_id" />
                <input type="hidden" id="outcome_goal_description" name="goal_description" />

                <div class="modal-header">
                    <h5 class="modal-title">Add Outcome</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- title -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label id="outcome_goal_desc" class="font-weight-bolder"></label>
                            </div>
                        </div>
                    </div>

                    <!-- title -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Title<span class="text-danger">*</span></label>
                                <input name="title" type="text" class="form-control" required="" />
                            </div>
                        </div>
                    </div>

                    <!-- description -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Description <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                                <textarea name="description" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-success font-weight-bold">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- add indicator -->
<div class="modal fade" id="addGoalIndicatorDialog" tabindex="-1" role="dialog" aria-labelledby="addGoalIndicatorDialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form id="addGoalIndicatorForm" name="addGoalIndicatorForm" method="post" action="">
                <input type="hidden" id="goal_indicator_id" name="goal_id" />
                <input type="hidden" id="goal_indicator_description" name="goal_description" />
                <input type="hidden" id="goal_indicator_add_disaggs" name="disaggregations" />

                <div class="modal-header">
                    <h5 class="modal-title">Add goal indicator</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- title -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Goal</label>
                                <br/>
                                <label id="goal_indicator_desc"></label>
                            </div>
                        </div>
                    </div>

                    <!-- title and reporting frequency -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Title<span class="text-danger">*</span></label>
                                <input name="title" type="text" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Reporting Frequency<span class="text-danger">*</span></label>
                                <select name="reporting_frequency" class="form-control" required="">
                                    <option value=""></option>
                                    <option value="Monthly">Monthly</option>
                                    <option value="Bi-Monthly">Bi-Monthly</option>
                                    <option value="Quarterly">Quarterly</option>
                                    <option value="Semi-Annual">Semi-Annual</option>
                                    <option value="Annual">Annual</option>
                                    <option value="Annual">Mid-Term</option>
                                    <option value="Annual">End-Term</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- description -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Description <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                                <textarea name="description" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- disaggregation -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Disaggregation<span class="text-danger">*</span></label>
                                <select id="goal_indicator_add_target_type" name="target_type" class="form-control" required="">
                                    <option value=""></option>
                                    <option value="Disaggregation">Disaggregation</option>
                                    <option value="None">None</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <br>

                    <!-- baseline and target -->
                    <div id="goal_indicator_add_target_baseline_section" class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="font-weight-bolder">Label <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                                <input name="label" type="number" step="any" class="form-control" />
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="font-weight-bolder">Baseline <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                                <input name="baseline" type="number" step="any" class="form-control" step="any" />
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="font-weight-bolder">Target <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                                <input name="target" type="number" step="any" class="form-control" step="any" />
                            </div>
                        </div>
                    </div>

                    <!-- disaggregations -->
                    <div id="goal_indicator_add_disagg_section">
                        <div class="separator separator-dashed mt-8 mb-8"></div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="font-weight-bolder text-muted font-italic">Label</label>
                                    <input id="goal_indicator_add_disag_label" type="text" class="form-control" placeholder="e.g. Male" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="font-weight-bolder text-muted font-italic">Baseline</label>
                                    <input id="goal_indicator_add_disag_baseline" type="number" step="any" class="form-control" placeholder="e.g. 10" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="font-weight-bolder text-muted font-italic">Target</label>
                                    <div class="input-group">
                                        <input id="goal_indicator_add_disag_target" type="number" step="any" class="form-control" placeholder="e.g. 10" />
                                        <div class="input-group-append">
                                            <button class="btn btn-secondary" type="button" onclick="add_goal_indicator_disag();">ADD</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive-lg">
                                    <table id="goal_indicator_add_disagg_values" class="table">
                                        <caption>Disaggregation Data</caption>
                                        <thead>
                                            <tr>
                                                <th>Label</th>
                                                <th>Baseline</th>
                                                <th>Target</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-borderless"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="separator separator-dashed mt-8 mb-8"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-success font-weight-bold">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- edit indicator -->
<div class="modal fade" id="editGoalIndicatorDialog" tabindex="-1" role="dialog" aria-labelledby="editGoalIndicatorDialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form id="editGoalIndicatorForm" name="editGoalIndicatorForm" method="post" action="">
                <input type="hidden" id="ed_goal_indicator_id" name="id" />
                <input type="hidden" id="ed_goal_indicator_add_disaggs" name="disaggregations" />

                <div class="modal-header">
                    <h5 class="modal-title">Edit indicator</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- title -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Goal</label>
                                <br/>
                                <label id="ed_goal_indicator_desc"></label>
                            </div>
                        </div>
                    </div>

                    <!-- title and reporting frequency -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Title<span class="text-danger">*</span></label>
                                <input id="ed_goal_indicator_title" name="title" type="text" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Reporting Frequency<span class="text-danger">*</span></label>
                                <select id="ed_goal_indicator_reporting_frequency" name="reporting_frequency" class="form-control" required="">
                                    <option value=""></option>
                                    <option value="Monthly">Monthly</option>
                                    <option value="Bi-Monthly">Bi-Monthly</option>
                                    <option value="Quarterly">Quarterly</option>
                                    <option value="Semi-Annual">Semi-Annual</option>
                                    <option value="Annual">Annual</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- description -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Description <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                                <textarea id="ed_goal_indicator_description" name="description" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- means of variation and target -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Disaggregation<span class="text-danger">*</span></label>
                                <select id="ed_goal_indicator_add_target_type" name="target_type" class="form-control" required="">
                                    <option value=""></option>
                                    <option value="Disaggregation">Disaggregation</option>
                                    <option value="None">None</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- baseline and target -->
                    <div id="ed_goal_indicator_add_target_baseline_section" class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="font-weight-bolder">Baseline <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                                <input id="ed_goal_indicator_baseline" name="baseline" type="number" step="any" class="form-control" />
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="font-weight-bolder">Target <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                                <input id="ed_goal_indicator_target" name="target" type="number" step="any" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <!-- disaggregations -->
                    <div id="ed_goal_indicator_add_disagg_section">
                        <div class="separator separator-dashed mt-8 mb-8"></div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="font-weight-bolder text-muted font-italic">Label</label>
                                    <input id="ed_goal_indicator_add_disag_label" type="text" class="form-control" placeholder="e.g. Male" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="font-weight-bolder text-muted font-italic">Baseline</label>
                                    <input id="ed_goal_indicator_add_disag_baseline" type="number" step="any" class="form-control" placeholder="e.g. 10" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="font-weight-bolder text-muted font-italic">Target</label>
                                    <div class="input-group">
                                        <input id="ed_goal_indicator_add_disag_target" type="number" step="any" class="form-control" placeholder="e.g. 10" />
                                        <div class="input-group-append">
                                            <button class="btn btn-secondary" type="button" onclick="ed_add_goal_indicator_disag();">ADD</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive-lg">
                                    <table id="ed_goal_indicator_add_disagg_values" class="table">
                                        <caption>Disaggregation Data</caption>
                                        <thead>
                                            <tr>
                                                <th>Label</th>
                                                <th>Baseline</th>
                                                <th>Target</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-borderless"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="separator separator-dashed mt-8 mb-8"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-success font-weight-bold">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- add activity -->
<div class="modal fade" id="addGoalActivityDialog" tabindex="-1" role="dialog" aria-labelledby="addGoalActivityDialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form id="addGoalActivityForm" name="addGoalActivityForm" method="post" action="">
                <input type="hidden" name="project_id" value="9" />
                <input type="hidden" name="link_type" value="GOAL" />
                <input type="hidden" id="goal_activity_link_id" name="link_id" />
                <input type="hidden" id="goal_activity_link_description" name="link_description" />

                <div class="modal-header">
                    <h5 class="modal-title">Add new goal activity</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- code -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Code <small class="text-muted font-weight-bolder text-uppercase">(Optional)</small></label>
                                <input name="code" type="text" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <!-- title -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Title<span class="text-danger">*</span></label>
                                <input name="title" type="text" class="form-control" required />
                            </div>
                        </div>
                    </div>

                    <!-- description -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Description <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                                <textarea name="description" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-success font-weight-bold">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- edit activity -->
<div class="modal fade" id="editGoalActivityDialog" tabindex="-1" role="dialog" aria-labelledby="editGoalActivityDialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form id="editGoalActivityForm" name="editGoalActivityForm" method="post" action="">
                <input type="hidden" id="goal_activity_id" name="id" />

                <div class="modal-header">
                    <h5 class="modal-title">Edit activity info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- code -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Code <small class="text-muted font-weight-bolder text-uppercase">(Optional)</small></label>
                                <input id="ed_goal_activity_code" name="code" type="text" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <!-- title -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Title<span class="text-danger">*</span></label>
                                <input id="ed_goal_activity_title" name="title" type="text" class="form-control" required />
                            </div>
                        </div>
                    </div>

                    <!-- description -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Description <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                                <textarea id="ed_goal_activity_description" name="description" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- start date and end date and status-->
                    <div class="row">
                        <!-- start date -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="font-weight-bolder">Start Date<span class="text-danger">*</span></label>
                                <input id="ed_goal_activity_start_date" name="start_date" type="text" class="form-control start-date" required="" readonly />
                            </div>
                        </div>

                        <!-- end date -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="font-weight-bolder">End Date<span class="text-danger">*</span></label>
                                <input id="ed_goal_activity_end_date" name="end_date" type="text" class="form-control end-date" required="" readonly />
                            </div>
                        </div>

                        <!-- activity type -->
                        <div class="col-lg-3">
                            <!-- notes -->
                            <div class="form-group">
                                <label class="font-weight-bolder">Activity Type<span class="text-danger">*</span></label>
                                <select id="ed_goal_activity_activity_type" name="activity_type" class="form-control" required="">
                                    <option value=""></option>
                                    <option value="Administration">Administration</option>
                                    <option value="Construction">Construction</option>
                                    <option value="Planning">Planning</option>
                                    <option value="Research/Evaluation">Research/Evaluation</option>
                                    <option value="Resource provision">Resource provision</option>
                                    <option value="Service delivery">Service delivery</option>
                                    <option value="Survey">Survey</option>
                                    <option value="Training">Training</option>
                                </select>
                            </div>
                        </div>

                        <!-- status -->
                        <div class="col-lg-3">
                            <!-- notes -->
                            <div class="form-group">
                                <label class="font-weight-bolder">Status<span class="text-danger">*</span></label>
                                <select id="ed_goal_activity_status" name="status" class="form-control" required="">
                                    <option value=""></option>
                                    <option value="Not Started">Not Started</option>
                                    <option value="Ongoing">Ongoing</option>
                                    <option value="Paused">Paused</option>
                                    <option value="Completed">Completed</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- assignee -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Assignee <small class="text-muted font-weight-bolder text-uppercase">(Optional)</small></label>
                                <input id="ed_goal_activity_assignee" name="assignee" type="text" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <!-- budget and expenditure -->
                    <div class="row">
                        <!-- budget -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Budget<span class="text-danger">*</span></label>
                                <input id="ed_goal_activity_budget" name="budget" type="number" step="any" class="form-control" required="" />
                            </div>
                        </div>

                        <!-- expenditure -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Expenditure <small class="text-muted font-weight-bolder text-uppercase">(Optional)</small></label>
                                <input id="ed_goal_activity_expenditure" name="expenditure" type="number" step="any" class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-success font-weight-bold">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- add output -->
<div class="modal fade" id="addOutputDialog" tabindex="-1" role="dialog" aria-labelledby="addOutputDialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="addOutputForm" name="addOutputForm" method="post" action="">
                <input type="hidden" id="output_outcome_id" name="outcome_id" />
                <input type="hidden" id="output_outcome_description" name="outcome_description" />

                <div class="modal-header">
                    <h5 class="modal-title">Add Output</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- title -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Outcome</label>
                                <br/>
                                <label id="output_outcome_desc"></label>
                            </div>
                        </div>
                    </div>

                    <!-- title -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Title<span class="text-danger">*</span></label>
                                <input name="title" type="text" class="form-control" required="" />
                            </div>
                        </div>
                    </div>

                    <!-- description -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Description <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                                <textarea name="description" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-success font-weight-bold">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- edit output -->
<div class="modal fade" id="editOutputDialog" tabindex="-1" role="dialog" aria-labelledby="editOutputDialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="editOutputForm" name="editOutputForm" method="post" action="">
                <input type="hidden" id="ed_output_id" name="output_id" />

                <div class="modal-header">
                    <h5 class="modal-title">Edit Output</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- title -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Outcome</label>
                                <br/>
                                <label id="ed_output_outcome_desc"></label>
                            </div>
                        </div>
                    </div>

                    <!-- title -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Title<span class="text-danger">*</span></label>
                                <input id="ed_output_title" name="title" type="text" class="form-control" required="" />
                            </div>
                        </div>
                    </div>

                    <!-- description -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Description <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                                <textarea id="ed_output_description" name="description" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-success font-weight-bold">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- add indicator -->
<div class="modal fade" id="addOutcomeIndicatorDialog" tabindex="-1" role="dialog" aria-labelledby="addOutcomeIndicatorDialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form id="addOutcomeIndicatorForm" name="addOutcomeIndicatorForm" method="post" action="">
                <input type="hidden" id="outcome_indicator_id" name="outcome_id" />
                <input type="hidden" id="outcome_indicator_description" name="outcome_description" />
                <input type="hidden" id="outcome_indicator_add_disaggs" name="disaggregations" />

                <div class="modal-header">
                    <h5 class="modal-title">Add outcome indicator</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- title -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Outcome</label>
                                <br/>
                                <label id="outcome_indicator_desc"></label>
                            </div>
                        </div>
                    </div>

                    <!-- title and reporting frequency -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Title<span class="text-danger">*</span></label>
                                <input name="title" type="text" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Reporting Frequency<span class="text-danger">*</span></label>
                                <select name="reporting_frequency" class="form-control" required="">
                                    <option value=""></option>
                                    <option value="Monthly">Monthly</option>
                                    <option value="Bi-Monthly">Bi-Monthly</option>
                                    <option value="Quarterly">Quarterly</option>
                                    <option value="Semi-Annual">Semi-Annual</option>
                                    <option value="Annual">Annual</option>
                                    <option value="Annual">Mid-Term</option>
                                    <option value="Annual">End-Term</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- description -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Description<span class="text-danger">*</span></label>
                                <textarea name="description" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- disaggregation -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Disaggregation<span class="text-danger">*</span></label>
                                <select id="outcome_indicator_add_target_type" name="target_type" class="form-control" required="">
                                    <option value=""></option>
                                    <option value="Disaggregation">Disaggregation</option>
                                    <option value="None">None</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- baseline and target -->
                    <div id="outcome_indicator_add_target_baseline_section" class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Label <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                                <input name="label" type="number" step="any" class="form-control" />
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Baseline <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                                <input name="baseline" type="number" step="any" class="form-control" />
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Target <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                                <input name="target" type="number" step="any" class="form-control" />
                            </div>
                        </div>
                    </div>
                    
                    <!-- disaggregations -->
                    <div id="outcome_indicator_add_disagg_section">
                        <div class="separator separator-dashed mt-8 mb-8"></div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="font-weight-bolder text-muted font-italic">Label</label>
                                    <input id="outcome_indicator_add_disag_label" type="text" class="form-control" placeholder="e.g. Male" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="font-weight-bolder text-muted font-italic">Baseline</label>
                                    <input id="outcome_indicator_add_disag_baseline" type="number" step="any" class="form-control" placeholder="e.g. 10" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="font-weight-bolder text-muted font-italic">Target</label>
                                    <div class="input-group">
                                        <input id="outcome_indicator_add_disag_target" type="number" step="any" class="form-control" placeholder="e.g. 10" />
                                        <div class="input-group-append">
                                            <button class="btn btn-secondary" type="button" onclick="add_outcome_indicator_disag();">ADD</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive-lg">
                                    <table id="outcome_indicator_add_disagg_values" class="table">
                                        <caption>Disaggregation Data</caption>
                                        <thead>
                                            <tr>
                                                <th>Label</th>
                                                <th>Baseline</th>
                                                <th>Target</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-borderless"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="separator separator-dashed mt-8 mb-8"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-success font-weight-bold">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- edit indicator -->
<div class="modal fade" id="editOutcomeIndicatorDialog" tabindex="-1" role="dialog" aria-labelledby="editOutcomeIndicatorDialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form id="editOutcomeIndicatorForm" name="editOutcomeIndicatorForm" method="post" action="">
                <input type="hidden" id="ed_outcome_indicator_id" name="id" />
                <input type="hidden" id="ed_outcome_indicator_add_disaggs" name="disaggregations" />

                <div class="modal-header">
                    <h5 class="modal-title">Edit outcome indicator</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- title -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Outcome</label>
                                <br/>
                                <label id="ed_outcome_indicator_desc"></label>
                            </div>
                        </div>
                    </div>

                    <!-- title and reporting frequency -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Title<span class="text-danger">*</span></label>
                                <input id="ed_outcome_indicator_title" name="title" type="text" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Reporting Frequency<span class="text-danger">*</span></label>
                                <select id="ed_outcome_indicator_reporting_frequency" name="reporting_frequency" class="form-control" required="">
                                    <option value=""></option>
                                    <option value="Monthly">Monthly</option>
                                    <option value="Bi-Monthly">Bi-Monthly</option>
                                    <option value="Quarterly">Quarterly</option>
                                    <option value="Semi-Annual">Semi-Annual</option>
                                    <option value="Annual">Annual</option>
                                    <option value="Annual">Mid-Term</option>
                                    <option value="Annual">End-Term</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- description -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Description<span class="text-danger">*</span></label>
                                <textarea id="ed_outcome_indicator_description" name="description" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- means of variation and target -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Disaggregation<span class="text-danger">*</span></label>
                                <select id="ed_outcome_indicator_add_target_type" name="target_type" class="form-control" required="">
                                    <option value=""></option>
                                    <option value="Disaggregation">Disaggregation</option>
                                    <option value="None">None</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- baseline and target -->
                    <div id="ed_outcome_indicator_add_target_baseline_section" class="row">

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="font-weight-bolder">Label <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                                <input id="ed_outcome_indicator_baseline" name="label" type="number" step="any" class="form-control" />
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="font-weight-bolder">Baseline <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                                <input id="ed_outcome_indicator_baseline" name="baseline" type="number" step="any" class="form-control" />
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="font-weight-bolder">Target <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                                <input id="ed_outcome_indicator_target" name="target" type="number" step="any" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <!-- disaggregations -->
                    <div id="ed_outcome_indicator_add_disagg_section">
                        <div class="separator separator-dashed mt-8 mb-8"></div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="font-weight-bolder text-muted font-italic">Label</label>
                                    <input id="ed_outcome_indicator_add_disag_label" type="text" class="form-control" placeholder="e.g. Male" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="font-weight-bolder text-muted font-italic">Baseline</label>
                                    <input id="ed_outcome_indicator_add_disag_baseline" type="number" step="any" class="form-control" placeholder="e.g. 10" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="font-weight-bolder text-muted font-italic">Target</label>
                                    <div class="input-group">
                                        <input id="ed_outcome_indicator_add_disag_target" type="number" step="any" class="form-control" placeholder="e.g. 10" />
                                        <div class="input-group-append">
                                            <button class="btn btn-secondary" type="button" onclick="ed_add_outcome_indicator_disag();">ADD</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive-lg">
                                    <table id="ed_outcome_indicator_add_disagg_values" class="table">
                                        <caption>Disaggregation Data</caption>
                                        <thead>
                                            <tr>
                                                <th>Label</th>
                                                <th>Baseline</th>
                                                <th>Target</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-borderless"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="separator separator-dashed mt-8 mb-8"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-success font-weight-bold">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- add activity -->
<div class="modal fade" id="addOutcomeActivityDialog" tabindex="-1" role="dialog" aria-labelledby="addOutcomeActivityDialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form id="addOutcomeActivityForm" name="addOutcomeActivityForm" method="post" action="">
                <input type="hidden" name="project_id" value="9" />
                <input type="hidden" name="link_type" value="OUTCOME" />
                <input type="hidden" id="outcome_activity_link_id" name="link_id" />
                <input type="hidden" id="outcome_activity_link_description" name="link_description" />

                <div class="modal-header">
                    <h5 class="modal-title">Add a new activity</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- code -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Code <small class="text-muted font-weight-bolder text-uppercase">(Optional)</small></label>
                                <input name="code" type="text" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <!-- title -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Title<span class="text-danger">*</span></label>
                                <input name="title" type="text" class="form-control" required />
                            </div>
                        </div>
                    </div>

                    <!-- description -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Description <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                                <textarea name="description" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- start date and end date and status-->
                    <div class="row">
                        <!-- start date -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="font-weight-bolder">Start Date<span class="text-danger">*</span></label>
                                <input name="start_date" type="text" class="form-control start-date" required="" readonly />
                            </div>
                        </div>

                        <!-- end date -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="font-weight-bolder">End Date<span class="text-danger">*</span></label>
                                <input name="end_date" type="text" class="form-control end-date" required="" readonly />
                            </div>
                        </div>

                        <!-- activity type -->
                        <div class="col-lg-3">
                            <!-- notes -->
                            <div class="form-group">
                                <label class="font-weight-bolder">Activity Type<span class="text-danger">*</span></label>
                                <select name="activity_type" class="form-control" required="">
                                    <option value=""></option>
                                    <option value="Administration">Administration</option>
                                    <option value="Construction">Construction</option>
                                    <option value="Planning">Planning</option>
                                    <option value="Research/Evaluation">Research/Evaluation</option>
                                    <option value="Resource provision">Resource provision</option>
                                    <option value="Service delivery">Service delivery</option>
                                    <option value="Survey">Survey</option>
                                    <option value="Training">Training</option>
                                </select>
                            </div>
                        </div>

                        <!-- status -->
                        <div class="col-lg-3">
                            <!-- notes -->
                            <div class="form-group">
                                <label class="font-weight-bolder">Status<span class="text-danger">*</span></label>
                                <select id="outcome_activity_status" name="status" class="form-control" required="">
                                    <option value=""></option>
                                    <option value="Not Started">Not Started</option>
                                    <option value="Ongoing">Ongoing</option>
                                    <option value="Paused">Paused</option>
                                    <option value="Completed">Completed</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- assignee -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Assignee <small class="text-muted font-weight-bolder text-uppercase">(Optional)</small></label>
                                <input name="assignee" type="text" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <!-- budget and expenditure -->
                    <div class="row">
                        <!-- budget -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Budget<span class="text-danger">*</span></label>
                                <input name="budget" type="number" step="any" class="form-control" required="" />
                            </div>
                        </div>

                        <!-- expenditure -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Expenditure <small class="text-muted font-weight-bolder text-uppercase">(Optional)</small></label>
                                <input id="outcome_activity_expenditure" name="expenditure" type="number" step="any" class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-success font-weight-bold">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- edit activity -->
<div class="modal fade" id="editOutcomeActivityDialog" tabindex="-1" role="dialog" aria-labelledby="editOutcomeActivityDialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form id="editOutcomeActivityForm" name="editOutcomeActivityForm" method="post" action="">
                <input type="hidden" id="outcome_activity_id" name="id" />

                <div class="modal-header">
                    <h5 class="modal-title">Edit activity info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- code -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Code <small class="text-muted font-weight-bolder text-uppercase">(Optional)</small></label>
                                <input id="ed_outcome_activity_code" name="code" type="text" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <!-- title -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Title<span class="text-danger">*</span></label>
                                <input id="ed_outcome_activity_title" name="title" type="text" class="form-control" required />
                            </div>
                        </div>
                    </div>

                    <!-- description -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Description <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                                <textarea id="ed_outcome_activity_description" name="description" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- start date and end date and status-->
                    <div class="row">
                        <!-- start date -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="font-weight-bolder">Start Date<span class="text-danger">*</span></label>
                                <input id="ed_outcome_activity_start_date" name="start_date" type="text" class="form-control start-date" required="" readonly />
                            </div>
                        </div>

                        <!-- end date -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="font-weight-bolder">End Date<span class="text-danger">*</span></label>
                                <input id="ed_outcome_activity_end_date" name="end_date" type="text" class="form-control end-date" required="" readonly />
                            </div>
                        </div>

                        <!-- activity type -->
                        <div class="col-lg-3">
                            <!-- notes -->
                            <div class="form-group">
                                <label class="font-weight-bolder">Activity Type<span class="text-danger">*</span></label>
                                <select id="ed_outcome_activity_activity_type" name="activity_type" class="form-control" required="">
                                    <option value=""></option>
                                    <option value="Administration">Administration</option>
                                    <option value="Construction">Construction</option>
                                    <option value="Planning">Planning</option>
                                    <option value="Research/Evaluation">Research/Evaluation</option>
                                    <option value="Resource provision">Resource provision</option>
                                    <option value="Service delivery">Service delivery</option>
                                    <option value="Survey">Survey</option>
                                    <option value="Training">Training</option>
                                </select>
                            </div>
                        </div>

                        <!-- status -->
                        <div class="col-lg-3">
                            <!-- notes -->
                            <div class="form-group">
                                <label class="font-weight-bolder">Status<span class="text-danger">*</span></label>
                                <select id="ed_outcome_activity_status" name="status" class="form-control" required="">
                                    <option value=""></option>
                                    <option value="Not Started">Not Started</option>
                                    <option value="Ongoing">Ongoing</option>
                                    <option value="Paused">Paused</option>
                                    <option value="Completed">Completed</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- assignee -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Assignee <small class="text-muted font-weight-bolder text-uppercase">(Optional)</small></label>
                                <input id="ed_outcome_activity_assignee" name="assignee" type="text" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <!-- budget and expenditure -->
                    <div class="row">
                        <!-- budget -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Budget<span class="text-danger">*</span></label>
                                <input id="ed_outcome_activity_budget" name="budget" type="number" step="any" class="form-control" required="" />
                            </div>
                        </div>

                        <!-- expenditure -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Expenditure <small class="text-muted font-weight-bolder text-uppercase">(Optional)</small></label>
                                <input id="ed_outcome_activity_expenditure" name="expenditure" type="number" step="any" class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-success font-weight-bold">Save</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- add indicator -->
<div class="modal fade" id="addOutputIndicatorDialog" tabindex="-1" role="dialog" aria-labelledby="addOutputIndicatorDialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form id="addOutputIndicatorForm" name="addOutputIndicatorForm" method="post" action="">
                <input type="hidden" id="output_indicator_id" name="output_id" />
                <input type="hidden" id="output_indicator_description" name="output_description" />
                <input type="hidden" id="output_indicator_add_disaggs" name="disaggregations" />

                <div class="modal-header">
                    <h5 class="modal-title">Add output indicator</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- title -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Output</label>
                                <br/>
                                <label id="output_indicator_desc"></label>
                            </div>
                        </div>
                    </div>

                    <!-- title and reporting frequency -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Title<span class="text-danger">*</span></label>
                                <input name="title" type="text" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Reporting Frequency<span class="text-danger">*</span></label>
                                <select name="reporting_frequency" class="form-control" required="">
                                    <option value=""></option>
                                    <option value="Monthly">Monthly</option>
                                    <option value="Bi-Monthly">Bi-Monthly</option>
                                    <option value="Quarterly">Quarterly</option>
                                    <option value="Semi-Annual">Semi-Annual</option>
                                    <option value="Annual">Annual</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- description -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Description<span class="text-danger">*</span></label>
                                <textarea name="description" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- disaggregation -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Disaggregation<span class="text-danger">*</span></label>
                                <select id="output_indicator_add_target_type" name="target_type" class="form-control" required="">
                                    <option value=""></option>
                                    <option value="Disaggregation">Disaggregation</option>
                                    <option value="None">None</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- baseline and target -->
                    <div id="output_indicator_add_target_baseline_section" class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Label <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                                <input name="label" type="number" step="any" class="form-control" />
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Baseline <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                                <input name="baseline" type="number" step="any" class="form-control" />
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Target <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                                <input name="target" type="number" step="any" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <!-- disaggregations -->
                    <div id="output_indicator_add_disagg_section">
                        <div class="separator separator-dashed mt-8 mb-8"></div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="font-weight-bolder text-muted font-italic">Label</label>
                                    <input id="output_indicator_add_disag_label" type="text" class="form-control" placeholder="e.g. Male" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="font-weight-bolder text-muted font-italic">Baseline</label>
                                    <input id="output_indicator_add_disag_baseline" type="number" step="any" class="form-control" placeholder="e.g. 10" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="font-weight-bolder text-muted font-italic">Target</label>
                                    <div class="input-group">
                                        <input id="output_indicator_add_disag_target" type="number" step="any" class="form-control" placeholder="e.g. 10" />
                                        <div class="input-group-append">
                                            <button class="btn btn-secondary" type="button" onclick="add_output_indicator_disag();">ADD</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive-lg">
                                    <table id="output_indicator_add_disagg_values" class="table">
                                        <caption>Disaggregation Data</caption>
                                        <thead>
                                            <tr>
                                                <th>Label</th>
                                                <th>Baseline</th>
                                                <th>Target</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-borderless"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="separator separator-dashed mt-8 mb-8"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-success font-weight-bold">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade zoom" tabindex="-1" id="modalZoom87">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Annual Work Plan Name</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="nk-block nk-block-lg">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <ul class="nav nav-tabs mt-n3">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem5fgt56"><em class="icon ni ni-user"></em><span>Annual Work Plan</span></a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem5fgt56">
                                    <form method="POST" action="{{ route('createwpcontainer')}}">
                                        @csrf
                                        <div class="row gy-4">

                                           <input type="hidden" class="form-control" value="01" name="status" id="default-01">
                                           <input type="hidden" class="form-control" value="{{Auth::user()->id}}" name="created_by" id="default-01">
                                           <input type="hidden" class="form-control" value="{{Auth::user()->organization_id}}" name="organization_id" id="default-01">
                                           <input type="hidden" class="form-control" value="{{$projectshow->id}}" name="project_id" id="default-01">

                                           <div class="form-group">
                                            <label class="form-label" for="default-01">Annual Work plan Name</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" name="container_name" id="default-01" placeholder="Input Work Plan Container Name">
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="default-06">Financial Year</label>
                                                <div class="form-control-wrap ">
                                                    <div class="form-control-select">
                                                        <select class="form-control" name="financial_year" id="financial_year">
                                                            <option value="null">-------Select Financial Year-------</option>
                                                            <option value="null"></option>
                                                            @foreach($years as $obj)
                                                            <option value="{{$obj->year_name}}">{{$obj->year_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="default-06">Planning Type</label>
                                                <div class="form-control-wrap ">
                                                    <div class="form-control-select">
                                                        <select class="form-control" name="planning_type" id="planning_type">
                                                            <option value="null">-------Select Plan Types-------</option>
                                                            <option value="null"></option>
                                                            <option value="Activity">Activities</option>
                                                            <option value="Indicator">Indicators</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <!-- <button type="submit" class="btn btn-primary"></button> -->
                                    </div>
                                    <br>
                                    <button style="margin-left: 40%;" type="submit" class="btn btn-round btn-primary"><em class="icon ni ni-navigate-fill"></em>&nbsp Save Container</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer bg-light">
            <span class="sub-text"></span>
        </div>
    </div>
</div>
</div>


<!-- edit indicator -->
<div class="modal fade" id="editOutputIndicatorDialog" tabindex="-1" role="dialog" aria-labelledby="editOutputIndicatorDialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form id="editOutputIndicatorForm" name="editOutputIndicatorForm" method="post" action="">
                <input type="hidden" id="ed_output_indicator_id" name="id" />
                <input type="hidden" id="ed_output_indicator_add_disaggs" name="disaggregations" />

                <div class="modal-header">
                    <h5 class="modal-title">Edit indicator</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- title -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Output</label>
                                <br/>
                                <label id="ed_output_indicator_desc"></label>
                            </div>
                        </div>
                    </div>

                    <!-- title and reporting frequency -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Title<span class="text-danger">*</span></label>
                                <input id="ed_output_indicator_title" name="title" type="text" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Reporting Frequency<span class="text-danger">*</span></label>
                                <select id="ed_output_indicator_reporting_frequency" name="reporting_frequency" class="form-control" required="">
                                    <option value=""></option>
                                    <option value="Monthly">Monthly</option>
                                    <option value="Bi-Monthly">Bi-Monthly</option>
                                    <option value="Quarterly">Quarterly</option>
                                    <option value="Semi-Annual">Semi-Annual</option>
                                    <option value="Annual">Annual</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- description -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Description<span class="text-danger">*</span></label>
                                <textarea id="ed_output_indicator_description" name="description" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- means of variation and target -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Disaggregation<span class="text-danger">*</span></label>
                                <select id="ed_output_indicator_add_target_type" name="target_type" class="form-control" required="">
                                    <option value=""></option>
                                    <option value="Disaggregation">Disaggregation</option>
                                    <option value="None">None</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- baseline and target -->
                    <div id="ed_output_indicator_add_target_baseline_section" class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="font-weight-bolder">Baseline <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                                <input id="ed_output_indicator_baseline" name="baseline" type="number" step="any" class="form-control" />
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="font-weight-bolder">Target <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                                <input id="ed_output_indicator_target" name="target" type="number" step="any" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <!-- disaggregations -->
                    <div id="ed_output_indicator_add_disagg_section">
                        <div class="separator separator-dashed mt-8 mb-8"></div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="font-weight-bolder text-muted font-italic">Label</label>
                                    <input id="ed_output_indicator_add_disag_label" type="text" class="form-control" placeholder="e.g. Male" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="font-weight-bolder text-muted font-italic">Baseline</label>
                                    <input id="ed_output_indicator_add_disag_baseline" type="number" step="any" class="form-control" placeholder="e.g. 10" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="font-weight-bolder text-muted font-italic">Target</label>
                                    <div class="input-group">
                                        <input id="ed_output_indicator_add_disag_target" type="number" step="any" class="form-control" placeholder="e.g. 10" />
                                        <div class="input-group-append">
                                            <button class="btn btn-secondary" type="button" onclick="ed_add_output_indicator_disag();">ADD</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive-lg">
                                    <table id="ed_output_indicator_add_disagg_values" class="table">
                                        <caption>Disaggregation Data</caption>
                                        <thead>
                                            <tr>
                                                <th>Label</th>
                                                <th>Baseline</th>
                                                <th>Target</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-borderless"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="separator separator-dashed mt-8 mb-8"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-success font-weight-bold">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- add output activity -->
<div class="modal fade" id="addOutputActivityDialog" tabindex="-1" role="dialog" aria-labelledby="addOutputActivityDialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form id="addOutputActivityForm" name="addOutputActivityForm" method="post" action="">
                <input type="hidden" name="project_id" value="9" />
                <input type="hidden" name="link_type" value="OUTPUT" />
                <input type="hidden" id="output_activity_link_id" name="link_id" />
                <input type="hidden" id="output_activity_link_description" name="link_description" />

                <div class="modal-header">
                    <h5 class="modal-title">Add a new activity</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- code -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Code <small class="text-muted font-weight-bolder text-uppercase">(Optional)</small></label>
                                <input name="code" type="text" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <!-- title -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Title<span class="text-danger">*</span></label>
                                <input name="title" type="text" class="form-control" required />
                            </div>
                        </div>
                    </div>

                    <!-- description -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Description <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                                <textarea name="description" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- start date and end date and status-->
                    <div class="row">
                        <!-- start date -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="font-weight-bolder">Start Date<span class="text-danger">*</span></label>
                                <input name="start_date" type="text" class="form-control start-date" required="" readonly />
                            </div>
                        </div>

                        <!-- end date -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="font-weight-bolder">End Date<span class="text-danger">*</span></label>
                                <input name="end_date" type="text" class="form-control end-date" required="" readonly />
                            </div>
                        </div>

                        <!-- activity type -->
                        <div class="col-lg-3">
                            <!-- notes -->
                            <div class="form-group">
                                <label class="font-weight-bolder">Activity Type<span class="text-danger">*</span></label>
                                <select name="activity_type" class="form-control" required="">
                                    <option value=""></option>
                                    <option value="Administration">Administration</option>
                                    <option value="Construction">Construction</option>
                                    <option value="Planning">Planning</option>
                                    <option value="Research/Evaluation">Research/Evaluation</option>
                                    <option value="Resource provision">Resource provision</option>
                                    <option value="Service delivery">Service delivery</option>
                                    <option value="Survey">Survey</option>
                                    <option value="Training">Training</option>
                                </select>
                            </div>
                        </div>

                        <!-- status -->
                        <div class="col-lg-3">
                            <!-- notes -->
                            <div class="form-group">
                                <label class="font-weight-bolder">Status<span class="text-danger">*</span></label>
                                <select id="output_activity_status" name="status" class="form-control" required="">
                                    <option value=""></option>
                                    <option value="Not Started">Not Started</option>
                                    <option value="Ongoing">Ongoing</option>
                                    <option value="Paused">Paused</option>
                                    <option value="Completed">Completed</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- assignee -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Assignee <small class="text-muted font-weight-bolder text-uppercase">(Optional)</small></label>
                                <input name="assignee" type="text" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <!-- budget and expenditure -->
                    <div class="row">
                        <!-- budget -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Budget<span class="text-danger">*</span></label>
                                <input name="budget" type="number" step="any" class="form-control" required="" />
                            </div>
                        </div>

                        <!-- expenditure -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Expenditure <small class="text-muted font-weight-bolder text-uppercase">(Optional)</small></label>
                                <input id="output_activity_expenditure" name="expenditure" type="number" step="any" class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-success font-weight-bold">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- edit output activity -->
<div class="modal fade" id="editOutputActivityDialog" tabindex="-1" role="dialog" aria-labelledby="editOutputActivityDialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form id="editOutputActivityForm" name="editOutputActivityForm" method="post" action="">
                <input type="hidden" id="output_activity_id" name="id" />

                <div class="modal-header">
                    <h5 class="modal-title">Edit activity info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- code -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Code <small class="text-muted font-weight-bolder text-uppercase">(Optional)</small></label>
                                <input id="ed_output_activity_code" name="code" type="text" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <!-- title -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Title<span class="text-danger">*</span></label>
                                <input id="ed_output_activity_title" name="title" type="text" class="form-control" required />
                            </div>
                        </div>
                    </div>

                    <!-- description -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Description <small class="text-muted font-weight-bolder">(OPTIONAL)</small></label>
                                <textarea id="ed_output_activity_description" name="description" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- start date and end date and status-->
                    <div class="row">
                        <!-- start date -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="font-weight-bolder">Start Date<span class="text-danger">*</span></label>
                                <input id="ed_output_activity_start_date" name="start_date" type="text" class="form-control start-date" required="" readonly />
                            </div>
                        </div>

                        <!-- end date -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="font-weight-bolder">End Date<span class="text-danger">*</span></label>
                                <input id="ed_output_activity_end_date" name="end_date" type="text" class="form-control end-date" required="" readonly />
                            </div>
                        </div>

                        <!-- activity type -->
                        <div class="col-lg-3">
                            <!-- notes -->
                            <div class="form-group">
                                <label class="font-weight-bolder">Activity Type<span class="text-danger">*</span></label>
                                <select id="ed_output_activity_activity_type" name="activity_type" class="form-control" required="">
                                    <option value=""></option>
                                    <option value="Administration">Administration</option>
                                    <option value="Construction">Construction</option>
                                    <option value="Planning">Planning</option>
                                    <option value="Research/Evaluation">Research/Evaluation</option>
                                    <option value="Resource provision">Resource provision</option>
                                    <option value="Service delivery">Service delivery</option>
                                    <option value="Survey">Survey</option>
                                    <option value="Training">Training</option>
                                </select>
                            </div>
                        </div>

                        <!-- status -->
                        <div class="col-lg-3">
                            <!-- notes -->
                            <div class="form-group">
                                <label class="font-weight-bolder">Status<span class="text-danger">*</span></label>
                                <select id="ed_output_activity_status" name="status" class="form-control" required="">
                                    <option value=""></option>
                                    <option value="Not Started">Not Started</option>
                                    <option value="Ongoing">Ongoing</option>
                                    <option value="Paused">Paused</option>
                                    <option value="Completed">Completed</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- assignee -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bolder">Assignee <small class="text-muted font-weight-bolder text-uppercase">(Optional)</small></label>
                                <input id="ed_output_activity_assignee" name="assignee" type="text" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <!-- budget and expenditure -->
                    <div class="row">
                        <!-- budget -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Budget<span class="text-danger">*</span></label>
                                <input id="ed_output_activity_budget" name="budget" type="number" step="any" class="form-control" required="" />
                            </div>
                        </div>

                        <!-- expenditure -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Expenditure <small class="text-muted font-weight-bolder text-uppercase">(Optional)</small></label>
                                <input id="ed_output_activity_expenditure" name="expenditure" type="number" step="any" class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-success font-weight-bold">Save</button>
                </div>
            </form>
        </div>
    </div>
</div> 


<div class="modal fade zoom" tabindex="-1" id="submitintervention1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Submit Intervention</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="nk-block nk-block-lg">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <ul class="nav nav-tabs mt-n3">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem589790"><em class="icon ni ni-table"></em><span>Submit Intervention</span></a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem589790">
                                    <form method="POST" action="{{ route('submitintervention')}}">
                                        @csrf
                                        <div class="row gy-4">

                                            <script type="text/javascript">
                                                $(document).ready(function() {
                                                    $('#users_id').change(function(){
                                                        $.get("{{ url('api/submittedemail')}}",
                                                            { option: $(this).val() },
                                                            function(data) {
                                                                console.log('submittedemail');
                                                                $('#submittedemail').val(data);
                                                            });
                                                    });
                                                });
                                            </script>

                                            <script type="text/javascript">
                                                $(document).ready(function() {
                                                    $('#users_id').change(function(){
                                                        $.get("{{ url('api/submiitedname')}}",
                                                            { option: $(this).val() },
                                                            function(data) {
                                                                console.log('submiitedname');
                                                                $('#submiitedname').val(data);
                                                            });
                                                    });
                                                });
                                            </script>

                                            <div class="form-group" id="program">
                                                <label class="form-label" for="default-06">Submit To?</label>
                                                <div class="form-control-wrap ">
                                                    <div class="form-control-select">
                                                        <select class="form-control" id="users_id" name="users_id" >
                                                            <option value="#">Nothing Selected</option>
                                                            <option></option>                                                
                                                            @foreach($projectusers as $object)
                                                            <option value="{{$object->id}}">{{$object->name}}  {{$object->last_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php

                                            $date = date('l dS \of F Y h:i:s A');
                                            ?>

                                            <input type="hidden" name="email" id="submittedemail" />
                                            <input type="hidden" name="name" id="submiitedname" />
                                            <input type="hidden" name="submitted_name" value="{{Auth::user()->name}}" />
                                            <input type="hidden" name="submitted_on" value="{{$date}}" />

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="default-textarea">Add Comment</label>
                                                    <div class="form-control-wrap">
                                                        <textarea class="form-control no-resize" name="submission_comment" id="default-textarea"></textarea>
                                                    </div>
                                                </div>
                                            </div> 

                                            <input type="hidden" name="status" value="02">
                                            <input type="hidden" name="submitted_by" value="{{Auth::user()->id}}">
                                            <input type="hidden" name="container_id" id="sibmit_container_id">
                                            <input type="hidden" name="container_name" id="submitted_container_name">

                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <span class="sub-text"></span>
            </div>
        </div>
    </div>
</div> 


<div class="modal fade zoom" tabindex="-1" id="cancelintervention1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cancel Intervention</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="nk-block nk-block-lg">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <ul class="nav nav-tabs mt-n3">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem58979080"><em class="icon ni ni-table"></em><span>Cancel Intervention</span></a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem58979080">
                                    <form method="POST" action="{{ route('cancelintervention')}}">
                                        @csrf
                                        <div class="row gy-4">


                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="default-textarea">Add Comment</label>
                                                    <div class="form-control-wrap">
                                                        <textarea class="form-control no-resize" name="cancel_comment" id="default-textarea"></textarea>
                                                    </div>
                                                </div>
                                            </div> 

                                            <input type="hidden" name="status" value="01">
                                            <input type="hidden" name="container_id" id="cancel_container_id">
                                            <input type="hidden" name="container_name" id="cancel_container_name">

                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <span class="sub-text"></span>
            </div>
        </div>
    </div>
</div> 


<div class="modal fade zoom" tabindex="-1" id="timeline1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Timeline</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="nk-block nk-block-lg">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <div class="example-alerts">
                                <div class="gy-4">
                                    <div class="example-alert">
                                        <div class="alert alert-success alert-icon">
                                            <em class="icon ni ni-check-circle"></em> <strong>Intervention Container Created</strong>
                                        </div>
                                    </div>
                                    <!-- <div class="example-alert">
                                        <div class="alert alert-secondary alert-icon">
                                            <em class="icon ni ni-alert-circle"></em> <strong>Order has been placed</strong>. Your will be redirect for make your payment.
                                        </div>
                                    </div>
                                    <div class="example-alert">
                                        <div class="alert alert-success alert-icon">
                                            <em class="icon ni ni-check-circle"></em> <strong>Thanks for your deposit</strong>. Your account balance has been updated accordingly.
                                        </div>
                                    </div>
                                    <div class="example-alert">
                                        <div class="alert alert-info alert-icon">
                                            <em class="icon ni ni-alert-circle"></em> <strong>Order has been placed</strong>. Your will be redirect for make your payment.
                                        </div>
                                    </div>
                                    <div class="example-alert">
                                        <div class="alert alert-warning alert-icon">
                                            <em class="icon ni ni-alert-circle"></em> Your credit card <strong>already expired</strong>. Please enter a valid & up-to-date <a href="#" class="alert-link">credit card</a> for make deposit.
                                        </div>
                                    </div>
                                    <div class="example-alert">
                                        <div class="alert alert-danger alert-icon">
                                            <em class="icon ni ni-cross-circle"></em> <strong>Update failed</strong>! There is some technical issues.
                                        </div>
                                    </div>
                                    <div class="example-alert">
                                        <div class="alert alert-gray alert-icon">
                                            <em class="icon ni ni-alert-circle"></em> Your credit card <strong>already expired</strong>. Please enter a valid & up-to-date <a href="#" class="alert-link">credit card</a> for make deposit.
                                        </div>
                                    </div>
                                    <div class="example-alert">
                                        <div class="alert alert-light alert-icon">
                                            <em class="icon ni ni-alert-circle"></em> Your credit card <strong>already expired</strong>. Please enter a valid & up-to-date <a href="#" class="alert-link">credit card</a> for make deposit.
                                        </div>
                                    </div>
                                    <div class="example-alert">
                                        <div class="alert alert-danger alert-icon alert-dismissible">
                                            <em class="icon ni ni-cross-circle"></em> <strong>Update failed</strong>! There is some technical issues. <button class="close" data-bs-dismiss="alert"></button>
                                        </div>
                                    </div> -->
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <span class="sub-text"></span>
            </div>
        </div>
    </div>
</div> 


<div class="modal fade zoom" tabindex="-1" id="workplan1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Submit WorkPlan</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="nk-block nk-block-lg">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <ul class="nav nav-tabs mt-n3">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem5897901"><em class="icon ni ni-table"></em><span>Submit WorkPlan</span></a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem5897901">
                                    <form method="POST" action="{{ route('submitworkplan')}}">
                                        @csrf
                                        <div class="row gy-4">

                                            <script type="text/javascript">
                                                $(document).ready(function() {
                                                    $('#users_id').change(function(){
                                                        $.get("{{ url('api/submittedemail')}}",
                                                            { option: $(this).val() },
                                                            function(data) {
                                                                console.log('submittedemail');
                                                                $('#submittedemail').val(data);
                                                            });
                                                    });
                                                });
                                            </script>

                                            <script type="text/javascript">
                                                $(document).ready(function() {
                                                    $('#users_id').change(function(){
                                                        $.get("{{ url('api/submiitedname')}}",
                                                            { option: $(this).val() },
                                                            function(data) {
                                                                console.log('submiitedname');
                                                                $('#submiitedname').val(data);
                                                            });
                                                    });
                                                });
                                            </script>

                                            <div class="form-group" id="program">
                                                <label class="form-label" for="default-06">Submit To?</label>
                                                <div class="form-control-wrap ">
                                                    <div class="form-control-select">
                                                        <select class="form-control" id="users_id" name="users_id" >
                                                            <option value="#">Nothing Selected</option>
                                                            <option></option>                                                
                                                            @foreach($projectusers as $object)
                                                            <option value="{{$object->id}}">{{$object->name}}  {{$object->last_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php

                                            $date = date('l dS \of F Y h:i:s A');
                                            ?>

                                            <input type="hidden" name="email" id="submittedemail" />
                                            <input type="hidden" name="name" id="submiitedname" />
                                            <input type="hidden" name="submitted_name" value="{{Auth::user()->name}}" />
                                            <input type="hidden" name="submitted_on" value="{{$date}}" />
                                            <input type="hidden" name="status" value="02">
                                            <input type="hidden" name="submitted_by" value="{{Auth::user()->id}}">
                                            <input type="hidden" name="container_id" id="workplan_container_id">
                                            <input type="hidden" name="container_name" id="workplan_container_name">

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="default-textarea">Add Comment</label>
                                                    <div class="form-control-wrap">
                                                        <textarea class="form-control no-resize" name="submission_comment" id="default-textarea"></textarea>
                                                    </div>
                                                </div>
                                            </div> 

                                            

                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <span class="sub-text"></span>
            </div>
        </div>
    </div>
</div> 

<div class="modal fade zoom" tabindex="-1" id="cancelworkplan1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cancel Workplan Container</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="nk-block nk-block-lg">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <ul class="nav nav-tabs mt-n3">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem589790801"><em class="icon ni ni-table"></em><span>Cancel WorkPlanConatiner</span></a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem589790801">
                                    <form method="POST" action="{{ route('cancelworkplan')}}">
                                        @csrf
                                        <div class="row gy-4">


                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="default-textarea">Add Comment</label>
                                                    <div class="form-control-wrap">
                                                        <textarea class="form-control no-resize" name="cancel_comment" id="default-textarea"></textarea>
                                                    </div>
                                                </div>
                                            </div> 

                                            <?php

                                            $date = date('l dS \of F Y h:i:s A');
                                            ?>

                                            <input type="hidden" name="status" value="01">
                                            <input type="hidden" name="container_id" id="cancelw_container_id">
                                            <input type="hidden" name="container_name" id="cancelw_container_name">
                                            <input type="hidden" name="cancel_date" value="{{$date}}" />

                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <span class="sub-text"></span>
            </div>
        </div>
    </div>
</div> 


<div class="modal fade zoom" tabindex="-1" id="forwardintervention1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Forward Intervention</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="nk-block nk-block-lg">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <ul class="nav nav-tabs mt-n3">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem58979022897"><em class="icon ni ni-table"></em><span>Forward Intervention</span></a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem58979022897">
                                    <form method="POST" action="{{ route('forwardintervention')}}">
                                        @csrf
                                        <div class="row gy-4">

                                            <script type="text/javascript">
                                                $(document).ready(function() {
                                                    $('#users_id1').change(function(){
                                                        $.get("{{ url('api/submittedemail')}}",
                                                            { option: $(this).val() },
                                                            function(data) {
                                                                console.log('submittedemail1');
                                                                $('#submittedemail1').val(data);
                                                            });
                                                    });
                                                });
                                            </script>

                                            <script type="text/javascript">
                                                $(document).ready(function() {
                                                    $('#users_id1').change(function(){
                                                        $.get("{{ url('api/submiitedname')}}",
                                                            { option: $(this).val() },
                                                            function(data) {
                                                                console.log('submiitedname1');
                                                                $('#submiitedname1').val(data);
                                                            });
                                                    });
                                                });
                                            </script>

                                            <div class="form-group" id="program">
                                                <label class="form-label" for="default-06">Submit To?</label>
                                                <div class="form-control-wrap ">
                                                    <div class="form-control-select">
                                                        <select class="form-control" id="users_id1" name="users_id1" >
                                                            <option value="#">Nothing Selected</option>
                                                            <option></option>                                                
                                                            @foreach($projectusers as $object)
                                                            <option value="{{$object->id}}">{{$object->name}}  {{$object->last_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php

                                            $date = date('l dS \of F Y h:i:s A');
                                            ?>

                                            <input type="hidden" name="forward_to_email" id="submittedemail1" />
                                            <input type="hidden" name="forward_to_name" id="submiitedname1" />
                                            <input type="hidden" name="forwarded_by" value="{{Auth::user()->name}}" />
                                            <input type="hidden" name="forwarded_on" value="{{$date}}" />

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="default-textarea">Add Comment</label>
                                                    <div class="form-control-wrap">
                                                        <textarea class="form-control no-resize" name="submission_comment" id="default-textarea"></textarea>
                                                    </div>
                                                </div>
                                            </div> 

                                            <input type="hidden" name="status" value="02">
                                            <input type="hidden" name="forwarded_by" value="{{Auth::user()->id}}">
                                            <input type="hidden" name="container_id" id="forward_container_id">
                                            <input type="hidden" name="container_name" id="forward_container_name">

                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <span class="sub-text"></span>
            </div>
        </div>
    </div>
</div> 


<div class="modal fade zoom" tabindex="-1" id="approveintervention1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Approve Intervention</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="nk-block nk-block-lg">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <ul class="nav nav-tabs mt-n3">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem58979022897"><em class="icon ni ni-table"></em><span>Approve Intervention</span></a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem58979022897">
                                    <form method="POST" action="{{ route('approveintervention')}}">
                                        @csrf
                                        <div class="row gy-4">


                                            <?php

                                            $date = date('l dS \of F Y h:i:s A');
                                            ?>

                                            <input type="hidden" name="approved_by" value="{{Auth::user()->name}}" />
                                            <input type="hidden" name="approved_by_email" value="{{Auth::user()->email}}" />
                                            <input type="hidden" name="approved_on" value="{{$date}}" />

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="default-textarea">Add Comment</label>
                                                    <div class="form-control-wrap">
                                                        <textarea class="form-control no-resize" name="approval_comment" id="default-textarea"></textarea>
                                                    </div>
                                                </div>
                                            </div> 

                                            <input type="hidden" name="status" value="02">
                                            <input type="hidden" name="container_id" id="approve_container_id">
                                            <input type="hidden" name="container_name" id="approve_container_name">

                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <span class="sub-text"></span>
            </div>
        </div>
    </div>
</div> 

<div class="modal fade zoom" tabindex="-1" id="rejectintervention1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reject Intervention</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="nk-block nk-block-lg">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <ul class="nav nav-tabs mt-n3">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem58979022897"><em class="icon ni ni-table"></em><span>Reject Intervention</span></a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem58979022897">
                                    <form method="POST" action="{{ route('rejectintervention')}}">
                                        @csrf
                                        <div class="row gy-4">


                                            <?php

                                            $date = date('l dS \of F Y h:i:s A');
                                            ?>

                                            <input type="hidden" name="rejected_by" value="{{Auth::user()->name}}" />
                                            <input type="hidden" name="rejected_by_email" value="{{Auth::user()->email}}" />
                                            <input type="hidden" name="rejected_on" value="{{$date}}" />

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="default-textarea">Add Comment</label>
                                                    <div class="form-control-wrap">
                                                        <textarea class="form-control no-resize" name="reject_comment" id="default-textarea"></textarea>
                                                    </div>
                                                </div>
                                            </div> 

                                            <input type="hidden" name="status" value="01">
                                            <input type="hidden" name="container_id" id="reject_container_id1">
                                            <input type="hidden" name="container_name" id="reject_container_name1">

                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <span class="sub-text"></span>
            </div>
        </div>
    </div>
</div>


<div class="modal fade zoom" tabindex="-1" id="uploadintervention1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Intervention</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="nk-block nk-block-lg">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <ul class="nav nav-tabs mt-n3">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem58979022897"><em class="icon ni ni-table"></em><span>Upload Excel/CSV</span></a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem58979022897">
                                    <form method="POST" action="#">
                                        @csrf
                                        <div class="row gy-4">

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <!-- <label class="font-weight-bolder">Upload Excel/CSV</label> -->
                                                        <input id="" name="" type="file" class="form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Upload</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <span class="sub-text"></span>
            </div>
        </div>
    </div>
</div>

<script>
// reject intervention container
    $(document).ready(function () {
        $('body').on('click', '#rejectintervention2', function (event) {
            event.preventDefault();
            var url = "{{ route('interventioncontainers.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {
                console.log(data);
                $('#userCrudModal').html("Output category");
                $('#submit').val("intervention add");
                $('#rejectintervention1').modal('show');
                $('#reject_container_id1').val(data.id);
                $('#reject_container_name1').val(data.container_name);
            })
        });
    }); 
</script>

<script>
// approve intervention container
    $(document).ready(function () {
        $('body').on('click', '#approveintervention2', function (event) {
            event.preventDefault();
            var url = "{{ route('interventioncontainers.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {
                console.log(data);
                $('#userCrudModal').html("Output category");
                $('#submit').val("intervention add");
                $('#approveintervention1').modal('show');
                $('#approve_container_id').val(data.id);
                $('#approve_container_name').val(data.container_name);
            })
        });
    }); 
</script>

<script>
// forward intervention container
    $(document).ready(function () {
        $('body').on('click', '#forwardintervention2', function (event) {
            event.preventDefault();
            var url = "{{ route('interventioncontainers.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {
                console.log(data);
                $('#userCrudModal').html("Output category");
                $('#submit').val("intervention add");
                $('#forwardintervention1').modal('show');
                $('#forward_container_id').val(data.id);
                $('#forward_container_name').val(data.container_name);
            })
        });
    }); 
</script>

<script>
// cancel container
    $(document).ready(function () {
        $('body').on('click', '#cancelworkplan', function (event) {
            event.preventDefault();
            var url = "{{ route('workplancontainers.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {
                console.log(data);
                $('#userCrudModal').html("Output category");
                $('#submit').val("intervention add");
                $('#cancelworkplan1').modal('show');
                $('#cancelw_container_id').val(data.id);
                $('#cancelw_container_name').val(data.container_name);
            })
        });
    }); 
</script>

<script>
// Add submitcontainer workplan
    $(document).ready(function () {
        $('body').on('click', '#workplan2', function (event) {
            event.preventDefault();
            var url = "{{ route('workplancontainers.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {
                console.log(id);
                $('#userCrudModal').html("Output category");
                $('#submit').val("intervention add");
                $('#workplan1').modal('show');
                $('#workplan_container_id').val(data.id);
                $('#workplan_container_name').val(data.container_name);
            })
        });
    }); 
</script> 

<script>
// Add addIntervetion
    $(document).ready(function () {
        $('body').on('click', '#addintervention12', function (event) {
            event.preventDefault();
            var url = "{{ route('interventions.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {
                console.log(id);
                $('#userCrudModal').html("Output category");
                $('#submit').val("intervention add");
                $('#addintervention1').modal('show');
                $('#intervention_container123').val(id);
            })
        });
    }); 
</script> 

<script>
// Add submitcontainer
    $(document).ready(function () {
        $('body').on('click', '#submitcontainer', function (event) {
            event.preventDefault();
            var url = "{{ route('interventioncontainers.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {
                console.log(id);
                $('#userCrudModal').html("Output category");
                $('#submit').val("intervention add");
                $('#submitintervention1').modal('show');
                $('#sibmit_container_id').val(data.id);
                $('#submitted_container_name').val(data.container_name);
            })
        });
    }); 
</script>  

<script>
// Show Intervention timeline
    $(document).ready(function () {
        $('body').on('click', '#timeline', function (event) {
            event.preventDefault();
            var url = "{{ route('interventioncontainers.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {
                console.log(id);
                $('#userCrudModal').html("Output category");
                $('#submit').val("intervention add");
                $('#timeline1').modal('show');
                $('#timeline_container_id').val(data.id);
                $('#timeline_container_name').val(data.container_name);
            })
        });
    }); 
</script>

<script>
// Add forwardcontainer
    $(document).ready(function () {
        $('body').on('click', '#forwardcontainer', function (event) {
            event.preventDefault();
            var url = "{{ route('interventioncontainers.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {
                console.log(id);
                $('#userCrudModal').html("Output category");
                $('#submit').val("intervention add");
                $('#submitintervention1').modal('show');
                $('#sibmit_container_id').val(data.id);
                $('#submitted_container_name').val(data.container_name);
            })
        });
    }); 
</script> 

<script>
// Add approvecontainer
    $(document).ready(function () {
        $('body').on('click', '#approvecontainer', function (event) {
            event.preventDefault();
            var url = "{{ route('interventioncontainers.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {
                console.log(id);
                $('#userCrudModal').html("Output category");
                $('#submit').val("intervention add");
                $('#submitintervention1').modal('show');
                $('#sibmit_container_id').val(data.id);
                $('#submitted_container_name').val(data.container_name);
            })
        });
    }); 
</script>

<script>
// Add rejectcontainer
    $(document).ready(function () {
        $('body').on('click', '#rejectcontainer', function (event) {
            event.preventDefault();
            var url = "{{ route('interventioncontainers.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {
                console.log(id);
                $('#userCrudModal').html("Output category");
                $('#submit').val("intervention add");
                $('#submitintervention1').modal('show');
                $('#sibmit_container_id').val(data.id);
                $('#submitted_container_name').val(data.container_name);
            })
        });
    }); 
</script>

<script>
// cancel container
    $(document).ready(function () {
        $('body').on('click', '#cancelintervention', function (event) {
            event.preventDefault();
            var url = "{{ route('interventioncontainers.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {
                console.log(data);
                $('#userCrudModal').html("Output category");
                $('#submit').val("intervention add");
                $('#cancelintervention1').modal('show');
                $('#cancel_container_id').val(data.id);
                $('#cancel_container_name').val(data.container_name);
            })
        });
    }); 
</script>

<script>
    $(document).ready(function () {
        $('body').on('click', '#editintervention', function (event) {
            event.preventDefault();
            var url = "{{ route('interventions.index')}}";
            var id = $(this).data('id');

            $.get(url + '/' + id + '/edit', function (data) {
                console.log(data);
                $('#userCrudModal').html("Edit category");
                $('#submit').val("Edit category");
                $('#editinterventi').modal('show');
                $('#intervention_id').val(data.id);
                $('#activity_name').val(data.activity_id);
                $('#funding11').val(data.funding1);
                $('#funding22').val(data.funding2);
                $('#totall').val(data.total);
            })
        });
    }); 
</script>

<script>
    $(document).ready(function () {
        $('body').on('click', '#viewintervention', function (event) {
            event.preventDefault();
            var url = "{{ route('interventions.index')}}";
            var id = $(this).data('id');

            $.get(url + '/' + id + '/edit', function (data) {
                console.log(data);
                $('#userCrudModal').html("Edit category");
                $('#submit').val("Edit category");
                $('#viewinterventi').modal('show');
                $('#id').val(data.id);
                $('#activity_name1').val(data.activity_name);
                $('#funding111').val(data.funding1);
                $('#funding222').val(data.funding2);
                $('#totalll').val(data.total);
            })
        });
    }); 
</script>

<script>
// Add Output
    $(document).ready(function () {
        $('body').on('click', '#addoutput', function (event) {
            event.preventDefault();
            var url = "{{ route('outcomes.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {
        // console.log(id);
             $('#userCrudModal').html("Output category");
             $('#submit').val("Output category");
             $('#output_model').modal('show');
             $('#outcome_id').val(data.id);
             $('#output_title').val(data.outcome_code + '-' + data.outcome_title)
         })
        });
    }); 
</script>

<script>
// Add addoutcomeactivity
    $(document).ready(function () {
        $('body').on('click', '#addoutcomeactivity', function (event) {
            event.preventDefault();
            var url = "{{ route('outcomes.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {
        // console.log(id);
             $('#userCrudModal').html("Output category");
             $('#submit').val("Output category");
             $('#activity1').modal('show');
             $('#outcome_id1').val(data.id);
             $('#activity_name2').val(data.outcome_code + '-' + data.outcome_title)
         })
        });
    }); 
</script>


<script>
// Add addoutcomeindicator
    $(document).ready(function () {
        $('body').on('click', '#addoutcomeindicator', function (event) {
            event.preventDefault();
            var url = "{{ route('outcomes.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {
        // console.log(id);
             $('#userCrudModal').html("Output category");
             $('#submit').val("Output category");
             $('#indicator1').modal('show');
             $('#outcome_id3').val(data.id);
             $('#outcome_indicator').val(data.outcome_code + '-' + data.outcome_title)
         })
             // window.location.reload();
        });

    }); 
</script>

<script>
// Add addoutputactivity
    $(document).ready(function () {
        $('body').on('click', '#addoutputactivity1', function (event) {
            event.preventDefault();
            var url = "{{ route('outputs.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {
        // console.log(id);
             $('#userCrudModal').html("Output category");
             $('#submit').val("Output category");
             $('#activity2').modal('show');
             $('#output_id5').val(data.id);
             $('#output_title7').val(data.output_code + '-' + data.output_name)
         })
        });
    }); 
</script>


<script>
// Add addoutputactivity
    $(document).ready(function () {
        $('body').on('click', '#addoutputindicator', function (event) {
            event.preventDefault();
            var url = "{{ route('outputs.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {
        // console.log(id);
             $('#userCrudModal').html("Output category");
             $('#submit').val("Output category");
             $('#indicator2').modal('show');
             $('#output_indicator5').val(data.id);
             $('#output_indicator7').val(data.output_code + '-' + data.output_name)
         })
        });
    });
</script>

<script>
// Update Budget
    $(document).ready(function () {
        $('body').on('click', '#editbudget', function (event) {
            event.preventDefault();
            var url = "{{ route('budgets.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {

             $('#userCrudModal').html("Output category");
             $('#submit').val("Output category");
             $('#editbudget_modal').modal('show');
             $('#budgetid').val(data.id);
             $('#impid').val(data.id);
         })
        });

    });
</script>


<script>
// Add editgoal
    $(document).ready(function () {
        $('body').on('click', '#editgoal', function (event) {
            event.preventDefault();
            var url = "{{ route('goals.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {

             $('#userCrudModal').html("Output category");
             $('#submit').val("Output category");
             $('#editgoal_modal').modal('show');
             $('#goal_name2').val(data.goal_name);
             $('#goal_code2').val(data.goal_code);
             $('#goal_id2').val(data.id)
         })
        });

    });
</script>

<script>
// Add editoutcome
    $(document).ready(function () {
        $('body').on('click', '#editoutcome', function (event) {
            event.preventDefault();
            var url = "{{ route('outcomes.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {

             $('#userCrudModal').html("Output category");
             $('#submit').val("Output category");
             $('#editoutcome_modal').modal('show');
             $('#outcome_name2').val(data.outcome_title);
             $('#outcome_code2').val(data.outcome_code);
             $('#outcome_id2').val(data.id)
         })
        });
    });
</script>

<script>
// Add editoutput
    $(document).ready(function () {
        $('body').on('click', '#editoutput', function (event) {
            event.preventDefault();
            var url = "{{ route('outputs.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {

             $('#userCrudModal').html("Output category");
             $('#submit').val("Output category");
             $('#editoutput_modal').modal('show');
             $('#output_name2').val(data.output_name);
             $('#output_code2').val(data.output_code);
             $('#output_id2').val(data.id)
         })
        });
    });
</script>


<script>
// Add editoutcomeactivity
    $(document).ready(function () {
        $('body').on('click', '#editoutcomeactivity', function (event) {
            event.preventDefault();
            var url = "{{ route('activities.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {

             $('#userCrudModal').html("Output category");
             $('#submit').val("Output category");
             $('#editoutcomeactivity_modal').modal('show');
             $('#activity_title3').val(data.activity_title);
             $('#activity_code3').val(data.activity_code);
             $('#activity_id3').val(data.id)
         })
        });
    });
</script>

<script>
// Add editouuputactivity
    $(document).ready(function () {
        $('body').on('click', '#editoutputcomeactivity', function (event) {
            event.preventDefault();
            var url = "{{ route('activities.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {

             $('#userCrudModal').html("Output category");
             $('#submit').val("Output category");
             $('#editoutputactivity_modal').modal('show');
             $('#activity_title4').val(data.activity_title);
             $('#activity_code4').val(data.activity_code);
             $('#activity_id4').val(data.id)
         })
        });
    });
</script>


<script>
// Add editgoalactivity
    $(document).ready(function () {
        $('body').on('click', '#editactivity', function (event) {
            event.preventDefault();
            var url = "{{ route('activities.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {

             $('#userCrudModal').html("Output category");
             $('#submit').val("Output category");
             $('#editactivity_modal').modal('show');
             $('#activity_title2').val(data.activity_title);
             $('#activity_code2').val(data.activity_code);
             $('#activity_id2').val(data.id)
         })
        });
    });
</script>

<script>
// Add editgoalIndicator
    $(document).ready(function () {
        $('body').on('click', '#editgoalIndicator', function (event) {
            event.preventDefault();
            var url = "{{ route('indicators.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {

             $('#userCrudModal').html("Output category");
             $('#submit').val("Output category");
             $('#editindicator_modal').modal('show');
             $('#output_name2').val(data.output_name);
             $('#output_code2').val(data.output_code);
             $('#output_id2').val(data.id)
         })
        });
    });
</script>


<script type="text/javascript">

    // deletegoal

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
    $(document).ready(function () {
        $('body').on('click', '#deletegoal', function () {

            var id = $(this).data('id');
            confirm("Are You sure want to delete goal !");

            $.ajax({
                type: "DELETE",
                url: "{{ route('goals.store') }}"+'/'+id,
                success: function (data) {
                    confirm("Goal Has been Deleted!");
                    window.location.reload();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });

    });

</script>


<script type="text/javascript">
    // deleteoutcome

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
    $(document).ready(function () {
        $('body').on('click', '#deleteoutcome', function () {

            var id = $(this).data('id');
            confirm("Are You sure want to delete Outcome!");

            $.ajax({
                type: "DELETE",
                url: "{{ route('outcomes.store') }}"+'/'+id,
                success: function (data) {
                    confirm("Outcome Has been Deleted!");
                    window.location.reload();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });

    });

</script>


<script type="text/javascript">
    // deleteoutput

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
    $(document).ready(function () {
        $('body').on('click', '#deleteoutput', function () {

            var id = $(this).data('id');
            confirm("Are You sure you want to delete Output!");

            $.ajax({
                type: "DELETE",
                url: "{{ route('outputs.store') }}"+'/'+id,
                success: function (data) {
                    confirm("Output Has been Deleted!");
                    window.location.reload();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });

    });

</script>

<script type="text/javascript">
    // delete goal activity

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
    $(document).ready(function () {
        $('body').on('click', '#deleteactivity', function () {

            var id = $(this).data('id');
            confirm("Are You sure you want to delete Activity!");

            $.ajax({
                type: "DELETE",
                url: "{{ route('activities.store') }}"+'/'+id,
                success: function (data) {
                    confirm("Activity Has been Deleted!");
                    window.location.reload();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });

    });

</script>


<script type="text/javascript">
    // delete goal indicator

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
    $(document).ready(function () {
        $('body').on('click', '#deleteindicator', function () {

            var id = $(this).data('id');
            confirm("Are You sure you want to delete Indicator!");

            $.ajax({
                type: "DELETE",
                url: "{{ route('indicators.store') }}"+'/'+id,
                success: function (data) {
                    confirm("Indicator Has been Deleted!");
                    window.location.reload();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });

    });

</script>



<script type="text/javascript">
    // delete outcome activity

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
    $(document).ready(function () {
        $('body').on('click', '#deleteoutcomeactivity', function () {

            var id = $(this).data('id');
            confirm("Are You sure you want to delete this Outcome Activity!");

            $.ajax({
                type: "DELETE",
                url: "{{ route('activities.store') }}"+'/'+id,
                success: function (data) {
                    confirm("Outcome Activity Has been Deleted!");
                    window.location.reload();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });

    });

</script>

<script type="text/javascript">
    // delete outcome indicator

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
    $(document).ready(function () {
        $('body').on('click', '#deleteoutcomeindicator', function () {

            var id = $(this).data('id');
            confirm("Are You sure you want to delete this Outcome Indicator!");

            $.ajax({
                type: "DELETE",
                url: "{{ route('indicators.store') }}"+'/'+id,
                success: function (data) {
                    confirm("Outcome Indicator Has been Deleted!");
                    window.location.reload();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });

    });

</script>


<script type="text/javascript">
    // delete output activity

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
    $(document).ready(function () {
        $('body').on('click', '#deleteoutputactivity', function () {

            var id = $(this).data('id');
            confirm("Are You sure you want to delete this Output Activity!");

            $.ajax({
                type: "DELETE",
                url: "{{ route('activities.store') }}"+'/'+id,
                success: function (data) {
                    confirm("Output Activity Has been Deleted!");
                    window.location.reload();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });

    });

</script>


<script type="text/javascript">
    // delete output indicator

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
    $(document).ready(function () {
        $('body').on('click', '#deleteoutputindicator', function () {

            var id = $(this).data('id');
            confirm("Are You sure you want to delete this Output Indicator!");

            $.ajax({
                type: "DELETE",
                url: "{{ route('indicators.store') }}"+'/'+id,
                success: function (data) {
                    confirm("Output indicator Has been Deleted!");
                    window.location.reload();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });

    });

</script>



@endsection
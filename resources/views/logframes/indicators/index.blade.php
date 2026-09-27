@extends('layouts.apps')
@section('content')

<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="components-preview wide-md mx-auto">
                    <div class="nk-block-head nk-block-head-lg wide-sm">
                        <div class="nk-block-head-content">
                            <div class="nk-block-head-sub"><a class="back-to" href="{{ route('logframes.index')}}"><em class="icon ni ni-arrow-left"></em><span>Logframes</span></a></div>
                            <h2 class="nk-block-title fw-normal">Indicators</h2>
                        </div>
                    </div><!-- .nk-block-head -->

                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                    @endif


                    <br>
                    <br>

                    <div class="card card-bordered card-preview">
                        <div class="card-inner">

                            <table style="width:100%">
                              <tr>
                                <th>Indicator Name</th>
                                <th>Value</th>
                                <th>Baseline</th>
                                <th>Target</th>
                                <th>Reporting Frequency</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($indicators as $key => $object)

                            
                            <!-- <tr>
                                <td>Jill</td>
                                <td>Smith</td>
                                <td>40</td>
                                <td>43</td>
                                <td>Monthly</td>
                                <td>Edit</td>
                            </tr>
                            <tr>
                                <td>Jill</td>
                                <td>Smith</td>
                                <td>40</td>
                                <td>43</td>
                                <td>Monthly</td>
                                <td>Edit</td>
                            </tr> -->
                            @if($object->disaggregation == 'Disaggregation' || $object->disaggregation == 'Disaggregation1' || $object->disaggregation == 'Disaggregation2')
                            <?php
                            $dvalue = explode("---", implode($object->dvalue));
                            $obj = implode($dvalue);
                            $dbaseline = explode("---", implode($object->dbaseline));
                            $obj1 = implode($dbaseline);
                            $dtarget = explode("---", implode($object->dtarget));
                            $obj2 = implode($dtarget);
                            ?>
                            <tr>
                                <td rowspan="2">{{$object->indicator_title}}</td>
                                <td>{{ (in_array($object->id, $dvalue)) ? 'dvalue' : '' }}{{$obj}}</td>
                                <td>{{ (in_array($object->id, $dbaseline)) ? 'dbaseline' : '' }}{{$obj1}}</td>
                                <td>{{ (in_array($object->id, $dtarget)) ? 'dtarget' : '' }}{{$obj2}}</td>
                                <td rowspan="2">{{$object->reporting_frequency}}</td>
                                <td rowspan="2">
                                    <li><a href="#">Update</a></li>
                                </td>
                            </tr>
                            <tr>
                                <td>{{ (in_array($object->id, $dvalue)) ? 'dvalue' : '' }}{{$obj}}</td>
                                <td>{{ (in_array($object->id, $dbaseline)) ? 'dbaseline' : '' }}{{$obj1}}</td>
                                <td>{{ (in_array($object->id, $dtarget)) ? 'dtarget' : '' }}{{$obj2}}</td>
                                

                            </tr>
                            @endif
                            @endforeach
                            <!-- <tr>
                                <td>Jane</td>
                                <td>Smith</td>
                                <td>40</td>
                                <td>43</td>
                                <td>Monthly</td>
                                <td>Edit</td>
                            </tr>
                            <tr>
                                <td>Vic</td>
                                <td>Smith</td>
                                <td>40</td>
                                <td>43</td>
                                <td>Monthly</td>
                                <td>Edit</td>
                            </tr> -->
                        </table>
                        <!-- <table class="datatable-init table"> -->
                                <!-- <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Indicator Name</th>
                                        <th>Value</th>
                                        <th>Baseline</th>
                                        <th>Target</th>
                                        <th>Reporting Frequency</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     <?php $i = 1; ?>
                                    @foreach ($indicators as $key => $object)
                                    <tr>
                                        <td>{{$i}}</td>
                                        @if($object->disaggregation == 'none')
                                        <td>{{ $object->indicator_title }}</td> 
                                        <td>{{ $object->label_none }}</td>
                                        <td>{{ $object->baseline_none }}</td>
                                        <td>{{ $object->target_none }}</td>
                                        @elseif($object->disaggregation == 'Disaggregation' || $object->disaggregation == 'Disaggregation1' || $object->disaggregation == 'Disaggregation2')
                                        <td rowspan="2">{{ $object->indicator_title }}</td>
                                        <td>Male</td>
                                        <td>Female</td>
                                        <td></td>
                                        @endif
                                        
                                        
                                        <td>{{ $object->reporting_frequency }}</td>   
                                        <td>
                                            <li class="col-sm-6 col-lg-3">

                                                <div class="dropdown">
                                                    <a href="#" class="btn btn-primary" data-bs-toggle="dropdown"><span>Select Action</span><em class="icon ni ni-chevron-down"></em></a>
                                                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-auto mt-1">
                                                        <ul class="link-list-plain">
                                                            <li><a href="#">Update</a></li>
                                                            <li><a href="#">Show</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                        </td>                                    
                                    </tr>
                                    <?php $i++; ?>
                                    @endforeach
                                </tbody> -->
                                <!-- </table> -->
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection
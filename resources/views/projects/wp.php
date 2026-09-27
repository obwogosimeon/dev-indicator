<div class="nk-block nk-block-lg">
                                                <div class="nk-block-head">
                                                    <div class="nk-block-head-content">
                                                    <!-- <div class="components-preview wide-md mx-auto">
                                                        <div class="nk-block-head nk-block-head-lg wide-sm"> -->


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
                                                                            <table class="datatable-init table">
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
                                                                            <hr>


                                                                        </div>
                                                                    </div>


                                                                    <div class="tab-pane" id="tabItem89">

                                                                        <div class="card-inner">
                                                                            <table class="datatable-init table">
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

                                                                                    <?php $i = 1; ?>
                                                                                    @foreach ($reporting as  $object)
                                                                                    <tr>
                                                                                        <td>{{$i}}</td>

                                                                                        <td>{{ $object->label }}</td>
                                                                                        <th>{{ $object->january }}</th>
                                                                                        <td>{{ $object->february }}</td>

                                                                                        <td>{{ $object->march }}</td>
                                                                                        <td>{{ $object->april }}</td>
                                                                                        <td>{{ $object->may }}</td>
                                                                                        <td>{{ $object->june }}</td>
                                                                                        <td>{{ $object->july }}</td>
                                                                                        <td>{{ $object->august }}</td>
                                                                                        <td>{{ $object->september }}</td>
                                                                                        <td>{{ $object->october }}</td>
                                                                                        <td>{{ $object->november }}</td>
                                                                                        <td>{{ $object->december }}</td>


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
                                                                            <table class="datatable-init table">
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
                                                                        <table class="datatable-init table">
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
                                                                                    <table class="datatable-init table">
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


                                                      <!--   </div>
                                                      </div> -->
                                                  </div>
                                              </div>
                                          </div>










                                          <div class="card-inner">
                                        <table class="datatable-init table">
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

                                                        <ul class="nk-tb-actions gx-1 my-n1">
                                                            <li class="me-n1">
                                                                <div class="dropdown">
                                                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <ul class="link-list-opt no-bdr">
                                                                            <li><a href="{{ url('budgetupdate',$object->id)}}"><em class="icon ni ni-edit"></em><span>Edit WorkPlan</span></a></li>
                                                                                    <!-- <li><a href="#"><em class="icon ni ni-trash"></em><span>Remove Project</span></a></li>
                                                                                        <li><a href="#"><em class="icon ni ni-eye"></em><span>View Project</span></a></li> -->

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
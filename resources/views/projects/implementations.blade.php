<div class="nk-block nk-block-lg">
                            <div class="nk-block-head">
                                <div class="nk-block-head-content">
                                    <h5 class="title nk-block-title">Implementations Management</h5>
                                    <li class="preview-item">
                                        <button type="button" style="margin-left: 78%" class="btn btn-round btn-primary" data-bs-toggle="modal" data-bs-target="#modalZoom877"><em class="icon ni ni-plus"></em>&nbsp Add Implementation Container</button>
                                    </li>
                                </div>
                            </div>

                            <div class="nk-block nk-block-lg">
                             <div class="card card-bordered card-preview">
                                <div class="card-inner">
                                    <div id="accordion-1" class="accordion accordion-s2">
                                       @foreach($impcontainers as $key1 => $imp)
                                       <div class="accordion-item">
                                        <a href="#" class="accordion-head collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-item-1-1">
                                            <h6 class="title">{{$imp->container_name}} ---( {{$imp->workplancontainer->container_name}} ) ---- {{$imp->exchange_rate}}</h6>
                                            <span class="accordion-icon"></span>
                                            <hr>
                                            <h6 class="title">
                                                @if($imp->status == '01')
                                                <span class="badge bg-gray">Draft Container</span>
                                                @elseif($imp->status == '02')
                                                <span class="badge bg-warning">Container Submitted</span>
                                                @elseif($imp->status == '03')
                                                <span class="badge bg-warning">Container Forwarded</span>
                                                @elseif($imp->status == '04')
                                                <span class="badge bg-success">Container Approved</span>
                                                @elseif($imp->status == '05')
                                                <span class="badge bg-gray">Container Reported</span>
                                                @elseif($imp->status == '06')
                                                <span class="badge bg-gray">Report Forwarded</span>
                                                @elseif($imp->status == '07')
                                                <span class="badge bg-gray">Report Approved</span>
                                                @endif
                                            </h6>
                                        </a>
                                    </div>
                                    <div class="accordion-body collapse" id="accordion-item-1-1" data-bs-parent="#accordion-1">
                                        <div class="accordion-inner">
                                            <div class="card card-bordered card-preview">
                                             @if($imp->workplancontainer->planning_type == 'Activity')   
                                             <div class="card-inner">
                                                <table class="datatable-init table">
                                                    <thead>
                                                        <tr>
                                                            <th rowspan="2">WorkPlan Containers</th>
                                                            <?php $i = 1; ?>
                                                            @foreach($accounts as $key => $object)
                                                            <th colspan="7">{{ $object->funding_name }}</th>
                                                            @endforeach
                                                        </tr>



                                                        <tr>
                                                            <td>Budget-Annual</td>
                                                            <td>Budget-Current Period</td>
                                                            <td>Expense-Previous Period</td>
                                                            <td>Expense-Current Period</td>
                                                            <td>Expense-Total</td>
                                                            <td>% Utilization</td>
                                                            <td class="tb-tnx-action"></td>

                                                            <td>Budget-Annual</td>
                                                            <td>Budget-Current Period</td>
                                                            <td>Expense-Previous Period</td>
                                                            <td>Expense-Current Period</td>
                                                            <td>Expense-Total</td>
                                                            <td>% Utilization</td>
                                                            <td class="tb-tnx-action">Action</td>
                                                        </tr>

                                                        @foreach($budgets as $key => $obj)

                                                        <tr>
                                                            <td>{{$obj->workplan_name}}</td>

                                                            <!-- Funding A Left-->

                                                            <td>KES @convert($obj->annual_amounta)</td>
                                                            @if($imp->container_type == 'main')
                                                            <td>
                                                                @foreach($budgetexpense as $budget) 
                                                                @if($budget->budget_id == $obj->id && $budget->implementation_container_id == $imp->id)
                                                                {{$budget->budget_current_period1}}
                                                                @endif  
                                                                @endforeach
                                                            </td>
                                                            <td>-</td>
                                                            <td>  
                                                                @foreach($budgetexpense as $budget) 
                                                                @if($budget->budget_id == $obj->id && $budget->implementation_container_id == $imp->id)
                                                                {{$budget->expense_current_period1}}
                                                                @endif  
                                                                @endforeach
                                                            </td>
                                                            <td>
                                                             @foreach($budgetexpense as $budget) 
                                                             @if($budget->budget_id == $obj->id && $budget->implementation_container_id == $imp->id)
                                                             {{$budget->expense_current_period1}}
                                                             @endif  
                                                             @endforeach 
                                                         </td>
                                                         <td>@foreach($budgetexpense as $budget) 
                                                            @if($budget->budget_id == $obj->id && $budget->implementation_container_id == $imp->id)
                                                            {{ round($budget->expense_current_period1 * 100 / $obj->annual_amounta, 2)}} %
                                                            @endif  
                                                            @endforeach
                                                        </td>
                                                        @elseif($imp->container_type == 'preceding')
                                                        <td>@foreach($budgetexpense as $budget) 
                                                         @if($budget->budget_id == $obj->id && $budget->implementation_container_id == $imp->id)
                                                         {{$budget->expense_current_period1}}
                                                         @endif  
                                                     @endforeach</td>
                                                     <td>
                                                         @foreach($budgetexpense as $budget) 
                                                         @if($budget->budget_id == $obj->id && $budget->implementation_container_id == $imp->id)
                                                         {{$budget->expense_current_period1}}
                                                         @endif  
                                                         @endforeach
                                                     </td>
                                                     <td>  
                                                        @foreach($budgetexpense as $budget) 
                                                        @if($budget->budget_id == $obj->id && $budget->implementation_container_id == $imp->id)
                                                        {{$budget->expense_current_period1}}
                                                        @endif  
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                     @foreach($budgetexpense as $budget) 
                                                     @if($budget->budget_id == $obj->id && $budget->implementation_container_id == $imp->id)
                                                     {{$budget->expense_current_period1}}
                                                     @endif  
                                                     @endforeach 
                                                 </td>
                                                 <td>@foreach($budgetexpense as $budget) 
                                                    @if($budget->budget_id == $obj->id && $budget->implementation_container_id == $imp->id)
                                                    {{ round($budget->expense_current_period1 * 100 / $obj->annual_amounta, 2)}} %
                                                    @endif  
                                                @endforeach</td>
                                                @endif

                                                <td>
                                                </td>

                                                <!-- Funding B right side -->

                                                <td>KES @convert($obj->annual_amountb)</td>
                                                @if($imp->container_type == 'main')
                                                <td>  
                                                    @foreach($budgetexpense as $budget) 
                                                    @if($budget->budget_id == $obj->id && $budget->implementation_container_id == $imp->id)
                                                    {{$budget->budget_current_period2}}
                                                    @endif  
                                                    @endforeach
                                                </td>
                                                @elseif($imp->container_type == 'preceding')
                                                <td>@foreach($budgetexpense as $budget) 
                                                 @if($budget->budget_id == $obj->id && $budget->implementation_container_id == $imp->id)
                                                 {{$budget->expense_current_period1}}
                                                 @endif  
                                             @endforeach</td>
                                             @endif
                                             <td>-</td>
                                             <td>
                                                @foreach($budgetexpense as $budget) 
                                                @if($budget->budget_id == $obj->id && $budget->implementation_container_id == $imp->id)
                                                {{$budget->expense_current_period2}}
                                                @endif  
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach($budgetexpense as $budget) 
                                                @if($budget->budget_id == $obj->id && $budget->implementation_container_id == $imp->id)
                                                {{$budget->expense_current_period2}}
                                                @endif  
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach($budgetexpense as $budget) 
                                                @if($budget->budget_id == $obj->id && $budget->implementation_container_id == $imp->id)
                                                {{ round($budget->expense_current_period2 * 100 / $obj->annual_amounta, 2)}} %
                                                @endif  
                                                @endforeach
                                            </td>

                                            <td>
                                                @if($imp->status == '01')
                                                <li><a href="{{ url('budgetupdate', $obj->id) }}">Edit</a></li>
                                                @endif
                                            </td>
                                        </tr>






                                        @endforeach
                                        <tr>
                                            <td><b>Total</b></td>
                                            <td><b>KES @convert($budgetannuala)</b></td>
                                            <td><b>KES @convert($totalcurrentperid)</b></td>
                                            <td><b>0</b></td>
                                            <td><b>KES @convert($totalexpensecurrent)</b></td>
                                            <td><b>KES @convert($totalexpensecurrent)</b></td>
                                            <td><b>0%</b></td>
                                            <td><b>0</b></td>
                                            <td><b>KES @convert($budgetannualb)</b></td>
                                            <td><b>KES @convert($totalcurrentperid2)</b></td>
                                            <td><b>0</b></td>
                                            <td><b>KES @convert($totalexpensecurrent2)</b></td>
                                            <td><b>KES @convert($totalexpensecurrent2)</b></td>
                                            <td><b>0%</b></td>
                                            <td>-</td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody>




                                        <script>

                                            var _token = $('input[name="_token"]').val();
                                            $('#mybutt').click(function(){

                                              var budget_current_period = $('#budget_current_period').text();
                                              var expense_current_period = $('#expense_current_period').text();
                                                              // var id = $('#id').text();
                                              if(budget_current_period != '' && expense_current_period != '')
                                                if(confirm("Are you sure you want to Update this Budgets?"))
                                                {
                                                   $.ajax({
                                                    url:"{{ route('livetable.add_data') }}",
                                                    method:"POST",
                                                    data:{budget_current_period:budget_current_period, expense_current_period:expense_current_period, _token:_token},
                                                    dataType: 'json',

                                                    success:function(data)
                                                    {
                                                     console.log(data);
                                                 }
                                             });
                                               }
                                               else
                                               {
                                                console.log("No Data");
                                            }
                                        });
                                    </script>



                                </tbody>
                            </table>

                        </div>



                        @elseif($imp->workplancontainer->planning_type == 'Indicator')



                        <table class="datatable-init table">
                         <thead> 
                          <tr>
                            <th>Indicator Name</th>
                            <th>Value</th>
                            <th>Annual Target</th>
                            <th>Target-Current Period</th>
                            <th>Achieved-Previous Period</th>
                            <th>Achieved-Current Period</th>
                            <th>Total Achieved</th>
                            <th>% Achievement</th>
                            <th>Action</th>
                        </tr>
                        @foreach($indicatortargets as $key => $obj)
                        <tr>
                            <td>{{$obj->indicator->indicator_title}}</td>
                            <td>{{$obj->label}}</td>
                            @if($obj->reporting == 'Monthly')
                            <td>{{$obj->january + $obj->february + $obj->march + $obj->april + $obj->may + $obj->june + $obj->july + $obj->august + $obj->september + $obj->october + $obj->november + $obj->december}}</td>
                            @elseif($obj->reporting == 'Annual')
                            <td>{{$obj->jan_december}}</td>
                            @elseif($obj->reporting == 'Bi-Monthly')
                            <td>{{$obj->jan_feb + $obj->mar_apr + $obj->may_june + $obj->july_aug + $obj->sep_oct + $obj->nov_dec}}</td>
                            @elseif($obj->reporting == 'Quaterly')
                            <td>{{$obj->jan_march + $obj->april_june + $obj->july_september + $obj->october_december}}</td>
                            @elseif($obj->reporting == 'Semi-Annual')
                            <td>{{$obj->jan_june + $obj->july_december}}</td>
                            @endif
                            @if($obj->reporting == 'Monthly')
                            <td>{{$obj->january}}</td>
                            @elseif($obj->reporting == 'Annual')
                            <td>{{$obj->jan_december}}</td>
                            @elseif($obj->reporting == 'Bi-Monthly')
                            <td>{{$obj->jan_feb}}</td>
                            @elseif($obj->reporting == 'Quaterly')
                            <td>{{$obj->jan_march}}</td>
                            @elseif($obj->reporting == 'Semi-Annual')
                            <td>{{$obj->jan_june}}</td>
                            @endif
                            <td>0</td>
                            <td contenteditable="true">0</td>
                            <td>0</td>
                            <td>0%</td>
                            <td>
                               @if($imp->status == '01')
                               <li><a href="{{ url('indicatorupdate', $obj->id) }}">Update</a></li>
                               @endif 
                           </td>
                       </tr>
                       @endforeach
                   </thead>

                   <hr>

               </table>


               @endif
           </div>
       </div>
   </div>
   <div class="card card-bordered card-preview">
    <div class="card-inner">
        <ul class="preview-list">
            @if($imp->status == '01')
            <li class="preview-item">
                <button type="button" class="btn btn-success icon ni ni-setting" data-bs-toggle="modal" data-bs-target="#submit"></em>Submit</button>
            </li> 
            @elseif($imp->status == '02')
            <li class="preview-item">
                <button type="button" class="btn btn-success icon ni ni-setting" data-bs-toggle="modal" data-bs-target="#approve"></em>Approve</button>
            </li>   
            <li class="preview-item">
                <button type="button" class="btn btn-info icon ni ni-setting" data-bs-toggle="modal" data-bs-target="#">Forward</button>
            </li> 
            <li class="preview-item">
                <button type="button" class="btn btn-danger icon ni ni-setting" data-bs-toggle="modal" data-bs-target="#Reject">Reject</button>
            </li>
            @elseif($imp->status == '04')
            <li class="preview-item">
                <button type="button" class="btn btn-success icon ni ni-setting" data-bs-toggle="modal" data-bs-target="#">Report</button>
            </li>
            <li class="preview-item">
                <button type="button" class="btn btn-success icon ni ni-setting" data-bs-toggle="modal" data-bs-target="#Reverse">Reverse</button>
            </li>
            @endif
        </ul>
    </div>
</div>

@if($imp != null)

<div class="modal fade zoom" tabindex="-1" id="submit">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Submit Implementation Container</h5>
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
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem5897"><em class="icon ni ni-user"></em><span>Implementation Container</span></a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem5897">
                                    <form method="POST" action="{{ url('impcontainer/submit/'.$imp->id)}}">
                                        @csrf
                                        <div class="row gy-4">

                                          <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label" for="default-textarea">Add Comment</label>
                                                <div class="form-control-wrap">
                                                    <textarea class="form-control no-resize" name="approval_comment" id="default-textarea"></textarea>
                                                </div>
                                            </div>
                                        </div> 

                                        <input type="hidden" name="status" value="02">
                                        <input type="hidden" name="submitted_by" value="{{Auth::user()->id}}">

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



<div class="modal fade zoom" tabindex="-1" id="approve">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Approve Implementation Container</h5>
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
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem5ere"><em class="icon ni ni-user"></em><span>Implementation Container</span></a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem5ere">
                                    <form method="POST" action="{{ url('impcontainer/submit/'.$imp->id)}}">
                                        @csrf
                                        <div class="row gy-4">

                                          <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label" for="default-textarea">Add Comment</label>
                                                <div class="form-control-wrap">
                                                    <textarea class="form-control no-resize" name="approval_comment" id="default-textarea"></textarea>
                                                </div>
                                            </div>
                                        </div> 

                                        <input type="hidden" name="status" value="04">
                                        <input type="hidden" name="submitted_by" value="{{Auth::user()->id}}">

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



<div class="modal fade zoom" tabindex="-1" id="Reverse">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reverse Implementation Container</h5>
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
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem5sde4"><em class="icon ni ni-user"></em><span>Implementation Container</span></a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem5sde4">
                                    <form method="POST" action="{{ url('impcontainer/submit/'.$imp->id)}}">
                                        @csrf
                                        <div class="row gy-4">

                                          <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label" for="default-textarea">Add Comment</label>
                                                <div class="form-control-wrap">
                                                    <textarea class="form-control no-resize" name="approval_comment" id="default-textarea"></textarea>
                                                </div>
                                            </div>
                                        </div> 

                                        <input type="hidden" name="status" value="01">
                                        <input type="hidden" name="submitted_by" value="{{Auth::user()->id}}">

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



<div class="modal fade zoom" tabindex="-1" id="Reject">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reject Implementation Container</h5>
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
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem5fdrt5"><em class="icon ni ni-user"></em><span>Implementation Container</span></a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem5fdrt5">
                                    <form method="POST" action="{{ url('impcontainer/submit/'.$imp->id)}}">
                                        @csrf
                                        <div class="row gy-4">

                                          <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label" for="default-textarea">Add Comment</label>
                                                <div class="form-control-wrap">
                                                    <textarea class="form-control no-resize" name="approval_comment" id="default-textarea"></textarea>
                                                </div>
                                            </div>
                                        </div> 

                                        <input type="hidden" name="status" value="01">
                                        <input type="hidden" name="submitted_by" value="{{Auth::user()->id}}">

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
@endif
@endforeach
</div>
</div>
</div> 
</div>
</div>
</div>
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
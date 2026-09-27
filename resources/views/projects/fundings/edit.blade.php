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
							<li class="breadcrumb-item"><a href="{{ route('projects.index')}}">Projects</a></li>
							<li class="breadcrumb-item"><a href="{{ route('projects.show', $workplancontainer->project_id) }}">Activity Workplans</a></li>
							<li class="breadcrumb-item active">Add Work Plan</li>
						</ul>
					</nav>
					<br>
					<div class="nk-block nk-block-lg">


						<div class="card card-bordered card-preview">
							<div class="card-inner">
								<div class="preview-block">
									<span class="preview-title-lg overline-title">Edit Budget</span>


									<form method="POST" action="{{ url('updatebudget', $budgetedit->id)}}">
										@csrf

										
										<div class="row gy-4 align-center">

											<div class="form-group">
												<label class="form-label" for="default-01">Work Plan Name</label>
												<div class="form-control-wrap">
													<input type="text" class="form-control" name="workplan_name" value="{{$budgetedit->workplan_name}}">
												</div>
											</div>
											@foreach($fundings as $obj)
											@if($loop->first)
											<div class="col-lg-6 col-sm-12">
												<div class="form-group">
													<label class="form-label" for="default-01">{{$obj->funding_name}} Annual Budget</label>
													<div class="form-control-wrap">
														<input type="text" id="annual2" class="form-control" name="annual_amounta" value="{{$budgetedit->annual_amounta}}">
													</div>
												</div>
											</div>
											@endif
											@if($loop->last)
											<div class="col-lg-6 col-sm-12">
												<div class="form-group">
													<label class="form-label" for="default-01">{{$obj->funding_name}} Annual Budget</label>
													<div class="form-control-wrap">
														<input type="text" id="annual1" class="form-control" name="annual_amountb" value="{{$budgetedit->annual_amountb}}">
													</div>
												</div>
											</div>
											@endif
											@endforeach

											<script type="text/javascript">
												$(function(){
													$('#annual2, #annual1').keyup(function(){
														var annual2 = parseFloat($('#annual2').val()) || 0;
														var annual1 = parseFloat($('#annual1').val()) || 0;
														$('#totalvalue').val(annual2 + annual1);
													});
												});
											</script>

											<div class="form-group">
												<label class="form-label" for="default-01">Total</label>
												<div class="form-control-wrap">
													<input type="text" class="form-control" value="{{$budgetedit->total}}" name="total" id="totalvalue">
												</div>
											</div>

											@foreach($fundings as $obj)
											@if($loop->first)
											<div class="col-lg-6 col-sm-12">
												<div class="form-group">
													<div class="form-control-wrap">
														<div class="form-icon form-icon-right">
															
														</div>
														<label class="form-label" for="default-01">{{$obj->funding_name}} (Intervention)</label>
														<input type="text" id="fund1" class="form-control" value="{{$interventions->funding1}}" readonly>
													</div>
												</div>
											</div>
											@endif
											@if($loop->last)
											<div class="col-lg-6 col-sm-12">
												<div class="form-group">
													<div class="form-control-wrap">
														<div class="form-icon form-icon-right">
															
														</div>
														<label class="form-label" for="default-01">{{$obj->funding_name}} (Intervention)</label>
														<input type="text" id="fund2" class="form-control" value="{{$interventions->funding2}}" readonly>
													</div>
												</div>
											</div>
											@endif
											@endforeach


											<script type="text/javascript">
												$(function(){
													$('#fund1, #fund2').keyup(function(){
														var fund1 = parseFloat($('#fund1').val()) || 0;
														var fund2 = parseFloat($('#fund2').val()) || 0;
														$('#totalfund').val(fund1 + fund2);
													});
												});
											</script>

											<div class="form-group">
												<label class="form-label" for="default-01">Total</label>
												<div class="form-control-wrap">
													<input type="text" class="form-control" value="{{$interventions->total}}" id="totalfund" readonly >
												</div>
											</div>

											


											<div class="col-lg-6 col-sm-9">
												<div class="form-group">
													<div class="form-control-wrap">
														<div class="form-icon form-icon-right">
															<em class="icon ni ni-calendar-alt"></em>
														</div>
														<input type="text" name="start_date" class="form-control form-control-xl form-control-outlined date-picker" id="outlined-date-picker" value="{{$budgetedit->start_date}}">
														<label class="form-label-outlined" for="outlined-date-picker">Start Date</label>
													</div>
												</div>
											</div>

											<div class="col-lg-6 col-sm-9">
												<div class="form-group">
													<div class="form-control-wrap">
														<div class="form-icon form-icon-right">
															<em class="icon ni ni-calendar-alt"></em>
														</div>
														<input type="text" name="end_date" class="form-control form-control-xl form-control-outlined date-picker" id="outlined-date-picker" value="{{$budgetedit->end_date}}">
														<label class="form-label-outlined" for="outlined-date-picker">End Date</label>
													</div>
												</div>
											</div>

											

											<input type="hidden" name="workplancontainer_id" class="form-control form-control-sm" value="{{$budgetedit->work_plan_container_id}}">

											<input type="hidden" name="implementation_container_id" class="form-control form-control-sm" value="{{$budgetedit->work_plan_container_id}}">

											<input type="hidden" name="budget_id" class="form-control form-control-sm" value="{{$budgetedit->id}}">

											<input type="hidden" name="project_id" class="form-control form-control-sm" value="{{$budgetedit->project_id}}">

											<button type="submit" class="btn btn-primary">Update Budget</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>=
			</div>
		</div>
	</div>
</div>





@endsection
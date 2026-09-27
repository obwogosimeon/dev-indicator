@extends('layouts.apps')
@section('content')





<script type="text/javascript">
	$(document).ready(function() {
		$('#activity').change(function(){
			$.get("{{ url('api/funding1')}}",
				{ option: $(this).val() },
				function(data) {
					console.log('funding1');
					$('#funding1').val(data);
				});
		});
	});
</script>


<script type="text/javascript">
	$(document).ready(function() {
		$('#activity').change(function(){
			$.get("{{ url('api/funding2')}}",
				{ option: $(this).val() },
				function(data) {
					console.log('funding2');
					$('#funding2').val(data);
				});
		});
	});
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#indicator').change(function(){
			$.get("{{ url('api/baseline')}}",
				{ option: $(this).val() },
				function(data) {
					console.log('baseline');
					$('#baseline').val(data);
				});
		});
	});
</script>


<script type="text/javascript">
	$(document).ready(function() {
		$('#indicator').change(function(){
			$.get("{{ url('api/target')}}",
				{ option: $(this).val() },
				function(data) {
					console.log('target');
					$('#target').val(data);
				});
		});
	});
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#indicator').change(function(){
			$.get("{{ url('api/label')}}",
				{ option: $(this).val() },
				function(data) {
					console.log('label');
					$('#label').val(data);
				});
		});
	});
</script>


<script type="text/javascript">
	$(document).ready(function() {
		$('#january').hide();
		$('#february').hide();
		$('#march').hide();
		$('#april').hide();
		$('#may').hide();
		$('#june').hide();
		$('#july').hide();
		$('#august').hide();
		$('#september').hide();
		$('#october').hide();
		$('#november').hide();
		$('#december').hide();
		$('#jan_feb').hide();
		$('#mar_apr').hide();
		$('#may_june').hide();
		$('#july_aug').hide();
		$('#sep_oct').hide();
		$('#nov_dec').hide();
		$('#jan_march').hide();
		$('#april_june').hide();
		$('#july_september').hide();
		$('#october_december').hide();
		$('#jan_june').hide();
		$('#july_december').hide();
		$('#jan_december').hide();

		$('#indicator').change(function(){
			$.get("{{ url('api/frequency')}}",
				{ option: $(this).val() },
				function(data) {
					console.log('reporting');
					$('#reporting').val(data);

					if(data == 'Monthly'){
						$('#january').show();
						$('#february').show();
						$('#march').show();
						$('#april').show();
						$('#may').show();
						$('#june').show();
						$('#july').show();
						$('#august').show();
						$('#september').show();
						$('#october').show();
						$('#november').show();
						$('#december').show();
					}else if(data == 'Bi-Monthly'){
						$('#january').hide();
						$('#february').hide();
						$('#march').hide();
						$('#april').hide();
						$('#may').hide();
						$('#june').hide();
						$('#july').hide();
						$('#august').hide();
						$('#september').hide();
						$('#october').hide();
						$('#november').hide();
						$('#december').hide();
						$('#jan_feb').show();
						$('#mar_apr').show();
						$('#may_june').show();
						$('#july_aug').show();
						$('#sep_oct').show();
						$('#nov_dec').show();
						$('#jan_march').show();
					}else if(data == 'Quaterly'){
						$('#january').hide();
						$('#february').hide();
						$('#march').hide();
						$('#april').hide();
						$('#may').hide();
						$('#june').hide();
						$('#july').hide();
						$('#august').hide();
						$('#september').hide();
						$('#october').hide();
						$('#november').hide();
						$('#december').hide();
						$('#jan_feb').hide();
						$('#mar_apr').hide();
						$('#may_june').hide();
						$('#july_aug').hide();
						$('#sep_oct').hide();
						$('#nov_dec').hide();
						$('#jan_march').show();
						$('#april_june').show();
						$('#july_september').show();
						$('#october_december').show();
					}else if(data == 'Semi-Annual'){
						$('#january').hide();
						$('#february').hide();
						$('#march').hide();
						$('#april').hide();
						$('#may').hide();
						$('#june').hide();
						$('#july').hide();
						$('#august').hide();
						$('#september').hide();
						$('#october').hide();
						$('#november').hide();
						$('#december').hide();
						$('#jan_feb').hide();
						$('#mar_apr').hide();
						$('#may_june').hide();
						$('#july_aug').hide();
						$('#sep_oct').hide();
						$('#nov_dec').hide();
						$('#jan_march').hide();
						$('#april_june').hide();
						$('#july_september').hide();
						$('#october_december').hide();
						$('#jan_june').show();
						$('#july_december').show();
					}else if(data == 'Annual'){
						$('#january').hide();
						$('#february').hide();
						$('#march').hide();
						$('#april').hide();
						$('#may').hide();
						$('#june').hide();
						$('#july').hide();
						$('#august').hide();
						$('#september').hide();
						$('#october').hide();
						$('#november').hide();
						$('#december').hide();
						$('#jan_feb').hide();
						$('#mar_apr').hide();
						$('#may_june').hide();
						$('#july_aug').hide();
						$('#sep_oct').hide();
						$('#nov_dec').hide();
						$('#jan_march').hide();
						$('#april_june').hide();
						$('#july_september').hide();
						$('#october_december').hide();
						$('#jan_june').hide();
						$('#july_december').hide();
						$('#jan_december').show();
					}else if(data == ''){
						$('#january').hide();
						$('#february').hide();
						$('#march').hide();
						$('#april').hide();
						$('#may').hide();
						$('#june').hide();
						$('#july').hide();
						$('#august').hide();
						$('#september').hide();
						$('#october').hide();
						$('#november').hide();
						$('#december').hide();
						$('#jan_feb').hide();
						$('#mar_apr').hide();
						$('#may_june').hide();
						$('#july_aug').hide();
						$('#sep_oct').hide();
						$('#nov_dec').hide();
						$('#jan_march').hide();
						$('#april_june').hide();
						$('#july_september').hide();
						$('#october_december').hide();
						$('#jan_june').hide();
						$('#july_december').hide();
						$('#jan_december').hide();
					}

				});
		});
});
</script>


<script type="text/javascript">
	$(function(){
		$('#annual_amounta, #annual_amountb').keyup(function(){
			var annual_amounta = parseFloat($('#annual_amounta').val()) || 0;
			var annual_amountb = parseFloat($('#annual_amountb').val()) || 0;
			$('#total').val(annual_amounta + annual_amountb);
		});
	});
</script>

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
									<span class="preview-title-lg overline-title">Add Work Plan</span>
									<form method="POST" action="{{ route('createactivitywp')}}" id="createActivityWP">
										@csrf
										<div class="row gy-4">

											<input type="hidden" class="form-control" value="01" name="status" id="default-01">
											<input type="hidden" class="form-control" value="1" name="exchange_rate" id="default-01">
											<input type="hidden" class="form-control" value="{{$workplancontainer->project_id}}" name="project_id" id="default-01">
											
											<input type="hidden" class="form-control" value="{{Auth::user()->id}}" name="created_by" id="default-01">
											<input type="hidden" class="form-control" value="{{Auth::user()->organization_id}}" name="organization_id" id="default-01">
											<input type="hidden" class="form-control" value="{{$workplancontainer->id}}" name="work_plan_container_id" id="default-01">
											<input type="hidden" class="form-control" value="{{$workplancontainer->financial_year}}" name="financial_year" id="default-01">

											
											<div class="form-group" id="program">
												<label class="form-label" for="default-06">Activity Plan</label>
												<div class="form-control-wrap ">
													<div class="form-control-select">
														<select class="form-control" id="activity" name="activity" >
															<option value="">-------Nothing Selected-------</option>
															<option></option>
															@foreach($activities as $obj)
															<option value="{{$obj->id}}">{{$obj->activity_title}}</option>
															@endforeach
														</select>
													</div>
												</div>
											</div>

											<div class="form-group">
												<label class="form-label" for="default-01">Work Plan Details</label>
												<div class="form-control-wrap">
													<input type="text" class="form-control" name="workplan_name" id="workplan_name" placeholder="Input Work Plan Name" required>
												</div>
											</div>

											@foreach($fundings as $obj)
											@if($loop->first)
											<div class="col-lg-6 col-sm-12">
												<div class="form-group">
													<label class="form-label" for="default-01">{{$obj->funding_name}}</label>
													<div class="form-control-wrap">
														<input type="text" class="form-control" name="funding1" readonly="" id="funding1" value="">
													</div>
												</div>
											</div>

											<div class="col-lg-6 col-sm-12">
												<div class="form-group">
													<label class="form-label" for="default-01">{{$obj->funding_name}} Annual Budget</label>
													<div class="form-control-wrap">
														<input type="text" class="form-control" name="annual_amounta" required="" id="annual_amounta" value="">
													</div>
												</div>
											</div>
											@endif
											@if($loop->last)
											<div class="col-lg-6 col-sm-12">
												<div class="form-group">
													<label class="form-label" for="default-01">{{$obj->funding_name}}</label>
													<div class="form-control-wrap">
														<input type="text" class="form-control" name="funding2" readonly="" id="funding2" value="">
													</div>
												</div>
											</div>

											<div class="col-lg-6 col-sm-12">
												<div class="form-group">
													<label class="form-label" for="default-01">{{$obj->funding_name}} Annual Budget</label>
													<div class="form-control-wrap">
														<input type="text" class="form-control" name="annual_amountb" required="" id="annual_amountb" value="">
													</div>
												</div>
											</div>
											@endif
											@endforeach

											<input type="hidden" class="form-control" value="1" name="total" id="total">


											<div class="col-lg-6 col-sm-9">
												<div class="form-group">
													<div class="form-control-wrap">
														<div class="form-icon form-icon-right">
															<em class="icon ni ni-calendar-alt"></em>
														</div>
														<input type="text" name="start_date" class="form-control form-control-xl form-control-outlined date-picker" id="outlined-date-picker">
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
														<input type="text" name="end_date" class="form-control form-control-xl form-control-outlined date-picker" id="outlined-date-picker">
														<label class="form-label-outlined" for="outlined-date-picker">End Date</label>
													</div>
												</div>
											</div>
											
											
											

											

											<div class="col-sm-12">
												<div class="form-group">
													<label class="form-label" for="default-textarea">Description:</label>
													<div class="form-control-wrap">
														<textarea class="form-control no-resize" name="workplan_description" id="default-textarea"></textarea>
													</div>
												</div>
											</div>
											<button type="submit" class="btn btn-primary">Save</button>
											<br>
											<button type="submit" class="btn btn-primary">Save & Add New</button>
										</div>
									</form>

									<script>
										$(document).ready(function() {
											$("#createActivityWP").validate({
												rules: {
													workplan_name: {
														required: true,
														minlength: 5
													},
													annual_amounta: {
														required: true,
														digits: true
													},
													annual_amountb: {
														required: true,
														digits: true
													},
													activity: {
														required: true,
													}
												},
												messages: {
													annual_amounta: {
														required: "Please enter the amount in numbers",
														digits: "Your Amount must consist of at least 1 number 0-9"
													},
													annual_amountb: {
														required: "Please enter the amount in numbers",
														digits: "Your Amount must consist of at least 1 number 0-9"
													},
													workplan_name: {
														required: "Please enter workplan details",
														minlength: "Your Details must consist of at least 5 characters"
													},
													activity: {
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
		</div>
	</div>
</div>

@endsection
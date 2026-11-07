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

<main class="container-fluid admin-page project-workplan-form-page">
					<header class="admin-page__header">
						<div>
							<p class="admin-page__eyebrow">Project planning · {{ $workplancontainer->financial_year }}</p>
							<h1 class="admin-page__title">Add activity plan</h1>
							<p class="admin-page__description">Build an activity schedule and assign its annual funding for this work plan.</p>
						</div>
						<a href="{{ route('projects.show', $workplancontainer->project_id) }}" class="admin-page__button-secondary">
							<em class="icon ni ni-arrow-left" aria-hidden="true"></em>
							Back to project
						</a>
					</header>

					@if ($errors->any())
						<div class="alert alert-danger" role="alert">
							<strong>Please review the activity plan details.</strong>
							@foreach ($errors->all() as $error)
								<div>{{ $error }}</div>
							@endforeach
						</div>
					@endif

			<div class="nk-block nk-block-lg">


				<section class="admin-page__card admin-page__form-card admin-page__form-card--wide">
							<div class="admin-page__card-head">
								<div>
									<h2>Activity plan details</h2>
									<p>Choose an activity, set its funding and schedule, then save it to this work plan.</p>
								</div>
								<span class="admin-page__badge admin-page__badge--amber">{{ $workplancontainer->financial_year }}</span>
							</div>
							<form method="POST" action="{{ route('createactivitywp')}}" id="createActivityWP" class="admin-page__form">
										@csrf
										<div class="admin-page__form-grid">

											<input type="hidden" class="form-control" value="01" name="status" id="default-01">
											<input type="hidden" class="form-control" value="1" name="exchange_rate" id="default-01">
											<input type="hidden" class="form-control" value="{{$workplancontainer->project_id}}" name="project_id" id="default-01">
											
											<input type="hidden" class="form-control" value="{{Auth::user()->id}}" name="created_by" id="default-01">
											<input type="hidden" class="form-control" value="{{Auth::user()->organization_id}}" name="organization_id" id="default-01">
											<input type="hidden" class="form-control" value="{{$workplancontainer->id}}" name="work_plan_container_id" id="default-01">
											<input type="hidden" class="form-control" value="{{$workplancontainer->financial_year}}" name="financial_year" id="default-01">

											
											<div class="admin-page__field admin-page__field--full" id="program">
												<label for="activity">Activity <span class="text-danger">*</span></label>
												<select class="form-control" id="activity" name="activity" required>
													<option value="">Select an activity</option>
													@foreach($activities as $obj)
														<option value="{{$obj->id}}"{{ (string) old('activity') === (string) $obj->id ? ' selected' : '' }}>{{$obj->activity_title}}</option>
													@endforeach
												</select>
												@if($activities->isEmpty())
													<span class="admin-page__field-hint">No activities are available for this project yet. Add an activity to a project intervention before creating its work plan.</span>
												@else
													<span class="admin-page__field-hint">Select an activity linked to this project.</span>
												@endif
											</div>

											<div class="admin-page__field admin-page__field--full">
												<label for="workplan_name">Activity plan name <span class="text-danger">*</span></label>
												<input type="text" class="form-control" name="workplan_name" id="workplan_name" value="{{ old('workplan_name') }}" placeholder="e.g. Community health outreach" required>
											</div>

											@foreach($fundings as $obj)
											@if($loop->first)
											<div class="admin-page__field">
												<label for="funding1">{{$obj->funding_name}}</label>
												<input type="text" class="form-control" name="funding1" readonly id="funding1" value="" aria-describedby="funding-help">
											</div>

											<div class="admin-page__field">
												<label for="annual_amounta">{{$obj->funding_name}} annual budget <span class="text-danger">*</span></label>
												<input type="text" class="form-control" name="annual_amounta" required id="annual_amounta" value="{{ old('annual_amounta') }}" inputmode="numeric">
											</div>
											@endif
											@if($loop->last)
											<div class="admin-page__field">
												<label for="funding2">{{$obj->funding_name}}</label>
												<input type="text" class="form-control" name="funding2" readonly id="funding2" value="" aria-describedby="funding-help">
											</div>

											<div class="admin-page__field">
												<label for="annual_amountb">{{$obj->funding_name}} annual budget <span class="text-danger">*</span></label>
												<input type="text" class="form-control" name="annual_amountb" required id="annual_amountb" value="{{ old('annual_amountb') }}" inputmode="numeric">
											</div>
											@endif
											@endforeach

											<span id="funding-help" class="admin-page__field-hint admin-page__field--full">Choose an activity to load the available funding sources, then enter the amount assigned to each source.</span>

											<div class="admin-page__field">
												<label for="total">Total activity budget</label>
												<input type="text" class="form-control" value="0" name="total" id="total" readonly>
											</div>

											<div class="admin-page__field">
												<label for="workplan-start-date">Start date <span class="text-danger">*</span></label>
												<input type="text" name="start_date" class="form-control date-picker" id="workplan-start-date" value="{{ old('start_date') }}" required>
											</div>

											<div class="admin-page__field">
												<label for="workplan-end-date">End date <span class="text-danger">*</span></label>
												<input type="text" name="end_date" class="form-control date-picker" id="workplan-end-date" value="{{ old('end_date') }}" required>
											</div>
											
											
											

											

											<div class="admin-page__field admin-page__field--full">
												<label for="workplan-description">Description</label>
												<textarea class="form-control no-resize" name="workplan_description" id="workplan-description" rows="4" placeholder="Add context or notes for this activity plan.">{{ old('workplan_description') }}</textarea>
											</div>
										</div>
										<div class="admin-page__form-footer">
											<button type="submit" name="after_save" value="project" class="admin-page__button">
												<em class="icon ni ni-save" aria-hidden="true"></em>
												Save activity plan
											</button>
											<button type="submit" name="after_save" value="add_another" class="admin-page__button-secondary">
												Save &amp; add another
											</button>
											<a href="{{ route('projects.show', $workplancontainer->project_id) }}" class="admin-page__button-secondary">Cancel</a>
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
				</section>

			</div>
		</main>

@endsection
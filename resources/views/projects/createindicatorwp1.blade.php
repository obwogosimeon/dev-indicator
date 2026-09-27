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
					// console.log('baseline');
					// var firstbaseline = data.toString().split(',')[0];
					// var secondbaseline = data.toString().split(',')[1];
					// $('#baseline1').val(firstbaseline);
					// $('#baseline2').val(secondbaseline);
					// if(data.toString > 0)
					var retrieved_date = data;
 					var substr = retrieved_date.toString().split(',');
					// var i;
					for (let i = 0; i < substr.length; ++i) {
					    $('#baseline1').val(substr[i]);
					}
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
					// console.log('target');
					// var firsttarget = data.toString().split(',')[0];
					// var secondtarget = data.toString().split(',')[1];
					// $('#target1').val(firsttarget);
					// $('#target2').val(secondtarget);
					var retrieved_date = data;
 					var substr = retrieved_date.toString().split(',');
					// var i;
					for (let i = 0; i < substr.length; ++i) {
					    $('#target1').val(substr[i]);
					}
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
					// console.log('label');
					// var firstlabel = data.toString().split(',')[0];
					// var secondlabel = data.toString().split(',')[1];
					// $('#label1').val(firstlabel);
					// $('#label2').val(secondlabel);
					var retrieved_date = data;
 					var substr = retrieved_date.toString().split(',');
 					// console.log(substr);
					var i;
					let inputs = '';
					for (let i = 0; i < substr.length; ++i) {
					    inputs += `<input type="text" class="form-control" name="label1${i+1}" readonly="" id="label1${i+1}" required="" tabindex="${i+1}"></br>`
					}
				});
		});
	});
</script>


<script type="text/javascript">
	$(document).ready(function() {
		$('#none1').hide();
		$('#none2').hide();
		$('#none3').hide();
		$('#des1').hide();
		$('#des2').hide();
		$('#des3').hide();
		$('#des4').hide();
		$('#des5').hide();
		$('#des6').hide();

		$('#indicator').change(function(){
			$.get("{{ url('api/des')}}",
				{ option: $(this).val() },
				function(data) {
					console.log('data');
					// $('#reporting').val(data);

					if(data == 'none'){
						$('#none1').show();
						$('#none2').show();
						$('#none3').show();
						$('#des1').hide();
						$('#des2').hide();
						$('#des3').hide();
						$('#des4').hide();
						$('#des5').hide();
						$('#des6').hide();
					}else if(data == 'Disaggregation' || data == 'Disaggregation1' || data == 'Disaggregation2'){
						$('#none1').hide();
						$('#none2').hide();
						$('#none3').hide();
						$('#des1').show();
						$('#des2').show();
						$('#des3').show();
						$('#des4').show();
						$('#des5').show();
						$('#des6').show();
					}

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
		$('#january1').hide();
		$('#february1').hide();
		$('#march1').hide();
		$('#april1').hide();
		$('#may1').hide();
		$('#june1').hide();
		$('#july1').hide();
		$('#august1').hide();
		$('#september1').hide();
		$('#october1').hide();
		$('#november1').hide();
		$('#december1').hide();
		$('#jan_feb').hide();
		$('#mar_apr').hide();
		$('#may_june').hide();
		$('#july_aug').hide();
		$('#sep_oct').hide();
		$('#nov_dec').hide();
		$('#jan_feb1').hide();
		$('#mar_apr1').hide();
		$('#may_june1').hide();
		$('#july_aug1').hide();
		$('#sep_oct1').hide();
		$('#nov_dec1').hide();
		$('#jan_march1').hide();
		$('#april_june1').hide();
		$('#july_september1').hide();
		$('#october_december1').hide();
		$('#jan_march2').hide();
		$('#april_june2').hide();
		$('#july_september2').hide();
		$('#october_december2').hide();
		$('#jan_june').hide();
		$('#july_december').hide();
		$('#jan_june1').hide();
		$('#july_december1').hide();
		$('#jan_december1').hide();
		$('#jan_december2').hide();

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
						$('#january1').show();
						$('#february1').show();
						$('#march1').show();
						$('#april1').show();
						$('#may1').show();
						$('#june1').show();
						$('#july1').show();
						$('#august1').show();
						$('#september1').show();
						$('#october1').show();
						$('#november1').show();
						$('#december1').show();
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
						$('#january1').hide();
						$('#february1').hide();
						$('#march1').hide();
						$('#april1').hide();
						$('#may1').hide();
						$('#june1').hide();
						$('#july1').hide();
						$('#august1').hide();
						$('#september1').hide();
						$('#october1').hide();
						$('#november1').hide();
						$('#december1').hide();
						$('#jan_feb').show();
						$('#mar_apr').show();
						$('#may_june').show();
						$('#july_aug').show();
						$('#sep_oct').show();
						$('#nov_dec').show();
						$('#jan_feb1').show();
						$('#mar_apr1').show();
						$('#may_june1').show();
						$('#july_aug1').show();
						$('#sep_oct1').show();
						$('#nov_dec1').show();
						// $('#jan_march').show();
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
						$('#jan_march1').show();
						$('#april_june1').show();
						$('#july_september1').show();
						$('#october_december1').show();
						$('#jan_march2').show();
						$('#april_june2').show();
						$('#july_september2').show();
						$('#october_december2').show();
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
						$('#jan_june1').show();
						$('#july_december1').show();
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
						$('#jan_december1').show();
						$('#jan_december2').show();
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
		$('#amounta, #amountb').keyup(function(){
			var amounta = parseFloat($('#amounta').val()) || 0;
			var amountb = parseFloat($('#amountb').val()) || 0;
			$('#total').val(amounta + amountb);
		});
	});
</script>

<div class="nk-block nk-block-lg">
	<div class="nk-block-head">
		<div class="nk-block-head-content">
			<nav>
				<ul class="breadcrumb breadcrumb-pipe">
					<li class="breadcrumb-item"><a href="{{ url('/home')}}">Home</a></li>
					<li class="breadcrumb-item"><a href="{{ route('projects.index')}}">Projects</a></li>
					<li class="breadcrumb-item"><a href="{{ route('projects.show', $workplancontainer->project_id)}}">Indicator Workplans</a></li>
					<li class="breadcrumb-item active">Add Indicator WorkPlan</li>
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

		</div><!-- .nk-block-head -->
		<div class="card card-bordered card-preview">
			<div class="card-inner">
				<div class="preview-block">
					<span class="preview-title-lg overline-title">Add Work Plan</span>
					<form method="POST" action="{{ route('createindicatorworkp')}}">
						@csrf
						<div class="row gy-4">

							<input type="hidden" class="form-control" value="01" name="status" id="default-01">
							<input type="hidden" class="form-control" value="1" name="exchange_rate" id="default-01">
							<input type="hidden" class="form-control" value="1" name="project_id" id="default-01">

							<input type="hidden" class="form-control" value="{{Auth::user()->id}}" name="created_by" id="default-01">
							<input type="hidden" class="form-control" value="{{Auth::user()->organization_id}}" name="organization_id" id="default-01">
							<input type="hidden" class="form-control" value="{{$workplancontainer->id}}" name="work_plan_container_id" id="default-01">
							<input type="hidden" class="form-control" value="{{$workplancontainer->financial_year}}" name="financial_year" id="default-01">

							<div class="form-group" id="program">
								<label class="form-label" for="default-06">Indicator Plan</label>
								<div class="form-control-wrap ">
									<div class="form-control-select">
										<select class="form-control" id="indicator" name="indicator_id" >
											<option value="#">Nothing Selected</option>
											<option></option>  
											@foreach($indicators as $obj)
											<option value="{{$obj->id}}">{{$obj->indicator_title}}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>

							<div class="col-lg-12 col-sm-12">
								<div class="form-group">
									<label class="form-label" for="default-01">Frequency</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="reporting" id="reporting" required="">
									</div>
								</div>
							</div>


							<div class="row gy-4 align-center" id="">
								<div class="col-lg-4" id="none1">
									<div class="form-group">
										<label class="form-label" for="default-01">Label</label>
										<div class="form-control-wrap">
											<input type="text" class="form-control" name="label" readonly="" id="label" required="">
										</div>
									</div>
								</div>
								<div class="col-lg-4" id="none2">
									<div class="form-group">
										<label class="form-label" for="default-01">Baseline</label>
										<div class="form-control-wrap">
											<input type="text" class="form-control" name="baseline" readonly="" id="baseline" value="">
										</div>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group" id="none3">
										<label class="form-label" for="default-01">Target</label>
										<div class="form-control-wrap">
											<input type="text" class="form-control" name="target" readonly="" id="target" value="">
										</div>
									</div>
								</div>
								
							</div>


							<div class="row gy-4 align-center" id="des">
								<div class="col-lg-4" id="des1">
									<div class="form-group">
										<label class="form-label" for="default-01">Label</label>
										<div class="form-control-wrap">
											<input type="text" class="form-control" name="label1" readonly="" id="label1" required="">
										</div>
									</div>
								</div>
								<div class="col-lg-4" id="des2">
									<div class="form-group">
										<label class="form-label" for="default-01">Baseline</label>
										<div class="form-control-wrap">
											<input type="text" class="form-control" name="baseline" readonly="" id="baseline1" value="">
										</div>
									</div>
								</div>
								<div class="col-lg-4" id="des3">
									<div class="form-group">
										<label class="form-label" for="default-01">Target</label>
										<div class="form-control-wrap">
											<input type="text" class="form-control" name="target" readonly="" id="target1" value="">
										</div>
									</div>
								</div>

								<!-- Bi-Monthly fields -->

							<div class="col-lg-6 col-sm-12" id="jan_feb1">
								<div class="form-group">
									<label class="form-label" for="default-01">January To February (Bi-Monthly)</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="jan_feb" id="jan_feb1" placeholder="December">
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-sm-12" id="mar_apr1">
								<div class="form-group">
									<label class="form-label" for="default-01">March To April (Bi-Monthly)</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="mar_apr" id="mar_apr1" placeholder="December">
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-sm-12" id="may_june1">
								<div class="form-group">
									<label class="form-label" for="default-01">May To June (Bi-Monthly)</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="may_june" id="may_june1" placeholder="December">
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-sm-12" id="july_aug1">
								<div class="form-group">
									<label class="form-label" for="default-01">July To August (Bi-Monthly)</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="july_aug" id="july_aug1" placeholder="December">
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-sm-12" id="sep_oct1">
								<div class="form-group">
									<label class="form-label" for="default-01">September To October (Bi-Monthly)</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="sep_oct" id="sep_oct1" placeholder="December">
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-sm-12" id="nov_dec1">
								<div class="form-group">
									<label class="form-label" for="default-01">November To December (Bi-Monthly)</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="nov_dec" id="nov_dec1" placeholder="December">
									</div>
								</div>
							</div>

								<!-- Semi-Annual -->

							<div class="col-lg-6 col-sm-12" id="jan_june1">
								<div class="form-group">
									<label class="form-label" for="default-01">January To June (Semi-Annual)</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="jan_june" id="jan_june1" placeholder="December">
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-sm-12" id="july_december1">
								<div class="form-group">
									<label class="form-label" for="default-01">July To December (Semi-Annual)</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="july_december" id="july_december1" placeholder="December">
									</div>
								</div>
							</div>

								<!--- Quaterly fields -->

							<div class="col-lg-6 col-sm-12" id="jan_march1">
								<div class="form-group">
									<label class="form-label" for="default-01">January To March (Quaterly)</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="jan_march" id="jan_march1" placeholder="December">
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-sm-12" id="april_june1">
								<div class="form-group">
									<label class="form-label" for="default-01">April To June (Quaterly)</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="april_june" id="april_june1" placeholder="December">
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-sm-12" id="july_september1">
								<div class="form-group">
									<label class="form-label" for="default-01">July To September (Quaterly)</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="july_september" id="july_september1"  placeholder="December">
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-sm-12" id="october_december1">
								<div class="form-group">
									<label class="form-label" for="default-01">October To December (Quaterly)</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="october_december" id="october_december1" placeholder="December">
									</div>
								</div>
							</div>

							<!--- Annual -->

							<div class="form-group" id="jan_december1">
								<label class="form-label" for="default-01">January To December</label>
								<div class="form-control-wrap">
									<input type="text" class="form-control" name="jan_december1"  id="jan_december1">
								</div>
							</div>

							<!-- Monthly -->

							<div class="col-lg-6 col-sm-12" id="january1">
								<div class="form-group">
									<label class="form-label" for="default-01">January</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="january" id="january1" value="" placeholder="January">
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-sm-12" id="february1">
								<div class="form-group">
									<label class="form-label" for="default-01">February</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="february" id="february1" value="" placeholder="February">
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-sm-12" id="march1">
								<div class="form-group">
									<label class="form-label" for="default-01">March</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="march" id="march1" placeholder="March">
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-sm-12" id="april1">
								<div class="form-group">
									<label class="form-label" for="default-01">April</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="april" id="april1" placeholder="`April">
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-sm-12" id="may1">
								<div class="form-group">
									<label class="form-label" for="default-01">May</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="may" id="may1" value="" placeholder="May">
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-sm-12" id="june1">
								<div class="form-group">
									<label class="form-label" for="default-01">June</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="june" id="june1" value="" placeholder="June">
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-sm-12" id="july1">
								<div class="form-group">
									<label class="form-label" for="default-01">July</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="july" id="july1" placeholder="July">
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-sm-12" id="august1">
								<div class="form-group">
									<label class="form-label" for="default-01">August</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="august" id="august1" placeholder="August">
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-sm-12" id="september1">
								<div class="form-group">
									<label class="form-label" for="default-01">September</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="september" id="september1" value="" placeholder="September">
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-sm-12" id="october1">
								<div class="form-group">
									<label class="form-label" for="default-01">October</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="october" id="october1" value="" placeholder="October">
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-sm-12" id="november1">
								<div class="form-group">
									<label class="form-label" for="default-01">November</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="november" id="november1" placeholder="November">
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-sm-12" id="december1">
								<div class="form-group">
									<label class="form-label" for="default-01">December</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="december" id="december1" placeholder="December">
									</div>
								</div>
							</div>

							<hr>

								<div class="col-lg-4" id="des4">
									<div class="form-group">
										<label class="form-label" for="default-01">Label</label>
										<div class="form-control-wrap">
											<input type="text" class="form-control" name="label" readonly="" id="label2" required="">
										</div>
									</div>
								</div>
								<div class="col-lg-4" id="des5">
									<div class="form-group">
										<label class="form-label" for="default-01">Baseline</label>
										<div class="form-control-wrap">
											<input type="text" class="form-control" name="baseline" readonly="" id="baseline2" value="">
										</div>
									</div>
								</div>
								<div class="col-lg-4" id="des6">
									<div class="form-group">
										<label class="form-label" for="default-01">Target</label>
										<div class="form-control-wrap">
											<input type="text" class="form-control" name="target" readonly="" id="target2" value="">
										</div>
									</div>
								</div>

								<!--- Quaterly fields -->

							<div class="col-lg-6 col-sm-12" id="jan_march2">
								<div class="form-group">
									<label class="form-label" for="default-01">January To March (Quaterly)</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="jan_march" id="jan_march2" placeholder="December">
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-sm-12" id="april_june2">
								<div class="form-group">
									<label class="form-label" for="default-01">April To June (Quaterly)</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="april_june" id="april_june2" placeholder="December">
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-sm-12" id="july_september2">
								<div class="form-group">
									<label class="form-label" for="default-01">July To September (Quaterly)</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="july_september" id="july_september2"  placeholder="December">
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-sm-12" id="october_december2">
								<div class="form-group">
									<label class="form-label" for="default-01">October To December (Quaterly)</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="october_december" id="october_december2" placeholder="December">
									</div>
								</div>
							</div>

							<!--- Annual -->

							<div class="form-group" id="jan_december2">
								<label class="form-label" for="default-01">January To December</label>
								<div class="form-control-wrap">
									<input type="text" class="form-control" name="jan_december2"  id="jan_december2">
								</div>
							</div>

							<!--Monthly -->

							<div class="col-lg-6 col-sm-12" id="january">
								<div class="form-group">
									<label class="form-label" for="default-01">January</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="january" id="january" value="" placeholder="January">
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-sm-12" id="february">
								<div class="form-group">
									<label class="form-label" for="default-01">February</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="february" id="february" value="" placeholder="February">
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-sm-12" id="march">
								<div class="form-group">
									<label class="form-label" for="default-01">March</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="march" id="march" placeholder="March">
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-sm-12" id="april">
								<div class="form-group">
									<label class="form-label" for="default-01">April</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="april" id="april" placeholder="`April">
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-sm-12" id="may">
								<div class="form-group">
									<label class="form-label" for="default-01">May</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="may" id="may" value="" placeholder="May">
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-sm-12" id="june">
								<div class="form-group">
									<label class="form-label" for="default-01">June</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="june" id="june" value="" placeholder="June">
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-sm-12" id="july">
								<div class="form-group">
									<label class="form-label" for="default-01">July</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="july" id="july" placeholder="July">
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-sm-12" id="august">
								<div class="form-group">
									<label class="form-label" for="default-01">August</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="august" id="august" placeholder="August">
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-sm-12" id="september">
								<div class="form-group">
									<label class="form-label" for="default-01">September</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="september" id="september" value="" placeholder="September">
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-sm-12" id="october">
								<div class="form-group">
									<label class="form-label" for="default-01">October</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="october" id="october" value="" placeholder="October">
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-sm-12" id="november">
								<div class="form-group">
									<label class="form-label" for="default-01">November</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="november" id="november" placeholder="November">
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-sm-12" id="december">
								<div class="form-group">
									<label class="form-label" for="default-01">December</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="december" id="december" placeholder="December">
									</div>
								</div>
							</div>


							<!-- Semi-Annual -->

							<div class="col-lg-6 col-sm-12" id="jan_june">
								<div class="form-group">
									<label class="form-label" for="default-01">January To June (Semi-Annual)</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="jan_june" id="jan_june" placeholder="December">
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-sm-12" id="july_december">
								<div class="form-group">
									<label class="form-label" for="default-01">July To December (Semi-Annual)</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="july_december" id="july_december" placeholder="December">
									</div>
								</div>
							</div>

							<!-- Bi-Monthly fields -->

							<div class="col-lg-6 col-sm-12" id="jan_feb">
								<div class="form-group">
									<label class="form-label" for="default-01">January To February (Bi-Monthly)</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="jan_feb" id="jan_feb" placeholder="December">
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-sm-12" id="mar_apr">
								<div class="form-group">
									<label class="form-label" for="default-01">March To April (Bi-Monthly)</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="mar_apr" id="mar_apr" placeholder="December">
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-sm-12" id="may_june">
								<div class="form-group">
									<label class="form-label" for="default-01">May To June (Bi-Monthly)</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="may_june" id="may_june" placeholder="December">
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-sm-12" id="july_aug">
								<div class="form-group">
									<label class="form-label" for="default-01">July To August (Bi-Monthly)</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="july_aug" id="july_aug" placeholder="December">
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-sm-12" id="sep_oct">
								<div class="form-group">
									<label class="form-label" for="default-01">September To October (Bi-Monthly)</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="sep_oct" id="sep_oct" placeholder="December">
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-sm-12" id="nov_dec">
								<div class="form-group">
									<label class="form-label" for="default-01">November To December (Bi-Monthly)</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="nov_dec" id="nov_dec" placeholder="December">
									</div>
								</div>
							</div>
								
							</div>

							<hr>
							<p><B>Targets</B></p>



							

							

							<!--- Quaterly fields -->

							<!-- <div class="col-lg-6 col-sm-12" id="jan_march">
								<div class="form-group">
									<label class="form-label" for="default-01">January To March (Quaterly)</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="jan_march" id="jan_march" placeholder="December">
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-sm-12" id="april_june">
								<div class="form-group">
									<label class="form-label" for="default-01">April To June (Quaterly)</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="april_june" id="april_june" placeholder="December">
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-sm-12" id="july_september">
								<div class="form-group">
									<label class="form-label" for="default-01">July To September (Quaterly)</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="july_september" id="july_september"  placeholder="December">
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-sm-12" id="october_december">
								<div class="form-group">
									<label class="form-label" for="default-01">October To December (Quaterly)</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="october_december" id="october_december" placeholder="December">
									</div>
								</div>
							</div> -->


							

							


							<div class="col-sm-12">
								<div class="form-group">
									<label class="form-label" for="default-textarea">Description:</label>
									<div class="form-control-wrap">
										<textarea class="form-control no-resize" name="workplan_description" id="default-textarea"></textarea>
									</div>
								</div>
							</div>
							<button type="submit" class="btn btn-primary">Add Indicator Work Plan</button>
						</div>
					</form>


				</div>
			</div>
		</div>

	</div>
</div>


@endsection
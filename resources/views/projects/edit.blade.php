@extends('layouts.apps')
@section('content')


<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
					<nav>
						<ul class="breadcrumb breadcrumb-pipe">
							<li class="breadcrumb-item"><a href="{{ url('/home')}}">Home</a></li>
							<li class="breadcrumb-item"><a href="{{ route('projects.index')}}">Projects</a></li>
							<li class="breadcrumb-item active">Update Project</li>
						</ul>
					</nav>
					<br>
					<div class="nk-block nk-block-lg">


						<div class="card card-bordered card-preview">
							<div class="card-inner">
								<div class="preview-block">
									<span class="preview-title-lg overline-title">Edit Project</span>


									{!! Form::model($projectedit, ['method' => 'PATCH','route' => ['projects.update', $projectedit->id]]) !!}
									@csrf
									<div class="row gy-4">

										<div class="form-group">
											<label class="form-label" for="default-01">Project Name</label>
											<div class="form-control-wrap">
												<input type="text" class="form-control" name="project_name" value="{{$projectedit->project_name}}">
											</div>
										</div>

										<input type="hidden" name="organization_id" class="form-control" id="default-01" readonly="" value="{{ Auth::user()->organization_id }}">

										<input type="hidden" name="created_by" class="form-control" id="default-01" readonly="" value="{{ Auth::user()->id }}"> 

										<input type="hidden" name="status" class="form-control" id="default-01" readonly="" value="04">

										<div class="col-lg-4 col-sm-6">
											<div class="form-group">
												<div class="form-control-wrap">
													<div class="form-icon form-icon-right">
														<em class="icon ni ni-calendar-alt"></em>
													</div>
													<input type="text" name="start_date" value="{{$projectedit->start_date}}" class="form-control form-control-xl form-control-outlined date-picker" id="outlined-date-picker">
													<label class="form-label-outlined" for="outlined-date-picker">Start Date</label>
												</div>
											</div>
										</div>

										<div class="col-lg-4 col-sm-6">
											<div class="form-group">
												<div class="form-control-wrap">
													<div class="form-icon form-icon-right">
														<em class="icon ni ni-calendar-alt"></em>
													</div>
													<input type="text" name="end_date" value="{{$projectedit->end_date}}" class="form-control form-control-xl form-control-outlined date-picker" id="outlined-date-picker">
													<label class="form-label-outlined" for="outlined-date-picker">End Date</label>
												</div>
											</div>
										</div>

										<div class="form-group">
											<label class="form-label" for="default-06">Reporting Frequency</label>
											<div class="form-control-wrap ">
												<div class="form-control-select">
													<select class="form-control" name="reporting_frequency" id="reporting_frequency">
														<option value="{{$projectedit->reporting_frequency}}">{{$projectedit->reporting_frequency}}</option>
														<!-- <option value="null"></option> -->
														<option value="Monthly">Monthly</option>
														<option value="BiMonthly">Bi-Monthly</option>
														<option value="Quaterly">Quaterly</option>
														<option value="SemiAnnual">Semi-Annual</option>
														<option value="Annaul">Annaul</option>
													</select>
												</div>
											</div>
										</div>

										<div class="form-group">
											<label class="form-label" for="default-06">Choose Programme/Log Frame</label>
											<div class="form-control-wrap ">
												<div class="form-control-select">
													<select class="form-control" name="program_id" id="choose">
														<option value="null">-------Select Programme-------</option>
														<option value="null"></option>
														<option value="programmeshow">Programme</option>
														<!-- <option value="logframeshow">Log Frame</option> -->
													</select>
												</div>
											</div>
										</div>

										<div class="form-group" id="program">
											<label class="form-label" for="default-06">Programme</label>
											<div class="form-control-wrap ">
												<div class="form-control-select">
													<select class="form-control" id="default-06" name="program_id" >
														<option value="{{$projectedit->program_id}}">{{$projectedit->program->program_name}}</option>
														<option></option>                                                   
														@foreach($programs as $object)
														<option value="{{$object->id}}">{{$object->program_name}}</option>
														@endforeach
													</select>
												</div>
											</div>
										</div>

											<!-- <div class="form-group" id="LogFrame">
												<label class="form-label" for="default-06">Log Frame</label>
												<div class="form-control-wrap ">
													<div class="form-control-select">
														<select class="form-control" id="default-06" name="logframe_id">
															<option value="#">-------Select LogFrame-------</option>
															<option></option>
															@foreach($logframes as $object)
															<option value="{{$object->id}}">{{$object->logframe_name}}</option>
															@endforeach
														</select>
													</div>
												</div>
											</div> -->
											<div class="form-group">
												<label class="form-label" for="default-06">Exchange Period</label>
												<div class="form-control-wrap ">
													<div class="form-control-select">
														<select class="form-control" name="exchange_period" id="default-06">
															<option value="#">-------Select Exchange Period-------</option>
															<option></option>
															@foreach($currencies as $object)
															<option value="{{$object->id}}">{{$object->currency_name}}</option>
															@endforeach
														</select>
													</div>
												</div>
											</div>
											<div class="col-sm-12">
												<div class="form-group">
													<label class="form-label" for="default-textarea">Project Description</label>
													<div class="form-control-wrap">
														<textarea class="form-control no-resize" name="description" id="default-textarea"></textarea>
													</div>
												</div>
											</div>

											<!-- <button type="submit" class="btn btn-primary"></button> -->
										</div>
										<br>
										<button style="margin-left: 40%;" type="submit" class="btn btn-round btn-primary"><em class="icon ni ni-reload"></em>&nbsp Update Project</button>
										{!! Form::close() !!}
									</div>
								</div>
							</div>
						</div>
					</div>=
				</div>
			</div>




	@endsection
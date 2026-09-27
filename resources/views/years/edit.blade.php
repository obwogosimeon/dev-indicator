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
                            <li class="breadcrumb-item"><a href="{{ route('years.index')}}">Fiscal Years</a></li>
                            <li class="breadcrumb-item active">Add Fiscal Year</li>
                        </ul>
                    </nav>
                    <br>
					<div class="nk-block nk-block-lg">

						<div class="card card-bordered card-preview">
							<div class="card-inner">
								<div class="preview-block">
									<span class="preview-title-lg overline-title">Create Fiscal Year</span>

									<!-- <p style="color: red">*For FX we do an API call in the background*</p> -->

									{!! Form::model($yearedit, ['method' => 'PATCH','route' => ['years.update', $yearedit->id]]) !!}
										@csrf
										<div class="row gy-4">

											<div class="form-group">
												<label class="form-label" for="default-01">Fiscal Year Name</label>
												<div class="form-control-wrap">
													<input type="text" name="year_name" class="form-control" id="default-01" value="{{$yearedit->year_name}}">
												</div>
											</div>

											<div class="col-lg-4 col-sm-6">
												<div class="form-group">
													<div class="form-control-wrap">
														<div class="form-icon form-icon-right">
															<em class="icon ni ni-calendar-alt"></em>
														</div>
														<input type="text" value="{{$yearedit->start_date}}" name="start_date" class="form-control form-control-xl form-control-outlined date-picker" id="outlined-date-picker">
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
														<input type="text" value="{{$yearedit->end_date}}" name="end_date" class="form-control form-control-xl form-control-outlined date-picker" id="outlined-date-picker">
														<label class="form-label-outlined" for="outlined-date-picker">End Date</label>
													</div>
												</div>
											</div>

											<button type="submit" class="btn btn-primary">Create Year</button>

										</div>

									{!! Form::close() !!}
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
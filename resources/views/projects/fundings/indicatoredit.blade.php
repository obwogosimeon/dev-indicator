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
                                <li class="breadcrumb-item active">Edit Implementation Indicator</li>
                            </ul>
                        </nav>
                        <br>
					<div class="nk-block nk-block-lg">


						<div class="card card-bordered card-preview">
							<div class="card-inner">
								<div class="preview-block">
									<span class="preview-title-lg overline-title">Edit Implementaion Indicator</span>


									<form method="POST" action="{{ url('updateindicator', $indicatorupdate->id)}}">
										@csrf
										<div class="row gy-4 align-center">

											

											<div class="col-lg-4">
												<div class="form-group">
													<label class="form-label" for="default-01">Budget Current Period (USAID)</label>
													<div class="form-control-wrap">
														<input type="text" name="budget_current_period1" class="form-control" value="">
													</div>
												</div>
											</div>

											<div class="col-lg-4">
												<div class="form-group">
													<label class="form-label" for="default-01">Expense Current Period (USAID)</label>
													<div class="form-control-wrap">
														<input type="text" name="expense_current_period1" class="form-control form-control-sm" value="">
													</div>
												</div>
											</div>

											<div class="col-sm-12">
												<div class="form-group">
													<label class="form-label" for="default-textarea">USAID Description</label>
													<div class="form-control-wrap">
														<textarea class="form-control no-resize" name="comment1" id="default-textarea"></textarea>
													</div>
												</div>
											</div>

											<hr>

											<div class="col-lg-4">
												<div class="form-group">
													<label class="form-label" for="default-01">UKAID ANNUAL BUDGET</label>
													<div class="form-control-wrap">
														<input type="text" class="form-control form-control-lg" value="{{$indicatorupdate->annual_amountb}}" readonly>
													</div>
												</div>
											</div>

											<div class="col-lg-4">
												<div class="form-group">
													<label class="form-label" for="default-01">Budget Current Period (UKAID)</label>
													<div class="form-control-wrap">
														<input type="text" name="budget_current_period2" class="form-control" value="">
													</div>
												</div>
											</div>

											<div class="col-lg-4">
												<div class="form-group">
													<label class="form-label" for="default-01">Expense Current Period (UKAID)</label>
													<div class="form-control-wrap">
														<input type="text" name="expense_current_period2" class="form-control form-control-sm" value="">
													</div>
												</div>
											</div>

											<div class="col-sm-12">
												<div class="form-group">
													<label class="form-label" for="default-textarea">UKAID Description</label>
													<div class="form-control-wrap">
														<textarea class="form-control no-resize" name="comment2" id="default-textarea"></textarea>
													</div>
												</div>
											</div>

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
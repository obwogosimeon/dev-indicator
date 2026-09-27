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
                            <!-- <li class="breadcrumb-item"><a href="{{ route('accounts.index')}}">Account</a></li> -->
                            <li class="breadcrumb-item active">Fundings</li>
                        </ul>
                    </nav>
                    <br>

					@if ($message = Session::get('success'))
					<div class="alert alert-success">
						<p>{{ $message }}</p>
					</div>
					@endif

					<a href="{{ route('fundingcreate')}}" style="align: left;" class="btn btn-round btn-lg btn-primary">Add Funding</a>

					<br>
					<br>

					<div class="card card-bordered card-preview">
						<div class="card-inner">
							<table class="datatable-init table">
								<thead>
									<tr>
										<th>#</th>
										<th>Financier</th>
										<th>Used for</th>.
										<th>For Expenditure?</th>
										<th>Varibale Name</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php $i = 1; ?>
									@foreach ($fundings as $key => $object)
									<tr>
										<td>{{$i}}</td>
										<td>{{ $object->funding_name }}</td>
										<td>{{ $object->funding_type }}</td>
										<td>{{ $object->expenditure }}</td>
										<td>{{ $object->variable_name }}</td>
										<td>
											<li class="col-sm-6 col-lg-3">

												<div class="dropdown">
													<a href="#" class="btn btn-primary" data-bs-toggle="dropdown"><span>Select Action</span><em class="icon ni ni-chevron-down"></em></a>
													<div class="dropdown-menu dropdown-menu-end dropdown-menu-auto mt-1">
														<ul class="link-list-plain">
															<li><a href="{{ route('funding.edit', $object->id) }}">Update</a></li>
															<li><a href="{{ route('funding.show', $object->id) }}">Show</a></li>
														</ul>
													</div>
												</div>
											</li>
										</td>
									</tr>
									<?php $i++; ?>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>

					<br>

					<div class="example-alerts">
						<div class="gy-4">
							<div class="example-alert">
								<div class="alert alert-pro alert-primary">
									<div class="alert-text">
										<!-- <h6>Welcome toPrograme Home Page</h6> -->
										<p>Fundings are account entry modes. E.g. For budget, one can have organization budget as well as donor budget.
											On other instances, expenditure can also be separated into either Internal expenditure or donor expenditure.
										You can enter as many as possible, just note that for each account, all entries will be availed. Or as few as two -one for budget and expenditure</p>
									</div>
								</div>
							</div>
							<div class="example-alert">
								<div class="alert alert-pro alert-secondary">
									<div class="alert-text">
										<!-- <h6>User roles and access can be set based on this programme</h6> -->
										<p style="color: green;"><i>Funding from programmes or projects can be modified from the respective programme or project</i></p>
									</div>
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
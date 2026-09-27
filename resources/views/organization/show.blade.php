@extends('layouts.apps')
@section('content')


<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block">
					<div class="card">
						<div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								<div class="nk-block-head nk-block-head-lg">
									<div class="nk-block-between">
										<div class="nk-block-head-content">
											<h4 class="nk-block-title">Organization Members</h4>
											<div class="nk-block-des">
												<!-- <p>Basic info, like your name and address, that you use on Nio Platform.</p> -->
											</div>
											<li class="preview-item">
												<button type="button" class="btn btn-success icon ni ni-plus" data-bs-toggle="modal" data-bs-target="#modalZoom1"></em>Add Member to -  {{$orgshow->organization_name}}</button>
											</li> 

										</div>
										<div class="nk-block-head-content align-self-start d-lg-none">
											<a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
										</div>
									</div>
								</div><!-- .nk-block-head -->
								<div class="nk-block">
									<div class="nk-data data-list">
										<table class="datatable-init table">
											<thead>
												<tr>
													<th>No</th>
													<th>Name</th>
													<th>Email</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>

												<?php $i = 1; ?>
												@foreach ($orgusers as $key => $object)
												<tr>
													<td>{{$i}}</td>
													<td>{{ $object->name }}</td> 
													<td>{{ $object->email }}</td>  

													<td>
														<ul class="nk-tb-actions gx-1 my-n1">
															<li class="me-n1">
																<div class="dropdown">
																	<a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
																	<div class="dropdown-menu dropdown-menu-end">
																		<ul class="link-list-opt no-bdr">
																			<li><a href="#"><em class="icon ni ni-trash"></em><span>Remove</span></a></li>
																			
																		</ul>
																	</div>
																</div>
															</li>
														</ul>
													</td>
												</tr>
												<?php $i++; ?>
												@endforeach
											</tbody>
										</table>
									</div><!-- data-list -->
									
								</div><!-- .nk-block -->
							</div>


							<div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg" data-toggle-body="true" data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true">
								<div class="card-inner-group" data-simplebar>
									<div class="card-inner">
										<div class="user-card">
											<div class="user-avatar bg-primary">
												<span>AB</span>
											</div>
											<div class="user-info">
												<span class="lead-text">{{$orgshow->organization_name}}</span>
												<span class="sub-text">{{$orgshow->email_address}}</span>
											</div>
											<div class="user-action">
												<div class="dropdown">
													<a class="btn btn-icon btn-trigger me-n2" data-bs-toggle="dropdown" href="#"><em class="icon ni ni-more-v"></em></a>
													<div class="dropdown-menu dropdown-menu-end">
														<ul class="link-list-opt no-bdr">
															<li><a href="#"><em class="icon ni ni-camera-fill"></em><span>Update Logo</span></a></li>
															<li><a href="#"><em class="icon ni ni-edit-fill"></em><span>Update Organization Details</span></a></li>
														</ul>
													</div>
												</div>
											</div>
										</div><!-- .user-card -->
									</div><!-- .card-inner -->
									<div class="card-inner p-0">
										<ul class="link-list-menu">
											<li><a class="active" href="html/user-profile-regular.html"><em class="icon ni ni-user-fill-c"></em><span>Organization Members</span></a></li>
											<li><a href="html/user-profile-notification.html"><em class="icon ni ni-bell-fill"></em><span>Roles</span></a></li>
											<li><a href="html/user-profile-activity.html"><em class="icon ni ni-activity-round-fill"></em><span>Organization Package</span></a></li>
											<!-- <li><a href="html/user-profile-setting.html"><em class="icon ni ni-lock-alt-fill"></em><span>Security Settings</span></a></li> -->
										</ul>
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




<div class="modal fade zoom" tabindex="-1" id="modalZoom1">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Member to -  {{$orgshow->organization_name}}</h5>
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
									<a class="nav-link active" data-bs-toggle="tab" href="#tabItem5"><em class="icon ni ni-user"></em><span>Add Member</span></a>
								</li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane active" id="tabItem5">
									<form method="POST" action="{{ url('addmember')}}">
										@csrf
										<div class="row gy-4">

											<div class="form-group">
												<label class="form-label" for="default-01">First Name</label>
												<div class="form-control-wrap">
													<input type="text" class="form-control" name="name" id="default-01" placeholder="First Name">
												</div>
											</div>

											<div class="form-group">
												<label class="form-label" for="default-01">Last Name</label>
												<div class="form-control-wrap">
													<input type="text" class="form-control" name="last_name" id="default-01" placeholder="Last Name">
												</div>
											</div>

											<div class="form-group">
												<label class="form-label" for="default-01">Email Address</label>
												<div class="form-control-wrap">
													<input type="email" class="form-control" name="email" id="default-01" placeholder="Email Address">
												</div>
											</div>

											<input type="hidden" class="form-control" name="organization_id" value="{{$orgshow->id}}">
											<input type="hidden" class="form-control" name="created_by" value="{{Auth::user()->id}}">
											<input type="hidden" class="form-control" name="roles" value="Normal">

											<button type="submit" class="btn btn-primary">Add Member</button>
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


@endsection
<div class="nk-block nk-block-lg">
	<div class="nk-block-head">
		<div class="nk-block-head-content">
			<h5 class="title nk-block-title"><i>Organization</i>  -   {{$orgshow->organization_name}}</h5>
		</div>
	</div>


	<div class="card card-bordered card-preview">
		<div class="card-inner">
			<ul class="nav nav-tabs mt-n3">
				<li class="nav-item">
					<a class="nav-link active" data-bs-toggle="tab" href="#tabItem1">Organization Users</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-bs-toggle="tab" href="#tabItem2">Roles</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-bs-toggle="tab" href="#tabItem3">Organization Package</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-bs-toggle="tab" href="#tabItem4">Departments</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-bs-toggle="tab" href="#tabItem5">Structure</a>
				</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tabItem1">
					<div class="card-inner">
						<ul class="preview-list">
							<li class="preview-item">
								<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalZoom1">Add Users to {{$orgshow->organization_name}}</button>
							</li>
						</ul>
					</div>

					<!-- Users Table -->
					<div class="card card-bordered card-preview">
						<div class="card-inner">
							<table class="datatable-init table">
								<thead>
									<tr>
										<th>#</th>
										<th>Name</th>
										<th>email</th>
										<th>Roles</th>
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
                                        	@if(!empty($object->getRoleNames()))
								        @foreach($object->getRoleNames() as $v)
								           
								           <span class="badge bg-success">{{ $v }}</span>
								        @endforeach
								      @endif
                                        </td>             
                                        <td>
                                        <li class="col-sm-6 col-lg-3">
                                      
                                        <div class="dropdown">
                                            <a href="#" class="btn btn-primary" data-bs-toggle="dropdown"><span>Select Action</span><em class="icon ni ni-chevron-down"></em></a>
                                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-auto mt-1">
                                                <ul class="link-list-plain">
                                                    <li><a href="#">Update</a></li>
                                                    <li><a href="#">Show</a></li>
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
					<!-- End of Users Table -->
					<!-- Start of add users Modal -->
					<div class="modal fade zoom" tabindex="-1" id="modalZoom1">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Add Users to {{$orgshow->organization_name}}</h5>
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
														<a class="nav-link active" data-bs-toggle="tab" href="#tabItem5"><em class="icon ni ni-user"></em><span>Add User</span></a>
													</li>
												</ul>
												<div class="tab-content">
													<div class="tab-pane active" id="tabItem5">
														<form method="POST" action="#">
															@csrf
															<div class="row gy-4">

																<div class="col-sm-12">
																	<div class="form-group" id="program">
																		<label class="form-label" for="default-06">Programme</label>
																		<div class="form-control-wrap ">
																			<div class="form-control-select">
																				<select class="form-control" id="default-06" name="program_id" >
																					<option value="#">-------Select User-------</option>
																					<option></option>                                                   
																					@foreach($users as $object)
																					<option value="{{$object->id}}">{{$object->name}}</option>
																					@endforeach
																				</select>
																			</div>
																		</div>
																	</div>
																</div>
																<button type="submit" class="btn btn-primary">Disapprove</button>
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
					<!-- end of add users modal -->
				</div>


				<div class="tab-pane" id="tabItem2">
					Roles
				</div>
				<div class="tab-pane" id="tabItem3">
					Organization Package
				</div>
				<div class="tab-pane" id="tabItem4">
					Departments
				</div>
				<div class="tab-pane" id="tabItem5">
					Structure
				</div>


			</div>
		</div>
	</div>

</div>
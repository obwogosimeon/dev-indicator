@extends('layouts.apps')
@section('content')



<div class="nk-block nk-block-lg">
	<div class="nk-block-head">
		<div class="nk-block-head-content">
			<h5 class="title nk-block-title">{{$projectshow->project_name}}</h5>
			<p>{{$projectshow->start_date}} - {{$projectshow->end_date}}</p>
			<p>Reports</p>
		</div>
	</div>

	<div class="card card-bordered card-preview">
		<div class="card-inner">
			<ul class="nav nav-tabs mt-n3">
				<!-- <li class="nav-item">
					<a class="nav-link active" data-bs-toggle="tab" href="#tabItem1">Overview</a>
				</li> -->
				<li class="nav-item">
					<a class="nav-link" data-bs-toggle="tab" href="#tabItem2">Shared Snapshot</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-bs-toggle="tab" href="#tabItem3">Defined</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-bs-toggle="tab" href="#tabItem4">Templates</a>
				</li>
				<!-- <li class="nav-item">
					<a class="nav-link" data-bs-toggle="tab" href="#tabItem4">Sunmissions</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-bs-toggle="tab" href="#tabItem4">Received</a>
				</li> -->
			</ul>
			<div class="tab-content">
				<!-- <div class="tab-pane active" id="tabItem1">
					<p>Cillum ad ut irure tempor velit nostrud occaecat ullamco aliqua anim Lorem sint. Veniam sint duis incididunt do esse magna mollit excepteur laborum qui. Id id reprehenderit sit est eu aliqua occaecat quis et velit excepteur laborum mollit dolore eiusmod. Ipsum dolor in occaecat commodo et voluptate minim reprehenderit mollit pariatur. Deserunt non laborum enim et cillum eu deserunt excepteur ea incid.</p>
				</div> -->
				<div class="tab-pane" id="tabItem2">
					<p>Culpa dolor voluptate do laboris laboris irure reprehenderit id incididunt duis pariatur mollit aute magna pariatur consectetur. Eu veniam duis non ut dolor deserunt commodo et minim in quis laboris ipsum velit id veniam. Quis ut consectetur adipisicing officia excepteur non sit. Ut et elit aliquip labore Lorem enim eu. Ullamco mollit occaecat dolore ipsum id officia mollit qui esse anim eiusmod do sint minim consectetur qui.</p>
				</div>
				<div class="tab-pane" id="tabItem3">
					<div class="card-inner">
							<ul class="preview-list">
								<li class="preview-item">
									<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalZoom4">Add Defintion</button>
								</li>
							</ul>
						</div>
						<div class="card card-bordered card-preview">
						<div class="card-inner">
							<table class="datatable-init table">
								<thead>
									<tr>
										<th>#</th>
										<th>Template Name</th>
										<th>Definition Title</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								

								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="tab-pane" id="tabItem4">
						<div class="card-inner">
							<ul class="preview-list">
								<li class="preview-item">
									<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalZoom3">Add Template</button>
								</li>
							</ul>
						</div>
					<div class="card card-bordered card-preview">
						<div class="card-inner">
							<table class="datatable-init table">
								<thead>
									<tr>
										<th>#</th>
										<th>Template Name</th>
										<th>Report Type</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								<?php $i = 1; ?>
                                @foreach ($templates as $key => $object)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{ $object->template_name }}</td>
                                    <td>{{ $object->report_type }}</td>
                                    <!-- <td></td>
                                    <td></td> -->
                                    <td>
                                    <li class="col-sm-6 col-lg-3">
                                  
                                    <div class="dropdown">
                                        <a href="#" class="btn btn-primary" data-bs-toggle="dropdown"><span>Select Action</span><em class="icon ni ni-chevron-down"></em></a>
                                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-auto mt-1">
                                            <ul class="link-list-plain">
                                                <li><a href="#">Edit</a></li>
                                                <li><a href="#">Settings</a></li>
                                                <li><a href="#">Delete</a></li>
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
				</div>
				<!-- <div class="tab-pane" id="tabItem5">
					<p>Eu dolore ea ullamco dolore Lorem id cupidatat excepteur reprehenderit consectetur elit id dolor proident in cupidatat officia. Voluptate excepteur commodo labore nisi cillum duis aliqua do. Aliqua amet qui mollit consectetur nulla mollit velit aliqua veniam nisi id do Lorem deserunt amet. Culpa ullamco sit adipisicing labore officia magna elit nisi in aute tempor commodo eiusmod.</p>
				</div>
				<div class="tab-pane" id="tabItem6">
					<p>Eu dolore ea ullamco dolore Lorem id cupidatat excepteur reprehenderit consectetur elit id dolor proident in cupidatat officia. Voluptate excepteur commodo labore nisi cillum duis aliqua do. Aliqua amet qui mollit consectetur nulla mollit velit aliqua veniam nisi id do Lorem deserunt amet. Culpa ullamco sit adipisicing labore officia magna elit nisi in aute tempor commodo eiusmod.</p>
				</div> -->
			</div>
		</div>
	</div><!-- .card-preview -->



	<div class="modal fade zoom" tabindex="-1" id="modalZoom3">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Create Template</h5>
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
										<a class="nav-link active" data-bs-toggle="tab" href="#tabItem5"><em class="icon ni ni-user"></em><span>Template Entry Form</span></a>
									</li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="tabItem5">
										<form method="POST" action="{{ route('createmplate')}}">
											@csrf
											<div class="row gy-4">

												<div class="form-group">
													<label class="form-label" for="default-01">Template Name</label>
													<div class="form-control-wrap">
														<input type="text" name="template_name" class="form-control" id="default-01" placeholder="Input Template Name">
													</div>
												</div>

												<input type="hidden" name="created_by" class="form-control" value="{{Auth::user()->id}}" placeholder="Input Template Name">

												<input type="hidden" name="status" class="form-control" value="01" placeholder="Input Template Name">

												<input type="hidden" name="project_id" class="form-control" value="{{$projectshow->id}}" placeholder="Input Template Name">

												<div class="card card-bordered card-preview">
													<div class="card-inner">
														<div class="row gy-4">
															<div class="col-md-3 col-sm-6">
																<div class="preview-block">
																	<!-- <span class="preview-title overline-title">Checked</span> -->
																	<div class="custom-control custom-radio">
																		<input type="radio" id="customRadio2" name="report_type" checked class="custom-control-input" value="Generic Report">
																		<label class="custom-control-label" for="customRadio2">Generic Report</label>
																	</div>
																</div>
															</div>

															<div class="col-md-3 col-sm-6">
																<div class="preview-block">
																	<!-- <span class="preview-title overline-title">Default</span> -->
																	<div class="custom-control custom-radio">
																		<input type="radio" id="customRadio1" name="report_type" class="custom-control-input" value="Specific Report">
																		<label class="custom-control-label" for="customRadio1">Specific Report</label>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>

												<div class="card card-bordered card-preview">
													<div class="card-inner">
														<div class="row gy-4">
															<div class="col-md-3 col-sm-6">
																<div class="preview-block">
																	<!-- <span class="preview-title overline-title">Default</span> -->
																	<div class="custom-control custom-checkbox">
																		<input type="checkbox" name="report_draft_entry" class="custom-control-input" id="customCheck1" value="Report Draft Entries">
																		<label class="custom-control-label" for="customCheck1">Report Draft Entries</label>
																	</div>
																</div>
															</div>


															<div class="col-md-3 col-sm-6">
																<div class="preview-block">
																	<!-- <span class="preview-title overline-title">Default</span> -->
																	<div class="custom-control custom-checkbox">
																		<input type="checkbox" name="closed_reported_entry" class="custom-control-input" id="customCheck2" value="Closed Reported Entries">
																		<label class="custom-control-label" for="customCheck2">Closed/Reported Entries</label>
																	</div>
																</div>
															</div>


															<div class="col-md-3 col-sm-6">
																<div class="preview-block">
																	<!-- <span class="preview-title overline-title">Default</span> -->
																	<div class="custom-control custom-checkbox">
																		<input type="checkbox" name="draft_entry" class="custom-control-input" id="customCheck3" value="Draft Entries">
																		<label class="custom-control-label" for="customCheck3">Draft Entries</label>
																	</div>
																</div>
															</div>


															<div class="col-md-3 col-sm-6">
																<div class="preview-block">
																	<!-- <span class="preview-title overline-title">Default</span> -->
																	<div class="custom-control custom-checkbox">
																		<input type="checkbox" name="approved_entry" class="custom-control-input" id="customCheck4" value="Approved Entries">
																		<label class="custom-control-label" for="customCheck4">Approved Entries</label>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>


												<button type="submit" class="btn btn-primary">Create Template</button>
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





<div class="modal fade zoom" tabindex="-1" id="modalZoom4">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Create Definition</h5>
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
										<a class="nav-link active" data-bs-toggle="tab" href="#tabItem5"><em class="icon ni ni-user"></em><span>Report Definition</span></a>
									</li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="tabItem5">
										<form method="POST" action="{{ route('createdefinition')}}">
											@csrf
											<div class="row gy-4">

												<div class="form-group">
													<label class="form-label" for="default-01">Definition Title</label>
													<div class="form-control-wrap">
														<input type="text" name="definition_title" class="form-control" id="default-01" placeholder="Input Definition Title">
													</div>
												</div>

												<input type="hidden" name="created_by" class="form-control" value="{{Auth::user()->id}}" placeholder="Input Template Name">

												<input type="hidden" name="status" class="form-control" value="01" placeholder="Input Template Name">

												<input type="hidden" name="project_id" class="form-control" value="{{$projectshow->id}}" placeholder="Input Template Name">


												<div class="form-group">
                                                <label class="form-label" for="default-06">Select Template</label>
                                                <div class="form-control-wrap ">
                                                    <div class="form-control-select">
                                                        <select class="form-control" id="default-06" name="logframe_id">
                                                            <option value="#">-------Select Template-------</option>
                                                            <option></option>
                                                            @foreach($templates as $object)
                                                            <option value="{{$object->id}}">{{$object->template_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>



												<button type="submit" class="btn btn-primary">Create Defintion</button>
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


</div>


@endsection
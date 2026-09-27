@extends('layouts.apps')
@section('content')

<div class="nk-block nk-block-lg">
	<div class="nk-block-head">
		<div class="nk-block-head-content">
			<nav>
				<ul class="breadcrumb breadcrumb-pipe">
					<li class="breadcrumb-item"><a href="{{ url('/home')}}">Home</a></li>
					<!-- <li class="breadcrumb-item"><a href="{{ route('documents.index')}}">Documents</a></li> -->
					<li class="breadcrumb-item active">Documents</li>
				</ul>
			</nav>
			<br>

			@if ($message = Session::get('success'))
			<div class="alert alert-success">
				<p>{{ $message }}</p>
			</div>
			@endif

			<a href="{{ route('documents.create')}}" style="margin-left: 88%" class="btn btn-round btn-primary"><em class="icon ni ni-plus"></em><span>New Document</span></a>

			<br>
			<br>

			<div class="card card-bordered card-preview">
				<div class="card-inner">
					<table class="datatable-init table">
						<thead>
							<tr>
								<th>SN</th>
								<th>File Name</th>
								<th>Organization</th>
								<th>Status</th>
								<th>Program/Project</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 1; ?>
							@foreach ($documents as $key => $object)
							<tr>
								<td>{{$i}}</td>
								<td>{{ $object->doc_name }}</td>                                     
								<td>{{ $object->organization->organization_name}}</td>
								<td>
									@if($object->status == '01')
									<span class="badge bg-gray">Draft</span></h6>
									@elseif($object->status == '02')
									<span class="badge bg-success">Approved</span></h6>
									@endif
								</td>
								@if($object->project_id == '#')
								<td>{{ $object->program->program_name }} - <i>(PROGRAM)</i></td>
								@elseif($object->program_id == '#')
								<td>{{ $object->project->project_name }}  - <i>(PROJECT)</i></td>
								@endif
								<td>
									<ul class="nk-tb-actions gx-1 my-n1">
										<li class="me-n1">
											<div class="dropdown">
												<a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
												<div class="dropdown-menu dropdown-menu-end">
													<ul class="link-list-opt no-bdr">
														<li><a href="{{ url('download/'.$object->id)}}"><em class="icon ni ni-download"></em><span>Download Document</span></a></li>
														<li><a href="{{ url('documentview/'.$object->id)}}"><em class="icon ni ni-eye"></em><span>View Document</span></a></li>
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
				</div>
			</div>

		</div>
	</div>
</div>



@endsection
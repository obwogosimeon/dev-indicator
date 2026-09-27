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
							
							<li class="breadcrumb-item active">Update Budget</li>
						</ul>
					</nav>
					<br>
					<div class="nk-block nk-block-lg">


						<div class="card card-bordered card-preview">
							<div class="card-inner">
								<div class="preview-block">
									<span class="preview-title-lg overline-title">Edit Budget</span>


									<form method="POST" action="{{ url('budgetexpense', $budget->id)}}">
										@csrf

										<input type="text" value="{{$budget->id}}" name="">
										<input type="text" value="{{$imp->id}}" name="">
										
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
@extends('layouts.apps')
@section('content')
<main class="container-fluid admin-page report-page">
	<header class="admin-page__header">
		<div>
			<p class="admin-page__eyebrow">Project reporting</p>
			<h1 class="admin-page__title">{{ $projectshow->project_name }}</h1>
			<p class="admin-page__description">
				@if ($projectshow->start_date || $projectshow->end_date)
					{{ $projectshow->start_date ?: '—' }} <span class="report-page__date-separator">to</span> {{ $projectshow->end_date ?: '—' }}
				@else
					Reporting workspace
				@endif
				@if ($projectshow->program)
					<span class="report-page__header-divider">·</span>{{ $projectshow->program->program_name }}
				@endif
			</p>
		</div>
		<a href="{{ route('reportsindex') }}" class="admin-page__button-secondary">
			<em class="icon ni ni-arrow-left" aria-hidden="true"></em>
			All reports
		</a>
	</header>

	@if (session('success'))
		<div class="alert alert-success" role="status">{{ session('success') }}</div>
	@endif
	@if ($errors->any())
		<div class="alert alert-danger" role="alert">
			@foreach ($errors->all() as $error)
				<div>{{ $error }}</div>
			@endforeach
		</div>
	@endif

	<section class="report-page__project-summary" aria-label="Project report summary">
		<div><strong>{{ $templates->count() }}</strong><span>Report templates</span></div>
		<div><strong>{{ $definitions->count() }}</strong><span>Report definitions</span></div>
		<div><strong>{{ $projectshow->status ?: '—' }}</strong><span>Project status</span></div>
	</section>

	<section class="admin-page__card report-page__workspace">
		<div class="admin-page__card-head">
			<div>
				<h2>Reporting workspace</h2>
				<p>Manage this project’s templates and report definitions.</p>
			</div>
		</div>
		<div class="admin-page__form">
			<ul class="nav nav-tabs report-page__tabs">
				<li class="nav-item">
					<a class="nav-link active" data-bs-toggle="tab" href="#project-overview">Overview</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-bs-toggle="tab" href="#project-definitions">Definitions <span class="report-page__tab-count">{{ $definitions->count() }}</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-bs-toggle="tab" href="#project-templates">Templates <span class="report-page__tab-count">{{ $templates->count() }}</span></a>
				</li>
			</ul>
			<div class="tab-content report-page__tab-content">
				<div class="tab-pane active" id="project-overview">
					<div class="report-page__overview-copy">
						<span class="report-page__metric-icon report-page__metric-icon--teal" aria-hidden="true"><em class="icon ni ni-reports"></em></span>
						<div>
							<h3>Build a consistent reporting approach</h3>
							<p>Create templates for routine reporting, then define the information each report should capture.</p>
						</div>
					</div>
					<div class="report-page__quick-actions">
						<button type="button" class="admin-page__button" data-bs-toggle="modal" data-bs-target="#modalZoom3">Create report template</button>
						<button type="button" class="admin-page__button-secondary" data-bs-toggle="modal" data-bs-target="#modalZoom4"{{ $templates->isEmpty() ? ' disabled' : '' }}>Add report definition</button>
					</div>
				</div>
				<div class="tab-pane" id="project-definitions">
					<div class="report-page__tab-toolbar">
						<div><h3>Report definitions</h3><p>Fields associated with this project’s report templates.</p></div>
						<button type="button" class="admin-page__button" data-bs-toggle="modal" data-bs-target="#modalZoom4"{{ $templates->isEmpty() ? ' disabled' : '' }}>Add definition</button>
					</div>
					<div class="table-responsive">
						<table class="table admin-page__table report-page__table">
							<thead><tr><th>Definition</th><th>Template</th><th>Standard</th></tr></thead>
							<tbody>
								@foreach ($definitions as $definition)
									@php($definitionTemplate = $templates->firstWhere('id', $definition->template_id))
									<tr>
										<td><strong>{{ $definition->definition_title }}</strong></td>
										<td>{{ $definitionTemplate ? $definitionTemplate->template_name : '—' }}</td>
										<td>{{ $definition->standard ?: '—' }}</td>
									</tr>
								@endforeach
								@if ($definitions->isEmpty())
									<tr><td colspan="3" class="admin-page__empty">No definitions have been added to this project yet.</td></tr>
								@endif
							</tbody>
						</table>
					</div>
				</div>
				<div class="tab-pane" id="project-templates">
					<div class="report-page__tab-toolbar">
						<div><h3>Report templates</h3><p>Reusable report structures for this project.</p></div>
						<button type="button" class="admin-page__button" data-bs-toggle="modal" data-bs-target="#modalZoom3">Create template</button>
					</div>
					<div class="table-responsive">
						<table class="table admin-page__table report-page__table">
							<thead><tr><th>Template</th><th>Type</th><th>Draft entries</th><th>Approved entries</th></tr></thead>
							<tbody>
								@foreach ($templates as $template)
									<tr>
										<td><strong>{{ $template->template_name }}</strong></td>
										<td><span class="admin-page__badge">{{ $template->report_type ?: 'Generic Report' }}</span></td>
										<td>{{ $template->draft_entry ?: $template->report_draft_entry ?: '—' }}</td>
										<td>{{ $template->approved_entry ?: '—' }}</td>
									</tr>
								@endforeach
								@if ($templates->isEmpty())
									<tr><td colspan="4" class="admin-page__empty">No templates have been created for this project yet.</td></tr>
								@endif
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>

	<div class="modal fade" tabindex="-1" id="modalZoom3" aria-labelledby="create-template-title" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
			<div class="modal-content report-page__modal">
				<div class="modal-header">
					<div><p class="admin-page__eyebrow">Project reporting</p><h2 class="modal-title" id="create-template-title">Create report template</h2></div>
					<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><em class="icon ni ni-cross"></em></button>
				</div>
				<form method="POST" action="{{ route('createmplate') }}">
					@csrf
					<input type="hidden" name="created_by" value="{{ Auth::id() }}">
					<input type="hidden" name="status" value="01">
					<input type="hidden" name="project_id" value="{{ $projectshow->id }}">
					<div class="modal-body report-page__modal-body">
						<div class="admin-page__field">
							<label for="template-name">Template name</label>
							<input type="text" name="template_name" id="template-name" class="form-control" placeholder="e.g. Quarterly progress report" required>
						</div>
						<div class="report-page__choice-group">
							<span class="admin-page__field-label">Report type</span>
							<label class="report-page__choice"><input type="radio" name="report_type" value="Generic Report" checked><span>Generic report<small>Reusable across routine reporting.</small></span></label>
							<label class="report-page__choice"><input type="radio" name="report_type" value="Specific Report"><span>Specific report<small>Tailored to this project’s reporting needs.</small></span></label>
						</div>
						<div class="report-page__choice-group">
							<span class="admin-page__field-label">Include entries</span>
							<div class="report-page__checkboxes">
								<label class="report-page__choice"><input type="checkbox" name="report_draft_entry" value="Report Draft Entries"><span>Report draft entries</span></label>
								<label class="report-page__choice"><input type="checkbox" name="closed_reported_entry" value="Closed Reported Entries"><span>Closed / reported entries</span></label>
								<label class="report-page__choice"><input type="checkbox" name="draft_entry" value="Draft Entries"><span>Draft entries</span></label>
								<label class="report-page__choice"><input type="checkbox" name="approved_entry" value="Approved Entries"><span>Approved entries</span></label>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="admin-page__button-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="admin-page__button">Create template</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="modal fade" tabindex="-1" id="modalZoom4" aria-labelledby="create-definition-title" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
			<div class="modal-content report-page__modal">
				<div class="modal-header">
					<div><p class="admin-page__eyebrow">Project reporting</p><h2 class="modal-title" id="create-definition-title">Add report definition</h2></div>
					<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><em class="icon ni ni-cross"></em></button>
				</div>
				<form method="POST" action="{{ route('createdefinition') }}">
					@csrf
					<input type="hidden" name="created_by" value="{{ Auth::id() }}">
					<input type="hidden" name="status" value="01">
					<div class="modal-body report-page__modal-body">
						<div class="admin-page__field">
							<label for="definition-title">Definition title</label>
							<input type="text" name="definition_title" id="definition-title" class="form-control" placeholder="e.g. Beneficiaries reached" required>
						</div>
						<div class="admin-page__field">
							<label for="definition-template">Report template</label>
							<select class="form-control" id="definition-template" name="template_id" required>
								<option value="">Select a template</option>
								@foreach ($templates as $template)
									<option value="{{ $template->id }}">{{ $template->template_name }}</option>
								@endforeach
							</select>
						</div>
						<div class="admin-page__field">
							<label for="definition-standard">Standard / guidance <span class="report-page__optional">(optional)</span></label>
							<textarea name="standard" id="definition-standard" class="form-control" rows="3" placeholder="Describe the standard or guidance for this data point"></textarea>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="admin-page__button-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="admin-page__button"{{ $templates->isEmpty() ? ' disabled' : '' }}>Save definition</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</main>

@endsection
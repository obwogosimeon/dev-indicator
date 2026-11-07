<div class="tab-pane" id="tabItem11" role="tabpanel" aria-labelledby="program-documents-tab">
    <div class="program-detail__panel">
        <div class="program-detail__panel-header">
            <div>
                <p class="admin-page__eyebrow">Programme library</p>
                <h2>Documents</h2>
                <p>Store and access supporting programme files.</p>
            </div>
            <button type="button" class="admin-page__button" data-bs-toggle="modal" data-bs-target="#addprogdoc">
                <em class="icon ni ni-plus" aria-hidden="true"></em>
                Add document
            </button>
        </div>

        @if ($documents->isEmpty())
            <div class="program-detail__empty-state">
                <span class="program-detail__record-icon program-detail__record-icon--violet"><em class="icon ni ni-file" aria-hidden="true"></em></span>
                <h3>No documents yet</h3>
                <p>Upload programme files to keep supporting materials together in one place.</p>
                <button type="button" class="admin-page__button" data-bs-toggle="modal" data-bs-target="#addprogdoc">
                    <em class="icon ni ni-plus" aria-hidden="true"></em>
                    Add document
                </button>
            </div>
        @else
            <div class="program-detail__record-list" aria-label="Programme documents">
                @foreach ($documents as $object)
                    <article class="program-detail__record">
                        <span class="program-detail__record-icon program-detail__record-icon--violet"><em class="icon ni ni-file" aria-hidden="true"></em></span>
                        <div class="program-detail__record-main">
                            <h3>{{ $object->doc_name }}</h3>
                            <div class="program-detail__record-meta">
                                @if ($object->status === '01')
                                    <span class="admin-page__badge admin-page__badge--amber">Draft</span>
                                @elseif ($object->status === '02')
                                    <span class="admin-page__badge admin-page__badge--green">Approved</span>
                                @else
                                    <span class="admin-page__badge admin-page__badge--neutral">Status {{ $object->status }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="program-detail__record-actions">
                            <a href="{{ url('download/'.$object->id) }}" class="admin-page__action" aria-label="Download {{ $object->doc_name }}">
                                <em class="icon ni ni-download" aria-hidden="true"></em>
                                Download
                            </a>
                            <a href="{{ url('documentview/'.$object->id) }}" class="admin-page__action" aria-label="View {{ $object->doc_name }}">
                                <em class="icon ni ni-eye" aria-hidden="true"></em>
                                View
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </div>

    <div class="modal fade zoom" tabindex="-1" id="addprogdoc" aria-labelledby="add-program-document-title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-program-document-title">Add programme document</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross" aria-hidden="true"></em>
                    </button>
                </div>
                <form method="POST" action="{{ route('documents.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label" for="program-document-name">Document name <span class="text-danger">*</span></label>
                            <input type="text" name="doc_name" class="form-control" id="program-document-name" placeholder="Enter a descriptive document name" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="program-document-file">File <span class="text-danger">*</span></label>
                            <input type="file" name="file" class="form-control" id="program-document-file" required>
                        </div>
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                        <input type="hidden" name="status" value="01">
                        <input type="hidden" name="program_id" value="{{ $programshow->id }}">
                        <input type="hidden" name="organization_id" value="{{ Auth::user()->organization_id }}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="admin-page__button-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="admin-page__button">
                            <em class="icon ni ni-upload" aria-hidden="true"></em>
                            Upload document
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

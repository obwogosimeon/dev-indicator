<div class="tab-pane" id="tabItem8">
    <li class="preview-item">
        <button type="button" class="btn btn-info icon ni ni-calender-fill" data-bs-toggle="modal" data-bs-target="#modal234567">Add Funding</button>
    </li> 
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class="datatable-init table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Financier</th>
                        <th>Used for</th>.
                        <th>For Expenditure?</th>
                        <th>Variable Name</th>
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
                            <ul class="nk-tb-actions gx-1 my-n1">
                                <li class="me-n1">
                                    <div class="dropdown">
                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul class="link-list-opt no-bdr">
                                                <li><a href="{{ route('funding.edit', $object->id) }}"><em class="icon ni ni-edit"></em><span>Edit Funding</span></a></li>
                                                <li><a href="#"><em class="icon ni ni-trash"></em><span>Remove Funding</span></a></li>
                                                <li><a href="{{ route('funding.show', $object->id) }}"><em class="icon ni ni-eye"></em><span>View Funding</span></a></li>
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
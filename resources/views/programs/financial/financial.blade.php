<div class="tab-pane" id="tabItem9">
    <li class="preview-item">
        <button type="button" class="btn btn-info icon ni ni-calender-fill" data-bs-toggle="modal" data-bs-target="#modal23456">Add Fiscal Year</button>
    </li> 
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class="datatable-init table">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Fiscal Year</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    @foreach ($years as $key => $object)
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{ $object->year_name }}</td>
                        <td>{{ $object->start_date }}</td>
                        <td>{{ $object->end_date }}</td>
                        <td>

                            <ul class="nk-tb-actions gx-1 my-n1">
                                <li class="me-n1">
                                    <div class="dropdown">
                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul class="link-list-opt no-bdr">
                                                <li><a href="{{ route('years.edit', $object->id) }}"><em class="icon ni ni-edit"></em><span>Edit Fiscal Year</span></a></li>
                                                <li><a href="#"><em class="icon ni ni-trash"></em><span>Remove User</span></a></li>
                                                <li><a href="{{ route('years.show', $object->id) }}"><em class="icon ni ni-eye"></em><span>View Fiscal Year</span></a></li>

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
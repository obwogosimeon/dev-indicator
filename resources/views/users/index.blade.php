@extends('layouts.apps')
@section('content')

<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <nav>
                <ul class="breadcrumb breadcrumb-pipe">
                    <li class="breadcrumb-item"><a href="{{ url('/home')}}">Home</a></li>
                    <!-- <li class="breadcrumb-item"><a href="{{ route('logframes.index')}}">Logframes</a></li> -->
                    <li class="breadcrumb-item active">Members</li>
                </ul>
            </nav>
            <br>

            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif

            <!-- <a href="" style="align: left;" class="btn btn-round btn-lg btn-primary">New User</a> -->

            <a href="{{ route('users.create')}}" style="margin-left: 90%" class="btn btn-round btn-primary"><em class="icon ni ni-plus"></em><span>New Member</span></a>

            <br>
            <br>

            <div class="card card-bordered card-preview">
                <div class="card-inner">
                    <table class="datatable-init table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th>Action</th>
                            </tr>
                        </thead><tbody>
                            @foreach ($data as $key => $user)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>@if(!empty($user->getRoleNames()))
                                    @foreach($user->getRoleNames() as $v)
                                    <span class="badge bg-success">{{ $v }}</span></h6>
                                    @endforeach
                                    @endif
                                </td>
                                <td>

                                   <ul class="nk-tb-actions gx-1 my-n1">
                                    <li class="me-n1">
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul class="link-list-opt no-bdr">
                                                    <li><a href="{{ route('users.edit', $user->id) }}"><em class="icon ni ni-edit"></em><span>Edit Member</span></a></li>
                                                    <li><a href="#"><em class="icon ni ni-trash"></em><span>Remove Member</span></a></li>
                                                    <li><a href="{{ route('users.show', $user->id) }}"><em class="icon ni ni-eye"></em><span>View Member</span></a></li>

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
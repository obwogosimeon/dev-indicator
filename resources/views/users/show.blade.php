@extends('layouts.apps')
@section('content')

<nav>
    <ul class="breadcrumb breadcrumb-pipe">
        <li class="breadcrumb-item"><a href="{{ url('/home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('users.index')}}">Users</a></li>
        <li class="breadcrumb-item active">Show User</li>
    </ul>
</nav>
<hr>

<div class="nk-block-head nk-block-head-lg wide-sm">
    <div class="nk-block-head-content">
        <h6 class="title"><B>Name</B> <span class="badge bg-success">{{ $user->name }}</span></h6>
        <div class="nk-block-des">
        </div>
    </div>
</div>


<div class="nk-block-head nk-block-head-lg wide-sm">
    <div class="nk-block-head-content">
        <h6 class="title"><B>Roles</B> 

            @if(!empty($user->getRoleNames()))
                @foreach($user->getRoleNames() as $v)
                    <span class="badge bg-success">{{ $v }}</span></h6>
                @endforeach
            @endif



            
        <div class="nk-block-des">
        </div>
    </div>
</div>

@endsection
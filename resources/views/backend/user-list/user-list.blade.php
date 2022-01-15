@extends('backend.master')

@section('title')
User List
@endsection

@section('breadcrumb')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Dashboard</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                    <li class="breadcrumb-item active">User List</li>
                </ol>
            </div>

        </div>
    </div>
</div>
@endsection

@section('body')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">User Datatable</h4>
                <table id="datatable" class="table table-bordered dt-responsive wrap w-100">
                    <thead>
                        <tr>
                            <th>Sl No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Permissions</th>
                            <th>Total Posts</th>
                            <th>Total Reply</th>
                            <th>Total Like</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                @foreach($user->roles as $userRole)
                                @if($loop->last)
                                {{ $userRole->name }}
                                @else
                                {{ $userRole->name  }} |
                                @endif
                                @endforeach
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                @if($user->status === 1)
                                    <a href="{{route('user.status', $user)}}" class="btn btn-success btn-sm">
                                        <i class="fas fa-arrow-alt-circle-up"></i>
                                    </a>
                                @else
                                    <a href="{{route('user.status', $user)}}" class="btn btn-danger btn-sm">
                                        <i class="fas fa-arrow-alt-circle-down"></i>
                                    </a>
                                @endif
                                <a href="{{route('edit-user', $user)}}" class="btn btn-info btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

@endsection

@section('page-model')

@endsection

@section('page-required-js')

@endsection

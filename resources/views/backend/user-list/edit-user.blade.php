@extends('backend.master')

@section('title')

@endsection

@section('breadcrumb')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Dashboard</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                    <li class="breadcrumb-item active">Edit Users</li>
                </ol>
            </div>

        </div>
    </div>
</div>
@endsection

@section('body')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Set User Role</h4>

                <form {{route('update-user', $user)}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="formrow-email-input" value="{{$user->name}}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-password-input" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="formrow-password-input" value="{{$user->email}}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-lg-12">
                            @foreach($roles as $key => $role)
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" name="roles[]" type="checkbox" id="gridCheck-{{$key}}" value="{{$role->id}}" @foreach($user->roles as $userRole)
                                    {{$userRole->id == $role->id? "checked" : ""}}
                                    @endforeach
                                    >
                                    <label class="form-check-label" for="gridCheck-{{$key}}">
                                        {{$role->name}}
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>

                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                    </div>
                </form>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>
<!-- end row -->
@endsection



@section('page-model')

@endsection

@section('page-required-js')

@endsection

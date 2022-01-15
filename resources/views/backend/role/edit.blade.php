@extends('backend.master')

@section('title')
Role
@endsection
@section('page-required-css')
<!-- DataTables -->
<link href="{{asset('/')}}backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="{{asset('/')}}backend/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<!-- Responsive datatable examples -->
<link href="{{asset('/')}}backend/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('breadcrumb')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Role Edit</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Role</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>

        </div>
    </div>
</div>
@endsection

@section('body')
@include('backend.includes.massage')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Add New Role</h4>
                <form action="{{route('role.update', ['id' => $role->id])}}" method="post" class="">
                    @csrf
                    {{-- {{ method_field('PUT') }}--}}
                    <div class="form-group row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Role Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="name" value="{{$role->name}}" id="horizontal-firstname-input" required maxlength="50">
                            <span class="text-danger">{{$errors->has('name') ? $errors->first('name') : ""}}</span>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Role Description</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="description" id="horizontal-email-input">{{$role->description}}</textarea>
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <label class="col-sm-3 col-form-label">Route Name</label>

                        <div class="col-sm-9 d-flex flex-wrap">
                            @foreach($routeLists as $key => $routelist)
                            <div class="form-check mb-4 me-2">
                                <input class="form-check-input" type="checkbox" name="route_name[]" id="horizontalLayout-Check{{$key}}" value="{{$routelist->getName()}}" @foreach($role->roleRoutes as $route)
                                {{$route->route_name == $routelist->getName() ? "checked"  : ""}}
                                @endforeach
                                >
                                <label class="form-check-label" for="horizontalLayout-Check{{$key}}">
                                    {{$routelist->getName()}}
                                </label>
                            </div>
                            @endforeach
                        </div>

                    </div>
                    <div class="form-group row mb-4">
                        <label for="horizontal-password-input" class="col-sm-3 col-form-label">Publication Status</label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" {{$role->status === 1 ? "checked" : ""}} type="radio" name="status" id="inlineRadio1" value="1">
                                <label class="form-check-label" for="inlineRadio1">Published</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" {{$role->status === 0 ? "checked" : ""}} type="radio" name="status" id="inlineRadio2" value="0">
                                <label class="form-check-label" for="inlineRadio2">Unpublished</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row justify-content-end">
                        <div class="col-sm-9">
                            <div>
                                <button type="submit" class="btn btn-primary w-md">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('page-model')

@endsection

@section('page-required-js')
<!-- Required datatable js -->
<script src="{{asset('/')}}backend/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{asset('/')}}backend/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

<!-- Buttons examples -->
<script src="{{asset('/')}}backend/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{asset('/')}}backend/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="{{asset('/')}}backend/assets/libs/jszip/jszip.min.js"></script>
<script src="{{asset('/')}}backend/assets/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="{{asset('/')}}backend/assets/libs/pdfmake/build/vfs_fonts.js"></script>
<script src="{{asset('/')}}backend/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="{{asset('/')}}backend/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="{{asset('/')}}backend/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

<!-- Responsive examples -->
<script src="{{asset('/')}}backend/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{asset('/')}}backend/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<!-- Datatable init js -->
<script src="{{asset('/')}}backend/assets/js/pages/datatables.init.js"></script>
@endsection

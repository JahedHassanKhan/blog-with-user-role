@extends('backend.master')

@section('title')
    Dashboard
@endsection

@section('breadcrumb')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Dashboard</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('body')
    @if($message = Session::get('message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{$message}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="row">
        <div class="col-xl-4">
            @include('backend.dashboard.user-dashboard.user-dashboard')
        </div>
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Change Password</h4>

                    <form action="{{route('change-password')}}" method="POST" enctype="multipart/form-data" class="mb-3">
                        @csrf
                        <div class="row mb-4">
                            <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Current Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="horizontal-firstname-input" name="current_password" autocomplete="current-password">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">New Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="horizontal-email-input" name="password" autocomplete="new-password">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Confirm New Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="horizontal-email-input" name="password_confirmation" autocomplete="new-password">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 d-grid">
                                <button type="submit"  class="btn d-block btn-primary">Update Password</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- end card body -->
            </div>
        </div>
    </div>
@endsection

@section('page-required-js')
    <!-- dashboard init -->
    <script src="{{asset('/')}}backend/assets/js/pages/dashboard.init.js"></script>

@endsection

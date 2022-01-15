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
                    <h4 class="card-title mb-4">Personal Information</h4>

                    <form action="{{route('personal-information.store')}}" method="POST" enctype="multipart/form-data" class="mb-3">
                        @csrf
                        {{--                        {{ method_field('PUT') }}--}}
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="name" class="form-label">Name</label>
                                <input type="file" name="image" class="dropify">
                                <span
                                    class="text-danger">{{$errors->has('image') ? $errors->first('image') : ""}}</span>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Name</label>
                                <input id="name" name="name" value="{{\Illuminate\Support\Facades\Auth::user()->name}}"
                                       disabled type="text" class="form-control" placeholder="Enter Name">
                                <span class="text-danger">{{$errors->has('name') ? $errors->first('name') : ""}}</span>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input id="email" name="email" value="{{Auth::user()->email}}" disabled type="email"
                                       class="form-control" placeholder="Enter Name">
                                <span class="text-danger">{{$errors->has('name') ? $errors->first('name') : ""}}</span>
                            </div>
                            <div class="mb-3 col-md-12">
                                <label class="form-label">About me</label>
                                <textarea id="" name="about_me" type="text" class="form-control"></textarea>
                                <span
                                    class="text-danger">{{$errors->has('about_me') ? $errors->first('about_me') : ""}}</span>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="father_name" class="form-label">Father Name</label>
                                <input id="father_name" name="father_name" type="text" class="form-control"
                                       placeholder="Enter Father Name">
                                <span
                                    class="text-danger">{{$errors->has('father_name') ? $errors->first('father_name') : ""}}</span>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="mother_name" class="form-label">Mother Name</label>
                                <input id="mother_name" name="mother_name" type="text" class="form-control"
                                       placeholder="Enter Mother Name">
                                <span
                                    class="text-danger">{{$errors->has('mother_name') ? $errors->first('mother_name') : ""}}</span>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="dob" class="form-label">Date of Birth</label>
                                <input id="dob" name="dob" type="date" class="form-control">
                                <span class="text-danger">{{$errors->has('dob') ? $errors->first('dob') : ""}}</span>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Gender</label>
                                <select class="form-select" name="gender">
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                                <span
                                    class="text-danger">{{$errors->has('gender') ? $errors->first('gender') : ""}}</span>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Religion</label>
                                <select class="form-select" name="religion">
                                    <option value="">Select Religion</option>
                                    <option value="islam">Islam</option>
                                    <option value="hindu">Hindu</option>
                                </select>
                                <span
                                    class="text-danger">{{$errors->has('religion') ? $errors->first('religion') : ""}}</span>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Marital Status</label>
                                <select class="form-select" name="marital_status">
                                    <option value="">Select Marital Status</option>
                                    <option value="unmarried">Unmarried</option>
                                    <option value="married">Married</option>
                                </select>
                                <span
                                    class="text-danger">{{$errors->has('marital_status') ? $errors->first('marital_status') : ""}}</span>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="nationality" class="form-label">Nationality</label>
                                <input id="nationality" name="nationality" type="text" class="form-control"
                                       placeholder="Enter Nationality">
                                <span
                                    class="text-danger">{{$errors->has('nationality') ? $errors->first('nationality') : ""}}</span>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="national_id" class="form-label">National Id</label>
                                <input id="national_id" name="national_id" type="text" class="form-control"
                                       placeholder="Enter National Id">
                                <span
                                    class="text-danger">{{$errors->has('national_id') ? $errors->first('national_id') : ""}}</span>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="passport_number" class="form-label">Passport Number</label>
                                <input id="passport_number" name="passport_number" type="text" class="form-control"
                                       placeholder="Enter Passport Number">
                                <span
                                    class="text-danger">{{$errors->has('passport_number') ? $errors->first('passport_number') : ""}}</span>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="passport_issue_date" class="form-label">Passport Issue Date</label>
                                <input id="passport_issue_date" name="passport_issue_date" type="date"
                                       class="form-control">
                                <span
                                    class="text-danger">{{$errors->has('passport_issue_date') ? $errors->first('passport_issue_date') : ""}}</span>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="primary_mobile" class="form-label">Primary Mobile</label>
                                <input id="primary_mobile" name="primary_mobile" type="text" class="form-control"
                                       placeholder="Enter National Id">
                                <span
                                    class="text-danger">{{$errors->has('primary_mobile') ? $errors->first('primary_mobile') : ""}}</span>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="secondary_mobile" class="form-label">Secondary Mobile</label>
                                <input id="secondary_mobile" name="secondary_mobile" type="text" class="form-control"
                                       placeholder="Enter National Id">
                                <span
                                    class="text-danger">{{$errors->has('secondary_mobile') ? $errors->first('secondary_mobile') : ""}}</span>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="emergency_contact" class="form-label">Emergency Contact</label>
                                <input id="emergency_contact" name="emergency_contact" type="text" class="form-control"
                                       placeholder="Enter National Id">
                                <span
                                    class="text-danger">{{$errors->has('emergency_contact') ? $errors->first('emergency_contact') : ""}}</span>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Blood Group</label>
                                <select class="form-select" name="blood_group">
                                    <option value="">Select Blood Group</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                </select>
                                <span
                                    class="text-danger">{{$errors->has('blood_group') ? $errors->first('blood_group') : ""}}</span>
                            </div>
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Present Address</label>
                                <textarea id="ckeditor" name="present_address" type="text"
                                          class="form-control ckeditor"></textarea>
                                <span
                                    class="text-danger">{{$errors->has('present_address') ? $errors->first('present_address') : ""}}</span>
                            </div>
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Permanent Address</label>
                                <textarea id="summernote" name="permanent_address" type="text"
                                          class="form-control"></textarea>
                                <span
                                    class="text-danger">{{$errors->has('permanent_address') ? $errors->first('permanent_address') : ""}}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 d-grid">
                                <button type="submit"  class="btn d-block btn-primary">Save Personal Information</button>
                            </div>
                        </div>
                    </form>

                </div>
                <!-- end card body -->
            </div>
        </div>
    </div>
@endsection

@section('page-model')
@endsection

@section('page-required-js')
    <!-- dashboard init -->
    <script src="{{asset('/')}}backend/assets/js/pages/dashboard.init.js"></script>
    <script>
        $(".navi-link").on("click", function(){
            $(".navi").find(".active").removeClass("active");
            $(this).addClass("active");
        });
    </script>
@endsection

@extends('backend.master')

@section('title')
    Company Information
@endsection
@section('page-required-css')
    <link href="{{asset('/')}}backend/assets/libs/spectrum-colorpicker2/spectrum.min.css" rel="stylesheet" type="text/css">
@endsection

@section('breadcrumb')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Edit</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Company Information</a></li>
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

            <form action="{{route('company')}}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- {{ method_field('PUT') }}--}}
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <h4 class="card-title mb-4">Company Information</h4>
                            <div class="col-md-6 mb-3">
                                <label for="companyName" class="form-label">Company Name</label>
                                <input id="companyName" name="name" type="text" class="form-control" placeholder="Enter Company Name...">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="companySolgan" class="form-label">Company Slogan</label>
                                <input id="companySolgan" name="slogan" type="text" class="form-control" placeholder="Enter Company Solgan...">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="companyLogoOne" class="form-label">Company Logo One</label>
                                <input id="companyLogoOne" name="logo_one" type="file" class="form-control dropify">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="companyLogoTwo" class="form-label">Company Logo Two</label>
                                <input id="companyLogoTwo" name="logo_two" type="file" class="form-control dropify">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="about_blog" class="form-label">About Blog</label>
                                <textarea id="about_blog" name="about_blog" type="text" class="form-control summernote"></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="mission" class="form-label">Mission</label>
                                <textarea id="mission" name="mission" type="text" class="form-control summernote"></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="vision" class="form-label">Vision</label>
                                <textarea id="vision" name="vision" type="text" class="form-control summernote"></textarea>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="companyEmail" class="form-label">Company Email</label>
                                <input id="companyEmail" name="email" type="email" class="form-control" placeholder="Enter Company Email...">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="companyPhoneOne" class="form-label">Company Phone Number</label>
                                <input id="companyPhoneOne" class="form-control" type="text" name="phone_one">
                            </div>
                            {{-- <div class="col-md-4 mb-3">--}}
                            {{-- <label for="companyPhoneTwo" class="form-label">Company Phone Number</label>--}}
                            {{-- <input id="companyPhoneTwo" class="form-control"--}}
                            {{-- type="text" name="phone_two">--}}
                            {{-- </div>--}}
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Select Color</label>
                                <input type="text" name="company_color" class="form-control" id="colorpicker-default" value="#50a5f1">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="companyFacebook" class="form-label">Company Facebook</label>
                                <input id="companyFacebook" class="form-control" type="text" name="fb_link">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="companylinkedin" class="form-label">Company Linkedin</label>
                                <input id="companylinkedin" class="form-control" type="text" name="linked_link">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="companyTwitter" class="form-label">Company Twitter</label>
                                <input id="companyTwitter" class="form-control" type="text" name="twitter_link">
                            </div>
                            <div class="mb-3">
                                <label for="companyAddress" class="form-label">Company Address</label>
                                <textarea id="companyAddress" name="address" type="text" class="form-control summernote"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-block btn-primary">Add Company Information</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('page-model')

@endsection

@section('page-required-js')
    <script src="{{asset('/')}}backend/assets/libs/spectrum-colorpicker2/spectrum.min.js"></script>

    <!-- form advanced init -->
    <script src="{{asset('/')}}backend/assets/js/pages/form-advanced.init.js"></script>
@endsection

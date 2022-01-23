@extends('backend.master')

@section('title')
Photo
@endsection

@section('page-required-css')

@endsection

@section('page-title')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Photo</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="#">Photo</a></li>
                    <li class="breadcrumb-item">Photo</li>
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
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Update Photo</h4>
                <form action="{{route('photo.update', [$id = $photo->id])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="row mb-4">
                        <label for="categoryName1" class="col-form-label col-lg-2">Photo Category</label>
                        <div class="col-md-10">
                            <select class="form-select" id="categoryName1" name="photo_category_id">
                                <option value="">Select</option>
                                @foreach($photoCategories as $photoCategory)
                                <option value="{{$photoCategory->id}}" {{$photoCategory->id == $photo->photo_category_id ? "checked" : ""}}>{{$photoCategory->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-form-label col-lg-2">Attached Files</label>
                        <div class="col-lg-10">
                            @if($photo->image)
                            <input id="companyLogoTwo" name="image" type="file" class="form-control dropify" data-default-file="{{asset('/')}}{{$photo->image}}">
                            @else
                            <input id="companyLogoTwo" name="image" type="file" class="form-control dropify">
                            @endif
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-form-label col-lg-2">Description</label>
                        <div class="col-lg-10">
                            <textarea id="mission" name="description" type="text" class="form-control summernote" placeholder="Enter Description">{{$photo->description}}</textarea>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-form-label col-lg-2">Publication Status</label>
                        <div class="col-lg-10">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" {{$photo->status == 1 ? "checked" : ""}} name="status" id="inlineRadio1" value="1">
                                <label class="form-check-label" for="inlineRadio1">Published</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" {{$photo->status == 0 ? "checked" : ""}} type="radio" name="status" id="inlineRadio2" value="0">
                                <label class="form-check-label" for="inlineRadio2">Unpublished</label>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-lg-10">
                            <button type="submit" class="btn btn-primary">Update Photo</button>
                            <button type="button" onclick="location.href='{{route('photo.index')}}'" class="btn ml-auto btn-outline-primary">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div><!-- end row -->
@endsection

@section('page-required-js')

@endsection

@extends('backend.master')

@section('title')
Edit Category
@endsection

@section('page-required-css')

@endsection

@section('page-title')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Category</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="#">Category</a></li>
                    <li class="breadcrumb-item">Edit Category</li>
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
                <h4 class="card-title mb-4">Update Category</h4>
                <form action="{{route('category.update', $category)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="row mb-4">
                        <label for="categoryName1" class="col-form-label col-lg-2">Main Category</label>
                        <div class="col-md-10">
                            <select class="form-select" id="categoryName1" name="main_category">
                                <option value=""  disabled>-- Select --</option>
                                <option value="1" {{$category->main_category == 1 ? "selected" : ""}}>Bangla</option>
                                <option value="2" {{$category->main_category == 2 ? "selected" : ""}}>English</option>
                                <option value="3" {{$category->main_category == 3 ? "selected" : ""}}>Norwegian</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="categoryName" class="col-form-label col-lg-2">Category Name</label>
                        <div class="col-lg-10">
                            <input id="categoryName" name="name" type="text" value="{{$category->name}}" class="form-control" placeholder="Enter Category Name...">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-form-label col-lg-2">Attached Files</label>
                        <div class="col-lg-10">
                            <input type="file" name="image" class="dropify" data-height="" id="horizontal-firstname-input" data-default-file="{{asset('/')}}{{$category->image}}">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-form-label col-lg-2"> Publication Status</label>
                        <div class="col-lg-10">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" {{$category->status == 1 ? "checked" : ""}} name="status" id="inlineRadio1" value="1">
                                <label class="form-check-label" for="inlineRadio1">Published</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" {{$category->status == 0 ? "checked" : ""}} type="radio" name="status" id="inlineRadio2" value="0">
                                <label class="form-check-label" for="inlineRadio2">Unpublished</label>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-lg-10">
                            <button type="submit" class="btn btn-primary">Update Category</button>
                            <button type="button" onclick="location.href='{{route('category.index')}}'" class="btn ml-auto btn-outline-primary">Cancel</button>
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


@extends('backend.master')

@section('title')
Photo Category
@endsection

@section('page-required-css')

@endsection

@section('page-title')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Photo Category</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item">Photo Category</li>
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
                <h4 class="card-title mb-4">Update Photo Category</h4>
                <form action="{{route('photo-category.update', $photoCategory)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="row mb-4">
                        <label for="categoryName" class="col-form-label col-lg-2">Category Name</label>
                        <div class="col-lg-10">
                            <input id="categoryName" name="name" type="text" value="{{$photoCategory->name}}" class="form-control" placeholder="Enter Category Name...">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-form-label col-lg-2">Publication Status</label>
                        <div class="col-lg-10">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" {{$photoCategory->status == 1 ? "checked" : ""}} name="status" id="inlineRadio1" value="1">
                                <label class="form-check-label" for="inlineRadio1">Published</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" {{$photoCategory->status == 0 ? "checked" : ""}} type="radio" name="status" id="inlineRadio2" value="0">
                                <label class="form-check-label" for="inlineRadio2">Unpublished</label>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-lg-10">
                            <button type="submit" class="btn btn-primary">Update Photo Category</button>
                            <button type="button" onclick="location.href='{{route('photo-category.index')}}'" class="btn ml-auto btn-outline-primary">Cancel</button>
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


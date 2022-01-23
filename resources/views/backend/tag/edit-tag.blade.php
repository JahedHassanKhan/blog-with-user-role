@extends('backend.master')

@section('title')
    Tag
@endsection

@section('page-required-css')

@endsection

@section('page-title')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Tag</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="#">Tag</a></li>
                        <li class="breadcrumb-item">Tag</li>
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
                    <h4 class="card-title mb-4">Create New Tag</h4>
                    <form action="{{route('tag.update', $tag->slug)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="row mb-4">
                            <label for="tagName" class="col-form-label col-lg-2">Tag Name</label>
                            <div class="col-lg-10">
                                <input id="tagName" name="tag_name" type="text" value="{{$tag->name}}" class="form-control" placeholder="Enter Tag Name...">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-form-label col-lg-2">Publication Status</label>
                            <div class="col-lg-10">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" {{$tag->status == 1 ? "checked" : ""}} name="publication_status" id="inlineRadio1" value="1">
                                    <label class="form-check-label" for="inlineRadio1">Published</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" {{$tag->status == 0 ? "checked" : ""}} type="radio" name="publication_status" id="inlineRadio2" value="0">
                                    <label class="form-check-label" for="inlineRadio2">Unpublished</label>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-lg-10">
                                <button type="submit" class="btn btn-primary">Update Tag</button>
                                <button type="button" onclick="location.href='{{route('tag.index')}}'" class="btn ml-auto btn-outline-primary">Cancel</button>
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


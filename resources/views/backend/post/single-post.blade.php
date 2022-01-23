@extends('backend.master')

@section('title')
    Post
@endsection

@section('page-required-css')
    <link href="{{asset('/')}}backend/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('/')}}backend/assets/libs/summernote/summernote-bs4.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('page-title')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Post</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="#">Post</a></li>
                        <li class="breadcrumb-item">Post</li>
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
                    <div class="pt-3">
                        <div class="row justify-content-center">
                            <div class="col-xl-8">
                                <div>
                                    <div class="text-center">
                                        <div class="mb-4">
                                            @foreach($post->categories as $postCategory)
                                                @if($loop->last)
                                                    <a href="#" class="badge bg-light font-size-12">
                                                        <i class="bx bx-purchase-tag-alt align-middle text-muted me-1"></i>
                                                        {{ $postCategory->name  }}
                                                    </a>
                                                @else
                                                    <a href="#" class="badge bg-light font-size-12">
                                                        <i class="bx bx-purchase-tag-alt align-middle text-muted me-1"></i>
                                                        {{ $postCategory->name  }}
                                                    </a>
                                                @endif
                                            @endforeach
                                        </div>
                                        <h4>{{$post->title}}</h4>
                                        <p class="text-muted mb-4"><i class="mdi mdi-calendar me-1"></i> {{ $post->created_at->isoFormat('MMM D, YYYY')}} </p>
                                    </div>

                                    <hr>
                                    <div class="text-center">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div>
                                                    <p class="text-muted mb-2">Categories</p>
                                                    <h5 class="font-size-15">
                                                        @foreach($post->categories as $postCategory)
                                                            @if($loop->last)
                                                                {{ $postCategory->name }}
                                                            @else
                                                                {{ $postCategory->name  }} |
                                                            @endif
                                                        @endforeach
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="mt-4 mt-sm-0">
                                                    <p class="text-muted mb-2">Date</p>
                                                    <h5 class="font-size-15">{{ $post->created_at->isoFormat('MMM D, YYYY')}}</h5>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="mt-4 mt-sm-0">
                                                    <p class="text-muted mb-2">Tags</p>
                                                    <h5 class="font-size-15">
                                                        @foreach($post->tags as $postTag)
                                                            @if($loop->last)
                                                                {{ $postTag->name }}
                                                            @else
                                                                {{ $postTag->name  }} |
                                                            @endif
                                                        @endforeach
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="my-5">
                                        <img src="{{asset('/')}}{{$post->image}}" alt="" class="img-thumbnail mx-auto d-block">
                                    </div>

                                    <hr>

                                    <div class="mt-4">
                                        {!! $post->body !!}
                                        <hr>
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <a href="{{route('post.edit', $post)}}" type="submit" class="btn btn-success w-sm">Edit Post</a>
                                        <a href="{{route('post.index')}}" class="btn btn-success w-sm">
                                            Go Back
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->


@endsection

@section('page-required-js')
    <script src="{{asset('/')}}backend/assets/libs/select2/js/select2.min.js"></script>
    <!-- form advanced init -->
    <script src="{{asset('/')}}backend/assets/js/pages/form-advanced.init.js"></script>
    <!-- Summernote js -->
    <script src="{{asset('/')}}backend/assets/libs/summernote/summernote-bs4.min.js"></script>

    <!-- init js -->
    <script src="{{asset('/')}}backend/assets/js/pages/form-editor.init.js"></script>

    {{--<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>--}}
    {{--<script>tinymce.init({id:'textarea'});</script>--}}


@endsection



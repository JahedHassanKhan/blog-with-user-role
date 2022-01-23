@extends('backend.master')

@section('title')
Post
@endsection

@section('page-required-css')


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
    <div class="col-xl-9 col-lg-8">
        <div class="card">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs nav-tabs-custom justify-content-center pt-2" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#all-post" role="tab">
                        All Post
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#archive" role="tab">
                        Archive
                    </a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content p-4">
                <div class="tab-pane active" id="all-post" role="tabpanel">
                    <div>
                        <div class="row justify-content-center">
                            <div class="col-xl-12">
                                <div>
                                    <div class="row align-items-center">
                                        <div class="col-4">
                                            <div>
                                                <h5 class="mb-0">Blog List</h5>
                                            </div>
                                        </div>

                                        <div class="col-8">
                                            <div>
                                                <ul class="nav nav-pills justify-content-end">
                                                    <li class="nav-item">
                                                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">View :</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="{{route('post.index')}}">
                                                            <i class="mdi mdi-format-list-bulleted"></i>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link active" href="{{route('all-post-table')}}">
                                                            <i class="mdi mdi-view-grid-outline"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end row -->

                                    <hr class="mb-4">

                                    <div class="row">
                                        @foreach($posts as $post)
                                        <div class="col-sm-4">
                                            <div class="card p-1 border shadow-none">
                                                <div class="p-3">
                                                    <h5><a href="{{route('post.show', $post)}}" class="text-dark">{{$post->title}}</a></h5>
                                                    <p class="text-muted mb-0">{{ $post->created_at->isoFormat('MMM D, YYYY')}}</p>
                                                </div>

                                                <div class="position-relative">
                                                    <img src="{{asset('/')}}{{$post->image}}" alt="" class="img-thumbnail">
                                                </div>

                                                <div class="p-3">
                                                    <ul class="list-inline">
                                                        <li class="list-inline-item me-3">
                                                            <a href="#" class="text-muted">
                                                                <i class="bx bx-purchase-tag-alt align-middle text-muted me-1"></i>
                                                                @foreach($post->categories as $postCategory)
                                                                @if($loop->last)
                                                                {{ $postCategory->name }}
                                                                @else
                                                                {{ $postCategory->name  }} |
                                                                @endif

                                                                @endforeach

                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item me-3">
                                                            <a href="#" class="text-muted">
                                                                <i class="bx bx-comment-dots align-middle text-muted me-1"></i>
{{--                                                                {{$post->replies->count()}} Comments--}}
                                                                10 Comments
                                                            </a>
                                                        </li>
                                                    </ul>
                                                    <p>{!! \Illuminate\Support\Str::words(htmlspecialchars(trim(strip_tags($post->body))), 30) !!} </p>
                                                    <div>
                                                        <a href="{{route('post.show', $post)}}" class="text-primary">Read more <i class="mdi mdi-arrow-right"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <hr class="my-4">
                                    {{ $posts->links('backend.includes.pagination') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="archive" role="tabpanel">
                    <div>
                        <div class="row justify-content-center">
                            <div class="col-xl-8">
                                <h5>Archive</h5>
                                <div class="mt-5">
                                    <div class="d-flex flex-wrap">
                                        <div class="me-2">
                                            <h4>2021</h4>
                                        </div>
                                        <div class="ms-auto">
                                            <span class="badge badge-soft-success badge-pill float-end ms-1 font-size-12"> 03
                                            </span>
                                        </div>
                                    </div>
                                    <hr class="mt-2">
                                    <div class="list-group list-group-flush">
                                        @foreach($posts as $post)
                                        @if($post->created_at->isoFormat('YYYY') == '2021')
                                        <a href="blog-details.html" class="list-group-item text-muted"><i class="mdi mdi-circle-medium me-1"></i>{{$post->title}}</a>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div class="mt-5">
                                    <div class="d-flex flex-wrap">
                                        <div class="me-2">
                                            <h4>2019</h4>
                                        </div>
                                        <div class="ms-auto">
                                            <span class="badge badge-soft-success badge-pill float-end ms-1 font-size-12">06</span>
                                        </div>
                                    </div>
                                    <hr class="mt-2">
                                    <div class="list-group list-group-flush">
                                        <a href="blog-details.html" class="list-group-item text-muted"><i class="mdi mdi-circle-medium me-1"></i> Coffee with Friends</a>

                                        <a href="blog-details.html" class="list-group-item text-muted"><i class="mdi mdi-circle-medium me-1"></i> Neque porro quisquam est</a>

                                        <a href="blog-details.html" class="list-group-item text-muted"><i class="mdi mdi-circle-medium me-1"></i> Quis autem vel eum iure</a>

                                        <a href="blog-details.html" class="list-group-item text-muted"><i class="mdi mdi-circle-medium me-1"></i> Cras mi eu turpis</a>

                                        <a href="blog-details.html" class="list-group-item text-muted"><i class="mdi mdi-circle-medium me-1"></i> Drawing a sketch</a>

                                        <a href="blog-details.html" class="list-group-item text-muted"><i class="mdi mdi-circle-medium me-1"></i> Project discussion with team</a>

                                    </div>
                                </div>
                                <div class="mt-5">
                                    <div class="d-flex flex-wrap">
                                        <div class="me-2">
                                            <h4>2018</h4>
                                        </div>
                                        <div class="ms-auto">
                                            <span class="badge badge-soft-success badge-pill float-end ms-1 font-size-12">03</span>
                                        </div>
                                    </div>
                                    <hr class="mt-2">
                                    <div class="list-group list-group-flush">
                                        <a href="blog-details.html" class="list-group-item text-muted"><i class="mdi mdi-circle-medium me-1"></i> Beautiful Day with Friends</a>
                                        <a href="blog-details.html" class="list-group-item text-muted"><i class="mdi mdi-circle-medium me-1"></i> Drawing a sketch</a>
                                        <a href="blog-details.html" class="list-group-item text-muted"><i class="mdi mdi-circle-medium me-1"></i> Project discussion with team</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-4">
        <div class="card">
            <div class="card-body p-4">
                <div class="search-box">
                    <p class="text-muted">Search</p>
                    <div class="position-relative">
                        <form class="searchform" action="{{route('all-post-table')}}" method="get">
                            <input type="text" name="term" class="form-control rounded bg-light border-light" placeholder="Search...">
                            <i class="mdi mdi-magnify search-icon"></i>
                        </form>
                    </div>
                </div>
                <hr class="my-4">
                <div>
                    <p class="text-muted">Categories</p>
                    <ul class="list-unstyled fw-medium">
                        @foreach($categories as $category)
                        <li>
                            <a href="#" class="text-muted py-2 d-block">
                                <i class="mdi mdi-chevron-right me-1"></i>
                                {{$category->name}}
                                @if($category->posts->count() > 0)
                                <span class="badge badge-soft-success badge-pill float-end ms-1 font-size-12">{{$category->posts->count()}}</span>
                                @endif
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <hr class="my-4">
                <div>
                    <p class="text-muted">Archive</p>

                    <ul class="list-unstyled fw-medium">
                        <li><a href="#" class="text-muted py-2 d-block"><i class="mdi mdi-chevron-right me-1"></i> 2020 <span class="badge badge-soft-success badge-pill float-end ms-1 font-size-12">03</span></a></li>
                        <li><a href="#" class="text-muted py-2 d-block"><i class="mdi mdi-chevron-right me-1"></i> 2019 <span class="badge badge-soft-success badge-pill float-end ms-1 font-size-12">06</span></a></li>
                        <li><a href="#" class="text-muted py-2 d-block"><i class="mdi mdi-chevron-right me-1"></i> 2018 <span class="badge badge-soft-success badge-pill float-end ms-1 font-size-12">05</span></a></li>
                    </ul>
                </div>
                <hr class="my-4">
                <div>
                    <p class="text-muted mb-2">Popular Posts</p>
                    <div class="list-group list-group-flush">
                        <a href="#" class="list-group-item text-muted py-3 px-2">
                            <div class="media align-items-center">
                                <div class="me-3">
                                    <img src="assets/images/small/img-7.jpg" alt="" class="avatar-md h-auto d-block rounded">
                                </div>
                                <div class="media-body overflow-hidden">
                                    <h5 class="font-size-13 text-truncate">Beautiful Day with Friends</h5>
                                    <p class="mb-0 text-truncate">10 Apr, 2020</p>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item text-muted py-3 px-2">
                            <div class="media align-items-center">
                                <div class="me-3">
                                    <img src="assets/images/small/img-4.jpg" alt="" class="avatar-md h-auto d-block rounded">
                                </div>
                                <div class="media-body overflow-hidden">
                                    <h5 class="font-size-13 text-truncate">Drawing a sketch</h5>
                                    <p class="mb-0 text-truncate">24 Mar, 2020</p>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item text-muted py-3 px-2">
                            <div class="media align-items-center">
                                <div class="me-3">
                                    <img src="assets/images/small/img-6.jpg" alt="" class="avatar-md h-auto d-block rounded">
                                </div>
                                <div class="media-body overflow-hidden">
                                    <h5 class="font-size-13 text-truncate">Project discussion with team</h5>
                                    <p class="mb-0 text-truncate">11 Mar, 2020</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <hr class="my-4">
                <div>
                    <p class="text-muted">Tags</p>
                    <div class="d-flex flex-wrap gap-2 widget-tag">
                        @foreach($tags as $tag)
                        <div><a href="#" class="badge bg-light font-size-12">{{$tag->tag_name}}</a></div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- end card -->
    </div>
</div>
@endsection

@section('page-required-js')


@endsection

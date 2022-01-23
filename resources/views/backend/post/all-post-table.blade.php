@extends('backend.master')

@section('title')
Post
@endsection

@section('page-required-css')
<link href="{{asset('/')}}backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="{{asset('/')}}backend/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<!-- Responsive datatable examples -->
<link href="{{asset('/')}}backend/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />


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
    <div class="col-xl-12 col-lg-12">
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
                                                        <a class="nav-link active" href="{{route('post.index')}}">
                                                            <i class="mdi mdi-format-list-bulleted"></i>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="{{route('all-post-table')}}">
                                                            <i class="mdi mdi-view-grid-outline"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end row -->

                                    <hr class="mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Post Datatable</h4>
                                            <table id="datatable" class="table table-bordered dt-responsive wrap w-100">
                                                <thead>
                                                    <tr>
                                                        <th>Sl No</th>
                                                        <th>Image</th>
                                                        <th>Post Title</th>
                                                        <th>Post Category</th>
                                                        <th>Post Tag</th>
                                                        <th>Post Body</th>
                                                        <th>Created by</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($posts as $post)
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>
                                                            @if ($post->image)
                                                            <img src="{{asset('/')}}{{$post->image}}" alt="Feature Image None" height="50" width="70">
                                                            @else
                                                            <span>No Image</span>
                                                            @endif
                                                        </td>
                                                        <td><a href="{{route('post.show', $post)}}">{{$post->title}}</a></td>
                                                        <td>
                                                            @foreach($post->categories as $postCategory)
                                                            @if($loop->last)
                                                            {{ $postCategory->name }}
                                                            @else
                                                            {{ $postCategory->name  }} |
                                                            @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach($post->tags as $postTag)
                                                            @if($loop->last)
                                                            {{ $postTag->name }}
                                                            @else
                                                            {{ $postTag->name  }} |
                                                            @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            {!! \Illuminate\Support\Str::words(htmlspecialchars(trim(strip_tags($post->body))), 30) !!}
                                                        </td>
                                                        <td>{{$post->createdBy->name}}</td>
                                                        <td>
                                                            @if($post->status == 1)
                                                            <a href="{{route('post.status', ['id' => $post->id])}}" class="btn btn-success btn-sm" title="click to unpublish">
                                                                <i class="fas fa-arrow-alt-circle-up"></i>
                                                            </a>
                                                            @else
                                                            <a href="{{route('post.status', ['id' => $post->id])}}" class="btn btn-danger btn-sm" title="click to publish">
                                                                <i class="fas fa-arrow-alt-circle-down"></i>
                                                            </a>
                                                            @endif
                                                            <a href="{{route('post.edit', $post)}}" class="btn btn-info btn-sm">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <form id="delete-product-{{$post->id}}" method="post" action="{{ route('post.destroy',$post) }}" style="display: none">
                                                                {{ csrf_field() }}
                                                                {{ method_field('DELETE') }}
                                                            </form>
                                                            <a href="" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure, You Want to delete this?')){
                                                                           event.preventDefault();
                                                                           document.getElementById('delete-product-{{$post->id}}').submit();
                                                                           }">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
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
                                            <h4>2020</h4>
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

</div>
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

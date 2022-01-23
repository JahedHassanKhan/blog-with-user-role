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
                    <form action="{{route('tag.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-4">
                            <label for="tagName" class="col-form-label col-lg-2">Tag Name</label>
                            <div class="col-lg-10">
                                <input id="tagName" name="name" type="text" class="form-control" placeholder="Enter Tag Name...">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-form-label col-lg-2">Publication Status</label>
                            <div class="col-lg-10">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" checked name="status" id="inlineRadio1" value="1">
                                    <label class="form-check-label" for="inlineRadio1">Published</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="0">
                                    <label class="form-check-label" for="inlineRadio2">Unpublished</label>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-lg-10">
                                <button type="submit" class="btn btn-primary">Create Tag</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- end row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Tag Datatable</h4>

                    <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th>Sl No</th>
                            <th>Tag Name</th>
                            <th>Tag Slug</th>
                            <th>Publication Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>


                        <tbody>
                        @foreach($tags as $tag)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$tag->name}}</td>
                                <td>{{$tag->slug}}</td>
                                <td>{{$tag->status ==1 ? 'Published' : 'Unpublished'}}</td>
                                <td>
                                    @if($tag->status ==1)
                                        <a href="{{route('tag.status', ['id' => $tag->id])}}" class="btn btn-success btn-sm">
                                            <i class="fas fa-arrow-alt-circle-up"></i>
                                        </a>
                                    @else
                                        <a href="{{route('tag.status', ['id' => $tag->id])}}" class="btn btn-danger btn-sm">
                                            <i class="fas fa-arrow-alt-circle-down"></i>
                                        </a>
                                    @endif
                                    <a href="{{route('tag.edit', $tag)}}" class="btn btn-info btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form id="delete-product-{{$tag->id}}" method="post" action="{{ route('tag.destroy',$tag) }}" style="display: none">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                    </form>
                                    <a href="" class="btn btn-danger btn-sm"
                                       onclick="if(confirm('Are you sure, You Want to delete this?')){
                                           event.preventDefault();
                                           document.getElementById('delete-product-{{$tag->id}}').submit();
                                           }"
                                    >
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection

@section('page-required-js')
@endsection


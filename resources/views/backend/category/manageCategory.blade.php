@extends('backend.master')

@section('title')
Category
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
                    <li class="breadcrumb-item">Category</li>
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
                <h4 class="card-title mb-4">Create New Category</h4>
                <form action="{{route('category.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-4">
                        <label for="categoryName1" class="col-form-label col-lg-2">Main Category</label>
                        <div class="col-md-10">
                            <select class="form-select" id="categoryName1" name="main_category" required>
                                <option value="" disabled>-- Select --</option>
                                <option value="1">Bangla</option>
                                <option value="2">English</option>
                                <option value="3">Norwegian</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="categoryName" class="col-form-label col-lg-2">Category Name</label>
                        <div class="col-lg-10">
                            <input id="categoryName" name="name" type="text" class="form-control" placeholder="Enter Category Name..." required>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-form-label col-lg-2">Attached Files</label>
                        <div class="col-lg-10">
                            <input type="file" name="image" class="dropify" data-height="" id="horizontal-firstname-input">
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
                            <button type="submit" class="btn btn-primary">Create Category</button>
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
                <h4 class="card-title">Category Datatable</h4>
                <table id="datatable" class="table table-bordered dt-responsive wrap w-100">
                    <thead>
                        <tr>
                            <th>Sl No</th>
                            <th>Main Category</th>
                            <th>Category Name</th>
                            <th>Created By</th>
                            <th>Updated By</th>
                            <th>Category Image</th>
                            <th>Publication Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>
                                @if($category->main_category == 1)
                                Bangla
                                @elseif($category->main_category == 2)
                                English
                                @elseif($category->main_category == 3)
                                Norwegian
                                @endif
                            </td>
                            <td>{{$category->name}}</td>
                            <td>{{$category->createdBy->name}}</td>
                            <td>
                                @if($category->updatedBy)
                                {{$category->updatedBy->name}}
                                @else
                                Null
                                @endif
                            </td>

                            <td><img src="{{$category->image}}" alt="" width="150" height="100"></td>
                            <td>{{$category->status ==1 ? 'Published' : 'Unpublished'}}</td>
                            <td>
                                @if($category->status ==1)
                                <a href="{{route('category.status', ['id' => $category->id])}}" class="btn btn-success btn-sm">
                                    <i class="fas fa-arrow-alt-circle-up"></i>
                                </a>
                                @else
                                <a href="{{route('category.status', ['id' => $category->id])}}" class="btn btn-danger btn-sm">
                                    <i class="fas fa-arrow-alt-circle-down"></i>
                                </a>
                                @endif
                                <a href="{{route('category.edit', $category)}}" class="btn btn-info btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form id="delete-product-{{$category->id}}" method="post" action="{{ route('category.destroy', $category) }}" style="display: none">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                </form>
                                <a href="" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure, You Want to delete this?')){
                                           event.preventDefault();
                                           document.getElementById('delete-product-{{$category->id}}').submit();
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
    </div> <!-- end col -->
</div> <!-- end row -->
@endsection

@section('page-required-js')

@endsection

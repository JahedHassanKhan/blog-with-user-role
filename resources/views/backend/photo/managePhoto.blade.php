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
                <h4 class="card-title mb-4">Add Photo To Gallary</h4>
                <form action="{{route('photo.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-4">
                        <label for="categoryName1" class="col-form-label col-lg-2">Photo Category</label>
                        <div class="col-md-10">
                            <select class="form-select" id="categoryName1" name="photo_category_id" required>
                                <option value="" disabled>-- Select ---</option>
                                @foreach($photoCategories as $photoCategory)
                                <option value="{{$photoCategory->id}}">{{$photoCategory->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-form-label col-lg-2">Image</label>
                        <div class="col-lg-10">
                            <input id="companyLogoTwo" name="image" type="file" accept="image/*" class="form-control dropify" required>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-form-label col-lg-2">Description</label>
                        <div class="col-lg-10">
                            <textarea id="mission" name="description" type="text" class="form-control summernote" placeholder="Enter Description"></textarea>
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
                            <button type="submit" class="btn btn-primary">Create Photo</button>
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
                <h4 class="card-title">Photo Datatable</h4>
                <table id="datatable" class="table table-bordered dt-responsive wrap w-100">
                    <thead>
                        <tr>
                            <th>Sl No</th>
                            <th>Photo Category</th>
                            <th>Photo Image</th>
                            <th>Description</th>
                            <th>Publication Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($photos))
                        @foreach($photos as $photo)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$photo->photoCategory->name??''}}</td>
                            <td><img src="{{asset('/')}}{{$photo->image}}" alt="" width="150" height="100"></td>
                            <td>{{$photo->description}}</td>
                            <td>{{$photo->status ==1 ? 'Published' : 'Unpublished'}}</td>
                            <td>
                                @if($photo->status ==1)
                                <a href="{{route('photo.status', ['id' => $photo->id])}}" class="btn btn-success btn-sm">
                                    <i class="fas fa-arrow-alt-circle-up"></i>
                                </a>
                                @else
                                <a href="{{route('photo.status', ['id' => $photo->id])}}" class="btn btn-danger btn-sm">
                                    <i class="fas fa-arrow-alt-circle-down"></i>
                                </a>
                                @endif
                                <a href="{{route('photo.edit', $photo)}}" class="btn btn-info btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form id="delete-product-{{$photo->id}}" method="post" action="{{ route('photo.destroy', $photo) }}" style="display: none">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                </form>
                                <a href="" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure, You Want to delete this?')){
                                    event.preventDefault();
                                    document.getElementById('delete-product-{{$photo->id}}').submit();
                                    }">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
@endsection

@section('page-required-js')

@endsection

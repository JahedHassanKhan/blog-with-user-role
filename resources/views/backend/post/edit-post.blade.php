@extends('backend.master')

@section('title')
    Edit Post
@endsection

@section('page-required-css')
    <link href="{{asset('/')}}backend/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('/')}}backend/assets/libs/summernote/summernote-bs4.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('page-title')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Edit Post</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="#">Dashdoard</a></li>
                        <li class="breadcrumb-item">Edit Post</li>
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
                    <h4 class="card-title mb-4">Edit Post</h4>
                    <form action="{{route('post.update', $post)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row mb-4">
                                    <label class="col-sm-3 col-form-label">Main Category</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="main_category" id="main_category" data-placeholder="Choose MainCategory ..." onchange="setCategory(this.value)" required>
                                            <option value="1" {{$post->main_category == 1 ? 'selected': ''}}>Bangla</option>
                                            <option value="2" {{$post->main_category == 2 ? 'selected': ''}}>English</option>
                                            <option value="3" {{$post->main_category == 3 ? 'selected': ''}}>Norwegian</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-sm-3 col-form-label">Category Names</label>
                                    <div class="col-sm-9">
                                        <select class="select2 form-control select2-multiple" id="categoryId" name="categories[]" multiple="multiple" data-placeholder="Choose categories ...">
                                            @foreach($categories as $category)
                                            <option value="{{$category->id}}"
                                                @foreach($post->categories as $postCategory)
                                                    {{$postCategory->id == $category->id ? 'selected' : ''}}
                                                @endforeach>{{$category->name}}</option
                                            >
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-form-label col-lg-3">Post Feature Image</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="file" name="post_image" id="formFile">
                                        <img src="{{asset('/')}}{{$post->image}}" width="150" height="100">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row mb-4">
                                    <label class="col-sm-3 col-form-label">Tag Names</label>
                                    <div class="col-sm-9">
                                        <select class="select2 form-control select2-multiple" name="tags[]" multiple="multiple" data-placeholder="Choose tags...">
                                            @foreach($tags as $tag)
                                                <option value="{{$tag->id}}"
                                                @foreach($post->tags as $postTag)
                                                    {{$postTag->id == $tag->id ? 'selected' : ''}}
                                                    @endforeach
                                                >{{$tag->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-form-label col-lg-3">Publication Status</label>
                                    <div class="col-lg-9">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" {{$post->status == 1 ? "checked" : ""}} name="publication_status" id="inlineRadio1" value="1">
                                            <label class="form-check-label" for="inlineRadio1">Published</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" {{$post->status == 0 ? "checked" : ""}} name="publication_status" id="inlineRadio2" value="0">
                                            <label class="form-check-label" for="inlineRadio2">Unpublished</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="postName" class="col-form-label">Post Title</label>
                            <div class="">
                                <input id="postName" name="title" type="text" class="form-control" value="{{$post->title}}">
                            </div>
                        </div>

                        <div class="row mb-4">
                            {{--                        <label class="col-form-label col-lg-2">Attached Files</label>--}}
                            <div class="">
                                <textarea class="form-control" name="body" id="editor">
                                    {{$post->body}}
                                </textarea>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary  w-100">Update Post</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- end row -->
@endsection

@section('page-required-js')
    <script src="{{asset('/')}}backend/assets/libs/select2/js/select2.min.js"></script>
    <script src="{{asset('/')}}backend/ckeditor.js"></script>
    <script>
        function setCategory(main_category) {
                $.ajax({
                    method: "GET",
                    url: "{{ url('set-category-by-main-category') }}",
                    data: {
                        main_category: main_category
                    },
                    dataType: 'JSON',
                    success: function(response) {
                        console.log(response);
                        var select = $('#categoryId');
                        select.empty();
                        var option = ' ';
                        // option += '<option value="" disable selected> -- Select Category -- </option>';
                        $.each(response, function(key, value) {
                            option += '<option value="' + value.id + '">' + value.category_name + '</option>';
                        });
                        select.append(option);
                    }
                });
            };
    </script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ), {
                // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
            } )
            .then( editor => {
                window.editor = editor;
            } )
            .catch( err => {
                console.error( err.stack );
            } );
    </script>

    <!-- form advanced init -->
    <script src="{{asset('/')}}backend/assets/js/pages/form-advanced.init.js"></script>

    {{--<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>--}}
    {{--<script>tinymce.init({id:'textarea'});</script>--}}


@endsection



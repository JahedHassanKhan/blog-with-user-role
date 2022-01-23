@extends('backend.master')

@section('title')
Create Post
@endsection

@section('page-required-css')

@endsection
@section('page-title')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Create Post</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="#">Dashdoard</a></li>
                    <li class="breadcrumb-item">Create Post</li>
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
                <h4 class="card-title mb-4">Create New Post</h4>
                <form action="{{route('post.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-4">
                        <div class="col-md-4 col-12">
                            <label class="col-form-label">Main Category</label>
                            <select class="form-control" name="main_category" id="main_category" data-placeholder="Choose MainCategory ..." onchange="setCategory(this.value)" required>
                                <option value="">--- Select ---</option>
                                <option value="1">Bangla</option>
                                <option value="2">English</option>
                                <option value="3">Norwegian</option>
                            </select>
                        </div>
                        <div class="col-md-4 col-12">
                            <label class="col-form-label">Category Names</label>
                            <select class="select2 form-control select2-multiple" id="categoryId" name="categories[]" multiple="multiple" data-placeholder="--- Choose categories ..." required>
                                @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 col-12">
                            <label class="col-sm-3 col-form-label">Tag Names</label>
                            <select class="select2 form-control select2-multiple" name="tags[]" multiple="multiple" data-placeholder="Choose tags...">
                                @foreach($tags as $tag)
                                <option value="{{$tag->id}}">{{$tag->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-12 col-12">
                            <label class="col-form-label col-lg-3">Post Featue Image</label>
                            <div class="col-12">
                                <input name="image" type="file" accept="image/*" class="form-control dropify" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label for="postName" class="col-form-label">Post Title</label>
                        <div class="col-12">
                            <input id="postName" name="title" type="text" class="form-control" placeholder="Enter Post Name...">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-form-label col-lg-2">Post Description</label>
                        <div class="col-12">
                            <textarea class="form-control summernote" name="body" id="editor"></textarea>
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary  w-100">Create Post</button>
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
                        option += '<option value="' + value.id + '">' + value.name + '</option>';
                    });
                    select.append(option);
                }
            });
        };
</script>

@endsection

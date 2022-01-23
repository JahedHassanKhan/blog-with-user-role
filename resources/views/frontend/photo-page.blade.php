@extends('frontend-master')

@section('title')
All Photo
@endsection

@section('body')
<div class="page_header header_image box_overlay d-flex align_items_center justify_content_center pafebg1">


    <h1 class="cat_title">Photos</h1>

    <div class="breadcrumbs">
        <ul class="page-list">
            <li class="first-item">
                <a href="{{route('/')}}">Home</a>
            </li>
            <li><i class="icon-right-open-big"></i></li>
            <li>Photos</li>
        </ul>
    </div>

</div>
<!--END Page header-->

<div class="page_container_wrapper">
    <div class="mb-4">
        {{ $photos->links('frontend.includes.pagination') }}
    </div>
    <div class="container-fluid">
        <div class="filter_image_btns text-center">
            <button type="button" class="filter active all" data-group="all">All</button>
            @foreach($photoCategories as $photoCategory)
            <button type="button" class="filter" data-group="{{$photoCategory->slug}}">{{$photoCategory->name}}</button>
            @endforeach
        </div>
        <div class="row shuffle_photos">
            @foreach($photos as $photo)
            <div class="col-sm-4 col-md-3 no_padding shuffle_photos_item" data-groups=["{{$photo->photoCategory->slug}}"]>
                <a href="{{asset('/')}}{{$photo->image}}" class="popupimg_gall hover_light">
                    <img src="{{asset('/')}}{{$photo->image}}" alt="" style="width: 100%; height: 350px">
                </a>
            </div>
            @endforeach
        </div>
        <div>
            {{ $photos->links('frontend.includes.pagination') }}
        </div>
        {{-- <div class="row shuffle_photos">
            @foreach($posts as $result)
            <div class="col-sm-4 col-md-3 no_padding shuffle_photos_item" data-groups=[@foreach($result->categories as $category){{$loop->last ? '"'.$category->category_name.'"' : '"'.$category->category_name.'",'}}@endforeach]>
                <a href="{{asset('/')}}{{$result->post_image}}" class="popupimg_gall hover_light">
                    <img src="{{asset('/')}}{{$result->post_image}}" alt="" style="width: 100%; height: 350px">
                </a>
            </div>
            @endforeach
        </div> --}}
    </div>
</div>


{{-- <div class="page_container_wrapper">
    <div class="container-fluid">
        <div class="filter_image_btns text-center">
            <button type="button" class="filter active all" data-group="all">All</button>
            @foreach($photoCategories as $category)
            <button type="button" class="filter" data-group="{{$category->name}}">{{$category->name}}</button>
@endforeach
</div>
<div class="row shuffle_photos">
    @foreach($photos as $post)
    <div class="col-sm-4 col-md-3 no_padding shuffle_photos_item" data-groups=[@foreach($post->categories as $postCategory)
        {{ $postCategory->category_name }}
        @continue
        @endforeach"]>
        <a href="{{asset('/')}}{{$post->post_image}}" class="popupimg_gall hover_light">
            <img src="{{asset('/')}}{{$post->post_image}}" alt="">
        </a>
    </div>
    @endforeach
</div>
</div>
</div> --}}


@endsection

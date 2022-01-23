@extends('frontend-master')

@section('title')
{{$category->name}}
@endsection

@section('body')
<!--Category header-->
<div class="category_header header_image box_overlay d-flex align_items_center justify_content_center" style="background-image: url({{asset('/')}}{{$category->category_image}})">


    <h1 class="cat_title">{{$category->name}}</h1>

    <div class="breadcrumbs">
        <ul class="page-list">
            <li class="first-item">
                <a href="{{route('/')}}">Home</a>
            </li>
            <li><i class="icon-right-open-big"></i></li>
            <li>
                @if ($category->main_category == 1)
                Bangla
                @elseif($category->main_category == 2)
                English
                @elseif($category->main_category == 3)
                Norwegian
                @endif</li>
            <li><i class="icon-right-open-big"></i></li>
            <li>{{$category->name}}</li>
        </ul>
    </div>

</div>
<!--END Category header-->

<div class="page_container_wrapper">

    <div class="container-fluid no_padding">
        @for ($i = 1; $i <= round($posts->count()/2); $i++)
            <div class="blog_list_post clearfix">
                @foreach($posts as $key=>$post)
                @if($key < $i*2-2 || $key>= $i*2)
                    @continue
                    @endif
                    <!--Post Box-->
                    <div class="blog_post_box clearfix">
                        <div class="blog_post_item">
                            <h2 class="post_name">
                                <a href="{{route('blogPost', $post)}}">{{$post->title}}</a>
                            </h2>
                            <div class="post_data">
                                <span class="category">
                                    @foreach($post->categories as $postCategory)
                                    @if($loop->last)
                                    {{ $postCategory->name }}
                                    @else
                                    {{ $postCategory->name  }} |
                                    @endif
                                    @endforeach
                                </span>
                                <span class="comments_count"><i class="fas fa-comments"></i> {{$post->replies->count()}}</span>
                                <span class="reviews_count"><i class="fas fa-eye"></i> {{$post->postView->count()}}</span>
                            </div>
                            <div>
                                @if ($post->admin_id)
{{--                                <span class="reviews_count">by <a href="">{{$post->admin->name}}</a></span>--}}
{{--                                @elseif ($post->user_id)--}}
                                <span class="reviews_count">by <a href="">{{$post->createdBy->name}}</a></span>
{{--                                @endif--}}
                            </div>
                            <div class="short_desc_post">
                                <p>
                                    {!! \Illuminate\Support\Str::limit(htmlspecialchars(trim(strip_tags($post->body))), 250, ' ....') !!}
                                </p>
                            </div>
                            <div class="seea_more">
                                <a href="{{route('blogPost', $post)}}">View More <i class="icon-right-open-big"></i></a>
                            </div>
                        </div>
                        <div class="blog_post_item_image" style="background-image: url({{asset('/')}}{{$post->post_image}})">
                            <div class="post_data_cr">
                                <span class="day">{{ $post->created_at->format('d') }}</span>
                                <div class="month">{{ $post->created_at->format('M') }}</div>
                                <div class="year">{{ $post->created_at->format('Y') }}</div>
                            </div>
                            <a href="{{route('blogPost', $post)}}" class="post_link_image">
                                <img src="{{asset('/')}}frontend/assets/images/postimagebox.png" alt="">
                            </a>
                        </div>
                    </div>
                    <!--END Post Box-->
                    @endforeach
            </div>
            @endfor
    </div>

    {{-- <div class="text-center btn_loadmore">--}}

    {{-- <a href="#" class="btn_gurd btn_gurd_trp btn_gurd_i loadmore_btn">Load More <i class="fas fa-spinner"></i></a>--}}

    {{-- </div>--}}

    {{ $posts->links('frontend.includes.pagination') }}

</div>

@endsection

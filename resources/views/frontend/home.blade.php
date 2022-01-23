@extends('frontend-master')

@section('title')
Home
@endsection

@section('body')

<!--Big SLider-->
<div class="main_slider_post_cat">
    <div class="lateps_postslides">
        <div class="latestposts_slider owl-carousel">
            @foreach($sliderPosts as $sliderPost)
            <!--Slider Latest Post-->
            <div class="item" style="background-image: url({{asset('/')}}{{$sliderPost->post_image}})">
                <div class="post_data_cr">
                    <span class="day">{{ $sliderPost->created_at->format('d') }}</span>
                    <div class="month">{{ $sliderPost->created_at->format('M') }}</div>
                    <div class="year">{{ $sliderPost->created_at->format('Y') }}</div>
                </div>
                <div class="post_info_wrapper">
                    <h2 class="post_name">{{$sliderPost->title}}</h2>
                    <div class="short_desc_post">
                        {{-- <p class="for-mobile">--}}
                        {{-- {!! \Illuminate\Support\Str::limit(htmlspecialchars(trim(strip_tags($sliderPost->post_body))), 150, '  ....') !!}--}}
                        {{-- </p>--}}
                        <p class="for-pc">
                            {!! \Illuminate\Support\Str::limit(htmlspecialchars(trim(strip_tags($sliderPost->body))), 200, ' ....') !!}
                        </p>
                    </div>
                    <div class="seea_more">
                        <a href="{{route('blogPost', $sliderPost)}}">View More <i class="icon-right-open-big"></i></a>
                    </div>
                </div>
                <img src="{{asset('/')}}frontend/assets/images/postimagebox.png" alt="">
            </div>
            <!--END Slider Latest Post-->
            @endforeach
        </div>
    </div>
    <div class="categories_wrapper">
        <div class="categories_slides owl-carousel">
            @for($j=1; $j <= ($categories->count()%2 == 0 ? $categories->count()/2 : ($categories->count()+1)/2); $j++)
                <div class="item">
                    {{-- @foreach($categories->chunk($categories->count()) as $chunk)--}}
                    {{-- @foreach($chunk as $key=>$category)--}}
                    @foreach($categories as $key=>$category)
                    @if($key < $j*2-2 || $key>= $j*2)
                        @continue
                        @endif
                        <div class="category_box" style="background-image: url({{asset($category->category_image)}})">
                            <a href="{{route('categoryPost', [$category, $category->main_category])}}">
                                <img src="{{asset('/')}}frontend/assets/images/postimagebox.png" alt="">
                                <span class="name_cat">{{$category->name}}</span>
                            </a>
                        </div>
                        @endforeach
                        {{-- @endforeach--}}
                        {{-- // By using chunk it also work.--}}
                </div>
            @endfor
        </div>
    </div>
</div>

<!--END Big SLider-->
<div class="page_container_wrapper">
    <div class="container-fluid no_padding scrollanimation" data-animation="fadeIn" data-timeout="200">
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
{{--                                <span class="comments_count"><i class="fas fa-comments"></i> {{$post->replies->count()}}</span>--}}
{{--                                <span class="reviews_count"><i class="fas fa-eye"></i> {{$post->postView->count()}}</span>--}}
                            </div>
                            <div>
                                <span class="reviews_count">by <a href="">{{$post->createdBy->name}}</a></span>
                            </div>
                            <div class="short_desc_post">
                                <p>
                                    {!! \Illuminate\Support\Str::limit(htmlspecialchars(trim(strip_tags($post->post_body))), 250, ' ....') !!}
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

    {{ $posts->links('frontend.includes.pagination') }}

    {{-- <div class="text-center btn_loadmore">--}}

    {{-- <a href="#" class="btn_gurd btn_gurd_trp btn_gurd_i loadmore_btn">Load More <i--}}
    {{-- class="fas fa-spinner"></i></a>--}}

    {{-- </div>--}}

    <!--Pagination-->
    <!--div class="text-center">
            <nav class="page_pagination_wrapper margin50_0_0_0">
                <ul class="page-numbers">
                    <li><a class="prev page-numbers" href="#"><i class="icon-left-open-big"></i></a></li>
                    <li><span aria-current="page" class="page-numbers current">1</span></li>
                    <li><a class="page-numbers" href="#">2</a></li>
                    <li><a class="page-numbers" href="#">3</a></li>
                    <li><a class="next page-numbers" href="#"><i class="icon-right-open-big"></i></a></li>
                </ul>
            </nav>
        </div-->
    <!--END Pagination-->

</div>

@endsection

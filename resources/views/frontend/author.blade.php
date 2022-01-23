@extends('frontend-master')

@section('title')
    Author
@endsection

@section('body')
    <div class="page_container_wrapper">

        <div class="container no_padding">

            <div class="row">
                <div class="col-lg-3">

                    <div class="author_card clearfix">

                        <div class="author_card_imag_name">

                            <div class="author_card_imag">
                                <img src="{{asset('/')}}{{$user->admin->adminInformation->image ?? 'default-image/avatar.png'}}" alt="">
                            </div>

                            <div class="author_name">{{$user->name}}</div>

                            <div class="author_articles">{{$posts->count()}} Articles</div>

                            <div class="author_socials">
{{--                                @if()--}}
                                <a href=""><span class="icon-facebook"></span></a>
{{--                                @endif--}}
{{--                                @if()--}}
                                <a href=""><span class="icon-twitter"></span></a>
{{--                                @endif--}}
                            </div>

                        </div>

                        <div class="short_autord_desc">
                            <h5 class="author_about">About</h5>
                            <p>about me</p>
                        </div>

                    </div>

                </div>
                <div class="col-lg-9">
                    @foreach($posts as $key=>$post)
                        <div class="blog_list_post one_col_post clearfix">
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
{{--                                        <span class="comments_count"><i class="fas fa-comments"></i> {{$post->replies->count()}}</span>--}}
{{--                                        <span class="reviews_count"><i class="fas fa-eye"></i> {{$post->postView->count()}}</span>--}}
                                    </div>
                                    <div class="short_desc_post">
                                        <p>
                                            {!! \Illuminate\Support\Str::limit(htmlspecialchars(trim(strip_tags($post->body))), 250, '  ....') !!}
                                        </p>
                                    </div>
                                    <div class="seea_more">
                                        <a href="{{route('blogPost', $post)}}">View More <i
                                                class="icon-right-open-big"></i></a>
                                    </div>
                                </div>
                                <div class="blog_post_item_image"
                                     style="background-image: url({{asset('/')}}{{$post->post_image}})">
                                    <div class="post_data_cr">
                                        <span class="day">{{ $post->created_at->format('d') }}</span>
                                        <div class="month">{{ $post->created_at->format('M') }}</div>
                                        <div class="year">{{ $post->created_at->format('Y') }}</div>
                                    </div>
                                    <a href="{{route('blogPost', $post->id)}}" class="post_link_image">
                                        <img src="{{asset('/')}}frontend/assets/images/postimagebox.png" alt="">
                                    </a>
                                </div>
                            </div>
                            <!--END Post Box-->
                        </div>
                    @endforeach
                        {{ $posts->links('frontend.includes.pagination') }}
{{--                    <div class="text-center btn_loadmore">--}}
{{--                        <a href="#" class="btn_gurd btn_gurd_trp btn_gurd_i loadmore_btn">Load More <i class="fas fa-spinner"></i></a>--}}
{{--                    </div>--}}
                </div>

            </div>

        </div>


    </div>

@endsection

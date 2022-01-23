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
{{--                    <p class="for-mobile">--}}
{{--                        {!! \Illuminate\Support\Str::limit(htmlspecialchars(trim(strip_tags($sliderPost->post_body))), 150, '  ....') !!}--}}
{{--                    </p>--}}
                    <p class="for-pc">
                        {!! \Illuminate\Support\Str::limit(htmlspecialchars(trim(strip_tags($sliderPost->body))), 200, '  ....') !!}
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

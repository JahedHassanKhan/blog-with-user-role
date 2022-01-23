<div class="float_bar" id="float_bar_site">
    <div class="float_bar_inner">
        <div class="float_bar_over_wrapp">

            <!--Widget-->
            <div class="sidebar_block float_sidebar_widget">
                <div class="widget_recent_image">
                    <h4 class="widget_title">Latest Posts</h4>
                    <div class="widget_recent_post">
                        <ul>
                            @foreach($allPosts as $p)
                                <li>
                                    <div class="post_thumb">
                                        <a href="{{route('blogPost', $p)}}">
                                            <img src="{{asset('/')}}{{$p->image}}" alt="">
                                        </a>
                                    </div>
                                    <h6 class="post_name"><a href="{{route('blogPost', $p)}}">{{$p->title}}</a></h6>
                                    <div class="post_data_recent">
                                        <div class="post_data"><i class="fas fa-clock"></i> {{ $p->created_at->isoFormat('D MMM YYYY')}}</div>
                                    </div>
                                </li>
                                @if($loop->iteration == 3)
                                    @break
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div><!--END Widhet-->

            <!--Widhet-->
            <div class="sidebar_block float_sidebar_widget">
                <h4 class="widget_title">Search</h4>
                <div class="widget_search">
                    <form id="searchform" class="searchform" action="{{route('/')}}" method="get">
                        <input type="text" placeholder="Search" required name="term">
                        <button type="submit" class="search-submit btn_gurd"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </div><!--END Widhet-->
            <!--Widhet-->
            <div class="sidebar_block float_sidebar_widget widget_categories">
                <h4 class="widget_title">Categories</h4>
                <ul>
                    @foreach($categories as $category)
                        <li><a href="{{route('categoryPost', [$category, $category->main_category])}}">{{$category->name}}</a></li>
                    @endforeach
                </ul>
            </div><!--END Widhet-->
            <!--Widhet-->
            <div class="sidebar_block float_sidebar_widget">
                <h4 class="widget_title">Subscribe</h4>
                <div class="wp_subscribe">
                    <form action="#">
                        <input type="text" name="email" placeholder="Your email" required>
                        <button class="btn_gurd"><i class="fas fa-envelope"></i></button>
                    </form>
                </div>
            </div><!--END Widhet-->
        </div>
        <button class="close_float_sidebar" type="button" data-target="#float_bar_site">
            <i class="navbar-toggler-icon"><i class="icon-delete-cross"></i></i>
        </button>
    </div>
    <div class="cover_float_sidebar" data-target="#float_bar_site"></div>
</div>

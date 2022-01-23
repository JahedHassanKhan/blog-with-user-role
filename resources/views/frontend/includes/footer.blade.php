<footer class="mainfooter">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="footer_block">
                    <h4 class="widget_title">About Blog</h4>
                    <div class="textwidget text-justify">
                        @if(!empty($company->about_blog))
                        {!! $company->about_blog !!}
                        @endif
                    </div>
                </div>
            </div>
           {{-- <div class="col-md-6 col-lg-2">--}}
{{--                <div class="footer_block widget_tag_cloud">--}}
{{--                    <h4 class="widget_title">Tags</h4>--}}
{{--                    <div class="tagcloud">--}}
{{--                        @foreach($tags as $tag)--}}
{{--                            <a>{{$tag->tag_name}}</a>--}}
{{--                        @endforeach--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div> --}}
            <div class="col-md-6 col-lg-6">
                <div class="row">
                    <div class="col-md-4">
                        <div class="footer_block widget_categories">
                            <h4 class="widget_title">Bangla</h4>
                            <ul>
                                @foreach($banglaCategories as $category)
                                    <li><a href="{{route('categoryPost', [$category, $category->main_category])}}">{{$category->name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="footer_block widget_categories">
                            <h4 class="widget_title">English</h4>
                            <ul>
                                @foreach($englishCategories as $category)
                                    <li><a href="{{route('categoryPost', [$category, $category->main_category])}}">{{$category->name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="footer_block widget_categories">
                            <h4 class="widget_title">Norwegian</h4>
                            <ul>
                                @foreach($norwegianCategories as $category)
                                    <li><a href="{{route('categoryPost', [$category, $category->main_category])}}">{{$category->name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="footer_block">
                    <h4 class="widget_title">Subscribe</h4>
                    <div class="wp_subscribe">
                        <form action="#">
                            <input type="text" name="email" placeholder="Your email" required>
                            <button class="btn_gurd"><i class="icon-mail-alt"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="socials_footer">
            <a href="{{$company->fb_link ?? '#'}}"><span class="icon-facebook"></span></a>
            <a href="{{$company->twitter_link ?? '#'}}"><span class="icon-twitter"></span></a>
            <a href="{{$company->linked_link ?? '#'}}"><span class="icon-linkedin"></span></a>
        </div>
        <div class="text-center">
            <span class="icon-mail text-danger mr-2"></span><span>{{$company->email ?? '#'}}</span>
        </div>
        <div class="site_copy">
            <p class="">© <script>
                    document.write(new Date().getFullYear())
                </script> All Right Resurved @ExileMemoir.</p>
        </div>


    </div>
</footer>

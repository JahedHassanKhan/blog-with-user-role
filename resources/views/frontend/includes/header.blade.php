<header class="main_header fixed_header">
    <div class="container-fluid no_padding clearfix">

        <div class="logo_head">
            <a href="{{route('/')}}">
                <img src="{{asset('/')}}{{$company->logo_one ?? ''}}" alt="LOGO">
                {{-- <span class="text-dark">&#x273E; ExileMemoir</span> --}}
            </a>
        </div>
        <div class="righthead_block">
            <div class="navbar-expand-lg nav_btn_toggle">
                <button class="navbar-toggler open_mobile_menu" type="button" data-target="#mobile_nav">
                    <span class="butline"></span>
                    <span class="butline"></span>
                    <span class="butline"></span>
                </button>
            </div>
            <nav class="top_nav_links navbar navbar-expand-lg">
                <div class="collapse navbar-collapse" id="topNav">
                    <ul class="navbar-nav mr-auto">
                        <li class="{{ Route::is('/') ? 'current-menu-item' : '' }}"><a href="{{route('/')}}"><span>Home</span></a></li>
                        <li class="{{ request()->is('category/*/1') ? 'current-menu-item' : '' }} menu-item-has-children">
                            <a href="#"><span>Bangla</span></a>
                            @if($banglaCategories->count() > 0)
                            <ul class="sub-menu">
                                @foreach($banglaCategories as $category)
                                <li><a href="{{route('categoryPost', [$category, $category->main_category])}}"><span>{{$category->name}}</span></a></li>
                                @endforeach
                            </ul>
                            @endif
                        </li>
                        <li class="{{ request()->is('category/*/2') ? 'current-menu-item' : '' }} menu-item-has-children">
                            <a href="#"><span>English</span></a>
                            @if($englishCategories->count() > 0)
                            <ul class="sub-menu">
                                @foreach($englishCategories as $category)
                                <li><a href="{{route('categoryPost', [$category, $category->main_category])}}"><span>{{$category->name}}</span></a></li>
                                @endforeach
                            </ul>
                            @endif
                        </li>
                        <li class="{{ request()->is('category/*/3') ? 'current-menu-item' : '' }} menu-item-has-children">
                            <a href="#"><span>Norwegian</span></a>
                            @if($norwegianCategories->count() > 0)
                            <ul class="sub-menu">
                                @foreach($norwegianCategories as $category)
                                <li><a href="{{route('categoryPost', [$category, $category->main_category])}}"><span>{{$category->name}}</span></a></li>
                                @endforeach
                            </ul>
                            @endif
                        </li>
                        <li class="menu-item-has-children {{ Route::is('photoPage') ? 'current-menu-item' : '' }}">
                            <a href="{{route('photoPage')}}"><span>Gallery</span></a>
                        </li>
                        @if(auth()->user())
                        <li class="menu-item-has-children">
                            <a href="{{route('dashboard')}}"><span>{{auth()->user()->name}}</span></a>
                            <ul class="sub-menu">
                                <form method="POST" action="{{ route('logout') }}" id="logoutForm" style="display: none">
                                    @csrf
                                </form>
                                <li>
                                    <a href="" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
                                        <span>Log Out</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @else
                        <li class=""><a href="{{route('login')}}"><span>Login</span></a></li>
                        <li class=""><a href="{{ route('register') }}"><span>Signup</span></a></li>
                        @endif
                    </ul>
                </div>
            </nav>
            <div class="search_btn"><a href="#" data-target="#search_widow" class="search_show"><i class="fas fa-search"></i></a></div>
            <div class="sidebar_btn"><a href="#" data-target="#float_bar_site" class="floatsidebar_show"><i class="fas fa-bars"></i></a></div>
        </div>
    </div>
</header>

<div class="mobile_nav" id="mobile_nav">
    <div class="mobile_nav_inner">
        <div class="mobile_nav_inner_wrapp">
            <ul>
                <li class="current-menu-item"><a href="{{route('/')}}"><span>Home</span></a></li>
                <li class="menu-item-has-children">
                    <a href="#"><span>Bangla</span></a>
                    @if($banglaCategories->count() > 0)
                    <ul class="sub-menu">
                        @foreach($banglaCategories as $category)
                            <li><a href="{{route('categoryPost', [$category, $category->main_category])}}"><span>{{$category->name}}</span></a></li>
                        @endforeach
                    </ul>
                    @endif
                </li>
                <li class="menu-item-has-children">
                    <a href="#"><span>English</span></a>
                    @if($englishCategories->count() > 0)
                        <ul class="sub-menu">
                            @foreach($englishCategories as $category)
                                <li><a href="{{route('categoryPost', [$category, $category->main_category])}}"><span>{{$category->name}}</span></a></li>
                            @endforeach
                        </ul>
                    @endif
                </li>
                <li class="menu-item-has-children">
                    <a href="#"><span>Norwegian</span></a>
                    @if($norwegianCategories->count() > 0)
                        <ul class="sub-menu">
                            @foreach($norwegianCategories as $category)
                                <li><a href="{{route('categoryPost', [$category, $category->main_category])}}"><span>{{$category->name}}</span></a></li>
                            @endforeach
                        </ul>
                    @endif
                </li>
                <li class="current-menu-item">
                    <a href="{{route('photoPage')}}"><span>Gallery</span></a>
                </li>
                @if(auth()->user())
                <li class="menu-item-has-children">
                    <a href="{{route('dashboard')}}"><span>{{auth()->user()->name}}</span></a>
                    <ul class="sub-menu">
                        <form method="POST" action="{{ route('logout') }}" id="logoutFormMobile" style="display: none">
                            @csrf
                        </form>
                        <li>
                            <a href="#" class="text-danger pointer" onclick="event.preventDefault(); document.getElementById('logoutFormMobile').submit();">
                                <span>LogOut</span>
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
    </div>
    <div class="cover_mobile_menu" data-target="#mobile_nav"></div>
</div>

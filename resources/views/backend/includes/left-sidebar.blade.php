<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{route('dashboard')}}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-store"></i>
                        <span>Manage User</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @foreach($userRoutes as $userRoute)
                            @if($userRoute == 'user-list')
                                <li><a href="{{route('user-list')}}">User List</a></li>
                            @endif
                        @endforeach
                        @foreach($userRoutes as $userRoute)
                            @if($userRoute == 'banned-user-list')
                                <li><a href="{{route('banned-user-list')}}">Banned User List</a></li>
                            @endif
                        @endforeach
                        @foreach($userRoutes as $userRoute)
                            @if($userRoute == 'role.index')
                                <li><a href="{{route('role.index')}}" class="" key="t-horizontal">Manage Role</a></li>
                            @endif
                        @endforeach
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-store"></i>
                        <span>Site Settings</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @foreach($userRoutes as $userRoute)
                            @if($userRoute == 'category.index')
                                <li><a href="{{route('category.index')}}">Category</a></li>
                            @endif
                        @endforeach
{{--                        <li><a href="{{route('tag.index')}}">Tag</a></li>--}}
{{--                        <li><a href="{{route('company')}}">Site Info</a></li>--}}
                    </ul>
                </li>
{{--                <li>--}}
{{--                    <a href="javascript: void(0);" class="has-arrow waves-effect">--}}
{{--                        <i class="bx bx-store"></i>--}}
{{--                        <span>Gallery</span>--}}
{{--                    </a>--}}
{{--                    <ul class="sub-menu" aria-expanded="false">--}}
{{--                        <li><a href="{{route('photo-category.index')}}">Photo Category</a></li>--}}
{{--                        <li><a href="{{route('photo.index')}}">Photo</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="javascript: void(0);" class="has-arrow waves-effect">--}}
{{--                        <i class="bx bx-detail"></i>--}}
{{--                        <span>Blog</span>--}}
{{--                    </a>--}}
{{--                    <ul class="sub-menu" aria-expanded="false">--}}
{{--                        <li><a href="{{route('post.index')}}">All Post</a></li>--}}
{{--                        <li><a href="{{route('post.create')}}">Create New Post</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>

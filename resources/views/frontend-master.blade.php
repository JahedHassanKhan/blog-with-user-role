<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.includes.head')
    <style>
        :root {
            --site-color: {{$company->company_color ?? "#fecb2f"}};
        }
    </style>
</head>

<body class="bodypadding">

    <!--ScrollTop Btn-->
    <div class="scroll_up gutengard_btn"><i class="icon-up-open-big"></i></div>
    <!--END ScrollTop Btn-->

    <!--Mobile Menu-->
    @include('frontend.includes.mobile-menu')
    <!--END Mobile Menu-->

    <!--Search-->
    @include('frontend.includes.search')
    <!--END Search-->

    <!--Float Sidebar-->
    @include('frontend.includes.right-sidebar')
    <!--END Float Sidebar-->
    <!-- main header -->
    @include('frontend.includes.header')
    <!--END main header -->

    @yield('body')


    {{--<div class="before_footer_area">--}}

    {{-- <div class="container-fluid no_padding">--}}

    {{-- <!--Widhet-->--}}
    {{-- <div class="sidebar_block float_sidebar_widget">--}}
    {{-- <div class="instagram-fee">--}}
    {{-- <ul class="instagram-pics instagram-size-large">--}}
    {{-- <li>--}}
    {{-- <a href="{{asset('/')}}frontend/{{asset('/')}}frontend/{{asset('/')}}frontend/assets/images/instthumblarge1.jpg" class="popupimg hover_light scrollanimation" data-animation="fadeInUp" data-timeout="200"><img src="assets/images/instthumblarge1.jpg" alt=""></a>--}}
    {{-- </li>--}}
    {{-- <li>--}}
    {{-- <a href="{{asset('/')}}frontend/{{asset('/')}}frontend/assets/images/instthumblarge2.jpg" class="popupimg hover_light scrollanimation" data-animation="fadeInUp" data-timeout="300"><img src="assets/images/instthumblarge2.jpg" alt=""></a>--}}
    {{-- </li>--}}
    {{-- <li>--}}
    {{-- <a href="{{asset('/')}}frontend/{{asset('/')}}frontend/assets/images/instthumblarge3.jpg" class="popupimg hover_light scrollanimation" data-animation="fadeInUp" data-timeout="400"><img src="assets/images/instthumblarge3.jpg" alt=""></a>--}}
    {{-- </li>--}}
    {{-- <li>--}}
    {{-- <a href="{{asset('/')}}frontend/{{asset('/')}}frontend/assets/images/instthumblarge4.jpg" class="popupimg hover_light scrollanimation" data-animation="fadeInUp" data-timeout="500"><img src="assets/images/instthumblarge4.jpg" alt=""></a>--}}
    {{-- </li>--}}
    {{-- <li>--}}
    {{-- <a href="{{asset('/')}}frontend/{{asset('/')}}frontend/assets/images/instthumblarge5.jpg" class="popupimg hover_light scrollanimation" data-animation="fadeInUp" data-timeout="600"><img src="assets/images/instthumblarge5.jpg" alt=""></a>--}}
    {{-- </li>--}}

    {{-- </ul>--}}
    {{-- </div>--}}
    {{-- </div><!--END Widhet-->--}}

    {{-- </div>--}}

    {{--</div>--}}

    @include('frontend.includes.footer')


    <!-- JS -->
    <!--jQuery 1.12.4 google link-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!--Bootstrap 4.1.0-->
    <script src="{{asset('/')}}frontend/assets/libs/bootstrap-4.1.0/bootstrap.min.js"></script>
    <!--jquery.magnific-popup-->
    <script src="{{asset('/')}}frontend/assets/libs/jquery.magnific-popup/jquery.magnific-popup.min.js"></script>
    <!--OWL Carousel-->
    <script src="{{asset('/')}}frontend/assets/libs/owlcarousel2-2.3.4/owl.carousel.min.js"></script>
    <!--Іhuffle-->
    <script src="{{asset('/')}}frontend/assets/libs/shuffle/shuffle.min.js"></script>
    <!--Custom js-->
    <script src="{{asset('/')}}frontend/assets/js/custom.js"></script>

</body>

</html>

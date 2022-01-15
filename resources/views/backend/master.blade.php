<!doctype html>
<html lang="en">
<head>
    @include('backend.includes.head')
</head>

<body data-sidebar="dark">
<!-- Begin page -->
<div id="layout-wrapper">
    @include('backend.includes.header')
    <!-- ========== Left Sidebar Start ========== -->
    @include('backend.includes.left-sidebar')
    <!-- Left Sidebar End -->
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                @yield('breadcrumb')

                @yield('body')

            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <!-- Transaction Modal -->
        @yield('page-model')
        <!-- end modal -->

        @include('backend.includes.footer')
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->


@include('backend.includes.core-js')
</body>
</html>






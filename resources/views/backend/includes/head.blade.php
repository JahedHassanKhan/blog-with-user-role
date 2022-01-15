
<meta charset="utf-8" />
<title>
    @yield('title')
</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
<meta content="Themesbrand" name="author" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- App favicon -->
<link rel="shortcut icon" href="{{asset('/dashboard')}}backend/assets/images/favicon.ico">

@yield('page-required-css')

<!-- Summernote css -->
<link href="{{asset('/')}}backend/assets/libs/summernote/summernote-lite.min.css" rel="stylesheet" type="text/css" />

<link href="{{asset('/')}}backend/assets/css/style.css" id="app-style" rel="stylesheet" type="text/css" />

<!-- DataTables -->
<link href="{{asset('/')}}backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="{{asset('/')}}backend/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<!-- Responsive datatable examples -->
<link href="{{asset('/')}}backend/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<link href="{{asset('/')}}backend/file-upload/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
<link href="{{asset('/')}}backend/file-upload/themes/explorer-fas/theme.css" media="all" rel="stylesheet" type="text/css"/>

<link href="{{asset('/')}}backend/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

<!-- Dropify Css -->
<link href="{{asset('/')}}backend/dropify/css/dropify.css" rel="stylesheet" type="text/css" />
<!-- Bootstrap Css -->
<link href="{{asset('/')}}backend/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="{{asset('/')}}backend/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="{{asset('/')}}backend/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
<script src="{{asset('/')}}backend/assets/libs/jquery/jquery.min.js"></script>


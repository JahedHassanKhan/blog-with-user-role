<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Register | To Continue to your account</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap Css -->
    <link href="{{asset('/')}}backend/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('/')}}backend/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('/')}}backend/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
</head>

<body class="bg-dark">
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="bg-primary bg-soft">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary">Signup to create an account!</h5>
                                    </div>
                                </div>
                                <div class="col-5 align-self-end">
                                    <img src="{{asset('/')}}backend/assets/images/profile-img.png" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="p-2">
                                <form class="needs-validation" novalidate action="{{route('register')}}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        @if($errors->has('name'))
                                            <span class="text-danger"><strong>{{ $errors->first('name') }}</strong></span>
                                        @endif
                                        <label for="name" class="form-label">User Name</label>
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter User Name" required>
                                        <div class="invalid-feedback">
                                            Please Enter name
                                        </div>
                                    </div>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                    @endif
                                    <div class="mb-3">
                                        <label for="useremail" class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" id="useremail" placeholder="Enter email" required>
                                        <div class="invalid-feedback">
                                            Please Enter Email
                                        </div>
                                    </div>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                    @endif
                                    <div class="mb-3">
                                        <label for="userpassword" class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password" id="userpassword" placeholder="Enter password" required>
                                        <div class="invalid-feedback">
                                            Please Enter Password
                                        </div>
                                    </div>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="text-danger">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </span>
                                    @endif
                                    <div class="mb-3">
                                        <label for="Confirmpassword" class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" id="Confirmpassword" name="password_confirmation" placeholder="Enter password again" required>
                                        <div class="invalid-feedback">
                                            Please Enter Password again
                                        </div>
                                    </div>
                                    <div class="mt-4 d-grid">
                                        <button class="btn btn-primary waves-effect waves-light" type="submit">Sign Up</button>
                                    </div>
                                    <div class="mt-3 text-center">
                                        <p>Already have an account ? <a href="{{route('login')}}" class="fw-medium text-primary">Login</a> </p>
                                    </div>
                                    <div class="mt-3 text-center">
                                        <h5 class="font-size-14 mb-3">Or Signin using</h5>
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
{{--                                                <a href="{{route('social.login',['driver'=>'facebook'])}}" class="social-list-item bg-primary text-white border-primary">--}}
                                                    <i class="mdi mdi-facebook"></i>
{{--                                                </a>--}}
                                            </li>
                                            {{-- <li class="list-inline-item">
                                                <a href="javascript::void()" class="social-list-item bg-info text-white border-info">
                                                    <i class="mdi mdi-twitter"></i>
                                                </a>
                                            </li> --}}
                                            <li class="list-inline-item">
{{--                                                <a href="{{route('social.login',['driver'=>'google'])}}" class="social-list-item bg-danger text-white border-danger">--}}
                                                    <i class="mdi mdi-google"></i>
{{--                                                </a>--}}
                                            </li>
                                        </ul>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        <div>
                            <p class="text-white">© <script>
                                    document.write(new Date().getFullYear())
                                </script> All Right Resurved exilememoir.com <i class="mdi mdi-heart text-danger"></i></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="{{asset('/')}}backend/assets/libs/jquery/jquery.min.js"></script>
    <script src="{{asset('/')}}backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('/')}}backend/assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="{{asset('/')}}backend/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="{{asset('/')}}backend/assets/libs/node-waves/waves.min.js"></script>

    <!-- validation init -->
    <script src="{{asset('/')}}backend/assets/js/pages/validation.init.js"></script>

    <!-- App js -->
    <script src="{{asset('/')}}backend/assets/js/app.js"></script>

</body>

</html>

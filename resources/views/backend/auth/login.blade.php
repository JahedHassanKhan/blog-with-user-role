<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Login | To your account</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap Css -->
    <link href="{{asset('/')}}backend/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('/')}}backend/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('/')}}backend/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
</head>

<body class="bg-dark">
    {{-- UserLogin --}}
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="bg-primary bg-soft">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary">Welcome Back!</h5>
                                        <p>Please Login to continue to Your account.</p>
                                    </div>
                                </div>
                                <div class="col-5 align-self-end">
                                    <img src="{{asset('/')}}backend/assets/images/profile-img.png" alt="Login Banner" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="p-2">
                                <form class="form-horizontal" action="{{ route('login') }}" method="POST">
                                    @csrf
                                    @if ($errors->has('email'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Email</label>
                                        <input type="email" name="email" :value="old('email')" required autofocus class="form-control" id="username" placeholder="Enter your email">
                                    </div>
                                    @if ($errors->has('password'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <div class="input-group auth-pass-inputgroup">
                                            <input type="password" name="password" required autocomplete="current-password" class="form-control" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon">
                                            <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                        </div>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="remember-check">
                                        <label class="form-check-label" for="remember-check">
                                            Remember me
                                        </label>
                                    </div>
                                    <div class="mt-3 d-grid">
                                        <button class="btn btn-primary waves-effect waves-light" type="submit">Login</button>
                                    </div>
                                    <div class="mt-3 text-center">
                                        <p>Do not have an account? <a href="{{route('register')}}" class="fw-medium text-primary">SignUp</a> </p>
                                    </div>
                                    <div class="mt-3 text-center">
                                        <h5 class="font-size-14 mb-3">Or SignIn using</h5>
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
{{--                                                <a href="{{route('social.login',['driver'=>'facebook'])}}" class="social-list-item bg-primary text-white border-primary">--}}
                                                    <i class="mdi mdi-facebook"></i>
{{--                                                </a>--}}
                                            </li>
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
    <!-- end UserLogin -->
    @include('backend.includes.core-js')
</body>

</html>

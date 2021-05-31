<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('assets/css/lib/weather-icons.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/lib/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/lib/owl.theme.default.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/lib/font-awesome.min.css') }}">
        <!-- <link rel="stylesheet" href="{{ asset('assets/font-awesome.min.css') }}"> -->
        <link rel="stylesheet" href="{{ asset('assets/css/lib/themify-icons.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/lib/menubar/sidebar.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/lib/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/lib/helper.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    </head>

<body class="bg-primary">

    <div class="unix-login">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="login-content">
                        <!-- <div class="login-logo">
                            <a href="index-2.html"><span>Focus</span></a>
                        </div> -->
                        <div class="login-form">
                            <h4> {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</h4>
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <div class="form-group">
                                    <label>Email address</label>
                                    <input id="email" type="email" name="email" value="{{old('email')}}" required autofocus class="form-control" placeholder="Email">
                                </div>
                                <button type="submit" class="btn btn-primary btn-flat m-b-15">{{ __('Email Password Reset Link') }}</button>
                                <div class="register-link text-center">
                                    <p>Back to <a href="{{ route('login') }}"> Login</a></p>
                                </div>
                            </form>

                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
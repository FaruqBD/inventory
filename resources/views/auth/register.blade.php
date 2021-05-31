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
                <div class="col-lg-4">
                    <div class="login-content">
                        <!-- <div class="login-logo">
                            <a href="index-2.html"><span>Focus</span></a>
                        </div> -->
                        <div class="login-form">
                            <div class="login-logo">
                                <a href="{{ url('/') }}"><span><img src = "{{ asset('logo.png') }}"> </span></a>
                             <h3>Inventory Register</h3>
                            </div>
                           
                             <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus  placeholder="User Name">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Email" name="email" value="{{old('email')}}" required>
                                </div>
                                <div class="form-group">
                                    <input id="password" type="password" name="password" required autocomplete="new-password" class="form-control" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <input id="password_confirmation" type="password" name="password_confirmation" required class="form-control" placeholder="Confirm Password">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> Agree the terms and policy 
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Register</button>


                                
                                <div class="register-link m-t-15 text-center">
                                    <p>Already registered? <a href="{{ route('login') }}"> Login</a></p>
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
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
                        
                        <div class="login-form">
                            <div class="login-logo">
                            <a href="{{ url('/') }}"><span><img src = "{{ asset('logo.png') }}"> </span></a>
                             <h3>Inventory Login</h3>
                        </div>
                           
                             <form method="POST" action="{{ route('login') }}">
            					@csrf
                                <div class="form-group">
                                    <input id="email" name="email" value="{{ old('email') }}" required autofocus type="email" class="form-control" placeholder="Email">
                                     @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                	@endif
                                </div>
                                <div class="form-group">
                                    <input id="password" name="password" required autocomplete="current-password" type="password" class="form-control" placeholder="Password">
                                    @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                           			@endif
                                </div>
                                <div class="checkbox">
                                    <label>
										<input id="remember_me" type="checkbox" name="remember"> Remember Me
									</label>
                                    <label class="pull-right">

										@if (Route::has('password.request'))
						                    <a href="{{ route('password.request') }}">
						                        {{ __('Forgot your password?') }}
						                    </a>
						                @endif

									</label>

                                </div>
                                <button type="submit" class="btn btn-primary my-button btn-flat m-b-30 m-t-30">Sign in</button>
                                
                                <div class="register-link m-t-15 text-center">
                                    <p>Don't have account ? <a href="{{ route('register') }}"> Sign Up Here</a></p>
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
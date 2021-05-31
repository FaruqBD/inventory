 <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Inventory Management') }}</title>

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">


  
    @include('sweetalert::alert')

    </head>



    <body>
    <div class="container mt-5 text-center">
          

        <h2 class="mb-4">
            Please choose an Excel File to import Tracking Number
        </h2>
        <p>Excel file must contain at least 1 columns : Tracking Number</p>

        <form action="{{ url('tracking-number-import') }}" method="POST" enctype="multipart/form-data" id="import-form">
            @csrf
            <div class="form-group mb-4" style="max-width: 500px; margin: 0 auto;">
                <div class="custom-file text-center">
                    <input type="file" name="file" required>
                </div>
                
            </div>
            <button class="btn btn-success" id="import-button">Import Tracking Number</button>
             <a class="btn btn-success" href="{{ url('/') }}">Go to Home</a>

        </form>
        <br>
    </div>


  
</html>

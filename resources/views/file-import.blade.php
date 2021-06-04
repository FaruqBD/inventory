@extends('layouts.master')


@section('content')
    <div class="container mt-5 text-center">
        <h2 class="mb-4">
            Please chose an Excel File to import Products
        </h2>
        <p>Excel file must contain 1 columns : Product Name</p>

        <form action="{{ route('file_import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-4" style="max-width: 500px; margin: 0 auto;">
                <div class="custom-file text-center">
                    <input type="file" name="file">
                </div>
            </div>
            <button class="btn btn-success">Import Products Name</button>
            <a class="btn btn-info" href="{{ route('file-export') }}">Export All Products</a>
        </form>
    </div>
              
@endsection
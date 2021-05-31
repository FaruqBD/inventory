@extends('layouts.master')
 <meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')

    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                
                <section id="main-content">
                    <div class="row justify-content-md-center">
                    	<!-- <div class="login-content"> -->
                        
                        <!-- <div class="login-form"> -->
	                            
                        <div class="col-lg-4  col-md-6 ">
                            <div class="card">
                            	<div class="login-logo">
	                           
	                             <h3>Create Manifest</h3>
	                        </div>
                              	<form method="POST" action="{{ route('login') }}">
	            					@csrf
	                                <div class="form-group">
				                        <label for="manifestDate" class="control-label">Select Date</label>
				                        <input class="form-control" type="date" id="manifestDate" name="manifestDate">
				                    </div>
				                    
				                    <div class="form-group">
				                        <label for="manifest_courier_id" class="control-label">Courier Name</label>
				                        <select class="form-control form-white"name="courier_id" id="courier_id">
				                         @foreach($couriers as $courier)
		                                    <option id= "courier_id" value="{{ $courier->id }}">{{ $courier->name }}</option>
		                                @endforeach
		                                </select>
				                    </div>
	                                <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Submit</button>
	                                
	                            </form>
                            </div>
                            <!-- /# card -->
                        <!-- </div> -->
                        <!-- /# column -->
                    <!-- </div> -->
                    </div>
                    <!-- /# row -->

                    
                </section>
            </div>
        </div>
    </div>

    
@endsection

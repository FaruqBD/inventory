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
	                           
	                             <h3>Single Product Outward</h3>
	                        </div>
                              	<form id="singleProductOutward" name="singleProductOutward" class="form-horizontal">
			                    {!! csrf_field() !!}
			                    
			                     <div class="form-group">
			                        <label for="product_name" class="control-label">Product Name</label>
			                        <input type="text"name="product_name" id="product_name" class="form-control input-lg" placeholder="Enter Product Name" autocomplete="off"/>
			                            <input type="hidden" name="product_id" id="product_id">
			                            <input type="hidden" name="product_name_id" id="product_name_id">
			                          <div  id="productList"></div>
			                    </div>
			                     <div class="form-group">
			                        <label for="godown_id" class="control-label">Select Godown</label>
			                        <select id="godown_id" class="form-control" name="godown_id"></select>
			                         @if ($errors->has('godown_id'))
			                            <span class="text-danger">{{ $errors->first('godown_id') }}</span>
			                        @endif
			                    </div>
			                    			                    
			                    <div class="form-group">
			                        <label>Available Quantity</label>
			                        <input class="form-control" type="number" id="quantity" name="quantity" value=""  readonly="">
			                        @if ($errors->has('quantity'))
			                            <span class="text-danger">{{ $errors->first('quantity') }}</span>
			                        @endif
			                    </div>

			                    <div class="form-group">
			                        <label>Required Quantity</label>
			                        <input class="form-control" type="number" id="quantity" name="quantity" value=""  required="">
			                        @if ($errors->has('quantity'))
			                            <span class="text-danger">{{ $errors->first('quantity') }}</span>
			                        @endif
			                    </div>
			                   
			                    <div class="form-group">
			                        <label>Remarks</label>
			                        <input class="form-control" type="text" id="remarks" name="remarks" value=" ">
			                        @if ($errors->has('remarks'))
			                            <span class="text-danger">{{ $errors->first('remarks') }}</span>
			                        @endif
			                    </div>

			                   <div>
			                      <button type="submit" class="btn btn-md btn-primary" id="saveBtn"  value="create" onclick="event.preventDefault();
			                                                this.closest('ProductForm').submit();">Print</button>
			                    </div>

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

@extends('layouts.master')
 <meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')

    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
            	<div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Create PackList</h1>
                                    
                                     <a href="{{ url('products') }}" class="btn btn-success m-b-10 m-l-5">
                                           </i> All Products
                                    </a>
                                    <a href="{{ route('create-packlist') }}" class="btn btn-success m-b-10 m-l-5">
                                            </i> Create PackList
                                    </a>
                                   
                                
                            </div>
                        </div>
                    </div>
                    
                </div>
                 @if($errors->any())
                    <div class="alert alert-danger text-center">
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success text-center">{{session('success')}}</div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger text-center">{{session('error')}}</div>
                @endif 

                
                <section id="main-content">
                    <div class="row justify-content-md-center">
                    	<!-- <div class="login-content"> -->
                        
                        <!-- <div class="login-form"> -->
	                            
                        <div class="col-lg-4  col-md-6 ">
                            <div class="card">
                            	<div class="login-logo">
	                           
	                             <h3>Single Product Outward</h3>
	                        </div>
                              	<form id="singleProductOutward" name="singleProductOutward" class="form-horizontal" action="{{ url('single-packlist-store') }}" method="POST">
			                    {!! csrf_field() !!}
			                    
			                     <div class="form-group">
			                        <label for="product_name" class="control-label">Product Name</label>
			                        <input type="text"name="product_name" id="product_name" class="form-control input-lg" placeholder="Enter Product Name" autocomplete="off"/>
			                            <input type="hidden" name="product_id" id="product_id">
			                            <input type="hidden" name="product_name_id" id="product_name_id">
			                          <div  id="productList"></div>
			                    </div>
			                     <div class="form-group">
			                        <label for="godown" class="control-label">Select Godown</label>
			                       <select class="form-control form-white"name="godown" id="godown">
										 @foreach($godowns as $godown)
		                                    <option id= "godown" value="{{ $godown->id }}">{{ $godown->name }}</option>
		                                @endforeach
									</select>
			                    </div>
			                    			                    
			                    <div class="form-group">
			                        <label>Available Quantity</label>
			                       <input class="form-control form-white" type="text" name="available_qty" id="available_qty" readonly/>
		                             @if ($errors->has('available_qty'))
		                            <span class="invalid-feedback" role="alert">
		                                <strong>{{ $errors->first('available_qty') }}</strong>
		                            </span>
		                            @endif
			                    </div>

			                    <div class="form-group">
			                        <label>Required Quantity</label>
			                        <input class="form-control" type="number" id="required_qty" name="required_qty" value=""  required="">
			                       
			                    </div>
			                  
			                   <div>
			                      <button type="submit" class="btn btn-md btn-success" id="saveBtn"  value="create" onclick="event.preventDefault();
                                                this.closest('form').submit();">Pick This Item</button>
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

                 <section id="main-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="bootstrap-data-table-panel">
                                    <div class="table-responsive">
                                        <table class="table table-bordered data-table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th widht="50%">Product Name</th>
                                                    <th>Godown</th>
                                                    <th>Available Quantity</th>
                                                    <th>Required Quantity</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- /# card -->
                        </div>
                        <!-- /# column -->
                    </div>
                    <!-- /# row -->

                    
                </section>
            </div>
        </div>
    </div>

    



<script>
$(document).ready(function(){

 $("#product_name").focus();

 $('#product_name').keyup(function(){ 
        var query = $(this).val();
        if(query != '')
        {
         var _token = $('input[name="_token"]').val();
         $.ajax({
          url:"{{ route('autocomplete-products') }}",
          method:"POST",
          data:{query:query, _token:_token},
          success:function(data){
           $('#productList').fadeIn();  
                    $('#productList').html(data);
          }
         });
        }
    });

    $(document).on('click', '#productList li', function(){  
        $('#product_name').val($(this).text());  
        $('#productList').fadeOut();  
         var id = $(this).attr('data-id');

        // console.log(id);
         // var id = e.target.value;
         $.get('packlists-godown/' + id, function (data) {
     
              $("#godown").empty();
              $("#required_qty").html();
               $("#available_qty").val(data[0].quantity);
               $("#product_name_id").val(data[0].product_name_id);
               $("#product_id").val(id);
               // console.log(data[0].product_name_id);

              $.each(data, function(i, item) {
      
                     $("#godown").append("<option value="+item.id+">"+item.name+"</option>");
         
               });
          });  
    }); 

    $("#godown").change(function (e) {
   e.preventDefault();
         var godown_id = e.target.value;
          var product_name_id = $('#product_name_id').val();
          // console.log(godown_id);
         console.log(product_name_id);
         $.get('packlists-quantity/' + product_name_id + '/' + godown_id, function (data) {
               $("#available_qty").empty();
               $("#available_qty").val(data[0].quantity);

             
          });  
       });

 });


  $(function () {

      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
      
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('single-product-outward') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'product_id'},
            {data: 'godown', name: 'godown'},
            {data: 'available_qty', name: 'available_qty'},
            {data: 'required_qty', name: 'required_qty'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });



    $('body').on('click', '.deletePackList', function () {

        var txt;
        var r = confirm("Are you sure you want to delete?");
        if (r == true) {
            
        var id = $(this).data("id");
        $.ajax({
            type: "DELETE",
            url: "packlists"+'/'+id,
            success: function (data) {
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
        } else {
            
            event.preventDefault();
        }

 
       });
   
   




  $("#required_qty").keyup(function(event) {
    if (event.keyCode === 13) {
        $("#saveBtn").click();
    }

   });
  

  });
</script>
               
@endsection

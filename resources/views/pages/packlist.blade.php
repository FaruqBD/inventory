@extends('layouts.master')
 <meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')

    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Create PackList</h1>
                                    
                                    <a href="{{ route('packlists-export') }}" class="btn btn-success m-b-10 m-l-5">
                                            <i class="fa fa-minus"></i> Excel Export
                                    </a>
                                    
                                     <a href="{{ route('clear-packlist') }}" class="btn btn-success m-b-10 m-l-5">
                                            <i class="fa fa-minus"></i> <i class="fa fa-minus"></i> Clear Pack List
                                    </a>
                                     <a href="{{ url('products') }}" class="btn btn-success m-b-10 m-l-5">
                                           </i> All Products
                                    </a>
                                   
                                
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
                                    <li class="breadcrumb-item active">PackList</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                   
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
                	<div class="row">
                	<div class="col-lg-12">
                            <div class="card">
                	<form name="packlistForm" id="packlistForm" action="{{ url('packlists') }}" method="POST">
                        {!! csrf_field() !!}
                        <div class="row">
                           <div class="col-md-5">
                            <label class="control-label">Product Name</label>
                            <input type="text"name="product_name" id="product_name" class="form-control input-lg" placeholder="Enter Product Name" autocomplete="off"/>
                            <input type="hidden" name="product_id" id="product_id">
                          <div  id="productList"></div>
                          </div>
                          <div class="col-md-3">
                            <label class="control-label">Select Godown</label>
                            <select class="form-control form-white"name="godown" id="godown">
								
							</select>
                            <input type="hidden" id="product_name_id">
                          </div>
                          <div class="col-md-2">
                            <label class="control-label">Available Quantity</label>
                            <input class="form-control form-white" type="text" name="available_qty" id="available_qty" readonly/>
                             @if ($errors->has('available_qty'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('available_qty') }}</strong>
                            </span>
                            @endif
                          </div>
                          <div class="col-md-2">
                            <label class="control-label">Required Quantity</label>
                            <input class="form-control form-white" type="text" name="required_qty" id="required_qty" required/>
                             @if ($errors->has('required_qty'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('required_qty') }}</strong>
                            </span>
                            @endif
                          </div>
                          <div class="col-md-12">
                           <button type="button" class="btn btn-success" id="saveBtn" onclick="event.preventDefault();
                                                this.closest('form').submit();" >Save Item</button>
                        </div>
                        </div>
                      </form>
            </div>
            </div>
            </div>
                </section>
                <!-- /# row -->
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
        ajax: "{{ url('packlists') }}",
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
    });
   


    $('#excelSave').click(function (e) {
        e.preventDefault();
        $(this).html('Upload');
       

         $.ajax({
                 type:'POST',
                 url:'{{ url('file_import') }}',
                  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                 data: {
                       
                        'file': $('#file').val()
                        },
                 success:function(data){
                     $('#excelModel').modal('hide');
                   console.log("File Uploaded");
                 
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

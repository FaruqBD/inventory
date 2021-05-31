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
                     @if($errors->any())
                    <div class="alert alert-danger">
                        <p><strong>Opps Something went wrong</strong></p>
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">{{session('error')}}</div>
                @endif          

                </div>

                <section id="main-content">
                	<div class="row">
                	<div class="col-lg-12">
                            <div class="card">
                	<form id="packlistForm" action="{{ url('packlists') }}" method="POST">
                        {!! csrf_field() !!}
                        <div class="row">
                           <div class="col-md-5">
                            <label class="control-label">Select Product Name</label>
                            <select class="form-control form-white"name="product_name" id="product_name">
                               @foreach($product_names as $product_name)
                                    <option id= "product_name" value="{{ $product_name->id }}">{{ $product_name->name }}</option>
                                @endforeach
                            </select>
                          </div>
                          <div class="col-md-3">
                            <label class="control-label">Select Godown</label>
                            <select class="form-control form-white"name="godown" id="godown">
								 @foreach($godowns as $godown)
                                    <option id= "godown" value="{{ $godown->id }}">{{ $godown->name }}</option>
                                @endforeach
							</select>
                          </div>
                          <div class="col-md-2">
                            <label class="control-label">Available Quantity</label>
                            <input class="form-control form-white" type="text" name="available_qty" id="available_qty" readonly/>
                          </div>
                          <div class="col-md-2">
                            <label class="control-label">Required Quantity</label>
                            <input class="form-control form-white" type="text" name="required_qty" id="required_qty" required/>
                          </div>
                          <div class="col-md-12">
                           <button type="button" class="btn btn-success" id="saveBtn">Save Item</button>
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
    

<script type="text/javascript">
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
            {data: 'product_name', name: 'product_name'},
            {data: 'godown', name: 'godown'},
            {data: 'available_qty', name: 'available_qty'},
            {data: 'required_qty', name: 'required_qty'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });


    $('#saveBtn').click(function (e) {
       document.onclick = function(e) {
    if (e.target instanceof HTMLAnchorElement) e.preventDefault();
}
       
        var product_name = $('#product_name').val();
        var godown = $('#godown').val();
        var available_qty = $('#available_qty').val();
        var required_qty = $('#required_qty').val();


        $.ajax({
            url: "{{url('packlists')}}",
            type:"POST",
            data: {'product_name' : product_name, 'godown' : godown, 'available_qty' : available_qty, 'required_qty' : required_qty},
            success: function (data) {
               table.draw();
              location.reload();

          },
          error: function (data) {
              console.log('Error:', data);
          }
        });
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
   
 $("#product_name").change(function (e) {
            console.log(e);
  
         var id = e.target.value;
         $.get('packlists-godown/' + id, function (data) {
             //console.log(data);
     
              $("#godown").empty();
              $("#required_qty").html();
               $("#available_qty").val(data[0].quantity);

              $.each(data, function(i, item) {
      
                     $("#godown").append("<option value="+item.id+">"+item.name+"</option>");
         
               });
          });  
       });

 $("#godown").change(function (e) {
            console.log(e);
   e.preventDefault();
         var godown_id = e.target.value;
         var product_name_id = $("#product_name").val();
         $.get('packlists-quantity/' + product_name_id + '/' + godown_id, function (data) {
            console.log(data.quantity);
               $("#available_qty").empty();
               $("#available_qty").val(data[0].quantity);

             
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
       

  });
</script>
               
@endsection

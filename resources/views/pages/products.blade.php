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
                                <h1>All Products 
                                    <a href="javascript:void(0)" class="btn btn-success m-b-10 m-l-5" id="createNewProduct">
                                            <i class="fa fa-plus"></i> Add New
                                    </a>
                                    <a href="{{ route('file-export') }}" class="btn btn-success m-b-10 m-l-5">
                                            <i class="fa fa-minus"></i> Excel Export
                                    </a>
                                   
                                    <a href="{{ route('create-packlist') }}" class="btn btn-success m-b-10 m-l-5">
                                            </i> Create PackList
                                    </a>
                                    
                                   
                                </h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Product</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                          

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
                                                    <th>Name</th>
                                                    <th>Quantity</th>
                                                    <th>Godown</th>
                                                    <th>Category</th>
                                                    <th>Remarks</th>
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
    <!-- Excel Add Product -->
    <div class="modal fade" id="excelModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Excel Product Upload</h4>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" id="modal_form_id"  method="POST" class="form-horizontal" >
                   
                    {!! csrf_field() !!}
                  
                    <div class="form-group mb-4" style="max-width: 500px; margin: 0 auto;">
                        <div class="custom-file text-left">
                            <input type="file" id="file" name="file" >
                        </div>
                    </div class="save-button">
                    <button type="submit" class="btn btn-primary" id="excelSave">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

     <!-- Modal Add Product -->
      <div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="ProductForm" name="ProductForm" class="form-horizontal">
                    {!! csrf_field() !!}
                    
                     <div class="form-group">
                        <label for="product_name" class="control-label">Product Name</label>
                        <input type="text"name="product_name" id="product_name" class="form-control input-lg" placeholder="Enter Product Name" autocomplete="off"/>
                            <input type="hidden" name="product_id" id="product_id">
                            <input type="hidden" name="product_name_id" id="product_name_id">
                          <div  id="productList"></div>
                    </div>
                    
                    <div class="form-group">
                        <label>Product Quantity</label>
                        <input class="form-control" type="number" id="quantity" name="quantity" value=""  required="">
                        @if ($errors->has('quantity'))
                            <span class="text-danger">{{ $errors->first('quantity') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="godown_id" class="control-label">Godown</label>
                        <select id="godown_id" class="form-control" name="godown_id"></select>
                         @if ($errors->has('godown_id'))
                            <span class="text-danger">{{ $errors->first('godown_id') }}</span>
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <label for="category_id" class="control-label">Category</label>
                        <select id="category_id" class="form-control" name="category_id"></select>
                         @if ($errors->has('category_id'))
                            <span class="text-danger">{{ $errors->first('category_id') }}</span>
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
                                                this.closest('ProductForm').submit();">Save</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

      <!-- END MODAL -->

<script type="text/javascript">
  $(function () {

     $("#product_name").focus();

 $('#product_name').keyup(function(){ 
        var query = $(this).val();
        if(query != '')
        {
         var _token = $('input[name="_token"]').val();
         $.ajax({
          url:"{{ route('autocomplete-all-products') }}",
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
        $("#product_name_id").val(id);
          
    });  


      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
      console.log(table_category(1));

    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('products') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'product_name_id', name: 'product_name_id'},
            {data: 'quantity', name: 'quantity'},
            {data: 'godown_id', name: 'godown_id'},
            {data: 'category_id', name: 'category_id'},
            {data: 'remarks', name: 'remarks'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    $('#createNewProduct').click(function () {
        $('#saveBtn').val("create-Product");
        $('#product_id').val('');
        $('#quantity').val('');
        $('#remarks').val('');
        $('#product_id').trigger("reset");
        $('#modelHeading').html("Add New Product");
        $('#ajaxModel').modal('show');
            godown();
            category();
            product_name();
    });

    $('body').on('click', '.editProduct', function () {
      var id = $(this).data('id');
      $.get("products" +'/' + id +'/edit', function (data) {
          $('#modelHeading').html("Edit Product");
          $('#saveBtn').val("edit-products");
          $('#ajaxModel').modal('show');
          $('#product_id').val(data.id);
          $('#product_name_id').val(data.product_name_id);
          $('#quantity').val(data.quantity);
          $('#remarks').val(data.remarks);
          $('#saveBtn').html('Update');
          var product_name = data.product_name_id;
            product_name_edit(product_name);
          var godown_id = data.godown_id;
            godown_edit(godown_id);
          var category_id = data.category_id;
            category_edit(category_id);
      })

   });

    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Save');
        var product_name_id = $('#product_name_id').val();
        var quantity = $('#quantity').val();
        var godown_id = $('#godown_id').val();
        var category_id = $('#category_id').val();
        var remarks = $('#remarks').val();
        var product_id = $('#product_id').val();

        $.ajax({
            url: "{{url('products')}}",
            type:"POST",
            data: {'product_name_id' : product_name_id, 'quantity' : quantity, 'godown_id' : godown_id, 'category_id' : category_id, 'remarks' : remarks, 'id' : product_id,},
            success: function (data) {
              $('#ProductForm').trigger("reset");
              $('#ajaxModel').modal('hide');
              table.draw();

          },
          error: function (data) {
              console.log('Error:', data);
              $('#saveBtn').html('Save');
          }
        });
    });

   

    function category(){
        url = '/product_category/'+0;
        $.ajax({
            url:url,
            method:"GET",
            success:function(data){
                $('#category_id').html(data);
            }
        });
        return false;
    }

    function category_edit(category_id){
        url = '/product_category/'+category_id;
        $.ajax({
            url:url,
            method:"GET",
            success:function(data){
                $('#category_id').html(data);
            }
        });
        return false;
    }
   
     function product_name_edit(product_name){
        url = '/product_name/'+product_name;
        $.ajax({
            url:url,
            method:"GET",
            success:function(data){
                $('#product_name').val(data);
            }
        });
        return false;
    }

     function godown(){
        url = '/product_godown/'+0;
        $.ajax({
            url:url,
            method:"GET",
            success:function(data){
                $('#godown_id').html(data);
            }
        });
        return false;
    }

    function godown_edit(godown_id){
        url = '/product_godown/'+godown_id;
        $.ajax({
            url:url,
            method:"GET",
            success:function(data){
                $('#godown_id').html(data);
            }
        });
        return false;
    }
    function table_category(category_id){
        url = '/table_category/'+category_id;
        var category_id = "";
        $.ajax({
            url:url,
            method:"GET",
            success:function(data){
               return category_id = data
            }
        });
        return category_id;
    }


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


     $('body').on('click', '.deleteProduct', function () {

         var txt;
        var r = confirm("Are you sure you want to delete?");
        if (r == true) {
            
        var id = $(this).data("id");
        $.ajax({
            type: "DELETE",
            url: "products"+'/'+id,
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
</script>
               
@endsection

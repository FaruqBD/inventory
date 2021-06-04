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
                                <h1>All Product Names
                                    <a href="javascript:void(0)" class="btn btn-success m-b-10 m-l-5" id="createNewProductName">
                                            <i class="fa fa-plus"></i> Add New
                                    </a>
                                     <a href="{{ url('products-import-export')}}" class="btn btn-success m-b-10 m-l-5">
                                            <i class="fa fa-plus"></i> <i class="fa fa-plus"></i> Excel Import
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
                                    <li class="breadcrumb-item active">Product Name</li>
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
                                                    <th width="15%">No</th>
                                                    <th>Name</th>
                                                    <th width="30%" class="text-center">Action</th>
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

     <!-- Modal Add ProductName -->
      <div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="ProductNameForm" name="ProductNameForm" class="form-horizontal">
                    {!! csrf_field() !!}
                   <input type="hidden" name="product_name_id" id="product_name_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-4 control-label">Product Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" value="" required="">
                        </div>
                    </div>
                    <div class="errors"></div>

                    <div class="save-button">
                      <button type="submit" class="btn btn-success" id="saveBtn" value="create">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

      <!-- END MODAL -->

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
        ajax: "{{ url('product-names') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    $('#createNewProductName').click(function () {
        $('#saveBtn').val("create-ProductName");
        $('#product_name_id').val('');
        $('#product_name_id').trigger("reset");
        $('#modelHeading').html("Add New Product Name");
        $('#ajaxModel').modal('show');
    });

    $('body').on('click', '.editProductName', function () {
      var id = $(this).data('id');
      $.get("product-names" +'/' + id +'/edit', function (data) {
          $('#modelHeading').html("Edit Product Name");
          $('#saveBtn').val("edit-product-names");
          $('#ajaxModel').modal('show');
          $('#product_name_id').val(data.id);
          $('#name').val(data.name);
          $('#saveBtn').html('Update');
      })
   });

    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Save');
        var name = $('#name').val();
        var product_name_id = $('#product_name_id').val();

        $.ajax({
            url: "{{url('product-names')}}",
            type:"POST",
            data: {'name' : name, 'id' : product_name_id},
            success: function (data) {
              $('#ProductNameForm').trigger("reset");
              $('#ajaxModel').modal('hide');
              table.draw();

          },
          error: function (data) {
              for (var i in data) {

                  $('errors').append('<div class="alert alert-danger">'+data[i].error_text+'</div>');

                }
          }
        });
    });

    $('body').on('click', '.deleteProductName', function () {

        var txt;
        var r = confirm("Are you sure you want to delete?");
        if (r == true) {
            
        var id = $(this).data("id");
        $.ajax({
            type: "DELETE",
            url: "product-names"+'/'+id,
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

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
                                <h1>All Courier 
                                    <a href="javascript:void(0)" class="btn btn-success m-b-10 m-l-5" id="createNewCourier">
                                            <i class="fa fa-plus"></i> Add New
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
                                    <li class="breadcrumb-item active">Courier</li>
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

     <!-- Modal Add Courier -->
      <div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="CourierForm" name="CourierForm" class="form-horizontal">
                    {!! csrf_field() !!}
                   <input type="hidden" name="courier_id" id="courier_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-4 control-label">Courier Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Courier Name" value="" required="">
                        </div>
                    </div>
                    

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
        ajax: "{{ url('couriers') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    $('#createNewCourier').click(function () {
        $('#saveBtn').val("create-Courier");
        $('#courier_id').val('');
        $('#courier_id').trigger("reset");
        $('#modelHeading').html("Add New Courier");
        $('#ajaxModel').modal('show');
    });

    $('body').on('click', '.editCourier', function () {
      var id = $(this).data('id');
      $.get("couriers" +'/' + id +'/edit', function (data) {
          $('#modelHeading').html("Edit Courier");
          $('#saveBtn').val("edit-couriers");
          $('#ajaxModel').modal('show');
          $('#courier_id').val(data.id);
          $('#name').val(data.name);
          $('#saveBtn').html('Update');
      })
   });

    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Save');
        var name = $('#name').val();
        var courier_id = $('#courier_id').val();

        $.ajax({
            url: "{{url('couriers')}}",
            type:"POST",
            data: {'name' : name, 'id' : courier_id},
            success: function (data) {
              $('#CourierForm').trigger("reset");
              $('#ajaxModel').modal('hide');
              table.draw();

          },
          error: function (data) {
              console.log('Error:', data);
              $('#saveBtn').html('Save Changes');
          }
        });
    });

    $('body').on('click', '.deleteCourier', function () {

        var txt;
        var r = confirm("Are you sure you want to delete?");
        if (r == true) {
            
        var id = $(this).data("id");
        $.ajax({
            type: "DELETE",
            url: "couriers"+'/'+id,
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

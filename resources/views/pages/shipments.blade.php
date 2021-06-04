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
                                <h1>All Shipment 
                                    <a href="javascript:void(0)" class="btn btn-success m-b-10 m-l-5" id="createNewShipment">
                                            <i class="fa fa-plus"></i> Add New
                                    </a>
                                   
                                    <a href="{{url('create-menifest')}}" class="btn btn-success m-b-10 m-l-5">
                                            Create Menifest
                                    </a>
                                     <a href="{{url('manifest')}}" class="btn btn-success m-b-10 m-l-5">
                                            Print Menifest
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
                                    <li class="breadcrumb-item active">Shipment</li>
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

                <!-- /# row -->
                <section id="main-content">
                    <div class="row">
                    <div class="col-lg-12">
                            <div class="card">
                    <form name="inputForm" action="{{ url('shipments') }}" method="POST">
                        {!! csrf_field() !!}
                        <div class="row">
                           <div class="col-md-3">
                            <label class="control-label">Shipment Type</label>
                            <select class="form-control form-white"name="shipment_type_id" id="shipment_type">
                               @foreach($shipment_types as $shipment_type)
                                    @if (old('shipment_type_id') == $shipment_type->id)
                                          <option value="{{ $shipment_type->id }}" selected>{{ $shipment_type->name }}</option>
                                    @else
                                         <option value="{{ $shipment_type->id }}">{{ $shipment_type->name }}</option>
                                    @endif
                                    
                                @endforeach  
                            </select>
                          </div>
                          <div class="col-md-3">
                            <label class="control-label">Courier Name</label>
                            <select class="form-control form-white"name="courier_id" id="courier">
                                 @foreach($couriers as $courier)
                                    @if (old('courier_id') == $courier->id)
                                          <option value="{{ $courier->id }}" selected>{{ $courier->name }}</option>
                                    @else
                                          <option value="{{ $courier->id }}">{{ $courier->name }}</option>
                                    @endif
                                    
                                @endforeach  
                                 
                            </select>
                          </div>
                          <div class="col-md-3">
                            <label class="control-label">Remarks</label>
                            <input class="form-control form-white" type="text" value="{{ old('remarks') }}" name="remarks" id="remarks" required/>
                          </div>
                           <div class="col-md-3">
                            <label class="control-label">Tracking Number</label>
                            <input class="form-control form-white" type="text" name="tracking_number" id="tracking_number" required />
                             @if ($errors->has('tracking_number'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('tracking_number') }}</strong>
                            </span>
                            @endif
                          </div>
                          <div class="col-md-12">
                           <button type="button" id="submitBtn" class="btn btn-success" onclick="event.preventDefault();
                                                this.closest('form').submit();">Save Item</button>
                        </div>
                        </div>
                      </form>
            </div>
            </div>
            </div>
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
                                                    <th >No</th>
                                                    <th>Shipment Type</th>
                                                    <th>Courier Name</th>
                                                    <th>Tracking Number</th>
                                                    <th>Date</th>
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

     <!-- Modal Add Shipment -->
      <div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                
                <form id="ShipmentForm" name="ShipmentForm" class="form-horizontal">
                    {!! csrf_field() !!}
                   <input type="hidden" name="shipment_id" id="shipment_id">
                    <div class="form-group">
                        <label for="shipment_type_id" class="control-label">Shipment Type</label>
                        <select id="shipment_type_id" class="form-control" name="shipment_type_id"></select>
                    </div>
                    
                    <div class="form-group">
                        <label for="courier_id" class="control-label">Courier Name</label>
                        <select id="courier_id" class="form-control" name="courier_id"></select>
                    </div>
                    <div class="form-group">
                        <label>Tracking Number</label>
                        <input class="form-control" type="text" id="tracking_number" name="tracking_number" value="">
                        <span class="help-block"><small></small></span>
                    </div>
                    <div class="form-group">
                        <label>Remarks</label>
                        <input class="form-control" type="text" id="remarks" name="remarks" value="">
                        <span class="help-block"><small></small></span>
                    </div>

                   <div >
                      <button type="submit" class="btn btn-md btn-success" id="saveBtn" value="create">Save</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

      <!-- END MODAL -->

      <!-- Modal Create Manifest -->
      <div class="modal fade" id="manifestModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="manifestModelHeading"></h4>
            </div>
            <div class="modal-body">
                
                <form id="ManifestForm" name="ManifestForm" class="form-horizontal">
                    {!! csrf_field() !!}
                   <input type="hidden" name="manifest_id" id="manifest_id">
                    <div class="form-group">
                        <label for="manifestDate" class="control-label">Select Date</label>
                        <input class="form-control" type="date" id="manifestDate" name="manifestDate">
                    </div>
                    
                    <div class="form-group">
                        <label for="manifest_courier_id" class="control-label">Courier Name</label>
                        <select id="manifest_courier_id" class="form-control" name="courier_id"></select>
                    </div>
                   <div >
                      <button type="submit" class="btn btn-md btn-success" id="manifestSaveBtn" value="create">Submit</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

      <!-- END MODAL -->

<script type="text/javascript">
     $(document).ready(function () {
       $("#tracking_number").focus();
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
        ajax: "{{ url('shipments') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'shipment_type_id', name: 'shipment_type_id'},
            {data: 'courier_id', name: 'courier_id'},
            {data: 'tracking_number', name: 'tracking_number'},
            {data: 'shipment_create_date', name: 'shipment_create_date'},
            {data: 'remarks', name: 'remarks'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    $('#createNewShipment').click(function () {
        $('#saveBtn').val("create-Shipment");
        $('#shipment_id').val('');
        $('#tracking_number').val('');
        $('#remarks').val('');
        $('#shipment_id').trigger("reset");
        $('#modelHeading').html("Add New Shipment");
        $('#ajaxModel').modal('show');
        shipment_type()
        courier()
    });

    $('body').on('click', '.editShipment', function () {
      var id = $(this).data('id');
      $.get("shipments" +'/' + id +'/edit', function (data) {
          $('#modelHeading').html("Edit Shipment");
          $('#saveBtn').val("edit-shipments");
          $('#ajaxModel').modal('show');
          $('#shipment_id').val(data.id);
          $('#tracking_number').val(data.tracking_number);
          $('#remarks').val(data.remarks);
          $('#saveBtn').html('Update');
          var shipment_type_id = data.shipment_type_id;
            shipment_type_edit(shipment_type_id);
            var courier_id = data.courier_id;
            courier_edit(courier_id);
      })
   });

    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Save');
        var shipment_type_id = $('#shipment_type_id').val();
        var courier_id = $('#courier_id').val();
        var tracking_number = $('#tracking_number').val();
        var remarks = $('#remarks').val();

        $.ajax({
            url: "{{url('shipments')}}",
            type:"POST",
            data: {'shipment_type_id' : shipment_type_id, 'courier_id' : courier_id, 'tracking_number' : tracking_number, 'remarks' : remarks},
            success: function (data) {
              $('#ShipmentForm').trigger("reset");
              $('#ajaxModel').modal('hide');
              table.draw();

          },
          error: function (data) {
              console.log('Error:', data);
              $('#saveBtn').html('Save Changes');
          }
        });
    });

    $('body').on('click', '.deleteShipment', function () {

        var txt;
        var r = confirm("Are you sure you want to delete?");
        if (r == true) {
            
        var id = $(this).data("id");
        $.ajax({
            type: "DELETE",
            url: "shipments"+'/'+id,
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

    $('#createManifest').click(function () {
        $('#manifestSaveBtn').val("Save");
        $('#manifestDate').val('');
        $('#manifest_courier_id').val('');
        $('#manifestModelHeading').html("Create Manifest");
        $('#manifestModal').modal('show');
        manifestCourier();
    });

     $('#manifestSaveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Save');
        var manifestDate = $('#manifestDate').val();
        var manifest_courier_id = $('#manifest_courier_id').val();

        $.ajax({
            url: "{{url('shipments')}}",
            type:"POST",
            data: {'shipment_type_id' : shipment_type_id, 'courier_id' : courier_id, 'tracking_number' : tracking_number, 'remarks' : remarks},
            success: function (data) {
              $('#ShipmentForm').trigger("reset");
              $('#ajaxModel').modal('hide');
              table.draw();

          },
          error: function (data) {
              console.log('Error:', data);
              $('#saveBtn').html('Save Changes');
          }
        });
    });

    function shipment_type(){
        url = '/shipment_type/'+0;
        $.ajax({
            url:url,
            method:"GET",
            success:function(data){
                $('#shipment_type_id').html(data);
            }
        });
        return false;
    }

    function shipment_type_edit(shipment_type_id){
        url = '/shipment_type/'+shipment_type_id;
        $.ajax({
            url:url,
            method:"GET",
            success:function(data){
                $('#shipment_type_id').html(data);
            }
        });
        return false;
    }

    function courier(){
        url = '/courier_name/'+0;
        $.ajax({
            url:url,
            method:"GET",
            success:function(data){
                $('#courier_id').html(data);
            }
        });
        return false;
    }

    function courier_edit(){
            url = '/courier_name/'+courier_id;
            $.ajax({
                url:url,
                method:"GET",
                success:function(data){
                    $('#courier_id').html(data);
                }
            });
            return false;
        }

    function manifestCourier(){
        url = '/manifest_courier_name/'+0;
        $.ajax({
            url:url,
            method:"GET",
            success:function(data){
                $('#manifest_courier_id').html(data);
            }
        });
        return false;
    }

    $("#tracking_number").keyup(function(event) {
    if (event.keyCode === 13) {
        $("#submitBtn").click();
    }
});

    


















  });

   
</script>
               
@endsection

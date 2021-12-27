@extends('layouts.master')
 <meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
<script type="text/javascript">

 function playSound(filename){
  var mp3Source = '<source src="' + filename + '.mp3" type="audio/mpeg">';
  var oggSource = '<source src="' + filename + '.ogg" type="audio/ogg">';
  var embedSource = '<embed hidden="true" autostart="true" loop="false" src="' + filename +'.mp3">';
  document.getElementById("sound").innerHTML='<audio autoplay="autoplay">' + mp3Source + oggSource + embedSource + '</audio>';
}

   
</script>
<button onclick="playSound('../scan');">Play</button>  
<div id="sound"></div>
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>{{$menifest->name}} 

                                     <a href="{{url('menifest-export')}}/{{$menifest->id}}" class="btn btn-success m-b-10 m-l-5" >
                                            Print Manifest
                                    </a>

                                    <a href="{{url('/all-menifests')}}" class="btn btn-success m-b-10 m-l-5">
                                            All Manifest
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
                                    <li class="breadcrumb-item"><a href="{{url('/all-menifests')}}">All Manifest</a></li>
                                    <li class="breadcrumb-item active">{{$menifest->name}}</li>
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
                <script>
                    playSound('../scan');

                </script>
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
                        <input type="hidden" name="menifest_id" value="{{$menifest->id}}">
                        {!! csrf_field() !!}
                        <div class="row">
                           <div class="col-md-2">
                            <label class="control-label">Shipment Type</label>
                            <select class="form-control form-white"name="shipment_type_id">
                               @foreach($shipment_types as $shipment_type)
                                    @if (old('shipment_type_id') == $shipment_type->id)
                                          <option value="{{ $shipment_type->id }}" selected>{{ $shipment_type->name }}</option>
                                    @else
                                         <option value="{{ $shipment_type->id }}">{{ $shipment_type->name }}</option>
                                    @endif
                                    
                                @endforeach  
                            </select>
                          </div>
                          <div class="col-md-2">
                            <label class="control-label">Courier Name</label>
                            <select class="form-control form-white"name="courier_id" >
                                 @foreach($couriers as $courier)
                                    @if (old('courier_id') == $courier->id)
                                          <option value="{{ $courier->id }}" selected>{{ $courier->name }}</option>
                                    @else
                                          <option value="{{ $courier->id }}">{{ $courier->name }}</option>
                                    @endif
                                    
                                @endforeach  
                                 
                            </select>
                          </div>
                         
                          <div class="col-md-2">
                            <label class="control-label">Vehicle No</label>
                            <input class="form-control form-white" type="text" value="{{ old('vehicle') }}" name="vehicle" required/>
                          </div>
                          <div class="col-md-3">
                            <label class="control-label">Executive Name</label>
                            <input class="form-control form-white" type="text" value="{{ old('executive') }}" name="executive" required/>
                          </div>
                           <div class="col-md-3">
                            <label class="control-label">Tracking Number</label>
                            <input class="form-control form-white" type="text" id="tracking_number_submit" name="tracking_number"  required />
                             @if ($errors->has('tracking_number'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('tracking_number') }}</strong>
                            </span>
                            @endif
                          </div>

                           
                          <div class="col-md-12">
                           <button type="button" class="btn btn-success" onclick="event.preventDefault(); this.closest('form').submit();" id="submitBtn">Save Item</button>
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
                                                    <th>Vehicle No</th>
                                                    <th>Executive Name</th>
                                                    <th>Tracking Number</th>
                                                    <th>Date</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $n = 1 ?>
                                                @foreach($data as $row)
                                                <tr>
                                                    <td>{{$n++}}</td>
                                                    <td>{{$row->shipment_type_id}}</td>
                                                    <td>{{$row->courier_id}}</td>
                                                    <td>{{$row->vehicle}}</td>
                                                    <td>{{$row->executive}}</td>
                                                    <td>{{$row->tracking_number}}</td>
                                                    <td>{{ date('d-M-y', strtotime($row->shipment_create_date)) }}</td>
                                                    <td class="text-center">
                                                       <a href="javascript:void(0)" data-toggle="tooltip"  data-id="{{$row->id}}" data-original-title="Edit" class="btn btn-info btn-sm editItem">Edit</a> 
                                                       <a href="javascript:void(0)" data-toggle="tooltip"  data-id="{{$row->id}}" data-original-title="Delete" class="btn btn-danger btn-sm deleteItem">Delete</a> 


                                                    </td>
                                                </tr>
                                                @endforeach
                                                
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
                
                <form id="ShipmentForm" name="ShipmentForm" class="form-horizontal"action="{{ url('update-menifest-list') }}" method="POST">
                        {!! csrf_field() !!}
                   <input type="hidden" name="shipment_id" id="shipment_id">
                   <input type="hidden" name="menifest_id" value="{{$menifest->id}}">
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
                        <label>Vehicle</label>
                        <input class="form-control" type="text" id="vehicle" name="vehicle" value="">
                        <span class="help-block"><small></small></span>
                    </div>
                    <div class="form-group">
                        <label>Executive</label>
                        <input class="form-control" type="text" id="executive" name="executive" value="">
                        <span class="help-block"><small></small></span>
                    </div>

                   <div >
                      <button type="submit" class="btn btn-md btn-success" onclick="event.preventDefault(); this.closest('form').submit();">Update</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
    

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

    $('body').on('click', '.editItem', function () {
      var id = $(this).data('id');
      $.get("shipments" +'/'+'edit'+'/'+ id, function (data) {
        console.log(data);
          $('#modelHeading').html("Edit Shipment");
          $('#saveBtn').val("edit-shipments");
          $('#ajaxModel').modal('show');
          $('#shipment_id').val(data.id);
          $('#tracking_number').val(data.tracking_number);
          $('#vehicle').val(data.vehicle);
          $('#executive').val(data.executive);
          $('#saveBtn').html('Update');
          var shipment_type_id = data.shipment_type_id;
            shipment_type_edit(shipment_type_id);
            var courier_id = data.courier_id;
            courier_edit(courier_id);
      })
   });


    $('body').on('click', '.deleteItem', function () {

        var txt;
        var r = confirm("Are you sure you want to delete?");
        if (r == true) {
            var id = $(this).data("id");
            location.href = "{{url('delete-menifest-list')}}/"+id;
        
        } else {
            event.preventDefault();
        }
    });


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



    function courier_edit(courier_id){
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


    $("#tracking_number_submit").keyup(function(event) {
    if (event.keyCode === 13) {
        $("#submitBtn").click();
    }
});

    


















  });



   
</script>
               
@endsection

@extends('layouts.master')
 <meta name="csrf-token" content="{{ csrf_token() }}">
 <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>

@section('content')

    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                 <h1>All CRM
                                     <a href="javascript:void(0)" class="btn btn-success m-b-10 m-l-5" id="createNewCrm">
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
                                    <li class="breadcrumb-item active">All CRM</li>
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
                                <div class="bootstrap-data-table-panel">
                                    <div class="table-responsive">
                                        <table class="table table-bordered data-table">
                                            <thead>
                                                <tr>
                                                    <th >No</th>
                                                    <th>Customer</th>
                                                    <th>Status</th>
                                                    <th>Assigned To</th>
                                                    <th>SLA</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $n = 1 ?>
                                                @foreach($crms as $row)
                                                <tr>
                                                    <td>{{$n++}}</td>
                                                    <td>{{$row->customer}}</td>

                                                    @if ($row->status == 0)
                                                    <td>New</td>
                                                    @elseif ($row->status == 1)
                                                     <td>In Progress</td>
                                                    @elseif ($row->status == 2)
                                                     <td>On Hold</td>
                                                    @else
                                                    <td class="text-danger">Closed</td>
                                                    @endif


                                                    <td>{{$row->assigned_to}}</td>

                                                    <?php

                                                    
                                                     $diff1 = strtotime($row->dead_line)/60-strtotime($row->created_at)/60;
                                                     $diff2 = strtotime($currentTime)/60-strtotime($row->created_at)/60;
                                                     $diff3 = strtotime($row->sla)/60-strtotime($row->created_at)/60;

                                                     // dd($diff2%3600);
                                                    
                                                    
                                                    if($diff2 < 2*60){
                                                        $clr = "green";
                                                    }elseif($diff2 < 3*60){
                                                        $clr = "yllow";
                                                    }else{
                                                        $clr = "red";
                                                    }
                                                    
                                                     if($row->status == 2)
                                                     {
                                                         $sla= round(($diff3 - ($diff3 % 60))/60) .":" . round(($diff3 % 60)) ." Hours";
                                                     }elseif($row->status == 3)
                                                     {
                                                     $sla= round(($diff3 - ($diff3 % 60))/60) .":" . round(($diff3 % 60)) ." Hours";
                                                        
                                                     }else{
                                                        $sla= round(($diff2 - ($diff2 % 60))/60) .":" . round(($diff2 % 60)) ." Hours";
                                                     }
                                                     if($diff3 > 1){

                                                         if($diff3 < 2*60){
                                                            $clr = "green";
                                                        }elseif($diff3 < 3*60){
                                                            $clr = "yllow";
                                                        }else{
                                                            $clr = "red";
                                                        }
                                                    }

                                                    ?>



                                                    <td>
                                                        
                                                    <div class="progress-bar" style="background-color:{{$clr}}; height:20px;" >{{$sla}}                               
                                                         </div>
                                                    </td>
                                                    <td class="text-center">
                                                       <a href="javascript:void(0)" data-toggle="tooltip"  data-id="{{$row->id}}" data-original-title="View" class="btn btn-success btn-sm viewItem">View</a>
                                                       @if(Auth::user()->id == 1)
                                                       <a href="javascript:void(0)" data-toggle="tooltip"  data-id="{{$row->id}}" data-original-title="Edit" class="btn btn-success btn-sm editItem">Edit</a> 

                                                       <a href="javascript:void(0)" data-toggle="tooltip"  data-id="{{$row->id}}" data-original-title="Delete" class="btn btn-danger btn-sm deleteItem">Delete</a> 
                                                       @endif

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
                
                <form id="crmForm" name="crmForm" class="form-horizontal" action="{{ url('crms') }}" method="POST">
                        {!! csrf_field() !!}
                        <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <input type="text" class="form-control" name="customer" id="customer" value="{{ old('customer') }}" required autofocus  placeholder="Customer Name">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="issue" placeholder="Issue" name="issue" value="{{old('issue')}}" required>
                    </div>
                    <div class="form-group">
                        <label id="status_lebel" for="status" class="control-label">Status</label>
                        <select id="status" class="form-control" name="status">
                            <option value="0">New</option>
                            <option value="1">In Progress</option>
                            <option value="2">On Hold</option>
                            <option value="3">Closed</option>
                        </select>
                    </div>
                    
                     <div class="form-group">
                        <label for="assigned_to" class="control-label">Assigned To</label>
                        <select id="assigned_to" class="form-control" name="assigned_to">
                             @foreach($users as $user)
                                @if (old('assigned_to') == $user->id)
                                      <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                                @else
                                     <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endif
                                    
                                @endforeach  
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="dead_line" class="control-label">Deadline</label>
                        <input class="form-control" type="datetime-local" id="dead_line" name="dead_line" value="2021-06-19T17:35:00+06:00">
                    </div>
                    <div class="form-group">
                        <input type="text" name="remarks" required class="form-control" id="remarks" placeholder="Remarks">
                    </div>
                    

                   <div >
                      <button type="submit" class="btn btn-md btn-success" id="saveBtn" onclick="event.preventDefault(); this.closest('form').submit();">Save</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
    

<script type="text/javascript">

  $(function () {

    $('#createNewCrm').click(function () {
        $('#saveBtn').val("create-User");
        $('#modelHeading').html("Add New CRM");
        $('#customer').val("");
          $('#issue').val("");
          $('#status').val("");
          $('#status').hide();
          $('#status_lebel').hide();
          $('#assigned_to').val("");
          $('input[type=datetime-local]').prop('valueAsNumber', Math.floor(new Date() / 60000) * 60000);
        $('#ajaxModel').modal('show');
    });

    $('body').on('click', '.deleteItem', function () {

        var txt;
        var r = confirm("Are you sure you want to delete?");
        if (r == true) {
            var id = $(this).data("id");
            location.href = "{{url('crms-delete')}}/"+id;
        
        } else {
            event.preventDefault();
        }
    });

     $('body').on('click', '.editItem', function () {
      var id = $(this).data('id');
      $.get("crms" +'/' + id +'/edit', function (data) {
          $('#modelHeading').html("Edit CRM");
          $('#saveBtn').val("edit-CRM");
          $('#ajaxModel').modal('show');
          $('#id').val(data.id);
          $('#customer').val(data.customer);
          $('#issue').val(data.issue);
          $('#assigned_to').val(data.assigned_to);
          $('#status').val(data.status);
          $('#status').show();
          $('#status_lebel').show();
          var cTime = Date.parse(data.dead_line);
          console.log(cTime);
         $('input[type=datetime-local]').prop('valueAsNumber', cTime + 6*3600*1000);
          $('#remarks').val(data.remarks);
          $('#saveBtn').html('Update');
          
      })
   });


      $('body').on('click', '.viewItem', function () {
      var id = $(this).data("id");
      location.href = "{{url('crm-details')}}/"+id;
   });
     





  });

   
</script>
               
@endsection

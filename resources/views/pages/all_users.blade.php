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
                            	 <h1>All Users
                                     <a href="javascript:void(0)" class="btn btn-success m-b-10 m-l-5" id="createNewUser">
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
                                    <li class="breadcrumb-item active">All Users</li>
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
                                                    <th>Name</th>
                                                    <th>Eamil</th>
                                                    <th>Role</th>
                                                    <th>Date</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $n = 1 ?>
                                                @foreach($users as $row)
                                                <tr>
                                                    <td>{{$n++}}</td>
                                                    <td>{{$row->name}}</td>
                                                    <td>{{$row->email}}</td>
                                                    @if ($row->role_id == 1)
                                                    <td>Admin</td>
                                                    @elseif ($row->role_id == 2)
                                                     <td>Staff</td>
                                                    @else
                                                    <td>New User</td>
                                                    @endif

                                                    <td>{{ date('d-M-y', strtotime($row->created_at)) }}</td>
                                                    <td class="text-center">
                                                       <a href="javascript:void(0)" data-toggle="tooltip"  data-id="{{$row->id}}" data-original-title="Edit" class="btn btn-info btn-sm editItem">Edit Role</a> 
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
                
                <form id="UserForm" name="UserForm" class="form-horizontal" action="{{ url('users') }}" method="POST">
                        {!! csrf_field() !!}
                        <input type="hidden" name="user_id" id="user_id">
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" id="user_name" value="{{ old('name') }}" required autofocus  placeholder="User Name">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" id="user_email" placeholder="Email" name="email" value="{{old('email')}}" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" required autocomplete="new-password" class="form-control" id="user_password" placeholder="Password">
                    </div>
                     <div class="form-group">
                        <select id="user_role" class="form-control" name="role_id">
                        	<option value="0">Select Role</option>
                            <option value="0">New User</option>
                        	<option value="2">Staff</option>
                        	<option value="1">Admin</option>
                        </select>
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

    $('#createNewUser').click(function () {
        $('#saveBtn').val("create-User");
        $('#modelHeading').html("Add New User");
        $('#user_id').val("");
          $('#user_name').val("");
          $('#user_email').val("");
           $('#user_email').show();
          $('#user_role').val("");
          $('#user_role').show();
          $('#user_password').show();
        $('#ajaxModel').modal('show');
         $('#saveBtn').html('Save');
    });

    $('body').on('click', '.deleteItem', function () {

        var txt;
        var r = confirm("Are you sure you want to delete?");
        if (r == true) {
            var id = $(this).data("id");
            location.href = "{{url('users-delete')}}/"+id;
        
        } else {
            event.preventDefault();
        }
    });

     $('body').on('click', '.editItem', function () {
      var id = $(this).data('id');
      $.get("users" +'/' + id +'/edit', function (data) {
          $('#modelHeading').html("Edit User Role");
          $('#saveBtn').val("edit-user-names");
          $('#ajaxModel').modal('show');
          $('#user_id').val(data.id);
          $('#user_name').val(data.name);
          $('#user_email').hide();
          $('#user_password').hide();
          $('#user_role').val(data.role_id);
          $('#saveBtn').html('Update');
           
      })
   });









  });

   
</script>
               
@endsection

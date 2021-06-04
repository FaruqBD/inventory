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
                                <h1>All Menifest
                                    <a href="javascript:void(0)" class="btn btn-success m-b-10 m-l-5" id="createNewMenifest">
                                            <i class="fa fa-plus"></i> Add New Menifest
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
                                    <li class="breadcrumb-item active">All Menifest</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                         @if($errors->any())
                    <div class="alert alert-danger">
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
                                                    <th>Menifest Name</th>
                                                    <th>Created Date</th>
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

     <!-- Modal Add Category -->
      <div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="newMenifestForm" name="newMenifestForm" class="form-horizontal" method="POST" action="{{route('save-menifest')}}">
                    {!! csrf_field() !!}
                   <input type="hidden" name="menifest_id" id="menifest_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-4 control-label">Menifest Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Menifest Name" value="" required="">
                        </div>
                    </div>
                   <div class="save-button">
                      <button type="submit" class="btn btn-success" id="saveBtn" value="create" onclick="event.preventDefault();
                                                this.closest('form').submit();">Save</button>
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
        ajax: "{{ url('all-menifests') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    $('#createNewMenifest').click(function () {
        $('#saveBtn').val("create-Menifest");
        $('#menifest_id').val('');
        $('#menifest_id').trigger("reset");
        $('#modelHeading').html("Add New Menifest");
        $('#ajaxModel').modal('show');
    });

    $('body').on('click', '.editCategory', function () {
      var id = $(this).data('id');
      $.get("categories" +'/' + id +'/edit', function (data) {
          $('#modelHeading').html("Edit Category");
          $('#saveBtn').val("edit-categorys");
          $('#ajaxModel').modal('show');
          $('#category_id').val(data.id);
          $('#name').val(data.name);
          $('#saveBtn').html('Update');
      })
   });

    
    $('body').on('click', '.deleteCategory', function () {

  var txt;
        var r = confirm("Are you sure you want to delete?");
        if (r == true) {
            
        var id = $(this).data("id");
        $.ajax({
            type: "DELETE",
            url: "categories"+'/'+id,
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
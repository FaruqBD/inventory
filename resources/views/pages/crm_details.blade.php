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
                            	 <h1>CRM Details
                                    <a href="{{ url('crms') }}" class="btn btn-success m-b-10 m-l-5" >
                                             All CRMs
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
                                    <li class="breadcrumb-item active">CRM Details</li>
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
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="bootstrap-data-table-panel">
                                    <div class="table-responsive">
                                        <table class="table">
                                        	<h4 class="text-center">Details</h4>
                                            <tbody>
                                            	 @foreach($crms as $crm)
                                                <tr><th>Customer</th><th>:</th><th>{{$crm->customer}}</th></tr>
                                                <tr><th>Issue</th><th>:</th><th>{{$crm->issue}}</th></tr>
                                                <tr><th>Assigned To</th><th>:</th><th>{{$crm->assigned_to}}</th></tr>
                                                <tr><th>Deadline</th><th>:</th><th>{{date("d-m-Y",strtotime($crm->dead_line))}}</th></tr>
                                               
                                                @endforeach
                                            </tbody>
                                           
                                        </table>


                                    </div>
                                </div>
                            </div>
                            <!-- /# card -->
                            <div class="card">
                                <div class="bootstrap-data-table-panel">
                                    <div class="table-responsive">
                                       
                                        	<h5 class="text-center">Remarks</h5>
                                             <form id="updateForm" name="updateForm" class="form-horizontal" action="{{ url('crm-post-update') }}" method="POST">
						                        {!! csrf_field() !!}
						                        <input type="hidden" name="crm_id" value="{{$id}}">
						                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
						                    <div class="form-group">
						                        
						                        <textarea name="details" class="form-control" ></textarea>
						                    </div>
						                   

						                   <div >
						                      <button type="submit" class="btn btn-md btn-success pull-right" id="saveBtn" onclick="event.preventDefault(); this.closest('form').submit();">Post</button>
						                    </div>

						                </form>

                                        
                                    </div>
                                </div>
                            </div>
                            <!-- /# card -->

 							<?php $n = count($crm_remarks) ?>
                             @foreach($crm_remarks as $crm)
                            <div class="card">
                                <div class="bootstrap-data-table-panel">
                                    <div class="table-responsive">
                                        <table class="table" style="margin-bottom:0px;">
                                            <tbody>
                                            	
                                                 <h6 style="padding-left:10px;">  Update {{$n--}} : {{$crm->details}}</h6>
                                                <tr>
                                                	<th><b>Date</b></th><th>:</th><th>{{date("d-m-Y",strtotime($crm->created_at))}}</th>
                                                    <th><b>Time</b></th><th>:</th><th>{{date("H:m",strtotime($crm->created_at))}}</th>
                                                    <th><b>User</b></th><th>:</th><th>{{$crm->user}}</th>
                                                </tr>
                                               
                                            </tbody>
                                           
                                        </table>

                                        
                                    </div>
                                </div>
                            </div>
                            <!-- /# card -->
							 @endforeach

                        </div>
                        <!-- /# column -->
                    </div>
                    <!-- /# row -->

                    
                </section>
            </div>
        </div>
    </div>


               
@endsection

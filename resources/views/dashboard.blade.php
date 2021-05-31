@extends('layouts.master')

@section('content')
    <div class="content-wrap">
            <div class="main">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-8 p-r-0 title-margin-right">
                            <div class="page-header">
                                <div class="page-title">
                                    <h1>Hello, <span>Welcome Here</span></h1>
                                </div>
                            </div>
                        </div>
                        <!-- /# column -->
                        <div class="col-lg-4 p-l-0 title-margin-left">
                            <div class="page-header">
                                <div class="page-title">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Home</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <!-- /# column -->
                    </div>
                    <!-- /# row -->
                    <section id="main-content">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="card">
                                    <div class="stat-widget-two">
                                        <div class="stat-content">
                                            <div class="stat-text">Today Expenses </div>
                                            <div class="stat-digit"> <i class="fa fa-usd"></i>8500</div>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-success w-85" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="card">
                                    <div class="stat-widget-two">
                                        <div class="stat-content">
                                            <div class="stat-text">Income Detail</div>
                                            <div class="stat-digit"> <i class="fa fa-usd"></i>7800</div>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-primary w-75" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="card">
                                    <div class="stat-widget-two">
                                        <div class="stat-content">
                                            <div class="stat-text">Task Completed</div>
                                            <div class="stat-digit"> <i class="fa fa-usd"></i> 500</div>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-warning w-50" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="card">
                                    <div class="stat-widget-two">
                                        <div class="stat-content">
                                            <div class="stat-text">Task Completed</div>
                                            <div class="stat-digit"> <i class="fa fa-usd"></i>650</div>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-danger w-65" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /# card -->
                            </div>
                            <!-- /# column -->
                        </div>
                        <!-- /# row -->


                        <div class="row">
                            <!-- column -->
                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Sales Overview</h4>
                                        <div id="morris-bar-chart"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- column -->
                            <div class="col-md-4">
                                <div class="card text-center">
                                    <div class="m-t-10">
                                        <p>Customer Feedback</p>
                                        <h5>385749</h5>
                                    </div>
                                    <div class="widget-card-circle pr m-t-20 m-b-20" id="info-circle-card">
                                        <i class="ti-control-shuffle pa"></i>
                                    </div>
                                    <ul class="widget-line-list m-b-15">
                                        <li class="border-right">92% <br><span class="color-success"><i class="ti-hand-point-up"></i> Positive</span></li>
                                        <li>8% <br><span class="color-danger"><i class="ti-hand-point-down"></i>Negative</span></li>
                                    </ul>
                                </div>
                            </div>

                        </div>


                        
                    </section>
                </div>
            </div>
        </div>
        <div id="search">
            <button type="button" class="close">×</button>
            <form>
                <input type="search" value="" placeholder="type keyword(s) here" />
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
               
@endsection

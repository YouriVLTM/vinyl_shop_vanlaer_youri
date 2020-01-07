@extends('layouts.template')

@section('title', 'Dashboard')

@section('main')
    <h1>Dashboard</h1>

    <div class="container-fluid">

        <div class="row">


            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Users</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <span class="animation-count-up" data-speed="100" data-min="0" data-max="{{$users->count}}">
                                        <div class="spinner-border" role="status">
                                          <span class="sr-only">Loading...</span>
                                        </div>
                                    </span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Records</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <span class="animation-count-up"  data-speed="100" data-min="0" data-max="{{$records->count}}">
                                        <div class="spinner-border" role="status">
                                          <span class="sr-only">Loading...</span>
                                        </div>
                                    </span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-compact-disc fa-fw fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Genres</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <span class="animation-count-up"  data-speed="200" data-min="0" data-max="{{$genres->count}}">
                                        <div class="spinner-border" role="status">
                                          <span class="sr-only">Loading...</span>
                                        </div>
                                    </span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-compact-disc fa-fw fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Orders</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><span class="animation-count-up"  data-speed="100" data-min="0" data-max="{{$orders->count}}">
                                        <div class="spinner-border" role="status">
                                          <span class="sr-only">Loading...</span>
                                        </div>
                                    </span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-box-open fa-fw mr-1 fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        <!--Charts-->
        <div class="row">
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">

                        <canvas id="myChart"></canvas>


                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">


                        <canvas id="ordersChart"></canvas>

                    </div>
                </div>
            </div>

        </div>
    </div>



@endsection

@section('script_after')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    @include('admin.dashboard.chart')

@endsection
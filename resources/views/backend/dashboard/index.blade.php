@extends('backend.layouts.backend')
@section('content')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        @include('alerts.alerts')
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box shadow-sm">
                  <span class="info-box-icon bg-success"><i class="fa fa-shopping-cart"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">{{ __('Total Orders') }}</span>
                    <span class="info-box-number">{{ $totalOrders }}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- ./col -->

            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box shadow-sm">
                  <span class="info-box-icon bg-success"><i class="fa fa-shopping-cart"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">{{ __('Pending Orders') }}</span>
                    <span class="info-box-number">{{ $totalPendingOrders }}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- ./col -->

            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box shadow-sm">
                  <span class="info-box-icon bg-success"><i class="fa fa-shopping-cart"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">{{ __('Delivered Orders') }}</span>
                    <span class="info-box-number">{{ $totalDeliveredOrders }}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- ./col -->

            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box shadow-sm">
                  <span class="info-box-icon bg-success"><i class="fa fa-shopping-cart"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">{{ __('Canceld Orders') }}</span>
                    <span class="info-box-number">{{ $totalCanceledOrders }}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- ./col -->

            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box shadow-sm">
                  <span class="info-box-icon bg-primary"><i class="fa fa-chart-bar"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">{{ __('Total Product Sale') }}</span>
                    <span class="info-box-number">{{ $totalProductSale }}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- ./col -->

            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box shadow-sm">
                  <span class="info-box-icon bg-danger"><i class="fa fa-money-bill-wave"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">{{ __('Total Earning') }}</span>
                    <span class="info-box-number">{{ $totalEarning }}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- ./col -->


            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box shadow-sm">
                  <span class="info-box-icon bg-info"><i class="fa fa-check-circle"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">{{ __('Total Products') }}</span>
                    <span class="info-box-number">{{ $totalItems }}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- ./col -->

            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box shadow-sm">
                  <span class="info-box-icon bg-info"><i class="fa fa-check-circle"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">{{ __('Total Customers') }}</span>
                    <span class="info-box-number">{{ $totalUsers }}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- ./col -->



        </div>
        <!-- /.row -->

        <!-- Main row -->
        <div class="row">
            <!-- col -->
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                    <h3 class="card-title">{{__('Recent Orders')}}</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    @if ($recentOrders->count() > 0)
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                <th>{{ __('Customer') }}</th>
                                <th>{{ __('Order ID') }}</th>
                                <th>{{ __('Payment Method') }}</th>
                                <th>{{ __('Total') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recentOrders as $data)
                                    <tr>
                                        <td><a href="{{ route('backend.user.show', $data->user_id) }}">{{ $data->user->displayName() }}</a></td>
                                        <td><a href="{{ route('backend.order.index', $data->id) }}">{{ $data->transaction_number }}</a></td>
                                        <td>{{ $data->payment_method }}</td>
                                        <td>{{ PriceHelper::orderTotal($data) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-center">
                            {{ __('No Order Found.') }}
                        </p>
                    @endif

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                </div>
            <!-- /. col -->

        </div>
        <!-- /.row (main row) -->

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
@section('script')
<script>
    $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    // var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

    var lineChartData1 = {
      labels  : [{!! $order_days !!}],
      datasets: [
        {
          label               : 'Product Sales',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : true,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [{!! $order_sales !!}]
        },
      ]
    }

    var lineChartOptions1 = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }


    //-------------
    //- LINE CHART - 1
    //--------------
    var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
    var lineChartOptions = $.extend(true, {}, lineChartOptions1)
    var lineChartData = $.extend(true, {}, lineChartData1)
    lineChartData.datasets[0].fill = false;
    lineChartOptions.datasetFill = false

    var lineChart = new Chart(lineChartCanvas, {
      type: 'line',
      data: lineChartData,
      options: lineChartOptions
    });

     //-------------
    //- LINE CHART - 2
    //--------------

    var lineChartData2 = {
      labels  : [{!! $earning_days !!}],
      datasets: [
        {
          label               : "Earning" + '{{ PriceHelper::adminCurrency() }}',
          backgroundColor     : 'rgba(215, 44, 38, 1)',
          borderColor         : 'rgba(215, 44, 38, 1)',
          pointRadius          : true,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [{!! $total_incomes !!}]
        }
      ]
    }

    var lineChartOptions2 = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }

    var lineChartCanvas = $('#lineChart2').get(0).getContext('2d')
    var lineChartOptions = $.extend(true, {}, lineChartOptions2)
    var lineChartData = $.extend(true, {}, lineChartData2)
    lineChartData.datasets[0].fill = false;
    lineChartOptions.datasetFill = false

    var lineChart = new Chart(lineChartCanvas, {
      type: 'line',
      data: lineChartData,
      options: lineChartOptions
    });


  })
  </script>
@endsection

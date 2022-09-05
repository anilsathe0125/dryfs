@extends('backend.layouts.backend')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ __('Create Currency') }}</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">

                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="small-box bg-white ">
                            <div class="inner p-4">
                                <h2 class="text-navy">{{ __('Add Physical Product') }}</h3>
                            </div>
                            <div class="icon">
                                <i class="fab fa-product-hunt text-navy"></i>
                            </div>
                            <a href="{{ route('backend.item.create') }}" class="small-box-footer">
                                {{ __('Continue') }} <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <!-- ./col -->

                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="small-box bg-white">
                            <div class="inner p-4">
                                <h2 class="text-success">{{ __('Add Digital Product') }}</h3>
                            </div>
                            <div class="icon">
                                <i class="fab fa-digital-ocean text-success"></i>
                            </div>
                            <a href="{{ route('backend.digital.item.create') }}" class="small-box-footer">
                                {{ __('Continue') }} <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <!-- ./col -->

                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="small-box bg-white">
                            <div class="inner p-4">
                                <h2 class="text-info">{{ __('Add Licence Product') }}</h3>
                            </div>
                            <div class="icon">
                                <i class="far fa-copyright text-info"></i>
                            </div>
                            <a href="{{ route('backend.license.item.create') }}" class="small-box-footer">
                                {{ __('Continue') }} <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <!-- ./col -->


                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

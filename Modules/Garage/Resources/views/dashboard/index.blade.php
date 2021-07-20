@extends('garage.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
            <small>{{ trans('labels.title_dashboard') }}</small>
            </h1>
            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</li>
            </ol>
        </section>
       
        <!-- Main content -->
        <section class="content">
          
            <div class="row">

                @if($result['garage_vendor_type'] ==! 2)
                    <div class="col-lg-3 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-yellow">
                        <div class="inner">
                          <h3>{{ $result['c_clientPackageSubscribe'] }}</h3>
                                <p>{{ trans('labels.ClientPackageSubscribe') }}</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-bag"></i>
                        </div>
                      </div>
                    </div>
                   
                    <div class="col-lg-3 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-blue">
                        <div class="inner">
                          <h3>{{ $result['c_garagePackageSubscribe'] }}</h3>
                                <p>{{ trans('labels.GaragePackageSubscribe') }}</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-bag"></i>
                        </div>
                      </div>
                    </div>
                 @endif
                <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-aqua">
                    <div class="inner">
                      <h3>{{ $result['total_orders'] }}</h3>
                            <p>{{ trans('labels.NewOrders') }}</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-bag"></i>
                    </div>
                  </div>
                </div>
                <!-- ./col -->

                 <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-green">
                    <div class="inner">
                      <h3>{{ $result['totalProducts'] }}</h3>

                      <p>{{ trans('labels.totalProducts') }}</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-pie-graph"></i>
                    </div>
                  </div>
                </div>
                <!-- ./col -->

                 <div class="col-lg-3 col-xs-6">

                  <div class="small-box bg-red">
                    <div class="inner">
                      <h3>{{ $result['outOfStock'] }} </h3>
                      <p>{{ trans('labels.outOfStock') }}</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-stats-bars"></i>
                    </div>
                  </div>
                </div>
                <!-- ./col -->

                <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-light-blue">
                    <div class="inner">
                      <h3>@if(!empty($result['commonContent']['currency']->symbol_left)) {{$result['commonContent']['currency']->symbol_left}} @endif {{ $result['total_sales_amount'] }} @if(!empty($result['commonContent']['currency']->symbol_right)) {{$result['commonContent']['currency']->symbol_right}} @endif</h3>
                      <p>{{ trans('labels.TotalSalesAmount')}}</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-bag"></i>
                    </div>
                  </div>
                </div>


                @if($result['garage_vendor_type'] == 2)
                <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-light-blue">
                    <div class="inner">
                      <h3>@if(!empty($result['commonContent']['currency']->symbol_left)) {{$result['commonContent']['currency']->symbol_left}} @endif {{ $result['current_balance'] }} @if(!empty($result['commonContent']['currency']->symbol_right)) {{$result['commonContent']['currency']->symbol_right}} @endif</h3>
                      <p>{{ trans('labels.CurrentBalance')}}</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-bag"></i>
                    </div>
                  </div>
                </div>
                @endif

              </div>

         

            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <div class="col-md-6">
                    <!-- MAP & BOX PANE -->

                    <!-- TABLE: LATEST ORDERS -->
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ trans('labels.NewOrders') }}</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table no-margin">
                                    <thead>
                                    <tr>
                                        <th>{{ trans('labels.OrderID') }}</th>
                                        <th>{{ trans('labels.CustomerName') }}</th>
                                        <th>{{ trans('labels.TotalPrice') }}</th>
                                        <th>{{ trans('labels.Status') }} </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($result['orders'])>0)
                                        @foreach($result['orders'] as $total_orders)
                                            @foreach($total_orders as $key=>$orders)
                                                @if($key<=10)
                                                    <tr>
                                                        <td><a href="{{ URL::to('partner/orders/vieworder/') }}/{{ $orders->orders_id }}" data-toggle="tooltip" data-placement="bottom" title="Go to detail">{{ $orders->orders_id }}</a></td>
                                                        <td>{{ $orders->customers_name }}</td>
                                                        <td>
                                                            @if(!empty($result['commonContent']['currency']->symbol_left)) {{$result['commonContent']['currency']->symbol_left}} @endif {{ floatval($orders->total_price) }} @if(!empty($result['commonContent']['currency']->symbol_right)) {{$result['commonContent']['currency']->symbol_right}} @endif
                                                        </td>
                                                        <td>
                                                            @if($orders->orders_status_id==1)
                                                                <span class="label label-warning"></span>
                            @elseif($orders->orders_status_id==2)
                                                                  <span class="label label-success">
                            @elseif($orders->orders_status_id==3)
                                                                </span>  <span class="label label-danger"></span>
                            @else
                                                                  <span class="label label-primary">
                            @endif
                                                                                            {{ $orders->orders_status }}
                                 </span>


                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endforeach

                                    @else
                                        <tr>
                                            <td colspan="4">{{ trans('labels.noOrderPlaced') }}</td>

                                        </tr>
                                    @endif


                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->

                <div class="col-md-6">

                    <!-- PRODUCT LIST -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ trans('labels.RecentlyAddedProducts') }}</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <ul class="products-list product-list-in-box">
                                @foreach($result['recentProducts'] as $recentProducts)
                                    <li class="item">
                                        <div class="product-img">
                                            <img src="{{asset('').$recentProducts->products_image}}" alt="" width=" 100px" height="100px">
                                        </div>
                                        <div class="product-info">
                                            <a href="{{ URL::to('partner/products/edit') }}/{{ $recentProducts->products_id }}" class="product-title">{{ $recentProducts->products_name }}
                                                <span class="label label-warning label-succes pull-right">
                                                    @if(!empty($result['commonContent']['currency']->symbol_left)) {{$result['commonContent']['currency']->symbol_left}} @endif {{ floatval($recentProducts->products_price) }} @if(!empty($result['commonContent']['currency']->symbol_right)) {{$result['commonContent']['currency']->symbol_right}} @endif
                                                    </span></a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                       
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
        </section>
        <!-- /.content -->
    </div>
    {{--<script src="{!! asset('plugins/jQuery/jQuery-2.2.0.min.js') !!}"></script>--}}

    {{--<script src="{!! asset('dist/js/pages/dashboard2.js') !!}"></script>--}}
@endsection

@extends('garage.layout')


@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Garage Transaction</h1>
      <ol class="breadcrumb">
       <li class="breadcrumb-item">
          <a href="{{ route('client.dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Garage Transaction</li>
      </ol>
    </section>
   
   <section class="content">

   
    <div class="row">
      <div class="col-12">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
         @if (session('status'))
              <div class="alert alert-success">
                  {{ session('status') }}
              </div>
          @endif
      </div>
    </div>


     
       <div class="box">
          <!--div class="row">

            <div class="col-lg-4 col-xs-6">
              <div class="small-box bg-green">
                <div class="inner">
                  <h3>AED {{ number_format( ($cps_total_amount + $sr_total_amount) , 2) }}</h3>
                        <p>Total Amount</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-xs-6">
              <div class="small-box bg-blue">
                <div class="inner">
                  <h3>AED {{ number_format($cps_total_amount,2) }}</h3>
                        <p>Package Subscritpion Amount</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
              </div>
            </div>

             <div class="col-lg-4 col-xs-6">
              <div class="small-box bg-red">
                <div class="inner">
                  <h3>AED {{ number_format($sr_total_amount,2) }}</h3>
                        <p>Service Request Amount</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
              </div>
            </div>
          </div--> 

          <div class="row">
            <div class="col-md-6">
              <div class="box-header"><i class="fa fa-list"></i> Package Subscription Payments</div>
              <div class="box-body">
               <div class="table-responsive">
                 <table class="table table-head-fixed table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                       <tr>
                        <th>Record #</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                          <th>Record #</th>
                          <th>Date</th>
                          <th>Amount</th>
                          <th>Status</th>
                      </tr>
                    </tfoot>
                    <tbody>
                      @if(!empty($cps_payments) && count($cps_payments) > 0)
                        @foreach($cps_payments as $list)
                          <tr>
                            <td>
                              @if($list->is_custom == 1)
                                <a class="btn btn-sm btn-outline-danger" href="{{route('garage.customers.packages-subscribed.custom.settings',['id' => $list->id ])}}">View # {{ $list->id }}</a>
                              @else
                                <a class="btn btn-sm btn-outline-danger" href="{{route('garage.customers.packages-subscribed.settings',['id' => $list->id ])}}">View # {{ $list->id }}</a>
                              @endif
                            </td>
                            <td>{{ $list->date }}</td>
                            <td>AED {{ number_format($list->amount, 2) }}</td>
                            <td>
                              @if($list->status == 1)
                                Success
                              @elseif($list->status == 3)
                                Failed
                              @else
                                Pending
                              @endif
                            </td>
                          </tr>
                         @endforeach
                      @else
                        <tr>
                          <td colspan="4">
                              No Payemnt History Found.
                          </td>
                        </tr>
                      @endif
                    </tbody>
                  </table>
                </div>
                </div>
            </div>


            <div class="col-md-6">
                <div class="box-header"><i class="fa fa-list"></i> Service Request Payments</div>
                 <div class="box-body">
                <div class="table-responsive">
                 <table class="table table-head-fixed table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                       <tr>
                        <th>Record #</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                           <th>Record #</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Status</th>
                      </tr>
                    </tfoot>
                    <tbody>
                      @if(!empty($csr_payments) && count($csr_payments) > 0)
                        @foreach($csr_payments as $list)
                          <tr>
                          <td> 
                            <a class="btn btn-sm btn-outline-danger "  href="{{ route('garage.customers.service-request.settings',['id' => $list->id ])}}">
                              View # {{ $list->id }}
                            </a>
                          </td>
                           <td>{{ $list->date }}</td>
                            <td>AED {{ number_format($list->amount, 2) }}</td>
                            <td>
                              @if($list->status == 1)
                                Success
                              @elseif($list->status == 3)
                                Failed
                              @else
                                Pending
                              @endif
                            </td>
                          </tr>
                         @endforeach
                      @else
                        <tr>
                          <td colspan="4">
                              No Payemnt History Found.
                          </td>
                        </tr>
                      @endif
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

@stop


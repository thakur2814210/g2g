@extends('admin::layouts.master')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Customers Package Subscription Payment</h1>
    <ol class="breadcrumb">
      <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
      <li class="active">Customers Package Subscription Payment</li>
    </ol>
  </section>

  <!-- Main content -->
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

     <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header">
            <div class="container-fluid">
                <div class="row">
                  <div class="col-lg-12 form-inline" id="contact-form">
                    <form>
                       <div class="form-group">
                        <span>Status Filter:</span>
                         <select class="custom-select mr-sm-2" id="f_status" name="f_status">
                            <option value="all">All</option>
                            <option value="success">Success</option>
                            <option value="failed">Failed</option>
                            <option value="pending">Pending</option>
                            <option value="required-payment-approval">Required-Payment-Approval</option>
                          </select>
                      </div>
                      </form>
                   </div>
                  </div>
                </div>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-xs-12">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                           <th>Date</th>
                          <th>Amount</th>
                          <th>Commission</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tfoot>
                          <tr>
                          <th>Date</th>
                          <th>Amount</th>
                          <th>Commission</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </tfoot>
                      <tbody>
                        @if(!empty($clientPackageSubscribes) && count($clientPackageSubscribes) > 0)
                          @foreach($clientPackageSubscribes as $clientPackageSubscribe)
                            <tr>
                               <td>{{ date('Y-m-d', strtotime($clientPackageSubscribe->date)) }}</td>
                              <td>AED {{ number_format($clientPackageSubscribe->amount,2) }}</td>
                              <td>
                                @php
                                      $commission_amount = $commission->client_package_subscription;
                                      if($commission_amount > 0)
                                        $f_amount = (float) ($clientPackageSubscribe->amount / $commission_amount);
                                      else
                                        $f_amount = 0;
                                @endphp
                                AED {{ number_format($f_amount,2) }}

                              </td>
                              <td>
                                   @if($clientPackageSubscribe->status == 1)
                                      Success
                                    @elseif($clientPackageSubscribe->status == 2)
                                      Failed
                                    @elseif($clientPackageSubscribe->status == 3)
                                      Pending
                                    @elseif($clientPackageSubscribe->status == 4)
                                      Required-Payment-Approval
                                    @endif
                              </td>
                               <td>
                                <a class="btn btn-sm btn-outline-danger "  href="{{route('superadmin.subscriptions.clients.settings',['id' => $clientPackageSubscribe->id])}}">
                                  Manage
                                </a>
                              </td>
                              
                            </tr>
                           @endforeach
                        @else
                          <tr>
                            <td colspan="4">
                                No payment Found.
                            </td>
                          </tr>
                        @endif
                      </tbody>
                    </table>
                    @if(!empty($clientPackageSubscribes) && count($clientPackageSubscribes) > 0)
                  <div class="col-xs-12 text-right">
                    {{$clientPackageSubscribes->links()}}
                  </div>
                 @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

       
@stop


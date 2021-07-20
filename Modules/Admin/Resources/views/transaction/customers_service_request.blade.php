@extends('admin::layouts.master')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Customer Service Request Payment</h1>
    <ol class="breadcrumb">
      <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
      <li class="active">Customer Service Request Payment</li>
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
                        @if(!empty($serviceRequests) && count($serviceRequests) > 0)
                          @foreach($serviceRequests as $serviceRequest)
                            <tr>
                              <td>{{ date('Y-m-d', strtotime($serviceRequest->date)) }}</td>
                              <td>AED {{ number_format($serviceRequest->amount,2) }}</td>
                              <td>
                                @php
                                      $commission_amount = $commission->service_request;
                                      if($commission_amount > 0)
                                        $f_amount = (float) ($serviceRequest->amount / $commission_amount);
                                      else
                                        $f_amount = 0;
                                @endphp
                                AED {{ number_format($f_amount,2) }}
                              </td>
                              <td>
                                   @if($serviceRequest->status == 1)
                                      Success
                                    @elseif($serviceRequest->status == 2)
                                      Failed
                                    @elseif($serviceRequest->status == 3)
                                      Pending
                                    @elseif($serviceRequest->status == 4)
                                      Required-Payment-Approval
                                    @endif
                              </td>
                              <td>
                                 <a class="btn btn-sm btn-outline-danger "  href="{{ route('superadmin.service-requests.view',['id' => $serviceRequest->id]) }}">
                                Manage
                              </a>
                              </td>
                              
                            </tr>
                           @endforeach
                        @else
                          <tr>
                            <td colspan="7">
                                No Customer Service Request Payment Found.
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
        </div>
      </section>
    </div>
@stop


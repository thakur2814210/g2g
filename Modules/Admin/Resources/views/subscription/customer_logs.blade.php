@extends('admin::layouts.master')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Customer Package Subscription Logs</h1>
    <ol class="breadcrumb">
      <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
       <li class="breadcrumb-item">
          <a href="{{ route('superadmin.subscriptions.clients.list') }}">Customer Package Subscription List</a></li>
        </li>
      <li class="active">Customer Package Subscription Logs</li>
    </ol>
  </section>

   
   <section class="content">



     
       <div class="box box-danger">
        <div class="box-header">
         Package Subscription Logs : {{ $clientPackageSubscribe->servicePackage->name }}
       </div>
       
          <div class="box-body">
            <table class="table table-head-fixed table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                  <tr style="background: #e9ecef">
                  <th>Date</th>
                  <th>Description</th>
                </tr>
              </thead>
              <tfoot>
                 <tr style="background: #e9ecef">
                    <th>Date</th>
                    <th>Description</th>
                </tr>
              </tfoot>
              <tbody>
                @if(!empty($logs) && count($logs) > 0)
                  @foreach($logs as $log)
                    <tr>
                      <td>{{ date('M d, Y', strtotime($log->date)) }}</td>
                      <td>{{ $log->description }}</td>
                    </tr>
                   @endforeach
                @else
                  <tr>
                    <td colspan="3">
                        No logs Found.
                    </td>
                  </tr>
                @endif
              </tbody>
            </table>
          </div>
        </div>
      </section>
    </div>
   

@stop

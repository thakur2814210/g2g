@extends('garage.layout')




@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Package Subscription Logs</h1>
      <ol class="breadcrumb">
       <li class="breadcrumb-item">
           <a href="{{ route('garage.dashboard') }}"><i class="fa fas fa-home"></i> Dashboard</a>
        </li>
         <li class="breadcrumb-item">
          <a href="{{ route('garage.customers.packages-subscribed') }}">Customers Package Subscription List</a></li>
        </li>
        <li class="breadcrumb-item active">Package Subscription Logs </li>
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

    
     
       <div class="box box-solid box-info">
        <div class="box-header">
         Package Subscription Logs : {{ $ps->client->user->first_name . ' ' . $ps->client->user->last_name }}
       </div>
       
          <div class="box-body table-responsive">
            <table class="table table-head-fixed table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                  <tr style="background: #e9ecef">
                  <th>Date</th>
                  <th>Description</th>
                </tr>
              </thead>
              <tfoot>
                 <tr style="background: #e9ecef">
                    <th width="15%">Date</th>
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



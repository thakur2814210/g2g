@extends('garage.layout')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> {{ trans('labels.Manage Vendors') }} <small>{{$pageTitle}}...</small> </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('garage.dashboard')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
      <li class="active">{{ trans('labels.Manage Vendors') }}</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Info boxes -->

    <!-- /.row -->

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-xs-12">

          @if (count($errors) > 0)
            @if($errors->any())
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              {{$errors->first()}}
            </div>
            @endif
          @endif
              </div>

            </div>
            <div class="row">
              <div class="col-xs-12">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>{{ trans('labels.ID') }}</th>
                      <th>{{ trans('labels.TRX #') }}</th>
                      <th>{{ trans('labels.ShopName') }}</th>
                      <th>{{ trans('labels.Methods') }}</th>
                      <th>{{ trans('labels.Amount') }}</th>
                      <th>{{ trans('labels.Charge') }}</th>
                       <th>{{ trans('labels.Time') }}</th>
                      <th>{{ trans('labels.Status') }}</th>
                      <th>{{ trans('labels.Action') }}</th>                       
                    </tr>
                  </thead>
                  <tbody>
                   @if (count($result['admins']) > 0)
                      @foreach ($result['admins']  as $key=>$admin)
                        <tr>
                          <td>{{ $admin->id }}</td>
                          <td>{{ $admin->trx }} </td>
                          <td>{{ $admin->shop_name }}</td>
                          <td>{{ $admin->name }} </td>
                          <td>{{ $admin->amount }} </td>
                          <td>{{ $admin->charge }} </td>
                          <td>{{ date('l jS \\of F Y h:i:s A' , strtotime($admin->created_at))}}</td>
                          <td>
                            @if($admin->status== 'pending')
                              <strong class="badge bg-yellow">
                            @elseif($admin->status== 'refunded')
                              <strong class="badge bg-blue">
                            @elseif($admin->status== 'processed')
                              <strong class="badge bg-green">
                            @endif
                              {{$admin->status}}</strong>
                          </td>
                          <td>
                              <a href="{{ URL::to('partner/vendor/transactions/withdrawLog')}}/{{$admin->id}}" type="button" class="btn btn-sm btn-primary" target="_blank" >{{ trans('labels.Details') }}</a>
                          </td>
                        </tr>
                      @endforeach
                    @else
                      <tr>
                       <td colspan="9">{{ trans('labels.NoRecordFound') }}</td>
                      </tr>
                    @endif
                  </tbody>
                </table>
                @if (count($result['admins']) > 0)
                  <div class="col-xs-12 text-right">
                    {{$result['admins']->links()}}
                  </div>
                 @endif
              </div>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>

    <div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel">
    <div class="modal-dialog" role="document">
    <div class="modal-content notificationContent">

    </div>
    </div>
  </div>

    <!-- Main row -->

    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
@endsection

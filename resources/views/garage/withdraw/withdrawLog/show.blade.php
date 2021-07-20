@extends('garage.layout')
@section('content')
<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> {{ trans('labels.WithdrawLog') }} <small>{{$pageTitle }}...</small> </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('garage.dashboard')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
      <li><a href="{{ URL::to('partner/vendors/active')}}"><i class="fa fa-users"></i> {{ trans('labels.Active Vendors') }}</a></li>
      <li class="active">{{ trans('labels.Add Vendors') }}</li>
    </ol>
  </section>
  
  <!-- Main content -->
  <section class="content"> 
    <!-- Info boxes --> 
    
    <!-- /.row -->

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">{{ $pageTitle }} </h3>
          </div>
          
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-xs-12">
                  <div class="box box-info">
                        <br>                       
                        
                        @if(session()->has('message'))
                            <div class="alert alert-success" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                              {{ session()->get('message') }}
                            </div>
                        @endif
                        
                        @if(session()->has('errorMessage'))
                            <div class="alert alert-danger" role="alert">
                               <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                {{ session()->get('errorMessage') }}
                            </div>
                        @endif

                        @if ($errors->any())
                         <div class="alert alert-danger" role="alert">
                             <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <ul>
                                  @foreach ($errors->all() as $error)
                                      <li>{{ $error }}</li>
                                  @endforeach
                              </ul>
                          </div>
                        @endif
                        
                        <!-- form start -->                        
                         <div class="box-body">

                          @if(Auth()->user()->role_id === 1)

                            <div class="row">
                              <div class="col-md-6"><h4 class="text-red text-uppercase"><b>{{ trans('labels.Withdraw Request') }}</b></h4>
                            <hr> 
                            <table class="table table-bordered table-striped">
                              <tbody>
                                 <tr class="bg-blue">
                                  <td width="30%"><b>{{ trans('labels.Requested By')}}</b></td>
                                  <td>{{ $result['admins']->shop_name }} ( {{ $result['admins']->user_email }})</td>
                                 
                                </tr>
                                <tr>
                                  <td width="30%"><b>{{ trans('labels.Requested On')}}</b></td>
                                  <td>{{ date('l jS \\of F Y h:i:s A' , strtotime($result['admins']->created_at))}}</td>
                                </tr>
                                <tr>
                                  <td width="30%"><b>{{ trans('labels.Transaction #')}}</b></td>
                                  <td>{{ $result['admins']->trx }}</td>
                                </tr>
                                <tr class="bg-blue">
                                  <td width="30%"><b>{{ trans('labels.Methods')}}</b></td>
                                  <td>{{ $result['admins']->name }}</td>
                                </tr>
                                 <tr>
                                  <td width="30%"><b>{{ trans('labels.Amount')}}</b></td>
                                  <td>{{ $result['admins']->amount }}</td>
                                </tr>
                                  <tr>
                                  <td width="30%"><b>{{ trans('labels.Charge')}}</b></td>
                                  <td>{{ $result['admins']->charge }}</td>
                                </tr>
                                <tr class="bg-yellow">
                                  <td width="30%"><b>{{ trans('labels.Status')}}</b></td>
                                  <td>{{ $result['admins']->status }}</td>
                                </tr>
                                <tr>
                                  <td width="30%"><b>{{ trans('labels.Details')}}</b></td>
                                  <td>{{ $result['admins']->details }}</td>
                                </tr>
                              </tbody>
                            </table></div>
                              <div class="col-md-6">{!! Form::open(array('url' =>'partner/transactions/withdrawLog/message/store', 'method'=>'post', 'class' => 'form-horizontal form-validate')) !!}
                              {!! Form::hidden('wID',  $result['wID'], array('id'=>'wID')) !!}
                            
                            
                            <h4 class="text-red text-uppercase"><b>{{ trans('labels.Take Action') }}</b></h4>
                            <hr> 
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 control-label">{{ trans('labels.Message or Reason') }} *</label>
                                  <div class="col-sm-10 ">
                                    {!! Form::textarea('message',  '', array('class'=>'form-control field-validate', 'id'=>'message')) !!}
                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.Enter message or reason about money transfer') }}</span>
                                    <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                  </div>
                                </div>
                               
                               
                            
                                
                              <!-- /.box-body -->
                              <div class="box-footer text-center">
                                <button type="submit" name="status" value="processed" class="btn btn-primary">{{ trans('labels.Processed') }}</button>

                                 <button type="submit" name="status" value="refunded" class="btn btn-danger">{{ trans('labels.Refund') }}</button>

                                <a href="{{ URL::to('partner/transactions/withdrawLog')}}" type="button" class="btn btn-default">{{ trans('labels.back') }}</a>
                              </div>
                              <!-- /.box-footer -->
                            {!! Form::close() !!}</div>
                            </div>


                            
                            @else

                              <h4 class="text-red text-uppercase"><b>{{ trans('labels.Withdraw Request') }}</b></h4>
                            <hr> 
                            <table class="table table-bordered table-striped">
                              <tbody>
                                 <tr class="bg-blue">
                                  <td width="30%"><b>{{ trans('labels.Requested By')}}</b></td>
                                  <td>{{ $result['admins']->shop_name }} ( {{ $result['admins']->user_email }})</td>
                                 
                                </tr>
                                <tr>
                                  <td width="30%"><b>{{ trans('labels.Requested On')}}</b></td>
                                  <td>{{ date('l jS \\of F Y h:i:s A' , strtotime($result['admins']->created_at))}}</td>
                                </tr>
                                <tr>
                                  <td width="30%"><b>{{ trans('labels.Transaction #')}}</b></td>
                                  <td>{{ $result['admins']->trx }}</td>
                                </tr>
                                <tr class="bg-blue">
                                  <td width="30%"><b>{{ trans('labels.Methods')}}</b></td>
                                  <td>{{ $result['admins']->name }}</td>
                                </tr>
                                 <tr>
                                  <td width="30%"><b>{{ trans('labels.Amount')}}</b></td>
                                  <td>{{ $result['admins']->amount }}</td>
                                </tr>
                                  <tr>
                                  <td width="30%"><b>{{ trans('labels.Charge')}}</b></td>
                                  <td>{{ $result['admins']->charge }}</td>
                                </tr>
                                <tr class="bg-yellow">
                                  <td width="30%"><b>{{ trans('labels.Status')}}</b></td>
                                  <td>{{ $result['admins']->status }}</td>
                                </tr>
                                <tr>
                                  <td width="30%"><b>{{ trans('labels.Details')}}</b></td>
                                  <td>{{ $result['admins']->details }}</td>
                                </tr>
                              </tbody>
                            </table>

                            @endif


                            
                        </div>
                  </div>
              </div>
            </div>
            
          </div>
          <!-- /.box-body --> 
        </div>
        <!-- /.box --> 
      </div>
      <!-- /.col --> 
    </div>
    <!-- /.row --> 
    
    <!-- Main row --> 
    
    <!-- /.row --> 
  </section>
  <!-- /.content --> 
</div>
@endsection 
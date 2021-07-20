@extends('admin.layout')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> {{ trans('labels.ManageTransaction') }} <small>{{$pageTitle}}...</small> </h1>
    <ol class="breadcrumb">
      <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
      <li class="active">{{ trans('labels.ManageTransaction') }}</li>
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
                      <th>{{ trans('labels.Name') }}</th>
                      <th>{{ trans('labels.Limit/Trx') }}</th>
                      <th>{{ trans('labels.Charge/Trx') }}</th>
                      <th>{{ trans('labels.Process Time') }}</th>
                      <th>{{ trans('labels.Action') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                   @if (count($result['admins']) > 0)
                      @foreach ($result['admins']  as $key=>$admin)
                        <tr>
                          <td>{{$admin->name}}</td>
                          <td><b>
                            {{$admin->min_limit}} </b> TO <b>{{$admin->max_limit}} 
                             @if(!empty($result['commonContent']['currency']->symbol_left)) {{$result['commonContent']['currency']->symbol_left}} @endif 
                             @if(!empty($result['commonContent']['currency']->symbol_right)) {{$result['commonContent']['currency']->symbol_right}} @endif
                          </b></td>
                          <td><b>{{$admin->fixed_charge}} </b> + <b>{{$admin->percentage_charge}} %</b></td>
                          <td><b>{{$admin->process_time}}</b></td>
                          
                          
                          <td>
                              <a href="javascript::void(0)" type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="bottom" title="{{ trans('labels.WithdrawMoney') }}" id="WithdrawMoneyForm" withdraw_method_id="{{ $admin->id }}">{{ trans('labels.WithdrawMoney') }}</a>
                          </td>
                     </tr>
                    @endforeach
                    @else
                      <tr>
                        <td colspan="5">{{ trans('labels.NoRecordFound') }}</td>
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

    <!-- /.row -->

    <!-- deleteCustomerModal -->
  <div class="modal fade" id="WithdrawMoneyFormModal" tabindex="-1" role="dialog" aria-labelledby="WithdrawMoneyFormModalLabel">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title" id="WithdrawMoneyFormModalLabel">{{ trans('labels.Request Money Withdraw') }}</h4>
      </div>
      {!! Form::open(array('url' =>'admin/vendor/transactions/withdrawRequest/store', 'name'=>'WithdrawMoneyMethod', 'id'=>'WithdrawMoneyMethod', 'method'=>'post', 'class' => 'form-horizontal')) !!}
          {!! Form::hidden('action',  'delete', array('class'=>'form-control')) !!}
          {!! Form::hidden('withdraw_method_id', '', array('class'=>'form-control', 'id'=>'withdraw_method_id')) !!}
      <div class="modal-body">
          <div class="form-group">
            <label for="name" class="col-sm-2 control-label">{{ trans('labels.Amount') }} </label>
            <div class="col-sm-10">
              {!! Form::text('amount',  '', array('class'=>'form-control field-validate', 'id'=>'amount')) !!}
              <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.Enter amount you want to withdraw') }}</span>
              <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
            </div>
          </div>
          <div class="form-group">
            <label for="name" class="col-sm-2 control-label">{{ trans('labels.Details') }} </label>
            <div class="col-sm-10">
              {!! Form::textarea('details',  '', array('class'=>'form-control field-validate', 'id'=>'details')) !!}
              <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.Enter your details to process money transfer') }}</span>
              <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
            </div>
          </div> 
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.Close') }}</button>
      <button type="submit" class="btn btn-primary">{{ trans('labels.Send Withdraw Request') }}</button>
      </div>
      {!! Form::close() !!}
    </div>
    </div>
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

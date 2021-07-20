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
          <div class="box-header">
            <h3 class="box-title">{{$pageTitle}}</h3>
            <div class="box-tools pull-right">
              <a href="{{ URL::to('admin/transactions/withdrawMethod/add')}}" type="button" class="btn btn-block btn-primary">{{ trans('labels.addnew') }}</a>
            </div>
          </div>
          
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
                      <th>{{ trans('labels.Status') }}</th>
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
          							  <td>@if($admin->deleted == 1) <b class="text-red">{{ trans('labels.disable')}} </b> @else <b class="text-success">{{ trans('labels.enable') }}</b> @endif</b></td>
          							  
								          <td>
                                <ul class="nav table-nav">
                              <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                  {{ trans('labels.Action') }} <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ URL::to('admin/transactions/withdrawMethod/edit')}}/{{ $admin->id }}">{{ trans('labels.Edit') }}</a></li>
                                    <li role="presentation" class="divider"></li>

                                    @if($admin->deleted == 1)
                                      <li role="presentation"><a data-toggle="tooltip" data-placement="bottom" title="{{ trans('labels.enable') }}" id="enableWithdrawMethodForm" enable_withdraw_method_id="{{ $admin->id }}">{{ trans('labels.enable') }}</a></li>
                                    @else
                                       <li role="presentation"><a data-toggle="tooltip" data-placement="bottom" title="{{ trans('labels.disable') }}" id="disableWithdrawMethodForm" disable_withdraw_method_id="{{ $admin->id }}">{{ trans('labels.disable') }}</a></li>
                                    @endif
                                </ul>
                              </li>
                            </ul>
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
	<div class="modal fade" id="enableWithdrawMethodModal" tabindex="-1" role="dialog" aria-labelledby="enableWithdrawMethodModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="enableWithdrawMethodModalLabel">{{ trans('labels.Enable Withdraw Method') }}</h4>
		  </div>
		  {!! Form::open(array('url' =>'admin/transactions/withdrawMethod/enable', 'name'=>'enableWithdrawMethod', 'id'=>'enableWithdrawMethod', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
				  {!! Form::hidden('action',  'delete', array('class'=>'form-control')) !!}
				  {!! Form::hidden('enable_withdraw_method_id', '', array('class'=>'form-control', 'id'=>'enable_withdraw_method_id')) !!}
		  <div class="modal-body">
			  <p>{{ trans('labels.Are you sure you want to enable this withdraw method') }} ?</p>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.Close') }}</button>
			<button type="submit" class="btn btn-primary">{{ trans('labels.enable') }}</button>
		  </div>
		  {!! Form::close() !!}
		</div>
	  </div>
	</div>

  <div class="modal fade" id="disableWithdrawMethodModal" tabindex="-1" role="dialog" aria-labelledby="disableWithdrawMehodLabel">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title" id="disableWithdrawMehodLabel">{{ trans('labels.Disable Withdraw Method') }}</h4>
      </div>
      {!! Form::open(array('url' =>'admin/transactions/withdrawMethod/delete', 'name'=>'disableWithdrawMethod', 'id'=>'disableWithdrawMethod', 'method'=>'post', 'class' => 'form-horizontal')) !!}
          {!! Form::hidden('action',  'delete', array('class'=>'form-control')) !!}
          {!! Form::hidden('disable_withdraw_method_id', '', array('class'=>'form-control', 'id'=>'disable_withdraw_method_id')) !!}
      <div class="modal-body">
        <p>{{ trans('labels.Are you sure you want to disable this withdraw method') }}?</p>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.Close') }}</button>
      <button type="submit" class="btn btn-primary">{{ trans('labels.disable') }}</button>
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

@extends('garage.layout')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
     <h1> {{ $pageTitle }} <small>{{$pageTitle }}...</small> </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('garage.dashboard')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
      <li><a href="{{ URL::to('partner/vendors/active')}}"><i class="fa fa-users"></i> {{ trans('labels.Active Vendors') }}</a></li>
      <li class="active">{{ trans('labels.EditVendor') }}</li>
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
            <h3 class="box-title">{{ trans('labels.EditVendor') }} </h3>
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

                        <!-- form start -->
                         <div class="box-body">
                            {!! Form::open(array('url' =>'partner/updatevendor', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')) !!}
                            {!! Form::hidden('myid', $result['myid'], array('id'=>'myid')) !!}
                          <div class="form-group">
                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.ShopName') }} </label>
                                <div class="col-sm-10 col-md-4">
                                  {!! Form::text('shop_name', $result['admins'][0]->shop_name, array('class'=>'form-control field-validate', 'id'=>'shop_name')) !!}
                                  <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.ShopNameText') }}</span>
                                  <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                </div>
                              </div>
                            <hr>
                            <h4>{{ trans('labels.Personal Info') }} </h4>
                            <hr>
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.FirstName') }} </label>
                                  <div class="col-sm-10 col-md-4">
                                    {!! Form::text('first_name',  $result['admins'][0]->first_name, array('class'=>'form-control field-validate', 'id'=>'first_name')) !!}
                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.FirstNameText') }}</span>
                                    <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.LastName') }} </label>
                                  <div class="col-sm-10 col-md-4">
                                    {!! Form::text('last_name',  $result['admins'][0]->last_name, array('class'=>'form-control field-validate', 'id'=>'last_name')) !!}
                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.lastNameText') }}</span>
                                    <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Telephone') }}</label>
                                  <div class="col-sm-10 col-md-4">
                                    {!! Form::text('phone',  $result['admins'][0]->phone, array('class'=>'form-control', 'id'=>'phone')) !!}
                                   <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                   {{ trans('labels.TelephoneText') }}</span>
                                  </div>
                                </div>
                                <hr>
                                <h4>{{ trans('labels.Login Info') }}</h4>
                                <hr>

                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.EmailAddress') }} </label>
                                  <div class="col-sm-10 col-md-4">
                                     {!! Form::text('email',  $result['admins'][0]->email, array('class'=>'form-control email-validate', 'id'=>'email')) !!}
                                     <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                     {{ trans('labels.EmailText') }}</span>
                                    <span class="help-block hidden"> {{ trans('labels.EmailError') }}</span>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.changePassword') }}</label>
                                  <div class="col-sm-10 col-md-4">
                                    {!! Form::checkbox('changePassword', 'yes', null, ['class' => '', 'id'=>'change-passowrd']) !!}
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Password') }}</label>
                                  <div class="col-sm-10 col-md-4">
                                    {!! Form::password('password', array('class'=>'form-control', 'id'=>'password')) !!}
                	                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                   {{ trans('labels.PasswordText') }}</span>
                                    <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Status') }} </label>
                                  <div class="col-sm-10 col-md-4">
                                    <select class="form-control" name="isActive">
                                          <option value="1" @if($result['admins'][0]->status==1) selected @endif>{{ trans('labels.Active') }}</option>
                                          <option value="3" @if($result['admins'][0]->status==3) selected @endif>{{ trans('labels.Inactive') }}</option>
                                           <option value="2" @if($result['admins'][0]->status==2) selected @endif>{{ trans('labels.Pending') }}</option>
									</select>
                                  <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                  {{ trans('labels.StatusText') }}</span>
                                  </div>
                                </div>

                              <!-- /.box-body -->
                              <div class="box-footer text-center">
                                <button type="submit" class="btn btn-primary">{{ trans('labels.Submit') }}</button>
                                <a href="{{ URL::to('partner/vendors/active')}}" type="button" class="btn btn-default">{{ trans('labels.back') }}</a>
                              </div>
                              <!-- /.box-footer -->
                            {!! Form::close() !!}
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

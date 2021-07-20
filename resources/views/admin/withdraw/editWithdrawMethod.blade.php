@extends('admin.layout')
@section('content')
<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> {{ $pageTitle }} <small>{{$pageTitle }}...</small> </h1>
    <ol class="breadcrumb">
      <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
      <li><a href="{{ URL::to('admin/vendors/active')}}"><i class="fa fa-users"></i> {{ trans('labels.Active Vendors') }}</a></li>
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
                            {!! Form::open(array('url' =>'admin/transactions/withdrawMethod/update', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')) !!}
                              {!! Form::hidden('wmID',  $result['admins']->id, array('id'=>'wmID')) !!}
                            <div class="form-group">
                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Method Name') }} </label>
                                <div class="col-sm-10 col-md-4">
                                  {!! Form::text('methodName',  $result['admins']->name, array('class'=>'form-control field-validate', 'id'=>'methodName')) !!}
                                  <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.MethodNameText') }}</span>
                                  <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                </div>
                              </div>

                              <div class="form-group">
                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Process Time') }} ({{trans('labels.Days')}})</label>
                                <div class="col-sm-10 col-md-4">
                                  {!! Form::number('processTime',  $result['admins']->process_time, array('class'=>'form-control field-validate', 'id'=>'processTime')) !!}
                                  <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.ProcessTimeText') }}</span>
                                  <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                </div>
                              </div>
                            <hr>
                            <h4>{{ trans('labels.Limit Per Transaction') }} </h4>
                            <hr> 
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Minimum') }} </label>
                                  <div class="col-sm-10 col-md-4">
                                    {!! Form::number('minimum',  $result['admins']->min_limit, array('class'=>'form-control field-validate', 'id'=>'minimum')) !!}
                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.MinimumText') }}</span>
                                    <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Maximum') }} </label>
                                  <div class="col-sm-10 col-md-4">
                                    {!! Form::number('maximum',  $result['admins']->max_limit, array('class'=>'form-control field-validate', 'id'=>'maximum')) !!}
                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.MaximumText') }}</span>
                                    <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                  </div>
                                </div> 
                               
                            <hr>
                            <h4>{{ trans('labels.Charge Per Transaction') }}</h4>
                            <hr>
                                
                                 <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.fixedCharge') }} </label>
                                  <div class="col-sm-10 col-md-4">
                                    {!! Form::text('charged', $result['admins']->fixed_charge, array('class'=>'form-control field-validate', 'id'=>'charged')) !!}
                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.fixedChargeText') }}</span>
                                    <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.percentageCharge') }} </label>
                                  <div class="col-sm-10 col-md-4">
                                    {!! Form::text('chargep',  $result['admins']->percentage_charge, array('class'=>'form-control field-validate', 'id'=>'chargep')) !!}
                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.percentageChargeText') }}</span>
                                    <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                  </div>
                                </div> 
                                
                              <!-- /.box-body -->
                              <div class="box-footer text-center">
                                <button type="submit" class="btn btn-primary">{{ trans('labels.Submit') }}</button>
                                <a href="{{ URL::to('admin/transactions/withdrawMethod')}}" type="button" class="btn btn-default">{{ trans('labels.back') }}</a>
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
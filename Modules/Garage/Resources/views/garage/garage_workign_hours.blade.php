@extends('garage.layout')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Garage Working Hours</h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('garage.dashboard')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
      <li class="active">Garage Working Hours</li>
    </ol>
  </section>


  <!-- Main content -->
  <section class="content">
    <div class="row">
          <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                  <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-info">
                          <br>
                          <div class="row">
                              <div class="col-md-12">
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
                                    <div class="alert alert-warning">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                 @if (isset($status))
                                    <div class="alert alert-warning">
                                        {{ $status }}
                                    </div>
                                @endif
                              </div>
                            </div>

                           
              
                            <div class="box-body">

                              <form class="form-horizontal" method="POST" action="{{ route('garage.working-hours.update')}}"  enctype="multipart/form-data">
                                
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ $garage->id }}" />

                                 <input type="hidden" name="form_action" value="{{!empty($garage_working_hours) ? 'update' : 'insert'}}" />

                                <div class="box-body">


                               
                                    @php
                                    $days = [
                                        'mon' => 'Monday',
                                        'tue' => 'Tuesday',
                                        'wed' => 'Wednessday',
                                        'thu' => 'Thrusday',
                                        'fri' => 'Friday',
                                        'sat' => 'Saturday',
                                        'sun' => 'Sunday',
                                      ];
                                      $optionTime = [
                                        'Closed', 
                                        '12:00 AM',
                                        '00:30 AM',
                                        '01:00 AM',
                                        '01:30 AM',
                                        '02:00 AM',
                                        '02:30 AM',
                                        '03:00 AM',
                                        '03:30 AM',
                                        '04:00 AM',
                                        '04:30 AM',
                                        '05:00 AM',
                                        '05:30 AM',
                                        '06:00 AM',
                                        '06:30 AM',
                                        '07:00 AM',
                                        '07:30 AM',
                                        '08:00 AM',
                                        '08:30 AM',
                                        '09:00 AM',
                                        '09:30 AM',
                                        '10:00 AM',
                                        '10:30 AM',
                                        '11:00 AM',
                                        '11:30 AM',
                                        '12:00 PM',
                                        '00:30 PM',  
                                        '01:00 PM',
                                        '01:30 PM',
                                        '02:00 PM',
                                        '02:30 PM',
                                        '03:00 PM',
                                        '03:30 PM',
                                        '04:00 PM',
                                        '04:30 PM',
                                        '05:00 PM',
                                        '05:30 PM',
                                        '06:00 PM',
                                        '06:30 PM',
                                        '07:00 PM',
                                        '07:30 PM',
                                        '08:00 PM',
                                        '08:30 PM',
                                        '09:00 PM',
                                        '09:30 PM',
                                        '10:00 PM',
                                        '10:30 PM',
                                        '11:00 PM',
                                        '11:30 PM',
                                      ];
                                 @endphp

                                  @foreach($days as $index => $day )

                                   
                                      @php
                                        $open_time = $close_time = null;
                                        if(!empty($garage_working_hours) && isset($garage_working_hours[$index])){
                                          $tims_str = $garage_working_hours[$index];
                                          if (strpos($tims_str, '-') !== FALSE){
                                            $time_arr = explode("-",$tims_str);
                                            $open_time = $time_arr[0];
                                            $close_time = $time_arr[1];
                                          }else{
                                            $open_time = $tims_str;
                                            $close_time = $tims_str;
                                          }
                                        }
                                      @endphp
                                    <!-- /row-->
                                    <div class="row">
                                      <div class="col-md-2">
                                        <label class="fix_spacing">{{$day}}</label>
                                      </div>

                                      <div class="col-md-4">
                                        <div class="form-group">
                                          <div class="styled-select">
                                          <select name="ot_{{$index}}" class='form-control' required>
                                            @foreach($optionTime as $value )
                                              <option value="{{$value}}" @if(strcasecmp($open_time, $value) == 0) selected="selected" @endif>{{$value}}</option> 
                                            @endforeach
                                          </select>
                                          </div>
                                        </div>
                                      </div>
                                       <div class="col-md-1"></div>
                                      <div class="col-md-4">
                                        <div class="form-group">
                                          <div class="styled-select">
                                           <select name="ct_{{$index}}" class='form-control' required>
                                            @foreach($optionTime as $value )
                                              <option value="{{$value}}" @if(strcasecmp($close_time, $value) == 0) selected="selected" @endif>{{$value}}</option> 
                                            @endforeach
                                          </select>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <!-- /row-->
                                  @endforeach

                                  
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer text-center">
                                  <button type="submit" class="btn btn-danger"><i class="fa fa-save" ></i> Update Garage Information</button>
                                 
                                </div>
                                <!-- /.card-footer -->
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>
          </div>
@stop


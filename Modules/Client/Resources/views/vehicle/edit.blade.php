@extends('client::layouts.master')

@section('title', 'Client Dashboard')

@section('website_css')
   
@stop

@section('content')

    <ol class="breadcrumb padding_bottom">
      <li class="breadcrumb-item">
        <a href="{{ route('client.dashboard') }}">Dashboard</a>
      </li>
       <li class="breadcrumb-item">
        <a href="{{ route('client.vehicles') }}">Vehicles</a>
      </li>
      <li class="breadcrumb-item active">Edit Vehicle</li>
    </ol>
   
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
      <div class="col-12">
        <div class="card">
          <div class="card-header card-header-custom">
            <p class="card-title"><i class="fa fas fa-car"></i> Edit Vehicle: {{ $vehicles->name }}</p>
          </div>
         

          <div class="card-body table-responsive p-0">
            <form class="form-horizontal" method="POST" action="{{ route('client.vehicle.update')}}">
              {{ csrf_field() }}
              <input type="hidden" name="id" value="{{ $vehicles->id }}">
              <div class="card-body">

                 <div class="row">

                      <div class="col-4">
                         <div class="form-group">
                            <label class="col-12 col-form-label text-danger"> *Plate No</label>
                           <div class="col-12">
                              <input type="text" class="form-control" name="plate_no" id="plate_no" value="{{ $vehicles->plate_no }}" required="required" />
                            </div>
                          </div>
                      </div>

                       <div class="col-4">
                         <div class="form-group">
                          <label for="tag_slug" class="col-12 col-form-label text-danger"> *Make ( Selected : {{$vehicles->vmake->name}})</label>
                          <div class="col-12">
                            <select class="form-control" name="make" id="make" required="required">
                               <option value="">Select Vehicle Make</option>
                               @foreach($vehicle_makes as $make)
                                <option value="{{$make->id}}" @if($make->id == $vehicles->make) selected @endif data-url="{{ route('client.vehicle.model',['id' => $make->id])}}"  >{{$make->name}}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                    </div>

                    <div class="col-4">
                         <div class="form-group">
                            <label for="tag_slug" class="col-12 col-form-label text-danger"> *Model ( Selected : {{$vehicles->vmodel->name}})</label>
                            <div class="col-12">
                              <select class="form-control" name="model" id="model" required="required">
                                 <option>PLEASE WAIT . . .</option>
                              </select>
                            </div>
                          </div>
                    </div>

                    
                     
                </div>
               

                <div class="row">

                   <div class="col-4">
                      <div class="form-group">
                        <label class="col-12 col-form-label text-danger"> *Year</label>
                        <div class="col-12">
                          <input type="text" class="form-control" name="year" id="year" value="{{ $vehicles->year }}" required="required" />
                        </div>
                      </div>
                    </div>

                    <div class="col-4">
                         <div class="form-group">
                            <label class="col-12 col-form-label text-danger"> Registration No</label>
                            <div class="col-12">
                              <input type="text" class="form-control" name="registration_no" id="registration_no" value="{{ $vehicles->registration_no }}" />
                            </div>
                          </div>
                    </div>

                     <div class="col-4">
                         <div class="form-group">
                            <label class="col-12 col-form-label text-danger"> Chassis No</label>
                           <div class="col-12">
                              <input type="text" class="form-control" name="chassis_no" id="chassis_no" value="{{ $vehicles->chassis_no }}"  />
                            </div>
                          </div>
                     </div>

                     
                </div>
               

               

               
                <div class="row">

                   <div class="col-4">
                         <div class="form-group">
                            <label class="col-12 col-form-label text-danger"> Color</label>
                            <div class="col-12">
                              <input type="text" class="form-control" name="color" id="color" value="{{ $vehicles->color }}"  />
                            </div>
                          </div>
                    </div>

                   

                    <div class="col-4">
                        <div class="form-group">
                          <label class="col-12 col-form-label text-danger"> Current Mileage</label>
                           <div class="col-12">
                            <input type="text" class="form-control" name="current_mileage" id="current_mileage" value="{{ $vehicles->current_mileage }}" />
                          </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                          <label class="col-12 col-form-label text-danger"> *Status</label>
                          <div class="col-12">
                            <select class="form-control" name="status" id="status" required="required">
                              <option value="1"  @if( $vehicles->status == 1) selected @endif >Active</option>
                              <option value="3" @if( $vehicles->status == 3) selected @endif >Hold</option>
                              <option value="2" @if( $vehicles->status == 2) selected @endif >Delete</option>
                            </select>
                          </div>
                        </div>
                    </div>
                </div>

                

                
                


               
                <div class="form-group row">
                  <div class="col-12 text-center">
                    <button type="submit" class="btn btn-danger"><i class="fa fa-save" ></i> Update Vehicle Information</button>
                  </div>
                </div>

            </div>
            <div class="card-footer">
             
            </div>
          </form>
          </div>
        </div>
      </div>
    </div>
@stop


@section('website_js')
  <script type="text/javascript">
    
    $(document).ready(function (){
      $('select[name="make"]').on('change',function(){
        alert('adsd');
         var makeId = $(this).val();
         var dataUrl = $('#make option:selected').attr('data-url');
        $('select[name="model"]').html('<option>PLEASE WAIT . . .</option>');
        
        // tis url not working on live
         if(makeId){
            $.ajax({
               url : dataUrl,
               type : "GET",
               dataType : "json",
               success:function(data)
               {
                  $('select[name="model"]').empty();
                  $.each(data, function(key,value){
                     $('select[name="model"]').append('<option value="'+ key +'">'+ value +'</option>');
                  });
               }
            });
         }
         else{
          $('select[name="state"]').empty();
         }
      });
    });
  </script>
   
@stop

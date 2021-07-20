@extends('admin::layouts.master')

@section('title', 'Admin Dashboard')

@section('css')
  
@stop

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('superadmin.dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Set  Commissions </li>
    </ol>
@stop

@section('content')

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


  <div class="card">
      <div class="card-header bg-gray">
      Set  Commissions ( % )
      </div>

      <form class="form-horizontal" method="POST" action="{{ route('superadmin.general-settings.update')}}">
      {{ csrf_field() }}
    
      <div class="card-body">
        <div class="row">
          <div class="col-sm-12">
            <div class="form-group ">
              <label for="tag_name" class="col-sm-12 col-form-label">Google Map Key</label>
              <div class="col-sm-12">
                <input type="text" class="form-control" name="google_map_key" value="{{ isset($setting->google_map_key) ? $setting->google_map_key : null  }}" />
              </div>
            </div>
          </div>
       </div>
      </div>
       <div class="card-footer text-center">
        <button type="submit" class="btn btn-danger"><i class="fa fa-money" ></i> Update Setting</button>
      </div>
    </form>
    </div>
@stop
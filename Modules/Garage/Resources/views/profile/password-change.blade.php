@extends('garage::layouts.master')

@section('title', 'Client Dashboard')

@section('content_header')
    
@stop

@section('content')
   
   

    <!-- Breadcrumbs-->
      <ol class="breadcrumb padding_bottom">
        <li class="breadcrumb-item">
          <a href="{{ route('garage.dashboard') }}"><i class="fa fas fa-home"></i> Dashboard</a>
        </li>
        <li class="breadcrumb-item">
          <a href="{{ route('garage.profile.view') }}"><i class="fa fas fa-user-circle"></i> Profile</a>
        </li>
        <li class="breadcrumb-item"><i class="fa fas fa-lock"></i> Change Password</li>
       
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


        <div class="card">
          <div class="card-header card-header-custom">
            <p class="card-title"><i class="fa fas fa-user-circle"></i> Change Password</p>
          </div>

          <div class="card-body table-responsive p-3">
              <form class="form-horizontal" method="POST" action="{{ route('garage.profile.update-password')}}">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                <div class="form-group">
                  <label>New password</label>
                  <input class="form-control" type="password" name="password">
                </div>
                <div class="form-group">
                  <label>Confirm new password</label>
                  <input class="form-control" type="password" name="cpassword">
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-danger" ><i class="fa faw fa-lock"></i> Update Password</button>
                </div>
              </form>
          </div>
        </div>
          
@stop
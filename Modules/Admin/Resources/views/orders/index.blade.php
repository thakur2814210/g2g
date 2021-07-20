@extends('adminlte::page')

@section('title', 'manage orders')

@section('content_header')
    <h1>Manage Orders</h1>
    <hr/>
@stop

@section('content')
  
     <div class="row">
      <div class="col-12">
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
          <div class="card-header bg-gray">
            <h3 class="card-title ">Order List</h3>
          </div>
          <div class="card-body table-responsive p-0">
           
          </div>
        </div>
      </div>
    </div>
@stop



@extends('website.layout')

@section('content')


  <main>
    <div class="container p-2">
        <div class="container-fluid">
            <div class="card  text-white">
              <div class="card-header bg-danger"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Error!</div>
              <div class="card-body">
                 <div class="row">
                    <div class="col-12 text-center">
                          <div class="alert alert-danger">
                              <i class="fa fa-exclamation-circle" aria-hidden="true"></i> {{ $message }}
                          </div>
                    </div>
                  </div>
              </div>
            </div>
        </div>
    </div>
  </main>
@stop

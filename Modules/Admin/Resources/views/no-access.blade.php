@extends('adminlte::page')

@section('title', 'Sorry, This Page Can&#39;t Be Accessed')


@section('content')
 <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header bg-dark">
          <h3 class="card-title ">Sorry, This Page Can&#39;t Be Accessed</h3>
        </div>
        <div class="card-body">
          <div class="row text-center">
               <div class="col-md-2 text-center">
                    <p><i class="fa fa-exclamation-triangle fa-5x"></i><br/>Status Code: 403</p>
               </div>
               <div class="col-md-10">
                    <h3>OPPSSS!!!! Sorry...</h3>
                    <p>Sorry, your access is refused due to security reasons of our server and also our sensitive data.<br/>Please go back to the previous page to continue browsing.</p>
                    <a class="btn btn-danger" href="javascript:history.back()">Go Back</a>
               </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop

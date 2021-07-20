@extends('client::layouts.master')

@section('title', 'Client Dashboard')

@section('website_css')
    
@stop

@section('content')

 	<ol class="breadcrumb padding_bottom">
        <li class="breadcrumb-item">
          <a href="{{ route('client.dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">My Profile</li>
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
      	</div>
	</div>

	
			
	   
	    <div class="card">
	       <div class="card-header">
          <i class="fa fa-user-circle"></i> My Profile
          <div class="card-tools float-right">
            <div class="input-group input-group-sm " style="width: 100px;">
              <div class="input-group-append">
                <a href="{{ route('client.profile.edit')}}"><button type="button" class="btn btn-block btn-sm"><i class="fa faw fa-edit"></i> Edit Profile</button></a>
              </div>
            </div>
          </div>
        </div>
         

          <div class="card-body table-responsive p-3">
			<div class="row add_top_20">
				<div class="col-12">
					<ul class="list-group">
					  	<li class="list-group-item d-flex justify-content-between align-items-center list-group-item-primary">
						   Username
						   <label>{{ $users->username }}</label>
						</li>
						<li class="list-group-item d-flex justify-content-between align-items-center">
						  Email
						    <label>{{ $users->email }}</label>
						  </li>
						  <li class="list-group-item d-flex justify-content-between align-items-center">
						    Phone
						   <label>{{ $users->phone }}</label>
						  </li>
						   <li class="list-group-item d-flex justify-content-between align-items-center">
							    Gender
							   <label>{{ $users->gender }}</label>
						  </li>
						   <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-dark">
							  
						  </li>

						  <li class="list-group-item d-flex justify-content-between align-items-center ">
						   First Name
						   <label>{{ $users->first_name }}</label>
						</li>

						<li class="list-group-item d-flex justify-content-between align-items-center ">
						   Last Name
						   <label>{{ $users->last_name }}</label>
						</li>
						<li class="list-group-item d-flex justify-content-between align-items-center list-group-item-dark">
							  
						  </li>

						<li class="list-group-item d-flex justify-content-between align-items-center ">
						   Address
						   <label>{{ $users->address }}</label>
						</li>

						<li class="list-group-item d-flex justify-content-between align-items-center ">
						   City
						   <label>{{ $users->t_city->name }}</label>
						</li>

						<li class="list-group-item d-flex justify-content-between align-items-center ">
						   Country
						   <label>{{ $users->t_country->name }}</label>
						</li>

						<li class="list-group-item d-flex justify-content-between align-items-center ">
						   Pobox
						   <label>{{ $users->postal }}</label>
						</li>

						<li class="list-group-item d-flex justify-content-between align-items-center list-group-item-dark">
							  

						<li class="list-group-item d-flex justify-content-between align-items-center ">
						   Fax
						   <label>{{ $users->fax }}</label>
						</li>

						<li class="list-group-item d-flex justify-content-between align-items-center ">
						    Optional Mobile Number
						   <label>{{ $users->mobile2 }}</label>
						</li>


						<li class="list-group-item d-flex justify-content-between align-items-center ">
						   Optional Phone Number
						   <label>{{ $users->phone2 }}</label>
						</li>
					</ul>


				</div>
		</div>
	</div>

@stop

@section('website_js')
 	
    <script src="{{ asset('website-theme/admin/vendor/dropzone.min.js') }}">
@stop
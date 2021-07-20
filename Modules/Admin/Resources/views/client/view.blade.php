@extends('admin::layouts.master')

@section('title', 'Admin Dashboard')

@section('css')
   
@stop

@section('breadcrumb')
   <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('superadmin.dashboard') }}">Dashboard</a>
        </li>
         <li class="breadcrumb-item">
            <a href="{{ route('superadmin.clients.active-list') }}">Active Customers List</a>
        </li>
         <li class="breadcrumb-item">
            <a href="{{ route('superadmin.clients.delete-list') }}">Delete Customers List</a>
        </li>
         <li class="breadcrumb-item">
            <a href="{{ route('superadmin.clients.pending-list') }}">Pending Customers List</a>
        </li>
        <li class="breadcrumb-item active">View Customers Profile</li>
    </ol>
@stop

@section('content')

 
 <div class="box_general padding_bottom">
    <div class="header_box version_2">
      <h2  class="text-danger"><i class="fa fa-user text-danger"></i> View Login Detail: {{ $client->username }}</h2>
    </div>
    <div class="row">
      <div class="col-8">
       <table class="table table-striped table-condensed table-bordered">
          <tbody>
            <tr>
              <td class="text-bold">Username</td>
              <td> {{ $client->username }}</td>
            </tr>

             <tr>
              <td class="text-bold">Email</td>
              <td> {{ $client->email }}</td>
            </tr>

             <tr>
              <td class="text-bold">Phone</td>
              <td> {{ $client->phone }}</td>
            </tr>

             <tr>
              <td class="text-bold">Created At</td>
              <td> {{ $client->created_at }}</td>
            </tr>
          </tbody>
        </table>
      </div>
       <div class="col-4">
            @if(!empty($client->image))
              <img src="{{ asset('assets/uploads/clients/'.$client->image) }}" class="avatar img-thumbnail" height="192" width="192" alt="client_image">
            @else
              <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-thumbnail" alt="client_image">
            @endif
       </div>
     </div>
  </div>

  <div class="box_general padding_bottom">
    <div class="header_box version_2">
      <h2  class="text-danger"><i class="fa fa-user text-danger"></i>View {{ $client->username }} details</h2>
    </div>
    <div class="row">
      <div class="col-12">
       <table class="table table-striped table-condensed table-bordered">
          <tbody>
            <tr>
              <td class="text-bold" width="30%">First name</td>
              <td> {{(!empty($client->first_name)) ? $client->first_name : '' }}</td>
            </tr>

             <tr>
              <td class="text-bold">Last name</td>
              <td> {{(!empty($client->last_name)) ? $client->last_name : '' }}</td>
            </tr>

             <tr>
              <td class="text-bold">Gender</td>
              <td> {{(!empty($client->gender)) ? $client->gender : '' }}</td>
            </tr>

             <tr>
              <td class="text-bold">Address</td>
              <td> {{(!empty($client->address)) ? $client->address : '' }}</td>
            </tr>

             <tr>
              <td class="text-bold">Latitude</td>
              <td> {{(!empty($client->latitude)) ? $client->latitude : '' }}</td>
            </tr>

             <tr>
              <td class="text-bold">Longitude</td>
              <td> {{(!empty($client->longitude)) ? $client->longitude : '' }}</td>
            </tr>
            
            <tr>
              <td class="text-bold">City</td>
              <td> {{(!empty($client->city)) ? $client->t_city->name : '' }}</td>
            </tr>

             <tr>
              <td class="text-bold">Country</td>
              <td> {{(!empty($client->country)) ? $client->t_country->name : '' }}</td>
            </tr>

            <tr>
              <td class="text-bold">Pobox</td>
              <td>{{(!empty($client->postal)) ? $client->postal : '' }}</td>
            </tr>

             <tr>
              <td class="text-bold">Fax</td>
              <td> {{(!empty($client->fax)) ? $client->fax : '' }}</td>
            </tr>
            <tr>
              <td class="text-bold">Seconadry Mobile</td>
              <td> {{(!empty($client->mobile2)) ? $client->mobile2 : '' }}</td>
            </tr>

             <tr>
              <td class="text-bold">Seconadry Phone</td>
              <td> {{(!empty($client->phone2)) ? $client->phone2 : '' }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      
     </div>
  </div>
@stop
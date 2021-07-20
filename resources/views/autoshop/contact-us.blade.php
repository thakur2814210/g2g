@extends('autoshop.layout')
@section('content')
@php $r =   'autoshop.contacts.contact' . $final_theme['contact']; @endphp
@include($r)
@endsection

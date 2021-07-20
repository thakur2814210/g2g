@extends('autoshop.layout')
@section('content')
@php $r =   'autoshop.details.detail' . $final_theme['detail']; @endphp
@include($r)
@endsection

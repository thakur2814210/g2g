@extends('autoshop.layout')
@section('content')
<!-- cart Content -->
@php $r =   'autoshop.carts.cart' . $final_theme['cart']; @endphp
@include($r)
@endsection

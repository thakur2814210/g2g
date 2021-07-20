@extends('autoshop.layout')
@section('content')
<!-- Site Content -->
@php $r =   'autoshop.blogs.blog' . $final_theme['blog']; @endphp
@include($r)
@endsection

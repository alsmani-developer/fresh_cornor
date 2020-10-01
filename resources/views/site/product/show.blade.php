@extends('site.layouts.app')
@section('page-title')
    {{ $locale == 'ar' ? $get_meat->ar_name : $get_meat->en_name }}
@endsection
@section('content')
@include('site.product.header')
@include('site.product.product')
{{-- @include('site.product.details') --}}
@include('site.product.related')
@endsection
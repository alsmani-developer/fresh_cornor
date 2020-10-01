@extends('site.layouts.app')
@section('page-title')
    Fresh Cornor Product Page
@endsection
@section('content')
@php
    if (session()->has('locale')) {
            App::setLocale(session()->get('locale'));
        }
@endphp
@include('site.product.header')
@include('site.product.product')
@include('site.product.details')
@include('site.product.related')
@endsection
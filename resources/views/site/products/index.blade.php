@extends('site.layouts.app')
@section('page-title')
    Fresh Cornor Products Page
@endsection
@section('content')
@php
    if (session()->has('locale')) {
            App::setLocale(session()->get('locale'));
        }
@endphp
@include('site.product.header')

@endsection
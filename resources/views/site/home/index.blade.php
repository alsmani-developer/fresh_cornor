@extends('site.layouts.app')
@section('page-title')
    Fresh Cornor Home Page
@endsection
@section('content')
@php
    if (session()->has('locale')) {
            App::setLocale(session()->get('locale'));
        }
@endphp
 @include('site.home.category')
 
 @include('site.home.demo1')
 @include('site.home.demo2')
@endsection
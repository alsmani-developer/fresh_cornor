@extends('site.layouts.app')
@section('page-title', trans('sentence.Homepage'))
@section('content')
@php
    if (session()->has('locale')) {
            App::setLocale(session()->get('locale'));
        }
@endphp
@include('site.home.demo1')
 @include('site.home.demo2')
 @include('site.home.category') 
@endsection
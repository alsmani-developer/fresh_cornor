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
<!-- BREADCRUMB -->
<div id="breadcrumb" class="section rtl-text-right">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb-tree">
                    <li><a href="/">{{ trans('sentence.Home Page') }}</a></li>
                    <li><a href="/products">{{ trans('sentence.All Categories') }}</a></li>
                    <li><a href="/category/beef">
                        {{ trans('sentence.Beef') }}</a></li>
                        <li><a href="/category/mutton">
                            {{ trans('sentence.Mutton') }}</a></li>
                            <li><a href="/category/goat-meat'">
                                {{ trans('sentence.Goat meat') }}</a></li>
                    <li class="active">{{ trans('sentence.Result Count') }} (227,490 {{ trans('sentence.Result') }})</li>
                </ul>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /BREADCRUMB -->
@include('site.products.demo1')
@include('site.products.demo1')
@include('site.products.demo1')
@include('site.products.demo1')
@include('site.products.demo1')

@endsection
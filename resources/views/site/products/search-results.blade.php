@extends('site.layouts.app')
@section('page-title')
    نتائج البحث عن: 
    {{ $search_text }}
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
                    <li>
                        {{ trans('sentence.Search Results') }}
                    </li>
                    <li>
                        <a href="#">
                            {{ $search_text }}
                        </a>
                    </li>
                    <li>
                        {{ trans('sentence.Category') }}</li>
                    @empty($get_cats)
                    <li>
                        <a href="/products">
                        كل الاصناف</a>
                    </li>
                    @else 
                    <li>
                        <a href="/category/{{ $get_cats->id }}">
                        {{ $locale == 'ar' ? $get_cats->ar_name : $get_cats->en_name }} </a>
                    </li>
                    @endempty
                    
                </ul>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /BREADCRUMB -->
@include('site.products.demo1')

@endsection
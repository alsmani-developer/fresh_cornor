@extends('site.layouts.app')
@section('page-title', $locale === 'ar' ? trans('sentence.Category') . ' ' . $get_cat->ar_name 
: trans('sentence.Category') . ' '. $get_cat->en_name)
@section('content')
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
                    <li class="active"><a href="/category/{{ $get_cat->id }}">
                       {{ $locale === 'ar' ? $get_cat->ar_name : $get_cat->en_name }}</a></li>
                    <li class="active">{{ trans('sentence.Result Count') }} 
                        ({{ $get_cat->Meat->count() }} {{ trans('sentence.Result') }})</li>
                </ul>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /BREADCRUMB -->
@include('site.category.demo1')

@endsection
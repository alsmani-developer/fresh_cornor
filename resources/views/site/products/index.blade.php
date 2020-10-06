@extends('site.layouts.app')
@section('page-title')
    {{ $locale == 'ar' ? 'كل المنتجات ' : 'All Products '}}
@endsection
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
                    @forelse ($get_cats as $get_cat)
                    <li><a href="/category/{{ $get_cat->id }}">
                        {{ $locale === 'ar' ? $get_cat->ar_name : $get_cat->en_name }}
                        </a></li>
                    @empty
                    @endforelse
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
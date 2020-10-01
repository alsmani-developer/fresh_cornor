@extends('site.layouts.app')
@section('page-title')
    {{ trans('sentence.Discount And Offers') }}
@endsection
@section('content')
 @include('site.home.category')
@endsection
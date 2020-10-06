@extends('site.layouts.app')
@section('page-title')
    {{ trans('sentence.Discount And Offers') }}
@endsection
@section('content')
<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
    <!-- row -->
    <div class="row">
    <!-- Product main img -->
    <div class="col-md-7">
    <div id="product-main-img">
    <div class="product-preview2">
        <img src="{{ asset('images/'.$discount->pic) }}" 
        alt="{{ $locale === 'ar' ? $discount->ar_name : $discount->en_name }}"
         height="400">
    </div>
    </div>
    </div>
    <!-- Product details -->
    <div class="col-md-5 mt-4">
        <div class="product-details">
            <h2 class="product-name rtl-text-right">
                {{ $locale === 'ar' ? $discount->ar_name : $discount->en_name }}
                <span class="product-available text-white p-2 bg-success">
                    {{ $discount->amount }}%
                </span>
            </h2>
            <div class="rtl-text-right text-info pb-10">
                خصم يصل الى 
                {{ $discount->amount }}%
            </div>
            <p>
                {{ $locale === 'ar' ? $discount->ar_description : $discount->en_description }}
            </p>
    
            <article class="product-btns rtl-text-right h2">
                <h4 class="mt-3">{{ trans('sentence.discount_left') }} 
                    <time>
                        @php
                            $to = \Carbon\Carbon::createFromFormat('Y-m-d', $discount->end_date);

                            $from = \Carbon\Carbon::createFromFormat('Y-m-d', $discount->start_date);

                            $diff_in_days = $to->diffInDays($from);
                        @endphp
                        {{  $diff_in_days  }}
                        {{ trans('sentence.Days Left For The Offer To Expire') }}
                    </time>
                </h4>
            </article>
    
        </div>
    </div>
    <!-- /Product details -->
@include('site.discounts.products')
@endsection
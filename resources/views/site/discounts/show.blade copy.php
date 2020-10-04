@extends('site.layouts.app')
@section('page-title')
    {{ trans('senntence.Discount And Offers') }}
@endsection
@section('content')
<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12 rtl-text-right">
                <ul class="breadcrumb-tree w-100">
                    <li class="w-50">
                        <img src="{{ asset('images/'.$discount->pic) }}" alt="" class="w-100" height="300">
                    </li>
                    <li class="text-center">
                        <h1>
                            {{ $locale === 'ar' ? $discount->ar_name : $discount->en_name }}
                        </h1>
                    <p class="mt-3 text-center">
                        {{ $locale === 'ar' ? $discount->ar_description : $discount->en_description }}

                    </p>
                    <p class="text-info h5">
                        خصم يصل الى 
                        {{ $discount->amount }}%
                    </p>
                    <p>
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
                    </p>
                    </li>
                </ul>
                <h2 class="mt-2 mr-30">
                    {{ trans('sentence.Products') }}
                </h2>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /BREADCRUMB -->
@include('site.discounts.products')
@endsection
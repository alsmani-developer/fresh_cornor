@extends('site.layouts.app')
@section('page-title', trans('sentence.My Orders'))
@section('content')
    <section class="section-pagetop mt-4">
        <div class="container clearfix rtl-text-right mb-2">
            <h2 class="title-page mr-2">
                {{ trans('sentence.My Orders') }}
            </h2>
        </div>
    </section>
    <section class="section-content bg padding-y border-top">
        <div class="container">
            <div class="row">
            </div>
            <div class="row">
                <main class="col-sm-12">
                    <table class="table table-hover rtl-text-right bg-white">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th scope="col" class="text-center">
                                    {{ trans('sentence.Order No.') }}
                                </th>
                                <th scope="col" class="text-center">
                                    {{ trans('sentence.Products') }}
                                </th>
                                <th scope="col" class="text-center">
                                    {{ trans('sentence.Qty') }}</th>
                                <th scope="col" class="text-center">
                                    {{ trans('sentence.Grand Price') }}
                                </th>
                                <th scope="col" class="text-center">
                                    {{ trans('sentence.Status') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                                <tr class="p-2">
                                    <th scope="col" class="text-center">{{ $order->id }}</th>
                                    <td class="text-center position-relative">
                                        <ul class="list-group">
                                            @foreach ($order->ordersMeats as $item)
                                                <li class="list-group-item">
                                                    <a href="/product/{{ $item->meat->id }}" class="text-primary">
                                                        {{ $locale == 'ar' ? $item->meat->ar_name : $item->meat->en_name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <div class="badge badge-info ordercountbadge">
                                            {{ $order->ordersMeats->count() }}
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        {{ $order->ordersMeats->count() }}
                                        {{ trans('sentence.KG') }}
                                    </td>
                                    <td class="text-center text-success">
                                        @isset($order->discount->discount_amount)
                                        @php $price =  $order->ordersMeats->sum('price') - 
                                        $order->discount->discount_amount / 
                                            ($order->ordersMeats->sum('price') * 100)
                                            @endphp
                                            {{ round($price*$order->ordersMeats->first()->quantity) }}
                                            @else 
                                            {{ round($order->ordersMeats->sum('price')) }} 
                                        @endisset
                                        {{ trans('sentence.Rial') }}
                                    </td>
                                    <td class="text-center"><span class="badge badge-success">
                                        {{ $locale == 'ar' ? $order->status->ar_name : $order->status->en_name }}
                                    </span>
                                    </td>
                                </tr>
                            @empty
                                <div class="col-sm-12">
                                    <p class="alert alert-warning">No orders to display.</p>
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                </main>
            </div>
        </div>
    </section>
@stop
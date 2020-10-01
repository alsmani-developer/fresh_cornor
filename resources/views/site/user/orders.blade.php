@extends('site.layouts.app')
@section('page-title', trans('sentence.My Orders'))
@section('content')
    <section class="section-pagetop bg-dark mt-4">
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
                    <table class="table table-hover rtl-text-right">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">
                                    {{ trans('sentence.Order No.') }}
                                </th>
                                <th scope="col" class="text-center">
                                    {{ trans('sentence.items count') }}
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
                                <tr>
                                    <th scope="col" class="text-center">{{ $order->id }}</th>
                                    <td class="text-center">{{ $order->ordersMeats->count() }}</td>
                                    <td class="text-center">
                                        {{ $order->ordersMeats->count() }}
                                        {{ trans('sentence.KG') }}
                                    </td>
                                    <td class="text-center">
                                        {{ round($order->ordersMeats->sum('price'), 2) }}
                                        {{ trans('sentence.Rial') }}
                                    </td>
                                    <td class="text-center"><span class="badge badge-success">
                                        {{ $order->status->ar_name }}
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
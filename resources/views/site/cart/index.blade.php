@extends('site.layouts.app')
@section('page-title', trans('sentence.Shopping Cart'))
@section('content')
{{-- {{ dd(\Cart::getContent()) }} --}}
    <section class="section-pagetop bg-dark mt-3 pb-2">
        <div class="container clearfix">
            <h2 class="title-page rtl-text-center">
                {{ trans('sentence.Shopping Cart') }}
            </h2>
        </div>
    </section>
    
    <section class="section-content bg padding-y border-top mb-4">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    @if (Session::has('message'))
                        <p class="alert alert-success">{{ Session::get('message') }}</p>
                    @endif
                </div>
            </div>
            <div class="row">
                <main class="col-sm-9">
                    @if (\Cart::isEmpty())
                        <p class="alert alert-warning">Your shopping cart is empty.</p>
                    @else
                        <div class="card rtl-text-right" dir="rtl">
                            <table class="table table-hover shopping-cart-wrap">
                                <thead class="text-muted">
                                <tr>
                                    <th scope="col" class="text-right">
                                        {{ trans('sentence.Product Name') }}
                                    </th>
                                    <th scope="col" class="text-right" width="120">
                                        {{ trans('sentence.Quantity') }}
                                    </th>
                                    <th scope="col" class="text-right" width="120">
                                        {{ trans('sentence.Price') }}
                                    </th>
                                    <th scope="col" class="text-right" width="200">
                                        <i class="fa fa-box"></i>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(\Cart::getContent() as $item)
                                    <tr>
                                        <td>
                                            <figure class="media">
                                                <figcaption class="media-body">
                                                    <h5 class="title text-truncate">
                                                        <a href="/product/{{ $item->id }}" class="text-info">
                                                            {{ Str::words($item->name,20) }}
                                                        </a>
                                                    </h5>
                                                </figcaption>
                                            </figure>
                                        </td>
                                        <td>
                                            <var class="price">
                                                {{ $item->quantity }} {{ trans('sentence.KG') }}
                                            </var>
                                        </td>
                                        <td>
                                            <div class="price-wrap">
                                                <var class="price text-success">
                                                    @empty($item->attributes->discount)
                                                    {{ $item->price }} {{ trans('sentence.Rial  For KG') }}
                                                    <span class="float-left">
                                                        {{ trans('sentence.Rial  For KG') }}
                                                    </span>
                                                    @else 
                                                <del class="text-divider">
                                                {{ $item->price }} {{ trans('sentence.Rial  For KG') }}
                                                </del> <br>
                                                {{  $item->price - $item->attributes->discount / 
                                                    ($item->price * 100) }}
                                                    <span class="float-left">
                                                        {{ trans('sentence.Rial  For KG') }}
                                                    </span>
                                                    @endempty
                                                    </var>
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <a href="{{ route('checkout.cart.remove', $item->id) }}" 
                                                class="btn btn-outline-danger text-danger"><i class="fa fa-times"></i> </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </main>
                <aside class="col-sm-3">
                    <a href="{{ route('checkout.cart.clear') }}" class="btn btn-danger btn-block mb-4">
                        {{ trans('sentence.Clear Cart') }}
                    </a>
                    {{-- <p class="alert alert-success text-center">
                        {{ trans('sentence.If a discount') }}
                    </p> --}}
                    <dl class="dlist-align h4">
                        {{-- <dt class="rtl-text-right">{{ trans('sentence.Total') }}:</dt>
                        <dd class="text-right rtl-text-left">
                            <strong>{{ \Cart::getSubTotal() }} {{ trans('sentence.Rial') }}
                            </strong></dd> --}}
                    </dl>
                    <a href="/checkout" class="btn btn-success btn-block">
                    {{ trans('sentence.Proceed To Checkout') }}
                    </a>
                </aside>
            </div>
        </div>
    </section>
@stop

@extends('site.layouts.app')
@section('page-title', trans('sentence.Shopping Cart'))
@section('content')
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
                                                    <h6 class="title text-truncate">
                                                        {{ Str::words($item->name,20) }}</h6>
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
                                                <var class="price">
                                                    {{ $item->price }} {{ trans('sentence.Rial  For KG') }}</var>
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
                    <p class="alert alert-success text-center">
                        {{ trans('sentence.If a discount') }}
                    </p>
                    <dl class="dlist-align h4">
                        <dt class="rtl-text-right">{{ trans('sentence.Total') }}:</dt>
                        <dd class="text-right rtl-text-left">
                            <strong>{{ \Cart::getSubTotal() }} {{ trans('sentence.Rial') }}
                            </strong></dd>
                    </dl>
                    <hr>
                    <dt class="rtl-text-right">{{ trans('sentence.Payment Methods') }}:</dt>
                    <form action="{{ route('checkout.index') }}" method="post">
                    <div class="form-group rtl-text-right position-relative">
                      <div class="w-100">
                        <input type="checkbox" name="paypal" id="paypal" value="1"
                        aria-describedby="helpId">
                        <label for="paypal">
                          الدفع الالكتروني
                          <div class="tooltip"><i class="fa fa-info-circle"></i>
                            <span class="tooltiptext">
                                ادفع باستخدام
                                <br>
                                <i class="fa fa-cc-mastercard" aria-hidden="true"></i>
                                {{ trans('sentence.Pay With Master Card') }} |
                                <i class="fa fa-cc-visa h3"></i>
                                {{ trans('sentence.Pay with Visa Card') }} |
                                <i class="fa fa-paypal h3"></i>
                                PayPal
                            </span>
                          </div> 
                          
                          </label>
                      </div>
                    </div>
                    <a href="{{ route('checkout.index') }}" class="btn btn-success btn-lg btn-block">
                        {{ trans('sentence.Proceed To Checkout') }}
                    </a>
                </form>
                </aside>
            </div>
        </div>
    </section>
@stop

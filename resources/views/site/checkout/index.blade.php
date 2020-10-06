@extends('site.layouts.app')
@section('page-title', trans('sentence.Review Your Order & Complete Checkout'))
@section('content')
<div class="container wrapper">
            <div class="row cart-head">
                <div class="container">
                <div class="row">
                    <p></p>
                </div>
                <div class="row">
                    <div style="display: table; margin: auto;">
                        <span class="step step_complete"> <a href="/cart" class="check-bc">{{ trans('sentence.View Cart') }}</a> <span class="step_line step_complete"> </span> <span class="step_line backline"> </span> </span>
                        <span class="step step_complete"> <a href="/checkout" class="check-bc">
                            {{ trans('sentence.Checkout') }}</a> <span class="step_line "> </span> <span class="step_line step_complete"> </span> </span>
                        <span class="step_thankyou check-bc step_complete">
                            {{ trans('sentence.Review Your Order & Complete Checkout') }}
                        </span>
                    </div>
                </div>
                <div class="row">
                    <p></p>
                </div>
                </div>
            </div>    
            <div class="row cart-body">
                <form class="form-horizontal" method="post" action="{{ route('checkout.place.order') }}">
                    @csrf
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-push-6 col-sm-push-6">
                    <!--REVIEW ORDER-->
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            {{ trans('sentence.order details') }} <div class="pull-right"><small><a class="afix-1" href="/cart">
                            {{ trans('sentence.Edit Cart') }}</a></small></div>
                        </div>
                        <div class="panel-body">
                            @foreach (\Cart::getContent() as $item)
                            <div class="form-group">
                                <div class="col-sm-3 col-xs-3 text-center" dir="rtl">
                                    <span>{{ trans('sentence.Total') }}</span>:
                                    <h6 class="text-success">{{ $item->price*$item->quantity }}
                                        {{ trans('sentence.Rial') }}
                                        </h6>
                                </div>
                                <div class="col-sm-6 col-xs-6 text-right">
                                    <div class="col-xs-12">{{ $item->name }}</div>
                                    <div class="col-xs-12 text-info"><small>{{ trans('sentence.Quantity') }}:<span>
                                        {{ $item->quantity }}
                                    {{ trans('sentence.KG') }}</span></small></div>
                                    <div class="col-xs-12"><small>{{ trans('sentence.Price') }}:
                                        <span class="text-success">
                                        {{ $item->price }}
                                    {{ trans('sentence.Rial  For KG') }}</span></small></div>
                                </div>
                                <div class="col-sm-3 col-xs-3">
                                    <img class="img-responsive" 
                                    src="{{ asset($item->attributes->pic) }}" />
                                </div>
                            </div>
                            @endforeach
                            <div class="form-group"><hr /></div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <strong>{{ trans('sentence.Order Total') }}</strong>
                                    <div class="pull-right"><span> <h4 class="text-success" dir="rtl">
                                        {{ \Cart::getSubTotal() }}
                                        {{ trans('sentence.Rial') }}</h4>
                                    </span></div>
                                </div>
                                {{-- <div class="col-xs-12">
                                    <small>Shipping</small>
                                    <div class="pull-right"><span>-</span></div>
                                </div>
                            </div>
                            <div class="form-group"><hr /></div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <strong>Order Total</strong>
                                    <div class="pull-right"><span>$</span><span>150.00</span></div>
                                </div>
                            --}}
                            </div>
                        </div>
                    </div>
                    <!--REVIEW ORDER END-->
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-pull-6 col-sm-pull-6">
                    <!--SHIPPING METHOD-->
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            {{ trans('sentence.Address') }}
                        </div>
                        <div class="panel-body rtl-text-right">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <h4>
                                        {{ trans('sentence.Shipping Address') }}
                                    </h4>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>{{ trans('sentence.Name') }}:</strong></div>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="name" 
                                    value="{{ auth()->user()->name }}" disabled/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>{{ trans('sentence.Address') }}: 
                                <span class="text-danger">*</span></strong>
                                </div>
                                <div class="col-md-12">
                                    <input type="text" name="address" class="form-control" 
                                    value="" placeholder="{{ trans('sentence.Full Address')}}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>{{ trans('sentence.Email') }}: 
                                </strong>
                                </div>
                                <div class="col-md-12">
                                    <input type="text" name="email" class="form-control" 
                                    value="{{ auth()->user()->email }}" disabled/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>{{ trans('sentence.Phone Number') }}:</strong></div>
                                <div class="col-md-12">
                                    <input type="text" name="phone" class="form-control" 
                                    value="{{ auth()->user()->phone }}" disabled/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="panel-body">
                                    <span class='payment-errors'></span>
                                    <div class="mr-1">
                                        <div class="form-group rtl-text-right position-relative"
                                        title="غير متاح حاليا">
                                          <div class="w-100">
                                            <input type="checkbox" name="paypal" 
                                            id="paypal" value="1" disabled>
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
                                        <div class="form-group rtl-text-right position-relative">
                                            <div class="w-100">
                                              <input type="checkbox" name="cash" id="cash" value="2">
                                              <label for="cash">
                                                الدفع عن التوصيل
                                                <div class="tooltip"><i class="fa fa-info-circle"></i>
                                                  <span class="tooltiptext">
                                                      ادفع باستخدام
                                                      <br>
                                                      <i class="fa fa-money h3" aria-hidden="true"></i>
                                                         نقدي   |
                                                      <i class="fa fa-credit-card h3"></i>
                                                        بطاقة الصراف الالي 
                                                  </span>
                                                </div> 
                                                </label>
                                            </div>
                                          </div>
                                    </div>
                                    <button type="submit" class="btn btn-success float-right" 
                                    style="width:25%;">
                                    {{ trans('sentence.Pay Now') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--SHIPPING METHOD END-->
                </div>
                
                </form>
            </div>
            <div class="row cart-footer">
        
            </div>
    </div>
@stop
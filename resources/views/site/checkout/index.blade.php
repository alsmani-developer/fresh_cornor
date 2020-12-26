@extends('site.layouts.app')
@section('page-title', trans('sentence.Review Your Order & Complete Checkout'))
@section('content')
<script src="https://js.stripe.com/v3/"></script>
<div class="container wrapper ">
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
                </div>
            </div>    
            <div class="row">
                @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <p class="p-4 alert-danger text-center font-weight-bolder col-md-6 ml-auto mr-auto">
                        {{ $error}}
                    </p>
                @endforeach
                @endif
            </div>
            <div class="row cart-body mt-2">
                <form class="form-horizontal" method="post" action="{{ route('checkout.place.order') }}"
                data-cc-on-file="false"
                data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                id="payment-form">
                    @csrf
                <!-- Used to display form errors. -->
                <div id="card-errors" role="alert"></div>
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
                                    <h6 class="text-success">
                                        @if ($item->attributes->discount)
                                        <del class="text-divider ml-2">
                                            {{ $item->price*$item->quantity }} {{ trans('sentence.Rial  For KG') }}
                                            </del>  <br>
                                            @php $price =  $item->price - $item->attributes->discount / 
                                            ($item->price * 100)
                                            @endphp
                                            {{ $price*$item->quantity }}
                                            <span class="float-left">
                                                {{ trans('sentence.Rial  For KG') }}
                                            </span>
                                        @else 
                                        {{ $item->price*$item->quantity }}
                                        {{ trans('sentence.Rial') }}
                                        @endif
                                        </h6>
                                </div>
                                <div class="col-sm-6 col-xs-6 text-right">
                                    <div class="col-xs-12">{{ $item->name }}</div>
                                    <div class="col-xs-12 text-info"><small>{{ trans('sentence.Quantity') }}:<span>
                                        {{ $item->quantity }}
                                    {{ trans('sentence.KG') }}</span></small></div>
                                    <div class="col-xs-12 text-success">
                                    <small>{{ trans('sentence.Price') }}:
                                    @if ($item->attributes->discount)
                                    <del class="text-divider ml-2">
                                        {{ $item->price }} {{ trans('sentence.Rial  For KG') }}
                                        </del> 
                                        {{  $item->price - $item->attributes->discount / 
                                        ($item->price * 100) }}
                                        <span class="float-left">
                                            {{ trans('sentence.Rial  For KG') }}
                                        </span>
                                    @else 
                                    <span class="text-success">
                                        {{ $item->price }}
                                    {{ trans('sentence.Rial  For KG') }}
                                    </span>
                                    @endif
                                </small></div>
                                </div>
                                <div class="col-sm-3 col-xs-3">
                                    <img class="img-responsive" 
                                    src="{{ asset($item->attributes->pic) }}" />
                                </div>
                            </div>
                            @endforeach
                            <div class="form-group"><hr /></div>
                            <div class="form-group">
                                {{-- <div class="col-xs-12">
                                    <strong>{{ trans('sentence.Order Total') }}</strong>
                                    <div class="pull-right"><span> <h4 class="text-success" dir="rtl">
                                        {{ \Cart::getSubTotal() }}
                                        {{ trans('sentence.Rial') }}</h4>
                                    </span></div>
                                </div> --}}
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
                                <div class="panel-body rtl-text-right">
                                    {{-- <p>Please select your gender:</p> --}}
                                    <br>
                                    <input type="radio" id="cash" name="payment" value="2">
                                    <label for="cash">الدفع عند التوصيل
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
                                    </label> <br>
                                    <input type="radio" id="online_payment" name="payment" value="1">
                                    <label for="online_payment">
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
                                    <div class="text-left w-100 p-1" dir="ltr">
                                        {{-- pay with credit card start here  --}}
                                         <!--CREDIT CART PAYMENT-->
                                        <div class="panel panel-info d-none" id="credit_card">
                                            <div class="panel-heading"><span>
                                                <i class="fa fa-lock"></i></span> Secure Payment</div>
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <div class="col-md-12 mb-1"><strong>
                                                        Name On The Card:</strong></div>
                                                    <div class="col-md-12">
                                                        <input type="text" placeholder="Card Name"
                                                        class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <label for="card-element mb-2">
                                                        Card Number
                                                    </label>
                                                    <div id="card-element">
                                                        <!-- A Stripe Element will be inserted here. -->
                                                    </div>
                                                
                                                    <!-- Used to display form errors. -->
                                                    <div id="card-errors" role="alert"></div>
                                                    </div>
                                                <div class="form-group mt-2">
                                                    <div class="col-md-12">
                                                        <span>Pay secure using your credit card.</span>
                                                    </div>
                                                    <div class="col-md-12 mt-1">
                                                        <ul class="cards">
                                                            <li class="visa hand">Visa</li>
                                                            <li class="mastercard hand">MasterCard</li>
                                                            <li class="amex hand">Amex</li>
                                                        </ul>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--CREDIT CART PAYMENT END-->
                                    </div>
                                    <button type="submit" class="btn btn-success float-right mt-3" 
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
    <script>
        window.onload = function(){
        if($("#online_payment").is(':checked')){
            $("#credit_card").show(300);
        }
        $("#online_payment").on('click', function(){
            console.log($("#online_payment").val());
            $("#credit_card").show(300);
        });
        $("#cash").on('click', function(){
            console.log($("#online_payment").val());
            $("#credit_card").hide(300);
        });


        if($("#online_payment").is(':checked')){
            // Create a Stripe client.
            var stripe = Stripe('pk_test_51HbXBWKm7K7BWbGmZNNr0Y4cvzlIF6kMQyndmta9YT8Y6GnZlqYgVfnowhJsvtIob5XctdgWwWJXcM3LJFECmGan00i02dzmir');

            // Create an instance of Elements.
            var elements = stripe.elements();

            // Custom styling can be passed to options when creating an Element.
            // (Note that this demo uses a wider set of styles than the guide below.)
            var style = {
            base: {
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
            };

            // Create an instance of the card Element.
            var card = elements.create('card', {style: style});

            // Add an instance of the card Element into the `card-element` <div>.
            card.mount('#card-element');
            // Handle real-time validation errors from the card Element.
            card.on('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
            });

            // Handle form submission.
            var form = document.getElementById('payment-form');
            form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                // Inform the user if there was an error.
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
                } else {
                // Send the token to your server.
                stripeTokenHandler(result.token);
                }
            });
            });

            // Submit the form with the token ID.
            function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
            }
        }
        }
    </script>
@stop
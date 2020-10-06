@extends('site.layouts.app')
@section('page-title', trans('sentence.Review Your Order & Complete Checkout'))
@section('content')

<div class='container'>
    <div class='row' style='padding-top:25px; padding-bottom:25px;'>
        <div class='col-md-12'>
            <div id='mainContentWrapper'>
                <div class="col-md-9 col-md-offset-1 checkout_con">
                    <h2 style="text-align: center;">
                        {{ trans('sentence.Review Your Order & Complete Checkout') }}
                    </h2>
                    <hr/>
                    <a href="/products" class="btn btn-" style="width: 100%;">
                    {{ trans('sentence.Add More Products') }}
                    </a>
                    <hr/>
                    <div class="shopping_cart">
                        <form class="form-horizontal" role="form" action="" method="post" id="payment-form">
                            <div class="panel-group" id="accordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title rtl-text-right">
                                            <a data-toggle="collapse" data-parent="#accordion" 
                                            href="#collapseOne">
                                        {{ trans('sentence.Review Your Order') }}</a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <div class="items">
                                                <div class="col-md-9">
                                                    <table class="table table-striped">
                                                        <tr>
                                                            <td colspan="2">
                                                                <b class="pull-right">
                                                                    {{ trans('sentence.order details') }}
                                                                </b>
                                                                <a class="btn btn-danger btn-sm pull-left"
                                                                   href="{{ route('checkout.cart.clear') }}"
                                                                   title="Remove Item">X</a>
                                                                </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <ul>
                                                                    @foreach(\Cart::getContent() as $item)
                                                                    <li dir="" class="mt-1">
                                                                        <ul class="list-group rtl-text-right w-70 d-inline-block">
                                                                            <li class="list-group-item">
                                                                                المنتج: 
                                                                                {{ Str::words($item->name,20) }}
                                                                            </li>
                                                                            <li class="list-group-item text-success">
                                                                                السعر: 
                                                                                {{ $item->price }} {{ trans('sentence.Rial  For KG') }}
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                الكمية: 
                                                                                {{ $item->quantity }} {{ trans('sentence.KG') }}
                                                                            </li>
                                                                        </ul>
                                                                        <img src="{{ asset($item->attributes->pic) }}"
                                                                         alt="" class="w-25 checkout_img h-100">
                                                                    </li>
                                                                    @endforeach
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="col-md-3">
                                                    <div style="text-align: center;">
                                                        <h3>{{ trans('sentence.Order Total') }}</h3>
                                                        <h3 class="text-success"> 
                                                            {{ \Cart::getSubTotal() }}  <br>
                                                            {{ trans('sentence.Rial') }}</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title rtl-text-right">
                                        <a data-toggle="collapse" data-parent="#accordion" 
                                        href="#collapseTwo" aria-expanded='true'>
                                           عنوان التسوق</a>
                                    </h3>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse in" aria-expanded='true'>
                                    <div id="map" class="w-100"></div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <div style="text-align: center;">
                                            <a data-toggle="collapse"
                                            data-parent="#accordion"
                                            href="#collapseThree"
                                            class=" btn   btn-success" id="payInfo"
                                            style="width:100%;display: none;" 
                                            onclick="$(this).fadeOut();  
                                            document.getElementById('collapseThree').scrollIntoView()">
                                        اختر طيقة الدفع</a>
                                        </div>
                                    </h4>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title rtl-text-right">
                                        <a data-toggle="collapse" data-parent="#accordion" 
                                        href="#collapseThree" aria-expanded='true'>
                                            <b>طريقة الدفع</b>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse in" aria-expanded='true'>
                                    <div class="panel-body">
                                        <span class='payment-errors'></span>
                                        <div class="mr-1">
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
                </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function initMap(){
            var map, infoWindow;
            var location = {lat: 37.09024, lng: -95.712891};
            map = new google.maps.Map(document.getElementById('map'), {
            center: location,
            zoom:   15
            });
            infoWindow = new google.maps.InfoWindow;
            // The marker, positioned at Uluru
            var marker = new google.maps.Marker({position: location, map: map});
            // Try HTML5 geolocation.
            if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
                };

                infoWindow.setPosition(pos);
                infoWindow.setContent();
                infoWindow.open(map);
                map.setCenter(pos);
                var points = {};
                points.lat = map.getCenter().lat();
                points.lng = map.getCenter().lng();
                updateLateLong(points);
            }, function() {
                handleLocationError(true, infoWindow, map.getCenter());
            });
            } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
            }
                function handleLocationError(browserHasGeolocation, infoWindow, pos) {
                infoWindow.setPosition(pos);
                infoWindow.setContent(browserHasGeolocation ?
                                    'Error: The Geolocation service failed.' :
                                    'Error: Your browser doesn\'t support geolocation.');
                infoWindow.open(map);
            }

        }
        function updateLateLong(points){
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
            url: "{{ route('checkout.saveLatLng') }}",
            method: 'post',
            data: points,
            success: function(res){
                console.log(res);
            }
         });
        }
    </script>
    <script defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCbnb4py-rBXdKvyWOZkIj9DgsqEkjj9-0&callback=initMap">
</script>
@stop
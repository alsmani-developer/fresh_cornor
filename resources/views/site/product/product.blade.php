<!-- SECTION -->
<div class="section">
<!-- container -->
<div class="container">
<!-- row -->
<div class="row">
<!-- Product main img -->
<div class="col-md-7">
<div id="product-main-img">
<div class="product-preview">
    <img src="{{ asset('images/'.$get_meat->pic) }}" alt="{{ $get_meat->ar_name }}" height="400">
</div>
</div>
</div>
<!-- Product details -->
<div class="col-md-5 mt-2">
    <div class="product-details">
        <h2 class="product-name rtl-text-right">
            {{ $locale === 'ar' ? $get_meat->ar_name : $get_meat->en_name }}
            <span class="product-available text-white p-2 {{ $get_meat->stock->quantity > 0 ? 
                'bg-success'  : 
                'bg-danger'}}">
                {{ $get_meat->stock->quantity > 0 ? 
                    trans('sentence.Available')  : 
                    trans('sentence.Not Available') }}
            </span>
        </h2>
        <div class="rtl-text-right">
            <div class="product-rating rtl-text-right">
                @for ($i = 1; $i <= 5; $i++)
                @if($i <= round($get_meat->meatsrating->avg('ratting')))
                    @php
                    $color = 'text-danger';
                    @endphp
                    @else
                    @php
                    $color = 'text-divider';
                    @endphp
                    @endif
                    <i class="fa fa-star {{ $color }}"></i>
                @endfor
                <hr class="primary-divider"/>
            </div>
            <a class="review-link" dir="rtl"> 
                {{ trans('sentence.ratings count') }}  {{ $get_meat->meatsratings->count() }}
                </a> | {{ trans('sentence.Category') }}:
                 {{ $locale === 'ar' ? $get_meat->cattlesType->ar_name : 
                 $get_meat->cattlesType->en_name }}
        </div>
        <div class="rtl-text-right pb-10">
            <h3 class="product-price rtl-text-right text-success">
                @isset($get_meat->discount_meat->last()->discount->amount)
                <del class="text-divider old-price">
                    {{ $get_meat->stock->price }}
                    <span class="float-left">
                        {{ trans('sentence.Rial  For KG') }}
                    </span>
                </del> <br>
                {{  $get_meat->stock->price - $get_meat->discount_meat->last()->discount->amount / 
                    ($get_meat->stock->price * 100) }}
                    <span class="float-left">
                        {{ trans('sentence.Rial  For KG') }}
                    </span>
                    @else 
                    {{ $get_meat->stock->price }} 
                    {{ trans('sentence.Rial  For KG') }}
                @endisset
               
            </h3>
        </div>
        <p>
           {{ $locale === 'ar' ? $get_meat->ar_description : 
           $get_meat->en_description }} 
        </p>
        <form class="add-to-cart" action="/add-to-cart" method="POST">
            @csrf
            <input type="hidden" name="productId" value="{{ $get_meat->id }}">
            <input type="hidden" name="ar_name" value="{{ $get_meat->ar_name }}">
            <input type="hidden" name="pic" value="{{ asset('images/'. $get_meat->pic) }}">
            <input type="hidden" name="pic" value="{{ asset('images/'. $get_meat->pic) }}">

            <div class="qty-label">
                {{ trans('sentence.Qty') }}
                <div class="input-number">
                    <input type="number" placeholder="{{ trans('sentence.KG') }}" min="1"
                     max="{{ $get_meat->stock->quantity }}" name="qty">
                    <span class="qty-up">+</span>
                    <span class="qty-down">-</span>
                </div>
                <span>
                    {{ trans('sentence.Max Qty') }}
                    {{ $get_meat->stock->quantity }}
                </span>
            </div>
            <button class="add-to-cart-btn rtl-float-left">
            <i class="fa fa-shopping-cart"></i> 
            {{ trans('sentence.add to cart') }}
            </button>
        </form>

        <ul class="product-btns rtl-text-right h2">
            <li>
                @auth
                @if (Auth::user()->favorites->where('meat_id', $get_meat->id)
                ->where('user_id', Auth::user()->id)->first())
                <form action="{{ route('removeFromFav', $get_meat->id) }}"
                    method="POST">
                    @csrf
                    <button type="submit" class="btn btn-default">
                    <i class="fa fa-heart-o text-danger"></i> 
                    {{ trans('sentence.Remove From wishlist') }}</button>
                </form>
                @else 
                <form action="{{ route('addToFav', $get_meat->id) }}"
                    method="POST">
                    @csrf
                    <button type="submit" class="btn btn-default">
                    <i class="fa fa-heart-o text-danger"></i> 
                    {{ trans('sentence.add to wishlist') }}</button>
                </form>
                @endif
                @else 
                <form action="{{ route('addToFav', $get_meat->id) }}"
                    method="POST">
                    @csrf
                    <button type="submit" class="btn btn-default">
                    <i class="fa fa-heart-o text-danger"></i> 
                    {{ trans('sentence.add to wishlist') }}</button>
                </form>
                @endauth
                </li>
            <li class="mr-30">
                {{ trans('sentence.Category') }}: {{ $locale === 'ar' ?
                $get_meat->cattlesType->ar_name : $get_meat->cattlesType->en_name }}</li>
        </ul>

        {{-- <ul class="product-links">
            <li class="ml-4">{{ trans('sentence.Share') }}:</li>
            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
            <li><a href="#"><i class="fa fa-envelope"></i></a></li>
        </ul> --}}
        <!-- Review Form -->
        <div class="col-md-12 mt-2 pt-4">
            <div id="review-form">
                <form class="review-form">
                    <div class="input-rating rtl-text-right h4">
                       <div id="loadProductRating"></div>
                       <div id="loadProductRatingMsg" class="p-1"></div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /Review Form -->

    </div>
</div>
<!-- /Product details -->
<script>
    $(document).ready(function(){
        function loadRatings(){}
        loadRatings();
        function loadRatings(){
            $.ajax({
                url: "{{url('/product/rating/'.$get_meat->id)  }}",
                method: 'get', 
                success: function(data){
                    $("#loadProductRating").html(data);
                }
            })
        }
    $(document).on('mouseenter', '.product-rating', function(){
                var index = $(this).data('index');
                var productId = $(this).data('product_id');
                var rating = $(this).data('rating');
                remove_background(productId);
                for(var count=1; count<=index; count++){
                $("#"+productId+'-'+count).css('color', '#ff4444');
                }
            });
        function remove_background(productId){
                for(var count = 1; count <= 5; count++){
                $("#"+productId+'-'+count).css('color', '#bdbdbd');
                }
            }
    $(document).on('click', '.product-rating', function(){
            var index = $(this).data('index');
            var productId = $(this).data('product_id');
            $.ajax({
                url: "{{url('/product/insert-rating/'.$get_meat->id)  }}",
                method: 'get',
                data:{index:index, productId:productId},
                success: function(data){
                    loadRatings();
                    $("#loadProductRatingMsg").addClass('bg-success text-center text-capitalize');
                    $("#loadProductRatingMsg").html(data);
                }
            })
        });
    });
</script>
<!-- SECTION -->
<div class="section">
<!-- container -->
<div class="container">
<!-- row -->
<div class="row">
<!-- Product main img -->
<div class="col-md-5 col-md-push-2">
<div id="product-main-img">
<div class="product-preview">
    <img src="{{ asset('images/meat2.webp') }}" alt="">
</div>

<div class="product-preview">
    <img src="{{ asset('images/meat1.webp') }}" alt="">
</div>

<div class="product-preview">
    <img src="{{ asset('images/meat3.webp') }}" alt="">
</div>

<div class="product-preview">
    <img src="{{ asset('images/meat1.webp') }}" alt="">
</div>
</div>
</div>
<!-- /Product main img -->
<!-- Product thumb imgs -->
<div class="col-md-2  col-md-pull-5">
    <div id="product-imgs">
        <div class="product-preview">
            <img src="{{ asset('images/meat2.webp') }}" alt="">
        </div>

        <div class="product-preview">
            <img src="{{ asset('images/meat1.webp') }}" alt="">
        </div>

        <div class="product-preview">
            <img src="{{ asset('images/meat3.webp') }}" alt="">
        </div>

        <div class="product-preview">
            <img src="{{ asset('images/meat1.webp') }}" alt="">
        </div>
    </div>
</div>
<!-- /Product thumb imgs -->
<!-- Product details -->
<div class="col-md-5 mt-3">
    <div class="product-details">
        <h2 class="product-name rtl-text-center">
            اسم المنتج
        </h2>
        <div class="rtl-text-center">
            <div class="product-rating">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-o"></i>
            </div>
            <a class="review-link" href="#" dir="rtl"> {{ trans('sentence.ratings count') }}  10
                </a> | {{ trans('sentence.Category') }}: {{ trans('sentence.Beef') }}
        </div>
        <div class="rtl-text-center">
            <h3 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h3>
            <span class="product-available">
                {{ trans('sentence.In Stock') }}
            </span>
        </div>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>


        <div class="add-to-cart">
            <div class="qty-label">
                {{ trans('sentence.Qty') }}
                <div class="input-number">
                    <input type="number" placeholder="{{ trans('sentence.KG') }}">
                    <span class="qty-up">+</span>
                    <span class="qty-down">-</span>
                </div>
            </div>
            <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> 
            {{ trans('sentence.add to cart') }}
            </button>
        </div>

        <ul class="product-btns rtl-text-right h2">
            <li><a href="#"><i class="fa fa-heart-o"></i> 
            {{ trans('sentence.add to wishlist') }}</a></li>
            <li class="mr-30">
                {{ trans('sentence.Category') }}: {{ trans('sentence.Beef') }}</li>
            <li><a href="#">
                </a></li>
        </ul>

        <ul class="product-links">
            <li class="ml-4">{{ trans('sentence.Share') }}:</li>
            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
            <li><a href="#"><i class="fa fa-envelope"></i></a></li>
        </ul>
        <!-- Review Form -->
        <div class="col-md-12 mt-4 pt-4">
            <br>
            <div id="review-form">
                <form class="review-form">
                    <div class="input-rating rtl-text-right h4">
                        <span>{{ trans('sentence.Your Rating') }}: </span>
                        <div class="stars">
                            <input id="star5" class="stars_rating" name="rating" value="5" type="radio"><label for="star5"></label>
                            <input id="star4" class="stars_rating" name="rating" value="4" type="radio"><label for="star4"></label>
                            <input id="star3" class="stars_rating" name="rating" value="3" type="radio"><label for="star3"></label>
                            <input id="star2" class="stars_rating" name="rating" value="2" type="radio"><label for="star2"></label>
                            <input id="star1" class="stars_rating" name="rating" value="1" type="radio"><label for="star1"></label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /Review Form -->

    </div>
</div>
<!-- /Product details -->
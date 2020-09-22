<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- shop -->
            <div class="col-md-4 col-xs-6">
                <div class="shop">
                    <div class="shop-img">
                        <img src="{{ asset('images/meat1.webp') }}" alt="{{ trans('sentence.Beef') }}" height="240">
                    </div>
                    <div class="shop-body">
                        <h3>{{ trans('sentence.Beef') }}</h3>
                        <a href="/category/{{ trans('sentence.Beef') }}" class="cta-btn"> 
                            {{ trans('sentence.Shop Now') }} <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /shop -->

            <!-- shop -->
            <div class="col-md-4 col-xs-6">
                <div class="shop">
                    <div class="shop-img">
                        <img src="{{ asset('images/meat2.webp') }}" alt="{{ trans('sentence.Goat meat') }}"
                         height="240">
                    </div>
                    <div class="shop-body">
                        <h3>{{ trans('sentence.Goat meat') }}</h3>
                        <a href="/category/{{ trans('sentence.Goat meat') }}" class="cta-btn"> 
                            {{ trans('sentence.Shop Now') }} <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /shop -->

            <!-- shop -->
            <div class="col-md-4 col-xs-6">
                <div class="shop">
                    <div class="shop-img">
                        <img src="{{ asset('images/meat3.webp') }}" alt="{{ trans('sentence.Mutton') }}" height="240">
                    </div>
                    <div class="shop-body">
                        <h3>{{ trans('sentence.Mutton') }}</h3>
                        <a href="/category/{{ trans('sentence.Mutton') }}" class="cta-btn">
                             {{ trans('sentence.Shop Now') }} <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /shop -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->
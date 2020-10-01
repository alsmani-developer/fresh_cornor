<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- section title -->
            <div class="col-md-12">
                <div class="section-title text-center">
                    <h3 class="title">
                        {{ trans('sentence.Discount And Offers') }}
                    </h3>
                </div>
            </div>
            <!-- /section title -->

            @forelse ($discounts as $discount)
                 <!-- shop -->
            <div class="col-md-4 col-xs-6 rtl-float-right">
                <div class="shop">
                    <div class="shop-img">
                        <img src="{{ asset('images/'.$discount->pic) }}" 
                        alt="{{ $locale === 'ar' ?  $discount->ar_name : $discount->en_name}}" height="240">
                    </div>
                    <div class="shop-body">
                        <h3> 
                            {{ $locale === 'ar' ?  $discount->ar_name : $discount->en_name}}
                        </h3>
                        <p class="text-light">
                            {{ $locale === 'ar' ?  mb_substr($discount->ar_description, 0, 30) :
                             mb_substr($discount->en_description, 0, 30) }}
                        </p>
                        <a href="/discount/{{ $discount->id }}" class="cta-btn"> 
                            {{ trans('sentence.More') }} <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /shop -->
            @empty
                
            @endforelse
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->
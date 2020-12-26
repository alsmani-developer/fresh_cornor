
    <!-- container -->
    <div class="container mb-4">
        <!-- row -->
        <div class="row">

            <!-- section title -->
            <div class="col-md-12">
                <div class="section-title text-center">
                    <h3 class="title">
                        {{ trans('sentence.Related Products') }}
                    </h3>
                </div>
            </div>
            <!-- /section title -->

            <!-- Products tab & slick -->
            <div class="col-md-12">
                <div class="row">
                    <div class="products-tabs">
                        <!-- tab -->
                        <div id="tab1" class="tab-pane active">
                            <div class="products-slick" data-nav="#slick-nav-1">
                                @forelse ($relatedMeats as $relatedMeat)
                                    <!-- product -->
                                <div class="product">
                                    <a href="/product/{{ $relatedMeat->id }}"
                                        title="{{ $locale === 'ar' ? $relatedMeat->cattlesType->ar_name : 
                                        $relatedMeat->cattlesType->en_name }}">
                                    <div class="product-img">
                                        <img src="{{ asset('images/'.$relatedMeat->pic) }}" 
                                        alt="{{ $relatedMeat->ar_name }}">
                                        @isset($relatedMeat->discount_meat->last()->discount->amount)
                                        <div class="product-label">
                                            <span class="new">
                                                {{ $relatedMeat->discount_meat->last()->discount->amount }}%
                                            </span>
                                        </div>
                                        @endisset
                                        <div class="product-label-contity">
                                            <span class="available">
                                                {{ $relatedMeat->stock->quantity > 0 ? 
                                                    trans('sentence.Available')  : 
                                                    trans('sentence.Not Available') }}
                                            </span>
                                        </div>
                                    </div>
                                    </a>
                                    <div class="product-body">
                                        <p class="product-category">
                                            {{ $locale === 'ar' ? $relatedMeat->cattlesType->ar_name : 
                                                $relatedMeat->cattlesType->en_name }}
                                        </p>
                                        <h3 class="product-name">
                                            <a href="/product/{{ $relatedMeat->id }}">
                                            {{ $locale === 'ar' ? $relatedMeat->ar_name : $relatedMeat->en_name }}
                                        </a></h3>
                                        @isset($relatedMeat->discount_meat->last()->discount->amount)
                                        <h4 class="product-price" dir="{{ $locale === 'ar' ? 'rtl' : 'ltl' }}"> 
                                            <del class="text-divider">
                                                {{ $relatedMeat->stock->price }}
                                            <span class="float-left">
                                                {{ trans('sentence.Rial  For KG') }}
                                            </span>
                                            
                                            </del> <br>
                                            </h4>
                                            <h4 class="product-price text-success" dir="{{ $locale === 'ar' ? 'rtl' : 'ltl' }}">
                                            {{  $relatedMeat->stock->price - $relatedMeat->discount_meat->last()->discount->amount / 
                                                ($relatedMeat->stock->price * 100) }}
                                             <span class="float-left"> 
                                                {{ trans('sentence.Rial  For KG') }}
                                             </span>
                                            </h4>
                                            @else 
                                            <h4 class="product-price text-success" dir="{{ $locale === 'ar' ? 'rtl' : 'ltl' }}"> 
                                                {{ $relatedMeat->stock->price }}
                                                <span class="float-left">
                                                    {{ trans('sentence.Rial  For KG') }}
                                                </span>
                                                </h4>
                                            @endisset
                                        <div class="product-rating">
                                            @for ($i = 1; $i <= 5; $i++)
                                            @if($i <= round($relatedMeat->meatsrating->avg('ratting')))
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
                                        </div>
                                        <form class="product-btns" action="{{ route('addToFav', $relatedMeat->id) }}"
                                            method="POST">
                                            @csrf
                                           <button class="add-to-wishlist" type="submit">
                                               <i class="fa fa-heart-o"></i><span class="tooltipp">
                                               {{ trans('sentence.add to wishlist') }}</span>
                                           </button>
                                       <button class="quick-view"><i class="fa fa-eye"></i>
                                           <p class="tooltipp" dir="{{ $locale == 'ar' ? 'rtl' : 'ltl' }}"> 
                                               {{ $relatedMeat->views }}
                                               {{ trans('sentence.views') }}
                                               </p>
                                           </button>
                                       </form>
                                    </div>
                                    {{-- <div class="add-to-cart">
                                        <button class="add-to-cart-btn d-none" id="{{ $relatedMeat->id }}">
                                            <i class="fa fa-shopping-cart"></i> 
                                        {{ trans('sentence.add to cart') }}
                                    </button>
                                    <div class="qty-label pb-2">
                                        {{ trans('sentence.Qty') }}
                                        <div class="input-number w-50 d-inline">
                                            <input type="number" placeholder="{{ trans('sentence.KG') }}" min="1"
                                             max="{{ $get_meat->stock->quantity }}" name="qty">
                                        </div>
                                        <button class="add-to-cart-btn w-50 d-inline" id="{{ $relatedMeat->id }}">
                                            <i class="fa fa-shopping-cart"></i> 
                                        {{ trans('sentence.add to cart') }}
                                        </button>
                                    </div>
                                    </div> --}}
                                </div>
                                <!-- /product -->
                                @empty
                                    <h3 class="text-center">
                                        لا توجد منتجات مشابهة
                                    </h3>
                                @endforelse
                                
                            </div>
                        </div>
                        <!-- /tab -->
                    </div>
                </div>
            </div>
            <!-- Products tab & slick -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
<script>
    $(document).ready(function(){
        $(".add-to-cart-btn").on('click', function(){
            console.log(this.id);
        });
    });
</script>
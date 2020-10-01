
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <!-- Products tab & slick -->
            <div class="col-md-12">
                <div class="row">
                    <div class="products-tabs">
                        <!-- tab -->
                        <div id="tab1" class="tab-pane active">
                            <div class="products-slick" data-nav="#slick-nav-1">
                                @forelse ($discount->discountsMeat as $get_meat)
                                    <!-- product -->
                                <div class="product mb-4">
                                    <a href="/product/{{ $get_meat->meat->id }}">
                                    <div class="product-img">
                                        <img src="{{ asset('images/'.$get_meat->meat->pic) }}" 
                                        alt="{{ $locale === 'ar' ?  $get_meat->meat->ar_name 
                                        : $get_meat->meat->en_name }}">
                                        @isset($discount->amount)
                                        <div class="product-label">
                                            <span class="sale">
                                                {{ $discount->amount}}%
                                            </span>
                                        </div> 
                                        @endisset
                                        <div class="product-label-contity">
                                            <span class="{{ $get_meat->meat->stock->quantity > 0 ? 'available' : 'not_available' }}">
                                                     {{ $get_meat->meat->stock->quantity > 0 ? 
                                                     trans('sentence.Available')  : trans('sentence.Not Available') }}
                                            </span>
                                        </div>
                                    </div>
                                    </a>
                                    <div class="product-body" title="">
                                        <p class="product-category">
                                        {{ $locale == 'ar' ? $get_meat->meat->cattlesType->ar_name :
                                        $get_meat->meat->cattlesType->en_name }}    
                                        </p>
                                        <h3 class="product-name">
                                            <a href="/product/{{ $get_meat->meat->id }}">
                                            {{ $locale === 'ar' ?  $get_meat->meat->ar_name : $get_meat->meat->en_name }}
                                            </a>
                                        </h3>
                                        <h4 class="product-price" dir="rtl"> 
                                            @isset($discount->amount)
                                            <del class="text-divider">
                                               <span class="float-left">
                                                   {{ trans('sentence.Rial') }}
                                                   {{ trans('sentence.KG') }}
                                               </span>
                                               {{ $get_meat->meat->stock->price }}
                                           </del> <br>
                                           @php
                                           @endphp
                                           </h4>
                                           <h4 class="product-price text-success" dir="rtl">
                                               {{  $get_meat->meat->stock->price - 
                                               $discount->amount
                                                / ($get_meat->meat->stock->price * 100) }}
                                            <span class="float-left">
                                               {{ trans('sentence.Rial') }}
                                               {{ trans('sentence.KG') }}
                                            </span>
                                           </h4>
                                           @else 
                                           <h4 class="product-price text-success" dir="rtl">
                                               {{  $get_meat->meat->stock->price }}
                                            <span class="float-left">
                                               {{ trans('sentence.Rial') }}
                                               {{ trans('sentence.KG') }}
                                            </span>
                                           </h4>
                                            @endisset
                                            <div class="product-rating">
                                                @for ($i = 1; $i <= 5; $i++)
                                                @if($i <= round($get_meat->meat->meatsrating->avg('ratting')))
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
                                            @auth
                                            @if (Auth::user()->favorites->where('meat_id', $get_meat->meat->id)
                                                ->where('user_id', Auth::user()->id)->first())
                                                <form class="product-btns" action="{{ route('removeFromFav', $get_meat->meat->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button class="add-to-wishlist" type="submit">
                                                        <i class="fa fa-heart-o text-danger"></i><span class="tooltipp">
                                                        {{ trans('sentence.Remove From wishlist') }}</span>
                                                    </button>
                                                <button class="quick-view"><i class="fa fa-eye"></i>
                                                    <p class="tooltipp" dir="{{ $locale == 'ar' ? 'rtl' : 'ltl' }}"> 
                                                        {{ $get_meat->meat->views }}
                                                        {{ trans('sentence.views') }}
                                                        </p>
                                                    </button>
                                                </form>
                                                @else
                                                <form class="product-btns" action="{{ route('addToFav', $get_meat->meat->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button class="add-to-wishlist" type="submit">
                                                        <i class="fa fa-heart-o"></i><span class="tooltipp">
                                                        {{ trans('sentence.add to wishlist') }}</span>
                                                    </button>
                                                <button class="quick-view"><i class="fa fa-eye"></i>
                                                    <p class="tooltipp" dir="{{ $locale == 'ar' ? 'rtl' : 'ltl' }}"> 
                                                        {{ $get_meat->meat->views }}
                                                        {{ trans('sentence.views') }}
                                                        </p>
                                                    </button>
                                                </form>
                                                @endif
                                                @else 
                                            <form class="product-btns" action="{{ route('addToFav', $get_meat->meat->id) }}"
                                                method="POST">
                                                @csrf
                                                <button class="add-to-wishlist" type="submit">
                                                    <i class="fa fa-heart-o"></i><span class="tooltipp">
                                                    {{ trans('sentence.add to wishlist') }}</span>
                                                </button>
                                            <button class="quick-view"><i class="fa fa-eye"></i>
                                                <p class="tooltipp" dir="{{ $locale == 'ar' ? 'rtl' : 'ltl' }}"> 
                                                    {{ $get_meat->meat->views }}
                                                    {{ trans('sentence.views') }}
                                                    </p>
                                                </button>
                                            </form>
                                            @endauth
                                            
                                    </div>
                                </div>
                                <!-- /product -->
                                @empty
                                    
                                @endforelse
                            </div>
                            <div id="slick-nav-1" class="products-slick-nav"></div>
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
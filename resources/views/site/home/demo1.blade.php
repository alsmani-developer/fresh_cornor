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
                        {{ trans('sentence.New Products') }}
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
                                @forelse ($get_meats as $get_meat)
                                {{-- {{ dd($get_meat->discount_meat->last()->discount->amount) }} --}}
                                    <!-- product -->
                                <div class="product">
                                    <a href="/product/{{ $get_meat->id }}" 
                                        title="{{ $locale === 'ar' ?  $get_meat->ar_name : $get_meat->en_name }}">
                                    <div class="product-img">
                                        <img src="{{ asset('images/'.$get_meat->pic) }}" 
                                        alt="{{ $locale === 'ar' ?  $get_meat->ar_name : $get_meat->en_name }}">
                                        @isset($get_meat->discount_meat->last()->discount->amount)
                                        <div class="product-label">
                                            <span class="sale">
                                                {{ $get_meat->discount_meat->last()->discount->amount}}%
                                            </span>
                                        </div> 
                                        @endisset
                                        
                                        <div class="product-label-contity">
                                            <span class="{{ $get_meat->stock->quantity > 
                                            0 ? 'available' : 'not_available' }}">
                                                     {{ $get_meat->stock->quantity > 0 ? 
                                                     trans('sentence.Available')  : 
                                                     trans('sentence.Not Available') }}
                                            </span>
                                        </div>
                                    </div>
                                    </a>
                                    <div class="product-body" title="">
                                        <p class="product-category">
                                            {{ $locale == 'ar' ? $get_meat->cattlesType->ar_name :
                                            $get_meat->cattlesType->en_name }} 
                                        </p>
                                        <h3 class="product-name">
                                            <a href="/product/{{ $get_meat->id }}">
                                            {{ $locale === 'ar' ?  $get_meat->ar_name : $get_meat->en_name }}
                                            </a>
                                        </h3>

                                         <h4 class="product-price" dir="rtl"> 
                                             @isset($get_meat->discount_meat->last()->discount->amount)
                                             <del class="text-divider">
                                                <span class="float-left">
                                                    {{ trans('sentence.Rial') }}
                                                    {{ trans('sentence.KG') }}
                                                </span>
                                                {{ $get_meat->stock->price }}
                                            </del> <br>
                                            @php
                                            @endphp
                                            </h4>
                                            <h4 class="product-price text-success" dir="rtl">
                                                {{  $get_meat->stock->price - 
                                                $get_meat->discount_meat->last()->discount->amount
                                                 / ($get_meat->stock->price * 100) }}
                                             <span class="float-left">
                                                {{ trans('sentence.Rial') }}
                                                {{ trans('sentence.KG') }}
                                             </span>
                                            </h4>
                                            @else 
                                            <h4 class="product-price text-success" dir="rtl">
                                                {{  $get_meat->stock->price }}
                                             <span class="float-left">
                                                {{ trans('sentence.Rial') }}
                                                {{ trans('sentence.KG') }}
                                             </span>
                                            </h4>
                                             @endisset
                                        <div class="product-rating">
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
                                        </div>
                                        <form class="product-btns" action="{{ route('addToFav', $get_meat->id) }}"
                                            method="POST">
                                            @csrf
                                           <button class="add-to-wishlist" type="submit">
                                               <i class="fa fa-heart-o"></i><span class="tooltipp">
                                               {{ trans('sentence.add to wishlist') }}</span>
                                           </button>
                                       <button class="quick-view"><i class="fa fa-eye"></i>
                                           <p class="tooltipp" dir="{{ $locale == 'ar' ? 'rtl' : 'ltl' }}"> 
                                               {{ $get_meat->views }}
                                               {{ trans('sentence.views') }}
                                               </p>
                                           </button>
                                       </form>
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
</div>
<!-- /SECTION -->
<!-- HEADER -->
<header>
    <!-- TOP HEADER -->
    <div id="top-header">
        <div class="container">
            <ul class="header-links pull-left">
                <li><a href="#"><i class="fa fa-phone"></i> +021-95-51-84</a></li>
                <li><a href="#"><i class="fa fa-envelope-o"></i> email@email.com</a></li>
                <li><a href="#"><i class="fa fa-map-marker"></i> 1734 Stonecoal Road</a></li>
            </ul>
            <ul class="header-links pull-right">
                @if (!Auth::check())
                <li><a href="/login"><i class="fa fa-user-o"></i> 
                    {{ trans('sentence.Login')}}
                </a></li>
                <li><a href="/register"><i class="fa fa-registered"></i> 
                    {{ trans('sentence.Register')}}
                </a></li>
                    @else 
                    <li>
                    <a href="{{ route('account.orders') }}" class="text-info">
                    {{ trans('sentence.Orders') }}</a>
                    <i class="fa fa-bookmark text-info"></i>
                    </li>
                    <li><a href="{{ route('userProfile') }}">
                        {{ trans('sentence.Profile')}}
                        <img src="{{ asset('profile/defualt.png') }}" alt="{{ Auth::user()->name }}" width="20" height="20">
                    </a></li>
                    <li class="rtl-text-right mr-3"><a href="/logout">
                        <i class="fa fa-sign-out"></i>
                        {{ trans('sentence.LogOut')}}
                    </a></li>
                    @endif
                <li><a href="/change-lang/eng">
                    English
                    </a>
                    |
                </li> 
                <li><a href="/change-lang/ar">
                    العربية
                    </a>
                </li> 
            </ul>
        </div>
    </div>
    <!-- /TOP HEADER -->

    <!-- MAIN HEADER -->
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class="col-md-3">
                    <div class="header-logo">
                        <a href="/" class="logo text-light">
                            <h3 class="text-light">
                               <span class="text-red">F</span>resh <span class="text-red">C</span>ornor
                            </h3>
                        </a>
                    </div>
                </div>
                <!-- /LOGO -->

                <!-- SEARCH BAR -->
                <div class="col-md-5">
                    <div class="header-search">
                        <form method="GET" action="{{ route('products.search-result') }}">
                            @csrf
                            {{-- <select class="input-select" name="search_cate">
                                <option value="0">
                                    {{ trans('sentence.All Categories') }}
                                </option>
                                @if ($locale == 'ar')
                                    @foreach ($CattlesType as $CattleType)
                                    <option value="{{ $CattleType->id }}">
                                        {{ $CattleType->ar_name }}
                                    </option>
                                    @endforeach
                                    @else
                                    @foreach ($CattlesType as $CattleType)
                                    <option value="{{ $CattleType->id }}">
                                        {{ $CattleType->en_name }}
                                    </option>
                                    @endforeach
                                @endif
                            </select> --}}
                            <input class="input" placeholder="{{ trans('sentence.Search Here')}}" 
                            name="search_text">
                            <button class="search-btn" type="submit">
                                {{ trans('sentence.Search')}}
                            </button>
                        </form>
                        <button class="text-white cursor-pointer small adv_search_btn" id="adv_search_btn">
                            {{ trans('sentence.Advanced Search') }}
                        </button>
                    </div> 
                </div>
                <!-- /SEARCH BAR -->

                <!-- ACCOUNT -->
                <div class="col-md-4 clearfix">
                    <div class="header-ctn">
                         <!-- Notification -->
                         <div class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <i class="fa fa-exclamation-circle "></i>
                                <span>
                                    {{ trans('sentence.Notification')}}
                                </span>
                                <div class="qty">3</div>
                            </a>
                            <div class="cart-dropdown">
                                <div class="cart-list">
                                    <div class="product-widget">
                                        <div class="product-img">
                                            <img src="./img/product01.png" alt="">
                                        </div>
                                        <div class="product-body">
                                            <h3 class="product-name"><a href="#">product name goes here</a></h3>
                                            <h4 class="product-price"><span class="qty">1x</span>$980.00</h4>
                                        </div>
                                        <button class="delete"><i class="fa fa-close"></i></button>
                                    </div>

                                    <div class="product-widget">
                                        <div class="product-img">
                                            <img src="./img/product02.png" alt="">
                                        </div>
                                        <div class="product-body">
                                            <h3 class="product-name"><a href="#">product name goes here</a></h3>
                                            <h4 class="product-price"><span class="qty">3x</span>$980.00</h4>
                                        </div>
                                        <button class="delete"><i class="fa fa-close"></i></button>
                                    </div>
                                </div>
                                <div class="cart-summary">
                                    <small>3 Item(s) selected</small>
                                    <h5>SUBTOTAL: $2940.00</h5>
                                </div>
                                <div class="cart-btns">
                                    <a href="#">View Cart</a>
                                    <a href="#">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- /Notification -->
                        <!-- Wishlist -->
                        <div>
                            <a href="{{ route('userProfile') }}">
                                <i class="fa fa-heart-o"></i>
                                <span>{{ trans('sentence.Your Wishlist')}}</span>
                                <div class="qty">
                                    @auth
                                        {{ Auth::user()->favorites->count() }}
                                        @else 
                                        0
                                    @endauth
                                </div>
                            </a>
                        </div>
                        <!-- /Wishlist -->

                        <!-- Cart -->
                        <div class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <i class="fa fa-shopping-cart"></i>
                                <span>
                                    {{ trans('sentence.Your Cart')}}
                                </span>
                                <div class="qty">
                                    {{ $cartCount }}
                                </div>
                            </a>
                            <div class="cart-dropdown">
                                @if (\Cart::isEmpty())
                                <p class="alert alert-warning">Your shopping cart is empty.</p>
                                @else
                                <div class="cart-list">
                                    @foreach(\Cart::getContent() as $item)
                                    <div class="product-widget rtl-text-right">
                                        <div class="product-img">
                                            <img src="{{ $item->attributes->pic }}" alt="">
                                        </div>
                                        <div class="product-body mr-2">
                                            <h3 class="product-name">
                                            <a href="/product/{{ $item->attributes->productId }}">
                                                {{ $item->name }}    
                                            </a>
                                            </h3>
                                            <h4 class="product-price text-success">
                                                {{ trans('sentence.Price') }}:
                                                {{  $item->price }}
                                                {{ trans('sentence.Rial  For KG') }}
                                            </h4>
                                            <h4 class="product-price text-info">
                                                {{ trans('sentence.Quantity') }}:
                                                {{  $item->quantity }}
                                                {{ trans('sentence.KG') }}
                                            </h4>
                                        </div>
                                        <a href="{{ route('checkout.cart.remove', $item->id) }}" class="delete"><i class="fa fa-close"></i></a>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="cart-summary rtl-text-right">
                                    <small>{{ \Cart::getContent()->count() }} {{ trans('sentence.Item(s) selected') }}</small>
                                    <h5 class="text-success">{{ trans('sentence.Total') }}: {{ \Cart::getSubTotal() }} {{ trans('sentence.Rial') }}</h5>
                                </div>
                                <div class="cart-btns">
                                    <a href="/cart">
                                    {{ trans('sentence.View Cart') }}
                                    </a>
                                    <a href="{{ route('checkout.index') }}">
                                        {{ trans('sentence.Checkout') }}  <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            @endif
                        </div>
                        <!-- /Cart -->

                        <!-- Menu Toogle -->
                        <div class="menu-toggle">
                            <a href="#">
                                <i class="fa fa-bars"></i>
                                <span>Menu</span>
                            </a>
                        </div>
                        <!-- /Menu Toogle -->
                    </div>
                </div>
                <!-- /ACCOUNT -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
    <!-- /MAIN HEADER -->
</header>
<!-- /HEADER -->
<form class="jumbotron d-none" id="adv_search_form" action="{{ route('products.adv-search-result') }}" method="GET">
    <div class="container" dir="rtl" style="margin-left:11%">
        <div class="row w-100" id="search">
                <div class="form-group col-xs-2 pr-0">
                    <button type="submit" class="btn btn-block btn-info w-100">
                        {{ trans('sentence.Search') }}
                    </button>
                </div>
                <div class="form-group col-xs-10 pl-0">
                    <input class="form-control" type="text" 
                    placeholder="{{ trans('sentence.Search') }}" name="name"/>
                </div>
        </div>
        <div class="row w-100" id="filter">
            {{-- <div class="form-group col-sm-1 col-xs-0">
                <input type="text" name="price_min" placeholder="ادنى سعر" class="form-control">
            </div>
            <div class="form-group col-sm-1 col-xs-0">
                <input type="text" name="price_max" placeholder="اعلى سعر" class="form-control">
            </div> --}}
                <div class="form-group col-sm-3 col-xs-6">
                    <select data-filter="make" class="filter-make filter form-control" name="cattels_types_id">
                        <option value="">
                            {{ trans('sentence.Category') }}
                        </option>
                        @foreach ($CattlesType as $type)
                        <option value="{{ $type->id }}">
                            {{ $locale == 'ar' ? $type->ar_name : $type->en_name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-sm-3 col-xs-6">
                    <select data-filter="model" class="filter-model filter form-control" name="cattles_origins_id">
                        <option value="">{{ trans('sentence.Country') }}</option>
                        @forelse ($CattlesOrigins as $CattlesOrigin)
                        <option value="{{ $CattlesOrigin->id }}">
                            {{ $locale == 'ar' ? $CattlesOrigin->ar_name : $CattlesOrigin->en_name }}
                        </option>
                        @empty
                            
                        @endforelse
                    </select>
                </div>
                <div class="form-group col-sm-3 col-xs-6">
                    <select data-filter="type" class="filter-type filter form-control" name="meats_areas_id">
                        <option value="">{{ trans('sentence.Meats Areas') }}</option>
                        @forelse ($MeatsAreas as $MeatsArea)
                            <option value="{{ $MeatsArea->id }}">
                            {{ $locale == 'ar' ? $MeatsArea->ar_name : $MeatsArea->en_name }}
                            </option>
                        @empty
                        @endforelse
                    </select>
                </div>
                <div class="form-group col-sm-3 col-xs-6">
                    <select data-filter="price" class="filter-price filter form-control" name="meats_shapes_id">
                        <option value="">
                        {{ trans('sentence.Meats Shape') }}
                        </option>
                        @forelse ($MeatsShapes as $MeatsShape)
                            <option value="{{ $MeatsShape->id }}">
                            {{ $locale == 'ar' ? $MeatsShape->ar_name : $MeatsShape->en_name }}
                            </option>
                        @empty
                            
                        @endforelse
                    </select>
                </div>
                {{-- <div class="form-group col-sm-2 col-xs-6">
                    <select data-filter="price" class="filter-price filter form-control">
                        <option value="">Select Price Range</option>
                        <option value="">Show All</option>
                    </select>
                </div> --}}
        </div>
        </div>
    </form>

    <script>
        $(document).ready(function(){
            $("#adv_search_btn").on('click', function(){
                $("#adv_search_form").toggle(200);
            });
        });
    </script>
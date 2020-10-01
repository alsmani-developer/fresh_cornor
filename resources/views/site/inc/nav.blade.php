<!-- NAVIGATION -->
<nav id="navigation">
    <!-- container -->
    <div class="container">
        <!-- responsive-nav -->
        <div id="responsive-nav">
            <ul class="main-nav nav navbar-nav" dir="rtl">
                @if (session()->get('locale') == 'eng')
                <li class="{{ empty(Request::segment(1)) ? 'active ' : null }}"><a href="/">
                    {{ trans('sentence.Home Page') }}    
                    </a>
                    </li>
                    <li class="{{ Request::segment(1) === 'products' ? 'active ' : null }}">
                        <a href="/products">
                        {{ trans('sentence.All Products') }}    
                        </a>
                        </li>
                    <li class="{{ Request::segment(1) === 'discounts' ? 'active ' : null }}">
                        <a href="/discounts">
                        {{ trans('sentence.Discount And Offers') }}    
                    </a></li>
                    @foreach ($CattlesType as $CattleType)
                    <li class="{{ Request::segment(2) === $CattleType->id ? 'active ' : null }}">
                        <a href="/category/{{ $CattleType->id }}">
                            {{ $CattleType->en_name }}
                        </a>
                    </li>
                    @endforeach
                        <li class=""><a href="#">
                            {{ trans('sentence.Products Delivery') }}    
                            </a>
                            </li>
                            <li class=""><a href="#">
                            {{ trans('sentence.Payment Methods') }}    
                            </a>
                            </li>
                @else
                        <li class="">
                        <a href="#">
                        {{ trans('sentence.Products Delivery') }}    
                        </a>
                        </li>
                        <li class=""><a href="#">
                        {{ trans('sentence.Payment Methods') }}    
                        </a>
                        </li>
                        @foreach ($CattlesType as $CattleType)
                        <li class="{{ Request::segment(2) === $CattleType->id ? 'active ' : null }}">
                            <a href="/category/{{ $CattleType->id }}">
                                {{ $CattleType->ar_name }}
                            </a>
                        </li>
                        @endforeach
                        <li class="{{ Request::segment(1) === 'discounts' ? 'active ' : null }}">
                            <a href="/discounts">
                            {{ trans('sentence.Discount And Offers') }}    
                        </a></li>
                        <li class="{{ Request::segment(1) === 'products' ? 'active ' : null }}"><a href="/products">
                            {{ trans('sentence.All Products') }}    
                            </a>
                            </li>
                        <li class="{{ empty(Request::segment(1)) ? 'active ' : null }}"><a href="/">
                            {{ trans('sentence.Home Page') }}    
                            </a>
                            </li>
                            
                @endif
                
            </ul>
            <!-- /NAV -->
        </div>
        <!-- /responsive-nav -->
    </div>
    <!-- /container -->
</nav>
<!-- /NAVIGATION -->
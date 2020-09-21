<!-- NAVIGATION -->
<nav id="navigation">
    <!-- container -->
    <div class="container">
        <!-- responsive-nav -->
        <div id="responsive-nav">
            <!-- NAV -->
            <ul class="main-nav nav navbar-nav" dir="rtl">
                @if (session()->get('locale') == 'eng')
                <li class="active"><a href="#">
                    {{ trans('sentence.Home Page') }}    
                    </a>
                    </li>
                    <li class=""><a href="#">
                        {{ trans('sentence.All Products') }}    
                        </a>
                        </li>
                    <li><a href="#">
                        {{ trans('sentence.Hot Deals') }}    
                    </a></li>
                    <li><a href="#">
                    {{ trans('sentence.Beef') }}    
                    </a>
                    </li>
                    <li><a href="#">
                        {{ trans('sentence.Goat meat') }}    
                        </a>
                        </li>
                    <li><a href="#">
                        {{ trans('sentence.Mutton') }}    
                        </a>
                        </li>
                        <li class=""><a href="#">
                            {{ trans('sentence.Products Delivery') }}    
                            </a>
                            </li>
                            <li class=""><a href="#">
                            {{ trans('sentence.Payment Methods') }}    
                            </a>
                            </li>
                @else
                    <li class=""><a href="#">
                    {{ trans('sentence.Products Delivery') }}    
                    </a>
                    </li>
                    <li class=""><a href="#">
                    {{ trans('sentence.Payment Methods') }}    
                    </a>
                    </li>
                    <li><a href="#" class="">
                        {{ trans('sentence.Goat meat') }}    
                        </a>
                        </li>
                    <li><a href="#">
                        {{ trans('sentence.Mutton') }}    
                        </a>
                        </li>
                        <li><a href="#">
                            {{ trans('sentence.Beef') }}    
                            </a>
                            </li>
                        <li><a href="#">
                            {{ trans('sentence.Hot Deals') }}    
                        </a></li>
                        <li class=""><a href="#">
                            {{ trans('sentence.All Products') }}    
                            </a>
                            </li>
                        <li class="active"><a href="#">
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

<!-- FOOTER -->
<footer id="footer">
    <!-- top footer -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-3 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title footer-links-main">
                            {{ trans('sentence.About Us') }}
                        </h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.</p>
                        <ul class="footer-links footer-links-main">
                            <li><a href="#"><i class="fa fa-map-marker"></i>1734 Stonecoal Road</a></li>
                            <li><a href="#"><i class="fa fa-phone"></i>+021-95-51-84</a></li>
                            <li><a href="#"><i class="fa fa-envelope-o"></i>email@email.com</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">
                            {{ trans('sentence.All Categories') }}
                        </h3>
                        <ul class="footer-links">
                        @foreach ($CattlesType as $CattleType)
                        <li><a href="/category/{{ $CattleType->id }}">
                            {{ $locale == 'ar' ? $CattleType->ar_name : $CattleType->en_name }}
                        </a></li>
                        @endforeach
                        </ul>
                    </div>
                </div>

                <div class="clearfix visible-xs"></div>

                <div class="col-md-3 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">
                            {{ trans('sentence.Information') }}
                        </h3>
                        <ul class="footer-links">
                            <li><a href="#">
                                {{ trans('sentence.About Us') }}
                            </a></li>
                            <li><a href="#">
                                {{ trans('sentence.Contact Us') }}
                            </a></li>
                            <li><a href="#">
                                {{ trans('sentence.Privacy Policy') }}</a></li>
                            <li><a href="#">
                                {{ trans('sentence.Orders and Returns') }}</a></li>
                            <li><a href="#">
                                {{ trans('sentence.Terms & Conditions') }}</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">
                            {{ trans('sentence.Service') }}
                        </h3>
                        <ul class="footer-links">
                            <li><a href="/user-profile">
                                {{ trans('sentence.My Account') }}
                            </a></li>
                            <li><a href="/cart">
                                {{ trans('sentence.View Cart') }}</a></li>
                            <li><a href="/user-profile">
                                {{ trans('sentence.Wishlist') }}</a></li>
                            <li><a href="#">
                                {{ trans('sentence.Help') }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /top footer -->
    <!-- bottom footer -->
			<div id="bottom-footer" class="section">
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-12 text-center">
							<ul class="footer-payments">
								<li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
								<li><a href="#"><i class="fa fa-credit-card"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
							</ul>
							<span class="copyright">
								<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;<script>document.write(new Date().getFullYear());</script> 
                                All rights reserved
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							</span>
						</div>
					</div>
						<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /bottom footer -->
		</footer>
		<!-- /FOOTER -->



<!-- jQuery Plugins -->
<script src="{{ asset('js/site/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/site/slick.min.js') }}"></script>
<script src="{{ asset('js/site/nouislider.min.js') }}"></script>
<script src="{{ asset('js/site/jquery.zoom.min.js') }}"></script>
<script src="{{ asset('js/site/main.js') }}"></script>
<!-- Product tab -->
<div class="col-md-12">
    <div id="product-tab">
        <!-- product tab nav -->
        <ul class="tab-nav">
            <li class="active"><a data-toggle="tab" href="#tab1">
                {{ trans('sentence.Description') }}</a></li>
        </ul>
        <!-- /product tab nav -->

        <!-- product tab content -->
        <div class="tab-content">
            <!-- tab1  -->
            <div id="tab1" class="tab-pane fade in active">
                <div class="row rtl-text-right">
                    <div class="col-md-12">
                        <p>
                            {{ $locale === 'ar' ? $get_meat->ar_description : $get_meat->en_description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- /product tab content  -->
    </div>
</div>
<!-- /product tab -->
</div>
<!-- /row -->
</div>
<!-- /container -->
</div>
<!-- /SECTION -->
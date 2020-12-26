<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12 rtl-text-right">
                <ul class="breadcrumb-tree">
                    <li><a href="/">
                        {{ trans('sentence.Home Page') }}</a></li>
                    <li><a href="/products">
                        {{ trans('sentence.All Products') }}</a></li>
                    <li class="active">
                        {{ $locale === 'ar' ? $get_meat->ar_name : $get_meat->en_name }}
                    </li>
                </ul>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /BREADCRUMB -->

@if (session()->has('error'))
<div class="col-12 text-center alert alert-danger">
    {{ session()->get('error') }}
</div>

@endif
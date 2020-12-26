@extends('site.layouts.app')
@section('page-title', trans('sentence.Homepage'))
@section('slider')
<div class="container-fluid">
	<div class="row">
		<!-- Carousel -->
    	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
			<!-- Indicators -->
			<ol class="carousel-indicators">
			  	<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
			    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
			    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
			</ol>
			<!-- Wrapper for slides -->
			<div class="carousel-inner">
			    <div class="item active">
                    <img src="{{ asset('images/slider1.webp') }}"
                    width="100%" alt="First slide">
			    </div>
			    <div class="item">
                    <img src="{{ asset('images/slider2.webp') }}"
                    width="100%" alt="Second slide">
			    </div>
			</div>
			<!-- Controls -->
			<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
		    	<span class="fa fa-arrow-left"></span>
			</a>
			<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
		    	<span class=" fa fa-arrow-right"></span>
			</a>
		</div><!-- /carousel -->
	</div>
</div>
@endsection
@section('content')
@include('site.home.demo1')
 @include('site.home.demo2')
 @include('site.home.category') 
@endsection


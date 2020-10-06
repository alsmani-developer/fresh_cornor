@extends('site.layouts.app')
@section('page-title')
    {{ $user->name }}
@endsection
@section('content')
<div class="container emp-profile">
            <form method="post">
                <div class="row profile_con" dir="rtl">
                    <div class="col-md-2">
                        <a href="/user-profile/edit" class="btn btn-info w-100">
                        {{ trans('sentence.Edit Profile') }}</a>
                        <a href="/cart" class="btn btn-info mt-2 w-100">
                            {{ trans('sentence.Shopping Cart') }}</a>
                        <a href="{{ route('checkout.index') }}" class="btn btn-info mt-2 w-100">
                            {{ trans('sentence.Orders') }}</a>
                    </div>
                    <div class="col-md-6 pl-0 pr-0">
                        <div class="profile-head mt-2">
                                    <h5>
                                        {{ trans('sentence.Username') }}: 
                                        {{ $user->name }}
                                    </h5>
                                    <h6 class="mt-2">
                                        {{ trans('sentence.Email') }}:
                                        {{ $user->email }}
                                    </h6>
                                    <h6 class="mt-2">
                                        {{ trans('sentence.Phone') }}:
                                        {{ $user->phone }}
                                    </h6>
                        </div>
                    </div>
                    <div class="col-md-4 pr-0 pl-0">
                        <div class="profile-img">
                            <img src="{{ asset('/profile/'.$user->pic) }}" alt=""/>
                            <div class="file btn btn-lg btn-primary">
                                Change Photo
                                <input type="file" name="file"/>
                            </div>
                        </div>
                    </div>
                </div>
            </form>           
        </div>

        
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- section title -->
            <div class="col-md-12">
                <div class="section-title text-center">
                    <h3 class="title">
                        {{ trans('sentence.Favorites Products') }}
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
                                @forelse ($user->favorites as $get_meat)
                                    <!-- product -->
                                <div class="product mb-4">
                                    <a href="/product/{{ $get_meat->meat->id }}">
                                    <div class="product-img">
                                        <img src="{{ asset('images/'.$get_meat->meat->pic) }}" 
                                        alt="{{ $locale === 'ar' ?  $get_meat->meat->ar_name : $get_meat->meat->en_name }}">
                                        @isset($get_meat->meat->discount_meat->last()->discount->amount)
                                        <div class="product-label">
                                            <span class="sale">
                                                {{ $get_meat->meat->discount_meat->last()->discount->amount}}%
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
                                            @isset($get_meat->meat->discount_meat->last()->discount->amount)
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
                                               $get_meat->meat->discount_meat->last()->discount->amount
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
                                        <div class="product-btns">
                                            <form class="product-btns" action="{{ route('removeFromFav', $get_meat->meat->id) }}"
                                            method="POST">
                                            @csrf
                                           <button class="add-to-wishlist" type="submit">
                                               <i class="fa fa-heart-o text-danger"></i><span class="tooltipp">
                                               {{ trans('sentence.Remove From wishlist') }}</span>
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
@endsection
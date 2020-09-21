@extends('site.layouts.app')
@section('page-title')
    Fresh Cornor Products Page
@endsection
@section('content')
@php
    if (session()->has('locale')) {
            App::setLocale(session()->get('locale'));
        }
@endphp

<div class="container section position-relative">
    <div class="row">
    <form method="POST" action="" class="col-sm-6 col-sm-offset-3 position-relative rtl-text-right">
      <div class="jumbotron">
      <div class="form-group">
      <label for="user">
          {{ trans('sentence.Phone Number') }}
      </label>
      <input type="text" class="form-control" id="user" name="user" placeholder="{{ trans('sentence.Phone Number') }}">
      
    <div class="form-group mt-2">
      <label for="password"> 
          {{ trans('sentence.Password') }}
      </label>
      <input type="password" class="form-control" id="password" placeholder="{{ trans('sentence.Password') }}">
     <br /> 
    <div class="form-group">
    <div>
      <div class="w-100">
        <ul class="list-inline">
      <button type="button" class="btn btn-primary active w-50">
          {{ trans('sentence.Login') }}
      </button>
      <li class="list-inline-item float-right rtl-float-left">
        <input name="remember" type="checkbox" id="Remember"> <label for="Remember">
            {{ trans('sentence.Remember Me') }}
        </label>
      </li>
        </ul>
      </div>
      <br><br>
        <a class="text-danger" href="">
            {{ trans('sentence.Forget Password') }}
        </a>
      </ul>
          </div>  
     </div>                        
     </div>
    </div>
    </div>
    </form> 
    </div>
    </div>

@endsection
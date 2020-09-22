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
    <form method="POST" action="{{ route('loginUser') }}" 
    class="col-sm-6 col-sm-offset-3 position-relative rtl-text-right">
      @csrf
      <div class="jumbotron">
        @if (session()->has('errors') || session()->has('error'))
        <div class="alert alert-danger text-center font-weight-bold">
          {{ trans('sentence.invalid credentials') }}
      </div>
        @endif
        <h2 class="text-center h3 mb-3">
          {{ trans('sentence.Login') }}
        </h2>
      <div class="form-group">
      <label for="phone">
          {{ trans('sentence.Phone Number') }}
      </label>
      <input type="text" class="form-control" id="phone" name="phone"
       placeholder="{{ trans('sentence.Phone Number') }}">
       @if ($errors->has('password'))
      <span class="error">{{ $errors->first('phone') }}</span>
      @endif  
      </div>
    <div class="form-group mt-2">
      <label for="password"> 
          {{ trans('sentence.Password') }}
      </label>
      <input type="password" class="form-control" id="password" 
      placeholder="{{ trans('sentence.Password') }}" name="password">
      @if ($errors->has('password'))
      <span class="error">{{ $errors->first('password') }}</span>
      @endif  
    <div class="form-group">
    <div class="mt-4">
      <div class="w-100">
        <ul class="list-inline">
      <button type="submit" class="btn btn-primary active w-50">
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
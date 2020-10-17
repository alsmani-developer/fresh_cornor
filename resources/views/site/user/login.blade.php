@extends('site.layouts.app')
@section('page-title')
{{ trans('sentence.Login') }}
@endsection
@section('content')
<link rel="stylesheet" href="{{ asset('css/intlTelInput.min.css') }}">
<div class="container section position-relative">
    <div class="row">
    @isset($_GET['registered'])
    <div class="alert alert-success font-weight-bold text-center col-12">
      لقد تم تسجيل حسابك بنجاح. 
      <br>
      الرجاء تسجيل الدخول لكي تتمكن من دخول حسابك
    </div>
  @endisset
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
      <input type="tel" class="form-control" id="phone" name="phone"
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
        <ul class="list-inline w-100">
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
    <script src="{{ asset('js/intlTelInput.min.js') }}"></script>
    <script>
      $(document).ready(function() {
    var input = document.querySelector("#phone");
    var iti = intlTelInput(input, {
            // any initialisation options go here
            utilsScript: '{{ asset("js/utils.js") }}',
            initialCountry: 'SA',
            preferredCountries: ['SA', 'UAE', 'SD'],
            hiddenInput: "full",
          });
        })
    </script>
@endsection
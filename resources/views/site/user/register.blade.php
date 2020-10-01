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
    <form method="POST" action="{{ route('registerUser') }}" 
    class="col-sm-6 col-sm-offset-3 position-relative rtl-text-right" id="register_user_step_1">
    @csrf
      <div class="jumbotron">
        @if (session()->has('errors'))
        <div class="alert alert-danger text-center font-weight-bold" id="showMsg">
          {{ trans('sentence.invalid credentials') }}
      </div>
        @endif
        <h2 class="text-center h3 mb-3">
          {{ trans('sentence.Register') }}
        </h2>
        <div class="form-group">
        <label for="user">
            {{ trans('sentence.Username') }}
        </label>
        <input type="text" class="form-control" id="user" name="user"
            placeholder="{{ trans('sentence.Username') }}" required>
        </div>
      <div class="form-group">
      <label for="phone">
          {{ trans('sentence.Phone Number') }}
      </label>
      <input type="text" class="form-control" id="phone" name="phone"
       placeholder="{{ trans('sentence.Phone Number') }}" required>
      </div>
      <div class="form-group">
        <label for="email">
            {{ trans('sentence.Email') }}
        </label>
        <input type="text" class="form-control" id="email" name="email"
            placeholder="{{ trans('sentence.Email') }}">
        </div>
        {{-- <div class="form-group">
            <label for="address">
                {{ trans('sentence.Address') }}
            </label>
            <input type="text" class="form-control" id="address" name="address"
                placeholder="{{ trans('sentence.Address') }}">
            </div> --}}
    <div class="form-group mt-2">
      <label for="password"> 
          {{ trans('sentence.Password') }}
      </label>
      <input type="password" class="form-control" id="password"
       placeholder="{{ trans('sentence.Password') }}" minlength="6" name="password">
     <br /> 
    <div class="form-group">
    <div>
      <div class="w-100">
        <ul class="list-inline">
      <button type="submit" class="btn btn-primary active w-50">
          {{ trans('sentence.Register') }}
      </button>
        </ul>
      </div>
      </ul>
    </div>  
     </div>                        
     </div>
    </div>
    </div>
    </form> 
    <form method="POST" 
    class="col-sm-6 col-sm-offset-3 position-relative rtl-text-right d-none" id="register_user_step_2">
    @csrf
    <div id="showSecondMsg"></div>
      <div class="jumbotron">
        <h2 class="text-center h3 mb-3">
          {{ trans('sentence.Register') }}
        </h2>
        <h2 class="text-center h4 mb-3">
          {{ trans('sentence.validation sent') }}
        </h2>

        <div class="form-group">
        <label for="validation_numb">
          {{ trans('sentence.Enter') }}  {{ trans('sentence.validation number') }}
        </label>
        <input type="text" class="form-control" id="validation_numb" name="validation_numb"
            placeholder="{{ trans('sentence.validation number') }}" required>
        </div>
     <br /> 
    <div class="form-group">
    <div>
      <div class="w-100">
        <ul class="list-inline">
      <button type="submit" class="btn btn-primary active w-50">
          {{ trans('sentence.Register') }}
      </button>
        </ul>
      </div>
      </ul>
    </div>
    </form> 
    </div>
    </div>
<script>
  $(document).ready(function() {
    $("#phone").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl/cmd+A
            (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
             // Allow: Ctrl/cmd+C
            (e.keyCode == 67 && (e.ctrlKey === true || e.metaKey === true)) ||
             // Allow: Ctrl/cmd+X
            (e.keyCode == 88 && (e.ctrlKey === true || e.metaKey === true)) ||
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
});
</script>
<script type="text/javascript">
  $(document).ready(function() {
      $('#register_user_step_1').submit(function(e) {
          e.preventDefault();
          // setup some local variables
          var $form = $(this);

          // Let's select and cache all the fields
          var $inputs = $form.find("input, button");

          // Serialize the data in the form
          var serializedData = $form.serialize();
          $.ajax({
              type: "post",
              url: '{{url("/register")}}',
              data: serializedData,
              success: function(data)
              {
                  $('#register_user_step_1').addClass('d-none');
                  $('#register_user_step_2').removeClass('d-none');
              }
      });
      });
      

  });
</script>
<script>
  $(document).ready(function(){
      $('#register_user_step_2').submit(function(e) {
          e.preventDefault();
          validation_numb = $('#validation_numb').val();
          $.ajax({
              type: "get",
              url: '{{url("/ajax/register-new-user-last-step")}}?validation_numb='+validation_numb,
              success: function(data)
              {
                  $('#showSecondMsg').html(data);
                  if(data == 'registered'){
                      window.location.href = "{{url('/login?registered=true')}}";
                  }
              }
      });
      });
  });
</script>
@endsection
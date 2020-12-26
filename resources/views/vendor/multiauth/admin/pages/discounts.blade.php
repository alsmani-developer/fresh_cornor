@extends('multiauth::layouts.dashbord')
@section('content')

<div class="card card-outline card-info" style="margin-top:-5%;">
  
    <div class="card-header">
      
     
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
          <i class="fas fa-minus"></i>
        </button>
        <button type="button" class="btn btn-tool" data-card-widget="remove">
          <i class="fas fa-times"></i>
        </button>
      </div>
      
      <discount-component v-bind:routes = " {
          get : '{{route('discount.index')}}',
          post : '{{route('discount.store')}}',
          meats : '{{route('get_meate')}}',
          deActivate : '{{route('de_activate')}}',
          activate : '{{route('activate')}}',
          } "    
      >
      </discount-component>
      

@endsection
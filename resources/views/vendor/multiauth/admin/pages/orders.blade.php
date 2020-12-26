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
      
      <orders-component v-bind:routes = " {
          
          orders : '{{route('get_orders')}}',
          get_dirvers :'{{route('get_dirvers')}}',
          add_order :'{{route('add_order_to_driver')}}',
          edit_order :'{{route('edit_order_to_driver')}}',
          deActivate : '{{route('de_activate')}}',
          activate : '{{route('activate')}}',
          } "    
      >
      </orders-component>
      

@endsection
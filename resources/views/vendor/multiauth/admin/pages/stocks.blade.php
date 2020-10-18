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
      
      <stock-component v-bind:routes = " {
          
          stocks : '{{route('get_stock')}}',
          edit_quantity :'{{route('edit_quantity')}}',
          admin_id : '{{auth('admin')->user()->id}}'
          } "    
      >
      </stock-component>
      

@endsection
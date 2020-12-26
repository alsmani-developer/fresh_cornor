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
      
      <meate-shape v-bind:routes = " {
          get : '{{route('meat_shape.index')}}',
          post : '{{route('meat_shape.store')}}',
          } "    
      >
      </meate-shape>
      

@endsection
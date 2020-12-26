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
      
      <meat-component v-bind:routes = " {
          get : '{{route('meat.index')}}',
          post : '{{route('meat.store')}}',
          shape : '{{route('get_shape')}}',
          type : '{{route('get_type')}}',
          origin : '{{route('get_origin')}}',
          area : '{{route('get_area')}}',
          upload_image:'{{route('upload_img')}}',
          deActivate : '{{route('de_activate')}}',
          activate : '{{route('activate')}}',
          } "    
      >
      </meat-component>
      

@endsection
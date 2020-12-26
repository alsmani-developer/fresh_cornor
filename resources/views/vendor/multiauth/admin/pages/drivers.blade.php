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
      
      <drivers-component v-bind:routes = " { 
          users : '{{route('get_drivers')}}',
          add_user :'{{route('user_register')}}',
          edit_user : '{{route('user_update')}}',
          deActivate : '{{route('de_activate')}}',
          activate : '{{route('activate')}}',
          } "    
      >
      </drivers-component>
      

@endsection
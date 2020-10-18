@extends('multiauth::layouts.dashbord')
@section('content')
<div class="card card-outline card-info mr-2" style="margin-top:-5%;">
  <div class="card-header">
    <h3 class="card-title" style="Margin-left:50%"><b>شاشه عمليات المخازن</b></h3>

    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse">
        <i class="fas fa-minus"></i>
      </button>
      <button type="button" class="btn btn-tool" data-card-widget="remove">
        <i class="fas fa-times"></i>
      </button>
    </div>
  </div>
  <stock-opration v-bind:routes = " {
          
    oprations : '{{route('oprations')}}',
  
    } "    
>
</stock-opration>
  
    
@endsection
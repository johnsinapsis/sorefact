@extends('layout')

@section('content')
<section class="content-header">
<div class="container">
  <div class="row">
      @if(Auth::guest())
      <div class="col-md-4 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading"><h3 align="center">Bienvenido</h3></div> 
            <div class="panel-body" style="align">
              {!! Html::image('dist/img/logosore.png', "Logo", array('width' => '70%', 'height' => '70%', 'style' => 'margin-left:50px')) !!}
            </div>
          </div>
        </div>
        @else
        @include('partials/success')
        @include('menu/boxresol')
        @include('menu/boxconfig')
        @include('menu/boxfact')
        @include('menu/boxanu')
        @include('menu/boxrad')
        @include('menu/boximp')
        @include('menu/boxpago')
        @include('menu/boxinfo')
        @endif
      </div>
  </div>
</div>
</section>
@endsection
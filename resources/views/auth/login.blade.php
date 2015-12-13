@extends('layout')

@section('content')
<!-- resources/views/auth/login.blade.php -->
<section class="content-header">
<div class="container-fluid" >
  <div class="row">
    <div class="col-md-8 ">
      <div class="panel panel-default" >
        <div class="col-md-12 panel-title" align="center"><h4><strong>Inicio de Sesión</strong></h4></div>
        <div class="panel-body">
          @include('partials/errors')
          @include('partials/success')
          <form class="form-horizontal" role="form" method="POST" action="{{route('login')}}">
            
            {!!Form::token();!!}
            <div class="form-group">
             {!!Form::label('email', 'Email', array('class' => 'col-md-4 control-label'));!!}    
              <div class="col-md-6">
             {!!Form::email('email',old('email'),['class'=>'form-control', 'id'=>'inputEmail', 'placeholder'=>'email', 'required'=>'required'])!!}
             </div>
           </div>
            <div class="form-group">
             {!!Form::label('pass', 'Password', array('class' => 'col-md-4 control-label'));!!}  
             <div class="col-md-6">
             {!!Form::password('password',['class'=>'form-control', 'id'=>'password', 'placeholder'=>'password', 'required'=>'required'])!!}
             </div>
            </div>
            <div class="form-group">
              <div class="col-md-offset-6 ">
                <div class="checkbox">
                <label>
                 {!!Form::checkbox('remember', 'value', false);!!} Recuérdame
                </label>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-12" align="center">
               <button type="submit" class="btn btn-primary">Login</button>
               <span><a href="#" style="padding-left:10px;">Olvidó su password?</a></span>
             </div>
  </div>
</form>
        </div>
      </div>
    </div>
  </div>
</div>
</section>
@endsection
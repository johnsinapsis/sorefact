@extends('layout')

@section('content')
<div class="container">
	<div class="row" style="padding-top :10px;">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-primary">
				<div class="panel-heading">Felicidades!!! Se ha logueado con éxito</div>

				<div class="panel-body">
					Bienvenido
				</div>
				<div class="col-md-4">{{$prueba}}</div>
			</div>
		</div>
	</div>
</div>
@endsection
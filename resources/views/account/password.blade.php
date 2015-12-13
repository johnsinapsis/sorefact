@extends('layout')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="col-md-12 panel-title" align="center"><h4><strong>Cambio de Contraseña</strong></h4></div>
                    <div class="panel-body">

                        @include('partials/errors')
                        @include('partials/success')

                        <form class="form-horizontal" method="POST" action="{{ url('account/password') }}">

                            {!! csrf_field() !!}

                            <div class="form-group">
                                <label class="col-md-4 control-label">Actual Contraseña</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="current_password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Nueva Contraseña</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password">
                                </div>

                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Confirmar Contraseña</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password_confirmation">
                                </div>

                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary" style="margin-right: 15px;">
                                        Guardar
                                    </button>
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
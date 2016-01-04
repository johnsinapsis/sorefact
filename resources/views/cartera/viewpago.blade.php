@extends('layout')
@section('content')
<!-- Inicio del componente -->
          <section class="col-lg-7 connectedSortable">
            <div class="box box-success">
              @include('partials/errors')
              @include('partials/success')
              @include('partials/msg-ok')
           
              {!! Form::open(['class' => 'form-horizontal', 'role' => 'form','method' => 'POST','route' => 'pago']) !!}
        
                <div class="box-header">
                  <i class="fa fa-cogs"></i>
                  <h3 class="box-title">Cartera</h3>
                  
                </div>
                <div class="box-body chat" id="chat-box" >
                  <!-- chat item -->
                  <div class="item">
                    {!! Html::image('dist/img/logosore.png', "User image", array('class' => 'online')) !!}
                    <p class="message">
                      <span class="name">
                        Registrar Pago de Facturas
                      </span>
                      
                    </p>
                    <div class="attachment">
                      <div id="formresol">
                        
                          <input id="token" type="hidden" name="_token" value="{{ csrf_token() }}">
                           
                           <div class="form-group">
                                <label class="col-md-4 control-label">Número de Factura:</label>
                                <div class="input-group input-group-sm">                                 
                                    <input id="numfac" type="number" class="form-control input-sm" name="numfac"   value="" >
                                </div>
                                 
                            </div>


                           <div class="form-group">
                                <label class="col-md-4 control-label">Fecha:</label>
                                <div class="input-group input-group-sm">                                 
                                  <input id="fecha" type="date" class="form-control input-sm" name="fecha" min="2015-09-07" max="{{Carbon\Carbon::now()->format('Y-m-d')}}" value="{{Carbon\Carbon::now()->format('Y-m-d')}}"  >    
                                </div>
                                 
                            </div> 

                            <div class="form-group">
                                <label class="col-md-4 control-label">Concepto:</label>
                                <div class="input-group input-group-sm">  
                                   @inject('concepto','App\Http\Controllers\ConcepController')                
                                    <select name="concepto" id="concepto" class="form-control input-sm">
                                      @foreach ($concepto->show() as $concepto)
                                      @if($concepto->id==1)
                                      <option value="{{$concepto->id}}" selected>{{$concepto->nomtipo}}</option>
                                      @else
                                      <option value="{{$concepto->id}}">{{$concepto->nomtipo}}</option>
                                      @endif
                                      @endforeach
                                    </select>
                                </div>
                                 
                            </div>    

                            <div class="form-group">
                                <label class="col-md-4 control-label">Valor del pago:</label>
                                <div class="input-group input-group-sm">                                 
                                    <input id="valpago" type="number" class="form-control input-sm" name="valpago" />
                                </div>
                                 
                            </div>           
                            
                      </div>
                        
                    </div><!-- /.attachment -->
                  </div><!-- /.item -->
                  <!-- chat item -->
                </div><!-- /.chat -->
                <div class="box-footer">
                  <div class="input-group-btn" align="right">
                  <button  type="submit" class="btn btn-primary btn-flat">Guardar</button>
                </div>
              </div>
               {!! Form::close() !!}
              </div><!-- /.box (chat box) -->

          @include('cartera/listpago')

              </section>
          <!-- Fin del componente -->
          @inject('resolucion','App\Http\Controllers\ResulController')
          @include('resol/actresol')
@endsection




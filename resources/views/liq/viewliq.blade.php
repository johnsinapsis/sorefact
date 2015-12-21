@extends('layout')
@section('content')
<!-- Inicio del componente -->
          <section class="col-lg-7 connectedSortable">
            <div class="box box-success">
              @include('partials/errors')
              @include('partials/success')
              @include('partials/msg-ok')
      
              @if (isset($mensaje))
              <div align="center"><button onclick="window.location='{{route('liq')}}'" class="btn btn-primary btn-flat">Nueva Factura</button></div> 
              @else
              {!! Form::open(['class' => 'form-horizontal', 'role' => 'form']) !!}
        
                <div class="box-header">
                  <i class="fa fa-cogs"></i>
                  <h3 class="box-title">Facturación</h3>
                  
                </div>
                <div class="box-body chat" id="chat-box" >
                  <!-- chat item -->
                  <div class="item">
                    {!! Html::image('dist/img/logosore.png', "User image", array('class' => 'online')) !!}
                    <p class="message">
                      @if(isset($info))
                      <span class="name">
                        Reliquidación Factura {{$info->numfac}}
                      </span>
                      @else
                      <span class="name">
                        Liquidación de servicios
                      </span>
                      @endif
                    </p>
                    <div class="attachment">
                      <div id="formresol">
                        
                          <input id="token" type="hidden" name="_token" value="{{ csrf_token() }}">
                           
                           <div class="form-group">
                                <label class="col-md-4 control-label">Fecha:</label>
                                <div class="input-group input-group-sm">                                 
                                    <input id="fecha" type="date" class="form-control input-sm" name="fecha" min="2015-09-07" max="{{Carbon\Carbon::now()->format('Y-m-d')}}" value="{{Carbon\Carbon::now()->format('Y-m-d')}}" >
                                </div>
                                 
                            </div>


                           <div class="form-group">
                                <label class="col-md-4 control-label">Entidad:</label>
                                @if(isset($info))
                                <div class="input-group input-group-sm">                                 
                                    <input id="entidad" type="text" class="form-control input-sm" name="entidad"  style="width:230px" value="{{$info->NOM_ENT}}">
                                    <input type="hidden" id="ident" value="{{$info->COD_ENT}}">  
                                </div>
                                @else
                                <div class="input-group input-group-sm">                                 
                                    <input id="entidad" type="text" class="form-control input-sm" name="entidad"  style="width:230px" >
                                    <input type="hidden" id="ident" value="0">  
                                </div>
                                @endif 
                            </div>
                            <div class="form-group">
                              <label class="col-md-4 control-label" >Servicio:</label>
                                <div class="input-group input-group-sm">
                                  <input id="servicio" type="text" class="form-control input-sm" name="servicio" style="width:230px;" readonly>
                                  <input type="hidden" id="idserv" value="0"> 
                                  <input type="hidden" id="valuni" value="0">
                                </div>
                                
                            </div>
                             <div class="form-group">
                                <label class="col-md-4 control-label">Cantidad:</label>
                                <div class="input-group col-md-8">
                                <input id="cantidad" type="number" class="form-control input-sm" name="cantidad" style="width:60px;" readonly>
                                <button id="agrefila" type="button" style="margin-left:10px" class="btn btn-primary btn-flat btn-sm" onclick="AgregaFilaServ();" disabled>Agregar</button>
                                </div>
                            </div>
                              
                            <div class="form-group">

                              <table id="detservi" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Servicio</th>
                <th>Cant</th>
                <th>V/unit</th>
                <th>V/total</th>
                <th>oculuni</th>
                <th>ocultot</th>

            </tr>
        </thead>
 
        
 
        <tbody>
                 @if(isset($info))
                  @inject('detser','App\Http\Controllers\FactController')
                  {{--*/ $i = 1 /*--}}
                  @foreach ($detser->listser($info->numfac) as $detalle)
                   
                       <tr data-id="p{{$detalle->idserv}}">
                         <td>{{$detalle->NOM_SER}}</td>
                         <td>{{$detalle->cantserv}}</td>
                          <td>{{number_format($detalle->valserv,2)}}</td>
                          <td>{{number_format($detalle->valserv * $detalle->cantserv,2)}}</td>
                          <td>{{$detalle->valserv}}</td>
                          <td>{{$detalle->valserv * $detalle->cantserv}}</td>
                     </tr>
                    {{--*/ $i++ /*--}}
                  @endforeach
                 @endif
                  
        </tbody>
    </table>
                      <div class="input-group-btn" align="right">
                              <button id="borrafila"  type="button" class="btn btn-danger btn-flat btn-sm" onclick="BorraFilaServ();" disabled>Eliminar</button>
                              </div>
                                
                            </div>                    
                             
                      </div>
                        
                    </div><!-- /.attachment -->
                  </div><!-- /.item -->
                  <!-- chat item -->
                </div><!-- /.chat -->
                <div class="box-footer">
                  <div class="" align="right">
                  <button id="previa" type="button" class="btn btn-primary btn-flat" disabled>Previsualizar</button> 
                  <button id="modif" type="button" onclick="location.reload();" class="btn btn-primary btn-flat" style="display:none; margin-right:20px;">Modificar todo</button> 
                  <button id="liqui" type="button"  class="btn btn-primary btn-flat" style="display:none;">liquidar</button> 
                </div>
              </div>
               {!! Form::close() !!}
               @endif
              </div><!-- /.box (chat box) -->

              <!--ültimas facturas -->
              <div class="box box-primary">
                <div class="box-header">
                  <i class="ion ion-clipboard"></i>
                  <h3 class="box-title">Últimas Facturas liquidadas</h3>
                  <div class="box-tools pull-right">
                    <ul class="pagination pagination-sm inline">
                      <li><a href="#">&laquo;</a></li>
                      <li><a href="#">1</a></li>
                      <li><a href="#">2</a></li>
                      <li><a href="#">3</a></li>
                      <li><a href="#">&raquo;</a></li>
                    </ul>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <ul class="todo-list">
                     @inject('fact','App\Http\Controllers\FactController')
                     @foreach ($fact->toplist() as $fact)
                    <li>
                      <!-- drag handle -->
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      
                      <!-- todo text -->
                      <span class="text" style="font-size: 12px;">Factura: <strong>{{$fact->numfac}}</strong>. Nit: {{$fact->COD_ENT}}. {{$fact->NOM_ENT}}. Total: $ {{number_format($fact->total)}}</span>
                      <!-- Emphasis label -->
                      @if($fact->estfac)
                      <small class="label label-success"><i class="fa fa-thumbs-up"></i> Activo</small>
                      @else
                      <small class="label label-danger"><i class="fa fa-thumbs-o-down"></i> Inactivo</small>
                      @endif
                      <!-- General tools such as edit or delete-->
                      <div class="tools">
                        <a href="{{route('pdffact',['numfac'=>$fact->numfac])}}" target="_blank"><i class="fa fa-television"></i></a>
                      </div>
                    </li>
                    @endforeach      
                  </ul>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix no-border">
                </div>
              </div><!-- /.box -->

              </section>
          <!-- Fin del componente -->
          @inject('resolucion','App\Http\Controllers\ResulController')
          @include('resol/actresol')
@endsection




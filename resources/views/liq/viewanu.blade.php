@extends('layout')
@section('content')
<!-- Inicio del componente -->
          <section class="col-lg-7 connectedSortable">
            <div class="box box-success">
              @include('partials/errors')
              @include('partials/success')
              @include('partials/msg-ok')
           
              {!! Form::open(['class' => 'form-horizontal', 'role' => 'form','method' => 'POST','route' => 'anu']) !!}
        
                <div class="box-header">
                  <i class="fa fa-cogs"></i>
                  <h3 class="box-title">Facturación</h3>
                  
                </div>
                <div class="box-body chat" id="chat-box" >
                  <!-- chat item -->
                  <div class="item">
                    {!! Html::image('dist/img/logosore.png', "User image", array('class' => 'online')) !!}
                    <p class="message">
                      <a href="#" class="name">
                        Anular Facturas
                      </a>
                      
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
                                <label class="col-md-4 control-label">Motivo de Anulación:</label>
                                <div class="input-group input-group-sm">                                 
                                    @inject('anu','App\Http\Controllers\AnuController')
                                    <select name="motianu" id="motianu" class="form-control input-sm" >
                                      <option value="0">Seleccione</option>
                                      @foreach ($anu->show() as $anu)
                                      <option value="{{$anu->id}}">{{$anu->nommotivo}}</option>
                                      @endforeach
                                    </select>
                                </div>
                                 
                            </div>
                            <div class="form-group">
                              <label class="col-md-4 control-label" >Observaciones Adicionales:</label>
                                <div class="input-group input-group-sm">
                                  <textarea name="observ" id="observ" class="form-control" cols="30" rows="10"></textarea>
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
                      <small class="label label-danger"><i class="fa fa-thumbs-o-down"></i> Anulada</small>
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




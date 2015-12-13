@extends('layout')
@section('content')
<!-- Inicio del componente -->
          <section class="col-lg-7 connectedSortable">
            <div class="box box-success">
              @include('partials/errors')
              @include('partials/success')
              @include('partials/msg-ok')
        @if (isset($idedit))      
{!! Form::open(['class' => 'form-horizontal', 'role' => 'form','method' => 'POST','route' => ['upconfig',$idedit], 'files' => true]) !!}
        @else
{!! Form::open(['class' => 'form-horizontal', 'role' => 'form','method' => 'POST','route' => 'config', 'files' => true]) !!}
        @endif
                <div class="box-header">
                  <i class="fa fa-cogs"></i>
                  <h3 class="box-title">Configuración general</h3>
                  
                </div>
                <div class="box-body chat" id="chat-box" >
                  <!-- chat item -->
                  <div class="item">
                    {!! Html::image('dist/img/logosore.png', "User image", array('class' => 'online')) !!}
                    <p class="message">
                      <a href="#" class="name">
                        Configurar parámetros iniciales
                      </a>
                      
                    </p>
                    <div class="attachment">
                      <div id="formresol">
                        
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           <div class="form-group">
                                <label class="col-md-4 control-label">Nit:</label>
                                <div class="input-group col-md-8">
                                    @if (isset($idedit)) 
                                    <input id="nit" type="number" onblur="CalcularDv('nit','dv');" class="form-control input-sm" name="nitfactura" value="{{$nitedit}}" style="width:100px">
                                    @else
                                    <input id="nit" type="number" onblur="CalcularDv('nit','dv');" class="form-control input-sm" name="nitfactura" value="" style="width:100px">
                                    @endif
                                    <label class="col-md-1 control-label" style="padding-left:3px;">DV:</label>
                                    <input id="dv" type="number"  class="form-control input-sm" style="width:40px; padding-left:3px" readOnly>
                                </div>
                                 
                            </div>
                            <div class="form-group">
                              <label class="col-md-4 control-label" style="padding-right:0px; margin-left:0px; margin-right:0px; text-align:left; width: 125px;">Nombre Entidad:</label>
                                <div class="input-group col-md-9">
                                  @if (isset($idedit)) 
                                  <input type="text" class="form-control input-sm" name="nomfactura" value="{{$nomedit}}" style="width:120px;" >
                                  @else
                                  <input type="text" class="form-control input-sm" name="nomfactura" value="" style="width:120px;" >
                                  @endif
                                  <label class="col-md-4 control-label" style="padding-right:0px; margin-right:0px; text-align:left; width: 100px;">Tipo Entidad:</label>
                                  @if (isset($idedit)) 
                                  <input type="text" class="form-control input-sm" name="tipfactura" value="{{$tipedit}}" style="width:120px;" placeholder="Régimen común o simplificado" >
                                  @else
                                  <input type="text" class="form-control input-sm" name="tipfactura" value="" style="width:120px;" placeholder="Régimen común o simplificado" >
                                  @endif
                                </div>
                                
                            </div>
                             <div class="form-group">
                                <label class="col-md-4 control-label" style="padding-right:0px; margin-left:0px; margin-right:0px; text-align:left; width: 125px;">Dirección:</label>
                                <div class="input-group col-md-9">
                                  @if (isset($idedit)) 
                                  <input type="text" class="form-control input-sm" name="dirfactura" value="{{$diredit}}" style="width:120px;" >
                                  @else
                                  <input type="text" class="form-control input-sm" name="dirfactura" value="" style="width:120px;" >
                                  @endif
                                  <label class="col-md-4 control-label" style="padding-right:0px; margin-right:0px; text-align:left; width: 100px;">Teléfono:</label>
                                   @if (isset($idedit)) 
                                   <input type="text" class="form-control input-sm" name="telfactura" value="{{$teledit}}" style="width:120px;"  >
                                   @else
                                    <input type="text" class="form-control input-sm" name="telfactura" value="" style="width:120px;"  >
                                   @endif
                                </div>
                            </div>
                            <div class="form-group">
                              <label class="col-md-4 control-label" style="padding-right:0px; margin-left:0px; margin-right:0px; text-align:left; width: 125px;">Email:</label>
                                <div class="input-group col-md-9">
                                  @if (isset($idedit)) 
                                  <input type="text" class="form-control input-sm" name="maifactura" value="{{$maiedit}}" style="width:120px;" >
                                  @else
                                  <input type="text" class="form-control input-sm" name="maifactura" value="" style="width:120px;" >
                                  @endif
                                  <label class="col-md-4 control-label" style="padding-right:0px; margin-right:0px; text-align:left; width: 100px;">Página Web:</label>
                                  @if (isset($idedit)) 
                                  <input type="text" class="form-control input-sm" name="webfactura" value="{{$webedit}}" style="width:120px;" >
                                  @else
                                  <input type="text" class="form-control input-sm" name="webfactura" value="" style="width:120px;" >
                                  @endif
                                </div>
                                
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label"  style="padding-right:0px; margin-left:0px; margin-right:0px; text-align:left; width: 125px;">logo:</label>
                                <div class="input-group input-group-sm">
                                    <input type="file"  class="form-control input-sm" name="logo" value="" >
                                </div>
                            </div>
                             <div class="form-group">
                                <label class="col-md-4 control-label"  style="padding-right:0px; margin-left:0px; margin-right:0px; text-align:left; width: 125px;">Marca de Agua:</label>
                                <div class="input-group input-group-sm">
                                    <input type="file"  class="form-control input-sm" name="marcagua" value="" >
                                </div>
                            </div>

                             <div class="form-group">
                              <label class="col-md-4 control-label" style="padding-right:0px; margin-left:0px; margin-right:0px; text-align:left; width: 125px;">No. días Venc:</label>
                                <div class="input-group col-md-9">
                                  @if (isset($idedit)) 
                                  <input type="text" class="form-control input-sm" name="venfactura" value="{{$venedit}}" style="width:120px;" >
                                  @else
                                  <input type="text" class="form-control input-sm" name="venfactura" value="" style="width:120px;" >
                                  @endif
                                  <label class="col-md-4 control-label" style="padding-right:0px; margin-right:0px; text-align:left; width: 100px;">Pie de Pág:</label>
                                  @if (isset($idedit))
                                  <input type="text" class="form-control input-sm" name="piefactura" value="{{$pieedit}}" style="width:120px;" >
                                  @else
                                  <input type="text" class="form-control input-sm" name="piefactura" value="" style="width:120px;" >
                                  @endif
                                </div>
                                
                            </div>

                             <div class="form-group">
                              <label class="col-md-4 control-label">Nota:</label>
                                <div class="input-group input-group-sm">
                                  @if (isset($idedit))
                                  <textarea class="form-control" name="nota" rows="5" style="margin: 0px; width: 150px; height: 61px;">{{$notedit}}</textarea>
                                  @else
                                  <textarea class="form-control" name="nota" rows="5" style="margin: 0px; width: 150px; height: 61px;"></textarea>
                                  @endif
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
              </section>

               <section class="col-lg-5 connectedSortable">

              <!-- TO DO List -->

              <div class="box box-primary">
                <div class="box-header">
                  <i class="ion ion-clipboard"></i>
                  <h3 class="box-title">Parámetros Iniciales</h3>
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
                     @inject('config','App\Http\Controllers\ConfigController')
                     @foreach ($config->listar() as $config)
                    <li>
                      <!-- drag handle -->
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      
                      <!-- todo text -->
                      <span class="text">Nit. <strong>{{$config->nit_factura}}</strong>. Nombre: {{$config->nom_factura}}. Dirección {{$config->dir_factura}}. Tel. {{$config->tel_factura}}</span>
                      <!-- Emphasis label -->
                      <small class="label label-success"><i class="fa fa-thumbs-up"></i> Activo</small>
                      <!-- General tools such as edit or delete-->
                      <div class="tools">
                        <a href="{{route('pdfconfig',['id'=>$config->id])}}" target="_blank"><i class="fa fa-television"></i></a>
                        <a href="{{route('editconfig',['id'=>$config->id])}}"><i class="fa fa-edit"></i></a>
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
@endsection
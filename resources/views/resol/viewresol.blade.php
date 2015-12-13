@extends('layout')
@section('content')
`<!-- Inicio del componente -->
          <section class="col-lg-7 connectedSortable">
            <div class="box box-success">
              @include('partials/errors')
              @include('partials/success')
              @include('partials/msg-ok')
              @if (isset($idedit))
              <form class="form-horizontal" role="form" method="POST" action="{{route('upresol',$idedit)}}">
              @else
              <form class="form-horizontal" role="form" method="POST" action="{{route('resol')}}">
              @endif  
                <div class="box-header">
                  <i class="fa fa-file-text-o"></i>
                  <h3 class="box-title">Resoluciones</h3>
                  
                </div>
                <div class="box-body chat" id="chat-box" >
                  <!-- chat item -->
                  <div class="item">
                    {!! Html::image('dist/img/logosore.png', "User image", array('class' => 'online')) !!}
                    <p class="message">
                      <a href="#" class="name">
                        Crear Resoluciones
                      </a>
                    </p>
                    <div class="attachment">
                      <div id="formresol">
                        
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           <div class="form-group">
                                <label class="col-md-4 control-label">No. de Resolución:</label>
                                <div class="input-group input-group-sm">
                                     @if (isset($idedit))
                                    <input type="number"  class="form-control input-sm" name="numresol" value="{{$numedit}}" required />
                                     @else
                                    <!--<input type="number"  class="form-control input-sm" name="numresol" value="" required />-->
                                     {!!Form::number('numresol',old('numresol'),['class'=>'form-control input-sm', 'id'=>'numresol', 'required'=>'required'])!!}
                                     @endif
                                </div>
                            </div>
                            <div class="form-group">
                              <label class="col-md-4 control-label">Fecha Resolución:</label>
                                <div class="input-group input-group-sm">
                                  @if (isset($idedit))
                                  <input type="date" class="form-control input-sm" name="fecresol" value="{{$fecedit}}" required>
                                  @else
                                  <input type="date" class="form-control input-sm" name="fecresol" value="{{old('fecresol')}}" required>
                                  @endif
                                </div>
                            </div>
                            <div class="form-group">
                              <label class="col-md-4 control-label">Consecutivo Del</label>
                               <div class="input-group col-md-8" style="float:left">
                                  @if (isset($idedit))
                               <input type="number" class="form-control input-sm" name="iniresol" value="{{$iniedit}}" style="width:60px" readonly>
                                  @else
                                 <input type="number" class="form-control input-sm" name="iniresol" value="{{old('iniresol')}}" style="width:60px" required> 
                                  @endif
                               <label class="col-md-1 control-label" >Al</label>
                               @if (isset($idedit))
                               <input type="number"  class="form-control input-sm" name="finresol" value="{{$finedit}}"style="width:60px; height:30px;" readonly>
                               @else
                               <input type="number"  class="form-control input-sm" name="finresol" value=""style="width:60px; height:30px;" required>
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
                             <div class="form-group">
                                <label class="col-md-4 control-label">Avisar cuando falten:</label>
                                <div class="input-group input-group-sm">
                                    @if (isset($idedit))
                                    <input type="number"  class="form-control input-sm" name="stock" value="{{$stoedit}}" style="width:60px" required>
                                    @else
                                    <input type="number"  class="form-control input-sm" name="stock" value="" style="width:60px" required>
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
                </form>
              </div><!-- /.box (chat box) -->

              <!-- TO DO List -->
              <div class="box box-primary">
                <div class="box-header">
                  <i class="ion ion-clipboard"></i>
                  <h3 class="box-title">Listado Resoluciones</h3>
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
                     @inject('resolucion','App\Http\Controllers\ResulController')
                     @foreach ($resolucion->listar() as $resol)
                    <li>
                      <!-- drag handle -->
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      
                      <!-- todo text -->
                      <span class="text">Resolución No. <strong>{{$resol->num_resol}}</strong>. Fecha: {{Carbon\Carbon::createFromFormat('Y-m-d',$resol->fec_resol)->format('d/m/Y')}}. 
                        Del <strong>{{$resol->ini_consec}}</strong> al <strong>{{$resol->fin_consec}}</strong></span>
                      <!-- Emphasis label -->
                      @if($resol->estado)
                      <small class="label label-success"><i class="fa fa-thumbs-up"></i> Activo</small>
                      @else
                      <small class="label label-danger"><i class="fa fa-thumbs-o-down"></i> Inactivo</small>
                      @endif
                      <!-- tools editar-->
                      <div class="tools">
                        <a href="{{route('showresol',['id'=>$resol->id])}}"><i class="fa fa-television"></i></a>
                        <a href="{{route('editresol',['id'=>$resol->id])}}"><i class="fa fa-edit"></i></a>
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
            @include('resol/actresol')
@endsection
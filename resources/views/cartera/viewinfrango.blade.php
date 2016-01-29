@extends('layout')
@section('content')
<!-- Inicio del componente -->
          <section class="col-lg-7 connectedSortable">
            <div class="box box-success">
              @include('partials/errors')
              @include('partials/success')
              @include('partials/msg-ok')
           
              {!! Form::open(['class' => 'form-horizontal', 'role' => 'form', 'url' => 'inforango']) !!}
               <!-- {!! Form::open(['class' => 'form-horizontal', 'role' => 'form','method' => 'POST','route' => 'imp']) !!}
                        -->
        
                <div class="box-header">
                  <i class="fa fa-file-excel-o"></i>
                  <h3 class="box-title">Exportación</h3>
                  
                </div>
                <div class="box-body chat" id="chat-box" >
                  <!-- chat item -->
                  <div class="item">
                    {!! Html::image('dist/img/logosore.png', "User image", array('class' => 'online')) !!}
                    <p class="message">
                      <a href="#" class="name">
                        Consulta de Pagos
                      </a>
                      
                    </p>
                    <div class="attachment">
                      <div id="formresol">
                        
                          <input id="token" type="hidden" name="_token" value="{{ csrf_token() }}">
                          <input type="hidden" id="select" value="0">
                           
                           <div class="form-group">
                               
                                <label class="col-md-4 control-label">Desde la Factura:</label>
                                <div class="input-group col-md-8">                                 
                                    <input id="numfac" type="number" class="form-control input-sm" name="numfac"   style="width:130px" />
                                    <label class="col-md-1 control-label" style="margin-left:10px; padding-left:3px;">
                                   <!-- <input id="fact" type="checkbox" onclick="queryfact('1');" class=""  name="fact" >   -->  
                                   </label>
                                   
                                </div>
                               
                            
                                 
                            </div>


                            <div class="form-group">
                               
                                <label class="col-md-4 control-label">Hasta la Factura:</label>
                                <div class="input-group col-md-8">                                 
                                    <input id="numfac2" type="number" class="form-control input-sm" name="numfac2"   style="width:130px" />
                                    <label class="col-md-1 control-label" style="margin-left:10px; padding-left:3px;">
                                   <!-- <input id="fact" type="checkbox" onclick="queryfact('1');" class=""  name="fact" >   -->  
                                   </label>
                                   
                                </div>
                               
                            
                                 
                            </div>
         
      
                            
                      </div>
                        
                    </div><!-- /.attachment -->
                  </div><!-- /.item -->
                  <!-- chat item -->
                </div><!-- /.chat -->
                <div class="box-footer">
                  <div class="input-group-btn" align="right">
                  <!-- <button  type="submit" class="btn btn-primary btn-flat">Buscar</button> -->
                  
                  <button id="buscaFact" type="submit"  class="btn btn-primary btn-flat" >Buscar</button>
                </div>
              </div>
               {!! Form::close() !!}
              </div><!-- /.box (chat box) -->


              <!-- <div class="box-footer">
                @if(isset($listfac))
                  <table border="1">
                    <tr>
                      <th>Factura</th>
                      <th>Fecha</th>
                    </tr>
                    @foreach($listfac as $listf)
                      <tr>
                        <td>{{ $listf->numfac }}</td>
                        <td>{{ $listf->fecfac }}</td>
                      </tr>
                    @endforeach
                  </table>
                @endif
              </div> -->


              <!--ültimas facturas -->
              

              </section>
          <!-- Fin del componente -->
          @inject('cartera','App\Http\Controllers\PagoController')
          @include('cartera/actcarte')
@endsection




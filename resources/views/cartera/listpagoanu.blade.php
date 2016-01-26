<!--listado facturas -->
              <div id="list_fact" class="box box-primary">
                <div class="box-header">
                  <i class="ion ion-clipboard"></i>
                  @if(isset($listpago))
                  <h3 class="box-title">Ultimos pagos registrados</h3>
                  @endif
                  <div class="box-tools pull-right">
                    
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <ul class="todo-list">
                     @if(isset($listpago))
                     @foreach($listpago as $fact)
                       <li>
                      <!-- drag handle -->
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      
                      <!-- todo text -->
                      <span class="text" style="font-size: 12px;"> Factura: <strong>{{$fact->Factura}}</strong>. {{$fact->NOM_ENT}}. Tipo de pago: <strong>{{$fact->nomtipo}}</strong>.  Total: $ {{number_format($fact->valpago)}}</span>
                      
                      <!-- Emphasis label -->
                     @if($fact->estfac==1)
                      <small class="label label-success"><i class="fa fa-thumbs-up"></i> Facturada</small>
                      @else
                        @if($fact->estfac==2)
                        <small class="label label-info"><i class="fa fa-thumbs-o-down"></i> Radicada</small>
                        @else
                          @if($fact->estfac==3)
                          <small class="label label-warning"><i class="fa fa-thumbs-o-down"></i> Pagada</small>
                          @else
                          <small class="label label-danger"><i class="fa fa-thumbs-o-down"></i> Anulada</small>
                          @endif
                        @endif
                      @endif
                      <!-- General tools such as edit or delete-->
                      <div class="tools">
                        @if($fact->estfac!=3)
                        <a href="javascript:anupago({{$fact->id}});"><i class="fa fa-share"></i></a>
                        @endif
                        <a href="{{route('pdffact',['numfac'=>$fact->Factura])}}" target="_blank"><i class="fa fa-television"></i></a>
                      </div>
                    </li>
                     @endforeach
                     @endif
                        
                  </ul>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix no-border">
                </div>
              </div><!-- /.box -->
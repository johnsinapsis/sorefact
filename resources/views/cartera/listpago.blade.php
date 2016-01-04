<!--listado facturas -->
              <div id="list_fact" class="box box-primary">
                <div class="box-header">
                  <i class="ion ion-clipboard"></i>
                  @if(isset($listfac))
                  <h3 class="box-title">Facturas resultado de la búsqueda</h3>
                  @else
                  <h3 class="box-title">Ultimos pagos registrados</h3>
                  @endif
                  <div class="box-tools pull-right">
                    
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <ul class="todo-list">
                     @if(isset($listfac))
                     @foreach($listfac as $fact)
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
                        <a href="{{route('ref',['numfac'=>$fact->numfac])}}"><i class="fa fa-share"></i></a>
                        <a href="{{route('pdffact',['numfac'=>$fact->numfac])}}" target="_blank"><i class="fa fa-television"></i></a>
                      </div>
                    </li>
                     @endforeach
                     
                     @else
                     @inject('pago','App\Http\Controllers\PagoController')
                     @foreach ($pago->toplist() as $pago)
                    <li>
                      <!-- drag handle -->
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      
                      <!-- todo text -->
                      <span class="text" style="font-size: 12px;">Factura: <strong>{{$pago->numfac}}</strong>. Fecha Factura: {{Carbon\Carbon::createFromFormat('Y-m-d',$pago->fecfac)->format('Y/m/d')}}. Fecha Pago: {{Carbon\Carbon::createFromFormat('Y-m-d',$pago->fecpago)->format('Y/m/d')}}. {{$pago->NOM_ENT}}. Total pagado: $ {{number_format($pago->valpago)}}</span>
                      <!-- Emphasis label -->
                     @if($pago->estfac==1)
                      <small class="label label-success"><i class="fa fa-thumbs-up"></i> Facturada</small>
                      @else
                        @if($pago->estfac==2)
                        <small class="label label-info"><i class="fa fa-thumbs-o-down"></i> Radicada</small>
                        @else
                        <small class="label label-danger"><i class="fa fa-thumbs-o-down"></i> {{Anulada}}</small>
                        @endif
                      @endif
                      <!-- General tools such as edit or delete-->
                      <div class="tools">
                        @if($pago->estfac)
                        <a href="{{route('pdffact',['numfac'=>$pago->numfac])}}" target="_blank"><i class="fa fa-television"></i></a>
                        @else
                        <a href="{{route('ref',['numfac'=>$pago->numfac])}}"><i class="fa fa-share"></i></a>
                        <a href="{{route('pdffact',['numfac'=>$pago->numfac])}}" target="_blank"><i class="fa fa-television"></i></a>
                        @endif
                      </div>
                    </li>
                    @endforeach  
                    @endif    
                  </ul>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix no-border">
                </div>
              </div><!-- /.box -->
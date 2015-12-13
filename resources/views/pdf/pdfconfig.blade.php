<html lang="en">
   <head>
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Previa</title>
    {!! Html::style('dist/css/pdfFact.css') !!}
       
  </head>
 <body>
      <div class="marcagua"></div>
     <div class="clearfix">
	 
	 {!! Html::image('imagenes/'.$logotipo, "User image", array('class' => 'logo')) !!}
     	
     	<div class="numfact">
     		<h4 align="center">
     			DOCUMENTO EQUIVALENTE <br>
     			<strong>FACTURA DE VENTA</strong>
     		</h4>
     	</div>
     	<div class="divnum">
     		@if (isset($numfac))
            <h3 style="margin-top:6px;" align="center">Nº&#32;&#32;&#32;{{$numfac}}</h3>
            @else
            <h3 style="margin-top:6px;" align="center">Nº&#32;&#32;&#32;XXXX</h3>
            @endif
     	</div>
     	<div class="cabfact">
     		<table class="fecha">
     			<tr><td colspan="3" class="titfec" align="center"><strong>FECHA DE EXPEDICION</strong></td></tr>
     			<tr>
     				@if (isset($fec_exp))
                    <td WIDTH="25">{{Carbon\Carbon::createFromFormat('d-m-Y',$fec_exp)->format('d')}}</td>
     				<td WIDTH="25">{{Carbon\Carbon::createFromFormat('d-m-Y',$fec_exp)->format('m')}}</td>
     				<td WIDTH="35" >{{Carbon\Carbon::createFromFormat('d-m-Y',$fec_exp)->format('Y')}}</td>
                    @else
                    <td WIDTH="25">DD</td>
                    <td WIDTH="25">MM</td>
                    <td WIDTH="35" >AA</td>
                    @endif
     			</tr>
     		</table>
     		<table class="fecven">
     			<tr><td colspan="3" class="titfec" align="center"><strong>FECHA DE VENCIMIENTO</strong></td></tr>
     			<tr>
     				@if (isset($fec_ven))
                    <td WIDTH="25">{{Carbon\Carbon::createFromFormat('d-m-Y',$fec_ven)->format('d')}}</td>
                    <td WIDTH="25">{{Carbon\Carbon::createFromFormat('d-m-Y',$fec_ven)->format('m')}}</td>
                    <td WIDTH="35" >{{Carbon\Carbon::createFromFormat('d-m-Y',$fec_ven)->format('Y')}}</td>
                    @else
                    <td WIDTH="25">DD</td>
                    <td WIDTH="25">MM</td>
                    <td WIDTH="35" >AA</td>
                    @endif
     			</tr>
     		</table>
     		<div class="resol">
     			AUTORIZA RESOL. DIAN <br>
     			@inject('resolucion','App\Http\Controllers\ResulController')
     			IBAGUÉ No. {{$resolucion->resActiva()->num_resol}} <br>
     			FECHA: {{Carbon\Carbon::createFromFormat('Y-m-d',$resolucion->resActiva()->fec_resol)->format('Y/m/d')}}
     			DEL No. {{$resolucion->resActiva()->ini_consec}} AL No. {{$resolucion->resActiva()->fin_consec}} <br>
     			NOTA: LA PRESENTE RESOLUCIÓN NOS EXONERA REALIZAR EL COBRO DE I.V.A.
     		</div>
     		
     		<div class="cliente">Cliente:</div>
     		@if (isset($nom_ent))
            <div class="nomcli">{{$nom_ent}}</div>
            @else
            <div class="nomcli"></div>
            @endif
     		<div class="nit">Nit:</div>
            @if (isset($nit_ent))
            <div class="nomnit">{{$nit_ent."-".$dv}}</div>
            @else
     		<div class="nomnit"></div>
            @endif
     		<div class="dir">Dirección:</div>
     		@if (isset($dir_ent))
            <div class="nomdir">{{$dir_ent}}</div>
            @else
            <div class="nomdir"></div>
            @endif
     		<div class="tel">Tel.:</div>
            @if (isset($tel_ent))
            <div class="nomtel">{{$tel_ent}}</div>
            @else
            <div class="nomtel"></div>
            @endif
            <div class="pag">Forma de Pago:</div>
            <div class="nompag"></div>
     	</div>
        <div class="detfact">
            <table class="detalle">
                <tr>
                   <td width="50" align="center" class="titdet"><strong>CANTIDAD</strong></td> 
                   <td width="250" align="center" class="titdet"><strong>DESCRIPCIÓN DEL SERVICIO</strong></td> 
                   <td width="90" align="center" class="titdet"><strong>V/R. UNITARIO</strong></td> 
                   <td width="90" align="center" class="titdet"><strong>VALOR TOTAL</strong></td>
                </tr>
                <tr>
                    <td style="height:560px;"></td> <td ></td> <td></td> <td></td>
                </tr>
            </table>
            <table class="detaserv" border="0";>
                {{--*/ $tot = 0 /*--}}
                @if (isset($tel_ent))
                @inject('detser','App\Http\Controllers\FactController')
                
                    @if(isset($numfac))
                    @foreach ($detser->listser($numfac) as $detalle)
                     <tr>
                         <td align="right" width="49">{{$detalle->cantserv}}</td>
                          <td align="left" width="230">{{$detalle->NOM_SER}}</td>
                          <td align="right" width="85">{{number_format($detalle->valserv)}}</td>
                            <td align="right" width="85">{{number_format($detalle->valserv * $detalle->cantserv)}}</td>
                     </tr>
                {{--*/ $tot = $tot + ($detalle->valserv * $detalle->cantserv) /*--}}
                     @endforeach
                     @else
                        @foreach ($detser->listtmp() as $detalle)
                <tr>
                    <td align="right" width="49">{{$detalle->cantserv}}</td>
                    <td align="left" width="230">{{$detalle->NOM_SER}}</td>
                    <td align="right" width="85">{{number_format($detalle->valserv)}}</td>
                    <td align="right" width="85">{{number_format($detalle->valserv * $detalle->cantserv)}}</td>
                </tr>
                {{--*/ $tot = $tot + ($detalle->valserv * $detalle->cantserv) /*--}}
                        @endforeach
                @endif
                @endif
            </table>
        </div>
        <div class="tittot" style="page-break-after: avoid;"><h3 align="center"><strong>TOTAL</strong></h3></div>
        <div class="valtot">
            <table>
                <tr>
                    <td><h3>$</h3></td>
                    <td><div class="divtot"><span class="valtotal">{{number_format($tot)}}</span></div></td>
                </tr>
            </table>
        </div>
     
     </div>
     <div class="notafact">NOTA: {{$nota_factura}}</div>
     <div class="nomrad">
         <table width="350">
             <tr>
                 <td class="titnom">Nombre:</td>
                 <td width="310"><div class="divnomrad"></div></td>
             </tr>
         </table>
     </div>
     <div class="fecrad">
         <table width="350">
             <tr>
                 <td width="57"class="titnom">Fecha recibido:</td>
                 <td width="350"><div class="divfecrad"></div></td>
             </tr>
         </table>
     </div>
     <div class="apprad">
         <table width="350">
             <tr>
                 <td width="30"class="titnom">Aceptado:</td>
                 <td width="300"><div class="divapprad"></div></td>
             </tr>
         </table>
     </div>
     <div class="sello">SALUD OCUPACIONAL REGIONAL S.A.S.</div>
    <footer>        
     <strong>ESTA FACTURA DE VENTA SE ASIMILA EN SUS EFECTOS LEGALES A LA LETRA DE CAMBIO, SEGÚN ARTÍCULOS 772 A
     774 DEL CÓDIGO DE COMERCIO.</strong> <br>
     Así lo indica el inciso 3 del artículo 772 del código de comercio, modificado con el artículo 1 de la ley 1231, donde se lee: El emisor vendedor o prestador del servicio emitirá un original y dos copias de la factura. Para todos los efectos legales derivados del carácter de título valor de la factura, el original firmado por el emisor y obligado, será título valor negociable por endoso por el emisor y lo deberá conservar el emisor, vendedor o prestador del servicio. Una de las copias se le entregará al obligado y la otra quedará en poder del emisor, para sus registros contables.

    </footer>
 </body>

</html>
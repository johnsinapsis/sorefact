<?php

namespace App\Http\Controllers;

use DB;
use Auth;

use App\FacturaCab;
use App\FacturaDet;
use App\Pago;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $factura = FacturaCab::select('fecfac')
                             ->where('numfac',$request->get('numfac'))
                             ->first();
        if($factura)
        $fecha = $factura->fecfac;
        else
        $fecha = Carbon::now()->format('Y-m-d');
        $date = Carbon::createFromFormat('Y-m-d',$fecha);
        $date = $date->subDay();
        $detalle = FacturaDet::select(DB::raw('sum(cantserv*valserv) as total'))
                             ->where('numfac',$request->get('numfac'))
                             ->first();
        if($detalle){
        $total=$detalle->total+0;
        $pagos = Pago::select(DB::raw('sum(valpago) as total'))
                       ->where('numfac',$request->get('numfac'))
                       ->first();
        if($pagos)
        $total = $total - $pagos->total;
        }
        else
        $total=0;
        //dd($total);
        $mensaje = [
            'fecha.after' => 'La fecha debe ser superior o igual a la fecha de la factura (:date)',
            'numfac.exists' => 'El numero de factura no se encuentra en estado Radicado',
            'valpago.max' => 'El valor pagado no puede superar el valor de la factura'
        ];
        $v = \Validator::make($request->all(),[
            'numfac' => 'required|numeric|exists:factura_cab,numfac,estfac,2',
            'fecha' => 'required|date|after:'.$date,
            'valpago' => 'required|numeric|max:'.$total
            ],$mensaje);
         if ($v->fails())
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }
        else{
            $pago = new Pago([
                    'fecpago' => $request->get('fecha'),
                    'numfac' => $request->get('numfac'),
                    'valpago' => $request->get('valpago'),
                    'tipopago' => $request->get('concepto'),
                    'user' => Auth::user()->id,
                ]);
            $pago->save();
            if($request->get('valpago')==$total)
            {
                FacturaCab::where('numfac',$request->get('numfac'))
                    ->update(['estfac' => '3']);
            }
            return View('cartera.viewpago')->with('mensaje','Pago Registrado Satisfactoriamente');
        }
    }


     /**
     * Muestra las 5 ultimas facturas liquidadas
     *
     * @param  int  $id
     * @return Response
     */
    public function toplist()
    {
       $listfac = Pago::join('factura_cab', 'factura_cab.numfac', '=', 'pagos.numfac')
                           ->join('entidades','entidades.COD_ENT','=','factura_cab.cod_ent')
                           ->select('factura_cab.numfac as numfac','fecfac', 'fecpago','NOM_ENT','valpago','estfac')
                           ->orderBy('numfac', 'desc')
                           ->take(5)
                           ->get();

        return $listfac; 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($numfac)
    {
        $detalle = FacturaDet::select(DB::raw('sum(cantserv*valserv) as total'))
                             ->where('numfac',$numfac)
                             ->first();
        $total=$detalle->total+0;
        $pagos = Pago::select(DB::raw('sum(valpago) as total'))
                       ->where('numfac',$request->get('numfac'))
                       ->first();
        if($pagos)
            $pagado = $pagos->total;
        else
            $pagado=0;
        $total = $total - $pagado;
        return $total;
    }

     
     public function queryedad(Request $request){
        $raw="";
        $edad = $request->get('edad');
        switch ($edad) {
            case '1':
                $raw = "and DATEDIFF(NOW(),fecrad) <= 60";
                break;

                case '2':
                $raw = "and DATEDIFF(NOW(),fecrad) > 60 and DATEDIFF(NOW(),fecrad) <= 90";
                break;

                case '3':
                $raw = "and DATEDIFF(NOW(),fecrad) > 90 and DATEDIFF(NOW(),fecrad) <= 120";
                break;

                case '4':
                $raw = "and DATEDIFF(NOW(),fecrad) > 120";
                break;
            
            
        }
        $ident = $request->get('ident');
        if ($ident != 0)
        $raw.= " and factura_cab.cod_ent = '".$ident."'";
        
        $listedad = DB::select("select a.*, IFNULL(b.Pagado,0) as Pagado, Facturado-IFNULL(b.Pagado,0) as Saldo  from
(select factura_cab.cod_ent as cod_ent, NOM_ENT as nom_ent, sum(cantserv*valserv) as Facturado 
from factura_cab 
inner join entidades on factura_cab.cod_ent = entidades.COD_ENT
inner join factura_det on factura_det.numfac = factura_cab.numfac
where estfac = 2 ".$raw."
group by factura_cab.cod_ent, NOM_ENT) as a
left join 
(select factura_cab.cod_ent as cod_ent, NOM_ENT as nom_ent, sum(valpago) as Pagado
from factura_cab 
inner join entidades on factura_cab.cod_ent = entidades.COD_ENT
inner join pagos on factura_cab.numfac = pagos.numfac
where estfac = 2
group by factura_cab.cod_ent, NOM_ENT) as b on a.cod_ent = b.cod_ent order by 2");
        
        //dd($listedad);
        $numreg = count($listedad); 
        $numreg ++;
        $rango = "A1:E".$numreg;
        //$listedad = array($listedad);
        //dd($listedad);
        $data = array();
       foreach ($listedad as $result) {
      $data[] = (array)$result;  

   #or first convert it and then change its properties using 
   #an array syntax, it's up to you
}
//dd($data);

        Excel::create('Cartera por edades', function($excel) use ($data,$rango) {
 
            $excel->sheet('Cartera', function($sheet) use ($data,$rango) {
 
                //$products = Product::all();
 
                $sheet->fromArray($data);

                // Set black background
                $sheet->row(1, function($row) {

                 // call cell manipulation methods
                        $row->setBackground('#45A9E3');

                });

                // Set border for range
                $sheet->setBorder($rango, 'thin');

                $sheet->setAutoFilter();
 
            });
        })->export('xls');
     }
     /**
     * Display the specified resource.
     *
     * @param  Request 
     * @return Response
     */
    public function querypago(Request $request)
    {
        $factura = $request->get('numfac');
        $fecini = $request->get('fecini');
        $fecfin = $request->get('fecfin');
        $ident = $request->get('ident');
        $raw = "";
        if(($fecini!="")&&($fecfin!=""))
            $fecha = 2;
        if(($fecini!="")&&($fecfin==""))
            $fecha = 1;
        if(($fecini=="")&&($fecfin==""))
            $fecha = 0;
        if($factura!="")
            $raw = "factura_cab.numfac = ".$factura;
        if($ident!=0){
            if($raw != "")
                $raw.=" and ";
            $raw.=" factura_cab.cod_ent = ".$ident;
        }

        if(($fecha==2)&&($raw!="")){
            $listpago = Pago::join('factura_cab', 'factura_cab.numfac', '=', 'pagos.numfac')
                           ->join('entidades','entidades.COD_ENT','=','factura_cab.cod_ent')
                           ->join('tipo_pago','pagos.tipopago','=','tipo_pago.id')
                           ->select('factura_cab.numfac as Factura','fecfac', 'fecpago','NOM_ENT','nomtipo','valpago','estfac')
                           ->whereBetween('fecpago',[$fecini,$fecfin])
                           ->whereRaw($raw)
                           ->orderBy('factura_cab.numfac', 'desc')
                           ->get();
        }
        if(($fecha==2)&&($raw=="")){
            $listpago = Pago::join('factura_cab', 'factura_cab.numfac', '=', 'pagos.numfac')
                           ->join('entidades','entidades.COD_ENT','=','factura_cab.cod_ent')
                           ->join('tipo_pago','pagos.tipopago','=','tipo_pago.id')
                           ->select('factura_cab.numfac as Factura','fecfac as Fecha_Factura', 'fecpago as Fecha_Pago','NOM_ENT as Entidad','nomtipo as Tipo de Pago','valpago as Valor','estfac')
                           ->whereBetween('fecpago',[$fecini,$fecfin])
                           ->orderBy('factura_cab.numfac', 'desc')
                           ->get();
        }
        if(($fecha==1)&&($raw!="")){
            $listpago = Pago::join('factura_cab', 'factura_cab.numfac', '=', 'pagos.numfac')
                           ->join('entidades','entidades.COD_ENT','=','factura_cab.cod_ent')
                           ->join('tipo_pago','pagos.tipopago','=','tipo_pago.id')
                           ->select('factura_cab.numfac as Factura','fecfac', 'fecpago','NOM_ENT','nomtipo','valpago','estfac')
                           ->where('fecpago',$fecini)
                           ->whereRaw($raw)
                           ->orderBy('factura_cab.numfac', 'desc')
                           ->get();
        }
        if(($fecha==1)&&($raw=="")){
            $listpago = Pago::join('factura_cab', 'factura_cab.numfac', '=', 'pagos.numfac')
                           ->join('entidades','entidades.COD_ENT','=','factura_cab.cod_ent')
                           ->join('tipo_pago','pagos.tipopago','=','tipo_pago.id')
                           ->select('factura_cab.numfac as Factura','fecfac', 'fecpago','NOM_ENT','nomtipo','valpago','estfac')
                           ->where('fecpago',$fecini)
                           ->orderBy('factura_cab.numfac', 'desc')
                           ->get();
        }
        if(($fecha==0)&&($raw!="")){
            $listpago = Pago::join('factura_cab', 'factura_cab.numfac', '=', 'pagos.numfac')
                           ->join('entidades','entidades.COD_ENT','=','factura_cab.cod_ent')
                           ->join('tipo_pago','pagos.tipopago','=','tipo_pago.id')
                           ->select('factura_cab.numfac as Factura','fecfac as Fecha_Factura', 'fecpago','NOM_ENT','nomtipo','valpago','estfac')
                           ->whereRaw($raw)
                           ->orderBy('factura_cab.numfac', 'desc')
                           ->get();
        }
         
         //dd($listpago);
         if(($fecha==0)&&($raw=="")){
            return redirect()->back()->withInput()->withErrors('No realizó ningun filtro');
         }

        else{

        $numreg = count($listpago); 
        $numreg ++;
        $rango = "A1:G".$numreg;

        Excel::create('Informe Pagos', function($excel) use ($listpago,$rango) {
 
            $excel->sheet('Pagos', function($sheet) use ($listpago,$rango) {
 
                //$products = Product::all();
 
                $sheet->fromArray($listpago);

                // Set black background
                $sheet->row(1, function($row) {

                 // call cell manipulation methods
                        $row->setBackground('#45A9E3');

                });

                // Set border for range
                $sheet->setBorder($rango, 'thin');

                $sheet->setAutoFilter();
 
            });
        })->export('xls');
     }

    }

    public function listpagoanu(Request $request)
    {
        $factura = $request->get('numfac');
        $fecini = $request->get('fecini');
        $fecfin = $request->get('fecfin');
        $ident = $request->get('ident');
        $raw = "";
        if(($fecini!="")&&($fecfin!=""))
            $fecha = 2;
        if(($fecini!="")&&($fecfin==""))
            $fecha = 1;
        if(($fecini=="")&&($fecfin==""))
            $fecha = 0;
        if($factura!="")
            $raw = "factura_cab.numfac = ".$factura;
        if($ident!=0){
            if($raw != "")
                $raw.=" and ";
            $raw.=" factura_cab.cod_ent = ".$ident;
        }

        if(($fecha==2)&&($raw!="")){
            $listpago = Pago::join('factura_cab', 'factura_cab.numfac', '=', 'pagos.numfac')
                           ->join('entidades','entidades.COD_ENT','=','factura_cab.cod_ent')
                           ->join('tipo_pago','pagos.tipopago','=','tipo_pago.id')
                           ->select('pagos.id','factura_cab.numfac as Factura','fecfac', 'fecpago','NOM_ENT','nomtipo','valpago','estfac')
                           ->whereBetween('fecpago',[$fecini,$fecfin])
                           ->whereRaw($raw)
                           ->orderBy('factura_cab.numfac', 'desc')
                           ->get();
        }
        if(($fecha==2)&&($raw=="")){
            $listpago = Pago::join('factura_cab', 'factura_cab.numfac', '=', 'pagos.numfac')
                           ->join('entidades','entidades.COD_ENT','=','factura_cab.cod_ent')
                           ->join('tipo_pago','pagos.tipopago','=','tipo_pago.id')
                           ->select('pagos.id','factura_cab.numfac as Factura','fecfac as Fecha_Factura', 'fecpago as Fecha_Pago','NOM_ENT as Entidad','nomtipo as Tipo de Pago','valpago as Valor','estfac')
                           ->whereBetween('fecpago',[$fecini,$fecfin])
                           ->orderBy('factura_cab.numfac', 'desc')
                           ->get();
        }
        if(($fecha==1)&&($raw!="")){
            $listpago = Pago::join('factura_cab', 'factura_cab.numfac', '=', 'pagos.numfac')
                           ->join('entidades','entidades.COD_ENT','=','factura_cab.cod_ent')
                           ->join('tipo_pago','pagos.tipopago','=','tipo_pago.id')
                           ->select('pagos.id','factura_cab.numfac as Factura','fecfac', 'fecpago','NOM_ENT','nomtipo','valpago','estfac')
                           ->where('fecpago',$fecini)
                           ->whereRaw($raw)
                           ->orderBy('factura_cab.numfac', 'desc')
                           ->get();
        }
        if(($fecha==1)&&($raw=="")){
            $listpago = Pago::join('factura_cab', 'factura_cab.numfac', '=', 'pagos.numfac')
                           ->join('entidades','entidades.COD_ENT','=','factura_cab.cod_ent')
                           ->join('tipo_pago','pagos.tipopago','=','tipo_pago.id')
                           ->select('pagos.id','factura_cab.numfac as Factura','fecfac', 'fecpago','NOM_ENT','nomtipo','valpago','estfac')
                           ->where('fecpago',$fecini)
                           ->orderBy('factura_cab.numfac', 'desc')
                           ->get();
        }
        if(($fecha==0)&&($raw!="")){
            $listpago = Pago::join('factura_cab', 'factura_cab.numfac', '=', 'pagos.numfac')
                           ->join('entidades','entidades.COD_ENT','=','factura_cab.cod_ent')
                           ->join('tipo_pago','pagos.tipopago','=','tipo_pago.id')
                           ->select('pagos.id','factura_cab.numfac as Factura','fecfac as Fecha_Factura', 'fecpago','NOM_ENT','nomtipo','valpago','estfac')
                           ->whereRaw($raw)
                           ->orderBy('factura_cab.numfac', 'desc')
                           ->get();
        }
         
        //dd($fecha);
         if(($fecha==0)&&($raw=="")){
            return redirect()->back()->withInput()->withErrors('No realizó ningun filtro');
         }
         else{
            //return $listpago;
             return view('cartera.viewanupago', compact('listpago'));
         }
    }


     /**
     * Muestra el total de la cartera
     *
     * @param  int  $id
     * @return Response
     */
    public function totcarte()
    {
        $detalle = FacturaDet::join('factura_cab', 'factura_cab.numfac', '=', 'factura_det.numfac')
                             ->select(DB::raw('sum(cantserv*valserv) as total'))
                             ->where('factura_cab.estfac','<>','0')
                             ->where('factura_cab.estfac','<>','1')
                             ->first();
        $total=$detalle->total+0;
        $pagos = Pago::select(DB::raw('sum(valpago) as total'))
                       ->first();
        if($pagos)
            $pagado = $pagos->total;
        else
            $pagado=0;
        $total = $total - $pagado;
        return $total;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function delete($id)
    {
        Pago::where('id',$id)->delete();
        return View('cartera.viewanupago')->with('mensaje','Pago eliminado Satisfactoriamente');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}

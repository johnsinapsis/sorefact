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


     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function totcarte()
    {
        $detalle = FacturaDet::join('factura_cab', 'factura_cab.numfac', '=', 'factura_det.numfac')
                             ->select(DB::raw('sum(cantserv*valserv) as total'))
                             ->where('factura_cab.estfac','<>','0')
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
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

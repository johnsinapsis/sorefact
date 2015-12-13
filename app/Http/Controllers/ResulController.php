<?php

namespace App\Http\Controllers;

use App\Resolucion;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Carbon\Carbon;
//use vendor\nesbot\Carbon\Carbon;

class ResulController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View('resol.viewresol');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {     
        $valini=$request->get('iniresol')+1;
         $v = \Validator::make($request->all(), [
             'numresol' => 'required|numeric',
             'fecresol' => 'required|date',
             'iniresol' => 'required|numeric',
             'finresol' => 'required|numeric|min:'.$valini,
             'stock' => 'required|numeric'
             
            ]);
          if ($v->fails())
        {
             //$request->flash();
            return redirect()->back()->withInput()->withErrors($v->errors());
        }
        else
         {

            Resolucion::where('estado', true)
                    ->update(['estado' => false]);
            $resol = new Resolucion([
                'num_resol' => $request->get('numresol'),
                'fec_resol' => $request->get('fecresol'),
                'ini_consec' => $request->get('iniresol'),
                'fin_consec' => $request->get('finresol'),
                'nota_resol' => $request->get('nota'),
                'stock_consec' => $request->get('stock'),

                ]);

            $resol->act_consec = $valini-1;
            $resol->estado = true;
            $resol->save();
            return View('resol.viewresol')->with('mensaje','Resolución Registrada Satisfactoriamente');
         }
         
        //$cresolucion = Client::all();
        //return \View::make('list', compact('clients')); //esto se reemplaza por una ruta a un controller por post
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
       
      
       $ressel = Resolucion:: where('id',$id)
                            ->first();
                            //->get();

        
        //dd($ressel->num_resol);
        return View('resol.viewresol',[
        'idsel'=> $id,
        'numressel' => $ressel->num_resol,
        'fecsel' => $ressel->fec_resol,
        'inisel' => $ressel->ini_consec,
        'finsel' => $ressel->fin_consec,
        'actsel' => $ressel->act_consec
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
         $resedit = Resolucion:: where('id',$id)
                            ->first();
                            //->get();

        
        //dd($resedit->num_resol);
        return View('resol.viewresol',[
        'idedit'=> $id,
        'numedit' => $resedit->num_resol,
        'fecedit' => $resedit->fec_resol,
        'iniedit' => $resedit->ini_consec,
        'finedit' => $resedit->fin_consec,
        'actedit' => $resedit->act_consec,
        'notedit' => $resedit->nota_resol,
        'stoedit' => $resedit->stock_consec
        ]);
    }


    /**
     * listar todos los registros de resoluciones descendente.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function listar()
    {
         $resol = Resolucion:: 
                               orderBy('id', 'desc')
                             ->get();
        
        //dd($resol);
        return $resol; 


    }


     /**
     * listar la Resolución que esté activa.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function resActiva()
    {
         $resol = Resolucion:: where('estado',true)
                               ->first();
                             
        
        return $resol; 


    }


    /**
     * Inactiva todos los demmás registros ya que 
     * solo una resolución puede estar activa
     *
     * @param  Request  $request
     * @param  int  $id
     */
    

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
         $v = \Validator::make($request->all(), [
             'numresol' => 'required|numeric',
             'fecresol' => 'required|date',
             'stock' => 'required|numeric'
             
            ]);
          if ($v->fails())
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }
        else
        {

        Resolucion::where('id', $id)
                    ->update([
                        'num_resol' => $request->get('numresol'),
                        'fec_resol' => $request->get('fecresol'),
                        'nota_resol' => $request->get('nota'),
                        'stock_consec' => $request->get('stock')
                        ]);
        return View('resol.viewresol')->with('mensaje','Resolución Actualizada Satisfactoriamente');
        }
        
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
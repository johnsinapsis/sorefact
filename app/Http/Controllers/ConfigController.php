<?php

namespace App\Http\Controllers;

use App\Configuracion;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ConfigController extends Controller
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
         return View('config.viewconfig');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        
         $v = \Validator::make($request->all(), [
             'nitfactura' => 'required|numeric',
             'nomfactura' => 'required',
             'tipfactura' => 'required',
             'dirfactura' => 'required',
             'telfactura' => 'required',
             'maifactura' => 'email',
             'logo' => 'required|image',
             'marcagua' => 'image',
             'venfactura' => 'required|numeric'
           
            ]);
          if ($v->fails())
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }
        else
         {
         	Configuracion::where('estado', true)
                       ->update(['estado' => false]);
            $config = new Configuracion([
            		'nit_factura' => $request->get('nitfactura'),
					'nom_factura' => $request->get('nomfactura'),
					'tip_factura' => $request->get('tipfactura'),
					'dir_factura' => $request->get('dirfactura'),
					'tel_factura' => $request->get('telfactura'),
					'mailfactura' => $request->get('maifactura'),
					'web_factura' => $request->get('webfactura'),
					'logotipo' => $request->file('logo')->getClientOriginalName(),
					'marcagua' => $request->file('marcagua')->getClientOriginalName(),
					'dias_venc' => $request->get('venfactura'),
					'pie_pagina' => $request->get('piefactura'),
					'nota_factura' => $request->get('nota'),
            	]);
            $config->estado = true;
            $config->save();
            \Storage::disk('local')->put($request->file('logo')->getClientOriginalName(),\File::get($request->file('logo')));
            \Storage::disk('local')->put($request->file('marcagua')->getClientOriginalName(),\File::get($request->file('marcagua')));
            return View('config.viewconfig')->with('mensaje','Configuración Registrada Satisfactoriamente');
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
       $config = Configuracion:: where('id',$id)
                            ->first();
       //dd($config->logotipo);
       $view = View('pdf.pdfconfig',[
        'id'=> $id,
        'nom_factura' => $config->nom_factura,
        'logotipo' => $config->logotipo,
        'nit_factura' => $config->nit_factura,
        'tip_factura' => $config->tip_factura,
        'dir_factura' => $config->dir_factura,
        'tel_factura' => $config->tel_factura,
        'mailfactura' => $config->mailfactura,
        'web_factura' => $config->web_factura,
        'nota_factura'=> $config->nota_factura
        ]);
       //return $view;
       
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($view);
      return $pdf->stream('previa.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $conedit = Configuracion:: where('id',$id)
                            ->first();
                            return View('config.viewconfig',[
        'idedit'=> $id,
        'nitedit' => $conedit->nit_factura,
        'nomedit' => $conedit->nom_factura,
        'tipedit' => $conedit->tip_factura,
        'diredit' => $conedit->dir_factura,
        'teledit' => $conedit->tel_factura,
        'maiedit' => $conedit->mai_factura,
        'webedit' => $conedit->web_factura,
        'venedit' => $conedit->dias_venc,
        'pieedit' => $conedit->pie_pagina,
        'notedit' => $conedit->nota_factura
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
         $conf = Configuracion:: 
                               orderBy('id', 'desc')
                             ->get();
        
        return $conf; 


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
       $v = \Validator::make($request->all(), [
             'nitfactura' => 'required|numeric',
             'nomfactura' => 'required',
             'tipfactura' => 'required',
             'dirfactura' => 'required',
             'telfactura' => 'required',
             'maifactura' => 'email',
             'logo' => 'required|image',
             'marcagua' => 'image',
             'venfactura' => 'required|numeric'
           
            ]);
          if ($v->fails())
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }
        else
         {
           Configuracion::where('id', $id)
                    ->update([
                    'nit_factura' => $request->get('nitfactura'),
                    'nom_factura' => $request->get('nomfactura'),
                    'tip_factura' => $request->get('tipfactura'),
                    'dir_factura' => $request->get('dirfactura'),
                    'tel_factura' => $request->get('telfactura'),
                    'mailfactura' => $request->get('maifactura'),
                    'web_factura' => $request->get('webfactura'),
                    'logotipo' => $request->file('logo')->getClientOriginalName(),
                    'marcagua' => $request->file('marcagua')->getClientOriginalName(),
                    'dias_venc' => $request->get('venfactura'),
                    'pie_pagina' => $request->get('piefactura'),
                    'nota_factura' => $request->get('nota')
                        ]); 
            \Storage::disk('local')->put($request->file('logo')->getClientOriginalName(),\File::get($request->file('logo')));
            \Storage::disk('local')->put($request->file('marcagua')->getClientOriginalName(),\File::get($request->file('marcagua')));
            return View('config.viewconfig')->with('mensaje','Configuración Actualizada Satisfactoriamente');
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

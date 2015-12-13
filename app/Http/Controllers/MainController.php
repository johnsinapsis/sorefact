<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    
 /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function menu()
    {
       
        $pepe = "una prueba";
        return View('home')->with('prueba',$pepe);   
    	
    }
}

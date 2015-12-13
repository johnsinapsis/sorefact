<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
       public function _construct(){
        $this->middleware('auth');
        //$this->middleware('guest',['except' => 'getLogout']);
       }
       
        public function index()
    {
        $pepe = "una prueba";
        return View('home')->with('prueba',$pepe);   
    }
}

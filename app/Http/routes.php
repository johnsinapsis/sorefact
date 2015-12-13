<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Route::get('/', function () {
    return view('home');
});*/

//Route::get('home', ['as' => 'home', 'uses' => 'HomeController@index']);


/************Validaciones y funciones que estan pendientes para tener en cuenta******

-------1) Falta validar que no se puede facturar más cuando se llegue al último consecutivo
-------2) cuando falten los números de consecutivos que se configuraron debe avisar con un mensaje
----------este mensaje puede ser un warning que se puede enviar en un cuadro cuando se hace el llamado
----------a la liquidación
-------3) Falta realizar pruebas cuando el número de servicios supera la hoja de la factura
-------4) Cambiar el correo por un login normal
-------5) Logotipo al iniciar sesión
-------6) Si la factura está anulada, al imprimirla en pdf debe existir una marca de agua que diga anulada
-------7) Activar el menú de la izquierda para que tengan el menú a la mano de los item autorizados
-------8) Construir la caja de administración de permisos
-------9) Cambiar los íconos de los formularios


*/


Route::get('/',[
	'uses' => 'MainController@menu',
	'as' => 'main'
	 
	]); 


Route::group(['middleware' => ['auth','role:1']], function () {

	Route::get('resol',[
		'uses' => 'ResulController@create',
		'as' => 'resol'
	 
	]); 

	Route::post('resol',[
		'uses' => 'ResulController@store',
		'as' => 'resol'
	 
	]);           

	Route::get('resol/{id}',[
		'uses' => 'ResulController@show',
		'as' => 'showresol'
	]);   

	Route::get('resoledit/{id}',[
		'uses' => 'ResulController@edit',
		'as' => 'editresol'
	]);   

	Route::post('resoledit/{id}',[
		'uses' => 'ResulController@update',
		'as' => 'upresol'
	]);   

});

Route::group(['middleware' => ['auth','role:2']], function () {

	Route::get('liq',[
		'uses' => 'FactController@index',
		'as' => 'liq'
	 
	]); 

	Route::post('liq',[
		'uses' => 'FactController@index',
		'as' => 'liq'
	 
	]); 

	
	//Route::get('liq/autocomplete', 'EntityController@query');
	 
	 Route::any('liq/autocomplete', function(){  
	 	// $term = "med";
	 	$term = Input::get('term');
	 	$data = DB::table('entidades')->select('COD_ENT','NOM_ENT')->where('NOM_ENT','LIKE',$term.'%')->get();
	 	//$result[0] = array('value' => 'Medicadiz', 'id' => '2');
	 	foreach ($data as $v) {
	 		$result[] =  array('value' => $v->NOM_ENT, 'id' => $v->COD_ENT);
	 	}
	 	return Response::json($result);
	 });


	 Route::any('liq/autocomplete2/', function(){  
	 	// $term = "med";
	 	$term = Input::get('term');
	 	$ident = Input::get('ident');
	 	$data = DB::table('servicios')
	 			 ->join('tarifas', 'servicios.COD_SER', '=', 'tarifas.COD_SER')
	 	         ->select('servicios.COD_SER','NOM_SER','VAL_SER')
	 	         ->where('NOM_SER','LIKE',$term.'%')
	 	         ->where('COD_ENT', '=', $ident)->get();
	 	//$result[0] = array('value' => 'consulta salud', 'id' => $ident);
	 	foreach ($data as $v) {
	 		$result[] =  array('value' => $v->NOM_SER, 'id' => $v->COD_SER, 'precio' => $v->VAL_SER);
	 	}
	 	return Response::json($result);
	 });

	 Route::any('liq/prev','FactController@preview');

	 Route::get('pdfprev/{id}/{fecha}', [
		'uses' => 'FactController@show',
		'as' => 'pdfprev'
		]);

	 Route::any('liq/fact','FactController@store');

	 Route::any('liq/{numfac}',function($numfac){
	 	return View('liq.viewliq')->with('mensaje','Factura '.$numfac.' liquidada Satisfactoriamente');
	 });

	 Route::get('pdffact/{numfac}', [
		'uses' => 'FactController@pdfshow',
		'as' => 'pdffact'
		]);


});

Route::group(['middleware' => ['auth','role:3']], function () {

	Route::get('anu', function(){
		return View('liq.viewanu');
	}); 

	Route::post('anu',[
		'uses' => 'FactController@validanu',
		'as' => 'anu'
	 
	]); 


	});

Route::group(['middleware' => ['auth','role:4']], function () {

	Route::get('imp', function(){
		return View('liq.viewimp');
	});


	Route::post('imp',[
		'uses' => 'FactController@queryFact',
		'as' => 'imp'
	 
	]); 

	Route::any('imp/query','FactController@queryFact');
	
	Route::get('imp/pag',function(){
		return View('liq.listfact');
	});

	});


Route::group(['middleware' => ['auth','role:5']], function () {

	Route::get('rad', function(){
		return View('liq.viewrad');
	}); 

	Route::post('rad',[
		'uses' => 'FactController@validrad',
		'as' => 'rad'
	 
	]); 


	});


Route::group(['middleware' => ['auth','role:8']], function () {

	Route::get('config',[
		'uses' => 'ConfigController@create',
		'as' => 'config'
	 
	]); 

	Route::post('config',[
		'uses' => 'ConfigController@store',
		'as' => 'config'
	 
	]); 

	Route::get('configedit/{id}',[
		'uses' => 'ConfigController@edit',
		'as' => 'editconfig'
	]);   

	Route::post('configedit/{id}',[
		'uses' => 'ConfigController@update',
		'as' => 'upconfig'
	]);   

	Route::get('pdfconfig/{id}', [
		'uses' => 'ConfigController@show',
		'as' => 'pdfconfig'
		]);

	});

Route::group(['middleware' => ['auth','role:9']], function () {
		// Registration routes...
	Route::get('register', [
	'uses' => 'Auth\AuthController@getRegister',
	'as' => 'register'
	]);

		Route::post('register', [
	 'uses' => 'Auth\AuthController@postRegister',
	 'as' => 'register'
	]);
});


/*Route::controllers ([
		'ver' => 'ResulController@show',
	]);*/

/*Route::get('/',function()
{
 $user = DB::table('users')->where('name','sinapsis')->first();
 return $user->email;
});*/

// Authentication routes...
Route::get('login', [
	'uses' => 'Auth\AuthController@getLogin',
	'as'   => 'login'
	]);
Route::post('login', 'Auth\AuthController@postLogin');


Route::get('logout', [
    'uses' => 'Auth\AuthController@getLogout',
    'as'   => 'logout'
]);



// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

//Route::get('main', 'MainController@index');

Route::group(['middleware' => 'auth'], function () {

    Route::get('account', function () {
        return view('account');
    });

    Route::get('account/password', 'AccountController@getPassword');
    Route::post('account/password', 'AccountController@postPassword');

    Route::get('account/edit-profile', 'AccountController@editProfile');
    Route::put('account/edit-profile', 'AccountController@updateProfile');

    Route::group(['middleware' => 'verified'], function () {

        Route::get('publish', function () {
            return view('publish');
        });
        Route::post('publish', function () {
            return Request::all();
        });

    });

    Route::group(['middleware' => 'role:admin'], function () {

        Route::get('admin/settings', function () {
            return view('admin/settings');
        });

    });

    Route::group(['middleware' => 'role:editor'], function () {

        Route::get('admin/posts', function () {
            return view('admin/posts');
        });

    });

});

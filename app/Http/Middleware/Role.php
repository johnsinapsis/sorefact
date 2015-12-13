<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\MenuController;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$funcion)
    {
        $user = auth()->user();
        $menu = new MenuController();
        $count = $menu->box($funcion,$user->role);
        if($count==0)
            abort(404,'No tiene autorización para usar esta función');
        return $next($request);
    }
}

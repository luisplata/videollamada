<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class UsuarioLogeado
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $empresa = Session::get("empresa");
        $root = Session::get("root");
        //if(is_object($empresa) || is_object($root)){
            return $next($request);
        //}
        //return redirect("/logout");
    }
}

<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Route::get("root", function () {
    return "Inicio";
});

Route::get("logout", function() {
    Session::flush();
    return redirect("/?mensaje=Gracias Por Contar Con nosotros");
});

Route::get("/", function() {
    if (is_object(Session::get("empresa"))) {
        return redirect("empresa/dashboard");
    }
    return view("index");
});

Route::post("login", "LoginController@autenticacion");

Route::post("empresa/registro", "EmpresaController@registro");


Route::get("videollamada", "SalaController@participante");


Route::group(['middleware' => ['usuarioLogeado']], function () {
    Route::prefix('empresa')->group(function () {
        Route::get("dashboard", "EmpresaController@dashboard");
        Route::get("obtener/token", "EmpresaController@obtenerToken");

        Route::get("sala/registro", "SalaController@registro");
       
    });
    Route::prefix('root')->group(function () {
        Route::get("dashboard", "RootController@dashboard");
    });

    
});


  


//Route::middleware([''])->group(function () {
    
//});

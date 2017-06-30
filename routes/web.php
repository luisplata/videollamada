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

Route::get("logout",function(){
   Session::flush();
   return redirect("/"); 
});

Route::get("/", function() {
    return view("login");
});

Route::get("/login_root", function() {
    return view("login_root");
});

Route::post("login", "LoginController@autenticacion");
Route::post("login_root", "LoginController@autenticacion_root");

Route::group(['middleware' => ['usuarioLogeado']], function () {
    Route::prefix('empresa')->group(function () {
       Route::get("dashboard","EmpresaController@dashboard");
    });
    Route::prefix('root')->group(function () {
       Route::get("dashboard","RootController@dashboard");
    });
});

//Route::middleware([''])->group(function () {
    
//});

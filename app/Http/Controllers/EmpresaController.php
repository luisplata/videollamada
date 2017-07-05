<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class EmpresaController extends Controller {

    //
    public function dashboard() {
        return view("empresa.dashboard");
    }

    public function registro(Request $request) {
        try {
            $empresa = new \App\Empresa();
            $empresa->nombre = $request->nombre;
            $empresa->email = $request->email;
            $empresa->telefono = $request->telefono;
            $empresa->pass = Hash::make($request->pass);
            $empresa->token = Hash::make(date("YYYY-MM-dd HH:ii:ss"));
            if ($empresa->save()) {
                return redirect("/");
            } else {
                return redirect("/?mensaje=No se guardo la empresa, porfavor revisa los datos");
            }
        } catch (\PDOException $e) {
            return redirect("/?mensaje=No se guardo, " . $e->getMessage());
        }
    }

    public function obtenerToken() {
        $empresa = \App\Empresa::find(Session::get("empresa")->id);
        $empresa->token = Hash::make(date("YYYY-MM-dd HH:ii:ss"));
        if ($empresa->save()) {
            Session::put('empresa', $empresa);
            return redirect("empresa/dashboard?titulo=Nuevo Token Creado&mensaje=El nuevo token ha sido creado, por favor actualize en sus aplicativos el nuevo token");
        } else {
            return redirect("empresa/?mensaje=No se guardo el nuevo token");
        }
    }

}
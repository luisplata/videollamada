<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Root;
use App\Empresa;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller {

    //
    public function autenticacion(Request $request) {
        $empresa = Empresa::where("email", $request->user)->first();
        if (!is_object($empresa)) {
            return redirect("/?mensaje=El usuario no existe");
        }
        if (!Hash::check($request->pass, $empresa->pass)) {
            //es porque no es cierto
            return redirect("/?mensaje=La contraseña no es valida");
        }
        Session::put('empresa', $empresa);
        return redirect("empresa/dashboard?mensaje=Bienvenido ".$empresa->nombre);
    }

    public function autenticacion_root(Request $request) {
        $root = Root::where("user", $request->user)->first();
        if (!is_object($root)) {
            return redirect("/?mensaje=El usuario no existe");
        }
        if (Hash::check($request->pass, $root->pass)) {
            //es porque es cierto
            Session::put('root', $root);
            return redirect("root/dashboard");
        }
        return redirect("/login_root?mensaje=La contraseña no es correcta");
    }

}

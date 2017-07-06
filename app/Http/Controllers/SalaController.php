<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Sala;

class SalaController extends Controller {

    public function registro(Request $request) {
        try {
            $empresa = \App\Empresa::getByToken($request->token);
            if (!is_object($empresa)) {
                return redirect("empresa/dashboard?titulo=Error&mensaje=El token no es valido&tipo=error");
            }
            $sala = new \App\Sala();
            $sala->nombre_sala = uniqid();
            $sala->fecha_hora_inicio = date("Y-m-d H:i:s");
            //$sala->fecha_hora_final = $request->fecha.' '.$request->hora_fin;
            $sala->empresas_id = $empresa->id;
            //$sala->estado = 'abierto';
            if ($sala->save()) {
                Session::put('sala', 'https://' . $_SERVER['SERVER_NAME'] . '/videollamada?sala=' . $sala->nombre_sala . '&nombre=NOMBRE_USUARIO');
                return redirect('empresa/dashboard?titulo=Nueva Sala Creada&mensaje=La nueva sala ha sido creado.');
            } else {
                return redirect("/?mensaje=No se guardo la sala, porfavor revisa los datos");
            }
        } catch (\PDOException $e) {
            return redirect("empresa/dashboard?mensaje=No se guardo, " . $e->getMessage());
        }
    }

    public function participante(Request $request) {
        $nombre_sala = $request->sala;
        try {

            $sala = Sala::BuscarPorNombre($nombre_sala);
            if ($sala == FALSE) {
                
            } else {
                //Validar si existe un participante activo con ese nombre y en la misma sala
                /* if(Participante::BuscarPorNombreYSala($request->nombre, $sala->id)){

                  }else{ */
                $participante = new \App\Participante();
                $participante->nombre = $request->nombre;
                $participante->estado = 'activo';
                $participante->salas_id = $sala->id;

                if ($participante->save()) {

                    $datos = array(
                        "nombre_sala" => $nombre_sala,
                        "token_empresa" => $request->token,
                        "nombre" => $request->nombre
                    );
                    return view("videollamada.videollamada", $datos);
                } else {
                    
                }
                //}
            }
        } catch (\PDOException $e) {
            //return redirect("/?mensaje=No se guardo, " . $e->getMessage());
        }
    }

    public function obtenerUrl(Request $request) {
        try {
            //llega el token
            //return response()->json($_SERVER['SERVER_NAME']);
            $empresa = \App\Empresa::getByToken($request->token);
            if (!is_object($empresa)) {
                return response()->json("Token no válido", 403);
            }
            $sala = new \App\Sala();
            $sala->nombre_sala = uniqid();
            $sala->fecha_hora_inicio = date("Y-m-d H:i:s");
            $sala->empresas_id = $empresa->id;
            if ($sala->save()) {
                return response()->json(array("url"=>'https://' . $_SERVER['SERVER_NAME'] . '/videollamada?sala=' . $sala->nombre_sala . '&nombre=NOMBRE_USUARIO'));
            } else {
                return response()->json("No se creo la sala, vuelva a intentarlo",502);
            }
        } catch (\PDOException $e) {
            //return response()->json("/?mensaje=No se guardo, " . $e->getPrevious());
            return response()->json($e->getPrevious(),501);
        }
    }

}

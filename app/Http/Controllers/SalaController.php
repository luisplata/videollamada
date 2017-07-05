<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SalaController extends Controller
{
   




	public function registro(Request $request) {
        try {

        	//print_r($request);

            $sala = new \App\Sala();
            $sala->nombre_sala = uniqid();
            $sala->fecha_hora_inicio = $request->fecha.' '.$request->hora_inicio;
            $sala->fecha_hora_final = $request->fecha.' '.$request->hora_fin;
            $sala->empresas_id = $request->empresa_id;
            $sala->estado = 'abierto';
            if ($sala->save()) {
            	Session::put('sala', 'https://'.$_SERVER['SERVER_NAME'].'/videollamada'.'/'.$sala->nombre_sala.'/'.$request->empresa_token);
                 return redirect('empresa/dashboard?titulo=Nueva Sala Creada&mensaje=La nueva sala ha sido creado.' );
            } else {
                return redirect("/?mensaje=No se guardo la sala, porfavor revisa los datos");
            }
        } catch (\PDOException $e) {
            return redirect("/?mensaje=No se guardo, " . $e->getMessage());
        }
    }

    public function participante($nombre_sala, $empresa_token){

    	try {
    		print_r($empresa_token);
    	} catch (Exception $e) {
    		
    	}
    }





}

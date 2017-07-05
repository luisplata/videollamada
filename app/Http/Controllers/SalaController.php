<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Sala;
use App\Participante;

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
            	Session::put('sala', 'https://'.$_SERVER['SERVER_NAME'].'/videollamada'.'/'.$sala->nombre_sala.'?token='.$request->empresa_token);
                 return redirect('empresa/dashboard?titulo=Nueva Sala Creada&mensaje=La nueva sala ha sido creado.' );
            } else {
                return redirect("/?mensaje=No se guardo la sala, porfavor revisa los datos");
            }
        } catch (\PDOException $e) {
            return redirect("/?mensaje=No se guardo, " . $e->getMessage());
        }
    }

    public function participante(Request $request){
    	$nombre_sala = $request->nombre;
    	try {

    		$sala = Sala::BuscarPorNombre($nombre_sala);
    		if($sala==FALSE){

    		}else{
    			//Validar si existe un participante activo con ese nombre y en la misma sala
    			/*if(Participante::BuscarPorNombreYSala($request->nombre, $sala->id)){

    			}else{*/
    				$participante = new \App\Participante();
		        	$participante->nombre = $request->nombre;
		        	$participante->estado = 'activo';
		        	$participante->salas_id = $sala->id;
		           
		            if ($participante->save()) {
		            	
		            	$datos = array(
		                	"nombre_sala"=>$nombre_sala,
		                	"token_empresa"=>$request->token,
		                	"nombre"=>$request->nombre
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





}

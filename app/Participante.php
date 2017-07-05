<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participante extends Model
{
    public static function BuscarPorNombreYSala($nombre, $sala_id){
	   	$participante = Participante::where([
	   		"nombre"=>$nombre,
	   		"salas_id"=>$sala_id
	   		])->first();
	   	if(is_object($participante)){
	   		//existe
	   		return $participante;
	   	}else{
	   		return FALSE;
	   	}
   	}
}

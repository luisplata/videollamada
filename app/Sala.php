<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    public static function BuscarPorNombre($nombre){
	   	$sala = Sala::where(["nombre_sala"=>$nombre])->first();
	   	if(is_object($sala)){
	   		//existe
	   		return $sala;
	   	}else{
	   		return FALSE;
	   	}
   	}
}

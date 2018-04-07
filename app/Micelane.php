<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Log;
use Illuminate\Support\Facades\Session;

class Micelane extends Model {

    
    public static function getError($error) {
        Log::error($error->getMessage());
        //Vamos a manejar los errores dependiendo del tipo
        Session::flash('tipo', "error");
        if ($error instanceof \PDOException) {
            Session::flash('mensaje', $error->errorInfo[2]);
        } else if ($error instanceof \ErrorException) {
            Session::flash('mensaje', $error->getMessage());
        } else if($error instanceof \QueryException){
             Session::flash('mensaje', $error->getMessage());
        } else {
            Session::flash('mensaje', $error->getMessage());
        }
        Miselanea::logInterno(null, $error);
        if (env('APP_DEBUG')) {
            dd($error);
        }
        
    }

    public static function logInterno($accion = null, $mensaje, $nombre) {
        try {
            $solicitud;
            $log = new \App\Log();
            if ($accion == null) {
                $accion = "|Method:" . \Illuminate\Support\Facades\Request::method();
                
                if ($mensaje instanceof \PDOException) {
                    $mensaje = $mensaje->errorInfo[2];
                }else if ($mensaje instanceof \Exception) {
                    $accion .= "|File:" . $mensaje->getFile();
                    $accion .= "|Line:" . $mensaje->getLine();
                    $mensaje = $mensaje->getMessage();
                } else {
                    $accion .= "|Menssage:" . $mensaje;
                }
                $accion .= "|IP:" . \Illuminate\Support\Facades\Request::ip();
                $accion .= "|Url:" . \Illuminate\Support\Facades\Request::url();
                //$accion .= "|Route:" . \Illuminate\Support\Facades\Request::route();
            }

            
            $log->accion = $accion;
            $log->mensaje = $mensaje;
            $log->usuario = $nombre;
            
            $log->save();
        } catch (\Exception $ex) {
            \App\Miselanea::getError($ex);
            //dd($ex);
        }
    }

    public static function logAcciones() {
        try {

            $log = new \App\Log();

            $accion = "|Method:" . \Illuminate\Support\Facades\Request::method();
            
            $accion .= "|IP:" . \Illuminate\Support\Facades\Request::ip();
            $accion .= "|Url:" . \Illuminate\Support\Facades\Request::url();
            
            $log->accion = $accion;
            $log->mensaje = "Log de actividad";
            $log->usuario = "Sistema";
            
            $log->save();
            //dd($mensaje);
            //dd($log);
        } catch (\Exception $ex) {
            \App\Miselanea::getError($ex);
            //dd($ex);
        }
    }

    

}

<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/**
 * @apiDefine db
 * @apiError 501 Usualmente para cuando es error de Base de datos, de duplicado, 
 * requerido, violacion de llave foranea.
 */
/**
 * @api {Method} /api/plantilla/ Plantilla para la documentación
 * @apiGroup Plantilla
 * @apiDescription Aquí se explica que hace el recurso
 * con varias lineas
 * @apiVersion 0.1.0
 * 
 * @apiExample Ejemplo de Uso:
 * https://api.telemedicina.hus.org.co:4433/api/plantilla/{Tipo:parametro_get}
 * 
 * @apiParam {string} Parametro Parametro (POST|PUT|DELECT) en la petición.
 * 
 * @apiSuccess {Tipo} nombre descripcion
 * 
 * @apiSuccessExample Ejemplo de Éxito:
 *      HTTP/1.1 200 OK
 *      {
 *          "mensaje":"Esto es el ejemplo de todo OK"
 *      }
 * 
 * @apiSampleRequest EjemploSoloParaBusquedas
 * 
 * @apiError Codigo1 Descripcion <code>4xx</code> y una corta explicación.
 * @apiError Codigo2 Descripcion <code>4xx</code> y una explicación.
 * 
 * @apiUse db
 */

/**
 * @api {POST} /api/obtener/url Consulta de url para la videollamada
 * @apiGroup Videollamada
 * @apiDescription Para acceder desde otra aplicación debe consultar la url
 * en esta dirección, para asi entrar desde cualquier sitio con esa URL.
 * @apiVersion 0.1.0
 * 
 * @apiExample Ejemplo de Uso:
 * https://telemedicina.hus.org.co:4433/api/obtener/url
 * 
 * @apiParam {string} token Token de la empresa que se creo al registrarse.
 * 
 * @apiSuccess {string} URL Url completa de la sala de la videollamada
 * 
 * @apiSuccessExample Ejemplo de Éxito:
 *      HTTP/1.1 200 OK
 *      {
 *          "url":"https://videollamada.telemedicina.hus.org.co:4433/videollamada?sala=SalaVideollamada&nombre="
 *      }
 * 
 * @apiSampleRequest https://telemedicina.hus.org.co:4433/api/obtener/url
 * 
 * @apiError 403 Token no valido.
 * @apiError 502 No se creo la sala, volver a intentarlo
 * 
 * @apiUse db
 */
Route::post("obtener/url","SalaController@obtenerUrl");
/**
 * @api {POST} /api/empresa/registrar Recurso para registrar una empresa desde afuera
 * @apiGroup Registro y Control
 * @apiDescription Cuando un sistema externo desea registrar sus usuarios internamente.
 * Puede hacerlo mediante este recurso
 * @apiVersion 0.1.0
 * 
 * @apiExample Ejemplo de Uso:
 * https://telemedicina.hus.org.co:4433/api/empresa/registro
 * 
 * @apiParam {string} nombre **maxlength:190** | **Required**
 * @apiParam {string} email **maxlength:190** | **Required** | **Unique**
 * @apiParam {string} telefono **maxlength:190**
 * @apiParam {string} pass **maxlength:190** | **Required** __Pasword de la plataforma__
 * 
 * 
 * @apiSuccess {String} token Token del registro nuevo
 * 
 * @apiSuccessExample Ejemplo de Éxito:
 *      HTTP/1.1 200 OK
 *      {
 *          token:"$gd7689768&8ihji&hnoonofe"
 *      }
 * 
 * @apiSampleRequest https://telemedicina.hus.org.co:4433/api/empresa/registro
 * 
 * @apiError 513 No se pudo Guardar la información
 * @apiError 514 Error de validación.
 * 
 * @apiUse db
 */
Route::post("empresa/registro", "EmpresaController@registro_api");
/**
 * @api {POST} /api/videollamada_log Recurso para consultar el log desde afuera
 * @apiGroup Logs
 * @apiDescription Cuando un sistema externo desea consultar los logs internos.
 * Puede hacerlo mediante este recurso
 * @apiVersion 0.1.0
 * 
 * @apiExample Ejemplo de Uso:
 * https://videollamada.nabu.com.co/api/videollamada_log
 * 
 * @apiParam {string} token Token de la empresa que se creo al registrarse.
 * 
 * 
 * @apiSuccess {string} URL Url logs del sistema de videollamada
 * 
 * @apiSuccessExample Ejemplo de Éxito:
 *      HTTP/1.1 200 OK
 *      [
*		    {
*		        "id": 1,
*		        "created_at": "2018-04-06 22:46:58",
*		        "updated_at": "2018-04-06 22:46:58",
*		        "mensaje": "Desconectado",
*		        "accion": "|Method:GET|Menssage:Desconectado|IP:127.0.0.1|Url:http://localhost:8000/capturar_log",
*
*				
*		        "usuario": "Sistema"
*		    }
 *  	]
 * 
 *  
 *
 * @apiUse db
 */
Route::post("consultar_log_videollamada", "SalaController@consultar_log_videollamada");
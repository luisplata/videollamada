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
 * https://quehaypahacer.nabu.com.co/api/plantilla/{Tipo:parametro_get}
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
 * https://videollamada.nabu.com.co/api/obtener/url
 * 
 * @apiParam {string} token Token de la empresa que se creo al registrarse.
 * 
 * @apiSuccess {string} URL Url completa de la sala de la videollamada
 * 
 * @apiSuccessExample Ejemplo de Éxito:
 *      HTTP/1.1 200 OK
 *      {
 *          "url":"https://videollamada.nabu.com.co/videollamada?sala=SalaVideollamada&nombre="
 *      }
 * 
 * @apiSampleRequest https://videollamada.nabu.com.co/api/obtener/url
 * 
 * @apiError 403 Token no valido.
 * @apiError 502 No se creo la sala, volver a intentarlo
 * 
 * @apiUse db
 */
Route::post("obtener/url","SalaController@obtenerUrl");
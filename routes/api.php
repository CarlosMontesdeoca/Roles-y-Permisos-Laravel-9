<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


/**
 * Las rutas publicas necesarias para el sistemas son las de registro y logeo de usuario ya que no necesitan un token de acceso.
*/

//_____________________________ RUTAS DE REGISTROS _______________________________________________________//
Route::post('register', 'App\Http\Controllers\UserController@register');  ## ==> Registro de nuevo usuario
Route::post('login', 'App\Http\Controllers\UserController@authenticate'); ## ==> Ingreso de Usuario, obtiene una llave temporal.


/** LISTADO DE RUTAS PROTEGIDAS, NECESITAN DE LA LLAVE TEMPORAL PARA SU USO JWT */
Route::group(['middleware' => ['jwt.verify']], function() {

    /// ---------------------METROLOGOS..............................//
    Route::get('users', 'App\Http\Controllers\UserController@index');               ## ==> Listado de Usuarios Habilitados del sistema  
    Route::get('user', 'App\Http\Controllers\UserController@getAuthenticatedUser'); ## ==> Informacion del Usuario Logueado
    Route::put('users/{user}', 'App\Http\Controllers\UserController@update');       ## ==> Informacion del Usuario Logueado
    Route::get('permissions', 'App\Http\Controllers\UserController@permissions');       ## ==> Editar un usuario existente
    Route::post('permissions/{user}', 'App\Http\Controllers\UserController@chage');       ## ==> Editar un usuario existente

    // Route::group(['middleware' => ['role:admin|alter']], function () {
    Route::get('metrologists/avl', 'App\Http\Controllers\MetrologistController@avilMtr');          ## ==> Listado de Metrologos y sus Proyectos Pendientes
    Route::get('metrologists', 'App\Http\Controllers\MetrologistController@index');                ## ==> Listado de Metrologos habilitados
    Route::post('metrologists', 'App\Http\Controllers\MetrologistController@store');               ## ==> REGISTRO de nuevo metrologo 
    Route::put('metrologists/{metrologist}', 'App\Http\Controllers\MetrologistController@update'); ## ==> EDITAR un metrologo axistente
    // });
    
    /// --------------------------------CLIENTES--------------------------------//
    Route::get('clients', 'App\Http\Controllers\ClientController@index');                ## ==> LISTA de Clientes Habilitados
    Route::get('clients/filter-{word}', 'App\Http\Controllers\ClientController@search'); ## ==> LISTA de Clientes Filtrados por un string
    Route::post('clients', 'App\Http\Controllers\ClientController@store');               ## ==> CREA un  nuevo Cliente
    Route::put('clients/{client}', 'App\Http\Controllers\ClientController@update');      ## ==> EDITA un Cliente existente
    /// -----------------|||||-SUCURSALES DEL CLIENTE-||||||------------------------//
    Route::get('clients/{client}/plants', 'App\Http\Controllers\PlantController@index'); ## ==> LISTA de sucursales de un Cliente
    Route::post('plants', 'App\Http\Controllers\PlantController@store');                 ## ==> CREA una nueva sucursal en un cliente
    Route::put('plants/{plant}', 'App\Http\Controllers\PlantController@update');         ## ==> EDITA una sucursal existente
    ///------------------|||||-CONTACTOS DEL CLENTE-|||||---------------------------//
    Route::get('plants/{plant}/contacts', 'App\Http\Controllers\ContactController@index');## ==> LISTA de Contactos de una sucursal
    Route::post('contacts', 'App\Http\Controllers\ContactController@store');              ## ==> CREA un nuevo contacto en una sucursal
    // Route::put('contacts/{contact}', 'App\Http\Controllers\ContactController@update'); ## ==> EDITA un contacto existente
    ///------------------|||||-BALANZAS DEL CLENTE-|||||---------------------------//
    Route::get('plants/{plant}/balances', 'App\Http\Controllers\BalanceController@index');## ==> LISTA de Balanzas de una sucursal
    Route::post('balances', 'App\Http\Controllers\BalanceController@store');              ## ==> CREA una Balanza en una sucursal
    Route::put('balances/{balance}', 'App\Http\Controllers\BalanceController@update');    ## ==> EDITA la informacion de la Balanza

    Route::post('balances/{balance}/sell/plant/{plant}', 'App\Http\Controllers\BalanceController@sell');## ==> CREA un clon de la balanza y desabilita la original, 
    Route::put('suplement/{suplement}', 'App\Http\Controllers\SuplementController@update');             ## ==> EDITA la informacion de la Balanza con los registros de la Tablet
});


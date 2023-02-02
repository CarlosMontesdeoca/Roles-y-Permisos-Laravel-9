<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\Plant;
use Illuminate\Http\Request;
use App\Http\Resources\BalanceResource;

class BalanceController extends Controller
{
    /**
     * la funcion index de ItemController busca una instancia de Plant y atravez de las funcion plants,
     * definida dentro de el modelo Plant filtra todas las sucursales relacionadas al sucursal y que esten con un 
     * estado activo.
     */
    public function index(Plant $plant){
        return response()->json(BalanceResource::collection($plant->balances->where('est', 'A')), 200);
    }

    /** 
     * Store es una funcion que toma el contenido dentro del cuerpo de la peticion y crea el registro del modelo correspondiente.
     */
    public function store(Request $request){
        $balance = Balance::create($request->all());
        // $balance = array_merge([$request->all()], ['div_d'=>$request->div_e], ['rang'=>$request->maxCap]);
        
        return response()->json($balance, 201);
    }

    /**
     * Update es una funcion que toma el contenido dentro del cuerpo de la peticion y una instancia del Modelo,
     * si la instancia existe cambia los valores correspondientes segun el contenido recibido.
     */
    public function update(Request $request, Balance $balance){
        $balance->update($request->all());
        return response()->json($balance, 201);
    }

    /** esta funcion es especifica para el cliente espinoza paes ya que nos ayuda a generar un inventario de a que clientes vende sus balanzas
     * con el fin de darle un seguimiento. 
     * duplica el registro con un estado V y modifica el original para enviarlo a }l nuevo cliente
     */
    public function sell(Balance $balance,Plant $plant ){
        $request = [
            'tip' => $balance->tip,
            'descBl' => $balance->descBl,
            'marc' => $balance->marc,
            'modl' => $balance->modl,
            'ser' => $balance->ser,
            'cls' => $balance->cls,
            'maxCap' => $balance->maxCap,
            'usCap' => $balance->usCap,
            'div_e' => $balance->div_e,
            'div_d' => $balance->div_d,
            'uni' => $balance->uni,
            'tolr' => $balance->tolr,
            'rang' => $balance->rang,
            'plant_id' => $balance->plant_id,
            'est' => 'V',
            'cli' => $plant->client->nom 
        ];
        $aux = Balance::create($request);
        $balance->update(array_merge(['plant_id' => $plant->id]));
        return response()->json($plant,200);
    }
}

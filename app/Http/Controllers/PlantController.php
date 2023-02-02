<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Client;
use App\Models\Plant;
use App\Http\Resources\PlantResource;

class PlantController extends Controller
{
    /**
     * @index lista de sucursales activas de un cliente
     */
    public function index(Client $client){
        return response()->json(PlantResource::collection($client->plants->where('est', 'A')), 200);
    }

    /** 
     * @store CREA una nueva sucursal */
    public function store(Request $request){
        $plant = Plant::create($request->all());
        return response()->json($plant, 201);
    }

    /**
     * @update EDITA la informacion de la sucursal si es que existe
     */
    public function update(Request $request, Plant $plant){
        $plant->update($request->all());
        return response()->json($plant, 200);
    }
}
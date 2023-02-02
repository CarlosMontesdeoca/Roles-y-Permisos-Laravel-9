<?php

namespace App\Http\Controllers;

use App\Models\Metrologist;
use App\Models\Certificate;
use Illuminate\Http\Request;

use App\Http\Resources\MetrologistProjectResource;

class MetrologistController extends Controller
{
    /**
     * @avilMtr LISTA de metrologos con sus proyectos pendientes
     */
    public function avilMtr(){
        $data = MetrologistProjectResource::collection(Metrologist::where('est','A')->get());
        return response()->json($data, 200);
    }
    
    /**
     * @index LISTA de metrologos habilitados
     */
    public function index(){
        $data = Metrologist::where('est', 'A')->get();
        return response()->json($data, 200);
    }

    /**
     * @store CREA un nuevo metrologo
     */
    public function store(Request $request){
        $metrologist = Metrologist::create($request->all());
        return response()->json($metrologist, 201);
    }

    /**
     * @update Edita la informacion de un metrologo existente
     */
    public function update(Request $request, Metrologist $metrologist){
        $metrologist->update($request->all());
        return response()->json($metrologist, 200);
    }
}

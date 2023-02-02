<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Http\Resources\ClientResource;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * @index LISTA de clientes habilitados ordenados alfabeticamente
     */
    public function index(){
        $clients = ClientResource::collection(Client::where('est','A')->orderBy('nom', 'asc')->get());
        return response()->json($clients,200);
    } 

    /** 
     * @search LISTA de clientes filtrados por una palabra clave o ruc
     */
    public function search($word){
        $clients = Client::where('nom', 'LIKE', '%' . $word . '%')
        ->orwhere('id', 'LIKE', '%' . $word . '%')
        ->get();
        return response()->json(ClientResource::collection($clients), 200);
    }

    /**
     * @store CREA un nuevo cliente
     */
    public function store(Request $request){
        $client = $request->all();
        $client = Client::create($request->all());
        return response()->json($client, 201);
    }

    /**
     * @update EDITA la informacion de un cliente existente
     */
    public function update(Request $request, Client $client){
        $client->update($request->all());
        return response()->json($client, 201);
    }

    // public function delete(Client $client){
    //     $ob = (object)['est'=>'I'];
    //     $client->update($ob->all());
    //     return response()->json($ob, 201);
    // }
}

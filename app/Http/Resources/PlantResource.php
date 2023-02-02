<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\Client;
use App\Models\Plant;
use App\Http\Resources\ClientResource;


class PlantResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nom_pl1' => $this->nom_pl1,
            'prov' => $this->prov,
            'ciu' => $this->ciu, 
            'cost' => $this->cost, 
            'dir' => $this->dir, 
            'per_ser' => $this->per_ser,
            'tip' => $this->tip,
            'contacts' => count(Plant::find($this->id)->contacts),
            'balances' => count(Plant::find($this->id)->balances),
            'client' => new ClientResource(Client::find($this->client_id))
        ];
    }
}

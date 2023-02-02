<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Project;

class ClientInfoResource extends JsonResource
{
    public function toArray($request)
    {
        $project = Project::find($this->id);
        $plant = $project->plant;
        $contact = $project->contact;
        return [
            'tip' => 'ICC',
            'codPro' => $this->codPro,
            'metrologist' => $project->metrologist->nom,
            'client' => $plant->client->nom,
            'loc' => $plant->prov,
            'cost' => $plant->cost,
            'plant' => $plant->nom_pl1,
            'cont' => $contact->nom,
            'telf' => $contact->telf,
            'email' => $contact->email,
            'certs' => count($project->certificates)
        ];
    }
}

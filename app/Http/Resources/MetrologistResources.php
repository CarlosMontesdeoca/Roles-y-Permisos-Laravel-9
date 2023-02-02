<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProjectResource;
use App\Models\Metrologist;
use App\Models\Project;

class MetrologistResources extends JsonResource
{
    public function toArray($request)
    {
        $met = Metrologist::find($this->id);
        $pr = ProjectResource::collection($met->projects);
        return  [
            'nom' => $this->nom,
            'usr' => $this->usr,
            'proj' => count($pr->where('revH', '!=', 0))
        ];
    }
}

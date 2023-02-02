<?php

namespace App\Http\Resources;
use App\Models\Project;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Resources\Json\JsonResource;

class MetrologistProjectResource extends JsonResource
{
    public function toArray($request)
    {
        $projects = DB::select(DB::raw("SELECT COUNT(DISTINCT P.codPro) AS 'pend' FROM projects P JOIN certificates C ON P.id = C.project_id WHERE P.metrologist_id LIKE ".$this->id." AND P.est LIKE 'P' AND (C.est LIKE 'P' OR C.est LIKE 'RH')"));
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'pend' => $projects[0]->pend
        ];
    }
}

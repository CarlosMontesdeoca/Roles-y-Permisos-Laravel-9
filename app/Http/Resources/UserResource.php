<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'usr' => $this->usr,
            'nom' => $this->nom, 
            'email' => $this->email, 
            'carg' => $this->carg,
            'role' =>$this->roles[0]->name,
            'est' =>$this->est
        ];
    }
}

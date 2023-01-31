<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    /** Datos que se ingresan o modifican */
    protected $fillable = ['plant_id', 'nom', 'email', 'telf'];

    /** Tipos de Relaciones */
    public function plant() {
        return $this->belongsTo(Client::class);
    }
}

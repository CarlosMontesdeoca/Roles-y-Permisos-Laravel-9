<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    /** Datos que se ingresan o modifican */
    protected $fillable = ['id', 'nom', 'ind', 'com'];

    /** tipos de Relaciones */
    public function plants() {
        return $this->hasMany(Plant::class);
    }
}

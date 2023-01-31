<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    use HasFactory;
    
    /** Datos que se ingresan o modifican */
    protected $fillable = ['nom_pl1', 'prov', 'ciu', 'cost', 'dir', 'per_ser', 'tip', 'client_id'];

    /** Tipos de Relaciones */
    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function contacts() {
        return $this->hasMany(Contact::class);
    }

    public function balances() {
        return $this->hasMany(Balance::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    use HasFactory;
    
    /** Datos que se ingresan o modifican */
    protected $fillable = [ 
        'tip', 
        'descBl', 
        'ident', 
        'marc', 
        'modl', 
        'ser', 
        'cls', 
        'maxCap', 
        'usCap', 
        'maxCap2', 
        'usCap2', 
        'div_e', 
        'div_e2', 
        'div_d', 
        'div_d2', 
        'uni', 
        'tolr', 
        'rang', 
        'plant_id', 
        'cli', 
        'est', 
        'cert' 
    ];

    /** Tipos de Realciones */
    public function plant() {
        return $this->belongsTo(Plant::class);
    }
}

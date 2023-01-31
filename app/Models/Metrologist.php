<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metrologist extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'usr', 'email', 'password', 'est'];

}

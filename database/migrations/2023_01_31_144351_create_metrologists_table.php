<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * nom => Nombre del Metrologo
     * usr => Nombre unico del Metrologo
     * email => Correo Empresarial 
     * est => Estado I o A
    */
    public function up()
    {
        Schema::create('metrologists', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('usr')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('est')->default('A');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('metrologists');
    }
};

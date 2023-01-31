<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {/**
         * nom_pl1 => nombre de la planta segun el cliente
         * prov => Provincia de la sucursal
         * ciu => Ciudad donde se encuentra la sucursal
         * cost => Central donde se Facturo Quito, Guayaquil o Manta
         * dir => Dirección de la sucursal 
         * tip => M para una matriz o S para una sucursal
         * client_id => Identificador del cliente
         */
        Schema::create('plants', function (Blueprint $table) {
            $table->id();
            $table->string('nom_pl1')->defaul('N/A');
            $table->string('prov');
            $table->string('ciu');
            $table->string('cost');
            $table->string('dir');
            $table->bigInteger('per_ser')->nullable();
            $table->string('tip');
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('restrict');
            $table->string('est')->default('A');
            $table->string('usr')->nullable();
            $table->text('com')->nullable();
            $table->timestamps(); 
        });
    }
    public function down()
    {
        Schema::dropIfExists('plants');
    }
};

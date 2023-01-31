<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        /**
         * plant_id => Planta a la cual pertenece la balanza
         * tip => Tipo o descripción de la balanza
         * descBl => identificador de la balanza segun el cliente
         * marc => Marca de la Balanza
         * modl => Modelo de la balanza
         * ser => Número de serie de la balanza
         * maxCap => Capacidad Máxima
         * usCap => Capacidad de Uso
         * div_e => Escala de la balanza(e)
         * div_d => Escala de la balanza(d)
         * uni => Unidad en g o kg
         * tolr => Tolerancia 
         * rang => Rango
         */
        Schema::create('balances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plant_id');
            $table->foreign('plant_id')->references('id')->on('plants')->onDelete('restrict');
            $table->string('tip');
            $table->string('descBl')->default('n/a');
            $table->string('ident')->nullable();
            $table->string('marc')->default('n/a');
            $table->string('modl')->default('n/a');
            $table->string('ser')->default('n/a');
            $table->string('cls');
            $table->double('maxCap');
            $table->double('usCap');
            $table->double('div_e');
            $table->double('div_d');
            $table->double('rang')->default(0);
            $table->char('uni', 2);
            $table->double('tolr')->default(1);
            $table->string('est')->default('A');
            $table->string('usr')->nullable();
            $table->text('com')->nullable();
            $table->string('cli')->nullable();
            $table->bigInteger('cert')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('balances');
    }
};

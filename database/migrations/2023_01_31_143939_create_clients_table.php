<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * id => Es el numero de Cedula o RUC del cliente
     * nom => Nombre empresarial o personal del cliente segun corresponda
     * ind => Tipo de industria a la que pertenece
     * est => Campo para desabilitar la información
     * usr => Registra el usuario que modifico o elimino el registro 
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('ind');
            $table->string('est')->default('A');
            $table->string('usr')->nullable();
            $table->text('com')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('clients');
    }
};

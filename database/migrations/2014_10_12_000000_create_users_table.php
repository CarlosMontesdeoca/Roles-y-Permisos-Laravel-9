<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * nom => Nombre de Empleado
     * usr => Nombre unico de usuario
     * email => Correo Empresarial 
     * rol => Cargo dentro de la empresa
     * est => Estado I o A
    */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('usr')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('carg');
            $table->string('est')->default('C');
            // $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compani', function (Blueprint $table) {
        $table->id();
        $table->string('nit')->unique(); 
        $table->string('nombre');
        $table->string('direccion');
        $table->string('telefono');
        $table->enum('estado', ['Activo', 'Inactivo'])->default('Activo'); 
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
        Schema::dropIfExists('compani');
    }
};

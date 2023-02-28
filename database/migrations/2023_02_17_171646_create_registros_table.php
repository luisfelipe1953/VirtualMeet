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
        Schema::create('registros', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('paquete_id');
            $table->string('pago_id', 30);
            $table->string('token', 8);
            $table->unsignedBigInteger('usuario_id')->nullable();
            $table->unsignedBigInteger('regalos_id')->nullable();
        
            $table->foreign('usuario_id')->references('id')->on('users');
            $table->foreign('paquete_id')->references('id')->on('paquetes');
            $table->foreign('regalos_id')->references('id')->on('regalos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registros');
    }
};

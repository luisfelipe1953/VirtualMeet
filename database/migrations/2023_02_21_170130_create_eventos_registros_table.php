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
        Schema::create('eventos_registros', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('evento_id');
            $table->unsignedBigInteger('registro_id');
            

            $table->foreign('evento_id')->references('id')->on('eventos');
            $table->foreign('registro_id')->references('id')->on('registros');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eventos_registros');
    }
};

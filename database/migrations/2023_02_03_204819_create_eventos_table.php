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
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 120)->nullable();
            $table->text('descripcion');
            $table->integer('disponibles')->nullable();
            $table->unsignedBigInteger('categoria_id');
            $table->unsignedBigInteger('dia_id');
            $table->unsignedBigInteger('hora_id');
            $table->unsignedBigInteger('ponente_id');
            

            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->foreign('dia_id')->references('id')->on('dias');
            $table->foreign('hora_id')->references('id')->on('horas');
            $table->foreign('ponente_id')->references('id')->on('ponentes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eventos');
    }
};

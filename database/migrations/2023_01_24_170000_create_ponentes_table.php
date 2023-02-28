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
        Schema::create('ponentes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 40);
            $table->string('apellido', 40);
            $table->string('ciudad', 40)->nullable();
            $table->string('pais', 40)->nullable();
            $table->string('imagen', 32)->nullable();
            $table->string('tags', 120)->nullable();
            $table->text('redes');
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
        Schema::dropIfExists('ponentes');
    }
};

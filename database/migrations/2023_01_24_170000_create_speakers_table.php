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
        Schema::create('speakers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 40);
            $table->string('lastname', 40);
            $table->string('city', 40)->nullable();
            $table->string('country', 255)->nullable();
            $table->string('image', 32)->nullable();
            $table->string('tags', 120)->nullable();
            $table->text('networks');
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
        Schema::dropIfExists('speakers');
    }
};

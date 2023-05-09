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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120)->nullable();
            $table->text('description');
            $table->integer('available')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('day_id');
            $table->unsignedBigInteger('time_id');
            $table->unsignedBigInteger('speaker_id');
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('day_id')->references('id')->on('days');
            $table->foreign('time_id')->references('id')->on('times');
            $table->foreign('speaker_id')->references('id')->on('speakers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
};

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitorRegistriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitor_registries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('art_id');
            $table->foreign('art_id')->references('id')->on('articles')->onDelete('cascade');
            $table->string('ip');
            $table->integer('clicks');

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
        Schema::dropIfExists('visitor_registries');
    }
}

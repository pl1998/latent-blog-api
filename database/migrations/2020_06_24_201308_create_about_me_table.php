<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAboutMeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about_me', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nickname',40);
            $table->string('description',40);
            $table->string('make',255);
            $table->string('contact_me',255);
            $table->string('img_url',255);
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
        Schema::dropIfExists('about_me');
    }
}

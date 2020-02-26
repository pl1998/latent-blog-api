<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->string('title');
            $table->string('cover_img')->nullable();
            $table->string('description')->nullable();
            $table->boolean('status')->default(0);
            $table->boolean('stick')->default(0);
            $table->text('content')->nullable();
            $table->text('slug')->nullable();
            $table->unsignedInteger('review_count')->default(0);
            $table->unsignedInteger('browse_count')->default(0);
            $table->string('label')->nullable();
            //$table->foreign('label_id')->references('id')->on('labels')->onDelete('cascade');
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
        Schema::table('articles', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
}

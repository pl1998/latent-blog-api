<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaveMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_message', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 20)->comment('昵称');
            $table->string('email', 40)->comment('邮箱');
            $table->string('content', 255)->comment('留言内容');
            $table->tinyInteger('status')->default(0)->comment('留言状态 0 成功 1 失败');
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
        Schema::dropIfExists('leave_message');
    }
}

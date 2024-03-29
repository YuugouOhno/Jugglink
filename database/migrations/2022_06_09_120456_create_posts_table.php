<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedinteger('user_id');
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
            $table->unsignedinteger('tool_id');
            $table->foreign('tool_id')
                    ->references('id')
                    ->on('tools');
            $table->integer('tool_number');
            $table->string('technique', 50);
            $table->string('video_path', 100);
            $table->string('video_delete', 100);
            $table->string('text', 100)->nullable();
            $table->integer('years');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}

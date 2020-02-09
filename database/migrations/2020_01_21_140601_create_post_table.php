<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('head',250)->nullable();
            $table->string('head2',250)->nullable();
            $table->string('photo',250)->nullable();
            $table->text('content')->nullable();
            $table->string('tags', 250)->nullable();
            $table->integer('likes', 7)->default(0);
            $table->integer('view', 7)->default(0);
            $table->integer('author', 7)->default(0);
            $table->integer('status', 1)->default(1);
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
        Schema::dropIfExists('post');
    }
}

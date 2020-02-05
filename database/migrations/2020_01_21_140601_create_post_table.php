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
            $table->string('category', 250)->nullable();
            $table->string('tags', 250)->nullable();
            $table->string('likes', 7)->default(0);
            $table->string('view', 7)->default(0);
            $table->string('status', 1)->default(0);
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

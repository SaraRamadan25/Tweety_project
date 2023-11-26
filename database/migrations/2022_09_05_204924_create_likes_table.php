<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('user_id')->constrained()->onDelte('cascaded');
            $table->unsignedBigInteger('tweet_id')->constrained()->onDelte('cascaded');
            $table->boolean('liked');
            $table->boolean('disliked');
            $table->timestamps();
            $table->unique(['user_id','tweet_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('likes');
    }
}

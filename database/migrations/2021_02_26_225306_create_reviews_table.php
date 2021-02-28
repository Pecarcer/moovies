<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedbigInteger('user_id');
            $table->unsignedbigInteger('movie_id');            
            $table->integer('score');
            $table->string('opinion');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete("cascade");
            $table->foreign('movie_id')->references('id')->on('movies')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}

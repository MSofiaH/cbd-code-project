<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActorsMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actors_movies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->integer('actor_id');
            $table->integer('movie_id');
            $table->decimal('actor_base_pay');
            $table->decimal('actor_revenue_share');
            $table->string('movie_character_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actors_movies');
    }
}

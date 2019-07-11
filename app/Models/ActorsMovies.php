<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActorsMovies extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'actors_movies';

    protected $fillable = ['actor_id','movie_id','actor_base_pay','actor_revenue_share','movie_character_name'];

    public function movie(){
        return $this->hasOne('App\Models\Movies', 'id', 'movie_id');
    }

    public function actor(){
        return $this->hasOne('App\Models\Actors', 'id', 'actor_id');
    }
}

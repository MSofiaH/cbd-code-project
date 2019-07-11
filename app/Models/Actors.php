<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actors extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'actors';
  
    protected $fillable = ['actor_name'];
  
    public function actorMovies(){
        return $this->hasMany('App\Models\ActorsMovies', 'actor_id', 'id');
    }
}

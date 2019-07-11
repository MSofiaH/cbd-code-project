<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScriptLines extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'script_lines';
    
    public function movieActor(){
        return $this->hasMany('App\Models\ActorsMovies', 'actor_id', 'id');
    }
}

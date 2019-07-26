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
        return $this->hasOne('App\Models\ActorsMovies', 'id', 'actor_id');
    }
}

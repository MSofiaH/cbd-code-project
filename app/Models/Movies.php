<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movies extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'movies';
  
    public function movieActors(){
        return $this->hasMany('App\Models\ActorsMovies', 'movie_id', 'id');
    }
  
    public function productionCompany(){
        return $this->hasOne('App\Models\ProductionCompanies', 'id', 'production_companies_id');
    }
  
    public function script(){
        return $this->hasOne('App\Models\Scripts', 'movie_id', 'id');
    }
}

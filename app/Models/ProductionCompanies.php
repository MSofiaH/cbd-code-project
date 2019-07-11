<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductionCompanies extends Model
{
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'production_companies';
  
    public function movies(){
        return $this->hasMany('App\Models\Movies', 'production_companies_id', 'id');
    }
}

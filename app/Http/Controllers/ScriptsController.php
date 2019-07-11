<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movies;

class ScriptsController extends Controller
{
     public function get($movieId) {
        $movie = Movies::find($movieId);
        return view('scripts')->with(['movie_name' => $movie->movie_name,'movie_id'=>$movie->id]);
    }
}

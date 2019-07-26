<?php

namespace App\Http\Controllers\Api;

use App\Models\ActorsMovies;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ActorMovie as ActorMovieResource;
use App\Http\Resources\ActorMovieCollection;

class ActorMovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $response = ActorsMovies::query();
        if(isset($request->movie)){
            $response->where('movie_id',$request->movie)->with('movie');
        }
        if(isset($request->actor)){
            $response->where('actor_id', $request->actor)->with('actor');
        }
        return new ActorMovieCollection($response->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

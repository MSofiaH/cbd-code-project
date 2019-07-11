<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Actors as ActorsResource;
use App\Http\Resources\ActorsCollection;
use App\Models\Actors;
use App\Models\ActorsMovies;

class ActorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ActorsCollection(Actors::with('actorMovies.movie')->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $actor = new Actors();
        $actor->actor_name = $request->actor_name;
        $actor->save();

        return new ActorsResource($actor);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new ActorsResource(Actors::with('actorMovies.movie')->find($id));
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
        $actorMovie = new ActorsMovies();
        $actorMovie->fill($request);
        $actorMovie->save();

        $actor = Actors::with('actorMovies.movie')->find($id);

        return new ActorsResource($actor);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $actor = Actors::find($id);
        $actor->delete();
        return new ActorsResource($actor);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Models\ScriptLines;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Scripts as ScriptsResource;
use App\Http\Resources\ScriptsCollection;
use App\Models\Scripts;

class ScriptsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ScriptsResource(Scripts::with('lines.movieActor.actor')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $script = Scripts::where('movie_id',$request->movie_id)->first();
        if($script == null){
            $script = new Scripts();
            $script->movie_id = $request->movie_id;
            $script->save();
        }

        $line = new ScriptLines();
        $line->script_id = $script->id;
        $line->actor_id = $request->actor_id;
        $line->line = $request->line;
        $line->save();

        return new ScriptsResource(Scripts::with('lines.movieActor.actor')->where('movie_id',$request->movie_id)->get());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new ScriptsResource(Scripts::with('lines.movieActor.actor')->where('movie_id',$id)->get());
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
        // lines
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

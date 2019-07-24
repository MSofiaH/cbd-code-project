<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Movies as MoviesResource;
use App\Http\Resources\MoviesCollection;
use App\Models\Movies;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new MoviesCollection(Movies::with('productionCompany')->with('script')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $movie = new Movies();
        $movie->movie_name = $request->movie_name;
        $movie->production_companies_id = $request->production_companies_id;
        $movie->production_company_revenue_share = $request->production_company_revenue_share;
        $movie->save();

        return new MoviesResource($movie);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new MoviesResource(Movies::find($id));
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
        $movie = Movies::find($id);
        $movie->movie_name = $request->movie_name;
        $movie->production_companies_id = $request->production_companies_id;
        $movie->production_company_revenue_share = $request->production_company_revenue_share;
        $movie->save();

        return new MoviesResource($movie);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movies::find($id);
        $movie->delete();
        return new MoviesResource($movie);
    }
}

<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductionCompanies as ProductionCompaniesResource;
use App\Http\Resources\ProductionCompaniesCollection;
use App\Models\ProductionCompanies;

class ProductionCompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ProductionCompaniesCollection(ProductionCompanies::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $productionCompany = new ProductionCompanies();
        $productionCompany->company_name = $request->company_name;
        $productionCompany->save();



        return new ProductionCompaniesResource($productionCompany);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new ProductionCompaniesResource(ProductionCompanies::find($id));
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
        $productionCompany = ProductionCompanies::find($id);
        $productionCompany->company_name = $request->company_name;
        $productionCompany->save();

        return new ProductionCompaniesResource($productionCompany);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $productionCompany = ProductionCompanies::find($id);
        $productionCompany->delete();
        return new ProductionCompaniesResource($productionCompany);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductionCompaniesController extends Controller
{
    public function index() {
        return view('production-companies');
    }
}

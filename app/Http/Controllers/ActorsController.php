<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActorsController extends Controller
{
    public function index() {
        return view('actors');
    }
    
    public function addActors() {
        return view('actors-add');
    }
}

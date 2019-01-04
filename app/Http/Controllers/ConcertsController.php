<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Concert;

class ConcertsController extends Controller
{
    public function index()
    {
        $concerts = Concert::all();
        return view('concerts.index', ['concerts' => $concerts]);
    }
}

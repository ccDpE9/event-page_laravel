<?php

namespace App\Http\Controllers;

use App\Concert;
use Illuminate\Http\Request;

class ConcertController extends Controller
{
    public function index()
    {
        $concert = Concert::upcoming();
        return response()->json([
            "data" => $concert,
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Concert $concert)
    {
        //
    }

    public function edit(Concert $concert)
    {
        //
    }

    public function update(Request $request, Concert $concert)
    {
        //
    }

    public function destroy(Concert $concert)
    {
        //
    }
}

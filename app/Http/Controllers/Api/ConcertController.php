<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Concert;

class ConcertController extends Controller
{
    public function index()
    {
        $concerts = Concert::upcoming()->get();
        return response()->json([
            "data" => $concerts
        ]);
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Concert;

class ConcertController extends Controller
{
    /*
    public function __constructor()
    {
        $this->middleware(
            "jwt.verify",
            ["except" => ["index"]]
        );
    }
     */

    public function index()
    {
        $concerts = Concert::upcoming()->get();
        return response()->json([
            "data" => $concerts
        ]);
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            "title" => ["required"],
            "description" => ["required"],
            "date" => ["required"],
            "start_time" => ["required"],
            "end_time" => ["required"],
            "city" => ["required"],
            "venue" => ["required"],
            "venue_address" => ["required"],
            "ticket_price" => ["required"],
            "tickets_quantity" => ["required"]
        ]);

        // - unlike make(), create() saves to the db
        $concert = Concert::create($request->all());
        return response()->json([
            "data" => $concert
        ]);
    }

    public function show($id)
    {
        $concert = Concert::where("id", $id)->get();
        return response()->json([
            "data" => $concert
        ]);
    }

    public function update(Request $request, $id)
    {
        $concert = Concert::where("id", $id);
        $concert->update($request->all());
        return response()->json([
            "data" => $concert
        ]);
    }

    public function destroy($id)
    {
        $concert = Concert::find($id);
        $concert->delete();
        return response()->json([
            "status" => "Concert was successfully deleted."
        ], 200);
    }
}

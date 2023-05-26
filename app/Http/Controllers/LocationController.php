<?php

namespace App\Http\Controllers;

use App\Http\Resources\ShowLocationResource;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = Location::all();
        $locations = ShowLocationResource::collection($locations);
        return response()->json(['message'=>true, 'data'=>$locations], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $location = Location::location($request);
        return response()->json(['message'=>true, 'data'=>$location], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $location = Location::find($id);
        if(!$location){

            return response()->json(['message'=>'Not found'],404);
        }
        $location = new ShowLocationResource($location);
        return response()->json(['scucces'=>true, 'data'=>$location],200);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $location = Location::location($request, $id);
        return response()->json(['Update location success'=>true, 'data'=>$location],200);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $location = Location::find($id);
        if(!$location){
            return response()->json(['message'=>'Not found'],404);
        }
        $location->delete();
        return response()->json(['message'=>true, 'data'=>$location], 200);
    }
}

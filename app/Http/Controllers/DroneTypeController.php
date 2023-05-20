<?php

namespace App\Http\Controllers;

use App\Http\Resources\ShowDroneTypeResource;
use App\Models\DroneType;
use Illuminate\Http\Request;

class DroneTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $droneTypes = DroneType::all();
        $droneTypes = ShowDroneTypeResource::collection($droneTypes);
        return response()->json(['message'=>true, 'data'=>$droneTypes], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dronType = DroneType::droneType($request);
        return response()->json(['message'=>true, 'data'=>$dronType], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dronType = DroneType::find($id);
        $dronType = new ShowDroneTypeResource($dronType);
        return response()->json(['message'=>true, 'data'=>$dronType], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dronType = DroneType::find($id);
        $dronType = DroneType::droneType($request, $id);
        return response()->json(['message'=>true, 'data'=>$dronType], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dronType = DroneType::find($id);
        $dronType->delete();
        return response()->json(['message'=>true, 'data'=>$dronType], 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\DroneRequest;
use App\Http\Resources\ShowDroneResource;
use App\Models\Drone;
use Illuminate\Http\Request;

class DroneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $drones = Drone::all();
        $drones = ShowDroneResource::collection($drones);
        return response()->json(['message'=>true, 'data'=>$drones], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DroneRequest $request)
    {
        $drone = Drone::drone($request);
        return response()->json(['message'=>true, 'data'=>$drone], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $drone = Drone::find($id);
        $drone = new ShowDroneResource($drone);
        return response()->json(['message'=>true, 'data'=>$drone], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DroneRequest $request, string $id)
    {
        $drone = Drone::find($id);
        $drone = Drone::drone($request, $id);
        return response()->json(['message'=>true, 'data'=>$drone], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $drone = Drone::find($id);
        $drone->delete();
        return response()->json(['message'=>true, 'data'=>$drone], 200);
    }
}

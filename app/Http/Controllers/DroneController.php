<?php

namespace App\Http\Controllers;

use App\Http\Requests\DroneRequest;
use App\Http\Resources\DroneResource;
use App\Http\Resources\IndructionResource;
use App\Http\Resources\ShowDroneResource;
use App\Models\Drone;
use App\Models\Instruction;
use App\Models\Location;
use Illuminate\Contracts\Database\Eloquent\Builder;
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
        return response()->json(['message'=>"Get all drone successfully", 'data'=>$drones], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DroneRequest $request)
    {
        $drone = Drone::drone($request);
        return response()->json(['message'=>"Create drone successfully", 'data'=>$drone], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        $drone = Drone::where('drone_id', $id)->first();
        if(!$drone){
            return response()->json(['message'=>'Drone not found'],404);
        }
        $drone = new ShowDroneResource($drone);
        return response()->json(['message'=>"Get drone by id successfully", 'data'=>$drone], 200);
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(DroneRequest $request, string $droneId)
    {
        $drone = Drone::where('drone_id', $droneId)->first();
       if($drone){
            $drone = Drone::drone($request, $droneId);
            return response()->json(['Update drone success'=>true, 'data'=>$drone],200);
       }
       return response()->json(['message'=>"Drone id not found"], 404);
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $drone = Drone::find($id);
        if(!$drone){
            return response()->json(['message'=>'Drone not found'], 404);
        }
        $drone->delete();
        return response()->json(['message'=>"Delete drone by id successfully", 'data'=>$drone], 200);
    }

    /**
     * Find id drone and location for get current location latitude and longitude.
     */
    public function droneLocation(string $droneId, string $locationId)
    {
        $drone = Drone::where('drone_id', $droneId)->with('locations', function($query) use ($locationId){
                $query->where('id', $locationId); })->first();
        if(!$drone){
            return response()->json(['message'=>'Drone not found'], 404);
        }
        $locations = $drone->locations->map(function($location) {
            return [
                'id'=>$location->id,
                'latitude'=>$location->latitude,
                'longitude'=>$location->longitude,
            ];
        });
        return response()->json(['message'=>"Show current latitude and longitude successfully", 'data'=>$locations], 200);
    }

    /**
     * Find id drone and location for get current location latitude and longitude.
     */
    public function runDrone(string $droneId, Request $request)
    {
        $runDrone = Instruction::whereHas('drone', function ($query) use ($droneId) {
            $query->where('drone_id', $droneId);})->first();
        if(!$runDrone){
                return response()->json(['message'=>'Drone id not found'], 404);
        }
        $runDrone->action  = $request->input('action');
        $runDrone->save();
        return response()->json(['message'=>"Drone run successfully", 'data'=>$runDrone], 200);
    }
}
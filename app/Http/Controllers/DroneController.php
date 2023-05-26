<?php

namespace App\Http\Controllers;

use App\Http\Requests\DroneRequest;
use App\Http\Resources\DroneResource;
use App\Http\Resources\IndructionResource;
use App\Http\Resources\ShowDroneResource;
use App\Models\Drone;
use App\Models\Indruction;
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
    public function show(string $drone_id)
    {
        $drone = Drone::where('drone_id', $drone_id)->get();
        if(!$drone){
            return response()->json(['message'=>'Not found'],404);
        }
        $drone =  DroneResource::collection($drone);
        return response()->json(['message'=>true, 'data'=>$drone], 200);
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(DroneRequest $request, string $drone_id)
    {
        $drone = Drone::where('drone_id', $drone_id)->get();
        $drone = Drone::drone($request, $drone_id);
        return response()->json(['message'=>true, 'data'=>$drone], 200);
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $drone = Drone::find($id);
        if(!$drone){
            return response()->json(['message'=>'Not found'],404);
        }
        $drone->delete();
        return response()->json(['message'=>true, 'data'=>$drone], 200);
    }

    /**
     * Find id drone and location for get current location latitude and longitude.
     */
    public function droneLocation(string $droneId, string $locationId)
    {
        $drone = Drone::where('drone_id', $droneId)->with(['locations' => function($query) use ($locationId){
                $query->where('id', $locationId); }])->first();
        if(!$drone){
            return response()->json(['message'=>'Not found'],404);
        }
        $locations = $drone->locations->map(function($location) {
            return [
                'latitude' => $location->latitude,
                'longitude' => $location->longitude,
            ];
        });
        return response()->json(['message'=>"Show current latitude and longitude successfully", 'data'=>$locations], 200);
    }

    /**
     * Find id drone and location for get current location latitude and longitude.
     */
    public function runDrone(string $droneId, Request $request)
    {
        $runDrone = Indruction::whereHas('drone', function ($query) use ($droneId) {
            $query->where('drone_id', $droneId);})->first();
        $runDrone->is_active  = $request->input('is_active');
        $runDrone->save();

        return response()->json(['message'=>"Failed to save instruction", 'data'=>$runDrone],500);

     
    }

}
<?php

namespace App\Http\Controllers;

use App\Http\Requests\MapRerequest;
use App\Http\Resources\ShowMapResource;
use App\Models\Farm;
use App\Models\Map;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class MapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $maps = Map::all();
        $maps = ShowMapResource::collection($maps);
        return response()->json(['message'=>true, 'data'=>$maps], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MapRerequest $request)
    {
        $map = Map::map($request);
        return response()->json(['message'=>true, 'data'=>$map], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $map = Map::find($id);
        if(!$map){
            return response()->json(['message'=>'Not found'],404);
        }
        $map = new ShowMapResource($map);
        return response()->json(['message'=>true, 'data'=>$map], 200);
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(MapRerequest $request, string $id)
    {
        $map = Map::find($id);
        $map = Map::map($request, $id);
        return response()->json(['message'=>true, 'data'=>$map], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $map = Map::find($id);
        if(!$map){
            return response()->json(['message'=>'Not found'],404);
        }
        $map->delete();
        return response()->json(['message'=>true, 'data'=>$map], 200);
    }

    public function downloadMapPhoto(string $mapName, string $farmId )
    {
        $map = Map::where('name', $mapName)->with(['farm' => function($query) use ($farmId){
            $query->orderByDesc('created_at')->where('id', $farmId); }])->first();
        if(!$map){
            return response()->json(['message'=>'Not found'],404);
        }
        return response()->json(['message'=>'Image download successfully', 'data'=>$map->image], 200);
    }

    public function deleteMapPhoto(string $mapName, string $farmId )
    {
        $map = Map::where('name', $mapName)->with(['farm' => function($query) use ($farmId){
            $query->orderByDesc('created_at')->where('id', $farmId); }])->first();
        if(!$map){
            return response()->json(['message'=>'Not found'],404);
        }

        if ($map->image != null) {
            Storage::delete($map->image);
            $map->image != null;
            $map->delete();
        }

        return response()->json(['message'=>'Image delete successfully', 'data'=>$map->image], 200);
    }

    // public function addMapPhoto(string $mapName, string $farmId, Request $request)
    // {
    //     $farm = Farm::where('name', $mapName)->where('id', $farmId)->first();

    //     if (!$farm) {
    //         return response()->json(['message' => 'Farm not found'], 404);
    //     }
    //     $map = new Map();
    //     $map->id = $farmId;
    //     $map->image_path = $request->file('image')->store('maps');
    //     $map->farm_id = $farm->id;
    //     $map->save();

    //     return response()->json(['message'=>'Map added successfully', 'data'=>$map], 200);
    // }
}

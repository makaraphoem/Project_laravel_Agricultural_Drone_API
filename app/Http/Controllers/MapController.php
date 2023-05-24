<?php

namespace App\Http\Controllers;

use App\Http\Requests\MapRerequest;
use App\Http\Resources\ShowMapResource;
use App\Models\Map;
use Illuminate\Http\Request;

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
}

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
        return response()->json(['message'=>"Create map successfully", 'data'=>$map], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $map = Map::find($id);
        if(!$map){
            return response()->json(['message'=>'Map not found'],404);
        }
        $map = new ShowMapResource($map);
        return response()->json(['message'=>"Get map by id successfully", 'data'=>$map], 200);
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(MapRerequest $request, string $id)
    {
        $map = Map::find($id);
        $map = Map::map($request, $id);
        return response()->json(['message'=>"Update map successfully", 'data'=>$map], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $map = Map::find($id);
        if(!$map){
            return response()->json(['message'=>'Map not found'],404);
        }
        $map->delete();
        return response()->json(['message'=>"Delete map successfully", 'data'=>$map], 200);
    }

       /**
     * Find name map and farm id for download image
     */
    public function downloadMapPhoto(string $province, string $farmId )
    {
        $map = Map::where('province', $province)->whereHas('farms', function ($query) use ($farmId) {
            $query->where('id', $farmId);})->first();
        if(!$map){
            return response()->json(['message'=>'Not found'],404);
        }
        return response()->json(['message'=>'Image download successfully', 'data'=>$map->image], 200);
    }

      /**
     * Find name map and farm id for delete image.
     */
    public function deleteMapPhoto(string $province, string $farmId )
    {
        $map = Map::where('province', $province)->whereHas('farms', function ($query) use ($farmId) {
                $query->where('id', $farmId);})->first();
        if(!$map){
            return response()->json(['message'=>'Map not found'],404);
        }
        if (!$map->image) {
            return response()->json(['message' => 'Map image not found'], 404);
        }
        $map->image = "null";
        $map->save();
        return response()->json(['message'=>'Image deleted successfully', 'data'=>$map], 200);
    }
    
     /**
     * Find name map and farm id for add new image.
     */
    public function addMapPhoto(string $province, string $farmId, Request $request)
    {
        $map = Map::where('province', $province)->whereHas('farms', function ($query) use ($farmId) {
            $query->where('id', $farmId);})->first();
        if (!$map) {
            return response()->json(['message' => 'Map not found'], 404);
        }
        $droneId = $map->drone_id;
        $map = new Map([
            'province' => $province,
            'image' => $request->input('image'),
            'drone_id' =>  $droneId,
            'farm_id' => $farmId,
        ]);
        $map->save();
        return response()->json(['message'=>'Map added successfully', 'data'=>$map], 200);
    }

     /**
     * Find name map and farm id for update image.
     */
    public function updateMapPhoto(string $province, string $farmId, Request $request)
    {
        $map = Map::where('province', $province)->whereHas('farms', function ($query) use ($farmId) {
            $query->where('id', $farmId);})->first();
        if (!$map) {
            return response()->json(['message' => 'Map not found'], 404);
        }
        $map->image = $request->input('image');
        $map->save();
        return response()->json(['message'=>'Map added successfully', 'data'=>$map], 200);
    }
}

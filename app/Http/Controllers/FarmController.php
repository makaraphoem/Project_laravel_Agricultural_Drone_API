<?php

namespace App\Http\Controllers;

use App\Http\Requests\FarmRequest;
use App\Http\Requests\StoreFarmRequest;
use App\Http\Resources\FarmResource;
use App\Http\Resources\ShowFarmResource;
use App\Models\Farm;
use Illuminate\Http\Request;

class FarmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $farm = Farm::all();
        $farm =  ShowFarmResource::collection($farm);
        return response()->json(['Get all farm success'=>true,'data'=>$farm],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FarmRequest $request)
    {
        $farm = Farm::farm($request);
        $farm = new ShowFarmResource($farm);
        return response()->json(['message'=>"Create farm success",'data'=>$farm],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $farm = Farm::find($id);
        if(!$farm){
            return response()->json(['message'=>'Not found'],404);
        }
        $farm = new ShowFarmResource($farm);
        return response()->json(['scucces'=>true, 'data'=>$farm],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $farm = Farm::farm($request,$id);
        return response()->json(['Update farm success'=>true, 'data'=>$farm],200);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $farm = Farm::find($id);
        if(!$farm){
            return response()->json(['message'=>'Not found'],404);
        }
        $farm-> delete();
        return response()->json(['Delete fa$farm success'=>true, 'data'=>$farm],201);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndructionRequest;
use App\Http\Resources\ShowIndructionResource;
use App\Models\Indruction;
use App\Models\Instruction;
use Illuminate\Http\Request;

class IndructionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $indructions = Instruction::all();
        $indructions = ShowIndructionResource::collection($indructions);
        return response()->json(['message'=>true, 'data'=>$indructions], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(IndructionRequest $request)
    {
        $indruction = Instruction::indruction($request);
        return response()->json(['message'=>true, 'data'=>$indruction], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $indruction = Instruction::find($id);
        if(!$indruction){
            return response()->json(['message'=>'Not found'],404);
        }
        $indruction = new ShowIndructionResource($indruction);
        return response()->json(['scucces'=>true, 'data'=>$indruction],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(IndructionRequest $request, string $id)
    {
        $indruction = Instruction::indruction($request,$id);
        return response()->json(['Update indruction success'=>true, 'data'=>$indruction],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $indruction = Instruction::find($id);
        if(!$indruction){
            return response()->json(['message'=>'Not found'],404);
        }
        $indruction->delete();
        return response()->json(['message'=>true, 'data'=>$indruction], 200);
    }
}

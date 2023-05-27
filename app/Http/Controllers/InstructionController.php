<?php

namespace App\Http\Controllers;

use App\Http\Requests\InstructionRequest;
use App\Http\Resources\ShowIndructionResource;
use App\Http\Resources\ShowInstructionResource;
use App\Models\Instruction;
use Illuminate\Http\Request;

class InstructionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $instructions = Instruction::all();
        $instructions = ShowInstructionResource::collection($instructions);
        return response()->json(['message'=>true, 'data'=>$instructions], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InstructionRequest $request)
    {
        $instruction = Instruction::instruction($request);
        return response()->json(['message'=>true, 'data'=>$instruction], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $instruction = Instruction::find($id);
        if(!$instruction){
            return response()->json(['message'=>'Instruction id not found'],404);
        }
        $instruction = new ShowInstructionResource($instruction);
        return response()->json(['scucces'=>true, 'data'=> $instruction],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InstructionRequest $request, string $id)
    {
        $instruction = Instruction::find($id);
        if($instruction){
             $instruction = Instruction::instruction($request, $id);
             return response()->json(['Update instruction success'=>true, 'data'=>$instruction],200);
        }
        return response()->json(['message'=>"Indruction id not found"],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $instruction = Instruction::find($id);
        if(!$instruction){
            return response()->json(['message'=>'Instruction id not found'],404);
        }
        $instruction->delete();
        return response()->json(['message'=>true, 'data'=>$instruction], 200);
    }
}

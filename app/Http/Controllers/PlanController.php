<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlanRequest;
use App\Http\Resources\IndructionResource;
use App\Http\Resources\PlanResource;
use App\Http\Resources\ShowPlanResource;
use App\Models\Indruction;
use App\Models\Plan;
use DOMProcessingInstruction;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $palns = Plan::all();
        $palns = ShowPlanResource::collection($palns);
        return response()->json(['message'=>true, 'data'=>$palns], 200);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(PlanRequest $request)
    {
        $plan = Plan::plan($request);
        return response()->json(['message'=>"create a plan successfull", 'data'=>$plan], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $plan = Plan::find($id);
        if(!$plan){
            return response()->json(['message'=>'Not found'],404);
        }
        $plan = new ShowPlanResource($plan);
        return response()->json(['message'=>true, 'data'=>$plan], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PlanRequest $request, string $id)
    {
        $plan = Plan::find($id);
        $plan = Plan::plan($request, $id);
        return response()->json(['message'=>true, 'data'=>$plan], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $plan = Plan::find($id);
        if(!$plan){
            return response()->json(['message'=>'Not found'],404);
        }
        $plan->delete();
        return response()->json(['message'=>true, 'data'=>$plan], 200);
    }
     /**
     * Find  plan name and indruction id for show plan indructiion.
     */
    public function getIntroduction(string $planName)
    {
        $planIndructions = Indruction::whereHas('plan', function ($query) use ($planName) {
            $query->where('name', $planName);})->first();
        if(!$planIndructions){
            return response()->json(['message'=>'Plan not found'],404);
        }
        return response()->json(['message'=>"Show plan indtructions successfully", 'data'=>$planIndructions], 200);
    }
}

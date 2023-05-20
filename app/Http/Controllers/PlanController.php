<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlanRequest;
use App\Http\Resources\ShowPlanResource;
use App\Models\Plan;
use Illuminate\Http\Request;

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
        return response()->json(['message'=>true, 'data'=>$plan], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $plan = Plan::find($id);
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
        $plan->delete();
        return response()->json(['message'=>true, 'data'=>$plan], 200);
    }
}

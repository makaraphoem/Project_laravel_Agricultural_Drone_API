<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UserRequest;
use App\Http\Resources\ShowUserResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all();
        $user =  ShowUserResource::collection($user);
        return response()->json(['Get all user success'=>true, 'data'=>$user],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $user = User::user($request);
        $token = $user->createToken('API Token')->plainTextToken;
        return response()->json(['Create user success'=>true, 'data'=>$user , 'token'=>$token],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        if(!$user){

            return response()->json(['message'=>'Not found'],404);
        }
        $user = new ShowUserResource($user);
        
        return response()->json(['scucces'=>true, 'data'=>$user],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
       $user = User::user($request,$id);
       
       return response()->json(['Update user success'=>true, 'data'=>$user],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        if(!$user){
            return response()->json(['message'=>'Not found'],404);
        }
        $user-> delete();
        return response()->json(['Delete user success'=>true, 'data'=>$user],201);
    }

    
}

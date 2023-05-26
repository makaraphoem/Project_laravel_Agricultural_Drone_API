<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogInOutController extends Controller
{
    public function login(Request $request){
        $credentail = $request->only('email', 'password');
        if(Auth::attempt($credentail)){
            $user = Auth::user();
            $token = $user->createToken('API Token')->plainTextToken;
            return  response()->json(['message' => "Valid credentail", 'data' => $user, 'token' => $token],200);
         }
         return response()->json(['message' => "Invalid credentail"],401);
    }

    public function logout(Request $request){
        $userLogOut = request()->user()->tokens()->delete();
        $userLogOut = Auth::user();
        return response()->json(['message' => "log out successfull", 'data'=> $userLogOut],401);
    }
}

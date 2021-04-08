<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Api\V1\UserController;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $user = User::where('email',$request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw  ValidationException::withMessages([
                'email'=> 'email or password are incorrect'
            ]);
            //  return response()->json(["email"=> "email or password are incorrect"], 404);
                
            }
        return   [
            'api_token'=> $user->createToken('api_token')->plainTextToken
        ];
    }
    public function register(RegisterRequest $request)
    {
        // $request->only(['email','password']);
        // $password = bcrypt($request->password);
       $user =User::create(['email'=> $request->email , "password"=> bcrypt($request->password)]);
        return [
            'api_token'=> $user->createToken('api_token')->plainTextToken
        ];

    }
    public function getUserByToken()
    {
            return [
                'user'=>  auth()->user(),
            ];
    }
  
    public function logout()
    {
            return auth()->user()->tokens()->delete();
    }
  
   
}

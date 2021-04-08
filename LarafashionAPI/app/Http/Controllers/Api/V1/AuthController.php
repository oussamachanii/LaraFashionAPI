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
    public function changePassword(Request $request)
    {
        return $request;
        $request->validate([
            'current_password' => 'required|',
            'password' => 'required|min:6|max:25',
            'password_confirmation' => 'required|confirmed',
        ]);
        $user = User::find(auth()->user()->id);
        if (Hash::check($request->current_password, $user->password)) {
            return $user->update(['password'=>bcrypt($request->password)]);
        }
        return response()->json([
            "message"=> "The given data was invalid !",
            "errors"=> [
                "password"=> [
                    "The password not correct"
                ],
            ]
               
        ],422);

    }
  
   
}

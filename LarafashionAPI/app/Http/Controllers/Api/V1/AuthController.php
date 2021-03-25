<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $user = User::where('email',$request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw  ValidationException::withMessages([
                'email'=> 'email or password are incorrect'
                ]);
                
            }
        return   [
            'user'=> $user,
            'api_token'=> $user->createToken('api_token')->plainTextToken
        ];
    }
    public function register(RegisterRequest $request)
    {
        $user = User::create($request->only(['email','password']));
        return [
            'user'=> $user,
            'api_token'=> $user->createToken('api_token')->plainTextToken
        ];

        // $user = User::where('email',$request->email)->first();
        // if ($user) {
        //     throw ValidationException::withMessages([
        //         'email'=> 'this email is already token'
        //     ]);
            
        // }
        // return [
        //     'user'=> $user,
        //     'api_token'=> $user->createToken()
        // ];
    }
}

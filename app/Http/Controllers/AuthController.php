<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;

class AuthController extends Controller
{
    public function register(AuthRegisterRequest $request)
    {
        $validated = $request->validated();

        try {
            $user = User::query()->create($validated);
            $token = $user->createToken('token')->plainTextToken;
            
            return response()->json(['data' => $user, 'token' => $token], Response::HTTP_CREATED);
        } catch (\Exception $ex) {
            Log::critical($ex->getMessage());
            return response()->json(['error' => 'Call the support'], Response::HTTP_OK);
        }
        
    }

    public function login(AuthLoginRequest $request)
    {
        $validated = $request->validated();

        try {
            $user = User::query()->where('email', $validated['email'])->first();

            if (!$user || !Hash::check($validated['password'], $user->password)) {
                return response()->json(['error' => 'Invalid credentials'], Response::HTTP_UNAUTHORIZED);
            }
    
            $token = $user->createToken('token');
    
            return response()->json(['token' => $token->plainTextToken], Response::HTTP_OK);
        } catch (\Exception $ex) {
            Log::critical($ex->getMessage());
            return response()->json(['error' => 'Call the support'], Response::HTTP_OK);
        }
        
    }
}

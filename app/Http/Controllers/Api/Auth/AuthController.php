<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AuthRequest;
use App\Http\Requests\Api\RegisterUserRequest;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    //
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(AuthRequest $request)
    {
        $auth = $this->authService->login($request->all());
        return $auth;
    }

    public function logout(Request $request){
        
        $request->user()->tokens()->delete();
        return response()->json([
            'message' => 'success'
        ]);

    }

    public function me(Request $request){
        $user =  $request->user();
        return response()->json([
            'me' => $user
        ]);
    }

}

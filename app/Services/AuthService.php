<?php

namespace App\Services;

use App\Repositories\Contracts\AuthRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthService {

    protected $userRepository;
    protected $authRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        AuthRepositoryInterface $authRepository 
       )
    {
        $this->userRepository = $userRepository;
        $this->authRepository = $authRepository;
    }

    public function login(array $userInput){
        $user = $this->userRepository->getUserByUsername($userInput['username']);

        if(!$user || !Hash::check($userInput['password'], $user->password)){
            responseError('user','Login ou senha estão inválidos');
        }

        if(!$user->active){
            responseError('user', 'Usuario está inativo.');
        }

        $user->tokens()->delete();
        $token = $user->createToken($userInput['device_name'], ['level:'.$user->level])->plainTextToken;
        return response()->json(['token' => $token], 200);
    }

    
}
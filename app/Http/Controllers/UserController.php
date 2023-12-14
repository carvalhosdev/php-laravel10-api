<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Requests\Api\AddUserRequest;
use App\Http\Requests\Api\LevelUserRequest;
use App\Http\Requests\Api\RegisterUserRequest;
use App\Http\Requests\Api\RemoveUserRequest;
use App\Http\Requests\Api\StatusUserRequest;
use App\Http\Requests\Api\UpdateUserRequest;
use App\Http\Resources\ChildResource;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService){
        $this->userService = $userService;
    }

    public function getAllUsers(Request $request){
        $users = $this->userService->getAllUsers();
        return UserResource::collection($users);
    }

    public function getUserById(int $id){
        $user = $this->userService->getUserById($id);
        return new UserResource($user);
    }

    public function destroyUser(RemoveUserRequest $request){
        $user = $this->userService->destroyUser($request->id);
        return $user;
    }

    public function updateUser(int $id, UpdateUserRequest $request)
    {
        $user = $this->userService->updateUser($id, $request->all());
        return $user;
    }

    public function registerUser(RegisterUserRequest $request)
    {
        $user = $this->userService->registerUser($request->all());
        return $user;
    }

    public function addUserByAdmin(AddUserRequest $request)
    {
        $user = $this->userService->addUserByAdmin($request->user()->id, $request->all());
        return $user;
    }

    public function userChildList(Request $request)
    {
        $users = $this->userService->userChildList($request->user()->id);
        return ChildResource::collection($users);
    }
        
}

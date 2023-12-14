<?php 
namespace App\Repositories;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface{

    protected $entity;

    public function __construct(User $user)
    {
        $this->entity = $user;
    }

    public function getAllUsers(){
        return $this->entity->orderBy('created_at', 'desc')->get();
    }

    public function getUserById(int $id){
        return $this->entity->where('id', $id)->first();
    }

    public function getUserByUsername(string $username){
        return $this->entity->where('username', $username)->first();
    }

    public function registerUser(array $userInput){
        return User::create($userInput);
    }

    public function updateUser(object $user, array $userInput){
        return $user->update($userInput);
    }

    public function destroyUser(object $user){
        return $user->delete();
    }

    public function userChildList(int $user_id){
        return $this->entity->where('user_owner', $user_id)->get();
    }
    
    
}
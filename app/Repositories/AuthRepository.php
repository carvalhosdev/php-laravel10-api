<?php 
namespace App\Repositories;

use App\Repositories\Contracts\AuthRepositoryInterface;
use App\Models\User;

class AuthRepository implements AuthRepositoryInterface{

    protected $entity;

    public function __construct(User $user)
    {
        $this->entity = $user;
    }
  
    public function login()
    {
        return "OK";
    }

}
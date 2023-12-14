<?php

namespace App\Services;

use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserService {

    protected  $userRepository;

    public function __construct(UserRepositoryInterface $userRepository){
        $this->userRepository = $userRepository;
    }

    public function getAllUsers(){
        return $this->userRepository->getAllUsers();
    }

    public function getUserById(int $id){
        $user =  $this->userRepository->getUserById($id);
        if(!$user){
            responseError('user','Usuario não encontrado');
        }

        return $user;
    }

    public function registerUser(array $userInput){
        $userInput['password'] = bcrypt($userInput['password']);
        $this->userRepository->registerUser($userInput);
        return response()->json([
            "message" => "Usuario criado com sucesso"
        ], 200);
    }

    public function addUserByAdmin(int $user_id, array $userInput){
        $father = $this->getUserById($user_id);
      

        $userInput['password'] = bcrypt($userInput['password']);
        $userInput['level'] = "user";
        $userInput['user_owner'] = $user_id; //who is the father?

        $rand = random_int(1, 100) . date('his');
        $newEmail = str_replace("@", "_c_{$rand}@", $father->email);
        $userInput['email'] = $newEmail;
        
        $this->userRepository->registerUser($userInput);
        return response()->json([
            "message" => "Usuario criado com sucesso"
        ], 200);
    }
    

    public function updateUser($id, array $userInput){
        $logout = false;
        $user = $this->getUserById($id);

     
        if(!$user){
            responseError('user','Usuario não encontrado');
        }

        if(!empty($userInput['password']) && !empty($userInput['re_password']))
        {
            if($userInput['password'] != $userInput['re_password']){
                responseError('user', 'A senhas não conferem');
            }

            $userInput['password'] = bcrypt($userInput['password']);
            $logout = true;
           
        }

        if($userInput['username'] != $user->username){
            $logout = true;
        }

        if($userInput['level'] != $user->level){
            userLevelAvailable($userInput['level']);
            $logout = true;
        }


        if($logout){
            $user->tokens()->delete();
        }

        $this->userRepository->updateUser($user, $userInput);
        return response()->json(["message" => "Usuario atualizado"], 200);
        
    }

    public function destroyUser(int $id){
        $user = $this->getUserById($id);
        if(!$user){
            responseError('user','Usuario não encontrado');
        }
        $this->userRepository->destroyUser($user);

        return response()->json(['message' => 'Usuario removido'], 200);
    }   


    public function userChildList(int $user_id){
        return $this->userRepository->userChildList($user_id);
    }
}
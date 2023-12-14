<?php 
namespace App\Repositories\Contracts;


interface UserRepositoryInterface{

    public function getAllUsers();
    public function getUserById(int $id);
    public function getUserByUsername(string $username);
    public function registerUser(array $userInput);
    public function updateUser(object $user, array $userInput);
    public function destroyUser(object $user);
    public function userChildList(int $user_id);

}
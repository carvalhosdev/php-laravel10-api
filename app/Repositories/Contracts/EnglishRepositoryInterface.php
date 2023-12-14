<?php
namespace App\Repositories\Contracts;

interface EnglishRepositoryInterface{
    
    public function all(int $user_id);
    public function byId(int $user_id, int $id);
    public function store(array $english_input);
    public function update(object $english, array $english_input);
    public function destroy(object $english);
}
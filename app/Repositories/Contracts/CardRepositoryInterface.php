<?php 
namespace App\Repositories\Contracts;

interface CardRepositoryInterface{
    public function all(int $user_id);
    public function byId(int $user_id, int $id);
    public function store(array $card_input);
    public function update(object $card, array $card_input);
    public function destroy(object $card);
}
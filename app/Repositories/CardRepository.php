<?php 
namespace App\Repositories;

use App\Repositories\Contracts\CardRepositoryInterface;
use App\Models\Card;

class CardRepository implements CardRepositoryInterface{

    protected $entity;

    public function __construct(Card $card)
    {
        $this->entity = $card;
    }

    public function all(int $user_id){
        return $this->entity->where("user_id", $user_id)->orderBy('created_at', 'desc')->get();
    }
  
    public function byId(int $user_id, int $id){
        return $this->entity->where("user_id", $user_id)->where('id', $id)->first();
    }
  
    public function store(array $card_input)
    {
        return Card::create($card_input);
    }

    public function update(object $card, array $card_input)
    {
        return $card->update($card_input);
    }
    
    public function destroy(object $card)
    {
        return $card->delete();
    }


}

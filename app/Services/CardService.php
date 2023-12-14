<?php

namespace App\Services;

use App\Repositories\Contracts\CardRepositoryInterface;
use Illuminate\Http\Request;

class CardService {

    protected  $cardRepository;

    public function __construct(CardRepositoryInterface $cardRepository){
        $this->cardRepository = $cardRepository;
    }

    public function all(int $user_id){
        return $this->cardRepository->all($user_id);
    }

    public function byId(int $user_id, int $id){
        $card = $this->cardRepository->byId($user_id, $id);
        if(!$card){
            responseError('card', "Cartão não encontrado");
        }
        return $card;
    }
    
    
    public function store(int $user_id, array $card_input){
        $card_input['user_id'] = $user_id;
        $this->cardRepository->store($card_input);
        return response()->json([
            "message" => "Cartão salva com sucesso!"
        ], 200);
    }

    public function update(int $user_id, int $id, array $card_input){
        $card = $this->byId($user_id, $id);
        $this->cardRepository->update($card, $card_input);
        return response()->json([
            "message" => "Cartão atualizado com sucesso!"
        ], 200);
    }

    public function destroy(int $user_id, int $id){
        $card = $this->byId($user_id, $id);
        $this->cardRepository->destroy($card);
        return response()->json([
            "message" => "Cartão removido com sucesso!"
        ], 200);
    }

}
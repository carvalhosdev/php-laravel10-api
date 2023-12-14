<?php

namespace App\Services;

use App\Repositories\Contracts\CardRepositoryInterface;
use App\Repositories\Contracts\EnglishRepositoryInterface;
use Illuminate\Http\Request;

class EnglishService {

    protected  $englishRepository;
    protected  $cardRepository;

    public function __construct(
        EnglishRepositoryInterface $englishRepository,
        CardRepositoryInterface $cardRepository
        ){
        $this->englishRepository = $englishRepository;
        $this->cardRepository = $cardRepository;
    }

    public function all(int $user_id){
        return $this->englishRepository->all($user_id);
    }

    public function byId(int $user_id, int $id){
        $english =  $this->englishRepository->byId($user_id, $id);
        if(!$english){
            responseError("english", "Frase não encontrada");
        }
        return $english;
    }

    public function store(int $user_id,  array $english_input){
        
        $english_input['user_id'] = $user_id;
        $card = $this->cardRepository->byId($user_id, $english_input['card_id']);
        

        if(!$card){
            responseError('card', 'Cartão não encontrado');
        }



        $this->englishRepository->store($english_input);
        return response()->json([
            "message" => "Frase salva com sucesso!"
        ], 200);
    }

    public function update(int $user_id, int $id, array $english_input){
        $english = $this->byId($user_id, $id);

        $card = $this->cardRepository->byId($user_id, $english_input['card_id']);
        if(!$card){
            responseError('card', 'Cartão não encontrado');
        }

        $this->englishRepository->update($english, $english_input);
        return response()->json([
            "message" => "Frase atualiza com sucesso!"
        ], 200);
    }

    public function destroy(int $user_id, int $id){
        $english = $this->byId($user_id, $id);
        $this->englishRepository->destroy($english);
        return response()->json(['english' => 'Frase removida com sucesso.'], 200);

    }
}
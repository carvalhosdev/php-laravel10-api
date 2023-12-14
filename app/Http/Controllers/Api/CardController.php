<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreCardRequest;
use App\Http\Resources\CardResource;
use App\Services\CardService;
use Illuminate\Http\Request;

class CardController extends Controller
{
    //
    protected $cardService;

    public function __construct(CardService $cardService)
    {
        $this->cardService = $cardService;
    }

    public function all(Request $request){
        $cards = $this->cardService->all($request->user()->id);
        return CardResource::collection($cards);
    }

    public function byId(int $id, Request $request){
        $card = $this->cardService->byId($request->user()->id, $id);
        return new CardResource($card);
    }

    public function store(StoreCardRequest $request){
        $card = $this->cardService->store($request->user()->id, $request->all());
        return $card;
    }

    public function update(int $id, StoreCardRequest $request){
        $card = $this->cardService->update($request->user()->id, $id, $request->all());
        return $card;
    }

    public function destroy(int $id, Request $request){
        $card = $this->cardService->destroy($request->user()->id, $id);
        return $card;
    }
}

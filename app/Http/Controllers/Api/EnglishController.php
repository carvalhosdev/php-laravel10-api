<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterEnglishRequest;
use App\Http\Resources\EnglishResource;
use App\Services\EnglishService;
use Illuminate\Http\Request;

class EnglishController extends Controller
{
    //
    protected $englishService;

    public function __construct(EnglishService $englishService)
    {
        $this->englishService = $englishService;
    }

    public function all(Request $request){
        $setences = $this->englishService->all($request->user()->id);
        return EnglishResource::collection($setences);
    }

    public function byId(int $id, Request $request){
        $sentence = $this->englishService->byId($request->user()->id, $id);
        return new EnglishResource($sentence);
    }


    public function store(RegisterEnglishRequest $request){
        $english = $this->englishService->store($request->user()->id, $request->all());
        return $english;
    }

    public function update(int $id, RegisterEnglishRequest $request){
        $english = $this->englishService->update($request->user()->id, $id, $request->all());
        return $english;
    }

    public function destroy(int $id, Request $request){
        $english = $this->englishService->destroy($request->user()->id, $id);
        return $english;
    }
}

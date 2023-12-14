<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EnglishResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "phrase" => $this->phrase,
            "translate" => $this->translate,
            "explanation" => $this->explanation,
            "image" => $this->image,
            "audio" => $this->audio,
            "remember_at" => $this->remember_at,
            "card" => new CardResource($this->card)
        ];
    }
}

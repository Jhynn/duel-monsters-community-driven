<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeckResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'deck_artwork_id' => $this->deck_artwork_id,
            'card_sleeve_id' => $this->card_sleeve_id,
            'cards' => CardResource::collection($this->whenLoaded('cards')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

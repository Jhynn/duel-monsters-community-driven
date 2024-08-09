<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CardResource extends JsonResource
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
            'attribute' => AttributeResource::make($this->whenLoaded('attribute')),
            'race' => RaceResource::make($this->whenLoaded('race')),
            'types' => TypeResource::collection($this->whenLoaded('types')),
            'medias' => MediaResource::collection($this->whenLoaded('medias')),
            'deck' => $this->whenPivotLoaded('card_deck', function () {
                return $this->pivot->deck;
            }),
            'name' => $this->name,
            'description' => $this->description,
            'max_quantity' => $this->max_quantity,
            'level' => $this->level,
            'attack' => $this->attack,
            'defense' => $this->defense,
            'tributable' => $this->tributable,
            'immune' => $this->immune,
            'metadata' => $this->metadata,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

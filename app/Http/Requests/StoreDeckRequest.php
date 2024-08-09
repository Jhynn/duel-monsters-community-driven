<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDeckRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'cards' => 'required|array',
            'cards.main' => 'required|array',
            'cards.fusion' => 'sometimes|nullable|array',
            'cards.additional' => 'sometimes|nullable|array',
            'cards.main.*' => 'integer',
            'cards.fusion.*' => 'integer',
            'cards.additional.*' => 'integer',
            'description' => 'sometimes|nullable|string',
            'deck_artwork_id' => 'sometimes|nullable|integer',
            'card_sleeve_id' => 'sometimes|nullable|integer',
        ];
    }
}

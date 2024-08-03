<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCardRequest extends FormRequest
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
            'description' => 'required|string',
            'max_quantity' => 'sometimes|nullable|integer|min:1|max:3',
            'tributable' => 'sometimes|nullable|boolean',
            'immune' => 'sometimes|nullable|boolean',
            'metadata' => 'sometimes|nullable|array',
            'level' => 'sometimes|nullable|integer|min:1',
            'attack' => 'sometimes|nullable|integer|min:0',
            'defense' => 'sometimes|nullable|integer|min:0',
            'race_id' => 'sometimes|nullable|integer',
            'attribute_id' => 'sometimes|nullable|integer',
            'types' => 'sometimes|nullable|array',
            'types.*' => 'integer',
        ];
    }
}

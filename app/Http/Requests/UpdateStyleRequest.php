<?php

namespace App\Http\Requests;

use App\Models\Style;
use Illuminate\Foundation\Http\FormRequest;

class UpdateStyleRequest extends FormRequest
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
            'name' => 'sometimes|nullable|string',
            'type' => 'sometimes|nullable|string|in' . Style::$types,
            'code' => 'sometimes|nullable|string',
            'description' => 'sometimes|nullable|string',
        ];
    }
}

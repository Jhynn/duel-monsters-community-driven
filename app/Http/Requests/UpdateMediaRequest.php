<?php

namespace App\Http\Requests;

use App\Providers\AppServiceProvider;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMediaRequest extends FormRequest
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
        $types = implode(',', array_keys(AppServiceProvider::$morphMap));

        return [
            'media' => 'required|file',
            'id' => 'required|integer',
            'type' => 'required|string|in:' . $types,
        ];
    }
}

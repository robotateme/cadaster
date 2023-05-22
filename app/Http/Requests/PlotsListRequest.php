<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlotsListRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'cadastral_numbers' => ['required', 'regex:/^((\d+)(:\s*\d+){3},(\s*)?)*((\d+)(:\s*\d+){3}(\s*)?)$/']
        ];
    }
}

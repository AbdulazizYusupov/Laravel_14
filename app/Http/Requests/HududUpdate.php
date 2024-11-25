<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HududUpdate extends FormRequest
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
            'name' => 'required|max:255',
            'user_id' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Hudud name is required',
            'user_id.required' => 'Hudud user is required',
        ];
    }
}

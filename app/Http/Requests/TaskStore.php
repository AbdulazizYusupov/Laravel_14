<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskStore extends FormRequest
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
            'title' => 'required|max:255',
            'file' => 'nullable|file|mimes:jpeg,png,jpg,svg,pdf,docx,xls,xlsx|max:4096',
            'category_id' => 'required',
            'data' => 'required|date',
            'hududs' => 'required|array',
            'hududs.*' => 'exists:hududs,id',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'title.required' => 'The title field is required.',
            'file.required' => 'The file field is required.',
            'file.mimes' => 'The file must be a file of type: jpeg, png, jpg, svg, pdf, docx, xls, xlsx.',
            'file.max' => 'The file may not be greater than 4MB.',
            'category_id.required' => 'The category field is required.',
            'data.required' => 'The data field is required.',
            'hududs.required' => 'The hududs field is required.',
        ];
    }
}

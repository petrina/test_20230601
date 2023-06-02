<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|max:255',
            'content' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'The title field is required.',
            'title.max' => 'The title may not be greater than :max characters.',
            'content.required' => 'The content field is required.',
        ];
    }
}

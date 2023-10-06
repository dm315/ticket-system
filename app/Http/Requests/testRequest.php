<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class testRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'min:8', 'image', 'mimetypes:jpeg,png,jpg', 'max:4096'],
            'test' => 'digits:11|nullable|numeric|regex:^(\+98|98|0)9\d{9}$',
            'url' => 'bool|unique:roles,title',
        ];
    }
}

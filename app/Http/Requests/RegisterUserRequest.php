<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
        /**
         * Faz a validação dos dados inseridos no AuthController
         */
        return [
            
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string'],
            'password' => ['required', 'min:6', 'confirmed'],
            'user_type_id' => ['required', 'int', 'between:1,2', 'exists:user_types,id'] 

        ];
    }
}

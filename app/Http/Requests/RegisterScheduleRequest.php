<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterScheduleRequest extends FormRequest
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

            'client_id' => ['required', 'int', 'exists:clients,id'],
            'start_date' => ['required', 'date'],
            'type' => ['required', 'string', 'max:50']
            // 'end_date' => ['nullable', 'date']
            
        ];
    }
}

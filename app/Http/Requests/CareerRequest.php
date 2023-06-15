<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CareerRequest extends FormRequest
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
            'email' => 'required|email',
            'role' => ['required', Rule::in(['writer','revisor','admin'])],
            'msg' => 'required|max:150',
        ];
    }

    public function messages(){
        return [
            'email.required' => "L'email è richiesta",
            'email.email' => 'Il formato della email non è valido',
            'role' => 'Selezionare una scelta valida',
            'msg.required' => 'La presentazione è richiesta',
            'msg.max' => 'Inserire al massimo 150 caratteri',
        ];
    }
}

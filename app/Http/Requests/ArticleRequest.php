<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'title' => 'required|min:5',
            'subtitle' => 'required|min:5',
            'id' => Rule::exists(Category::class),
            'body' => 'required|min:10',
            'image' => 'required|mimes:jpg,bmp,png',
        ];
    }

    public function messages(){
        return [
            'title.required' => 'Il titolo è richiesto',
            'title.min' => 'Il titolo deve contenere almeno 5 caratteri',
            'subtitle.required' => 'Il sottotitolo è richiesto',
            'subtitle.min' => 'Il sottotitolo deve contenere almeno 5 caratteri',
            'id.exists' => 'Scelta non valida',
            'body.required' => 'Il body è richiesto',
            'body.min' => 'Il body deve contenere almeno 10 caratteri',
            'image.required' => "L'immagine è richiesta",
            'image.mimes' => "Il formato non è valido, (formati validi: jpg, bmp e png)",
        ];
    }
}

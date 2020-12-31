<?php

namespace App\Http\Requests\Notary;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|min:5',
            'email' => 'nullable',
            'phone' => 'nullable|max:11',
            'description' => 'nullable|min:5'
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Поле обязательное к заполнению',
            'title.min' => 'В названии должно быть минимум 5 символов',
        ];
    }
}

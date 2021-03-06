<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
{
    /**
     * @var mixed
     */
    private $id;

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
            'id'                => 'required|numeric',
            'name'              => 'required|string',
            'email'             => 'required|email|unique:users,email,' . $this->id,
            'password'          => 'nullable|string|min:8|confirmed',
            'current_password'  => 'nullable|string|min:8',
            'role'              => 'required|numeric',
        ];
    }
}

<?php

namespace App\Http\Requests\Role;

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
            'name'          => 'required|string|unique:roles,name,' . $this->id,
            'description'   => 'nullable|string',
            'permissions'   => 'nullable|array',
        ];
    }
}

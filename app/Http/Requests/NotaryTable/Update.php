<?php

namespace App\Http\Requests\NotaryTable;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
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
            'number_loan' => 'required|unique:notaries_table,number_loan,' . $this->id,
            'iin' => 'required',
            'identification' => 'required|unique:notaries_table,identification,' . $this->id,
            'full_name' => 'required',
            'email' => 'nullable',
            'home_phone' => 'nullable',
            'mobile_phone' => 'required',
            'work_phone' => 'nullable',
            'residence_address' => 'nullable',
            'place_of_residence' => 'nullable',
            'date_of_issue' => 'required',
            'loan_term' => 'required',
            'issued_amount' => 'required',
            'number_of_day_overdue' => 'required',
            'delayed_od' => 'required',
            'delayed_prc' => 'required',
            'delayed_fines' => 'required',
            'total' => 'nullable',
            'notary_cost' => 'nullable',
            'total_with_notary_cost' => 'nullable',
        ];
    }
}

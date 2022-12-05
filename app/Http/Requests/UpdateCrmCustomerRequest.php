<?php

namespace App\Http\Requests;

use App\Models\CrmCustomer;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCrmCustomerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('crm_customer_edit');
    }

    public function rules()
    {
        return [
            'first_name' => [
                'string',
                'required',
            ],
            'last_name' => [
                'string',
                'required',
            ],
            'email' => [
                'string',
                'required',
            ],
            'phone' => [
                'string',
                'required',
            ],
            'cellphone' => [
                'string',
                'nullable',
            ],
            'other_phone' => [
                'string',
                'nullable',
            ],
            'address' => [
                'string',
                'required',
            ],
            'city' => [
                'string',
                'required',
            ],
            'country' => [
                'string',
                'max:2',
                'required',
            ],
            'state' => [
                'string',
                'required',
            ],
            'zip_code' => [
                'string',
                'required',
            ],
            'file_code' => [
                'string',
                'nullable',
            ],
            'w2_employees' => [
                'string',
                'nullable',
            ],
            'receive_erc' => [
                'string',
                'nullable',
            ],
            'ppp_loan' => [
                'string',
                'nullable',
            ],
            'employee_count' => [
                'string',
                'nullable',
            ],
            'first_name_verified' => [
                'string',
                'nullable',
            ],
            'last_name_verified' => [
                'string',
                'nullable',
            ],
            'custom_field_1' => [
                'string',
                'nullable',
            ],
            'custom_field_2' => [
                'string',
                'nullable',
            ],
            'custom_field_3' => [
                'string',
                'nullable',
            ],
            'custom_field_4' => [
                'string',
                'nullable',
            ],
            'custom_field_5' => [
                'string',
                'nullable',
            ],
            'custom_field_6' => [
                'string',
                'nullable',
            ],
            'custom_field_7' => [
                'string',
                'nullable',
            ],
            'custom_field_8' => [
                'string',
                'nullable',
            ],
            'custom_field_9' => [
                'string',
                'nullable',
            ],
            'custom_field_10' => [
                'string',
                'nullable',
            ],
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Models\CrmCustomer;
use Illuminate\Http\Response;

class StoreAPICrmCustomerRequest 
{
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

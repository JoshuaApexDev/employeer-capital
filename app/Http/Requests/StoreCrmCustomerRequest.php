<?php

namespace App\Http\Requests;

use App\Models\CrmCustomer;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCrmCustomerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('crm_customer_create');
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
                'unique:crm_customers',
            ],
            'phone' => [
                'string',
                'required',
                'unique:crm_customers',
            ],
            'address' => [
                'string',
                'required',
            ],
            'age' => [
                'required',
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'gender' => [
                'required',
            ],
            'date_of_birth' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'nationality' => [
                'string',
                'required',
            ],
            'curp' => [
                'string',
                'nullable',
            ],
            'rfc' => [
                'string',
                'nullable',
            ],
            'ssn' => [
                'string',
                'nullable',
            ],
            'chronic_illness' => [
                'string',
                'nullable',
            ],
            'elementary_school_name' => [
                'string',
                'nullable',
            ],
            'elementary_graduate_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'middle_school_name' => [
                'string',
                'nullable',
            ],
            'middle_school_graduate_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'high_school_name' => [
                'string',
                'nullable',
            ],
            'high_school_graduate_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'college_name' => [
                'string',
                'nullable',
            ],
            'college_graduate_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'career' => [
                'string',
                'nullable',
            ],
            'father_name' => [
                'string',
                'nullable',
            ],
            'father_age' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'mother_name' => [
                'string',
                'nullable',
            ],
            'mother_age' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'emergency_contact_name' => [
                'string',
                'nullable',
            ],
            'emergency_contact_relationship' => [
                'string',
                'nullable',
            ],
            'reference_name_1' => [
                'string',
                'nullable',
            ],
            'reference_relationship_1' => [
                'string',
                'nullable',
            ],
            'reference_phone_1' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'reference_name_2' => [
                'string',
                'nullable',
            ],
            'reference_relationship_2' => [
                'string',
                'nullable',
            ],
            'reference_phone_2' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'reference_name_3' => [
                'string',
                'nullable',
            ],
            'reference_relationship_3' => [
                'string',
                'nullable',
            ],
            'reference_phone_3' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'company_name_1' => [
                'required',
                'string',
                'nullable',
            ],
            'company_phone_1' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'worked_from_1' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'worked_until_1' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'reason_for_leaving_1' => [
                'string',
                'nullable',
            ],
            'company_name_2' => [
                'string',
                'nullable',
            ],
            'company_phone_2' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'worked_from_2' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'worked_until_2' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'reason_for_leaving_2' => [
                'string',
                'nullable',
            ],
            'when_start' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'additional_comments' => [
                'string',
                'nullable',
            ],
            'position_id' => [
                'required',
                'integer',
            ],
            'infonavit_credit' => [
                'string',
                'nullable',
            ],
            'how_you_knew' => [
                'string',
                'nullable',
            ],
        ];
    }
}

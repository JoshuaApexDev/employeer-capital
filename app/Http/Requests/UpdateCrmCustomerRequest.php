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
            'verify_employee_count' => [
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
            'employee_amount' => [
                'string',
                'nullable',
            ],
            'payroll_amount' => [
                'string',
                'nullable',
            ],
            'erc_amount' => [
                'string',
                'nullable',
            ],
            'erc_advance' => [
                'string',
                'nullable',
            ],
            'deal_revenue' => [
                'string',
                'nullable',
            ],
            'contingency_fee' => [
                'string',
                'nullable',
            ],
            'was_your_business_operational' => [
                'string',
                'nullable',
            ],
            'full_time_operational_employees' => [
                'numeric',
                'nullable',
            ],
            'hm_w2_employees' => [
                'numeric',
                'nullable',
            ],
            'is_your_business_a_restaurant' => [
                'string',
                'nullable',
            ],
            'periods_when_suspended' => [
                'array',
                'nullable',
            ],
            'company_name' => [
                'string',
                'nullable',
            ],
            'quarter_with_declined_gross' => [
                'string',
                'nullable',
            ],
            'q1_2021_vs_q1_2019' => [
                'string',
                'nullable',
            ],
            'q3_2021_vs_q3_2019' => [
                'string',
                'nullable',
            ],
            'q2_2021_vs_q2_2019' => [
                'string',
                'nullable',
            ],
            'q4_2021_vs_q4_2019' => [
                'string',
                'nullable',
            ],
            'total_dollar_amount_ppp_loan_received_2020' => [
                'string',
                'nullable',
            ],
            'total_dollar_amount_ppp_loan_received_2021' => [
                'string',
                'nullable',
            ],
            'total_payroll_2020' => [
                'string',
                'nullable',
            ],
            'requested_documents' => [
                'array',
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

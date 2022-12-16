<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CrmCustomer extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const W2_EMPLOYEES_SELECT = [
        'yes' => 'Yes',
        'no'  => 'No',
    ];

    public const RECEIVE_ERC_SELECT = [
        'yes' => 'Yes',
        'no'  => 'No',
    ];

    public const PPP_LOAN_SELECT = [
        'yes' => 'Yes',
        'no'  => 'No',
    ];

    public const WAS_YOUR_BUSINESS_OPERATIONAL_SELECT = [
        'yes' => 'Yes',
        'no'  => 'No',
    ];

    public const IS_YOUR_BUSINESS_A_RESTAURANT_SELECT = [
        'yes' => 'Yes',
        'no'  => 'No',
    ];

    public const PERIODS_WHEN_SUSPENDED_SELECT = [
        '1q-20' => '1Q-2020',
        '2q-20' => '2Q-2020',
        '3q-20' => '3Q-2020',
        '4q-20' => '4Q-2020',
        '1q-21' => '1Q-2021',
        '2q-21' => '2Q-2021',
        '3q-21' => '3Q-2021',
        '4q-21' => '4Q-2021',
    ];

    public const QUARTER_WITH_DECLINED_GROSS_SELECT = [
        'yes' => 'Yes',
        'no'  => 'No',
    ];

    public const Q1_2021_VS_Q1_2019_SELECT = [
        'yes' => 'Yes',
        'no'  => 'No',
    ];

    public const Q3_2021_VS_Q3_2019_SELECT = [
        'yes' => 'Yes',
        'no'  => 'No',
    ];

    public const Q2_2021_VS_Q2_2019_SELECT = [
        'yes' => 'Yes',
        'no'  => 'No',
    ];

    public const Q4_2021_VS_Q4_2019_SELECT = [
        'yes' => 'Yes',
        'no'  => 'No',
    ];


    public const LIVED_IN_USA_SELECT = [
        'yes' => 'Yes/Si',
        'no'  => 'No/No',
    ];

    public const SPEAK_ENGLISH_SELECT = [
        'yes' => 'Yes/Si',
        'no'  => 'No/No',
    ];

    public const COVID_VACCINE_SELECT = [
        'yes' => 'Yes/Si',
        'no'  => 'No/No',
    ];

    public const GENDER_SELECT = [
        'male'   => 'Male/Masculino',
        'female' => 'Female/Femenino',
        'other'  => 'Other/Otro',
    ];

    public const HAVE_HAD_COVID_SELECT = [
        'yes'     => 'Yes/Si',
        'no'      => 'No/No',
        'notsure' => 'Not sure/No estoy seguro',
    ];

    public const HEALTH_STATUS_SELECT = [
        'good'    => 'Good/Bueno',
        'regular' => 'Regular/Regular',
        'bad'     => 'Bad/Malo',
    ];

    public const MARITAL_STATUS_SELECT = [
        'single'  => 'Single/Soltero',
        'married' => 'Married/Casado',
        'other'   => 'Other',
    ];

    public const ENGLISH_LEVEL_SELECT = [
        'excellent' => 'Excellent/Excelente',
        'good'      => 'Good/Bueno',
        'regular'   => 'Regular/Regular',
        'none'      => 'None/Nada',
    ];

    public const WRITTEN_ENGLISH_SELECT = [
        'excellent' => 'Excellent/Excelente',
        'good'      => 'Good/Bueno',
        'regular'   => 'Regular/Regular',
        'none'      => 'None/Nada',
    ];

    public const DEPENDENTS_SELECT = [
        'children' => 'Children/Hijos',
        'spouse'   => 'Spouse/Esposa',
        'parents'  => 'Parents/Padres',
        'others'   => 'Others/Otros',
    ];

    public const LIVING_WITH_SELECT = [
        'parents'   => 'Parents/Padres',
        'family'    => 'Family/Familia',
        'relatives' => 'Relatives/Parientes',
        'alone'     => 'Alone/Solo',
    ];

    public $table = 'crm_customers';

    protected $dates = [
        'date_of_birth',
        'elementary_graduate_date',
        'middle_school_graduate_date',
        'high_school_graduate_date',
        'college_graduate_date',
        'worked_from_1',
        'worked_until_1',
        'worked_from_2',
        'worked_until_2',
        'when_start',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'cellphone',
        'other_phone',
        'address',
        'company_name',
        'city',
        'country',
        'state',
        'zip_code',
        'file_code',
        'w2_employees',
        'receive_erc',
        'ppp_loan',
        'employee_count',
        'verify_employee_count',
        'first_name_verified',
        'last_name_verified',
        'employee_amount',
        'payroll_amount',
        'erc_amount',
        'erc_advance',
        'deal_revenue',
        'contingency_fee',
        'was_your_business_operational',
        'full_time_operational_employees',
        'hm_w2_employees',
        'is_your_business_a_restaurant',
        'periods_when_suspended',
        'quarter_with_declined_gross',
        'q1_2021_vs_q1_2019',
        'q3_2021_vs_q3_2019',
        'q2_2021_vs_q2_2019',
        'q4_2021_vs_q4_2019',
        'total_dollar_amount_ppp_loan_received_2020',
        'total_dollar_amount_ppp_loan_received_2021',
        'total_payroll_2020',
        'custom_field_1',
        'custom_field_2',
        'custom_field_3',
        'custom_field_4',
        'custom_field_5',
        'custom_field_6',
        'custom_field_7',
        'custom_field_8',
        'custom_field_9',
        'custom_field_10',
        'status_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'user_id',
        'requested_documents',
    ];

    public function owner(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function leadTasks()
    {
        return $this->hasMany(Task::class, 'lead_id', 'id');
    }

    public function leadNotes()
    {
        return $this->hasMany(CrmNote::class, 'customer_id', 'id');
    }

    public function documents()
    {
        return $this->hasMany(CrmDocument::class, 'customer_id', 'id');
    }

    public function getDateOfBirthAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateOfBirthAttribute($value)
    {
        $this->attributes['date_of_birth'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getElementaryGraduateDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setElementaryGraduateDateAttribute($value)
    {
        $this->attributes['elementary_graduate_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getMiddleSchoolGraduateDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setMiddleSchoolGraduateDateAttribute($value)
    {
        $this->attributes['middle_school_graduate_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getHighSchoolGraduateDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setHighSchoolGraduateDateAttribute($value)
    {
        $this->attributes['high_school_graduate_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getCollegeGraduateDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setCollegeGraduateDateAttribute($value)
    {
        $this->attributes['college_graduate_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getWorkedFrom1Attribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setWorkedFrom1Attribute($value)
    {
        $this->attributes['worked_from_1'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getWorkedUntil1Attribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setWorkedUntil1Attribute($value)
    {
        $this->attributes['worked_until_1'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getWorkedFrom2Attribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setWorkedFrom2Attribute($value)
    {
        $this->attributes['worked_from_2'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getWorkedUntil2Attribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setWorkedUntil2Attribute($value)
    {
        $this->attributes['worked_until_2'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getWhenStartAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setWhenStartAttribute($value)
    {
        $this->attributes['when_start'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function status()
    {
        return $this->belongsTo(CrmStatus::class, 'status_id');
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}

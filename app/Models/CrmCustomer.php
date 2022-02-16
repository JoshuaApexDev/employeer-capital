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
        'address',
        'description',
        'age',
        'gender',
        'living_with',
        'dependents',
        'date_of_birth',
        'nationality',
        'marital_status',
        'curp',
        'rfc',
        'ssn',
        'health_status',
        'chronic_illness',
        'goal_in_life',
        'elementary_school_name',
        'elementary_graduate_date',
        'middle_school_name',
        'middle_school_graduate_date',
        'high_school_name',
        'high_school_graduate_date',
        'college_name',
        'college_graduate_date',
        'career',
        'lived_in_usa',
        'speak_english',
        'english_level',
        'written_english',
        'father_name',
        'father_age',
        'mother_name',
        'mother_age',
        'emergency_contact_name',
        'emergency_contact_relationship',
        'reference_name_1',
        'reference_relationship_1',
        'reference_phone_1',
        'reference_name_2',
        'reference_relationship_2',
        'reference_phone_2',
        'reference_name_3',
        'reference_relationship_3',
        'reference_phone_3',
        'company_name_1',
        'company_phone_1',
        'worked_from_1',
        'worked_until_1',
        'reason_for_leaving_1',
        'company_name_2',
        'company_phone_2',
        'worked_from_2',
        'worked_until_2',
        'reason_for_leaving_2',
        'office_skills',
        'when_start',
        'status_id',
        'official_valid',
        'birth_certificate',
        'have_curp',
        'have_rfc',
        'have_had_covid',
        'covid_vaccine',
        'additional_comments',
        'imss_number',
        'proof_of_residence',
        'highschool_diploma',
        'position_id',
        'infonavit_credit',
        'payment_method',
        'how_you_knew',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function leadTasks()
    {
        return $this->hasMany(Task::class, 'lead_id', 'id');
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

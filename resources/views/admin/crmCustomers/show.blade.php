@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.crmCustomer.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.crm-customers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
                <a class="btn btn-warning" href="print/{{$crmCustomer->id}}">
                    Print
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.id') }}
                        </th>
                        <td>
                            {{ $crmCustomer->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.first_name') }}
                        </th>
                        <td>
                            {{ $crmCustomer->first_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.last_name') }}
                        </th>
                        <td>
                            {{ $crmCustomer->last_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.email') }}
                        </th>
                        <td>
                            {{ $crmCustomer->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.phone') }}
                        </th>
                        <td>
                            {{ $crmCustomer->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.address') }}
                        </th>
                        <td>
                            {{ $crmCustomer->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.description') }}
                        </th>
                        <td>
                            {{ $crmCustomer->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.age') }}
                        </th>
                        <td>
                            {{ $crmCustomer->age }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.gender') }}
                        </th>
                        <td>
                            {{ App\Models\CrmCustomer::GENDER_SELECT[$crmCustomer->gender] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.living_with') }}
                        </th>
                        <td>
                            {{ App\Models\CrmCustomer::LIVING_WITH_SELECT[$crmCustomer->living_with] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.dependents') }}
                        </th>
                        <td>
                            {{ App\Models\CrmCustomer::DEPENDENTS_SELECT[$crmCustomer->dependents] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.date_of_birth') }}
                        </th>
                        <td>
                            {{ $crmCustomer->date_of_birth }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.nationality') }}
                        </th>
                        <td>
                            {{ $crmCustomer->nationality }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.marital_status') }}
                        </th>
                        <td>
                            {{ App\Models\CrmCustomer::MARITAL_STATUS_SELECT[$crmCustomer->marital_status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.curp') }}
                        </th>
                        <td>
                            {{ $crmCustomer->curp }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.rfc') }}
                        </th>
                        <td>
                            {{ $crmCustomer->rfc }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.ssn') }}
                        </th>
                        <td>
                            {{ $crmCustomer->ssn }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.health_status') }}
                        </th>
                        <td>
                            {{ App\Models\CrmCustomer::HEALTH_STATUS_SELECT[$crmCustomer->health_status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.chronic_illness') }}
                        </th>
                        <td>
                            {{ $crmCustomer->chronic_illness }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.goal_in_life') }}
                        </th>
                        <td>
                            {{ $crmCustomer->goal_in_life }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.elementary_school_name') }}
                        </th>
                        <td>
                            {{ $crmCustomer->elementary_school_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.elementary_graduate_date') }}
                        </th>
                        <td>
                            {{ $crmCustomer->elementary_graduate_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.middle_school_name') }}
                        </th>
                        <td>
                            {{ $crmCustomer->middle_school_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.middle_school_graduate_date') }}
                        </th>
                        <td>
                            {{ $crmCustomer->middle_school_graduate_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.high_school_name') }}
                        </th>
                        <td>
                            {{ $crmCustomer->high_school_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.high_school_graduate_date') }}
                        </th>
                        <td>
                            {{ $crmCustomer->high_school_graduate_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.college_name') }}
                        </th>
                        <td>
                            {{ $crmCustomer->college_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.college_graduate_date') }}
                        </th>
                        <td>
                            {{ $crmCustomer->college_graduate_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.career') }}
                        </th>
                        <td>
                            {{ $crmCustomer->career }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.lived_in_usa') }}
                        </th>
                        <td>
                            {{ App\Models\CrmCustomer::LIVED_IN_USA_SELECT[$crmCustomer->lived_in_usa] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.speak_english') }}
                        </th>
                        <td>
                            {{ App\Models\CrmCustomer::SPEAK_ENGLISH_SELECT[$crmCustomer->speak_english] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.english_level') }}
                        </th>
                        <td>
                            {{ App\Models\CrmCustomer::ENGLISH_LEVEL_SELECT[$crmCustomer->english_level] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.written_english') }}
                        </th>
                        <td>
                            {{ App\Models\CrmCustomer::WRITTEN_ENGLISH_SELECT[$crmCustomer->written_english] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.father_name') }}
                        </th>
                        <td>
                            {{ $crmCustomer->father_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.father_age') }}
                        </th>
                        <td>
                            {{ $crmCustomer->father_age }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.mother_name') }}
                        </th>
                        <td>
                            {{ $crmCustomer->mother_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.mother_age') }}
                        </th>
                        <td>
                            {{ $crmCustomer->mother_age }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.emergency_contact_name') }}
                        </th>
                        <td>
                            {{ $crmCustomer->emergency_contact_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.emergency_contact_relationship') }}
                        </th>
                        <td>
                            {{ $crmCustomer->emergency_contact_relationship }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.reference_name_1') }}
                        </th>
                        <td>
                            {{ $crmCustomer->reference_name_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.reference_relationship_1') }}
                        </th>
                        <td>
                            {{ $crmCustomer->reference_relationship_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.reference_phone_1') }}
                        </th>
                        <td>
                            {{ $crmCustomer->reference_phone_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.reference_name_2') }}
                        </th>
                        <td>
                            {{ $crmCustomer->reference_name_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.reference_relationship_2') }}
                        </th>
                        <td>
                            {{ $crmCustomer->reference_relationship_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.reference_phone_2') }}
                        </th>
                        <td>
                            {{ $crmCustomer->reference_phone_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.reference_name_3') }}
                        </th>
                        <td>
                            {{ $crmCustomer->reference_name_3 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.reference_relationship_3') }}
                        </th>
                        <td>
                            {{ $crmCustomer->reference_relationship_3 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.reference_phone_3') }}
                        </th>
                        <td>
                            {{ $crmCustomer->reference_phone_3 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.company_name_1') }}
                        </th>
                        <td>
                            {{ $crmCustomer->company_name_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.company_phone_1') }}
                        </th>
                        <td>
                            {{ $crmCustomer->company_phone_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.worked_from_1') }}
                        </th>
                        <td>
                            {{ $crmCustomer->worked_from_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.worked_until_1') }}
                        </th>
                        <td>
                            {{ $crmCustomer->worked_until_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.reason_for_leaving_1') }}
                        </th>
                        <td>
                            {{ $crmCustomer->reason_for_leaving_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.company_name_2') }}
                        </th>
                        <td>
                            {{ $crmCustomer->company_name_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.company_phone_2') }}
                        </th>
                        <td>
                            {{ $crmCustomer->company_phone_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.worked_from_2') }}
                        </th>
                        <td>
                            {{ $crmCustomer->worked_from_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.worked_until_2') }}
                        </th>
                        <td>
                            {{ $crmCustomer->worked_until_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.reason_for_leaving_2') }}
                        </th>
                        <td>
                            {{ $crmCustomer->reason_for_leaving_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.office_skills') }}
                        </th>
                        <td>
                            {{ $crmCustomer->office_skills }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.when_start') }}
                        </th>
                        <td>
                            {{ $crmCustomer->when_start }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.status') }}
                        </th>
                        <td>
                            {{ $crmCustomer->status->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.official_valid') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $crmCustomer->official_valid ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.birth_certificate') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $crmCustomer->birth_certificate ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.have_curp') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $crmCustomer->have_curp ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.have_rfc') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $crmCustomer->have_rfc ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.have_had_covid') }}
                        </th>
                        <td>
                            {{ App\Models\CrmCustomer::HAVE_HAD_COVID_SELECT[$crmCustomer->have_had_covid] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.covid_vaccine') }}
                        </th>
                        <td>
                            {{ App\Models\CrmCustomer::COVID_VACCINE_SELECT[$crmCustomer->covid_vaccine] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.additional_comments') }}
                        </th>
                        <td>
                            {{ $crmCustomer->additional_comments }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.imss_number') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $crmCustomer->imss_number ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.proof_of_residence') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $crmCustomer->proof_of_residence ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.highschool_diploma') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $crmCustomer->highschool_diploma ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.position') }}
                        </th>
                        <td>
                            {{ $crmCustomer->position->position_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.infonavit_credit') }}
                        </th>
                        <td>
                            {{ $crmCustomer->infonavit_credit }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.payment_method') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $crmCustomer->payment_method ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.how_you_knew') }}
                        </th>
                        <td>
                            {{ $crmCustomer->how_you_knew }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.crm-customers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#lead_tasks" role="tab" data-toggle="tab">
                {{ trans('cruds.task.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="lead_tasks">
            @includeIf('admin.crmCustomers.relationships.leadTasks', ['tasks' => $crmCustomer->leadTasks])
        </div>
    </div>
</div>

@endsection

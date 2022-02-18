@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.crmCustomer.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.crm-customers.update", [$crmCustomer->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="first_name">{{ trans('cruds.crmCustomer.fields.first_name') }}</label>
                <input class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" type="text" name="first_name" id="first_name" value="{{ old('first_name', $crmCustomer->first_name) }}" required>
                @if($errors->has('first_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('first_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.first_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="last_name">{{ trans('cruds.crmCustomer.fields.last_name') }}</label>
                <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text" name="last_name" id="last_name" value="{{ old('last_name', $crmCustomer->last_name) }}" required>
                @if($errors->has('last_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('last_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.last_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="email">{{ trans('cruds.crmCustomer.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email', $crmCustomer->email) }}" required>
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="phone">{{ trans('cruds.crmCustomer.fields.phone') }}</label>
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', $crmCustomer->phone) }}" required>
                @if($errors->has('phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="address">{{ trans('cruds.crmCustomer.fields.address') }}</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', $crmCustomer->address) }}" required>
                @if($errors->has('address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.crmCustomer.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description', $crmCustomer->description) }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="age">{{ trans('cruds.crmCustomer.fields.age') }}</label>
                <input class="form-control {{ $errors->has('age') ? 'is-invalid' : '' }}" type="number" name="age" id="age" value="{{ old('age', $crmCustomer->age) }}" step="1" required>
                @if($errors->has('age'))
                    <div class="invalid-feedback">
                        {{ $errors->first('age') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.age_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.crmCustomer.fields.gender') }}</label>
                <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender" id="gender" required>
                    <option value disabled {{ old('gender', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\CrmCustomer::GENDER_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('gender', $crmCustomer->gender) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('gender'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gender') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.gender_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.crmCustomer.fields.living_with') }}</label>
                <select class="form-control {{ $errors->has('living_with') ? 'is-invalid' : '' }}" name="living_with" id="living_with">
                    <option value disabled {{ old('living_with', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\CrmCustomer::LIVING_WITH_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('living_with', $crmCustomer->living_with) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('living_with'))
                    <div class="invalid-feedback">
                        {{ $errors->first('living_with') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.living_with_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.crmCustomer.fields.dependents') }}</label>
                <select class="form-control {{ $errors->has('dependents') ? 'is-invalid' : '' }}" name="dependents" id="dependents">
                    <option value disabled {{ old('dependents', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\CrmCustomer::DEPENDENTS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('dependents', $crmCustomer->dependents) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('dependents'))
                    <div class="invalid-feedback">
                        {{ $errors->first('dependents') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.dependents_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date_of_birth">{{ trans('cruds.crmCustomer.fields.date_of_birth') }}</label>
                <input class="form-control date {{ $errors->has('date_of_birth') ? 'is-invalid' : '' }}" type="text" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth', $crmCustomer->date_of_birth) }}" required>
                @if($errors->has('date_of_birth'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_of_birth') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.date_of_birth_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="nationality">{{ trans('cruds.crmCustomer.fields.nationality') }}</label>
                <input class="form-control {{ $errors->has('nationality') ? 'is-invalid' : '' }}" type="text" name="nationality" id="nationality" value="{{ old('nationality', $crmCustomer->nationality) }}" required>
                @if($errors->has('nationality'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nationality') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.nationality_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.crmCustomer.fields.marital_status') }}</label>
                <select class="form-control {{ $errors->has('marital_status') ? 'is-invalid' : '' }}" name="marital_status" id="marital_status">
                    <option value disabled {{ old('marital_status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\CrmCustomer::MARITAL_STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('marital_status', $crmCustomer->marital_status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('marital_status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('marital_status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.marital_status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="curp">{{ trans('cruds.crmCustomer.fields.curp') }}</label>
                <input class="form-control {{ $errors->has('curp') ? 'is-invalid' : '' }}" type="text" name="curp" id="curp" value="{{ old('curp', $crmCustomer->curp) }}">
                @if($errors->has('curp'))
                    <div class="invalid-feedback">
                        {{ $errors->first('curp') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.curp_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="rfc">{{ trans('cruds.crmCustomer.fields.rfc') }}</label>
                <input class="form-control {{ $errors->has('rfc') ? 'is-invalid' : '' }}" type="text" name="rfc" id="rfc" value="{{ old('rfc', $crmCustomer->rfc) }}">
                @if($errors->has('rfc'))
                    <div class="invalid-feedback">
                        {{ $errors->first('rfc') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.rfc_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ssn">{{ trans('cruds.crmCustomer.fields.ssn') }}</label>
                <input class="form-control {{ $errors->has('ssn') ? 'is-invalid' : '' }}" type="text" name="ssn" id="ssn" value="{{ old('ssn', $crmCustomer->ssn) }}">
                @if($errors->has('ssn'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ssn') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.ssn_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.crmCustomer.fields.health_status') }}</label>
                <select class="form-control {{ $errors->has('health_status') ? 'is-invalid' : '' }}" name="health_status" id="health_status">
                    <option value disabled {{ old('health_status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\CrmCustomer::HEALTH_STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('health_status', $crmCustomer->health_status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('health_status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('health_status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.health_status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="chronic_illness">{{ trans('cruds.crmCustomer.fields.chronic_illness') }}</label>
                <input class="form-control {{ $errors->has('chronic_illness') ? 'is-invalid' : '' }}" type="text" name="chronic_illness" id="chronic_illness" value="{{ old('chronic_illness', $crmCustomer->chronic_illness) }}">
                @if($errors->has('chronic_illness'))
                    <div class="invalid-feedback">
                        {{ $errors->first('chronic_illness') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.chronic_illness_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="goal_in_life">{{ trans('cruds.crmCustomer.fields.goal_in_life') }}</label>
                <textarea class="form-control {{ $errors->has('goal_in_life') ? 'is-invalid' : '' }}" name="goal_in_life" id="goal_in_life">{{ old('goal_in_life', $crmCustomer->goal_in_life) }}</textarea>
                @if($errors->has('goal_in_life'))
                    <div class="invalid-feedback">
                        {{ $errors->first('goal_in_life') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.goal_in_life_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="elementary_school_name">{{ trans('cruds.crmCustomer.fields.elementary_school_name') }}</label>
                <input class="form-control {{ $errors->has('elementary_school_name') ? 'is-invalid' : '' }}" type="text" name="elementary_school_name" id="elementary_school_name" value="{{ old('elementary_school_name', $crmCustomer->elementary_school_name) }}">
                @if($errors->has('elementary_school_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('elementary_school_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.elementary_school_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="elementary_graduate_date">{{ trans('cruds.crmCustomer.fields.elementary_graduate_date') }}</label>
                <input class="form-control date {{ $errors->has('elementary_graduate_date') ? 'is-invalid' : '' }}" type="text" name="elementary_graduate_date" id="elementary_graduate_date" value="{{ old('elementary_graduate_date', $crmCustomer->elementary_graduate_date) }}">
                @if($errors->has('elementary_graduate_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('elementary_graduate_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.elementary_graduate_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="middle_school_name">{{ trans('cruds.crmCustomer.fields.middle_school_name') }}</label>
                <input class="form-control {{ $errors->has('middle_school_name') ? 'is-invalid' : '' }}" type="text" name="middle_school_name" id="middle_school_name" value="{{ old('middle_school_name', $crmCustomer->middle_school_name) }}">
                @if($errors->has('middle_school_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('middle_school_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.middle_school_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="middle_school_graduate_date">{{ trans('cruds.crmCustomer.fields.middle_school_graduate_date') }}</label>
                <input class="form-control date {{ $errors->has('middle_school_graduate_date') ? 'is-invalid' : '' }}" type="text" name="middle_school_graduate_date" id="middle_school_graduate_date" value="{{ old('middle_school_graduate_date', $crmCustomer->middle_school_graduate_date) }}">
                @if($errors->has('middle_school_graduate_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('middle_school_graduate_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.middle_school_graduate_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="high_school_name">{{ trans('cruds.crmCustomer.fields.high_school_name') }}</label>
                <input class="form-control {{ $errors->has('high_school_name') ? 'is-invalid' : '' }}" type="text" name="high_school_name" id="high_school_name" value="{{ old('high_school_name', $crmCustomer->high_school_name) }}">
                @if($errors->has('high_school_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('high_school_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.high_school_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="high_school_graduate_date">{{ trans('cruds.crmCustomer.fields.high_school_graduate_date') }}</label>
                <input class="form-control date {{ $errors->has('high_school_graduate_date') ? 'is-invalid' : '' }}" type="text" name="high_school_graduate_date" id="high_school_graduate_date" value="{{ old('high_school_graduate_date', $crmCustomer->high_school_graduate_date) }}">
                @if($errors->has('high_school_graduate_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('high_school_graduate_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.high_school_graduate_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="college_name">{{ trans('cruds.crmCustomer.fields.college_name') }}</label>
                <input class="form-control {{ $errors->has('college_name') ? 'is-invalid' : '' }}" type="text" name="college_name" id="college_name" value="{{ old('college_name', $crmCustomer->college_name) }}">
                @if($errors->has('college_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('college_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.college_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="college_graduate_date">{{ trans('cruds.crmCustomer.fields.college_graduate_date') }}</label>
                <input class="form-control date {{ $errors->has('college_graduate_date') ? 'is-invalid' : '' }}" type="text" name="college_graduate_date" id="college_graduate_date" value="{{ old('college_graduate_date', $crmCustomer->college_graduate_date) }}">
                @if($errors->has('college_graduate_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('college_graduate_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.college_graduate_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="career">{{ trans('cruds.crmCustomer.fields.career') }}</label>
                <input class="form-control {{ $errors->has('career') ? 'is-invalid' : '' }}" type="text" name="career" id="career" value="{{ old('career', $crmCustomer->career) }}">
                @if($errors->has('career'))
                    <div class="invalid-feedback">
                        {{ $errors->first('career') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.career_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.crmCustomer.fields.lived_in_usa') }}</label>
                <select class="form-control {{ $errors->has('lived_in_usa') ? 'is-invalid' : '' }}" name="lived_in_usa" id="lived_in_usa">
                    <option value disabled {{ old('lived_in_usa', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\CrmCustomer::LIVED_IN_USA_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('lived_in_usa', $crmCustomer->lived_in_usa) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('lived_in_usa'))
                    <div class="invalid-feedback">
                        {{ $errors->first('lived_in_usa') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.lived_in_usa_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.crmCustomer.fields.speak_english') }}</label>
                <select class="form-control {{ $errors->has('speak_english') ? 'is-invalid' : '' }}" name="speak_english" id="speak_english">
                    <option value disabled {{ old('speak_english', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\CrmCustomer::SPEAK_ENGLISH_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('speak_english', $crmCustomer->speak_english) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('speak_english'))
                    <div class="invalid-feedback">
                        {{ $errors->first('speak_english') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.speak_english_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.crmCustomer.fields.english_level') }}</label>
                <select class="form-control {{ $errors->has('english_level') ? 'is-invalid' : '' }}" name="english_level" id="english_level">
                    <option value disabled {{ old('english_level', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\CrmCustomer::ENGLISH_LEVEL_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('english_level', $crmCustomer->english_level) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('english_level'))
                    <div class="invalid-feedback">
                        {{ $errors->first('english_level') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.english_level_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.crmCustomer.fields.written_english') }}</label>
                <select class="form-control {{ $errors->has('written_english') ? 'is-invalid' : '' }}" name="written_english" id="written_english">
                    <option value disabled {{ old('written_english', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\CrmCustomer::WRITTEN_ENGLISH_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('written_english', $crmCustomer->written_english) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('written_english'))
                    <div class="invalid-feedback">
                        {{ $errors->first('written_english') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.written_english_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="father_name">{{ trans('cruds.crmCustomer.fields.father_name') }}</label>
                <input class="form-control {{ $errors->has('father_name') ? 'is-invalid' : '' }}" type="text" name="father_name" id="father_name" value="{{ old('father_name', $crmCustomer->father_name) }}">
                @if($errors->has('father_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('father_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.father_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="father_age">{{ trans('cruds.crmCustomer.fields.father_age') }}</label>
                <input class="form-control {{ $errors->has('father_age') ? 'is-invalid' : '' }}" type="number" name="father_age" id="father_age" value="{{ old('father_age', $crmCustomer->father_age) }}" step="1">
                @if($errors->has('father_age'))
                    <div class="invalid-feedback">
                        {{ $errors->first('father_age') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.father_age_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mother_name">{{ trans('cruds.crmCustomer.fields.mother_name') }}</label>
                <input class="form-control {{ $errors->has('mother_name') ? 'is-invalid' : '' }}" type="text" name="mother_name" id="mother_name" value="{{ old('mother_name', $crmCustomer->mother_name) }}">
                @if($errors->has('mother_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mother_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.mother_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mother_age">{{ trans('cruds.crmCustomer.fields.mother_age') }}</label>
                <input class="form-control {{ $errors->has('mother_age') ? 'is-invalid' : '' }}" type="number" name="mother_age" id="mother_age" value="{{ old('mother_age', $crmCustomer->mother_age) }}" step="1">
                @if($errors->has('mother_age'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mother_age') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.mother_age_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="emergency_contact_name">{{ trans('cruds.crmCustomer.fields.emergency_contact_name') }}</label>
                <input class="form-control {{ $errors->has('emergency_contact_name') ? 'is-invalid' : '' }}" type="text" name="emergency_contact_name" id="emergency_contact_name" value="{{ old('emergency_contact_name', $crmCustomer->emergency_contact_name) }}">
                @if($errors->has('emergency_contact_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('emergency_contact_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.emergency_contact_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="emergency_contact_relationship">{{ trans('cruds.crmCustomer.fields.emergency_contact_relationship') }}</label>
                <input class="form-control {{ $errors->has('emergency_contact_relationship') ? 'is-invalid' : '' }}" type="text" name="emergency_contact_relationship" id="emergency_contact_relationship" value="{{ old('emergency_contact_relationship', $crmCustomer->emergency_contact_relationship) }}">
                @if($errors->has('emergency_contact_relationship'))
                    <div class="invalid-feedback">
                        {{ $errors->first('emergency_contact_relationship') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.emergency_contact_relationship_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="reference_name_1">{{ trans('cruds.crmCustomer.fields.reference_name_1') }}</label>
                <input class="form-control {{ $errors->has('reference_name_1') ? 'is-invalid' : '' }}" type="text" name="reference_name_1" id="reference_name_1" value="{{ old('reference_name_1', $crmCustomer->reference_name_1) }}">
                @if($errors->has('reference_name_1'))
                    <div class="invalid-feedback">
                        {{ $errors->first('reference_name_1') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.reference_name_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="reference_relationship_1">{{ trans('cruds.crmCustomer.fields.reference_relationship_1') }}</label>
                <input class="form-control {{ $errors->has('reference_relationship_1') ? 'is-invalid' : '' }}" type="text" name="reference_relationship_1" id="reference_relationship_1" value="{{ old('reference_relationship_1', $crmCustomer->reference_relationship_1) }}">
                @if($errors->has('reference_relationship_1'))
                    <div class="invalid-feedback">
                        {{ $errors->first('reference_relationship_1') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.reference_relationship_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="reference_phone_1">{{ trans('cruds.crmCustomer.fields.reference_phone_1') }}</label>
                <input class="form-control" type="number" name="reference_phone_1" id="reference_phone_1" value="{{ old('reference_phone_1', $crmCustomer->reference_phone_1) }}">
            </div>
            <div class="form-group">
                <label for="reference_name_2">{{ trans('cruds.crmCustomer.fields.reference_name_2') }}</label>
                <input class="form-control {{ $errors->has('reference_name_2') ? 'is-invalid' : '' }}" type="text" name="reference_name_2" id="reference_name_2" value="{{ old('reference_name_2', $crmCustomer->reference_name_2) }}">
                @if($errors->has('reference_name_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('reference_name_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.reference_name_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="reference_relationship_2">{{ trans('cruds.crmCustomer.fields.reference_relationship_2') }}</label>
                <input class="form-control {{ $errors->has('reference_relationship_2') ? 'is-invalid' : '' }}" type="text" name="reference_relationship_2" id="reference_relationship_2" value="{{ old('reference_relationship_2', $crmCustomer->reference_relationship_2) }}">
                @if($errors->has('reference_relationship_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('reference_relationship_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.reference_relationship_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="reference_phone_2">{{ trans('cruds.crmCustomer.fields.reference_phone_2') }}</label>
                <input class="form-control {{ $errors->has('reference_phone_2') ? 'is-invalid' : '' }}" type="number" name="reference_phone_2" id="reference_phone_2" value="{{ old('reference_phone_2', $crmCustomer->reference_phone_2) }}">
                @if($errors->has('reference_phone_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('reference_phone_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.reference_phone_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="reference_name_3">{{ trans('cruds.crmCustomer.fields.reference_name_3') }}</label>
                <input class="form-control {{ $errors->has('reference_name_3') ? 'is-invalid' : '' }}" type="text" name="reference_name_3" id="reference_name_3" value="{{ old('reference_name_3', $crmCustomer->reference_name_3) }}">
                @if($errors->has('reference_name_3'))
                    <div class="invalid-feedback">
                        {{ $errors->first('reference_name_3') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.reference_name_3_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="reference_relationship_3">{{ trans('cruds.crmCustomer.fields.reference_relationship_3') }}</label>
                <input class="form-control {{ $errors->has('reference_relationship_3') ? 'is-invalid' : '' }}" type="text" name="reference_relationship_3" id="reference_relationship_3" value="{{ old('reference_relationship_3', $crmCustomer->reference_relationship_3) }}">
                @if($errors->has('reference_relationship_3'))
                    <div class="invalid-feedback">
                        {{ $errors->first('reference_relationship_3') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.reference_relationship_3_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="reference_phone_3">{{ trans('cruds.crmCustomer.fields.reference_phone_3') }}</label>
                <input class="form-control {{ $errors->has('reference_phone_3') ? 'is-invalid' : '' }}" type="number" name="reference_phone_3" id="reference_phone_3" value="{{ old('reference_phone_3', $crmCustomer->reference_phone_3) }}">
                @if($errors->has('reference_phone_3'))
                    <div class="invalid-feedback">
                        {{ $errors->first('reference_phone_3') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.reference_phone_3_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="company_name_1">{{ trans('cruds.crmCustomer.fields.company_name_1') }}</label>
                <input class="form-control {{ $errors->has('company_name_1') ? 'is-invalid' : '' }}" type="text" name="company_name_1" id="company_name_1" value="{{ old('company_name_1', $crmCustomer->company_name_1) }}">
                @if($errors->has('company_name_1'))
                    <div class="invalid-feedback">
                        {{ $errors->first('company_name_1') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.company_name_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="company_phone_1">{{ trans('cruds.crmCustomer.fields.company_phone_1') }}</label>
                <input class="form-control {{ $errors->has('company_phone_1') ? 'is-invalid' : '' }}" type="number" name="company_phone_1" id="company_phone_1" value="{{ old('company_phone_1', $crmCustomer->company_phone_1) }}" >
                @if($errors->has('company_phone_1'))
                    <div class="invalid-feedback">
                        {{ $errors->first('company_phone_1') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.company_phone_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="worked_from_1">{{ trans('cruds.crmCustomer.fields.worked_from_1') }}</label>
                <input class="form-control date {{ $errors->has('worked_from_1') ? 'is-invalid' : '' }}" type="text" name="worked_from_1" id="worked_from_1" value="{{ old('worked_from_1', $crmCustomer->worked_from_1) }}">
                @if($errors->has('worked_from_1'))
                    <div class="invalid-feedback">
                        {{ $errors->first('worked_from_1') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.worked_from_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="worked_until_1">{{ trans('cruds.crmCustomer.fields.worked_until_1') }}</label>
                <input class="form-control date {{ $errors->has('worked_until_1') ? 'is-invalid' : '' }}" type="text" name="worked_until_1" id="worked_until_1" value="{{ old('worked_until_1', $crmCustomer->worked_until_1) }}">
                @if($errors->has('worked_until_1'))
                    <div class="invalid-feedback">
                        {{ $errors->first('worked_until_1') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.worked_until_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="reason_for_leaving_1">{{ trans('cruds.crmCustomer.fields.reason_for_leaving_1') }}</label>
                <input class="form-control {{ $errors->has('reason_for_leaving_1') ? 'is-invalid' : '' }}" type="text" name="reason_for_leaving_1" id="reason_for_leaving_1" value="{{ old('reason_for_leaving_1', $crmCustomer->reason_for_leaving_1) }}">
                @if($errors->has('reason_for_leaving_1'))
                    <div class="invalid-feedback">
                        {{ $errors->first('reason_for_leaving_1') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.reason_for_leaving_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="company_name_2">{{ trans('cruds.crmCustomer.fields.company_name_2') }}</label>
                <input class="form-control {{ $errors->has('company_name_2') ? 'is-invalid' : '' }}" type="text" name="company_name_2" id="company_name_2" value="{{ old('company_name_2', $crmCustomer->company_name_2) }}">
                @if($errors->has('company_name_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('company_name_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.company_name_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="company_phone_2">{{ trans('cruds.crmCustomer.fields.company_phone_2') }}</label>
                <input class="form-control {{ $errors->has('company_phone_2') ? 'is-invalid' : '' }}" type="number" name="company_phone_2" id="company_phone_2" value="{{ old('company_phone_2', $crmCustomer->company_phone_2) }}" >
                @if($errors->has('company_phone_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('company_phone_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.company_phone_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="worked_from_2">{{ trans('cruds.crmCustomer.fields.worked_from_2') }}</label>
                <input class="form-control date {{ $errors->has('worked_from_2') ? 'is-invalid' : '' }}" type="text" name="worked_from_2" id="worked_from_2" value="{{ old('worked_from_2', $crmCustomer->worked_from_2) }}">
                @if($errors->has('worked_from_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('worked_from_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.worked_from_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="worked_until_2">{{ trans('cruds.crmCustomer.fields.worked_until_2') }}</label>
                <input class="form-control date {{ $errors->has('worked_until_2') ? 'is-invalid' : '' }}" type="text" name="worked_until_2" id="worked_until_2" value="{{ old('worked_until_2', $crmCustomer->worked_until_2) }}">
                @if($errors->has('worked_until_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('worked_until_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.worked_until_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="reason_for_leaving_2">{{ trans('cruds.crmCustomer.fields.reason_for_leaving_2') }}</label>
                <input class="form-control {{ $errors->has('reason_for_leaving_2') ? 'is-invalid' : '' }}" type="text" name="reason_for_leaving_2" id="reason_for_leaving_2" value="{{ old('reason_for_leaving_2', $crmCustomer->reason_for_leaving_2) }}">
                @if($errors->has('reason_for_leaving_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('reason_for_leaving_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.reason_for_leaving_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="office_skills">{{ trans('cruds.crmCustomer.fields.office_skills') }}</label>
                <textarea class="form-control {{ $errors->has('office_skills') ? 'is-invalid' : '' }}" name="office_skills" id="office_skills">{{ old('office_skills', $crmCustomer->office_skills) }}</textarea>
                @if($errors->has('office_skills'))
                    <div class="invalid-feedback">
                        {{ $errors->first('office_skills') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.office_skills_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="when_start">{{ trans('cruds.crmCustomer.fields.when_start') }}</label>
                <input class="form-control date {{ $errors->has('when_start') ? 'is-invalid' : '' }}" type="text" name="when_start" id="when_start" value="{{ old('when_start', $crmCustomer->when_start) }}">
                @if($errors->has('when_start'))
                    <div class="invalid-feedback">
                        {{ $errors->first('when_start') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.when_start_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="status_id">{{ trans('cruds.crmCustomer.fields.status') }}</label>
                <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id" id="status_id">
                    @foreach($statuses as $id => $entry)
                        <option value="{{ $id }}" {{ (old('status_id') ? old('status_id') : $crmCustomer->status->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('official_valid') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="official_valid" value="0">
                    <input class="form-check-input" type="checkbox" name="official_valid" id="official_valid" value="1" {{ $crmCustomer->official_valid || old('official_valid', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="official_valid">{{ trans('cruds.crmCustomer.fields.official_valid') }}</label>
                </div>
                @if($errors->has('official_valid'))
                    <div class="invalid-feedback">
                        {{ $errors->first('official_valid') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.official_valid_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('birth_certificate') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="birth_certificate" value="0">
                    <input class="form-check-input" type="checkbox" name="birth_certificate" id="birth_certificate" value="1" {{ $crmCustomer->birth_certificate || old('birth_certificate', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="birth_certificate">{{ trans('cruds.crmCustomer.fields.birth_certificate') }}</label>
                </div>
                @if($errors->has('birth_certificate'))
                    <div class="invalid-feedback">
                        {{ $errors->first('birth_certificate') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.birth_certificate_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('have_curp') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="have_curp" value="0">
                    <input class="form-check-input" type="checkbox" name="have_curp" id="have_curp" value="1" {{ $crmCustomer->have_curp || old('have_curp', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="have_curp">{{ trans('cruds.crmCustomer.fields.have_curp') }}</label>
                </div>
                @if($errors->has('have_curp'))
                    <div class="invalid-feedback">
                        {{ $errors->first('have_curp') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.have_curp_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('have_rfc') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="have_rfc" value="0">
                    <input class="form-check-input" type="checkbox" name="have_rfc" id="have_rfc" value="1" {{ $crmCustomer->have_rfc || old('have_rfc', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="have_rfc">{{ trans('cruds.crmCustomer.fields.have_rfc') }}</label>
                </div>
                @if($errors->has('have_rfc'))
                    <div class="invalid-feedback">
                        {{ $errors->first('have_rfc') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.have_rfc_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.crmCustomer.fields.have_had_covid') }}</label>
                <select class="form-control {{ $errors->has('have_had_covid') ? 'is-invalid' : '' }}" name="have_had_covid" id="have_had_covid">
                    <option value disabled {{ old('have_had_covid', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\CrmCustomer::HAVE_HAD_COVID_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('have_had_covid', $crmCustomer->have_had_covid) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('have_had_covid'))
                    <div class="invalid-feedback">
                        {{ $errors->first('have_had_covid') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.have_had_covid_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.crmCustomer.fields.covid_vaccine') }}</label>
                <select class="form-control {{ $errors->has('covid_vaccine') ? 'is-invalid' : '' }}" name="covid_vaccine" id="covid_vaccine">
                    <option value disabled {{ old('covid_vaccine', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\CrmCustomer::COVID_VACCINE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('covid_vaccine', $crmCustomer->covid_vaccine) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('covid_vaccine'))
                    <div class="invalid-feedback">
                        {{ $errors->first('covid_vaccine') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.covid_vaccine_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="additional_comments">{{ trans('cruds.crmCustomer.fields.additional_comments') }}</label>
                <input class="form-control {{ $errors->has('additional_comments') ? 'is-invalid' : '' }}" type="text" name="additional_comments" id="additional_comments" value="{{ old('additional_comments', $crmCustomer->additional_comments) }}">
                @if($errors->has('additional_comments'))
                    <div class="invalid-feedback">
                        {{ $errors->first('additional_comments') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.additional_comments_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('imss_number') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="imss_number" value="0">
                    <input class="form-check-input" type="checkbox" name="imss_number" id="imss_number" value="1" {{ $crmCustomer->imss_number || old('imss_number', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="imss_number">{{ trans('cruds.crmCustomer.fields.imss_number') }}</label>
                </div>
                @if($errors->has('imss_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('imss_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.imss_number_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('proof_of_residence') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="proof_of_residence" value="0">
                    <input class="form-check-input" type="checkbox" name="proof_of_residence" id="proof_of_residence" value="1" {{ $crmCustomer->proof_of_residence || old('proof_of_residence', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="proof_of_residence">{{ trans('cruds.crmCustomer.fields.proof_of_residence') }}</label>
                </div>
                @if($errors->has('proof_of_residence'))
                    <div class="invalid-feedback">
                        {{ $errors->first('proof_of_residence') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.proof_of_residence_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('highschool_diploma') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="highschool_diploma" value="0">
                    <input class="form-check-input" type="checkbox" name="highschool_diploma" id="highschool_diploma" value="1" {{ $crmCustomer->highschool_diploma || old('highschool_diploma', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="highschool_diploma">{{ trans('cruds.crmCustomer.fields.highschool_diploma') }}</label>
                </div>
                @if($errors->has('highschool_diploma'))
                    <div class="invalid-feedback">
                        {{ $errors->first('highschool_diploma') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.highschool_diploma_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="position_id">{{ trans('cruds.crmCustomer.fields.position') }}</label>
                <select class="form-control select2 {{ $errors->has('position') ? 'is-invalid' : '' }}" name="position_id" id="position_id" required>
                    @foreach($positions as $id => $entry)
                        <option value="{{ $id }}" {{ (old('position_id') ? old('position_id') : $crmCustomer->position->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('position'))
                    <div class="invalid-feedback">
                        {{ $errors->first('position') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.position_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="infonavit_credit">{{ trans('cruds.crmCustomer.fields.infonavit_credit') }}</label>
                <input class="form-control {{ $errors->has('infonavit_credit') ? 'is-invalid' : '' }}" type="text" name="infonavit_credit" id="infonavit_credit" value="{{ old('infonavit_credit', $crmCustomer->infonavit_credit) }}">
                @if($errors->has('infonavit_credit'))
                    <div class="invalid-feedback">
                        {{ $errors->first('infonavit_credit') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.infonavit_credit_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('payment_method') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="payment_method" value="0">
                    <input class="form-check-input" type="checkbox" name="payment_method" id="payment_method" value="1" {{ $crmCustomer->payment_method || old('payment_method', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="payment_method">{{ trans('cruds.crmCustomer.fields.payment_method') }}</label>
                </div>
                @if($errors->has('payment_method'))
                    <div class="invalid-feedback">
                        {{ $errors->first('payment_method') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.payment_method_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="how_you_knew">{{ trans('cruds.crmCustomer.fields.how_you_knew') }}</label>
                <input class="form-control {{ $errors->has('how_you_knew') ? 'is-invalid' : '' }}" type="text" name="how_you_knew" id="how_you_knew" value="{{ old('how_you_knew', $crmCustomer->how_you_knew) }}">
                @if($errors->has('how_you_knew'))
                    <div class="invalid-feedback">
                        {{ $errors->first('how_you_knew') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.how_you_knew_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

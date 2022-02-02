<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ trans('panel.site_title') }}</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet"/>
    <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet"/>
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"
        rel="stylesheet"/>
    <link href="https://unpkg.com/@coreui/coreui@3.2/dist/css/coreui.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/css/perfect-scrollbar.min.css"
          rel="stylesheet"/>
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet"/>
    @yield('styles')
</head>

<body class="c-app">
<div class="c-wrapper">
    <div class="c-body">
        <main class="c-main" style="background-color: #2196F3;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8 col-lg-12 col-sm-4">
                        <form action="">
                            <div class="card card-primary">
                                <div class="card-header text-center">
                                    <h3><b>Personal Information</b></h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label class="required"
                                                       for="first_name">{{ trans('cruds.crmCustomer.fields.first_name') }}</label>
                                                <input
                                                    class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}"
                                                    type="text" name="first_name" id="first_name"
                                                    value="{{ old('first_name', '') }}" required>
                                                @if($errors->has('first_name'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('first_name') }}
                                                    </div>
                                                @endif
                                                <span
                                                    class="help-block">{{ trans('cruds.crmCustomer.fields.first_name_helper') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label class="required"
                                                       for="last_name">{{ trans('cruds.crmCustomer.fields.last_name') }}</label>
                                                <input
                                                    class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}"
                                                    type="text" name="last_name" id="last_name"
                                                    value="{{ old('last_name', '') }}" required>
                                                @if($errors->has('last_name'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('last_name') }}
                                                    </div>
                                                @endif
                                                <span
                                                    class="help-block">{{ trans('cruds.crmCustomer.fields.last_name_helper') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label class="required"
                                                       for="email">{{ trans('cruds.crmCustomer.fields.email') }}</label>
                                                <input
                                                    class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                                    type="text" name="email" id="email" value="{{ old('email', '') }}"
                                                    required>
                                                @if($errors->has('email'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('email') }}
                                                    </div>
                                                @endif
                                                <span
                                                    class="help-block">{{ trans('cruds.crmCustomer.fields.email_helper') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label class="required"
                                                       for="phone">{{ trans('cruds.crmCustomer.fields.phone') }}</label>
                                                <input
                                                    class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                                                    type="text" name="phone" id="phone" value="{{ old('phone', '') }}"
                                                    required>
                                                @if($errors->has('phone'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('phone') }}
                                                    </div>
                                                @endif
                                                <span
                                                    class="help-block">{{ trans('cruds.crmCustomer.fields.phone_helper') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label class="required"
                                                       for="address">{{ trans('cruds.crmCustomer.fields.address') }}</label>
                                                <input
                                                    class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}"
                                                    type="text" name="address" id="address"
                                                    value="{{ old('address', '') }}" required>
                                                @if($errors->has('address'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('address') }}
                                                    </div>
                                                @endif
                                                <span
                                                    class="help-block">{{ trans('cruds.crmCustomer.fields.address_helper') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label
                                                    for="description">Address {{ trans('cruds.crmCustomer.fields.description') }}</label>
                                                <input
                                                    class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                                    name="description" id="description">{{ old('description') }}</input>
                                                @if($errors->has('description'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('description') }}
                                                    </div>
                                                @endif
                                                <span
                                                    class="help-block">{{ trans('cruds.crmCustomer.fields.description_helper') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label class="required"
                                                       for="age">{{ trans('cruds.crmCustomer.fields.age') }}</label>
                                                <input
                                                    class="form-control {{ $errors->has('age') ? 'is-invalid' : '' }}"
                                                    type="number" min="0" name="age" id="age"
                                                    value="{{ old('age', '') }}" step="1" required>
                                                @if($errors->has('age'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('age') }}
                                                    </div>
                                                @endif
                                                <span
                                                    class="help-block">{{ trans('cruds.crmCustomer.fields.age_helper') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label
                                                    class="required">{{ trans('cruds.crmCustomer.fields.gender') }}</label>
                                                <select
                                                    class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}"
                                                    name="gender" id="gender" required>
                                                    <option value
                                                            disabled {{ old('gender', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                                    @foreach(App\Models\CrmCustomer::GENDER_SELECT as $key => $label)
                                                        <option
                                                            value="{{ $key }}" {{ old('gender', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('gender'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('gender') }}
                                                    </div>
                                                @endif
                                                <span
                                                    class="help-block">{{ trans('cruds.crmCustomer.fields.gender_helper') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>{{ trans('cruds.crmCustomer.fields.living_with') }}</label>
                                                <select
                                                    class="form-control {{ $errors->has('living_with') ? 'is-invalid' : '' }}"
                                                    name="living_with" id="living_with">
                                                    <option value
                                                            disabled {{ old('living_with', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                                    @foreach(App\Models\CrmCustomer::LIVING_WITH_SELECT as $key => $label)
                                                        <option
                                                            value="{{ $key }}" {{ old('living_with', 'Do you currently live with?') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('living_with'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('living_with') }}
                                                    </div>
                                                @endif
                                                <span
                                                    class="help-block">{{ trans('cruds.crmCustomer.fields.living_with_helper') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>{{ trans('cruds.crmCustomer.fields.dependents') }}</label>
                                                <select
                                                    class="form-control {{ $errors->has('dependents') ? 'is-invalid' : '' }}"
                                                    name="dependents" id="dependents">
                                                    <option value
                                                            disabled {{ old('dependents', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                                    @foreach(App\Models\CrmCustomer::DEPENDENTS_SELECT as $key => $label)
                                                        <option
                                                            value="{{ $key }}" {{ old('dependents', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('dependents'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('dependents') }}
                                                    </div>
                                                @endif
                                                <span
                                                    class="help-block">{{ trans('cruds.crmCustomer.fields.dependents_helper') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label class="required"
                                                       for="date_of_birth">{{ trans('cruds.crmCustomer.fields.date_of_birth') }}</label>
                                                <input
                                                    class="form-control date {{ $errors->has('date_of_birth') ? 'is-invalid' : '' }}"
                                                    type="text" name="date_of_birth" id="date_of_birth"
                                                    value="{{ old('date_of_birth') }}" required>
                                                @if($errors->has('date_of_birth'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('date_of_birth') }}
                                                    </div>
                                                @endif
                                                <span
                                                    class="help-block">{{ trans('cruds.crmCustomer.fields.date_of_birth_helper') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label class="required"
                                                       for="nationality">{{ trans('cruds.crmCustomer.fields.nationality') }}</label>
                                                <input
                                                    class="form-control {{ $errors->has('nationality') ? 'is-invalid' : '' }}"
                                                    type="text" name="nationality" id="nationality"
                                                    value="{{ old('nationality', '') }}" required>
                                                @if($errors->has('nationality'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('nationality') }}
                                                    </div>
                                                @endif
                                                <span
                                                    class="help-block">{{ trans('cruds.crmCustomer.fields.nationality_helper') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>{{ trans('cruds.crmCustomer.fields.marital_status') }}</label>
                                                <select
                                                    class="form-control {{ $errors->has('marital_status') ? 'is-invalid' : '' }}"
                                                    name="marital_status" id="marital_status">
                                                    <option value
                                                            disabled {{ old('marital_status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                                    @foreach(App\Models\CrmCustomer::MARITAL_STATUS_SELECT as $key => $label)
                                                        <option
                                                            value="{{ $key }}" {{ old('marital_status', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('marital_status'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('marital_status') }}
                                                    </div>
                                                @endif
                                                <span
                                                    class="help-block">{{ trans('cruds.crmCustomer.fields.marital_status_helper') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-primary">
                                <div class="card-header text-center">
                                    <h3><b>Documentation</b></h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="curp">{{ trans('cruds.crmCustomer.fields.curp') }}</label>
                                                <input class="form-control {{ $errors->has('curp') ? 'is-invalid' : '' }}" type="text" name="curp" id="curp" value="{{ old('curp', '') }}">
                                                @if($errors->has('curp'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('curp') }}
                                                    </div>
                                                @endif
                                                <span class="help-block">{{ trans('cruds.crmCustomer.fields.curp_helper') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="rfc">{{ trans('cruds.crmCustomer.fields.rfc') }}</label>
                                                <input class="form-control {{ $errors->has('rfc') ? 'is-invalid' : '' }}" type="text" name="rfc" id="rfc" value="{{ old('rfc', '') }}">
                                                @if($errors->has('rfc'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('rfc') }}
                                                    </div>
                                                @endif
                                                <span class="help-block">{{ trans('cruds.crmCustomer.fields.rfc_helper') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="ssn">{{ trans('cruds.crmCustomer.fields.ssn') }}</label>
                                                <input class="form-control {{ $errors->has('ssn') ? 'is-invalid' : '' }}" type="text" name="ssn" id="ssn" value="{{ old('ssn', '') }}">
                                                @if($errors->has('ssn'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('ssn') }}
                                                    </div>
                                                @endif
                                                <span class="help-block">{{ trans('cruds.crmCustomer.fields.ssn_helper') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-primary">
                                <div class="card-header text-center">
                                    <h3><b>Health status and personal habits</b></h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label>{{ trans('cruds.crmCustomer.fields.health_status') }}</label>
                                                <select class="form-control {{ $errors->has('health_status') ? 'is-invalid' : '' }}" name="health_status" id="health_status">
                                                    <option value disabled {{ old('health_status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                                    @foreach(App\Models\CrmCustomer::HEALTH_STATUS_SELECT as $key => $label)
                                                        <option value="{{ $key }}" {{ old('health_status', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('health_status'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('health_status') }}
                                                    </div>
                                                @endif
                                                <span class="help-block">{{ trans('cruds.crmCustomer.fields.health_status_helper') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="chronic_illness">{{ trans('cruds.crmCustomer.fields.chronic_illness') }}</label>
                                                <input class="form-control {{ $errors->has('chronic_illness') ? 'is-invalid' : '' }}" type="text" name="chronic_illness" id="chronic_illness" value="{{ old('chronic_illness', '') }}">
                                                @if($errors->has('chronic_illness'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('chronic_illness') }}
                                                    </div>
                                                @endif
                                                <span class="help-block">{{ trans('cruds.crmCustomer.fields.chronic_illness_helper') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label>{{ trans('cruds.crmCustomer.fields.have_had_covid') }}</label>
                                                <select class="form-control {{ $errors->has('have_had_covid') ? 'is-invalid' : '' }}" name="have_had_covid" id="have_had_covid">
                                                    <option value disabled {{ old('have_had_covid', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                                    @foreach(App\Models\CrmCustomer::HAVE_HAD_COVID_SELECT as $key => $label)
                                                        <option value="{{ $key }}" {{ old('have_had_covid', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('have_had_covid'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('have_had_covid') }}
                                                    </div>
                                                @endif
                                                <span class="help-block">{{ trans('cruds.crmCustomer.fields.have_had_covid_helper') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label>{{ trans('cruds.crmCustomer.fields.covid_vaccine') }}</label>
                                                <select class="form-control {{ $errors->has('covid_vaccine') ? 'is-invalid' : '' }}" name="covid_vaccine" id="covid_vaccine">
                                                    <option value disabled {{ old('covid_vaccine', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                                    @foreach(App\Models\CrmCustomer::COVID_VACCINE_SELECT as $key => $label)
                                                        <option value="{{ $key }}" {{ old('covid_vaccine', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('covid_vaccine'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('covid_vaccine') }}
                                                    </div>
                                                @endif
                                                <span class="help-block">{{ trans('cruds.crmCustomer.fields.covid_vaccine_helper') }}</span>
                                            </div>
                                        </div>
                                    </div>



                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

</body>

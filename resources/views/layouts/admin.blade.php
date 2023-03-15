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
    <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@3.2.2/dist/css/coreui.min.css" rel="stylesheet"/>
{{--    <link href="https://unpkg.com/@coreui/coreui@3.2/dist/css/coreui.min.css" rel="stylesheet"/>--}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/css/perfect-scrollbar.min.css"
          rel="stylesheet"/>
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet"/>
    @yield('styles')
    <style>
        .modal-dialog{
            overflow-y: initial !important
        }
        .modal-body{
            height: 80vh;
            overflow-y: auto;
        }
    </style>
    <script>
        let user = {!! json_encode(auth()->user()) !!};
        localStorage.setItem('user', JSON.stringify(user));
    </script>
</head>

<body class="c-app">
@include('partials.menu')
<div id="app" class="c-wrapper">


    <header class="c-header c-header-fixed px-3">
        <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar"
                data-class="c-sidebar-show">
            <i class="fas fa-fw fa-bars"></i>
        </button>

        <a class="c-header-brand d-lg-none" href="#">{{ trans('panel.site_title') }}</a>

        <button class="c-header-toggler mfs-3 d-md-down-none" type="button" responsive="true">
            <i class="fas fa-fw fa-bars"></i>
        </button>

        <ul class="c-header-nav ml-auto">

            @if(auth()->user()->sip_enabled)
                <telephony class="ml-4" v-bind:user="{{ json_encode(auth()->user()) }}"></telephony>
            @endif

            <span class="c-avatar">
                    <img class="c-avatar-img" src="{{ asset('images/user.png') }}" alt="{{ Auth::user()->name }}">
                </span>
            @if(count(config('panel.available_languages', [])) > 1)
                <li class="c-header-nav-item dropdown d-md-down-none">
                    <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                       aria-expanded="false">
                        {{ strtoupper(app()->getLocale()) }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        @foreach(config('panel.available_languages') as $langLocale => $langName)
                            <a class="dropdown-item"
                               href="{{ url()->current() }}?change_language={{ $langLocale }}">{{ strtoupper($langLocale) }}
                                ({{ $langName }})</a>
                        @endforeach
                    </div>
                </li>
            @endif

            <ul class="c-header-nav ml-auto">
                <li class="c-header-nav-item dropdown notifications-menu">
                    <a href="#" class="c-header-nav-link" data-toggle="dropdown">
                        <i class="far fa-bell"></i>
                        @php
                            $alertsCount = \Auth::user()->userUserAlerts()->where('read', false)->count()
                        @endphp
                        @if($alertsCount > 0)
                            <span class="badge badge-warning navbar-badge">
                                        {{ $alertsCount }}
                                    </span>
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        @if(count($alerts = \Auth::user()->userUserAlerts()->withPivot('read')->limit(10)->orderBy('created_at', 'ASC')->get()->reverse()) > 0)
                            @foreach($alerts as $alert)
                                <div class="dropdown-item">
                                    <a href="{{ $alert->alert_link ? $alert->alert_link : "#" }}" target="_blank"
                                       rel="noopener noreferrer">
                                        @if($alert->pivot->read === 0)
                                            <strong> @endif
                                                {{ $alert->alert_text }}
                                                @if($alert->pivot->read === 0) </strong>
                                        @endif
                                    </a>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center">
                                {{ trans('global.no_alerts') }}
                            </div>
                        @endif
                    </div>
                </li>
            </ul>

        </ul>
    </header>

    <div class="c-body">
        <main class="c-main">
            <div class="container-fluid">
                @if(session('message'))
                    <div class="row mb-2">
                        <div class="col-lg-12">
                            <div class="alert alert-success" role="alert">{{ session('message') }}</div>
                        </div>
                    </div>
                @endif
                @if($errors->count() > 0)
                    <div class="alert alert-danger">
                        <ul class="list-unstyled">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @yield('content')

                <div class="modal fade" id="incoming-call-modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Incoming Call</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                Call from: <span v-if="activeCall != null" id="incoming-call-from"> @{{  activeCall.options.remoteCallerNumber }}</span>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-warning" data-dismiss="modal"
                                        v-on:click="answer()">Answer
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="incoming-call-data" tabindex="-1" role="dialog">
                    <div class="modal-dialog" style="max-width: 1080px">
                        <div class="modal-content" >
                            <div class="modal-header">
                                <h4 class="modal-title">Lead info</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">

                                @php
                                    $crmCustomer = new \App\Models\CrmCustomer();
                                @endphp

                                <form id="lead-info-form" method="POST" action="" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="form-group">
                                        <button class="btn btn-danger" type="submit" onclick="this.disable = 'disable'">
                                            {{ trans('global.save') }}
                                        </button>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="card">
                                                <div class="card-header bg-primary">
                                                    Basic Info
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label class="required"
                                                                       for="first_name">{{ trans('cruds.crmCustomer.fields.first_name') }}</label>
                                                                <input
                                                                    class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}"
                                                                    type="text"
                                                                    name="first_name" id="first_name"
                                                                    value="{{ old('first_name', $crmCustomer->first_name) }}"
                                                                    required>
                                                                @if($errors->has('first_name'))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('first_name') }}
                                                                    </div>
                                                                @endif
                                                                <span
                                                                    class="help-block">{{ trans('cruds.crmCustomer.fields.first_name_helper') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label class="required"
                                                                       for="last_name">{{ trans('cruds.crmCustomer.fields.last_name') }}</label>
                                                                <input
                                                                    class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}"
                                                                    type="text"
                                                                    name="last_name" id="last_name"
                                                                    value="{{ old('last_name', $crmCustomer->last_name) }}"
                                                                    required>
                                                                @if($errors->has('last_name'))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('last_name') }}
                                                                    </div>
                                                                @endif
                                                                <span
                                                                    class="help-block">{{ trans('cruds.crmCustomer.fields.last_name_helper') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="required"
                                                               for="email">{{ trans('cruds.crmCustomer.fields.email') }}</label>
                                                        <input
                                                            class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                                            type="text" name="email"
                                                            id="email" value="{{ old('email', $crmCustomer->email) }}"
                                                            required>
                                                        @if($errors->has('email'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('email') }}
                                                            </div>
                                                        @endif
                                                        <span
                                                            class="help-block">{{ trans('cruds.crmCustomer.fields.email_helper') }}</span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="required"
                                                               for="phone">{{ trans('cruds.crmCustomer.fields.phone') }}</label>
                                                        <input
                                                            class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                                                            type="text" name="phone"
                                                            id="phone" value="{{ old('phone', $crmCustomer->phone) }}"
                                                            required>
                                                        @if($errors->has('phone'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('phone') }}
                                                            </div>
                                                        @endif
                                                        <span
                                                            class="help-block">{{ trans('cruds.crmCustomer.fields.phone_helper') }}</span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="cellphone">Cellphone</label>
                                                        <input
                                                            class="form-control {{ $errors->has('cellphone') ? 'is-invalid' : '' }}"
                                                            type="text"
                                                            name="cellphone" id="cellphone"
                                                            value="{{ old('cellphone', $crmCustomer->cellphone) }}">
                                                        @if($errors->has('cellphone'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('cellphone') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="company_name">Company Name</label>
                                                        <input
                                                            class="form-control {{ $errors->has('company_name') ? 'is-invalid' : '' }}"
                                                            type="text"
                                                            name="company_name" id="company_name"
                                                            value="{{ old('company_name', $crmCustomer->company_name) }}">
                                                        @if($errors->has('company_name'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('company_name') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="card">
                                                <div class="card-header bg-primary">
                                                    Address Info
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label class="required"
                                                               for="address">{{ trans('cruds.crmCustomer.fields.address') }}</label>
                                                        <input
                                                            class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}"
                                                            type="text"
                                                            name="address" id="address"
                                                            value="{{ old('address', $crmCustomer->address) }}"
                                                            required>
                                                        @if($errors->has('address'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('address') }}
                                                            </div>
                                                        @endif
                                                        <span
                                                            class="help-block">{{ trans('cruds.crmCustomer.fields.address_helper') }}</span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="city">City</label>
                                                        <input
                                                            class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}"
                                                            type="text" name="city"
                                                            id="city" value="{{ old('city', $crmCustomer->city) }}">
                                                        @if($errors->has('city'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('city') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="state">State</label>
                                                        <input
                                                            class="form-control {{ $errors->has('state') ? 'is-invalid' : '' }}"
                                                            type="text" name="state"
                                                            id="state" value="{{ old('state', $crmCustomer->state) }}">
                                                        @if($errors->has('state'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('state') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="zip_code">Zip Code</label>
                                                        <input
                                                            class="form-control {{ $errors->has('zip_code') ? 'is-invalid' : '' }}"
                                                            type="text"
                                                            name="zip_code" id="zip_code"
                                                            value="{{ old('zip_code', $crmCustomer->zip_code) }}">
                                                        @if($errors->has('zip_code'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('zip_code') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="contry">Country</label>
                                                        <input
                                                            class="form-control {{ $errors->has('country') ? 'is-invalid' : '' }}"
                                                            type="text"
                                                            name="country" id="country"
                                                            value="{{ old('country', $crmCustomer->country) }}">
                                                        @if($errors->has('country'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('country') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="card">
                                                <div class="card-header bg-primary">
                                                    Verify Info
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label for="employee_count">Employee Count</label>
                                                        <input
                                                            class="form-control {{ $errors->has('employee_count') ? 'is-invalid' : '' }}"
                                                            type="text"
                                                            name="employee_count" id="employee_count"
                                                            value="{{ old('employee_count', $crmCustomer->employee_count) }}">
                                                        @if($errors->has('employee_count'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('employee_count') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="verify_employee_count">Verify Employee Count</label>
                                                        <input
                                                            class="form-control {{ $errors->has('verify_employee_count') ? 'is-invalid' : '' }}"
                                                            type="text"
                                                            name="verify_employee_count" id="verify_employee_count"
                                                            value="{{ old('verify_employee_count', $crmCustomer->verify_employee_count) }}">
                                                        @if($errors->has('verify_employee_count'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('verify_employee_count') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="first_name_verified">First Name Verified</label>
                                                        <input
                                                            class="form-control {{ $errors->has('first_name_verified') ? 'is-invalid' : '' }}"
                                                            type="text"
                                                            name="first_name_verified" id="first_name_verified"
                                                            value="{{ old('first_name_verified', $crmCustomer->first_name_verified) }}">
                                                        @if($errors->has('first_name_verified'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('first_name_verified') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="last_name_verified">Last Name Verified</label>
                                                        <input
                                                            class="form-control {{ $errors->has('last_name_verified') ? 'is-invalid' : '' }}"
                                                            type="text"
                                                            name="last_name_verified" id="last_name_verified"
                                                            value="{{ old('last_name_verified', $crmCustomer->last_name_verified) }}">
                                                        @if($errors->has('last_name_verified'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('last_name_verified') }}
                                                            </div>
                                                        @endif
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="employee_amount">Employee Amount</label>
                                                        <input
                                                            class="form-control {{ $errors->has('employee_amount') ? 'is-invalid' : '' }}"
                                                            type="text"
                                                            name="employee_amount" id="employee_amount"
                                                            value="{{ old('employee_amount', $crmCustomer->employee_amount) }}">
                                                        @if($errors->has('employee_amount'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('employee_amount') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="card">
                                                <div class="card-header bg-primary">
                                                    ERC Info
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="file_code">File Code</label>
                                                                <input
                                                                    class="form-control {{ $errors->has('file_code') ? 'is-invalid' : '' }}"
                                                                    type="text"
                                                                    name="file_code" id="file_code"
                                                                    value="{{ old('file_code', $crmCustomer->file_code) }}">
                                                                @if($errors->has('file_code'))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('file_code') }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="w2_employees">W2 Employee</label>
                                                                <select
                                                                    class="form-control {{ $errors->has('w2_employees') ? 'is-invalid' : '' }}"
                                                                    name="w2_employees" id="w2_employees">
                                                                    @foreach(App\Models\CrmCustomer::W2_EMPLOYEES_SELECT as $key => $label)
                                                                        <option
                                                                            value="{{ $key }}" {{ old('w2_employees', $crmCustomer->w2_employees) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @if($errors->has('w2_employees'))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('w2_employees') }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="receive_erc">Receive ERC</label>
                                                                <select
                                                                    class="form-control {{ $errors->has('receive_erc') ? 'is-invalid' : '' }}"
                                                                    name="receive_erc" id="receive_erc">
                                                                    @foreach(App\Models\CrmCustomer::RECEIVE_ERC_SELECT as $key => $label)
                                                                        <option
                                                                            value="{{ $key }}" {{ old('receive_erc', $crmCustomer->receive_erc) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @if($errors->has('receive_erc'))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('receive_erc') }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="ppp_loan">PPP Loan</label>
                                                                <select
                                                                    class="form-control {{ $errors->has('ppp_loan') ? 'is-invalid' : '' }}"
                                                                    name="ppp_loan" id="ppp_loan">
                                                                    @foreach(App\Models\CrmCustomer::PPP_LOAN_SELECT as $key => $label)
                                                                        <option
                                                                            value="{{ $key }}" {{ old('ppp_loan', $crmCustomer->ppp_loan) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @if($errors->has('ppp_loan'))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('ppp_loan') }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="payroll_amount">Payroll Amount</label>
                                                                <input
                                                                    class="form-control {{ $errors->has('payroll_amount') ? 'is-invalid' : '' }}"
                                                                    type="text"
                                                                    name="payroll_amount" id="payroll_amount"
                                                                    value="{{ old('payroll_amount', $crmCustomer->payroll_amount) }}">
                                                                @if($errors->has('payroll_amount'))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('payroll_amount') }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="erc_advance">ERC Advance</label>
                                                                <input
                                                                    class="form-control {{ $errors->has('erc_advance') ? 'is-invalid' : '' }}"
                                                                    type="text"
                                                                    name="erc_advance" id="erc_advance"
                                                                    value="{{ old('erc_advance', $crmCustomer->erc_advance) }}">
                                                                @if($errors->has('erc_advance'))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('erc_advance') }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="erc_amount">ERC Amount</label>
                                                                <input
                                                                    class="form-control {{ $errors->has('erc_amount') ? 'is-invalid' : '' }}"
                                                                    type="text"
                                                                    name="erc_amount" id="erc_amount"
                                                                    value="{{ old('erc_amount', $crmCustomer->erc_amount) }}">
                                                                @if($errors->has('erc_amount'))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('erc_amount') }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="deal_revenue">Deal Revenue</label>
                                                                <input
                                                                    class="form-control {{ $errors->has('deal_revenue') ? 'is-invalid' : '' }}"
                                                                    type="text"
                                                                    name="deal_revenue" id="deal_revenue"
                                                                    value="{{ old('deal_revenue', $crmCustomer->deal_revenue) }}">
                                                                @if($errors->has('deal_revenue'))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('deal_revenue') }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="contingency_fee">Contingency Fee</label>
                                                                <input
                                                                    class="form-control {{ $errors->has('contingency_fee') ? 'is-invalid' : '' }}"
                                                                    type="text"
                                                                    name="contingency_fee" id="contingency_fee"
                                                                    value="{{ old('contingency_fee', $crmCustomer->contingency_fee) }}">
                                                                @if($errors->has('contingency_fee'))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('contingency_fee') }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <div class="card">
                                                <div class="card-header bg-primary">
                                                    Qualification Questionnaire
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="was_your_business_operational">Was your
                                                                    business operational as
                                                                    of January 1, 2019?</label>
                                                                <select
                                                                    class="form-control select2 {{ $errors->has('was_your_business_operational') ? 'is-invalid' : '' }}"
                                                                    name="was_your_business_operational"
                                                                    id="was_your_business_operational">
                                                                    @foreach(App\Models\CrmCustomer::WAS_YOUR_BUSINESS_OPERATIONAL_SELECT as $key => $label)
                                                                        <option
                                                                            value="{{ $key }}" {{ (old('was_your_business_operational') ? old('was_your_business_operational') : $crmCustomer->was_your_business_operational ?? '') == $key ? 'selected' : '' }}>{{ $label }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @if($errors->has('was_your_business_operational'))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('was_your_business_operational') }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="full_time_operational_employees">How many
                                                                    full-time employees
                                                                    did you average for each month you were operational
                                                                    in 2019?</label>
                                                                <input
                                                                    class="form-control {{ $errors->has('full_time_operational_employees') ? 'is-invalid' : '' }}"
                                                                    type="number" name="full_time_operational_employees"
                                                                    min="0"
                                                                    id="full_time_operational_employees"
                                                                    value="{{ old('full_time_operational_employees', $crmCustomer->full_time_operational_employees) }}"
                                                                    step="1">
                                                                @if($errors->has('full_time_operational_employees'))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('full_time_operational_employees') }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="hm_w2_employees">Approximately how many W-2
                                                                    employees did you
                                                                    have at the end of 2020?</label>
                                                                <input
                                                                    class="form-control {{ $errors->has('hm_w2_employees') ? 'is-invalid' : '' }}"
                                                                    type="number" name="hm_w2_employees"
                                                                    id="hm_w2_employees" min="0"
                                                                    value="{{ old('hm_w2_employees', $crmCustomer->hm_w2_employees) }}"
                                                                    step="1">
                                                                @if($errors->has('hm_w2_employees'))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('hm_w2_employees') }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="is_your_business_a_restaurant">Is your
                                                                    business a restaurant? Or
                                                                    does the taxpayer who owns this business
                                                                    also own a restaurant?</label>
                                                                <select
                                                                    class="form-control select2 {{ $errors->has('is_your_business_a_restaurant') ? 'is-invalid' : '' }}"
                                                                    name="is_your_business_a_restaurant"
                                                                    id="is_your_business_a_restaurant">
                                                                    @foreach(App\Models\CrmCustomer::IS_YOUR_BUSINESS_A_RESTAURANT_SELECT as $key => $label)
                                                                        <option
                                                                            value="{{ $key }}" {{ (old('is_your_business_a_restaurant') ? old('is_your_business_a_restaurant') : $crmCustomer->is_your_business_a_restaurant ?? '') == $key ? 'selected' : '' }}>{{ $label }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @if($errors->has('is_your_business_a_restaurant'))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('is_your_business_a_restaurant') }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                @php
                                                                    if(isset($crmCustomer->periods_when_suspended)){
                                                                        $selected = json_decode($crmCustomer->periods_when_suspended, true);
                                                                    }else{
                                                                        $selected = [];
                                                                    }
                                                                @endphp
                                                                <label for="periods_when_suspended">Select all periods
                                                                    that your business
                                                                    was partially or fully suspended due to goverment
                                                                    orders</label>
                                                                <select
                                                                    class="form-control select2 {{ $errors->has('periods_when_suspended') ? 'is-invalid' : '' }}"
                                                                    multiple
                                                                    name="periods_when_suspended[]"
                                                                    id="periods_when_suspended">

                                                                    @foreach(App\Models\CrmCustomer::PERIODS_WHEN_SUSPENDED_SELECT as $key => $label)
                                                                        <option value="{{ $key }}"
                                                                                @if(in_array($key, $selected)) selected="selected" @endif>{{$label}}</option>
                                                                    @endforeach
                                                                </select>
                                                                @if($errors->has('periods_when_suspended'))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('periods_when_suspended') }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="quarter_with_declined_gross">Did any quarter
                                                                    of 2020 have a
                                                                    decline in gross
                                                                    receipts of 50% or more compared to the same quarter
                                                                    in 2019</label>
                                                                <select
                                                                    class="form-control select2 {{ $errors->has('quarter_with_declined_gross') ? 'is-invalid' : '' }}"
                                                                    name="quarter_with_declined_gross"
                                                                    id="quarter_with_declined_gross">
                                                                    @foreach(App\Models\CrmCustomer::QUARTER_WITH_DECLINED_GROSS_SELECT as $key => $label)
                                                                        <option
                                                                            value="{{ $key }}" {{ (old('quarter_with_declined_gross') ? old('quarter_with_declined_gross') : $crmCustomer->quarter_with_declined_gross ?? '') == $key ? 'selected' : '' }}>{{ $label }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @if($errors->has('quarter_with_declined_gross'))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('quarter_with_declined_gross') }}
                                                                    </div>
                                                                @endif
                                                            </div>

                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="q1_2021_vs_q1_2019">Did Q1 of 2021 have a
                                                                    20% or more decline
                                                                    compared to Q1 of
                                                                    2019?</label>
                                                                <select
                                                                    class="form-control select2 {{ $errors->has('q1_2021_vs_q1_2019') ? 'is-invalid' : '' }}"
                                                                    name="q1_2021_vs_q1_2019" id="q1_2021_vs_q1_2019">
                                                                    @foreach(App\Models\CrmCustomer::Q1_2021_VS_Q1_2019_SELECT as $key => $label)
                                                                        <option
                                                                            value="{{ $key }}" {{ (old('q1_2021_vs_q1_2019') ? old('q1_2021_vs_q1_2019') : $crmCustomer->q1_2021_vs_q1_2019 ?? '') == $key ? 'selected' : '' }}>{{ $label }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @if($errors->has('q1_2021_vs_q1_2019'))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('q1_2021_vs_q1_2019') }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="q3_2021_vs_q3_2019">Did Q3 of 2021 have a
                                                                    decline of 20% or more
                                                                    compared
                                                                    to Q3 of 2019?</label>
                                                                <select
                                                                    class="form-control select2 {{ $errors->has('q3_2021_vs_q3_2019') ? 'is-invalid' : '' }}"
                                                                    name="q3_2021_vs_q3_2019" id="q3_2021_vs_q3_2019">
                                                                    @foreach(App\Models\CrmCustomer::Q3_2021_VS_Q3_2019_SELECT as $key => $label)
                                                                        <option
                                                                            value="{{ $key }}" {{ (old('q3_2021_vs_q3_2019') ? old('q3_2021_vs_q3_2019') : $crmCustomer->q3_2021_vs_q3_2019 ?? '') == $key ? 'selected' : '' }}>{{ $label }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @if($errors->has('q3_2021_vs_q3_2019'))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('q3_2021_vs_q3_2019') }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="q2_2021_vs_q2_2019">Did Q2 of 2021 have a
                                                                    20% or more decline
                                                                    compared
                                                                    to Q2 of 2019?</label>
                                                                <select
                                                                    class="form-control select2 {{ $errors->has('q2_2021_vs_q2_2019') ? 'is-invalid' : '' }}"
                                                                    name="q2_2021_vs_q2_2019" id="q2_2021_vs_q2_2019">
                                                                    @foreach(App\Models\CrmCustomer::Q2_2021_VS_Q2_2019_SELECT as $key => $label)
                                                                        <option
                                                                            value="{{ $key }}" {{ (old('q2_2021_vs_q2_2019') ? old('q2_2021_vs_q2_2019') : $crmCustomer->q2_2021_vs_q2_2019 ?? '') == $key ? 'selected' : '' }}>{{ $label }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @if($errors->has('q2_2021_vs_q2_2019'))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('q2_2021_vs_q2_2019') }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="q4_2021_vs_q4_2019">Did Q4 of 2020 decline
                                                                    20% or more compare
                                                                    to Q2 of 2019?</label>
                                                                <select
                                                                    class="form-control select2 {{ $errors->has('q4_2021_vs_q4_2019') ? 'is-invalid' : '' }}"
                                                                    name="q4_2021_vs_q4_2019" id="q4_2021_vs_q4_2019">
                                                                    @foreach(App\Models\CrmCustomer::Q4_2021_VS_Q4_2019_SELECT as $key => $label)
                                                                        <option
                                                                            value="{{ $key }}" {{ (old('q4_2021_vs_q4_2019') ? old('q4_2021_vs_q4_2019') : $crmCustomer->q4_2021_vs_q4_2019 ?? '') == $key ? 'selected' : '' }}>{{ $label }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @if($errors->has('q4_2021_vs_q4_2019'))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('q4_2021_vs_q4_2019') }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="total_dollar_amount_ppp_loan_received_2020">What
                                                                    is the total
                                                                    dollar amount
                                                                    of PPP Loans received in 2020?</label>
                                                                <input type="text"
                                                                       class="form-control {{ $errors->has('total_dollar_amount_ppp_loan_received_2020') ? 'is-invalid' : '' }}"
                                                                       name="total_dollar_amount_ppp_loan_received_2020"
                                                                       id="total_dollar_amount_ppp_loan_received_2020"
                                                                       value="{{ old('total_dollar_amount_ppp_loan_received_2020', $crmCustomer->total_dollar_amount_ppp_loan_received_2020) }}">
                                                                @if($errors->has('total_dollar_amount_ppp_loan_received_2020'))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('total_dollar_amount_ppp_loan_received_2020') }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="total_dollar_amount_ppp_loan_received_2021">What
                                                                    is the total
                                                                    dollar amount
                                                                    of PPP Loans received in 2021?</label>
                                                                <input type="text"
                                                                       class="form-control {{ $errors->has('total_dollar_amount_ppp_loan_received_2021') ? 'is-invalid' : '' }}"
                                                                       name="total_dollar_amount_ppp_loan_received_2021"
                                                                       id="total_dollar_amount_ppp_loan_received_2021"
                                                                       value="{{ old('total_dollar_amount_ppp_loan_received_2021', $crmCustomer->total_dollar_amount_ppp_loan_received_2021) }}">
                                                                @if($errors->has('total_dollar_amount_ppp_loan_received_2021'))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('total_dollar_amount_ppp_loan_received_2021') }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="total_payroll_2020">What was your total
                                                                    payroll for 2020?
                                                                    This does not include 1099. As 1099 do not qualify
                                                                    or contract
                                                                    workers.</label>
                                                                <input type="text"
                                                                       class="form-control {{ $errors->has('total_payroll_2020') ? 'is-invalid' : '' }}"
                                                                       name="total_payroll_2020" id="total_payroll_2020"
                                                                       value="{{ old('total_payroll_2020', $crmCustomer->total_payroll_2020) }}">
                                                                @if($errors->has('total_payroll_2020'))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('total_payroll_2020') }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-danger" type="submit" onclick="this.disable = 'disable'">
                                            {{ trans('global.save') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <audio id="audio-interface" autoplay></audio>
        </main>
        <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/perfect-scrollbar.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@3.2/dist/js/coreui.min.js"></script>
{{--<script src="https://unpkg.com/@coreui/coreui@3.2/dist/js/coreui.min.js"></script>--}}
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script>
    $(function () {
        let copyButtonTrans = '{{ trans('global.datatables.copy') }}'
        let csvButtonTrans = '{{ trans('global.datatables.csv') }}'
        let excelButtonTrans = '{{ trans('global.datatables.excel') }}'
        let pdfButtonTrans = '{{ trans('global.datatables.pdf') }}'
        let printButtonTrans = '{{ trans('global.datatables.print') }}'
        let colvisButtonTrans = '{{ trans('global.datatables.colvis') }}'
        let selectAllButtonTrans = '{{ trans('global.select_all') }}'
        let selectNoneButtonTrans = '{{ trans('global.deselect_all') }}'

        let languages = {
            'en': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/English.json',
            'es': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
        };

        $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, {className: 'btn'})
        $.extend(true, $.fn.dataTable.defaults, {
            language: {
                url: languages['{{ app()->getLocale() }}']
            },
            columnDefs: [{
                orderable: false,
                className: 'select-checkbox',
                targets: 0
            }, {
                orderable: false,
                searchable: false,
                targets: -1
            }],
            select: {
                style: 'multi+shift',
                selector: 'td:first-child'
            },
            order: [],
            scrollX: true,
            pageLength: 100,
            dom: 'lBfrtip<"actions">',
            buttons: [
                {
                    extend: 'selectAll',
                    className: 'btn-primary',
                    text: selectAllButtonTrans,
                    exportOptions: {
                        columns: ':visible'
                    },
                    action: function (e, dt) {
                        e.preventDefault()
                        dt.rows().deselect();
                        dt.rows({search: 'applied'}).select();
                    }
                },
                {
                    extend: 'selectNone',
                    className: 'btn-primary',
                    text: selectNoneButtonTrans,
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'copy',
                    className: 'btn-default',
                    text: copyButtonTrans,
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'csv',
                    className: 'btn-default',
                    text: csvButtonTrans,
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'excel',
                    className: 'btn-default',
                    text: excelButtonTrans,
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdf',
                    className: 'btn-default',
                    text: pdfButtonTrans,
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'print',
                    className: 'btn-default',
                    text: printButtonTrans,
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'colvis',
                    className: 'btn-default',
                    text: colvisButtonTrans,
                    exportOptions: {
                        columns: ':visible'
                    }
                }
            ]
        });

        $.fn.dataTable.ext.classes.sPageButton = '';
    });

</script>
<script>
    $(document).ready(function () {
        $(".notifications-menu").on('click', function () {
            if (!$(this).hasClass('open')) {
                $('.notifications-menu .label-warning').hide();
                $.get('/admin/user-alerts/read');
            }
        });
    });

</script>
{{--    vue--}}
<script src="{{ mix('/js/app.js') }}"></script>


@yield('scripts')
</body>

</html>

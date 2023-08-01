@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-10">
                    @if(auth()->user()->sip_enabled)
                        <div v-if="registered" id="makecallcard">
                            <div class="btn btn-danger"
                                 v-if="activeCall  != null &&  activeCall.state != 'active' && activeCall.state != 'destroy' && activeCall.state != 'early'"
                                 v-on:click="hangup()">@{{$root.activeCall.state}}</div>
                            <div class="btn btn-danger"
                                 v-else-if="activeCall  != null && activeCall.state === 'active' ||activeCall  != null && activeCall.state === 'early'"
                                 v-on:click="hangup()">Hang up
                            </div>
                            <div v-else>
                                <div class="btn btn-primary" v-on:click="makeCall('{{$crmCustomer->phone}}')">Call {{$crmCustomer->first_name ?? ''}} {{$crmCustomer->last_name ?? ''}}</div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-2 text-right">
                    Lead claimed by: <span class="badge badge-primary">{{ $crmCustomer->owner->name ?? '' }}</span>
                </div>
            </div>

        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.crm-customers.update", [$crmCustomer->id]) }}"
                  enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <button class="btn btn-danger" type="submit" onclick="this.disable = 'disable'">
                        {{ trans('global.save') }}
                    </button>
                    <button class="btn btn-info" type="button" onclick="sendSecureLink({{$crmCustomer->id}},event)">
                        {{ trans('global.send_secure_link') }}
                    </button>
                </div>
                @if($user->getIsAdminAttribute())
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class=""
                                       for="user_id">Assign to:</label>
                                <select
                                    class="form-control select2 {{ $errors->has('user_id') ? 'is-invalid' : '' }}"
                                    name="user_id" id="user_id">
                                    @foreach($users as $id => $entry)
                                        <option
                                            value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $entry->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('user_id'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('user_id') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.crmCustomer.fields.status_helper') }}</span>
                            </div>
                        </div>
                    </div>
                @endif
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
                                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                           type="text" name="email"
                                           id="email" value="{{ old('email', $crmCustomer->email) }}">
                                    @if($errors->has('email'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('email') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.crmCustomer.fields.email_helper') }}</span>
                                </div>
                                <div class="form-group">
                                    <label class="required"
                                           for="phone">{{ trans('cruds.crmCustomer.fields.phone') }}</label>
                                    <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                                           type="text" name="phone"
                                           id="phone" value="{{ old('phone', $crmCustomer->phone) }}">
                                    @if($errors->has('phone'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('phone') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.crmCustomer.fields.phone_helper') }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="cellphone">Cellphone</label>
                                    <input class="form-control {{ $errors->has('cellphone') ? 'is-invalid' : '' }}"
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
                                    <input class="form-control {{ $errors->has('company_name') ? 'is-invalid' : '' }}"
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
                                    <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}"
                                           type="text"
                                           name="address" id="address"
                                           value="{{ old('address', $crmCustomer->address) }}">
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
                                    <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}"
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
                                    <input class="form-control {{ $errors->has('state') ? 'is-invalid' : '' }}"
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
                                    <input class="form-control {{ $errors->has('zip_code') ? 'is-invalid' : '' }}"
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
                                    <input class="form-control {{ $errors->has('country') ? 'is-invalid' : '' }}"
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
                                    <input class="form-control {{ $errors->has('employee_count') ? 'is-invalid' : '' }}"
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
                    <div class="col-8">
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
                                                <option value disabled {{ old('w2_employees', null) === null ? 'selected' : '' }}>
                                                    {{ trans('global.pleaseSelect') }}
                                                </option>
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
                                                <option value disabled {{ old('receive_erc', null) === null ? 'selected' : '' }}>
                                                    {{ trans('global.pleaseSelect') }}
                                                </option>
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
                                                <option value disabled {{ old('ppp_loan', null) === null ? 'selected' : '' }}>
                                                    {{ trans('global.pleaseSelect') }}
                                                </option>
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
                                        <div class="form-group">
                                            <label class="required"
                                                   for="status_id">{{ trans('cruds.crmCustomer.fields.status') }}</label>
                                            <select
                                                class="form-control select2 required {{ $errors->has('status') ? 'is-invalid' : '' }}"
                                                name="status_id" id="status_id">
                                                @foreach($statuses as $id => $entry)
                                                    <option
                                                        value="{{ $id }}" {{ (old('status_id') ? old('status_id') : $crmCustomer->status->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('status'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('status') }}
                                                </div>
                                            @endif
                                            <span
                                                class="help-block">{{ trans('cruds.crmCustomer.fields.status_helper') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card">
                            <div class="card-header bg-primary">
                                Documents
                            </div>
                            <div class="card-body">
                                @foreach($documentTypes as $key => $documentType)
                                    <div class="form-group row">
                                        <div class="col">
                                            <label for="document_type_{{ $key }}">{{ $documentType->name }}</label>
                                        </div>
                                        <div class="col">
                                            <label for="requested_documents">Requested</label>
                                            <input id="requested_documents" name="requested_documents[]"
                                                   type="checkbox" value="{{$documentType->id}}"
                                                   @if($documentType->requested == 1) checked @endif>
                                        </div>
                                        <div class="col">
                                            <label for="received_documents">Received</label>
                                            <input id="received_documents" name="received_documents[]"
                                                   type="checkbox" value="{{$documentType->id}}"
                                                   @if($documentType->received == 1) checked @endif
                                                   disabled>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="row" style="margin-bottom: 10px;">
                                    <div class="col-lg-12">
                                        <a class="btn btn-success"
                                           href="/admin/crm-documents/create?customer_id={{$crmCustomer->id}}">
                                            {{ trans('global.add') }} {{ trans('cruds.crmDocument.title_singular') }}
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table
                                            class=" table table-bordered table-striped table-hover datatable datatable-CrmDocument">
                                            <thead>
                                            <tr>
                                                <th>
                                                    {{ trans('cruds.crmDocument.fields.document_file') }}
                                                </th>
                                                <th>
                                                    {{ trans('cruds.crmDocument.fields.name') }}
                                                </th>
                                                <th>
                                                    &nbsp;Actions
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($crmDocuments as $key => $crmDocument)
                                                <tr data-entry-id="{{ $crmDocument->id }}">
                                                    <td>
                                                        @if($crmDocument->document_file)
                                                            <a href="{{ $crmDocument->document_file->getUrl() }}"
                                                               target="_blank">
                                                                {{ trans('global.view_file') }}
                                                            </a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{ $crmDocument->documentType->name ?? '' }}
                                                    </td>
                                                    <td>
                                                        @can('crm_document_show')
                                                            <a class="btn btn-xs btn-primary"
                                                               href="{{ route('admin.crm-documents.show', $crmDocument->id) }}">
                                                                {{ trans('global.view') }}
                                                            </a>
                                                        @endcan

                                                        @can('crm_document_edit')
                                                            <a class="btn btn-xs btn-info"
                                                               href="{{ route('admin.crm-documents.edit', $crmDocument->id) }}">
                                                                {{ trans('global.edit') }}
                                                            </a>
                                                        @endcan

                                                        @can('crm_document_delete')
                                                            <input type="submit" class="btn btn-xs btn-danger"
                                                                   value="{{ trans('global.delete') }}"
                                                                   onclick="deleteDocument({{$crmDocument->id}})">
                                                        @endcan

                                                    </td>

                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
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
                                            <label for="was_your_business_operational">Was your business operational as
                                                of January 1, 2019?</label>
                                            <select
                                                class="form-control select2 {{ $errors->has('was_your_business_operational') ? 'is-invalid' : '' }}"
                                                name="was_your_business_operational" id="was_your_business_operational">
                                                <option value disabled {{ old('was_your_business_operational', null) === null ? 'selected' : '' }}>
                                                    {{ trans('global.pleaseSelect') }}
                                                </option>
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
                                            <label for="full_time_operational_employees">How many full-time employees
                                                did you average for each month you were operational in 2019?</label>
                                            <input
                                                class="form-control {{ $errors->has('full_time_operational_employees') ? 'is-invalid' : '' }}"
                                                type="number" name="full_time_operational_employees" min="0"
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
                                            <label for="hm_w2_employees">Approximately how many W-2 employees did you
                                                have at the end of 2020?</label>
                                            <input
                                                class="form-control {{ $errors->has('hm_w2_employees') ? 'is-invalid' : '' }}"
                                                type="number" name="hm_w2_employees" id="hm_w2_employees" min="0"
                                                value="{{ old('hm_w2_employees', $crmCustomer->hm_w2_employees) }}"
                                                step="1">
                                            @if($errors->has('hm_w2_employees'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('hm_w2_employees') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="is_your_business_a_restaurant">Is your business a restaurant? Or
                                                does the taxpayer who owns this business
                                                also own a restaurant?</label>
                                            <select
                                                class="form-control select2 {{ $errors->has('is_your_business_a_restaurant') ? 'is-invalid' : '' }}"
                                                name="is_your_business_a_restaurant" id="is_your_business_a_restaurant">
                                                <option value disabled {{ old('is_your_business_a_restaurant', null) === null ? 'selected' : '' }}>
                                                    {{ trans('global.pleaseSelect') }}
                                                </option>
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
                                            <label for="periods_when_suspended">Select all periods that your business
                                                was partially or fully suspended due to goverment orders</label>
                                            <select
                                                class="form-control select2 {{ $errors->has('periods_when_suspended') ? 'is-invalid' : '' }}"
                                                multiple
                                                name="periods_when_suspended[]" id="periods_when_suspended">
                                                <option value disabled {{ old('periods_when_suspended', null) === null ? 'selected' : '' }}>
                                                    {{ trans('global.pleaseSelect') }}
                                                </option>
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
                                            <label for="quarter_with_declined_gross">Did any quarter of 2020 have a
                                                decline in gross
                                                receipts of 50% or more compared to the same quarter in 2019</label>
                                            <select
                                                class="form-control select2 {{ $errors->has('quarter_with_declined_gross') ? 'is-invalid' : '' }}"
                                                name="quarter_with_declined_gross" id="quarter_with_declined_gross">
                                                <option value disabled {{ old('quarter_with_declined_gross', null) === null ? 'selected' : '' }}>
                                                    {{ trans('global.pleaseSelect') }}
                                                </option>
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
                                            <label for="q1_2021_vs_q1_2019">Did Q1 of 2021 have a 20% or more decline
                                                compared to Q1 of
                                                2019?</label>
                                            <select
                                                class="form-control select2 {{ $errors->has('q1_2021_vs_q1_2019') ? 'is-invalid' : '' }}"
                                                name="q1_2021_vs_q1_2019" id="q1_2021_vs_q1_2019">
                                                <option value disabled {{ old('q1_2021_vs_q1_2019', null) === null ? 'selected' : '' }}>
                                                    {{ trans('global.pleaseSelect') }}
                                                </option>
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
                                            <label for="q3_2021_vs_q3_2019">Did Q3 of 2021 have a decline of 20% or more
                                                compared
                                                to Q3 of 2019?</label>
                                            <select
                                                class="form-control select2 {{ $errors->has('q3_2021_vs_q3_2019') ? 'is-invalid' : '' }}"
                                                name="q3_2021_vs_q3_2019" id="q3_2021_vs_q3_2019">
                                                <option value disabled {{ old('q3_2021_vs_q3_2019', null) === null ? 'selected' : '' }}>
                                                    {{ trans('global.pleaseSelect') }}
                                                </option>
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
                                            <label for="q2_2021_vs_q2_2019">Did Q2 of 2021 have a 20% or more decline
                                                compared
                                                to Q2 of 2019?</label>
                                            <select
                                                class="form-control select2 {{ $errors->has('q2_2021_vs_q2_2019') ? 'is-invalid' : '' }}"
                                                name="q2_2021_vs_q2_2019" id="q2_2021_vs_q2_2019">
                                                <option value disabled {{ old('q2_2021_vs_q2_2019', null) === null ? 'selected' : '' }}>
                                                    {{ trans('global.pleaseSelect') }}
                                                </option>
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
                                            <label for="q4_2021_vs_q4_2019">Did Q4 of 2020 decline 20% or more compare
                                                to Q2 of 2019?</label>
                                            <select
                                                class="form-control select2 {{ $errors->has('q4_2021_vs_q4_2019') ? 'is-invalid' : '' }}"
                                                name="q4_2021_vs_q4_2019" id="q4_2021_vs_q4_2019">
                                                <option value disabled {{ old('q4_2021_vs_q4_2019', null) === null ? 'selected' : '' }}>
                                                    {{ trans('global.pleaseSelect') }}
                                                </option>
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
                                            <label for="total_dollar_amount_ppp_loan_received_2020">What is the total
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
                                            <label for="total_dollar_amount_ppp_loan_received_2021">What is the total
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
                                            <label for="total_payroll_2020">What was your total payroll for 2020?
                                                This does not include 1099. As 1099 do not qualify or contract
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
                    <div class="col-4">
                        <div class="card">
                            <div class="card-header bg-primary">
                                Notes History
                            </div>
                            <div class="card-body">
                                <div class="row" style="margin-bottom: 10px;">
                                    <div class="col-lg-12">
                                        <a class="btn btn-success" href="/admin/crm-notes/create?customer_id={{$crmCustomer->id}}">
                                            {{ trans('global.add') }} {{ trans('cruds.crmNote.title_singular') }}
                                        </a>
                                    </div>
                                </div>
                                @foreach($crmCustomer->leadNotes->sortDesc() as $key => $crmNote)
                                    <div class="card">
                                        <div class="card-body">
                                            <blockquote class="blockquote mb-0">
                                                <p>{{ $crmNote->note }}</p>
                                                <footer class="blockquote-footer">{{ $crmNote->created_at }} by @if(isset($crmNote->user->id)) {{ $crmNote->user->name ?? 'System Admin' }}@endif</footer>
                                            </blockquote>
                                        </div>
                                    </div>

                                @endforeach
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

@endsection

<script>
    deleteDocument = function (id) {
        if (confirm('Are you sure you want to delete this document?')) {
            $.ajax({
                url: '/admin/crm-documents/' + id,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function (result) {
                    location.reload();
                }
            });
        }
    }
</script>
<script>
    sendSecureLink = function (id,e) {
        e.preventDefault();
        if (confirm('Are you sure you want to send this secure link?')) {
            $.ajax({
                url: '/admin/crm-documents/send-secure-link/' + id,
                type: 'GET',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function (result) {
                    location.reload();
                }
            });
        }
    }
</script>

@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.crmCustomer.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.crm-customers.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="required" for="first_name">{{ trans('cruds.crmCustomer.fields.first_name') }}</label>
                    <input class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" type="text"
                           name="first_name" id="first_name" value="{{ old('first_name', '') }}" required>
                    @if($errors->has('first_name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('first_name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.crmCustomer.fields.first_name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="last_name">{{ trans('cruds.crmCustomer.fields.last_name') }}</label>
                    <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text"
                           name="last_name" id="last_name" value="{{ old('last_name', '') }}" required>
                    @if($errors->has('last_name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('last_name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.crmCustomer.fields.last_name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="email">{{ trans('cruds.crmCustomer.fields.email') }}</label>
                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email"
                           id="email" value="{{ old('email', '') }}" required>
                    @if($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.crmCustomer.fields.email_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="phone">{{ trans('cruds.crmCustomer.fields.phone') }}</label>
                    <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone"
                           id="phone" value="{{ old('phone', '') }}" required>
                    @if($errors->has('phone'))
                        <div class="invalid-feedback">
                            {{ $errors->first('phone') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.crmCustomer.fields.phone_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="cellphone">Cellphone</label>
                    <input class="form-control {{ $errors->has('cellphone') ? 'is-invalid' : '' }}" type="text"
                           name="cellphone" id="cellphone" value="{{ old('cellphone', '') }}">
                    @if($errors->has('cellphone'))
                        <div class="invalid-feedback">
                            {{ $errors->first('cellphone') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="other_phone">Other Phone</label>
                    <input class="form-control {{ $errors->has('other_phone') ? 'is-invalid' : '' }}" type="text"
                           name="other_phone" id="other_phone" value="{{ old('other_phone', '') }}">
                    @if($errors->has('other_phone'))
                        <div class="invalid-feedback">
                            {{ $errors->first('other_phone') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label class="required" for="address">{{ trans('cruds.crmCustomer.fields.address') }}</label>
                    <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text"
                           name="address" id="address" value="{{ old('address', '') }}" required>
                    @if($errors->has('address'))
                        <div class="invalid-feedback">
                            {{ $errors->first('address') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.crmCustomer.fields.address_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="status_id">{{ trans('cruds.crmCustomer.fields.status') }}</label>
                    <select class="form-control select2 required {{ $errors->has('status') ? 'is-invalid' : '' }}"
                            name="status_id" id="status_id">
                        @foreach($statuses as $id => $entry)
                            <option
                                value="{{ $id }}" {{ old('status_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                    <label for="city">City</label>
                    <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city"
                           id="city" value="{{ old('city', '') }}">
                    @if($errors->has('city'))
                        <div class="invalid-feedback">
                            {{ $errors->first('city') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <lable for="country">Country</lable>
                    <input class="form-control {{ $errors->has('country') ? 'is-invalid' : '' }}" type="text"
                           name="country" id="country" value="{{ old('country', '') }}">
                    @if($errors->has('country'))
                        <div class="invalid-feedback">
                            {{ $errors->first('country') }}
                        </div>
                    @endif
                    <span class="help-block">max 2 characters ex: US</span>
                </div>
                <div class="form-group">
                    <label for="state">State</label>
                    <input class="form-control {{ $errors->has('state') ? 'is-invalid' : '' }}" type="text" name="state"
                           id="state" value="{{ old('state', '') }}">
                    @if($errors->has('state'))
                        <div class="invalid-feedback">
                            {{ $errors->first('state') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="zip_code">Zip Code</label>
                    <input class="form-control {{ $errors->has('zip_code') ? 'is-invalid' : '' }}" type="text"
                           name="zip_code" id="zip_code" value="{{ old('zip_code', '') }}">
                    @if($errors->has('zip_code'))
                        <div class="invalid-feedback">
                            {{ $errors->first('zip_code') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="file_code">File Code</label>
                    <input class="form-control {{ $errors->has('file_code') ? 'is-invalid' : '' }}" type="text"
                           name="file_code" id="file_code" value="{{ old('file_code', '') }}">
                    @if($errors->has('file_code'))
                        <div class="invalid-feedback">
                            {{ $errors->first('file_code') }}
                        </div>
                    @endif
                </div>
{{--                inputs for custom fields from 2 to 10 --}}
                @for($i = 1; $i <= 10; $i++)
                    <div class="form-group">
                        <label for="custom_field_{{ $i }}">Custom Field {{ $i }}</label>
                        <input class="form-control {{ $errors->has('custom_field_' . $i) ? 'is-invalid' : '' }}" type="text"
                               name="custom_field_{{ $i }}" id="custom_field_{{ $i }}" value="{{ old('custom_field_' . $i, '') }}">
                        @if($errors->has('custom_field_' . $i))
                            <div class="invalid-feedback">
                                {{ $errors->first('custom_field_' . $i) }}
                            </div>
                        @endif
                    </div>
                @endfor

                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection

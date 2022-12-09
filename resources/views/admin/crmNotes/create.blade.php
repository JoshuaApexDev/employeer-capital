@extends('layouts.admin')
@section('content')

<div class="card">
    @if($customer != null)
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.crmNote.title_singular') }} for {{ $customer->first_name }} {{ $customer->last_name }}
        </div>
    @else
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.crmNote.title_singular') }}
        </div>
    @endif

    <div class="card-body">
        <form method="POST" action="{{ route("admin.crm-notes.store") }}" enctype="multipart/form-data">
            @csrf
            @if($customer != null)
                <input type="hidden" name="customer_id" value="{{ $customer->id }}">
            @else
                <div class="form-group">
                    <label class="required" for="customer_id">{{ trans('cruds.crmNote.fields.customer') }}</label>
                    <select class="form-control select2 {{ $errors->has('customer') ? 'is-invalid' : '' }}" name="customer_id" id="customer_id" required>
                        @foreach($customers as $id => $entry)
                            <option value="{{ $entry->id }}" {{ old('customer_id') == $entry->id ? 'selected' : '' }}>{{ $entry->first_name }} {{ $entry->last_name }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('customer'))
                        <div class="invalid-feedback">
                            {{ $errors->first('customer') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.crmNote.fields.customer_helper') }}</span>
                </div>
            @endif
            <div class="form-group">
                <label class="required" for="note">{{ trans('cruds.crmNote.fields.note') }}</label>
                <textarea class="form-control {{ $errors->has('note') ? 'is-invalid' : '' }}" name="note" id="note" required>{{ old('note') }}</textarea>
                @if($errors->has('note'))
                    <div class="invalid-feedback">
                        {{ $errors->first('note') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmNote.fields.note_helper') }}</span>
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

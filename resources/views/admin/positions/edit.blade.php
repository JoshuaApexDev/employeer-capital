@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.position.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.positions.update", [$position->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="position_name">{{ trans('cruds.position.fields.position_name') }}</label>
                <input class="form-control {{ $errors->has('position_name') ? 'is-invalid' : '' }}" type="text" name="position_name" id="position_name" value="{{ old('position_name', $position->position_name) }}" required>
                @if($errors->has('position_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('position_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.position.fields.position_name_helper') }}</span>
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
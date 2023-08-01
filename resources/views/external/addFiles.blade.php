@extends('layouts.guest')
@section('content')
<?php
$customer = $data['customer'];
?>
    @if($customer != null)
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.crmDocument.title_singular') }} for {{ $customer->first_name }} {{ $customer->last_name }}
        </div>
    @else
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.crmDocument.title_singular') }}
        </div>
    @endif

    <div class="card-body">
        <form method="POST" action="{{ route("crm-documents.store.external") }}" enctype="multipart/form-data">
            @csrf
            @if($customer != null)
                <input type="hidden" name="customer_id" value="{{ $customer->id }}">
            @else
                <div class="form-group">
                    <label class="required" for="customer_id">{{ trans('cruds.crmDocument.fields.customer') }}</label>
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
                    <span class="help-block">{{ trans('cruds.crmDocument.fields.customer_helper') }}</span>
                </div>
            @endif

            <div class="form-group">
                <label class="required" for="document_file">{{ trans('cruds.crmDocument.fields.document_file') }}</label>
                <label class="ml-4 blue-grey" for="document_file">{{ trans('cruds.crmDocument.instructions.one_by_one') }}</label>
                <label class="ml-4 blue-grey" for="document_file">{{ trans('cruds.crmDocument.instructions.max_file_size') }}</label>
                <label class="ml-4 blue-grey" for="document_file">{{ trans('cruds.crmDocument.instructions.allowed_file') }}</label>
                <label class="ml-4 blue-grey" for="document_file">{{ trans('cruds.crmDocument.instructions.drag_drop') }}</label>
                <div class="needsclick dropzone {{ $errors->has('document_file') ? 'is-invalid' : '' }}" id="document_file-dropzone">
                </div>
                @if($errors->has('document_file'))
                    <div class="invalid-feedback">
                        {{ $errors->first('document_file') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmDocument.fields.document_file_helper') }}</span>
            </div>
{{--            <div class="form-group">--}}
{{--                <label for="name">{{ trans('cruds.crmDocument.fields.name') }}</label>--}}
{{--                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}">--}}
{{--                @if($errors->has('name'))--}}
{{--                    <div class="invalid-feedback">--}}
{{--                        {{ $errors->first('name') }}--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--                <span class="help-block">{{ trans('cruds.crmDocument.fields.name_helper') }}</span>--}}
{{--            </div>--}}
            <div class="form-group">
                <label for="document_type">Document Type</label>
                <label class="ml-4 blue-grey" for="document_file">{{ trans('cruds.crmDocument.instructions.sure_category') }}</label>
                <select
                    class="form-control"
                    name="document_type_id" id="document_type_id">
                    @foreach($document_types as $id => $document_type)
                        <option value="{{ $document_type->id }}" {{ old('document_type_id') == $document_type->id ? 'selected' : '' }}>{{ $document_type->name }}</option>
                    @endforeach
                </select>
            </div>
{{--            <div class="form-group">--}}
{{--                <label for="description">{{ trans('cruds.crmDocument.fields.description') }}</label>--}}
{{--                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description') }}</textarea>--}}
{{--                @if($errors->has('description'))--}}
{{--                    <div class="invalid-feedback">--}}
{{--                        {{ $errors->first('description') }}--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--                <span class="help-block">{{ trans('cruds.crmDocument.fields.description_helper') }}</span>--}}
{{--            </div>--}}
            <div class="form-group">
                <label class="blue-grey" for="document_file">{{ trans('cruds.crmDocument.instructions.click_upload') }}</label>
                <br>
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    Dropzone.options.documentFileDropzone = {
        addRemoveLinks: true,
        error: function (file, response) {
            if ($.type(response) === 'string') {
                var message = response //dropzone sends it's own error messages in string
            } else {
                var message = response.errors.file
            }
            file.previewElement.classList.add('dz-error')
            _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
            _results = []
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                node = _ref[_i]
                _results.push(node.textContent = message)
            }
            return _results
        }, // MB
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        init: function () {
            @if(isset($crmDocument) && $crmDocument->document_file)
            var file = {!! json_encode($crmDocument->document_file) !!}
            this.options.addedfile.call(this, file)
            file.previewElement.classList.add('dz-complete')
            $('form').append('<input type="hidden" name="document_file" value="' + file.file_name + '">')
            this.options.maxFiles = this.options.maxFiles - 1
            @endif
        },
        // Modify the text that appears in the dropzone

        maxFiles: 1,
        maxFilesize: 5,
        params: {
            size: 40
        },
        removedfile: function (file) {
            file.previewElement.remove()
            if (file.status !== 'error') {
                $('form').find('input[name="document_file"]').remove()
                this.options.maxFiles = this.options.maxFiles + 1
            }
        },
        success: function (file, response) {
            $('form').find('input[name="document_file"]').remove()
            $('form').append('<input type="hidden" name="document_file" value="' + response.name + '">')
        },
        url: '{{ route('crm-documents.storeMedia') }}'
    };
  window.addEventListener("load", function() {
        // Change the helper text
        let dzMessage = document.querySelector(".dz-default.dz-message");
        let spanElement = dzMessage.querySelector("span");
        spanElement.textContent = "Drag and drop files here or click to upload";
      });

</script>
@endsection

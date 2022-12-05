@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} lead: {{ $crmCustomer->first_name }} {{ $crmCustomer->last_name }} |
            status:
            <div class="badge badge-primary">{{ $crmCustomer->status->name ?? '' }}</div>
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.crm-customers.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                    <a class="btn btn-warning" href="print/{{$crmCustomer->id }}">
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
                            Cellphone
                        </th>
                        <td>
                            {{ $crmCustomer->cellphone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Other Phone
                        </th>
                        <td>
                            {{ $crmCustomer->other_phone }}
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
                            Country
                        </th>
                        <td>
                            {{ $crmCustomer->country ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            State
                        </th>
                        <td>
                            {{ $crmCustomer->state ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            City
                        </th>
                        <td>
                            {{ $crmCustomer->city ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Zip Code
                        </th>
                        <td>
                            {{ $crmCustomer->zip_code ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            File code
                        </th>
                        <td>
                            {{ $crmCustomer->file_code ?? '' }}
                        </td>
                    </tr>
                    @for($i = 1; $i <= 10; $i++)
                        @php
                            $field = 'custom_field_'.$i;
                            $field = $crmCustomer->$field;
                        @endphp
                        <tr>
                            <th>
                                Custom Field {{$i}}
                            </th>
                            <td>
                                {{ $field ?? '' }}
                            </td>
                        </tr>
                    @endfor
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

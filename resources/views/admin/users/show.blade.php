@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.user.title') }}
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">User info</div>
                        <div class="card-body">
                            <div class="form-group">
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.user.fields.id') }}
                                        </th>
                                        <td>
                                            {{ $user->id }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.user.fields.name') }}
                                        </th>
                                        <td>
                                            {{ $user->name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.user.fields.email') }}
                                        </th>
                                        <td>
                                            {{ $user->email }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.user.fields.email_verified_at') }}
                                        </th>
                                        <td>
                                            {{ $user->email_verified_at }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.user.fields.roles') }}
                                        </th>
                                        <td>
                                            @foreach($user->roles as $key => $roles)
                                                <span class="label label-info">{{ $roles->title }}</span>
                                            @endforeach
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">Sip setup</div>
                        <div class="card-body">
                            <div class="form-group">
                                <form method="POST" action="{{route('admin.user-sip.update', $user->id)}}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="sip_extension">Extension</label>
                                        <input type="text" name="sip_extension" id="sip_extension" class="form-control" value="{{$user->sip_extension}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="sip_password">Password</label>
                                        <input type="text" name="sip_password" id="sip_password" class="form-control" value="{{$user->sip_password}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="sip_caller_id">Sip Caller ID</label>
                                        <input type="text" name="sip_caller_id" id="sip_caller_id" class="form-control" value="{{$user->sip_caller_id}}">
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" name="sip_enabled" id="sip_enabled" class="form-check-input" {{($user->sip_enabled ? 'checked' : '')}}>
                                        <label class="form-check-label" for="sip_enabled">Enabled</label>
                                    </div>
                                    <div class="form-group mt-5">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            {{ trans('global.relatedData') }}
        </div>
        <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
            <li class="nav-item">
                <a class="nav-link" href="#assigned_to_tasks" role="tab" data-toggle="tab">
                    {{ trans('cruds.task.title') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#user_user_alerts" role="tab" data-toggle="tab">
                    {{ trans('cruds.userAlert.title') }}
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane" role="tabpanel" id="assigned_to_tasks">
                @includeIf('admin.users.relationships.assignedToTasks', ['tasks' => $user->assignedToTasks])
            </div>
            <div class="tab-pane" role="tabpanel" id="user_user_alerts">
                @includeIf('admin.users.relationships.userUserAlerts', ['userAlerts' => $user->userUserAlerts])
            </div>
        </div>
    </div>

@endsection

<?php

use App\Http\Controllers\Api\V1\Admin\CrmCustomerApiController;
use App\Http\Controllers\Api\V1\Admin\ApplyApiController;

Route::get('get/lead', [CrmCustomerApiController::class, 'getLead']);
Route::get('employee/', [CrmCustomerApiController::class, 'employee']);
Route::post('/validate/applicant', [ApplyApiController::class, 'Validar'])->name('validate.applicant');
Route::get('/leads/status', [CrmCustomerApiController::class , 'status']);
Route::post('/crm/lead',[ApplyApiController::class, 'createLead']);

Route::group(['prefix'=>'telnyx','namespace' => 'Api\V1\Admin'], function () {
    Route::post('incoming-call-queue', 'TelnyxApiController@incomingCallQueue');
    Route::post('xfers', 'TelnyxApiController@xfers');
    Route::get('connections', 'TelnyxApiController@getConections');
    Route::get('calls', 'TelnyxApiController@getCalls');
});

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Crm Status
    Route::apiResource('crm-statuses', 'CrmStatusApiController');

    // Crm Customer
    Route::apiResource('crm-customers', 'CrmCustomerApiController');

    // Crm Document
    Route::post('crm-documents/media', 'CrmDocumentApiController@storeMedia')->name('crm-documents.storeMedia');
    Route::apiResource('crm-documents', 'CrmDocumentApiController');

    // Task Status
    Route::apiResource('task-statuses', 'TaskStatusApiController');

    // Task Tag
    Route::apiResource('task-tags', 'TaskTagApiController');

    // Task
    Route::post('tasks/media', 'TaskApiController@storeMedia')->name('tasks.storeMedia');
    Route::apiResource('tasks', 'TaskApiController');
});

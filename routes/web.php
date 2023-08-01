<?php

use App\Http\Controllers\SecureLinkController;
use App\Http\Controllers\Admin\CrmDocumentController;

//test the emailLead view
Route::get('emailLead', function(){
   return view('mail.emailLead')->with(
         [
              'lead' => \App\Models\CrmCustomer::find(1),
              'body' => 'This is the body',
              'subject' => 'This is the subject',
         ]
   );
});

Route::get('/apply', 'ApplyController@Index');
Route::get('/apply/es', 'ApplyController@Indexsp');
Route::get('/thankyou', function(){
    return view('admin.crmCustomer.thankyou');
});
Route::post('/store/applicant', 'ApplyController@Store');
Route::get('admin/crm-customers/print/{id}', 'ApplyController@Print');

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
//    Telephony Area
    Route::get('/telephony', 'HomeController@TelephonyArea')->name('telephony_area');

//    Ruta para enviar correo
    Route::post('/crm-customers/send-email', 'CrmCustomerController@sendEmail')->name('crm-customers.sendEmail');
    Route::get('/', 'HomeController@index')->name('home');
    // Rutas para subir listas csv de leads
    Route::get('/leads-uploader', 'LeadUploaderController@index')->name('leads-uploader.index');
    Route::post('upload/leads-report', 'LeadUploaderController@uploadLeadsReport')->name('upload.leads-report');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users & Sip
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');
    Route::post('users/sip/{user}', 'UsersController@updateSip')->name('user-sip.update');

    // Crm Status
    Route::delete('crm-statuses/destroy', 'CrmStatusController@massDestroy')->name('crm-statuses.massDestroy');
    Route::resource('crm-statuses', 'CrmStatusController');

    // Crm Customer
    Route::delete('crm-customers/destroy', 'CrmCustomerController@massDestroy')->name('crm-customers.massDestroy');
    Route::resource('crm-customers', 'CrmCustomerController');
    Route::post('crm-customer/claim/{id}', 'CrmCustomerController@claim')->name('crm-customers.claim');
    Route::get('crm-customer/claim/{id}', 'CrmCustomerController@claim')->name('crm-customers.claim');

    // Crm Note
//    Route::resource('crm-notes', 'CrmNoteController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);
    Route::resource('crm-notes', 'CrmNoteController');

    // Crm Document
    Route::delete('crm-documents/destroy', 'CrmDocumentController@massDestroy')->name('crm-documents.massDestroy');
    Route::post('crm-documents/media', 'CrmDocumentController@storeMedia')->name('crm-documents.storeMedia');
    Route::post('crm-documents/ckmedia', 'CrmDocumentController@storeCKEditorImages')->name('crm-documents.storeCKEditorImages');
    Route::resource('crm-documents', 'CrmDocumentController');
    // Secure Link
    Route::get('crm-documents/send-secure-link/{id}', [SecureLinkController::class, 'sendSecureLink'])->name('send-link');

    // Task Status
    Route::delete('task-statuses/destroy', 'TaskStatusController@massDestroy')->name('task-statuses.massDestroy');
    Route::resource('task-statuses', 'TaskStatusController');

    // Task Tag
    Route::delete('task-tags/destroy', 'TaskTagController@massDestroy')->name('task-tags.massDestroy');
    Route::resource('task-tags', 'TaskTagController');

    // Task
    Route::delete('tasks/destroy', 'TaskController@massDestroy')->name('tasks.massDestroy');
    Route::post('tasks/media', 'TaskController@storeMedia')->name('tasks.storeMedia');
    Route::post('tasks/ckmedia', 'TaskController@storeCKEditorImages')->name('tasks.storeCKEditorImages');
    Route::resource('tasks', 'TaskController');

    // Tasks Calendar
    Route::resource('tasks-calendars', 'TasksCalendarController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Position
    Route::delete('positions/destroy', 'PositionController@massDestroy')->name('positions.massDestroy');
    Route::resource('positions', 'PositionController');
});

Route::get('crm-documents/secureupload/{id}', [SecureLinkController::class, 'secureLinkVerification'])->name('external-add-files')->middleware('signed');
Route::post('crm-documents/media', [CrmDocumentController::class, 'storeMedia'])->name('crm-documents.storeMedia');
Route::post('crm-documents/store/external', [CrmDocumentController::class, 'storeSecureLink'])->name('crm-documents.store.external');

Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});

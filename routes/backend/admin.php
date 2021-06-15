<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ElectionsController;
use App\Http\Controllers\Backend\NotificationController;
use Tabuna\Breadcrumbs\Trail;

// All route names are prefixed with 'admin.'.
Route::redirect('/', '/admin/dashboard', 301);
Route::get('dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'));
    });

Route::resource('elections', ElectionsController::class);

// whatsapp notification
Route::group(['prefix' => 'notification', 'as' => 'notification.',], function () {
    Route::get('/', [NotificationController::class, 'index'])->name('index');
    Route::post('/send/{$ser_id}', [NotificationController::class, 'send'])->name('send');
    Route::post('/send-all', [NotificationController::class, 'sendAll'])->name('send_all');
});

// Route::post('notification', [LoginController::class, 'login']);

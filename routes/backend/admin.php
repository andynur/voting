<?php

use App\Http\Controllers\Backend\CandidateController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ElectionsController;
use App\Http\Controllers\Backend\NotificationController;
use App\Http\Controllers\Backend\BoothController;
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
    Route::get('/edit/{user_id}', [NotificationController::class, 'edit'])->name('edit');
    Route::patch('/update/{user_id}', [NotificationController::class, 'update'])->name('update');
    Route::get('/send/{user_id}', [NotificationController::class, 'send'])->name('send');
    Route::get('/send-all', [NotificationController::class, 'sendAll'])->name('send_all');
});

// Route::post('notification', [LoginController::class, 'login']);
Route::post("candidates/{id}", ['as' => "candidates.update_new", 'uses' => "App\Http\Controllers\Backend\CandidateController@update"]);
Route::resource('candidates', CandidateController::class)->except(['update']);
Route::get('booth/count', [BoothController::class, 'count'])->name('booth.count');
Route::delete('booth/all', [BoothController::class, 'destroyAll'])->name('booth.destroy-all');
Route::resource('booth', BoothController::class);
Route::get("reports", ['as' => "reports.index", 'uses' => "App\Http\Controllers\Backend\ReportController@index"]);
Route::get("reports/export", ['as' => "reports.export", 'uses' => "App\Http\Controllers\Backend\ReportController@export"]);

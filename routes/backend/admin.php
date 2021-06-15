<?php

use App\Http\Controllers\Backend\CandidateController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ElectionsController;
use App\Http\Controllers\BoothController;
use Tabuna\Breadcrumbs\Trail;

// All route names are prefixed with 'admin.'.
Route::redirect('/', '/admin/dashboard', 301);
Route::get('dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'));
    });

Route::resource('elections', ElectionsController::class);
Route::post("candidates/{id}", ['as' => "candidates.update_new", 'uses' => "App\Http\Controllers\Backend\CandidateController@update"]);
Route::resource('candidates', CandidateController::class)->except(['update']);
Route::resource('booth', BoothController::class);
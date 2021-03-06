<?php

use App\Http\Controllers\Frontend\MemberController;
use App\Http\Controllers\Frontend\User\AccountController;
use App\Http\Controllers\Frontend\User\DashboardController;
use App\Http\Controllers\Frontend\User\ProfileController;
use Tabuna\Breadcrumbs\Trail;

/*
 * These frontend controllers require the user to be logged in
 * All route names are prefixed with 'frontend.'
 * These routes can not be hit if the user has not confirmed their email
 */
Route::group(['as' => 'user.', 'middleware' => ['auth', 'password.expires', config('boilerplate.access.middleware.verified')]], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])
        ->middleware('is_user')
        ->name('dashboard')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('frontend.index')
                ->push(__('Dashboard'), route('frontend.user.dashboard'));
        });

    Route::get('account', [AccountController::class, 'index'])
        ->name('account')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('frontend.index')
                ->push(__('My Account'), route('frontend.user.account'));
        });

    Route::post('election/{election_id}/{candidate_id}', [DashboardController::class, 'election'])->name('dashboard.election');

    Route::patch('profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

// whatsapp notification
Route::get('/voting', [MemberController::class, 'voting'])->name('voting');
Route::post('/voted/{candidate_id}', [MemberController::class, 'voted'])->name('voted');
Route::get('/live-polling', [MemberController::class, 'polling'])->name('live-polling');
Route::get('/data-polling', [MemberController::class, 'dataPolling'])->name('data-polling');

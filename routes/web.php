<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\InvitationController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'web'], function () {
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::post('/login-submit', [AuthController::class, 'loginSubmit'])->name('login.submit');
});

Route::group(['middleware' => ['auth']], function () {

    //Auth Routes
    Route::controller(AuthController::class)->group(function () {
        Route::get('/dashboard', 'dashboard')->name('dashboard');
        Route::post('/logout', 'logout')->name('logout');
    });

    //Invitation Routes
    Route::controller(InvitationController::class)->group(function () {
        Route::prefix('invitations')->group(function () {
            Route::get('/', 'index')->name('invitations.index');
            Route::post('/send', 'sendInvitation')->name('invitations.send');
        });
    });
});

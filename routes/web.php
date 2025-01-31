<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\TaskController;
use App\Models\PermissionController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'web'], function () {

    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::post('/login-submit', [AuthController::class, 'loginSubmit'])->name('login.submit');
    Route::post('/signup-submit', [AuthController::class, 'signUp'])->name('signup.submit');

    Route::controller(InvitationController::class)->group(function () {
        Route::get('invitations/accept/{token}', 'acceptInvitation')->name('invitations.accept');
    });

    Route::group(['middleware' => ['auth']], function () {

        //Auth Routes
        Route::controller(AuthController::class)->group(function () {
            Route::get('/dashboard', 'dashboard')->name('dashboard');
            Route::post('/logout', 'logout')->name('logout');
            Route::get('/client', 'index')->name('client.index');
            Route::get('/list', 'clientList')->name('client.list');
            Route::get('/client-detail/{id}', 'clientDetail')->name('client.detail');
        });

        //Invitation Routes
        Route::controller(InvitationController::class)->group(function () {
            Route::prefix('invitations')->group(function () {
                Route::get('/', 'index')->name('invitations.index');
                Route::get('/get', 'getInvitations')->name('invitations.list');
                Route::post('/send', 'sendInvitation')->name('invitations.send');
            });
        });

        //Role & Permissions
        Route::controller(PermissionController::class)->group(function () {
            Route::get('/role-permission', 'index')->name('role.permissions.index');
            Route::get('/role-permission/{id}', 'detail')->name('role.permissions.detail');
            Route::post('/role-permission/{id}/update', 'updatePermissions')->name('role.permissions.update');
        });

        //Task Routes
        Route::controller(TaskController::class)->group(function () {
            Route::prefix('task')->group(function () {
                Route::get('/', 'index')->name('task.index');
                Route::post('/create', 'store')->name('task.create');
                Route::post('/update', 'update')->name('task.update');
                Route::get('/list', 'taskList')->name('task.list');
                Route::post('/assign', 'assignTask')->name('task.assign');
            });
        });
    });
});

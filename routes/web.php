<?php

use App\Http\Controllers\System\PermissionController;
use App\Http\Controllers\System\RoleController;
use App\Http\Controllers\System\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
require __DIR__ . '/auth.php';
require __DIR__ . '/console.php';

Route::middleware(['verified', 'web'])->group(function () {
    Route::view('/dashboard', 'layouts.master')->middleware(['auth'])->name('master');

    //system settings
    Route::prefix('setting')->group(function () {
        Route::get('permission', [PermissionController::class, 'index'])->name('permission.index');
        Route::post('permission', [PermissionController::class, 'refresh'])->name('permission.refresh');
        Route::resource('role', RoleController::class);
        Route::resource('user', UserController::class);
    });
});

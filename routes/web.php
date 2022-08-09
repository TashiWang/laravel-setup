<?php

use App\Http\Controllers\System\PermissionController;
use App\Http\Controllers\System\RoleController;
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
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);
        Route::post('permissions', [PermissionController::class, 'refresh'])->name('permissions.refresh');
    });
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});


Route::get('dashboard', [HomeController::class, 'dashboard']);

Route::prefix('user')->group(function () {
    Route::get('/', [UserController::class, 'user']);
    Route::get('create', [UserController::class, 'user_create']);
    Route::post('create', [UserController::class, 'user_store']);
    Route::get('edit/{id}', [UserController::class, 'user_edit']);
    Route::post('edit/{id}', [UserController::class, 'user_update']);
});

Route::prefix('department')->group(function () {
    Route::get('/', [DepartmentController::class, 'department']);
    Route::get('create', [DepartmentController::class, 'department_create']);
    Route::post('create', [DepartmentController::class, 'department_store']);
    Route::get('edit/{id}', [DepartmentController::class, 'department_edit']);
    Route::post('edit/{id}', [DepartmentController::class, 'department_update']);
});

Route::prefix('designation')->group(function () {
    Route::get('/', [DesignationController::class, 'designation']);
    Route::get('create', [DesignationController::class, 'designation_create']);
    Route::post('create', [DesignationController::class, 'designation_store']);
    Route::get('edit/{id}', [DesignationController::class, 'designation_edit']);
    Route::post('edit/{id}', [DesignationController::class, 'designation_update']);
});
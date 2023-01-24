<?php

use App\Http\Controllers\AdminActionController;
use App\Http\Controllers\AdminChecklistController;
use App\Http\Controllers\AdminChiefController;
use App\Http\Controllers\AdminChiefDefaultController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminFieldController;
use App\Http\Controllers\AdminInspectorController;
use App\Http\Controllers\AdminMarshalController;
use App\Http\Controllers\AdminMarshalDefaultController;
use App\Http\Controllers\AdminUserController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('index');

Route::group(['as' => 'fields.'], function () {
    Route::get('/fields', [AdminFieldController::class, 'index'])->name('index');
    Route::post('/id-prefix', [AdminFieldController::class, 'setIdPrefix'])->name('setIdPrefix');
    Route::post('/io-prefix', [AdminFieldController::class, 'setIoPrefix'])->name('setIoPrefix');
    Route::patch('/id-prefix/{id}', [AdminFieldController::class, 'updateIdPrefix'])->name('updateIdPrefix');
    Route::patch('/io-prefix/{id}', [AdminFieldController::class, 'updateIoPrefix'])->name('updateIoPrefix');
});

Route::get('/actions/logs', [AdminActionController::class, 'index'])->name('actions.index');
Route::get('/actions/export', [AdminActionController::class, 'export'])->name('actions.export');

Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
    Route::get('/', [AdminUserController::class, 'index'])->name('index');
    Route::get('/create', [AdminUserController::class, 'create'])->name('create');
    Route::post('/', [AdminUserController::class, 'store'])->name('store');
    Route::get('/{user}/edit', [AdminUserController::class, 'edit'])->name('edit');
    Route::patch('/{user}', [AdminUserController::class, 'update'])->name('update');
    Route::patch('/{user}/reset-password', [AdminUserController::class, 'reset'])->name('reset');
    Route::delete('/{user}', [AdminUserController::class, 'destroy'])->name('destroy');
});

Route::group(['prefix' => 'inspectors', 'as' => 'inspectors.'], function () {
    Route::get('/', [AdminInspectorController::class, 'index'])->name('index');
    Route::get('/create', [AdminInspectorController::class, 'create'])->name('create');
    Route::post('/', [AdminInspectorController::class, 'store'])->name('store');
    Route::get('/{inspector}/edit', [AdminInspectorController::class, 'edit'])->name('edit');
    Route::patch('/{inspector}', [AdminInspectorController::class, 'update'])->name('update');
    Route::delete('/{inspector}', [AdminInspectorController::class, 'destroy'])->name('destroy');
});

Route::group(['prefix' => 'marshals', 'as' => 'marshals.'], function () {
    Route::get('/', [AdminMarshalController::class, 'index'])->name('index');
    Route::get('/create', [AdminMarshalController::class, 'create'])->name('create');
    Route::get('history', [AdminMarshalController::class, 'history'])->name('history');
    Route::post('/', [AdminMarshalController::class, 'store'])->name('store');
    Route::get('/{marshal}/edit', [AdminMarshalController::class, 'edit'])->name('edit');
    Route::patch('/{marshal}', [AdminMarshalController::class, 'update'])->name('update');
    Route::patch('{marshal}/default', AdminMarshalDefaultController::class)->name('default');
    Route::patch('{marshal}/restore', [AdminMarshalController::class, 'restore'])->name('restore');
    Route::delete('/{marshal}', [AdminMarshalController::class, 'destroy'])->name('destroy');
});

Route::group(['prefix' => 'chiefs', 'as' => 'chiefs.'], function () {
    Route::get('/', [AdminChiefController::class, 'index'])->name('index');
    Route::get('create', [AdminChiefController::class, 'create'])->name('create');
    Route::get('history', [AdminChiefController::class, 'history'])->name('history');
    Route::post('/', [AdminChiefController::class, 'store'])->name('store');
    Route::get('{chief}/edit', [AdminChiefController::class, 'edit'])->name('edit');
    Route::patch('{chief}', [AdminChiefController::class, 'update'])->name('update');
    Route::patch('{chief}/default', AdminChiefDefaultController::class)->name('default');
    Route::patch('{chief}/restore', [AdminChiefController::class, 'restore'])->name('restore');
    Route::delete('{chief}', [AdminChiefController::class, 'destroy'])->name('destroy');
});

Route::get('/uploads/checklist', [AdminChecklistController::class, 'create'])->name('checklists.upload');
Route::post('/uploads/checklist/upload', [AdminChecklistController::class, 'store'])->name('checklists.store');

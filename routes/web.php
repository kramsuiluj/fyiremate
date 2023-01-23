<?php

use App\Http\Controllers\EstablishmentController;
use App\Http\Controllers\InspectionController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'guest'], function () {
    Route::view('/', 'index');
    Route::post('/login', LoginController::class)->name('login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::delete('/logout', LogoutController::class)->name('logout');
});

Route::group(['prefix' => 'establishments', 'as' => 'establishments.'], function () {
    Route::get('/', [EstablishmentController::class, 'index'])->name('index');
    Route::get('/import', [EstablishmentController::class, 'import'])->name('import');
    Route::post('/upload', [EstablishmentController::class, 'upload'])->name('upload');
    Route::get('/create', [EstablishmentController::class, 'create'])->name('create');
    Route::post('/', [EstablishmentController::class, 'store'])->name('store');
    Route::get('/{establishment}', [EstablishmentController::class, 'show'])->name('show');
    Route::get('/{establishment}/edit', [EstablishmentController::class, 'edit'])->name('edit');
    Route::patch('/{establishment}', [EstablishmentController::class, 'update'])->name('update');
    Route::delete('/{establishment}', [EstablishmentController::class, 'destroy'])->name('destroy');

    Route::get('/{establishment}/inspections', [InspectionController::class, 'index'])->name('inspections.index');
    Route::get('/{establishment}/inspections/create', [InspectionController::class, 'create'])->name('inspections.create');
});

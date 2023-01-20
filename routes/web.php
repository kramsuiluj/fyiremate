<?php

use App\Http\Controllers\EstablishmentController;
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
});

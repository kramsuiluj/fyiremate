<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\CertificatePrintController;
use App\Http\Controllers\EstablishmentController;
use App\Http\Controllers\InspectionController;
use App\Http\Controllers\InspectionPrintController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ReportController;
use App\Models\Certificate;
use App\Models\Position;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'guest'], function () {
    Route::view('/', 'index');
    Route::post('/login', LoginController::class)->name('login');
});

Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboards.index');

Route::get('/{establishment}/inspections/{inspection}/checklist/print', [InspectionController::class, 'print'])->name('establishments.inspections.checklists.print');

Route::group(['middleware' => 'auth'], function () {
    Route::delete('/logout', LogoutController::class)->name('logout');
});

Route::patch('/certificates/set-positions', function () {
    $positions = \App\Models\Position::firstWhere('name', 'certificate');

    $positions->update([
        'name' => 'certificate',
        'pos' => request('positions')
    ]);

    activity('Certificate Positions Updated')
        ->causedBy(auth()->user())
        ->withProperties(['by' => auth()->user()->fullname()])
        ->log('The position of the elements on the printing page has been updated.');

    return redirect()->back();
})->name('certificates.positions');

Route::patch('/establishments/inspections/set-positions', function () {
    $positions = Position::firstWhere('name', 'inspection');

    $positions->update([
        'name' => 'inspection',
        'pos' => request('positions')
    ]);

    activity('IO Positions Updated')
        ->causedBy(auth()->user())
        ->withProperties(['by' => auth()->user()->fullname()])
        ->log('The position of the elements on the printing page has been updated.');

    return redirect()->back();
})->name('establishments.inspections.positions');


Route::group(['prefix' => 'establishments', 'as' => 'establishments.'], function () {
    Route::get('/', [EstablishmentController::class, 'index'])->name('index');
    Route::get('/import', [EstablishmentController::class, 'import'])->name('import');
    Route::post('/upload', [EstablishmentController::class, 'upload'])->name('upload');
    Route::get('/create', [EstablishmentController::class, 'create'])->name('create');
    Route::post('/', [EstablishmentController::class, 'store'])->name('store');
    Route::post('/export', [EstablishmentController::class, 'export'])->name('export');
    Route::get('/{establishment}', [EstablishmentController::class, 'show'])->name('show');
    Route::get('/{establishment}/edit', [EstablishmentController::class, 'edit'])->name('edit');
    Route::patch('/{establishment}', [EstablishmentController::class, 'update'])->name('update');
    Route::delete('/{establishment}', [EstablishmentController::class, 'destroy'])->name('destroy');

    Route::get('/{establishment}/inspections', [InspectionController::class, 'index'])->name('inspections.index');
    Route::get('/{establishment}/inspections/create', [InspectionController::class, 'create'])->name('inspections.create');
    Route::post('/{establishment}/inspections', [InspectionController::class, 'store'])->name('inspections.store');
    Route::get('/{establishment}/inspections/{inspection}/edit', [InspectionController::class, 'edit'])->name('inspections.edit');
    Route::patch('/{establishment}/inspections/{inspection}', [InspectionController::class, 'update'])->name('inspections.update');
    Route::delete('/{establishment}/inspections/{inspection}', [InspectionController::class, 'destroy'])->name('inspections.destroy');
    Route::get('/{establishment}/inspections/{inspection}/print', InspectionPrintController::class)->name('inspections.print');

    Route::get('/{establishment}/certificates', [CertificateController::class, 'index'])->name('certificates.index');
    Route::get('/{establishment}/certificates/create', [CertificateController::class, 'create'])->name('certificates.create');
    Route::get('/{establishment}/certificates/{certificate}', [CertificateController::class, 'show'])->name('certificates.show');
    Route::post('/{establishment}/certificates/', [CertificateController::class, 'store'])->name('certificates.store');
    Route::get('/{establishment}/certificates/{certificate}/edit', [CertificateController::class, 'edit'])->name('certificates.edit');
    Route::patch('/{establishment}/certificates/{certificate}', [CertificateController::class, 'update'])->name('certificates.update');
    Route::delete('/{establishment}/certificates/{certificate}', [CertificateController::class, 'destroy'])->name('certificates.destroy');

    Route::get('/{establishment}/certificates/{certificate}/print', CertificatePrintController::class)->name('certificates.print');
});

Route::get('/updates/validity', function () {
    return view('updates.index');
});

Route::patch('updates/validity/update', function () {
    $certificates = Certificate::get(['id', 'valid_until', 'validity']);

    foreach ($certificates as $certificate) {
        $validity = Carbon::createFromDate($certificate['valid_until'])->isFuture();

        if ($validity) {
            $attributes['validity'] = 'Valid';
        } else {
            $attributes['validity'] = 'Invalid';
        }

        if ($certificate->validity != $attributes['validity']) {
            Certificate::find($certificate->id)->update([
                'validity' => $attributes['validity']
            ]);
        }
    }

    return redirect(route('dashboards.index'))->with('success', 'You have successfully updated the validity of FSICs.');
})->name('updates.validity');

Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

Route::get('/account/edit', [AccountController::class, 'edit'])->name('account.edit');
Route::post('/account/update', [AccountController::class, 'update'])->name('account.update');

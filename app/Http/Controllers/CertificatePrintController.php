<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Establishment;
use App\Models\Position;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CertificatePrintController extends Controller
{
    public function __invoke(Establishment $establishment, Certificate $certificate)
    {
        $certificate['filled_date'] = Carbon::parse($certificate['filled_date'])->toDateString();
        $certificate['valid_until'] = Carbon::parse($certificate['valid_until'])->toDateString();

        return view('establishments.certificates.print', [
            'certificate' => $certificate,
            'establishment' => $establishment,
            'positions' => Position::firstWhere('name', 'certificate')
        ]);
    }
}

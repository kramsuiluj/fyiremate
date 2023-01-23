<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Establishment;
use App\Models\Position;
use Illuminate\Http\Request;

class CertificatePrintController extends Controller
{
    public function __invoke(Establishment $establishment, Certificate $certificate)
    {
        return view('establishments.certificates.print', [
            'certificate' => $certificate,
            'establishment' => $establishment,
            'positions' => Position::firstWhere('name', 'certificate')
        ]);
    }
}

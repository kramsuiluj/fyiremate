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

        if (strlen($certificate['description']) > 60) {
            $partialDescription = str_split($certificate['description'], 60);
            $certificate['description'] = $partialDescription[0];

            array_shift($partialDescription);
            $certificate['description2'] = implode('', $partialDescription);
        }

        return view('establishments.certificates.print', [
            'certificate' => $certificate,
            'establishment' => $establishment,
            'positions' => Position::firstWhere('name', 'certificate')
        ]);
    }
}

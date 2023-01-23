<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Establishment;
use App\Models\Inspection;
use App\Models\Position;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InspectionPrintController extends Controller
{
    public function __invoke(Establishment $establishment, Inspection $inspection)
    {
        $inspection['processed_at'] = Carbon::parse($inspection['processed_at'])->toDateString();

        return view('establishments.inspections.print', [
            'establishment' => $establishment,
            'inspection' => $inspection,
            'positions' => Position::firstWhere('name', 'inspection')
        ]);
    }
}

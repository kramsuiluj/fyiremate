<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Establishment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $startOfQuarter = Carbon::now()->startOfQuarter();
        $endOfQuarter = Carbon::now()->endOfQuarter();

        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;

        $monthlyEstablishments = Establishment::whereYear('date', '=', $currentYear)
            ->whereMonth('date', '=', $currentMonth)
            ->count();

        $quarterlyEstablishments = Establishment::where('date', '>=', $startOfQuarter)
            ->where('date', '<=', $endOfQuarter)
            ->count();

        $yearlyEstablishments = Establishment::whereYear('date', '=', $currentYear)
            ->count();

        $monthlyCompleted = Establishment::whereYear('date', '=', $currentYear)
            ->whereMonth('date', '=', $currentMonth)
            ->where('status', 'Completed')
            ->count();

        $monthlyFI = Establishment::whereYear('date', '=', $currentYear)
            ->whereMonth('date', '=', $currentMonth)
            ->where('status', 'For Inspection')
            ->count();

        $monthlyFC = Establishment::whereYear('date', '=', $currentYear)
            ->whereMonth('date', '=', $currentMonth)
            ->where('status', 'For Compliance')
            ->count();

        $monthlyFRI = Establishment::whereYear('date', '=', $currentYear)
            ->whereMonth('date', '=', $currentMonth)
            ->where('status', 'For Re-Inspection')
            ->count();

        $valid = Certificate::where('validity', 'Valid')->count();
        $invalid = Certificate::where('validity', 'Invalid')->count();

        return view('administrators.index', [
            'monthlyEstablishments' => $monthlyEstablishments,
            'quarterlyEstablishments' => $quarterlyEstablishments,
            'yearlyEstablishments' => $yearlyEstablishments,
            'monthlyCompleted' => $monthlyCompleted,
            'monthlyFI' => $monthlyFI,
            'monthlyFC' => $monthlyFC,
            'monthlyFRI' => $monthlyFRI,
            'valid' => $valid,
            'invalid' => $invalid
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Establishment;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $from = request('from');
        $to = request('to');

        if (request()->has(['from', 'to'])) {
            $establishments = Establishment::filter(request(['from', 'to']));

            $business = Establishment::whereBetween('date', [$from, $to])->where('occupancy', 'BUSINESS')->count() ?? null;
            $industrial = Establishment::whereBetween('date', [$from, $to])->where('occupancy', 'INDUSTRIAL')->count() ?? null;
            $educational = Establishment::whereBetween('date', [$from, $to])->where('occupancy', 'EDUCATIONAL')->count() ?? null;
            $healthcare = Establishment::whereBetween('date', [$from, $to])->where('occupancy', 'HEALTH CARE')->count() ?? null;
            $mercantile = Establishment::whereBetween('date', [$from, $to])->where('occupancy', 'MERCANTILE')->count() ?? null;
            $residential = Establishment::whereBetween('date', [$from, $to])->where('occupancy', 'like', '%' . 'RESIDENTIAL' . '%')->count() ?? null;
            $storage = Establishment::whereBetween('date', [$from, $to])->where('occupancy', 'STORAGE')->count() ?? null;
        } else {
            $establishments = null;
        }

        return view('administrators.reports.index', [
            'establishments' => $establishments?->get() ?? 0,
            'business' => $business ?? null,
            'industrial' => $industrial ?? null,
            'educational' => $educational ?? null,
            'healthcare' => $healthcare ?? null,
            'mercantile' => $mercantile ?? null,
            'residential' => $residential ?? null,
            'storage' => $storage ?? null,
        ]);
    }
}

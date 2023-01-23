<?php

namespace App\Http\Controllers;

use App\Models\Chief;
use App\Models\Establishment;
use App\Models\Field;
use App\Models\Inspection;
use App\Models\Inspector;
use App\Models\Marshal;

class InspectionController extends Controller
{
    public function index(Establishment $establishment)
    {
        return view('establishments.inspections.index', [
            'establishment' => $establishment,
            'inspections' => Inspection::latest()->paginate(10)
        ]);
    }

    public function create(Establishment $establishment)
    {
        return view('establishments.inspections.create', [
            'establishment' => $establishment,
            'inspectors' => Inspector::latest()->get(),
            'marshal' => Marshal::firstWhere('is_default', true),
            'chief' => Chief::firstWhere('is_default', true),
            'io_prefix' => Field::firstWhere('name', 'io_prefix')
        ]);
    }
}

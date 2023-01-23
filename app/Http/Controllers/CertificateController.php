<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Chief;
use App\Models\Establishment;
use App\Models\Field;
use App\Models\Marshal;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class CertificateController extends Controller
{
    public function index(Establishment $establishment)
    {
        return view('establishments.certificates.index', [
            'establishment' => $establishment,
            'certificates' => Certificate::where('establishment_id', $establishment->id)->get()
        ]);
    }

    public function create(Establishment $establishment)
    {
        $id_prefix = Field::firstWhere('name', 'id_prefix')?->value;
        $currentPrefix = $id_prefix;

        if (Establishment::latest('fsic_number')?->firstWhere('fsic_prefix', $currentPrefix)) {
            $nextId = Establishment::latest('fsic_number')?->firstWhere('fsic_prefix', $currentPrefix)?->fsic_number + 1;
        } else {
            $nextId = 1;
        }

        return view('establishments.certificates.create', [
            'establishment' => $establishment,
            'marshal' => Marshal::firstWhere('is_default', true),
            'chief' => Chief::firstWhere('is_default', true),
            'id_prefix' => Field::firstWhere('name', 'id_prefix')?->value,
            'io_prefix' => Field::firstWhere('name', 'io_prefix')?->value,
            'latest_id' => Establishment::latest('id')?->first()?->id,
            'nextId' => $nextId
        ]);
    }

    public function store(Establishment $establishment)
    {
        $attributes = request()->validate([
            'fsic' => ['required'],
            'filled_date' => ['required'],
            'valid_until' => ['required'],
            'description' => ['required'],
            'establishment' => ['required'],
            'owner' => ['required'],
            'address' => ['required'],
            'amount_paid' => ['required'],
            'or_number' => ['required'],
            'date_paid' => ['required'],
            'chief' => ['required'],
            'marshal' => ['required']
        ]);

        $fsicFormat = explode('-', $attributes['fsic']);

        if ($fsicFormat && count($fsicFormat) == 4) {
            $fsicPrefix = $fsicFormat[0] . '-' . $fsicFormat[1] . '-'  .$fsicFormat[2];
            $fsicId = (int)$fsicFormat[3];
        } else {
            throw ValidationException::withMessages([
                'fsic' => 'Invalid input format. Please follow the example.'
            ]);
        }

        $validity = Carbon::createFromDate($attributes['valid_until'])->isFuture();

        if ($validity) {
            $attributes['validity'] = 'Valid';
        } else {
            $attributes['validity'] = 'Invalid';
        }

        $filledDate = Carbon::createFromDate($attributes['filled_date'])->toDateString();
        $attributes['filled_date'] = $filledDate;

        $validUntil = Carbon::createFromDate($attributes['valid_until'])->toDateString();
        $attributes['valid_until'] = $validUntil;

        $establishment->update([
            'fsic_prefix' => $fsicPrefix ?? null,
            'fsic_number' => $fsicId ?? null,
            'fsic' => $attributes['fsic'],
            'ops_number' => $attributes['fsic']
        ]);

        $certificate = Certificate::create([
            'establishment_id' => $establishment->id,
            'fsic' => $attributes['fsic'],
            'filled_date' => $attributes['filled_date'],
            'valid_until' => $attributes['valid_until'],
            'description' => $attributes['description'],
            'address' => $attributes['address'],
            'chief' => $attributes['chief'],
            'marshal' => $attributes['marshal'],
            'validity' => $attributes['validity']
        ]);

        activity('Certificate Created')
            ->causedBy(auth()->user())
            ->withProperties(['by' => auth()->user()->fullname()])
            ->log('A Fire Safety Inspection Certificate has been created. [' . $establishment->fsic . ']');

        return redirect(route('establishments.certificates.index', $establishment->id))->with('success', 'You have successfully created an FSIC.');
    }

    public function edit(Establishment $establishment, Certificate $certificate)
    {
        return view('establishments.certificates.edit', [
            'establishment' => $establishment,
            'certificate' => $certificate
        ]);
    }

}

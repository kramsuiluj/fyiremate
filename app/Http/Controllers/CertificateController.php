<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Chief;
use App\Models\Establishment;
use App\Models\Field;
use App\Models\Marshal;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class CertificateController extends Controller
{
    public function index(Establishment $establishment)
    {
        return view('establishments.certificates.index', [
            'establishment' => $establishment,
            'certificates' => Certificate::where('establishment_id', $establishment->id)->latest()->get()
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
            'description' => ['required', 'max:200'],
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
            $fsicPrefix = $fsicFormat[0] . '-' . $fsicFormat[1] . '-' . $fsicFormat[2];
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
        $id_prefix = Field::firstWhere('name', 'id_prefix')?->value;
        $currentPrefix = $id_prefix;

        if (Establishment::latest('fsic_number')?->firstWhere('fsic_prefix', $currentPrefix)) {
            $nextId = Establishment::latest('fsic_number')?->firstWhere('fsic_prefix', $currentPrefix)?->fsic_number + 1;
        } else {
            $nextId = 1;
        }

        return view('establishments.certificates.edit', [
            'establishment' => $establishment,
            'certificate' => $certificate,
            'latest_id' => Establishment::latest('id')?->first()?->id,
            'nextId' => $nextId
        ]);
    }

    public function update(Establishment $establishment, Certificate $certificate)
    {
        $payment = $establishment->payments->last();

        $attributes = request()->validate([
            'fsic' => [Rule::unique('certificates', 'fsic')->ignore($certificate->id)],
            'filled_date' => ['required'],
            'valid_until' => ['required'],
            'description' => ['required', 'max:200'],
            'establishment' => ['required'],
            'owner' => ['required'],
            'address' => ['required'],
            'amount_paid' => ['required'],
            'or_number' => ['required'],
            'date_paid' => ['required'],
            'chief' => ['required'],
            'marshal' => ['required']
        ]);

        $updated = [];
        $updatedPayment = [];

        if ($certificate->fsic != $attributes['fsic']) {
            $updated['fsic'] = $attributes['fsic'];
            $updated['ops_number'] = $attributes['fsic'];

            $fsicFormat = explode('-', $attributes['fsic']);

            if ($fsicFormat && count($fsicFormat) == 4) {
                $fsicPrefix = $fsicFormat[0] . '-' . $fsicFormat[1] . '-' . $fsicFormat[2];
                $fsicId = (int)$fsicFormat[3];
            } else {
                throw ValidationException::withMessages([
                    'fsic' => 'Invalid input format. Please follow the example.'
                ]);
            }

            $establishment->update([
                'fsic' => $attributes['fsic'],
                'ops_number' => $attributes['fsic'],
                'fsic_prefix' => $fsicPrefix,
                'fsic_number' => $fsicId
            ]);
        }

        if ($certificate->filled_date != $attributes['filled_date']) {
            $updated['filled_date'] = $attributes['filled_date'];
        }

        if ($certificate->valid_until != $attributes['valid_until']) {
            $updated['valid_until'] = $attributes['valid_until'];
        }

        if ($certificate->description != $attributes['description']) {
            $updated['description'] = $attributes['description'];
        }

//        if ($certificate->establishment != $attributes['establishment']) {
//            $updated['establishment'] = $attributes['establishment'];
//        }

//        if ($certificate->owner != $attributes['owner']) {
//            $updated['owner'] = $attributes['owner'];
//        }

//        if ($certificate->address != $attributes['address']) {
//            $updated['address'] = $attributes['address'];
//        }

        if ($payment->amount_paid != $attributes['amount_paid']) {
            $updatedPayment['amount_paid'] = $attributes['amount_paid'];
        }

        if ($payment->date_paid != $attributes['date_paid']) {
            $updatedPayment['date_paid'] = $attributes['date_paid'];
        }

        if ($payment->or_number != $attributes['or_number']) {
            $updatedPayment['or_number'] = $attributes['or_number'];
        }

        if ($certificate->chief != $attributes['chief']) {
            $updated['chief'] = $attributes['chief'];
        }

        if ($certificate->marshal != $attributes['marshal']) {
            $updated['marshal'] = $attributes['marshal'];
        }

        if (count($updated) == 0 && count($updatedPayment) == 0) {
            return redirect(route('establishments.certificates.index', $establishment->id))->with('success', 'You did not update any field.');
        }

        if (count($updated) > 0) {
            $certificate->update($updated);
        }

        if (count($updatedPayment) > 0) {
            $establishment->payments->last()->update($updatedPayment);
        }

        activity('Certificate Updated')
            ->causedBy(auth()->user())
            ->withProperties(['by' => auth()->user()->fullname()])
            ->log('A Fire Safety Inspection Certificate has been updated. [' . $certificate->fsic . ']');

        return redirect(route('establishments.certificates.index', $establishment->id))->with('success', 'You have successfully updated an FSIC.');
    }

    public function destroy(Establishment $establishment, Certificate $certificate)
    {
        $certificate->delete();

        activity('Certificate Deleted')
            ->causedBy(auth()->user())
            ->withProperties(['by' => auth()->user()->fullname()])
            ->log('A Fire Safety Inspection Certificate has been deleted. [' . $certificate->fsic . ']');

        return redirect(route('establishments.certificates.index', $establishment->id))->with('success', 'You have successfully deleted an FSIC.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Checklist;
use App\Models\Chief;
use App\Models\Establishment;
use App\Models\Field;
use App\Models\Inspection;
use App\Models\Inspector;
use App\Models\Marshal;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use PhpOffice\PhpWord\PhpWord;

class InspectionController extends Controller
{
    public function index(Establishment $establishment)
    {
        return view('establishments.inspections.index', [
            'establishment' => $establishment,
            'inspections' => $establishment->inspections
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

    public function store(Establishment $establishment)
    {
        $attributes = request()->validate([
            'establishment_id' => ['required'],
            'io_number' => ['required', Rule::unique('inspections', 'io_number')],
            'to' => ['required'],
            'proceed' => ['required'],
            'purpose' => ['required'],
            'duration' => ['required'],
            'remarks' => ['required'],
            'chief' => ['required'],
            'marshal' => ['required'],
            'processed_at' => ['required']
        ]);

        $inspection = Inspection::create($attributes);

        $establishment->update([
            'io_number' => $inspection->io_number
        ]);

        activity('Inspection Order Created')
            ->causedBy(auth()->user())
            ->withProperties(['by' => auth()->user()->fullname()])
            ->log('An Inspection Order has been created. [' . $inspection->io_number . ']');

        return redirect(route('establishments.inspections.index', $establishment->id))->with('success', 'You have successfully created an Inspection Order.');
    }

    public function edit(Establishment $establishment, Inspection $inspection)
    {
        $inspection['processed_at'] = Carbon::parse($inspection['processed_at'])->toDateString();

        return view('establishments.inspections.edit', [
            'establishment' => $establishment,
            'inspection' => $inspection,
            'inspectors' => Inspector::latest()->get(),
            'marshal' => Marshal::firstWhere('is_default', true),
            'chief' => Chief::firstWhere('is_default', true)
        ]);
    }

    public function update(Establishment $establishment, Inspection $inspection)
    {
        $inspection['processed_at'] = Carbon::parse($inspection['processed_at'])->toDateString();

        $attributes = request()->validate([
            'establishment_id' => ['required'],
            'io_number' => ['required', Rule::unique('inspections', 'io_number')->ignore($inspection)],
            'to' => ['required'],
            'proceed' => ['required'],
            'purpose' => ['required'],
            'duration' => ['required'],
            'remarks' => ['required'],
            'chief' => ['required'],
            'marshal' => ['required'],
            'processed_at' => ['required']
        ]);

        $updated = [];

        if ($inspection->io_number != $attributes['io_number']) {
            $updated['io_number'] = $attributes['io_number'];
        }

        if ($inspection->to != $attributes['to']) {
            $updated['to'] = $attributes['to'];
        }

        if ($inspection->proceed != $attributes['proceed']) {
            $updated['proceed'] = $attributes['proceed'];
        }

        if ($inspection->purpose != $attributes['purpose']) {
            $updated['purpose'] = $attributes['purpose'];
        }

        if ($inspection->duration != $attributes['duration']) {
            $updated['duration'] = $attributes['duration'];
        }

        if ($inspection->remarks != $attributes['remarks']) {
            $updated['remarks'] = $attributes['remarks'];
        }

        if ($inspection->chief != $attributes['chief']) {
            $updated['chief'] = $attributes['chief'];
        }

        if ($inspection->marshal != $attributes['marshal']) {
            $updated['marshal'] = $attributes['marshal'];
        }

        if ($inspection->processed_at != $attributes['processed_at']) {
            $updated['processed_at'] = $attributes['processed_at'];
        }

        if (count($updated) === 0) {
            return redirect(route('establishments.inspections.index', [$establishment->id, $inspection->id]))->with('success', 'You did not update any field.');
        }

        $latest = $establishment->inspections;

        if ($latest->last() == $inspection['io_number']) {
            $establishment->update([
                'io_number' => $inspection['io_number']
            ]);
        }

        $inspection->update($updated);


        activity('Inspection Order Updated')
            ->causedBy(auth()->user())
            ->withProperties(['by' => auth()->user()->fullname()])
            ->log('Administrator has updated an Inspection Order record. [' . $inspection->io_number . ']');

        return redirect(route('establishments.inspections.index', [$establishment->id, $inspection->id]))->with('success', 'You have successfully updated the selected city fire marshal.');
    }

    public function print(Establishment $establishment, Inspection $inspection)
    {
        $occupancy = $establishment->occupancy;
        $checklist = Checklist::firstWhere('type', $occupancy);
        $fullPath = $checklist->getMedia()[0]->getUrl();
        $partialPath = explode('storage', $fullPath)[1];

        $phpWord = new PhpWord();
        $fontStyleName = 'oneUserDefinedStyle';
        $phpWord->addFontStyle($fontStyleName, array('name' => 'Century Gothic', 'size' => 16, 'color' => 'FFFFF', 'bold' => true));
        $docs = $phpWord->loadTemplate(storage_path('app/public' . $partialPath));

        $docs->setValues(
            array(
                'owner' => $establishment->owner,
                'date' => $inspection->processed_at,
                'name' => $establishment->name,
                'address' => $establishment->address,
                'io_number' => $inspection->io_number,
                'to' => $inspection->to,
                'chief' => $inspection->chief . ' BFP',
                'marshal' => $inspection->marshal . ' BFP'
            )
        );

        $temp_file = tempnam(sys_get_temp_dir(), 'PHPWord');
        $docs->saveAs($temp_file);

        header("Content-Disposition: attachment; filename=" . $inspection->io_number . "-" . $occupancy . "-Checklist.docx");
        readfile($temp_file);
        unlink($temp_file);
    }

    public function destroy(Establishment $establishment, Inspection $inspection)
    {
        $latest = $establishment->inspections;

        if (count($latest) == 1) {
            $establishment->update([
                'io_number' => null
            ]);
        }

        if (count($latest) > 1) {
            $latestInspection = Inspection::where('establishment_id', $establishment->id)
                ->firstWhere('id', '!=', $inspection->id);

            $establishment->update([
                'io_number' => $latestInspection['io_number']
            ]);
        }

        $inspection->forceDelete();



//        if (count($latest) != 0 && $latest->last() == $inspection['io_number']) {
//            $establishment->update([
//                'io_number' => Inspection::where('establishment_id', $establishment->id)
//                        ->where('id', '!=', $inspection->id)->latest()->first()->io_number ?? null
//            ]);
//        }

        activity('Inspection Order Deleted')
            ->causedBy(auth()->user())
            ->withProperties(['by' => auth()->user()->fullname()])
            ->log('Administrator has deleted an inspection order. [' . $inspection->io_number . ']');

        return redirect(route('establishments.inspections.index', $establishment->id))->with('success', 'You have successfully deleted the selected Inspection Order.');
    }
}

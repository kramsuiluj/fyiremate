<?php

namespace App\Http\Controllers;

use App\Models\Establishment;
use App\Models\Field;
use App\Models\Payment;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Rap2hpoutre\FastExcel\FastExcel;
use Spatie\QueryBuilder\QueryBuilder;

class EstablishmentController extends Controller
{
    public function index()
    {
        $establishment = Establishment::latest('id')->filter(request(['search']))->paginate(10)->withQueryString();

//        QueryBuilder::for(Establishment::class)
//            ->allowedFilters(['name', 'owner'])
//            ->paginate(10)
//            ->withQueryString()

        return view('establishments.index', [
            'establishments' => $establishment
        ]);
    }

    public function import()
    {
        return view('establishments.import');
    }

    public function upload()
    {
        $attributes = request()->validate([
            'establishments' => ['required', 'mimes:xlsx']
        ]);

        $establishments = (new FastExcel)->import($attributes['establishments']);

        $count = 1;

        DB::transaction(function () use ($establishments, $count) {
            foreach ($establishments as $establishment) {
                if (!array_key_exists('DATE', $establishment) && !array_key_exists('NAME OF OWNER', $establishment) && !array_key_exists('NAME OF ESTABLISHMENT', $establishment) && !array_key_exists('ADDRESS', $establishment) && !array_key_exists('AMOUNT PAID', $establishment) && !array_key_exists('DATE PAID', $establishment) && !array_key_exists('OR #', $establishment) && !array_key_exists('OPS #', $establishment) && !array_key_exists('DATE RELEASED', $establishment) && !array_key_exists('FSIC #', $establishment) && !array_key_exists('NEW / RENEW', $establishment) && !array_key_exists('TYPE OF OCCUPANCY', $establishment) && !array_key_exists('AREA SQ.M.', $establishment) && !array_key_exists('REMARKS', $establishment) && !array_key_exists('DATE OF INSPECTION', $establishment) && !array_key_exists('INSPECTION ORDER #', $establishment) && !array_key_exists('REALTY TAX', $establishment) && !array_key_exists('AMOUNT', $establishment)) {
                    throw ValidationException::withMessages([
                        'establishments' => 'The column names might be invalid or the file you are trying to upload is invalid.'
                    ]);
                }

                $count++;

                if (!empty($establishment['FSIC #'])) {
                    try {
                        $id = explode('-', $establishment['FSIC #']);
                        $fsic_prefix = $id[0] . '-' . $id[1] . '-' . $id[2];
                        $fsic_number = (int)$id[3];

                        $establishment['FSIC #'] = $fsic_prefix . '-' . strval($fsic_number);
                    } catch (\Exception $e) {
                        throw ValidationException::withMessages([
                            'establishments' => 'The <span class="font-semibold">FSIC #</span> value format is invalid.'
                        ]);
                    }
                } else {
                    $establishment['FSIC #'] = null;
                }

                if (!empty($establishment['DATE'])) {
                    try {
                        if (gettype($establishment['DATE']) == 'object') {
                            $establishment['DATE'] = Carbon::createFromDate($establishment['DATE'])->toDateString();
                        } else {
                            $establishment['DATE'] = strtoupper(strval($establishment['DATE']));
                            $month = explode(' ', $establishment['DATE'])[0];

                            $establishment['DATE'] = $this->convertDate($establishment['DATE'], str_replace('.', '', $month));
                        }
                    } catch (\Exception $e) {
                        throw ValidationException::withMessages([
                            'establishments' => 'The <span class="font-semibold">DATE</span> value format is invalid. Row: #' . $count
                        ]);
                    }
                } else {
                    $establishment['DATE'] = null;
                }

                if (!empty($establishment['DATE PAID'])) {
                    try {
                        if (gettype($establishment['DATE PAID']) == 'object') {
                            $establishment['DATE PAID'] = Carbon::createFromDate($establishment['DATE PAID'])->toDateString();
                        } else {
                            $establishment['DATE PAID'] = strtoupper(strval($establishment['DATE PAID']));
                            $month = explode(' ', $establishment['DATE PAID'])[0];

                            $establishment['DATE PAID'] = $this->convertDate($establishment['DATE PAID'], str_replace('.', '', $month));
                        }
                    } catch (\Exception $e) {
                        throw ValidationException::withMessages([
                            'establishments' => 'The <span class="font-semibold">DATE PAID</span> value format is invalid. Row: #' . $count
                        ]);
                    }
                } else {
                    $establishment['DATE PAID'] = null;
                }

                if (!empty($establishment['DATE RELEASED'])) {
                    try {
                        if (gettype($establishment['DATE RELEASED']) == 'object') {
                            $establishment['DATE RELEASED'] = Carbon::createFromDate($establishment['DATE RELEASED'])->toDateString();
                        } else {
                            $establishment['DATE RELEASED'] = strtoupper(strval($establishment['DATE RELEASED']));
                            $month = explode(' ', $establishment['DATE RELEASED'])[0];

                            $establishment['DATE RELEASED'] = $this->convertDate($establishment['DATE RELEASED'], str_replace('.', '', $month));
                        }
                    } catch (\Exception $e) {
                        throw ValidationException::withMessages([
                            'establishments' => 'The <span class="font-semibold">DATE RELEASED</span> value format is invalid. Row: #' . $count
                        ]);
                    }
                } else {
                    $establishment['DATE RELEASED'] = null;
                }

                if (!empty($establishment['DATE OF INSPECTION'])) {
                    try {
                        if (gettype($establishment['DATE OF INSPECTION']) == 'object') {
                            $establishment['DATE OF INSPECTION'] = Carbon::createFromDate($establishment['DATE OF INSPECTION'])->toDateString();
                        } else {
                            $establishment['DATE OF INSPECTION'] = strtoupper(strval($establishment['DATE OF INSPECTION']));
                            $month = explode(' ', $establishment['DATE OF INSPECTION'])[0];

                            $establishment['DATE OF INSPECTION'] = $this->convertDate($establishment['DATE OF INSPECTION'], str_replace('.', '', $month));
                        }
                    } catch (\Exception $e) {
                        $establishment['DATE OF INSPECTION'] = null;
                    }
                } else {
                    $establishment['DATE OF INSPECTION'] = null;
                }

                try {
                    $estab = Establishment::create([
                        'date' => $establishment['DATE'],
                        'owner' => $establishment['NAME OF OWNER'],
                        'name' => $establishment['NAME OF ESTABLISHMENT'],
                        'address' => $establishment['ADDRESS'],
                        'ops_number' => $establishment['OPS #'],
                        'date_released' => $establishment['DATE RELEASED'],
                        'fsic_prefix' => $fsic_prefix ?? null,
                        'fsic_number' => $fsic_number ?? null,
                        'fsic' => $establishment['FSIC #'],
                        'issuance' => $establishment['NEW / RENEW'],
                        'occupancy' => $establishment['TYPE OF OCCUPANCY'],
                        'area' => $establishment['AREA SQ.M.'],
                        'remarks' => $establishment['REMARKS'],
                        'inspection_date' => $establishment['DATE OF INSPECTION'],
                        'io_number' => $establishment['INSPECTION ORDER #'],
                        'amount' => $establishment['AMOUNT'],
                        'realty_tax' => $establishment['REALTY TAX'],
                    ]);

                    Payment::create([
                        'establishment_id' => $estab->id,
                        'amount_paid' => $establishment['AMOUNT PAID'],
                        'date_paid' => $establishment['DATE PAID'],
                        'or_number' => $establishment['OR #']
                    ]);
                } catch (\Exception $e) {
                    throw ValidationException::withMessages([
                        'establishments' => 'There was an error while importing line #' . $count . '. Please check if the values are valid.'
                    ]);
                }
            }
        });

        activity('Establishment File Imported')
            ->causedBy(auth()->user())
            ->withProperties(['by' => auth()->user()->fullname()])
            ->log('An .xlsx file containing establishment records has been imported.' . '# of Records: ' . $count);

        return redirect(route('establishments.index'))->with('success', 'You have successfully imported the establishments list.');
    }

    public function create()
    {
        $id_prefix = Field::firstWhere('name', 'id_prefix')?->value;
        $currentPrefix = $id_prefix;

        if (Establishment::latest('fsic_number')?->firstWhere('fsic_prefix', $currentPrefix)) {
            $nextId = Establishment::latest('fsic_number')?->firstWhere('fsic_prefix', $currentPrefix)?->fsic_number + 1;
        } else {
            $nextId = 1;
        }

        return view('establishments.create', [
            'id_prefix' => Field::firstWhere('name', 'id_prefix')?->value,
            'io_prefix' => Field::firstWhere('name', 'io_prefix')?->value,
            'latest_id' => Establishment::latest('id')?->first()?->id,
            'nextId' => $nextId
        ]);
    }

    public function store()
    {
        $attributes = request()->validate([
            'date' => ['required'],
            'owner' => ['required'],
            'name' => ['required'],
            'address' => ['required'],
            'ops_number' => ['required', Rule::unique('establishments', 'ops_number')],
            'fsic' => ['required', Rule::unique('establishments', 'fsic')],
            'status' => ['required'],
            'occupancy' => ['required'],
        ]);

        $fsicFormat = explode('-', $attributes['fsic']);
        $opsFormat = explode('-', $attributes['ops_number']);

        if (!$opsFormat && count($opsFormat) != 4) {
            throw ValidationException::withMessages([
                'ops_number' => 'Invalid input format. Please follow the example.'
            ]);
        }

        if ($fsicFormat && count($fsicFormat) == 4) {
            $fsicPrefix = $fsicFormat[0] . '-' . $fsicFormat[1] . '-'  .$fsicFormat[2];
            $fsicId = (int)$fsicFormat[3];
        } else {
            throw ValidationException::withMessages([
                'fsic' => 'Invalid input format. Please follow the example.'
            ]);
        }

        $attributes['remarks'] = request('remarks') ?? null;
        $attributes['realty_tax'] = request('realty_tax') ?? null;
        $attributes['amount'] = request('amount') ?? null;
        $attributes['amount_paid'] = request('amount_paid') ?? null;
        $attributes['date_paid'] = request('date_paid') ?? null;
        $attributes['or_number'] = request('or_number') ?? null;
        $attributes['fsic_prefix'] = $fsicPrefix ?? null;
        $attributes['fsic_number'] = $fsicId ?? null;
        $attributes['issuance'] = request('issuance') ?? null;
        $attributes['area'] = request('area') ?? null;
        $attributes['io_number'] = request('io_number') ?? null;
        $attributes['date_released'] = request('date_released') ?? null;
        $attributes['inspection_date'] = request('inspection_date') ?? null;

        $establishment = Establishment::create([
            'date' => $attributes['date'],
            'owner' => $attributes['owner'],
            'name' => $attributes['name'],
            'address' => $attributes['address'],
            'ops_number' => $attributes['ops_number'],
            'date_released' => $attributes['date_released'],
            'fsic_prefix' => $attributes['fsic_prefix'],
            'fsic_number' => $attributes['fsic_number'],
            'fsic' => $attributes['fsic'],
            'issuance' => $attributes['issuance'],
            'status' => $attributes['status'],
            'occupancy' => $attributes['occupancy'],
            'area' => $attributes['area'],
            'remarks' => $attributes['remarks'],
            'inspection_date' => $attributes['inspection_date'],
            'io_number' => $attributes['io_number'],
            'amount' => $attributes['amount'],
            'realty_tax' => $attributes['realty_tax']
        ]);

        Payment::create([
            'establishment_id' => $establishment->id,
            'amount_paid' => $attributes['amount_paid'],
            'date_paid' => $attributes['date_paid'],
            'or_number' => $attributes['or_number']
        ]);

        activity('Establishment Record Created')
            ->causedBy(auth()->user())
            ->withProperties(['by' => auth()->user()->fullname()])
            ->log('A user has added an establishment record. [' . $establishment->fsic . ']');

        return redirect(route('establishments.index'))->with('success', 'You have successfully created an Establishment Record.');
    }

    public function show(Establishment $establishment)
    {
        $payment = $establishment->payments->last();

        if ($establishment->date) {
            $establishment->date = date('F j, Y', strtotime($establishment->date));
        }

        if ($payment->date_paid) {
            $payment->date_paid = date('F j, Y', strtotime($payment->date_paid));
        }

        if ($establishment->date_released) {
            $establishment->date_released = date('F j, Y', strtotime($establishment->date_released));
        }

        if ($establishment->inspection_date) {
            $establishment->inspection_date = date('F j, Y', strtotime($establishment->inspection_date));
        }

        return view('establishments.show', [
            'establishment' => $establishment
        ]);
    }

    public function edit(Establishment $establishment)
    {
        return view('establishments.edit', [
            'establishment' => $establishment
        ]);
    }

    public function update(Establishment $establishment)
    {
        $payment = $establishment->payments->last();

        $attributes = request()->validate([
            'date' => ['required'],
            'owner' => ['required'],
            'name' => ['required'],
            'address' => ['required'],
            'ops_number' => ['required', Rule::unique('establishments', 'ops_number')->ignore($establishment)],
            'fsic' => ['required', Rule::unique('establishments', 'fsic')->ignore($establishment)],
            'status' => ['required'],
            'occupancy' => ['required'],
            'io_number' => [Rule::unique('establishments', 'io_number')->ignore($establishment)]
        ]);

        $attributes['date_released'] = request('date_released') ?? null;
        $attributes['issuance'] = request('issuance') ?? null;
        $attributes['area'] = request('area') ?? null;
        $attributes['remarks'] = request('remarks') ?? null;
        $attributes['inspection_date'] = request('inspection_date') ?? null;
        $attributes['amount'] = request('amount') ?? null;
        $attributes['realty_tax'] = request('realty_tax') ?? null;
        $attributes['amount_paid'] = request('amount_paid') ?? null;
        $attributes['date_paid'] = request('date_paid') ?? null;
        $attributes['or_number'] = request('or_number') ?? null;

        $updatedEstablishment = [];
        $updatedPayment = [];

        if ($establishment->date != $attributes['date']) {
            $updatedEstablishment['date'] = $attributes['date'];
        }

        if ($establishment->owner != $attributes['owner']) {
            $updatedEstablishment['owner'] = $attributes['owner'];
        }

        if ($establishment->name != $attributes['name']) {
            $updatedEstablishment['name'] = $attributes['name'];
        }

        if ($establishment->address != $attributes['address']) {
            $updatedEstablishment['address'] = $attributes['address'];
        }

        if ($establishment->status != $attributes['status']) {
            $updatedEstablishment['status'] = $attributes['status'];
        }

        if ($establishment->occupancy != $attributes['occupancy']) {
            $updatedEstablishment['occupancy'] = $attributes['occupancy'];
        }

        if ($establishment->io_number != $attributes['io_number']) {
            $updatedEstablishment['io_number'] = $attributes['io_number'];
        }

        if ($establishment->date_released != $attributes['date_released']) {
            $updatedEstablishment['date_released'] = $attributes['date_released'];
        }

        if ($establishment->issuance != $attributes['issuance']) {
            $updatedEstablishment['issuance'] = $attributes['issuance'];
        }

        if ($establishment->area != $attributes['area']) {
            $updatedEstablishment['area'] = $attributes['area'];
        }

        if ($establishment->remarks != $attributes['remarks']) {
            $updatedEstablishment['remarks'] = $attributes['remarks'];
        }

        if ($establishment->inspection_date != $attributes['inspection_date']) {
            $updatedEstablishment['inspection_date'] = $attributes['inspection_date'];
        }

        if ($establishment->amount != $attributes['amount']) {
            $updatedEstablishment['amount'] = $attributes['amount'];
        }

        if ($establishment->realty_tax != $attributes['realty_tax']) {
            $updatedEstablishment['realty_tax'] = $attributes['realty_tax'];
        }

        if ($payment->amount_paid != $attributes['amount_paid']) {
            $updatedPayment['amount_paid'] = $attributes['amount_paid'];
        }

        if ($payment->date_paid != $attributes['date_paid']) {
            $updatedPayment['date_paid'] = $attributes['date_paid'];
        }

        if ($payment->or_number != $attributes['or_number']) {
            $updatedPayment['or_number'] = $attributes['or_number'];
        }

        if ($establishment->ops_number != $attributes['ops_number']) {
            $opsFormat = explode('-', $attributes['ops_number']);

            if (!$opsFormat && count($opsFormat) != 4) {
                throw ValidationException::withMessages([
                    'ops_number' => 'Invalid input format. Please follow the example.'
                ]);
            } else {
                $updatedEstablishment['ops_number'] = $attributes['ops_number'];
            }
        }

        if ($establishment->fsic != $attributes['fsic']) {
            $fsicFormat = explode('-', $attributes['fsic']);

            if ($fsicFormat && count($fsicFormat) == 4) {
                $fsicPrefix = $fsicFormat[0] . '-' . $fsicFormat[1] . '-'  .$fsicFormat[2];
                $fsicId = (int)$fsicFormat[3];
            } else {
                throw ValidationException::withMessages([
                    'fsic' => 'Invalid input format. Please follow the example.'
                ]);
            }

            $updatedEstablishment['fsic_prefix'] = $fsicPrefix;
            $updatedEstablishment['fsic_number'] = $fsicId;
            $updatedEstablishment['fsic'] = $attributes['fsic'];
        }

        $establishment->update($updatedEstablishment);
        $payment->update($updatedPayment);

        if (count($updatedEstablishment) !== 0 || count($updatedPayment) !== 0) {
            activity('Establishment Record Updated')
                ->causedBy(auth()->user())
                ->withProperties(['by' => auth()->user()->fullname()])
                ->log('A user has updated an existing establishment record. [' . $establishment->fsic . ']');

            return redirect(route('establishments.index'))->with('success', 'You have successfully updated an Establishment Record.');
        } else {
            return redirect(route('establishments.index'))->with('success', 'You did not update any field.');
        }
    }

    public function destroy(Establishment $establishment)
    {
        $payments = $establishment->payments;

        DB::transaction(function () use ($establishment, $payments) {
            foreach ($payments as $payment) {
                $payment->forceDelete();
            }

            $establishment->forceDelete();
        });

        activity('Establishment Record Deleted')
            ->causedBy(auth()->user())
            ->withProperties(['by' => auth()->user()->fullname()])
            ->log('A user has deleted an establishment record. [' . $establishment->fsic . ']');

        return redirect(route('establishments.index'))->with('success', 'You have successfully deleted an Establishment Record.');
    }

    protected function convertDate($date, $month): string
    {
        $m = 0;

        if ($month == 'JAN') {
            $m = '01';
        }

        if ($month == 'FEB') {
            $m = '02';
        }

        if ($month == 'MAR') {
            $m = '03';
        }

        if ($month == 'APR') {
            $m = '04';
        }

        if ($month == 'MAY') {
            $m = '05';
        }

        if ($month == 'JUN') {
            $m = '06';
        }

        if ($month == 'JUL') {
            $m = '07';
        }

        if ($month == 'AUG') {
            $m = '08';
        }

        if ($month == 'SEP') {
            $m = '09';
        }

        if ($month == 'OCT') {
            $m = '10';
        }

        if ($month == 'NOV') {
            $m = '11';
        }

        if ($month == 'DEC') {
            $m = '12';
        }

        $unformattedDate = explode(' ', $date);

        if (str_contains($unformattedDate[1], ',')) {
            $day = str_replace(',', '', $unformattedDate[1]);
        } else {
            $day = $unformattedDate[1];
        }

        $year = $unformattedDate[2];

        return Carbon::createFromDate($year, $m, $day)->toDateString();
    }
}

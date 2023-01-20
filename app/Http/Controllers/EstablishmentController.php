<?php

namespace App\Http\Controllers;

use App\Models\Establishment;
use App\Models\Payment;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;
use Rap2hpoutre\FastExcel\FastExcel;

class EstablishmentController extends Controller
{
    public function index()
    {
        return view('establishments.index', [
            'establishments' => Establishment::latest()->paginate(10)->withQueryString()
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

        foreach ($establishments as $establishment) {
            if (!array_key_exists('DATE', $establishment) && !array_key_exists('NAME OF OWNER', $establishment) && !array_key_exists('NAME OF ESTABLISHMENT', $establishment) && !array_key_exists('ADDRESS', $establishment) && !array_key_exists('AMOUNT PAID', $establishment) && !array_key_exists('DATE PAID', $establishment) && !array_key_exists('OR #', $establishment) && !array_key_exists('OPS #', $establishment) && !array_key_exists('DATE RELEASED', $establishment) && !array_key_exists('FSIC #', $establishment) && !array_key_exists('NEW / RENEW', $establishment) && !array_key_exists('TYPE OF OCCUPANCY', $establishment) && !array_key_exists('AREA SQ.M.', $establishment) && !array_key_exists('REMARKS', $establishment) && !array_key_exists('DATE OF INSPECTION', $establishment) && !array_key_exists('INSPECTION ORDER #', $establishment) && !array_key_exists('REALTY TAX', $establishment) && !array_key_exists('AMOUNT', $establishment)) {
                throw ValidationException::withMessages([
                    'establishments' => 'The column names might be invalid or the file you are trying to upload is invalid.'
                ]);
            }

            if (!empty($establishment['FSIC #'])) {
                try {
                    $id = explode('-', $establishment['FSIC #']);
                    $fsic_prefix = $id[0] . '-' . $id[1] . '-' . $id[2];
                    $fsic_number = $id[3];

                    $establishment['FSIC #'] = $fsic_prefix . '-' . $fsic_number;
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
                        'establishments' => 'The <span class="font-semibold">DATE</span> value format is invalid.'
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
                        'establishments' => 'The <span class="font-semibold">DATE PAID</span> value format is invalid.'
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
                        'establishments' => 'The <span class="font-semibold">DATE RELEASED</span> value format is invalid.'
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

            $count++;

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

            return redirect(route('establishments.import'))->with('success', 'You have successfully imported the establishments list.');
        }

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

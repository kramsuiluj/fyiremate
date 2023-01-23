<?php

namespace App\Http\Controllers;

use App\Models\Chief;
use Illuminate\Http\Request;

class AdminChiefDefaultController extends Controller
{
    public function __invoke(Chief $chief)
    {
        $chiefs = Chief::where('is_default', true)->get();

        if (count($chiefs) !== 0) {
            foreach ($chiefs as $c) {
                $c->update([
                    'is_default' => false
                ]);
            }
        }

        $chief->update([
            'is_default' => true
        ]);

        activity('Default Chief Set')
            ->causedBy(auth()->user())
            ->withProperties(['by' => auth()->user()->fullname()])
            ->log('A Chief, FSES has been set to default. [' . $chief->fullname() . ']');

        return redirect(route('administrators.chiefs.index'))->with('success', 'You have successfully set the selected chief as the default chief.');
    }
}

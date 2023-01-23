<?php

namespace App\Http\Controllers;

use App\Models\Marshal;
use Illuminate\Http\Request;

class AdminMarshalDefaultController extends Controller
{
    public function __invoke(Marshal $marshal)
    {
        $marshals = Marshal::where('is_default', true)->get();

        if (count($marshals) !== 0) {
            foreach ($marshals as $m) {
                $m->update([
                    'is_default' => false
                ]);
            }
        }

        $marshal->update([
            'is_default' => true
        ]);

        activity('Default Marshal Set')
            ->causedBy(auth()->user())
            ->withProperties(['by' => auth()->user()->fullname()])
            ->log('A city fire marshal has been set to default. [' . $marshal->fullname() . ']');

        return redirect(route('administrators.marshals.index'))->with('success', 'You have successfully set the selected marshal as the default marshal.');
    }
}

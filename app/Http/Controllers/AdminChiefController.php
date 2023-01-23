<?php

namespace App\Http\Controllers;

use App\Models\Chief;
use App\Models\Marshal;
use Illuminate\Validation\Rule;

class AdminChiefController extends Controller
{
    public function index()
    {
        return view('administrators.chiefs.index', [
            'chiefs' => Chief::latest()->paginate(10)
        ]);
    }

    public function create()
    {
        return view('administrators.chiefs.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'rank' => ['nullable', 'min:1', 'max:25', 'string'],
            'firstname' => ['required', 'min:2', 'max:30', 'alpha_spaces',
                Rule::unique('chiefs')
                    ->where('firstname', request('firstname'))
                    ->where('middlename', request('middlename'))
                    ->where('lastname', request('lastname'))
            ],
            'middlename' => ['required', 'min:1', 'max:30', 'alpha_spaces',
                Rule::unique('chiefs')
                    ->where('firstname', request('firstname'))
                    ->where('middlename', request('middlename'))
                    ->where('lastname', request('lastname'))
            ],
            'lastname' => ['required', 'min:2', 'max:30', 'alpha_spaces',
                Rule::unique('chiefs')
                    ->where('firstname', request('firstname'))
                    ->where('middlename', request('middlename'))
                    ->where('lastname', request('lastname'))
            ]
        ]);

        $chief = Chief::create($attributes);

        activity('Chief Created')
            ->causedBy(auth()->user())
            ->withProperties(['by' => auth()->user()->fullname()])
            ->log('Administrator has created a Chief, FSES. [' . $chief->fullname() . ']');

        return redirect(route('administrators.chiefs.index'))->with('success', 'You have successfully created a city fire marshal.');
    }

    public function edit(Chief $chief)
    {
        return view('administrators.chiefs.edit', [
            'chief' => $chief
        ]);
    }

    public function update(Chief $chief)
    {
        $attributes = request()->validate([
            'rank' => ['nullable', 'min:1', 'max:25', 'nullable'],
            'firstname' => ['required', 'min:2', 'max:30', 'alpha_spaces',
                Rule::unique('marshals')
                    ->where('firstname', request('firstname'))
                    ->where('middlename', request('middlename'))
                    ->where('lastname', request('lastname'))
                    ->ignore($chief)
            ],
            'middlename' => ['required', 'min:1', 'max:30', 'alpha_spaces',
                Rule::unique('marshals')
                    ->where('firstname', request('firstname'))
                    ->where('middlename', request('middlename'))
                    ->where('lastname', request('lastname'))
                    ->ignore($chief)
            ],
            'lastname' => ['required', 'min:2', 'max:30', 'alpha_spaces',
                Rule::unique('marshals')
                    ->where('firstname', request('firstname'))
                    ->where('middlename', request('middlename'))
                    ->where('lastname', request('lastname'))
                    ->ignore($chief)
            ]
        ]);

        $updated = [];

        if ($chief->rank !== $attributes['rank']) {
            $updated['rank'] = $attributes['rank'];
        }

        if ($chief->firstname !== $attributes['firstname']) {
            $updated['firstname'] = $attributes['firstname'];
        }

        if ($chief->middlename !== $attributes['middlename']) {
            $updated['middlename'] = $attributes['middlename'];
        }

        if ($chief->lastname !== $attributes['lastname']) {
            $updated['lastname'] = $attributes['lastname'];
        }

        if (count($updated) === 0) {
            return redirect(route('administrators.chiefs.index'))->with('info', 'You did not update any field.');
        }

        $chief->update($updated);

        activity('Chief Updated')
            ->causedBy(auth()->user())
            ->withProperties(['by' => auth()->user()->fullname()])
            ->log('Administrator has updated a city fire marshal profile. [' . $chief->fullname() . ']');

        return redirect(route('administrators.chiefs.index'))->with('success', 'You have successfully updated the selected Chief, FSES.');
    }


    public function destroy(Chief $chief)
    {
        $chief->delete();

        activity('Chief Deleted')
            ->causedBy(auth()->user())
            ->withProperties(['by' => auth()->user()->fullname()])
            ->log('Administrator has deleted a Chief, FSES. [' . $chief->fullname() . ']');

        return redirect(route('administrators.chiefs.index'))->with('success', 'You have successfully deleted the selected marshal.');
    }

    public function history()
    {
        return view('administrators.chiefs.history', [
            'chiefs' => Chief::onlyTrashed()->latest()->paginate(10)
        ]);
    }

    public function restore($id)
    {
        $chief = Chief::withTrashed()->find($id);

        $chief->restore();

        activity('Chief Restored')
            ->causedBy(auth()->user())
            ->withProperties(['by' => auth()->user()->fullname()])
            ->log('Administrator has restored a Chief, FSES. [' . $chief->fullname() . ']');

        return redirect(route('administrators.chiefs.index'))->with('success', 'You have successfully restored the selected marshal.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Chief;
use App\Models\Marshal;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminMarshalController extends Controller
{
    public function index()
    {
        return view('administrators.marshals.index', [
            'marshals' => Marshal::latest()->paginate(10)
        ]);
    }

    public function create()
    {
        return view('administrators.marshals.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'rank' => ['nullable', 'min:1', 'max:25', 'string'],
            'firstname' => ['required', 'min:2', 'max:30', 'alpha_spaces',
                Rule::unique('marshals')
                    ->where('firstname', request('firstname'))
                    ->where('middlename', request('middlename'))
                    ->where('lastname', request('lastname'))
            ],
            'middlename' => ['required', 'min:1', 'max:30', 'alpha_spaces',
                Rule::unique('marshals')
                    ->where('firstname', request('firstname'))
                    ->where('middlename', request('middlename'))
                    ->where('lastname', request('lastname'))
            ],
            'lastname' => ['required', 'min:2', 'max:30', 'alpha_spaces',
                Rule::unique('marshals')
                    ->where('firstname', request('firstname'))
                    ->where('middlename', request('middlename'))
                    ->where('lastname', request('lastname'))
            ]
        ]);

        $marshal = Marshal::create($attributes);

        activity('Marshal Created')
            ->causedBy(auth()->user())
            ->withProperties(['by' => auth()->user()->fullname()])
            ->log('Administrator has created a city fire marshal. [' . $marshal->fullname() . ']');

        return redirect(route('administrators.marshals.index'))->with('success', 'You have successfully created a city fire marshal.');
    }

    public function edit(Marshal $marshal)
    {
        return view('administrators.marshals.edit', [
            'marshal' => $marshal
        ]);
    }

    public function update(Marshal $marshal)
    {
        $attributes = request()->validate([
            'rank' => ['nullable', 'min:1', 'max:25', 'nullable'],
            'firstname' => ['required', 'min:2', 'max:30', 'alpha_spaces',
                Rule::unique('marshals')
                    ->where('firstname', request('firstname'))
                    ->where('middlename', request('middlename'))
                    ->where('lastname', request('lastname'))
                    ->ignore($marshal)
            ],
            'middlename' => ['required', 'min:1', 'max:30', 'alpha_spaces',
                Rule::unique('marshals')
                    ->where('firstname', request('firstname'))
                    ->where('middlename', request('middlename'))
                    ->where('lastname', request('lastname'))
                    ->ignore($marshal)
            ],
            'lastname' => ['required', 'min:2', 'max:30', 'alpha_spaces',
                Rule::unique('marshals')
                    ->where('firstname', request('firstname'))
                    ->where('middlename', request('middlename'))
                    ->where('lastname', request('lastname'))
                    ->ignore($marshal)
            ]
        ]);

        $updated = [];

        if ($marshal->rank !== $attributes['rank']) {
            $updated['rank'] = $attributes['rank'];
        }

        if ($marshal->firstname !== $attributes['firstname']) {
            $updated['firstname'] = $attributes['firstname'];
        }

        if ($marshal->middlename !== $attributes['middlename']) {
            $updated['middlename'] = $attributes['middlename'];
        }

        if ($marshal->lastname !== $attributes['lastname']) {
            $updated['lastname'] = $attributes['lastname'];
        }

        if (count($updated) === 0) {
            return redirect(route('administrators.marshals.index'))->with('info', 'You did not update any field.');
        }

        $marshal->update($updated);

        activity('Marshal Updated')
            ->causedBy(auth()->user())
            ->withProperties(['by' => auth()->user()->fullname()])
            ->log('Administrator has updated a city fire marshal profile. [' . $marshal->fullname() . ']');

        return redirect(route('administrators.marshals.index'))->with('success', 'You have successfully updated the selected city fire marshal.');
    }

    public function destroy(Marshal $marshal)
    {
        $marshal->delete();

        activity('Marshal Deleted')
            ->causedBy(auth()->user())
            ->withProperties(['by' => auth()->user()->fullname()])
            ->log('Administrator has deleted a city fire marshal. [' . $marshal->fullname() . ']');

        return redirect(route('administrators.marshals.index'))->with('success', 'You have successfully deleted the selected marshal.');
    }

    public function history()
    {
        return view('administrators.marshals.history', [
            'marshals' => Marshal::onlyTrashed()->latest()->paginate(10)
        ]);
    }

    public function restore($id)
    {
        $marshal = Marshal::withTrashed()->find($id);

        $marshal->restore();

        activity('Marshal Restored')
            ->causedBy(auth()->user())
            ->withProperties(['by' => auth()->user()->fullname()])
            ->log('Administrator has restored a city fire marshal. [' . $marshal->fullname() . ']');

        return redirect(route('administrators.marshals.index'))->with('success', 'You have successfully restored the selected marshal.');
    }
}

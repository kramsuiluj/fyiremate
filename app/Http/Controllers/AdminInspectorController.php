<?php

namespace App\Http\Controllers;

use App\Models\Inspector;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminInspectorController extends Controller
{
    public function index()
    {
        return view('administrators.inspectors.index', [
            'inspectors' => Inspector::latest()->paginate(10)
        ]);
    }

    public function create()
    {
        return view('administrators.inspectors.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'rank' => ['nullable', 'min:1', 'max:25', 'string'],
            'firstname' => ['required', 'min:2', 'max:30', 'alpha_spaces',
                Rule::unique('inspectors')
                    ->where('firstname', request('firstname'))
                    ->where('middlename', request('middlename'))
                    ->where('lastname', request('lastname'))
            ],
            'middlename' => ['required', 'min:1', 'max:30', 'alpha_spaces',
                Rule::unique('inspectors')
                    ->where('firstname', request('firstname'))
                    ->where('middlename', request('middlename'))
                    ->where('lastname', request('lastname'))
            ],
            'lastname' => ['required', 'min:2', 'max:30', 'alpha_spaces',
                Rule::unique('inspectors')
                    ->where('firstname', request('firstname'))
                    ->where('middlename', request('middlename'))
                    ->where('lastname', request('lastname'))
            ],
        ]);

        $inspector = Inspector::create($attributes);

        activity('Inspector Created')
            ->causedBy(auth()->user())
            ->withProperties(['by' => auth()->user()->fullname()])
            ->log('Administrator has created an inspector. [' . $inspector->fullname() . ']');

        return redirect(route('administrators.inspectors.index'))->with('success', 'You have successfully created an Inspector.');
    }

    public function edit(Inspector $inspector)
    {
        return view('administrators.inspectors.edit', [
            'inspector' => $inspector
        ]);
    }

    public function update(Inspector $inspector)
    {
        $attributes = request()->validate([
            'rank' => ['nullable', 'min:1', 'max:25', 'string'],
            'firstname' => ['required', 'min:2', 'max:30', 'alpha_spaces',
                Rule::unique('inspectors')
                    ->where('firstname', request('firstname'))
                    ->where('middlename', request('middlename'))
                    ->where('lastname', request('lastname'))
                    ->ignore($inspector)
            ],
            'middlename' => ['required', 'min:1', 'max:30', 'alpha_spaces',
                Rule::unique('inspectors')
                    ->where('firstname', request('firstname'))
                    ->where('middlename', request('middlename'))
                    ->where('lastname', request('lastname'))
                    ->ignore($inspector)
            ],
            'lastname' => ['required', 'min:2', 'max:30', 'alpha_spaces',
                Rule::unique('inspectors')
                    ->where('firstname', request('firstname'))
                    ->where('middlename', request('middlename'))
                    ->where('lastname', request('lastname'))
                    ->ignore($inspector)
            ]
        ]);

        $updated = [];

        if ($inspector->rank !== $attributes['rank']) {
            $updated['rank'] = $attributes['rank'];
        }

        if ($inspector->firstname !== $attributes['firstname']) {
            $updated['firstname'] = $attributes['firstname'];
        }

        if ($inspector->middlename !== $attributes['middlename']) {
            $updated['middlename'] = $attributes['middlename'];
        }

        if ($inspector->lastname !== $attributes['lastname']) {
            $updated['lastname'] = $attributes['lastname'];
        }

        if (count($updated) === 0) {
            return redirect(route('administrators.inspectors.index'))->with('info', 'You did not updated any field.');
        }

        $inspector->update($updated);

        activity('Inspector Updated')
            ->causedBy(auth()->user())
            ->withProperties(['by' => auth()->user()->fullname()])
            ->log("An inspector details has been updated. [" . $inspector->fullname() . ']');

        return redirect(route('administrators.inspectors.index'))->with('success', 'You have successfully updated the selected inspector.');
    }

    public function destroy(Inspector $inspector)
    {
        $inspector->delete();

        activity('Inspector Deleted')
            ->causedBy(auth()->user())
            ->withProperties(['by' => auth()->user()->fullname()])
            ->log("An inspector record has been deleted. [" . $inspector->fullname() . ']');

        return redirect(route('administrators.inspectors.index'))->with('success', 'You have successfully deleted an inspector.');
    }
}

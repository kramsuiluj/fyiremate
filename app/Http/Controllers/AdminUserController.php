<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class AdminUserController extends Controller
{
    public function index()
    {
        return view('administrators.users.index', [
            'users' => User::where('is_admin', 'false')->latest()->paginate(10)
        ]);
    }

    public function create()
    {
        return view('administrators.users.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'username' => ['required', 'min:5', 'max:25', 'alpha_dash', Rule::unique('users', 'username')],
            'rank' => ['min:1', 'max:25', 'string', 'nullable'],
            'firstname' => ['min:2', 'max:30', 'alpha_spaces',
                Rule::unique('users')
                    ->where('firstname', request('firstname'))
                    ->where('middlename', request('middlename'))
                    ->where('lastname', request('lastname'))
            ],
            'middlename' => ['min:2', 'max:30', 'alpha_spaces',
                Rule::unique('users')
                    ->where('firstname', request('firstname'))
                    ->where('middlename', request('middlename'))
                    ->where('lastname', request('lastname'))
            ],
            'lastname' => ['min:2', 'max:30', 'alpha_spaces',
                Rule::unique('users')
                    ->where('firstname', request('firstname'))
                    ->where('middlename', request('middlename'))
                    ->where('lastname', request('lastname'))
            ],
            'password' => ['required', Password::default(), 'confirmed']
        ]);

        $attributes['password'] = bcrypt($attributes['password']);

        $user = User::create([
            'username' => $attributes['username'],
            'rank' => $attributes['rank'],
            'firstname' => $attributes['firstname'],
            'middlename' => $attributes['middlename'],
            'lastname' => $attributes['lastname'],
            'password' => $attributes['password']
        ]);

        activity('End User Created')
            ->causedBy(auth()->user())
            ->withProperties(['by' => auth()->user()->fullname()])
            ->log('Administrator has created an end user. [' . $user->username . ']');

        return redirect(route('administrators.users.index'))->with('success', 'You have successfully created an end user.');
    }

    public function edit(User $user)
    {
        return view('administrators.users.edit', [
            'user' => $user
        ]);
    }

    public function update(User $user)
    {
        $attributes = request()->validate([
            'username' => ['required', 'min:5', 'max:25', 'alpha_dash', Rule::unique('users', 'username')->ignore($user)],
            'rank' => ['min:1', 'max:25', 'string', 'nullable'],
            'firstname' => ['min:2', 'max:30', 'alpha_spaces',
                Rule::unique('users')
                    ->where('firstname', request('firstname'))
                    ->where('middlename', request('middlename'))
                    ->where('lastname', request('lastname'))
                    ->ignore($user)
            ],
            'middlename' => ['min:2', 'max:30', 'alpha_spaces',
                Rule::unique('users')
                    ->where('firstname', request('firstname'))
                    ->where('middlename', request('middlename'))
                    ->where('lastname', request('lastname'))
                    ->ignore($user)
            ],
            'lastname' => ['min:2', 'max:30', 'alpha_spaces',
                Rule::unique('users')
                    ->where('firstname', request('firstname'))
                    ->where('middlename', request('middlename'))
                    ->where('lastname', request('lastname'))
                    ->ignore($user)
            ]
        ]);

        $updated = [];

        if ($user->username !== $attributes['username']) {
            $updated['username'] = $attributes['username'];
        }

        if ($user->rank !== $attributes['rank']) {
            $updated['rank'] = $attributes['rank'];
        }

        if ($user->firstname !== $attributes['firstname']) {
            $updated['firstname'] = $attributes['firstname'];
        }

        if ($user->middlename !== $attributes['middlename']) {
            $updated['middlename'] = $attributes['middlename'];
        }

        if ($user->lastname !== $attributes['lastname']) {
            $updated['lastname'] = $attributes['lastname'];
        }

        if (count($updated) > 0) {
            $user->update($updated);

            activity('End User Updated')
                ->causedBy(auth()->user())
                ->withProperties(['by' => auth()->user()->fullname()])
                ->log("Administrator has updated end user's details. [" . $user->username . ']');

            return redirect(route('administrators.users.index'))->with('success', 'You have successfully updated the selected user.');
        } else {
            return redirect(route('administrators.users.index'))->with('success', 'You did not update any field.');
        }
    }

    public function reset(User $user)
    {
        $user->update([
            'password' => bcrypt('!password')
        ]);

        activity('End User Password Reset')
            ->causedBy(auth()->user())
            ->withProperties(['by' => auth()->user()->fullname()])
            ->log("An end user's password has been reset. [" . $user->username . ']');

        return redirect(route('administrators.users.index'))->with('success', "You have successfully reset the end user's password.");
    }

    public function destroy(User $user)
    {
        $user->delete();

        activity('End User Deleted')
            ->causedBy(auth()->user())
            ->withProperties(['by' => auth()->user()->fullname()])
            ->log("An end user has been deleted. [" . $user->username . ']');

        return redirect(route('administrators.users.index'))->with('success', 'You have successfully delete the selected user.');
    }
}

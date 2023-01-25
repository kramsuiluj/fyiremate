<?php

namespace App\Http\Controllers;


use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function __invoke()
    {
        $credentials = request()->validate([
            'username' => ['required', 'min:4', 'alpha_num', Rule::exists('users', 'username')],
            'password' => ['required', Password::min(8)]
        ]);

        if (!auth()->attempt($credentials, request('remember'))) {
            throw ValidationException::withMessages([
                'username' => "Username or Password you entered must've been incorrect."
            ]);
        }

        session()->regenerate();

        if (!auth()->user()->is_admin) {
            activity('Login')
                ->causedBy(auth()->user())
                ->withProperties(['by' => auth()->user()->fullname()])
                ->log('User has logged in.');
            return redirect(route('dashboards.index'))->with('success', 'Welcome ' . ucwords(auth()->user()->firstname) . ' !');
        }

        activity('Login')
            ->causedBy(auth()->user())
            ->withProperties(['by' => auth()->user()->fullname()])
            ->log('Administrator has logged in.');
        return redirect(route('dashboards.index'))->with('success', 'Welcome ' . ucwords(auth()->user()->firstname) . ' !');
    }
}

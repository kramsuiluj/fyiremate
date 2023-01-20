<?php

namespace App\Http\Controllers;


class LogoutController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();

        auth()->logout();

        if (!$user->is_admin) {
            activity('Logout')->causedBy($user)->log('User has logged out.');
            return redirect(route('index'));
        }

        activity('Logout')->causedBy($user)->log('Administrator has logged out.');
        return redirect('/');
    }
}

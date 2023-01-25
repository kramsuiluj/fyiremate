<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class AccountController extends Controller
{
    public function edit()
    {
        return view('passwords.edit');
    }

    public function update(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => ['required', 'confirmed', Password::default()],
        ]);

        if(!Hash::check($request->old_password, auth()->user()->password)){
            throw ValidationException::withMessages([
                'old_password' => 'You entered the wrong password.'
            ]);
//            return back()->with("error", "Old Password Doesn't match!");
        }

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect(route('dashboards.index'))->with('success', 'You have successfully changed your password.');
    }
}

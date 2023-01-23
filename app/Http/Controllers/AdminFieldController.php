<?php

namespace App\Http\Controllers;

use App\Models\Field;
use Illuminate\Http\Request;

class AdminFieldController extends Controller
{
    public function index()
    {
        return view('administrators.fields.index', [
            'id_prefix' => Field::firstWhere('name', 'id_prefix'),
            'io_prefix' => Field::firstWhere('name', 'io_prefix')
        ]);
    }

    public function setIdPrefix() {
        $attributes = request()->validate([
            'id_prefix' => ['required']
        ]);

        $id_prefix = Field::create([
            'name' => 'id_prefix',
            'value' => $attributes['id_prefix']
        ]);

        activity('Set ID Prefix')
            ->causedBy(auth()->user())
            ->withProperties(['by' => auth()->user()->fullname()])
            ->log('Administrator has set the default value of ID prefix.');


        return redirect(route('administrators.fields.index'));
    }

    public function setIoPrefix() {
        $attributes = request()->validate([
            'io_prefix' => ['required']
        ]);

        $id_prefix = Field::create([
            'name' => 'io_prefix',
            'value' => $attributes['io_prefix']
        ]);

        activity('Set IO Prefix')
            ->causedBy(auth()->user())
            ->withProperties(['by' => auth()->user()->fullname()])
            ->log('Administrator has set the default value of IO prefix.');


        return redirect(route('administrators.fields.index'));
    }


    public function updateIoPrefix($id) {
        $attributes = request()->validate([
            'io_prefix' => ['required']
        ]);

        $io_prefix = Field::find($id);

        $io_prefix->update([
            'value' => $attributes['io_prefix']
        ]);

        activity('Updated IO Prefix')
            ->causedBy(auth()->user())
            ->withProperties(['by' => auth()->user()->fullname()])
            ->log('Administrator has updated the default value of IO prefix.');


        return redirect(route('administrators.fields.index'))->with('success', 'You have successfully updated the IO Prefix.');

    }

    public function updateIdPrefix($id) {
        $attributes = request()->validate([
            'id_prefix' => ['required']
        ]);

        $id_prefix = Field::find($id);

        $id_prefix->update([
            'value' => $attributes['id_prefix']
        ]);

        activity('Updated ID Prefix')
            ->causedBy(auth()->user())
            ->withProperties(['by' => auth()->user()->fullname()])
            ->log('Administrator has updated the default value of ID prefix.');


        return redirect(route('administrators.fields.index'))->with('success', 'You have successfully updated the ID Prefix.');

    }
}

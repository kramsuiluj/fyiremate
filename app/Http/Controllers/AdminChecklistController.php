<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use Illuminate\Http\Request;

class AdminChecklistController extends Controller
{
    public function create()
    {
        return view('administrators.checklists.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'type' => ['required'],
            'file' => ['required', 'mimes:docx']
        ]);

        $template = Checklist::create([
            'type' => $attributes['type'],
        ]);

        if (request('file')) {
            $template->addMediaFromRequest('file')->toMediaCollection();
        }

        return redirect(route('administrators.checklists.upload'))->with('success', 'You have successfully uploaded a template.');
    }
}

<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;
use Spatie\Activitylog\Models\Activity;

class AdminActionController extends Controller
{
    public function index()
    {


        return view('administrators.actions.index', [
            'actions' => Activity::latest()->paginate(10)
        ]);
    }

    public function export()
    {
        $actions = Activity::latest()->get(['created_at', 'log_name', 'description', 'properties'])->toArray();

        $actions = array_map(function ($action) {
            $action['created_at'] = Carbon::createFromTimeString($action['created_at'])->isoFormat('MMMM D, YYYY h:mm:ss a');
            $action['by'] = $action['properties']['by'];
            return $action;
        }, $actions);

        return (new FastExcel(collect($actions)))->download('actions_logs.xlsx');
    }
}

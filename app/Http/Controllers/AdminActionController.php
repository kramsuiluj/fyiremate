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
            'actions' => Activity::latest()->filter(request(['from', 'to']))->paginate(10)->withQueryString()
        ]);
    }

    public function export()
    {
        $from = request('from');
        $to = request('to');

        $actions = Activity::latest()->whereBetween('created_at', [$from, $to])->get(['created_at', 'log_name', 'description', 'properties'])->toArray();

        $actions = array_map(function ($action) {
            $action['created_at'] = Carbon::createFromTimeString($action['created_at'])->isoFormat('MMMM D, YYYY h:mm:ss a');
            $action['by'] = $action['properties']['by'];
            return $action;
        }, $actions);

        return (new FastExcel(collect($actions)))->download('actions_logs.xlsx');

//        return redirect(route('administrators.actions.index'))->with('success', 'You have successfully exported actions log records.');
    }
}

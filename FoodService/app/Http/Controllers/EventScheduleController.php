<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventSchedule;

class EventScheduleController extends Controller
{
    public function index()
    {
        $schedules = EventSchedule::all();
        return view('event_schedules.index', compact('schedules'));
    }
}

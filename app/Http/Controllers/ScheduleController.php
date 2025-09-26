<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function schedule(Request $request) {
        
        $validated = $request->validate([
            'client_id' => ['required', 'int', 'exists:clients,id'],
            'start_date' => ['required', 'date']
            // 'end_date' => ['nullable', 'date']
        ]);

        $schedule = Schedule::create([
            'client_id' => $validated['client_id'],
            'start_date' => $validated['start_date']
            // 'end_date' => $validated['end_date']
        ]);

        return response()->json(['agendado' => true, 'schedule' => $schedule]);
        
    }
}

<?php

namespace App\Services;
use App\Models\Schedule;

class ScheduleService {

    public function create(Array $scheduleData) {
        
        #após a validação chamo o método create() da classe Schedule para ja criar o registro pronto para armazenar no banco
        $schedule = Schedule::create([

            'client_id' => $scheduleData['client_id'],
            'start_date' => $scheduleData['start_date'],
            'type' => $scheduleData['type']
            // 'end_date' => $validated['end_date']

        ]);

        return $schedule;

    }

}
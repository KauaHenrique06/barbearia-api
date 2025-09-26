<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ScheduleController extends Controller
{
    public function create(Request $request) {
        
        $validated = $request->validate([
            'client_id' => ['required', 'int', 'exists:clients,id'],
            'start_date' => ['required', 'date'],
            'type' => ['required', 'string', 'max:50']
            // 'end_date' => ['nullable', 'date']
        ]);

        $schedule = Schedule::create([
            'client_id' => $validated['client_id'],
            'start_date' => $validated['start_date'],
            'type' => $validated['type']
            // 'end_date' => $validated['end_date']
        ]);

        return response()->json(['agendado' => true, 'schedule' => $schedule]);
        
    }

    /**
     * Indico que vou receber o o id como parâmetro na URL (foi definido nas routes) 
     */
    public function show($id) {

        #chamo o método findOrFail() para buscar os dados da tabela (levando em consideração o ID que foi passado)
        $schedule = Schedule::findOrFail($id);

        return response()->json(["serviços do id: $id" => $schedule]);

    }

    public function showAll() {

        #chamo o método all() para buscar todos os dados da tabela e armazeno na variável
        $schedule = Schedule::all();

        #retorno em formato json os itens da tabela
        return response()->json(['todos os serviços' => $schedule]);

    }

}

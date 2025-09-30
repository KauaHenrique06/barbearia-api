<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterScheduleRequest;
use App\Models\Schedule;
use App\Services\ScheduleService;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{

    protected ScheduleService $scheduleService;

    public function __construct(ScheduleService $scheduleService)
    {
        $this->scheduleService = $scheduleService;
    }

    public function create(RegisterScheduleRequest $request) {
        
        $schedule = $this->scheduleService->create($request->validated());

        return response()->json(['agendado' => true, 'schedule' => $schedule]);
        
    }

    /**
     * Indico que vou receber o o id como parâmetro na URL (foi definido nas routes) 
     */
    public function show($id) {

        #chamo o método findOrFail() para buscar os dados da tabela (levando em consideração o ID que foi passado)
        $schedule = Schedule::findOrFail($id);

        if(!$schedule) {

            return response()->json(['serviços' => "esse usuário não possui nenhum agendamento"]);

        }

        return response()->json(["serviços do id: $id" => $schedule]);

    }

    public function showAll() {

        #chamo o método all() para buscar todos os dados da tabela e armazeno na variável
        $schedule = Schedule::all();

        if(!$schedule) {

            return response()->json(['serviços' => "nenhum cliente com serviço agendado no momento"]);

        }

        #retorno em formato json os itens da tabela
        return response()->json(['todos os serviços' => $schedule]);

    }

    public function delete($id) {

        $schedule = Schedule::find($id);

        if(!$schedule) {

            return response()->json(['deleted' => false, 'mensagem' => "agendamento de id: $id não encontrado"]);

        }

        $schedule->delete();

        return response()->json(['deleted' => true, 'mensagem' => "agendamento excluido"]);

    }

}

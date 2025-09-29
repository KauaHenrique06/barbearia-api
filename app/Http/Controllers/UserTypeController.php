<?php

namespace App\Http\Controllers;

use App\Models\UserType;
use Illuminate\Http\Request;

class UserTypeController extends Controller
{
    public function create(Request $request) {

        $validated = $request->validate([
            'type' => ['required', 'string']
        ]);

        $userType = UserType::create([
            'type' => $validated['type']
        ]);

        return response()->json(['ok' => true, 'mensagem' => 'tipos de usuários criado com sucesso', 'types' => $userType]);

    }

    public function show() {

        $userType = UserType::all();

        if(!$userType) {

            return response()->json(['mensagem' => 'nenhum tipo de usuário registrado']);

        }

        return response()->json(['userType' => $userType]);

    }

    public function delete($id) {

        $userType = UserType::find($id);

        if(!$userType) {

            return response()->json(['deleted' => false, 'mensagem' => "userType de id: $id não encontrado"]);

        }

        return response()->json(['deleted' => true, 'mensagem' => "userType de id: $id excluido"]);

    }
}

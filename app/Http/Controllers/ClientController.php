<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    public function create(Request $request) {

        $validated = $request->validate([
            'phone' => ['required', 'string', 'max:11'],
            'address' => ['required', 'string', 'max:100'],
            'city' => ['required', 'string', 'max:100'],
            'user_id' => ['required', 'int', 'exists:users,id']
        ]);

        $client = Client::create([
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'city' => $validated['city'],
            'user_id' => $validated['user_id']
        ]);

        return response()->json(['client' => true, 'client' => $client]);

    }

    public function show($id) {

        $client = Client::findOrFail($id);

        if(!$client) {

            return response()->json(['busca' => false, 'mensagem' => "cliente de id: $id não encontrado"]);

        }

        return response()->json(['busca' => true, 'cliente' => $client]);

    }

    public function showAll() {

           $client = Client::all();

        if(!$client) {

            return response()->json(['cliente' => "nenhum cliente encontrado"]);

        }

        #retorno em formato json os itens da tabela
        return response()->json(['todos os clientes' => $client]);

    }
 
    public function update(Request $request, $id) {
        //
    }

    public function delete($id) {

        #procura o usuário de id x (que foi passado na requisição) e armazena na variável
        $client = Client::find($id);

        #caso o cliente não seja encontrado no banco retornará um erro
        if(!$client) {

            return response()->json(['deleted' => false, 'mensagem' => "usuário de id: $id não foi encontrado" ]);

        }

        #caso o usuário realmente exista ele irá apagar do banco devido ao método delete()
        $client->delete();

        return response()->json(['deleted' => true, 'mensagem' => 'usuário excluído com sucesso']);

    }

}

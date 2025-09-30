<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use App\Services\ClientService;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    protected ClientService $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    public function create(CreateClientRequest $request) {

        $client = $this->clientService->create($request->validated());

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
 
    public function update(UpdateClientRequest $request, $id) {

        #para atualizar dados eu preciso verificar os dados assim como os outros para validar os dados novos

        $client = $this->clientService->update($request->validated(), $id);

        return response()->json(['atualizado' => true, 'mensagem' => 'dados atualizados com sucesso', 'dados' => $client]);

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

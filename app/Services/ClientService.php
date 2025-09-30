<?php

namespace App\Services;
use App\Models\Client;

class ClientService {

    public function create(Array $clientData) {

        $client = Client::create([

            'phone' => $clientData['phone'],
            'address' => $clientData['address'],
            'city' => $clientData['city'],
            'user_id' => $clientData['user_id']

        ]);

        return $client;
    }

    public function update(Array $newClientData, $id) {

        #chama o método que vai procurar no banco os dados do id passado na requisição 
        $client = Client::findOrFail($id);

        if(!$client) {

            return response()->json(['atualizado' => false, 'mensagem' => "usuário de id: $id não cadastrado"]);

        }

        #chamo o método update nos dados que estão armazenados dentro da variavel $validated
        $client->update($newClientData);

        return $client;

    }

}
<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function teste(Request $request) {

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
}

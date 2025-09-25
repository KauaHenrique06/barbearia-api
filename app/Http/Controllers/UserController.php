<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Criação de usuário do sistema e armazenando no banco
     * juntamente com o seu tipo, que será passado no body da requisição
     * 
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'string'],
            'password' => ['required', 'min:6'],
            'user_type_id' => ['required', 'int', 'between:1,2', 'exists:user_types,id'] 
        ]);

        $dadosUser = $request->all();
        return response(User::create($dadosUser), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //return User::get();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

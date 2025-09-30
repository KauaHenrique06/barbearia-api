<?php

namespace App\Services;
use App\Models\User;

class AuthService {

    public function register(Array $userData) {

        /**
         * recebe os dados validados do RegisterUserRequest e armazena dentro da variável $user
         * retornando a variável 
         */
        $user = User::create([

            'name' => $userData['name'],
            'email' => $userData['email'],
            'password' => $userData['password'], 
            'user_type_id' => $userData['user_type_id']
        ]);

        return $user;

    }

}
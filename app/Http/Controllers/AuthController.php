<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{

    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Criação do Endpoint de registro de usuário com geração de token
     */
    public function register(RegisterUserRequest $request) {

        $user = $this->authService->register($request->validated());

        /*
        crio o token e armazeno na variável de mesmo nome
        após isso determino o nome do token e coloco a habilidade baseada no token
        */
        $token = $user->createToken('token-api'); 

        /*
        retorno para o usuário um json informando que foi registrado (caso tudo tenha sido preenchido corretamente),
        os dados do usuário e o token que foi gerado após o registro
        */
        return response()->json(['registrado' => true, 'user' => $user, 'token' => $token]); 
    }

    public function login(Request $request) {

        #faço a validação somente do email e senha por se tratar do login
        $validated = $request->validate([
            'email' => ['required', 'string'],
            'password' => ['required', 'min:6'],
        ]);

        #se caso a tentativa de autenticação estiver correta
        if (Auth::attempt($validated)) {

            /*
            chamo a função do model User para verificar as credenciais,
            o 'firstOrFail()' serve para retornar o erro caso necessário
            */
            $user = User::where('email', $validated['email'])->firstOrFail();

            $token = $user->createToken('token-api');
            return response()->json(['user' => $user, 'logado' => true, 'token' => $token]);
        }

        #caso as credenciais acima estejam erradas vai retornar um erro em formato json
        return response()->json(['logado' => false, 'mensagem' => 'credenciais inválidas']);

    }

    public function logout(Request $request) {

        #o bearerToken informa que devo informar o token no cabeçalho da requisição
        $token = $request->bearerToken();

        #caso o token não seja informado irá retornar esse erro
        if (!$token) {
            return response()->json(['logout' => false, 'mensagem' => 'token não informado']);
        }

        #utilizo a classe PersonalAcessToken do sanctum e chamo o findToken(), passando o token recebido na requisição
        $accessToken = PersonalAccessToken::findToken($token);

        #caso o token inserido tenha expirado irá retornar esse erro
        if (!$accessToken) {
            return response()->json(['logout' => false, 'mensagem' => 'token inválido']);
        }

        #caso o token ainda esteja disponível ele irá apagar, fazendo assim o logout do user
        $accessToken->delete();
        return response()->json(['logout' => true, 'mensagem' => 'logout realizado com sucesso']);
    }

}

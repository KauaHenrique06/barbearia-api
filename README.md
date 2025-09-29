## Requisitos para rodar

- PHP 8.2 ou superior
- Composer 2.0 ou superior
- MySql

## Como executar

- Primeiramente deve verificar se as versões do PHP e do Composer estão nas recomendadas: php -v && composer -v
- Depois dar um git clone no repositório: git clone `https://github.com/KauaHenrique06/barbearia-api.git`
- Copie o arquivo `.env.example` e coloque o nome `.env`
- Alterar os dados referentes ao banco de dados no arquivo `.env`
```
Código gerado como padrão

DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306  
# DB_DATABASE=laravel
# DB_USERNAME=root
# DB_PASSWORD=
```
```
Exemplo do código ja formatado

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_barbearia //com o nome que preferir
DB_USERNAME=root //nome de usuário do banco
DB_PASSWORD=070506 //senha cadastrada no banco (caso possua uma)
```
- Logo depois de configurar a conexão com o banco é necessário criar as tabelas usando o comando: `php artisan migrate`
```
Provavelmente retornará um comando pareciido em caso de êxito

  2025_09_24_194159_create_user_types_table ........................................................... 17.77ms DONE
  2025_09_25_155930_create_users_table ............................................................... 146.61ms DONE
  2025_09_25_161249_create_personal_access_tokens_table ............................................... 65.31ms DONE
  2025_09_25_201303_create_clients_table .............................................................. 61.24ms DONE
  2025_09_25_201354_create_schedules_table ............................................................ 53.68ms DONE
```
## Para abrir a documentação dos Endpoints
- Abrir o link `856j4f7ba4.apidog.io` no navegador para abrir o Apidog online
- Na parte de baixo da página terá a opção de 'exportar dados'
- Escolha a opção OpenAPI Spec e OpenAPI 3.0, isso irá gerar um arquivo Json
- Abra o site do swagger `https://editor.swagger.io/`, limpe o código padrão que é gerado e abra o arquivo Json baixado

## Endpoints do sistema
### Endpoints do UserType (Criação, Listagem, Exclusão e Atualização) em ordem
- ` http://127.0.0.1:8000/api/usertype/create`
```
  //PASSAR NO CORPO DA REQUISIÇÃO
  { 
    "type": "admin"
  }

  //RETORNARÁ UM JSON ASSIM
  { 
    "ok": true,
    "mensagem": "string",
    "types": {
        "type": "string",
        "updated_at": "string",
        "created_at": "string",
        "id": 0
    }
  }
```
- `http://127.0.0.1:8000/api/usertype/showTypes`
```  
  //RESPOSTA AO FAZER A REQUISIÇÃO
  {
    "userType": [
        {
            "id": 1,
            "type": "admin",
            "created_at": "2025-09-29T13:16:55.000000Z",
            "updated_at": "2025-09-29T13:16:55.000000Z"
        },
        {
            "id": 2,
            "type": "cliente",
            "created_at": "2025-09-29T13:26:13.000000Z",
            "updated_at": "2025-09-29T13:26:13.000000Z"
        }
    ]
  }
```
- `http://127.0.0.1:8000/api/usertype/delete/{id}`
```
  //PASSAR O ID NA HORA DE FAZER A REQUISIÇÃO /{id}
  {
    "deleted": true,
    "mensagem": "userType de id: 1 excluido"
  }
```
- `http://127.0.0.1:8000/api/usertype/update{id}`
```
  //PASSAR O ID NA HORA DE FAZER A REQUISIÇÃO /{id}
  {
    "type": "admin1"
  }

  //RESPOSTA
  {
    "atualizado": true,
    "mensagem": "dados atualizados com sucesso",
    "dados": {
        "id": 1,
        "type": "admin1",
        "created_at": "2025-09-29T13:26:13.000000Z",
        "updated_at": "2025-09-29T15:58:52.000000Z"
    }
  }
```
### Endpoints de Autenticação (Registro, Login e Logout) 
- `http://127.0.0.1:8000/api/auth/register`
``` 
  //ESTRUTURA DO CORPO
  {
    "name": "kaua",
    "email": "kaua@gmail.com",
    "password": "123123",
    "password_confirmation": "123123",
    "user_type_id": 2
  }

  //MENSAGEM APÓS A REQUISIÇÃO (CASO ESTEJA TUDO CORRETO)
  {
    "registrado": true,
    "user": {
        "name": "string",
        "email": "string",
        "user_type_id": "string",
        "updated_at": "string",
        "created_at": "string",
        "id": 0
    },
    "token": {
        "accessToken": {
            "name": "string",
            "abilities": [
                "string"
            ],
            "expires_at": null,
            "tokenable_id": 0,
            "tokenable_type": "string",
            "updated_at": "string",
            "created_at": "string",
            "id": 0
        },
        "plainTextToken": "string"
    }
  }
```
- `http://127.0.0.1:8000/api/auth/login`
```
  //CORPO DA REQUISIÇÃO
  {
    "email": "kaua@gmail.com",
    "password": "123123"
  }

  //RESPOSTA

  {
    "user": {
        "id": 1,
        "name": "kaua",
        "email": "kaua@gmail.com",
        "email_verified_at": null,
        "created_at": "2025-09-29T14:41:34.000000Z",
        "updated_at": "2025-09-29T14:41:34.000000Z",
        "user_type_id": 2
    },
    "logado": true,
    "token": {
        "accessToken": {
            "name": "token-api",
            "abilities": [
                "*"
            ],
            "expires_at": null,
            "tokenable_id": 1,
            "tokenable_type": "App\\Models\\User",
            "updated_at": "2025-09-29T14:41:41.000000Z",
            "created_at": "2025-09-29T14:41:41.000000Z",
            "id": 2
        },
        "plainTextToken": "2|RmF7KlgzsWIGZvfJW76dbyF2GLeVW1PP4KUkwiLj375a6f00"
    }
  }
```
- `http://127.0.0.1:8000/api/auth/logout`
```
  //NECESSÁRIO PASSAR O TOKEN QUE FOI GERADO NO LOGIN NA PARTE DE AUTENTICAÇÃO 

  {
    "logout": true,
    "mensagem": "logout realizado com sucesso"
  }
```
### Endpoints relacionados ao cliente (Registro, Listagem, Delete e Update) em ordem
- `http://127.0.0.1:8000/api/client/create`
```
  //PASSAR NO CORPO DA REQUISIÇÃO
  {
    "phone": "988346537",
    "address": "rua lazaro ferreira",
    "city": "cruzeiro",
    "user_id": 1
  }

  //RESPOSTA
  {
    "client": {
        "phone": "988346537",
        "address": "rua lazaro ferreira",
        "city": "cruzeiro",
        "user_id": 1,
        "updated_at": "2025-09-28T21:34:36.000000Z",
        "created_at": "2025-09-28T21:34:36.000000Z",
        "id": 1
    }
  }
```
- `http://127.0.0.1:8000/api/client/show/{id}`
```
  //PASSAR O ID NA REQUISIÇÃO
  {
    "busca": true,
    "cliente": {
        "id": 1,
        "user_id": 1,
        "phone": "12988346537",
        "address": "larazo ferreira",
        "city": "cruzeiro",
        "created_at": "2025-09-26T23:00:36.000000Z",
        "updated_at": "2025-09-26T23:00:36.000000Z"
    }
  }
```
- `http://127.0.0.1:8000/api/client/show`
```
  //RESPOSTA
  {
    "todos os clientes": [
        {
            "id": 1,
            "user_id": 2,
            "phone": "12988346537",
            "address": "rua lazaro ferreira",
            "city": "cruzeiro",
            "created_at": "2025-09-28T21:45:53.000000Z",
            "updated_at": "2025-09-28T21:45:53.000000Z"
        },
        {
            "id": 2,
            "user_id": 2,
            "phone": "12312312312",
            "address": "centro",
            "city": "cruzeiro",
            "created_at": "2025-09-28T21:44:20.000000Z",
            "updated_at": "2025-09-28T21:44:20.000000Z"
        }
    ]
  }

```
- `http://127.0.0.1:8000/api/client/delete/{id}`
```
  //PASSAR O ID NA HORA DE FAZER A REQUISIÇÃO
  {
    "deleted": true,
    "mensagem": "usuário excluído com sucesso"
  }

```
- `http://127.0.0.1:8000/api/client/update/{id}`
```
  //PASSAR NO CORPO DA REQUISIÇÃO OS DADOS QUE DESEJA ALTERAR
  {
    "phone": "988346537",
    "address": "rua major hermogenes",
    "city": "cruzeiro"
  }

  //RESPOSTA
  {
    "atualizado": true,
    "mensagem": "dados atualizados com sucesso",
    "dados": {
        "id": 3,
        "user_id": 3,
        "phone": "988346537",
        "address": "rua major hermogenes",
        "city": "cruzeiro",
        "created_at": "2025-09-28T21:45:53.000000Z",
        "updated_at": "2025-09-28T22:37:04.000000Z"
    }
  }
```
  ### Endpoints relacionados ao agendamento (Criar, Lisagem e Apagar)
- `http://127.0.0.1:8000/api/schedule/create`
```
    //PASSAR NO CORPO
    {
        "client_id": 2,
        "start_date": "2025-10-10",
        "type": "corte e barba"
    }

    //RESPOSTA
        {
        "agendado": true,
        "schedule": {
            "client_id": 2,
            "start_date": "2025-10-10",
            "type": "corte e barba",
            "updated_at": "2025-09-28T21:49:08.000000Z",
            "created_at": "2025-09-28T21:49:08.000000Z",
            "id": 1
        }
    }
```
- `http://127.0.0.1:8000/api/schedule/show`
```
    //RESPOSTA
    {
        "todos os serviços": [
            {
                "id": 1,
                "client_id": 2,
                "start_date": "2025-10-10",
                "end_date": null,
                "type": "corte e barba",
                "created_at": "2025-09-28T21:49:08.000000Z",
                "updated_at": "2025-09-28T21:49:08.000000Z"
            }
        ]
    }
```
- `http://127.0.0.1:8000/api/schedule/show/{id}`
```
    //RESPOSTA
       {
        "serviços do id: 2": {
            "id": 2,
            "client_id": 3,
            "start_date": "2025-10-11",
            "end_date": null,
            "type": "corte",
            "created_at": "2025-09-28T21:51:22.000000Z",
            "updated_at": "2025-09-28T21:51:22.000000Z"
        }
    }
```
- `http://127.0.0.1:8000/api/schedule/delete/{id}`
```
    //RESPOSTA
    {
        "deleted": true,
        "mensagem": "agendamento excluido"
    }
```

## Requisitos para rodar

- PHP 8.2 ou superior
- Composer 2.0 ou superior
- MySql

## Como executar

- Primeiramente deve verificar se as versões do PHP e do Composer estão nas recomendadas: php -v && composer -v
- Depois dar um git clone no repositório: git clone `https://github.com/KauaHenrique06/barbearia-api.git`
- Alterar os dados referentes ao banco de dados no arquivo `.env`
```
Exemplo do código ja formatado

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=loja_virtual
DB_USERNAME=root
DB_PASSWORD=070506
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
## Endpoints do sistema

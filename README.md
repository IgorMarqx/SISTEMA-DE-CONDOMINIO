# Condominio API
Esta API tem como principal finalidade o gerenciamento de sistemas de condomínio. Ela oferece funcionalidades para criar e administrar condomínios, áreas comuns, apartamentos, garagens e usuários.

## End-Points

Esta API disponibiliza três endpoints que podem ser acessados livremente, sem a necessidade de autenticação:

| TIPO | END-POINT | O QUE ELA FAZ |
|-----------------------|-----------------------|-----------------------|
| `GET`    | `api/ping`     |Esta rota serve para verificar o funcionamento da API.|
| `GET`   | `api/unauthorized`     |Esta rota fornece uma resposta JSON de erro de autorização imediatamente.|
| `POST`     | `api/auth/login `    |Essa rota permite fazer login na aplicação.|

Rotas de usuários: `users`

| TIPO | END-POINT | O QUE ELA FAZ |
|-----------------------|-----------------------|-----------------------|
| `GET`     | `api/users/{id} `    |Esta rota é responsável por recuperar um usuário específico.|
| `GET`     | `api/users`    |Esta rota é responsável por recuperar todos os usuários.|

***

```http
GET api/filter/users
```
Esta rota é responsável pela filtragem de usuários.
| PARAMETROS | TIPOS | DESCRIÇÃO |
|-----------------------|-----------------------|-----------------------|
| `userFilter`    | `string/integer`     |required|

***

```http
POST api/auth/register
```
Esta rota é responsável pelo registro de usuários.
| PARAMETROS | TIPOS | DESCRIÇÃO |
|-----------------------|-----------------------|-----------------------|
| `name`    | `string`     |required|
| `email`    | `string`     |required/email/unique|
| `password`    | `string/integer`     |required/confirmed/min:5|
| `password_confirmation`    | `string/integer`     |min:5|
| `condominium_id`    | `integer`     |required/numeric/condominium_exists|

***

```http
DELETE api/users/{id}
```
Esta rota é responsável pela exclusão de usuários.
| PARAMETROS | TIPOS | DESCRIÇÃO |
|-----------------------|-----------------------|-----------------------|
| `id`    | `string/integer`     |required|

***

```http
DELETE api/users/{id}
```
Esta rota é responsável pela exclusão de usuários.
| PARAMETROS | TIPOS | DESCRIÇÃO |
|-----------------------|-----------------------|-----------------------|
| `id`    | `string/integer`     |required|

***

```http
PUT api/users/{id}
```
Essa rota é responsável pela edição dos usuários
| PARAMETROS | TIPOS | DESCRIÇÃO |
|-----------------------|-----------------------|-----------------------|
| `id`    | `string/integer`     |required|

***

Rotas de condominios: `condominium`

| TIPO | END-POINT | O QUE ELA FAZ |
|-----------------------|-----------------------|-----------------------|
| `GET`    | `api/condominium`     |Esta rota é responsável pelo registro de condominios.|
| `DELETE`   | `api/condominium/{id}`     |Esta rota é responsável pela exclusão de condominios.|
| `PUT/PATCH`     | `api/condominium/{id} `    |Essa rota é responsável pela edição dos condominios.|
| `GET`     | `api/condominium/{id}`    |Esta rota é responsável por recuperar um condominio específico.|
| `GET`     | `api/filter/condominium`    |Esta rota é responsável pela filtragem de condominios.|
| `GET`     | `api/condominium`    |Esta rota é responsável por recuperar todos os condominios.|

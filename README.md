# Condominio API
Esta API tem como principal finalidade o gerenciamento de sistemas de condomínio. Ela oferece funcionalidades para criar e administrar condomínios, áreas comuns, apartamentos, garagens e usuários.

## End-Points

Esta API disponibiliza três endpoints que podem ser acessados livremente, sem a necessidade de autenticação:

| TIPO | END-POINT | O QUE ELA FAZ |
|-----------------------|-----------------------|-----------------------|
| `GET`    | `api/ping`     |Esta rota serve para verificar o funcionamento da API.|
| `GET`   | `api/unauthorized`     |Esta rota fornece uma resposta JSON de erro de autorização imediatamente.|
| `POST`     | `api/auth/login `    |Essa rota permite fazer login na aplicação.|

### Rotas de usuários: `users`

| TIPO | END-POINT | O QUE ELA FAZ |
|-----------------------|-----------------------|-----------------------|
| `GET`     | `api/users/{id} `    |Esta rota é responsável por recuperar um usuário específico.|
| `GET`     | `api/users`    |Esta rota é responsável por recuperar todos os usuários.|

***

- Esta rota é responsável pela filtragem de usuários.
    ```http
    GET api/filter/users
    ```
    | PARAMETROS | TIPOS | DESCRIÇÃO |
    |-----------------------|-----------------------|-----------------------|
    | `userFilter`    | `string/integer`     |required|
    
***

- Esta rota é responsável pelo registro de usuários.
    ```http
    POST api/auth/register
    ```
    | PARAMETROS | TIPOS | DESCRIÇÃO |
    |-----------------------|-----------------------|-----------------------|
    | `name`    | `string`     |required|
    | `email`    | `string`     |required/email/unique|
    | `password`    | `string/integer`     |required/confirmed/min:5|
    | `password_confirmation`    | `string/integer`     |min:5|
    | `condominium_id`    | `integer`     |required/numeric/condominium_exists|

***

- Esta rota é responsável pela exclusão de usuários.
    ```http
    DELETE api/users/{id}
    ```
    | PARAMETROS | TIPOS | DESCRIÇÃO |
    |-----------------------|-----------------------|-----------------------|
    | `id`    | `string/integer`     |required|

***

- Esta rota é responsável pela exclusão de usuários.
    ```http
    DELETE api/users/{id}
    ```
    | PARAMETROS | TIPOS | DESCRIÇÃO |
    |-----------------------|-----------------------|-----------------------|
    | `id`    | `string/integer`     |required|

***

- Essa rota é responsável pela edição dos usuários
    ```http
    PUT api/users/{id}
    ```
    | PARAMETROS | TIPOS | DESCRIÇÃO |
    |-----------------------|-----------------------|-----------------------|
    | `id`    | `string/integer`     |required|

***

### Rotas de condominios: `condominium`

| TIPO | END-POINT | O QUE ELA FAZ |
|-----------------------|-----------------------|-----------------------|
| `GET`     | `api/condominium/{id}`    |Esta rota é responsável por recuperar um condominio específico.|
| `GET`     | `api/condominium`    |Esta rota é responsável por recuperar todos os condominios.|

- Esta rota é responsável pela filtragem de condominios.
    ```http
    GET api/filter/condominium
    ```
    | PARAMETROS | TIPOS | DESCRIÇÃO |
    |-----------------------|-----------------------|-----------------------|
    | `condominiumFilter`    | `string/integer`     |required|
    
***

- Esta rota é responsável pelo registro de condominios.
    ```http
    POST api/condominium
    ```
    | PARAMETROS | TIPOS | DESCRIÇÃO |
    |-----------------------|-----------------------|-----------------------|
    | `name`    | `string/integer`     |required/unique|
    | `address`    | `string/integer`     |required/unique|

***

- Esta rota é responsável pela exclusão de condominios.
    ```http
    DELETE api/condominium/{id}
    ```
    | PARAMETROS | TIPOS | DESCRIÇÃO |
    |-----------------------|-----------------------|-----------------------|
    | `id`    | `string/integer`     |required|

***

- Esta rota é responsável pela edição dos condominios.
    ```http
    PUT api/condominium/{id}
    ```
    | PARAMETROS | TIPOS | DESCRIÇÃO |
    |-----------------------|-----------------------|-----------------------|
    | `id`    | `string/integer`     |required|

***

## Rotas de areas: `areas`

| TIPO | END-POINT | O QUE ELA FAZ |
|-----------------------|-----------------------|-----------------------|
| `GET`     | `api/areas/{id}`    |Esta rota é responsável por recuperar uma area específico.|
| `GET`     | `api/areas`    |Esta rota é responsável por recuperar todos as areas.|

***

- Esta rota é responsável pela criação das areas.
  * Para a criação dos condominios é necessário antes ter criado algum condominio
  ```http
  POST api/condominium/{id}
  ```
  | PARAMETROS | TIPOS | DESCRIÇÃO |
  |-----------------------|-----------------------|-----------------------|
  | `name`    | `string/integer`     |required|
  | `days`    | `date`     |required/date_format:Y-m-d|
  | `start_time`    | `time`     |required/date_format:H:i:s|
  | `end_time`    | `time`     |required/date_format:H:i:s|
  | `condominium_id`    | `integer`     |required/numeric/condominium_exists|

***

- Esta rota é responsável pela edição das areas.
    ```http
    PUT api/areas/{id}
    ```
    | PARAMETROS | TIPOS | DESCRIÇÃO |
    |-----------------------|-----------------------|-----------------------|
    | `id`    | `string/integer`     |required|

***
- Esta rota é responsável pela exclusão das areas.
    ```http
    DELETE api/areas/{id}
    ```
    | PARAMETROS | TIPOS | DESCRIÇÃO |
    |-----------------------|-----------------------|-----------------------|
    | `id`    | `string/integer`     |required|

***

## Rotas de apartamentos: `apartment`



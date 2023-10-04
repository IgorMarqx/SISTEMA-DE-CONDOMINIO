# Condominio API
Esta API tem como principal finalidade o gerenciamento de sistemas de condomínio. Ela oferece funcionalidades para criar e administrar condomínios, áreas comuns, apartamentos, garagens e usuários.

## Tópicos
<p align="center">
  <a href="#end-points">End-points</a> •
  <a href="#usuarios">Rota de usuários</a> •
  <a href="#condominios">Rota de condomínios</a> •
  <a href="#areas">Rota de áreas</a> •
  <a href="#apartamentos">Rota de apartamentos</a> •
  <a href="#jwt">JWT</a> •
  <a href="#migrations">Migrations</a> •
  <a href="#author">Autor</a> •
</p>

## Sistema de autenticação JWT
<a id="jwt"></a>
Esta API utiliza um sistema de autenticação chamado JWT (JSON Web Token). Para começar a usá-lo, você deve adicionar um campo à sua variável de ambiente.<br>
Para gerar seu próprio token JWT, execute o seguinte comando: `php artisan jwt:secret`.

```env
JWT_SECRET=(token-de-acesso)
```

## Rodando as migrations
<a id="migrations"></a>
Antes de tudo, é necessário executar as `migrations`. Foi implementado seeders e factories para simplificar os testes da API. Caso deseje, basta executar o seguinte comando para preencher o banco de dados de maneira adequada.

```php
$ php artisan migrate --seed
```

## End-Points
<a id="end-points"></a>

Esta API disponibiliza três endpoints que podem ser acessados livremente, sem a necessidade de autenticação:

| TIPO | END-POINT | O QUE ELA FAZ |
|-----------------------|-----------------------|-----------------------|
| `GET`    | `api/ping`     |Esta rota serve para verificar o funcionamento da API.|
| `GET`   | `api/unauthorized`     |Esta rota fornece uma resposta JSON de erro de autorização imediatamente.|
| `POST`     | `api/auth/login `    |Essa rota permite fazer login na aplicação.|

### Rotas de usuários: `users`
<a id="usuarios"></a>

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
<a id="condominios"></a>

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
<a id="areas"></a>

| TIPO | END-POINT | O QUE ELA FAZ |
|-----------------------|-----------------------|-----------------------|
| `GET`     | `api/areas/{id}`    |Esta rota é responsável por recuperar uma area específico.|
| `GET`     | `api/areas`    |Esta rota é responsável por recuperar todos as areas.|

***

- Esta rota é responsável pela criação das areas.
  * Para a criação das areas é necessário antes ter criado algum condominio
  ```http
  POST api/areas
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
<a id="apartamentos"></a>


| TIPO | END-POINT | O QUE ELA FAZ |
|-----------------------|-----------------------|-----------------------|
| `GET`     | `api/apartment/{id}`    |Esta rota é responsável por recuperar uma apartamento específico.|
| `GET`     | `api/apartment`    |Esta rota é responsável por recuperar todos os apartamentos.|

***

- Esta rota é responsável pela criação das areas.
  * Para a criação dos apartamentos é necessário antes ter criado algum condominio
  ```http
  POST api/apartment
  ```
  | PARAMETROS | TIPOS | DESCRIÇÃO |
  |-----------------------|-----------------------|-----------------------|
  | `identify`    | `string/integer`     |required|
  | `condominium_id`    | `integer`     |required/numeric/condominium_exists|

***

- Esta rota é responsável pela edição dos apartamentos.
    ```http
    PUT api/apartment/{id}
    ```
    | PARAMETROS | TIPOS | DESCRIÇÃO |
    |-----------------------|-----------------------|-----------------------|
    | `id`    | `string/integer`     |required|

***

- Esta rota é responsável pela exclusão dos apartamentos.
    ```http
    DELETE api/apartment/{id}
    ```
    | PARAMETROS | TIPOS | DESCRIÇÃO |
    |-----------------------|-----------------------|-----------------------|
    | `id`    | `string/integer`     |required|

***

## Autor
<a id="author"></a>

- ***Igor Marques de Azevedo*** - [Linkedin](https://www.linkedin.com/in/igor-marques-azevedo/)



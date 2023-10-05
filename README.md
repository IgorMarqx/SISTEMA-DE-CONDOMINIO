# Condominio API
Esta API tem como principal finalidade o gerenciamento de sistemas de condomínio. Ela oferece funcionalidades para criar e administrar condomínios, áreas comuns, apartamentos, garagens e usuários.

## Tópicos
<p align="center">
  <a href="#getting-start">Primeiros passos 📗</a> •
  <a href="#end-points">End-points ✨</a> •
  <a href="#usuarios">Rota de usuários 🙍‍♂️</a> •
  <a href="#condominios">Rota de condomínios 🏢</a> •
  <a href="#areas">Rota de áreas 🛝</a> •
  <a href="#apartamentos">Rota de apartamentos 🌆</a> •
  <a href="#jwt">JWT 🔥</a> •
  <a href="#migrations">Migrations 🛸</a> •
  <a href="#author">Autor 💎</a>
</p>

## Escopo geral da API
Esta API foi desenvolvida utilizando a estrutura de pastas fornecida pelo Laravel, proporcionando uma organização exemplar. Foi utilizado a seguinte estrutura:

- Repository Pattern:
  * Na pasta `app`, você encontrará a pasta `repositories`, onde estão organizadas as respectivas subpastas contendo cada classe de repository e suas interfaces correspondentes. Todas as operações de banco de dados foram realizadas exclusivamente através desses repositórios. Os repositorys têm a responsabilidade exclusiva de executar apenas as consultas no banco de dados.
- Services:
  * Nessa pasta, você encontrará todas as subpastas correspondentes contendo as validações para as operações do banco de dados. Os services englobam todas as validações, incluindo a verificação do correto preenchimento do ID do usuário para operações de exclusão e atualização.
- Controllers:
  * O funcionamento dos controladores segue um padrão consistente para todos. Cada controlador possui um construtor que chama a classe de serviços correspondente à aquele controlador, e cada método recebe parâmetros dos serviços e retorna uma validação padrão. Esses controladores estão organizados em subpastas, onde cada um deles reside em sua respectiva subpasta. Além disso, há uma pasta chamada `filters`, que abriga os controladores responsáveis pelas rotas de filtragem de dados.
- Requests:
  * Seguindo um padrão distinto para a validação dos dados de entrada, estamos empregando uma abordagem denominada `Request Forms`, um padrão do Laravel que assume a responsabilidade de manipular os dados de entrada para cada endpoint. Além disso, esse padrão também executa a validação para garantir que não haja incompatibilidade nos dados enviados, retornando um erro caso ocorra alguma invalidação dos dados.
- Resources:
  * Estamos adotando um padrão consistente para as respostas da API, utilizando os recursos `(resources)` do Laravel. Esse padrão uniformiza todas as respostas da API, garantindo que cada controlador utilize esse formato padronizado para as saídas.
- Providers:
  * Dentro da pasta de providers, existe um arquivo chamado `AppServiceProvider`, onde você encontra todos os registros das interfaces dos repositórios. Além disso, esses registros são configurados usando o padrão singleton.


## Primeiros passos
<a id="getting-start"></a>
É necessário rodar o composer para poder gerar todas as dependências necessárias:

```php
$ composer install
```

Rode as migrations:

```php
$ php artisan migrate
```

## Sistema de autenticação JWT
<a id="jwt"></a>
Esta API utiliza um sistema de autenticação chamado JWT (JSON Web Token). Para começar a usá-lo, você deve adicionar um campo à sua variável de ambiente.<br>
Para gerar seu próprio token JWT, execute o seguinte comando: `php artisan jwt:secret`.

```env
JWT_SECRET=(token-de-acesso)
```

Após a configuração inicial, basta acessar a rota de login e fornecer um usuário válido para gerar um `TOKEN`. <br>
Com o `TOKEN` gerado, você deve acessar o seu aplicativo de teste da API e inserir os seguintes campos nos headers:

| HEADER NAME | HEADER VALUE |
|-----------------------|-----------------------|
| `Authorization`    | `Bearer (token-de-acesso)`     |


## Rodando as migrations
<a id="migrations"></a>
Foi implementado seeders e factories para simplificar os testes da API. <br>
Caso deseje utilizar, basta executar o seguinte comando para preencher o banco de dados de maneira adequada.

```php
$ php artisan migrate --seed
```

Caso anteriormente já tenha executado as migrations se as seeders, rode o seguinte comando para utilizar os seeders:

```php
$ php artisan migrate:fresh --seed
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



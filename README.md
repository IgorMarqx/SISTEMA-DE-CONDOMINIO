# Condominio API
Esta API tem como principal finalidade o gerenciamento de sistemas de condomínio. Ela oferece funcionalidades para criar e administrar condomínios, áreas comuns, apartamentos, garagens e usuários.

## End-Points

Esta API disponibiliza três endpoints que podem ser acessados livremente, sem a necessidade de autenticação:

| TIPO | NOME DA ROTA | O QUE ELA FAZ |
|-----------------------|-----------------------|-----------------------|
| `GET`    | `api/ping`     |Esta rota serve para verificar o funcionamento da API.|
| `GET`   | `api/unauthorized`     |Esta rota fornece uma resposta JSON de erro de autorização imediatamente.|
| `POST`     | `api/auth/login `    |Essa rota permite fazer login na aplicação.|

Rotas que requerem autenticação:

| TIPO | NOME DA ROTA | O QUE ELA FAZ |
|-----------------------|-----------------------|-----------------------|
| `GET`    | `api/auth/register`     |Esta rota serve para verificar o funcionamento da API.|
| `DELETE`   | `api/users/{id}`     |Esta rota fornece uma resposta JSON de erro de autorização imediatamente.|
| `PUT/PATCH`     | `api/users/{id} `    |Essa rota permite fazer login na aplicação..|
| `GET`     | `api/users/{id} `    |Essa rota permite fazer login na aplicação..|
| `POST`     | `api/users `    |Essa rota permite fazer login na aplicação..|
| `GET`     | `api/users`    |Essa rota permite fazer login na aplicação..|

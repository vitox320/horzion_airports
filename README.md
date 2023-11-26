## 

# HORIZON AIRPORTS 
## Stack
<p align="center">
  <a href="https://skillicons.dev" style="display: flex; justify-content: center">
    <img src="https://skillicons.dev/icons?i=php,laravel,github,sqlite" />
  </a>
</p>

- php 8.1
- sqlite
- Laravel 10
- phpunit

### Configuração servidor:
    1 passo -> Criar um arquivo database.sqlite dentro da pasta database/
    2 passo -> Renomear o .env.example para env 
    3 passo -> Renomear o DB_CONNECTION para DB_CONNECTION=sqlite
    4 passo -> Executar o comando: php artisan optimize:clear
    5 passo -> Executar o comando: php artisan migrate --seed
    6 passo -> Executar o comando: php artisan serve

## Testes

- Para que os testes possam ser executados executar o seguinte comando:
    - php artisan test

### Funcionalidades Testadas
     - Autenticação
     - Listagem de aeroportos
     - Fluxo/CRUD de voos
     - Fluxo/CRUD de Passagens

## Documentação
- Documentação:https://documenter.getpostman.com/view/22314878/2s9YeD9tKM
 

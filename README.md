# Notes com Laravel

Este é um projeto de um simples aplicativo de anotações (Notes) desenvolvido com o framework Laravel. Ele permite que os usuários se registrem, façam login e gerenciem suas anotações pessoais.

## Funcionalidades

-   Registro de novos usuários.
-   Autenticação de usuários (Login/Logout).
-   Criação, visualização, edição e exclusão de anotações.
-   Design responsivo utilizando Bootstrap.

## Tecnologias Utilizadas

-   **Backend:**
    -   PHP 8.2
    -   Laravel 12
-   **Frontend:**
    -   Vite.js
    -   Bootstrap 5
    -   Font Awesome
-   **Banco de Dados:**
    -   Compatível com MySQL, PostgreSQL, SQLite, etc (configurável no Laravel).

## Instalação e Execução

Siga os passos abaixo para configurar e executar o projeto em seu ambiente de desenvolvimento local.

1.  **Clonar o repositório:**
    ```bash
    git clone https://github.com/seu-usuario/notes-laravel.git
    cd notes-laravel
    ```

2.  **Instalar dependências (PHP e JS):**
    ```bash
    composer install
    npm install
    ```

3.  **Configurar o ambiente:**
    -   Copie o arquivo de exemplo `.env.example` para `.env`.
        ```bash
        cp .env.example .env
        ```
    -   Gere a chave da aplicação:
        ```bash
        php artisan key:generate
        ```
    -   Configure as variáveis do banco de dados no arquivo `.env` (DB_DATABASE, DB_USERNAME, DB_PASSWORD, etc.).

4.  **Executar as migrações e seeders:**
    As migrações criarão as tabelas `users` e `notes`. O seeder criará um usuário de exemplo.
    ```bash
    php artisan migrate --seed
    ```
    **Usuário de Exemplo:**
    -   **Email:** `user@example.com`
    -   **Senha:** `password`

5.  **Compilar os assets do frontend:**
    ```bash
    npm run build
    ```

6.  **Iniciar o servidor de desenvolvimento:**
    -   Inicie o servidor do Laravel:
        ```bash
        php artisan serve
        ```
    -   Em outro terminal, inicie o Vite para o hot-reloading (desenvolvimento):
        ```bash
        npm run dev
        ```

7.  **Acessar a aplicação:**
    Abra seu navegador e acesse [http://127.0.0.1:8000](http://127.0.0.1:8000).

## Estrutura de Pastas Principais

```
├── app/                # Contém o núcleo da aplicação (Models, Controllers, etc.)
├── config/             # Arquivos de configuração do projeto
├── database/           # Migrações, factories e seeders do banco de dados
├── public/             # Pasta pública com assets (CSS, JS, imagens)
├── resources/          # Arquivos de frontend (views Blade, CSS/JS não compilados)
├── routes/             # Definição das rotas da aplicação (web.php)
└── tests/              # Arquivos de teste
```

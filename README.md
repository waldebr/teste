# Projeto Banco Carlos

Aplicação Laravel 12 com autenticação (login/cadastro) e um painel protegido que
exibe totais das tabelas do banco `banco_carlos`.

## Requisitos

- PHP 8.2+ com `pdo_sqlite` (ou `pdo_mysql` se for usar MySQL)
- Composer 2
- Node.js 20.19+ e npm

## Como rodar

Na pasta do projeto:

```powershell
composer install
copy .env.example .env
php artisan key:generate
php artisan migrate --seed
npm install
```

Depois abra **dois terminais**:

```powershell
# Terminal 1 - front-end (Vite + Tailwind)
npm run dev
```

```powershell
# Terminal 2 - servidor PHP
php artisan serve
```

Acesse **http://127.0.0.1:8000**.

> Se o PowerShell bloquear o `npm.ps1` por política de execução, use
> `npm.cmd install` e `npm.cmd run dev`, ou execute os comandos pelo `cmd.exe`.

## Usuário padrão

| E-mail             | Senha      |
|--------------------|------------|
| `admin@carlos.com` | `password` |

## Banco de dados

Por padrão o projeto usa **SQLite** (`database/database.sqlite`), sem precisar
configurar servidor. O arquivo é criado automaticamente no primeiro `migrate`
caso não exista.

Para usar **MySQL/MariaDB** (XAMPP), crie o banco e ajuste o `.env`:

```sql
CREATE DATABASE banco_carlos CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
```

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=banco_carlos
DB_USERNAME=root
DB_PASSWORD=
```

Depois rode novamente:

```powershell
php artisan migrate:fresh --seed
```

## O que foi corrigido/estruturado

- Esqueleto Laravel 12 completo (`artisan`, `composer.json`, `config`, `public`,
  `bootstrap`, `storage`, etc.).
- `package.json` + `vite.config.js` + Tailwind CSS 4 integrados via `@vite`.
- Seeder com o namespace correto (`Database\Seeders`), necessário no Laravel 8+.
- `.env.example` com SQLite como padrão e bloco MySQL documentado.
- `phpunit.xml` usando SQLite em memória nos testes.
- Compatibilidade com PHP 8.5 (constante de SSL do MySQL sem depreciação).
- Testes de autenticação e de proteção de rotas.

## Testes

```powershell
php artisan test
```

## Rotas

| Método | Rota        | Descrição                          |
|--------|-------------|------------------------------------|
| GET    | `/`         | Redireciona para o painel/login    |
| GET    | `/login`    | Formulário de login                |
| POST   | `/login`    | Autentica (throttle 6/min)         |
| GET    | `/register` | Formulário de cadastro             |
| POST   | `/register` | Cria usuário e autentica           |
| GET    | `/dashboard`| Painel protegido por `auth`        |
| POST   | `/logout`   | Encerra a sessão                   |

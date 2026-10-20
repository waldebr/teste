# Projeto Banco Carlos — Login com Laravel

Este pacote contém **todos os arquivos** necessários para a parte de **login/autenticação**
de um projeto Laravel baseado no banco `banco_carlos.sql`.

O SQL original **não tinha tabela de usuários**, então criamos a tabela `users`
(padrão do Laravel) e mantivemos todas as tabelas do seu banco.

---

## Arquivos criados (o que copiar para o projeto Laravel)

```
app/
├─ Models/
│  ├─ User.php
│  ├─ Cliente.php
│  ├─ Produto.php
│  ├─ Regiao.php
│  ├─ Veiculo.php
│  ├─ Vendedor.php
│  ├─ VendedorVeiculo.php
│  ├─ NotaFiscal.php
│  ├─ ItemNota.php
│  └─ PontoEstrategico.php
├─ Http/
│  ├─ Controllers/
│  │  ├─ Controller.php
│  │  ├─ DashboardController.php
│  │  └─ Auth/
│  │     ├─ LoginController.php
│  │     └─ RegisterController.php
│  └─ Requests/Auth/LoginRequest.php
database/
├─ migrations/
│  ├─ 0001_01_01_000000_create_users_table.php
│  └─ 2026_01_01_000001_create_banco_carlos_tables.php
└─ seeders/DatabaseSeeder.php
resources/views/
├─ components/layouts/app.blade.php
├─ auth/login.blade.php
├─ auth/register.blade.php
└─ dashboard.blade.php
routes/web.php
.env.example
```

---

## Passo a passo

### 1. Preparar o PHP no PATH (XAMPP)

Você tem o XAMPP em `C:\xampp`. Adicione o PHP ao PATH (PowerShell **como Administrador**):

```powershell
[Environment]::SetEnvironmentVariable(
  "Path",
  $env:Path + ";C:\xampp\php;C:\xampp\mysql\bin",
  "Machine"
)
```

Feche e abra o terminal e confirme:

```powershell
php -v
```

> Deve aparecer `PHP 8.2.12` (é a versão que combina com o seu dump).

### 2. Instalar o Composer

Baixe e instale: https://getcomposer.org/download/ (Composer-Setup.exe).
Ao instalar, ele vai pedir o caminho do PHP: aponte para `C:\xampp\php\php.exe`.

Confirme:

```powershell
composer --version
```

### 3. Criar o projeto Laravel

```powershell
cd C:\xampp\htdocs
composer create-project laravel/laravel banco_carlos
cd banco_carlos
```

### 4. Ligar o MySQL/MariaDB no XAMPP

Abra o **XAMPP Control Panel** e clique em **Start** no módulo **MySQL**.

### 5. Criar o banco e configurar o `.env`

Abra o phpMyAdmin (http://localhost/phpmyadmin) ou rode no terminal:

```powershell
mysql -u root
```

```sql
CREATE DATABASE banco_carlos CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
exit;
```

No projeto, copie o `.env.example` (deste pacote) para `.env`:

```powershell
copy C:\Users\rosec\Documents\Projeto` Padrão\.env.example .env
php artisan key:generate
```

Confira no `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=banco_carlos
DB_USERNAME=root
DB_PASSWORD=
```

> **Importante:** `SESSION_DRIVER=database` e `CACHE_STORE=database` usam tabelas
> criadas pelas migrations — por isso rodamos `migrate` antes de testar o login.

### 6. Copiar os arquivos deste pacote para o projeto

Copie cada arquivo da estrutura acima para dentro de `C:\xampp\htdocs\banco_carlos`,
respeitando exatamente os mesmos caminhos (sobrescrevendo `routes/web.php`,
`database/seeders/DatabaseSeeder.php` e as migrations de `users`).

Um comando rápido no PowerShell (ajuste o caminho de origem):

```powershell
$origem  = "C:\Users\rosec\Documents\Projeto Padrão"
$destino = "C:\xampp\htdocs\banco_carlos"

Copy-Item "$origem\app"              "$destino" -Recurse -Force
Copy-Item "$origem\database"         "$destino" -Recurse -Force
Copy-Item "$origem\resources\views"  "$destino\resources" -Recurse -Force
Copy-Item "$origem\routes\web.php"   "$destino\routes\web.php" -Force
```

### 7. Rodar as migrations e o seed

```powershell
php artisan migrate --seed
```

Isso cria:
- `users`, `password_reset_tokens`, `sessions` (login)
- `regiao`, `cliente`, `produtos`, `veiculo`, `vendedor`,
  `vendedor_veiculo`, `nota_fiscal`, `item_nota`, `ponto_estrategico`
- Usuário padrão + dados de exemplo

**Usuário padrão:**
| E-mail             | Senha      |
|--------------------|------------|
| `admin@carlos.com` | `password` |

### 8. Rodar o servidor

```powershell
php artisan serve
```

Acesse: **http://127.0.0.1:8000**

- `/login` → tela de login
- `/register` → criar conta
- `/dashboard` → painel protegido (só após login)

---

## Alternativa: usar o SQL direto (sem as migrations do domínio)

Se você preferir importar o `banco_carlos.sql` pelo phpMyAdmin:

1. Importe o `banco_carlos.sql` no banco `banco_carlos` (tabelas do domínio).
2. **Apague** o arquivo `database/migrations/2026_01_01_000001_create_banco_carlos_tables.php`.
3. Rode `php artisan migrate --seed` (cria só `users`/`sessions` e faz o seed).

> Use **uma das duas** opções, senão o `migrate` vai tentar criar tabelas que já existem.

---

## Como o login funciona

1. `routes/web.php` define `/login` (GET/POST) e `/logout`.
2. `LoginController@store` usa o `LoginRequest`, que:
   - valida e-mail/senha,
   - limita a 5 tentativas (`RateLimiter`) contra brute force,
   - chama `Auth::attempt()`.
3. Em caso de sucesso, a sessão é regenerada (evita *session fixation*).
4. O `/dashboard` está protegido pelo middleware `auth`. Sem login, o Laravel
   redireciona para `login`.
5. `logout` invalida a sessão e gera um novo token CSRF.

## Extras

- **Vincular usuário a vendedor:** a tabela `users` tem a coluna `cod_vendedor`
  (nullable). O `User` já tem o relacionamento `vendedor()` e o painel mostra o
  vendedor/região quando existe vínculo.
- **Views:** usam Tailwind via CDN — não precisa de `npm install`.
- **Português:** coloque `lang/pt_BR/` (ou `php artisan lang:publish`) se quiser
  mensagens de validação traduzidas.

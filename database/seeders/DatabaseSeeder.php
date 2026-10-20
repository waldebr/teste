<?php

use App\Models\Cliente;
use App\Models\NotaFiscal;
use App\Models\Produto;
use App\Models\Regiao;
use App\Models\User;
use App\Models\Veiculo;
use App\Models\Vendedor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ---------- Usuario padrao para login ----------
        // E-mail: admin@carlos.com  /  Senha: password
        User::updateOrCreate(
            ['email' => 'admin@carlos.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('password'),
                'cod_vendedor' => 1,
            ]
        );

        // ---------- Dados de exemplo (opcionais) ----------
        Regiao::updateOrCreate(
            ['cod_regiao' => 1],
            ['cep' => '60000-000', 'nome' => 'Fortaleza']
        );

        Vendedor::updateOrCreate(
            ['cod_vendedor' => 1],
            ['cod_regiao' => 1, 'nome' => 'Carlos Silva']
        );

        Cliente::updateOrCreate(
            ['cod_cliente' => 1],
            ['nome' => 'Cliente Exemplo LTDA']
        );

        Produto::updateOrCreate(
            ['cod_produto' => 1],
            ['descricao' => 'Produto Exemplo', 'estoque' => 100, 'status_ativo' => true]
        );

        Veiculo::updateOrCreate(
            ['cod_veiculo' => 1],
            ['placa' => 'ABC-1234', 'descricao' => 'Fiat Uno']
        );

        NotaFiscal::updateOrCreate(
            ['num_nota' => 1],
            ['cod_vendedor' => 1, 'cod_cliente' => 1, 'preco_total' => 250.00]
        );
    }
}

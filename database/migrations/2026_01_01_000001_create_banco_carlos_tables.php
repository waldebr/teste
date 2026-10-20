<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Reproduz o schema do arquivo banco_carlos.sql, na ordem correta
 * para respeitar as FOREIGN KEY.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('regiao', function (Blueprint $table) {
            $table->integer('cod_regiao')->primary();
            $table->string('cep', 20)->nullable();
            $table->string('nome', 100)->nullable();
        });

        Schema::create('cliente', function (Blueprint $table) {
            $table->integer('cod_cliente')->primary();
            $table->string('nome', 100)->nullable();
        });

        Schema::create('produtos', function (Blueprint $table) {
            $table->integer('cod_produto')->primary();
            $table->string('descricao', 255)->nullable();
            $table->integer('estoque')->nullable();
            $table->boolean('status_ativo')->nullable();
        });

        Schema::create('veiculo', function (Blueprint $table) {
            $table->integer('cod_veiculo')->primary();
            $table->string('placa', 20)->nullable();
            $table->string('descricao', 255)->nullable();
        });

        Schema::create('vendedor', function (Blueprint $table) {
            $table->integer('cod_vendedor')->primary();
            $table->integer('cod_regiao')->nullable();
            $table->string('nome', 100)->nullable();

            $table->foreign('cod_regiao')->references('cod_regiao')->on('regiao');
        });

        Schema::create('vendedor_veiculo', function (Blueprint $table) {
            $table->integer('cod_vendedor');
            $table->integer('cod_veiculo');
            $table->date('data');

            $table->primary(['cod_vendedor', 'cod_veiculo', 'data']);

            $table->foreign('cod_vendedor')->references('cod_vendedor')->on('vendedor');
            $table->foreign('cod_veiculo')->references('cod_veiculo')->on('veiculo');
        });

        Schema::create('nota_fiscal', function (Blueprint $table) {
            $table->integer('num_nota')->primary();
            $table->integer('cod_vendedor')->nullable();
            $table->integer('cod_cliente')->nullable();
            $table->decimal('preco_total', 10, 2)->nullable();

            $table->foreign('cod_vendedor')->references('cod_vendedor')->on('vendedor');
            $table->foreign('cod_cliente')->references('cod_cliente')->on('cliente');
        });

        Schema::create('item_nota', function (Blueprint $table) {
            $table->integer('num_nota');
            $table->integer('cod_produto');
            $table->decimal('preco_unitario', 10, 2)->nullable();
            $table->integer('quantidade')->nullable();

            $table->primary(['num_nota', 'cod_produto']);

            $table->foreign('num_nota')->references('num_nota')->on('nota_fiscal');
            $table->foreign('cod_produto')->references('cod_produto')->on('produtos');
        });

        Schema::create('ponto_estrategico', function (Blueprint $table) {
            $table->integer('cod_ponto')->primary();
            $table->integer('cod_regiao')->nullable();
            $table->string('descricao', 255)->nullable();

            $table->foreign('cod_regiao')->references('cod_regiao')->on('regiao');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ponto_estrategico');
        Schema::dropIfExists('item_nota');
        Schema::dropIfExists('nota_fiscal');
        Schema::dropIfExists('vendedor_veiculo');
        Schema::dropIfExists('vendedor');
        Schema::dropIfExists('veiculo');
        Schema::dropIfExists('produtos');
        Schema::dropIfExists('cliente');
        Schema::dropIfExists('regiao');
    }
};

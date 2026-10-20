<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Tabela: vendedor_veiculo (pivo com chave composta).
 */
class VendedorVeiculo extends Model
{
    protected $table = 'vendedor_veiculo';

    protected $primaryKey = 'cod_vendedor';

    public $incrementing = false;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'cod_vendedor',
        'cod_veiculo',
        'data',
    ];

    protected $casts = [
        'data' => 'date',
    ];
}

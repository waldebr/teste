<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Tabela: veiculo
 */
class Veiculo extends Model
{
    protected $table = 'veiculo';

    protected $primaryKey = 'cod_veiculo';

    public $incrementing = false;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'cod_veiculo',
        'placa',
        'descricao',
    ];

    public function vendedores()
    {
        return $this->belongsToMany(
            Vendedor::class,
            'vendedor_veiculo',
            'cod_veiculo',
            'cod_vendedor'
        )->withPivot('data');
    }
}

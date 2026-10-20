<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Tabela: nota_fiscal
 */
class NotaFiscal extends Model
{
    protected $table = 'nota_fiscal';

    protected $primaryKey = 'num_nota';

    public $incrementing = false;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'num_nota',
        'cod_vendedor',
        'cod_cliente',
        'preco_total',
    ];

    protected $casts = [
        'preco_total' => 'decimal:2',
    ];

    public function vendedor()
    {
        return $this->belongsTo(Vendedor::class, 'cod_vendedor', 'cod_vendedor');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cod_cliente', 'cod_cliente');
    }

    public function itens()
    {
        return $this->hasMany(ItemNota::class, 'num_nota', 'num_nota');
    }
}
